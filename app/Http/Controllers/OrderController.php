<?php

namespace App\Http\Controllers;

use App\Creator;
use App\Order;
use App\Product;
use Auth;
use Ecpay;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request('search');
        if ($search) {
            $orders     = Order::where('orders.member_id', Auth::id())->where('product.name', 'like', '%' . $search . '%')->join('product', 'orders.product_id', '=', 'product.id')->orderBy('date', 'desc')->paginate(10);
            $appendData = $orders->appends(array(
                'search' => $search,
            ));
        } else {
            $orders = Order::where('member_id', Auth::id())->orderBy('date', 'desc')->paginate(10);
        }
        return view('order.index', compact('orders'));
    }

    public function index_img()
    {
        $search = request('search');
        if ($search) {
            $collects   = Order::where([['orders.member_id', Auth::id()], ['product.id', '>', 10]])->where('product.name', 'like', '%' . $search . '%')->join('product', 'orders.product_id', '=', 'product.id')->paginate(8);
            $appendData = $collects->appends(array(
                'search' => $search,
            ));
        } else {
            $collects = Order::where([['member_id', Auth::id()], ['product_id', '>', 10]])->paginate(8);
        }
        return view('collect.index', compact('collects'));
    }
    public function index_report($date = "month")
    {
        if ($date == "month") {
            $from = date("Y-m") . "-01";
            $to   = date("Y-m-d", strtotime("+1 months", strtotime($from)));
        } else if ($date == "all") {
            $from = date("Y") . "-01-01";
            $to   = date("Y-m-d", strtotime("+12 months", strtotime($from)));
            $from = '0000-01-01';
        } else {
            $from = date("Y") . "-01-01";
            $to   = date("Y-m-d", strtotime("+12 months", strtotime($from)));
        }
        $search = request('search');
        if ($search) {
            $orders = Order::groupBy('orders.product_id')->selectRaw('product.price,product.name,product.id,count(*) as total,sum(orders.price) as sum')->join('product', 'product.id', '=', 'orders.product_id')->where('product.name', 'like', '%' . $search . '%')->where('product.creator_id', Auth::id())->whereBetween('orders.date', [$from, $to])->orderBy('total', 'desc')->paginate(5);
        } else {
            $orders = Order::groupBy('orders.product_id')->selectRaw('product.price,product.name,product.id,count(*) as total,sum(orders.price) as sum')->join('product', 'product.id', '=', 'orders.product_id')->where('product.creator_id', Auth::id())->whereBetween('orders.date', [$from, $to])->orderBy('total', 'desc')->paginate(5);
        }
        return view('product.report', compact('orders', 'date'));
    }

    public function index_re()
    {
        return redirect()->route('order.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id, Request $request)
    {
        $product = Product::where('id', $id)->first();
        if ($product->price == 0) {
            $order             = new Order;
            $order->member_id  = Auth::id();
            $order->product_id = $id;
            $order->status     = "交易成功";
            $order->price      = $product->price;
            $order->date       = date('Y/m/d H:i:s');
            $order->save();
            return redirect()->route('order.index');
        }

        if ($request->name || $request->code || $request->account) {
            $rules = [
                'name'    => 'required|string|min:1|max:15',
                'code'    => 'required|numeric|max:999',
                'account' => 'required|numeric|min:6',
            ];
            $messages = [
            ];
            request()->validate($rules, $messages);
        }

        Ecpay::i()->Send['OrderResultURL']    = env('PAY_SERVICE_OrderResultURL');
        Ecpay::i()->ServiceURL                = env('PAY_SERVICE_URL');
        Ecpay::i()->Send['ReturnURL']         = env('PAY_SERVICE_ReturnURL');
        Ecpay::i()->Send['MerchantTradeNo']   = "Virtual" . time(); //訂單編號
        Ecpay::i()->Send['MerchantTradeDate'] = date('Y/m/d H:i:s'); //交易時間
        Ecpay::i()->Send['TotalAmount']       = (int) "$product->price"; //交易金額
        Ecpay::i()->Send['TradeDesc']         = "good to drink"; //交易描述
        Ecpay::i()->Send['CustomField1']      = $product->id . "," . Auth::id() . "," . $product->price;
        if ($product->id == 1) {
            Ecpay::i()->Send['CustomField2'] = $request->name;
            Ecpay::i()->Send['CustomField3'] = $request->code;
            Ecpay::i()->Send['CustomField4'] = $request->account;
        }
        Ecpay::i()->Send['ChoosePayment'] = \ECPay_PaymentMethod::Credit; //付款方式
        array_push(Ecpay::i()->Send['Items'], array('Name' => "$product->name", 'Price' => (int) "$product->price", 'Currency' => "元", 'Quantity' => (int) "1", 'URL' => "dedwed"));
        echo Ecpay::i()->CheckOutString();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $arFeedback = Ecpay::i()->CheckOutFeedback($request->all());
            $str        = $request->CustomField1;
            $str_sec    = explode(",", $str);
            $p_id       = $str_sec[0];
            $m_id       = $str_sec[1];
            $price      = $str_sec[2];

            $order             = new Order;
            $order->member_id  = $m_id;
            $order->product_id = $p_id;
            $order->status     = "交易成功";
            $order->price      = $price;
            $order->date       = date('Y/m/d H:i:s');
            $order->save();

            if ($p_id == 1) {
                $creator          = new Creator;
                $creator->id      = $m_id;
                $creator->name    = $request->CustomField2;
                $creator->code    = $request->CustomField3;
                $creator->account = $request->CustomField4;
                $creator->status  = "T";
                $creator->save();
            }
            echo '1|OK';
        } catch (Exception $e) {
            echo '0|' . $e->getMessage();
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
