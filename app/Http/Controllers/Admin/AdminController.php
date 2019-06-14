<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Collect;
use App\Creator;
use App\Http\Controllers\Controller;
use App\Message;
use App\News;
use App\Order;
use App\Product;
use App\Review;
use App\User;
use Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function index_new()
    {
        $search = request('search');
        if ($search) {
            $news       = News::where('title', 'like', '%' . $search . '%')->orderBy('date', 'desc')->paginate(10);
            $appendData = $news->appends(array(
                'search' => $search,
            ));
        } else {
            $news = News::orderBy('date', 'desc')->paginate(10);
        }
        return view('admin.new', compact('news'));
    }

    public function index_creator()
    {
        $search = request('search');
        if ($search) {
            $creators   = Creator::where('name', 'like', '%' . $search . '%')->orderBy('id', 'desc')->paginate(10);
            $appendData = $creators->appends(array(
                'search' => $search,
            ));
        } else {
            $creators = Creator::orderBy('id', 'desc')->paginate(10);
        }
        return view('admin.creator', compact('creators'));
    }

    public function index_product()
    {
        $search = request('search');
        if ($search) {
            $products   = Product::where([['status', '已通過'], ['display', 'T']])->where('name', 'like', '%' . $search . '%')->orderBy('date', 'desc')->paginate(10);
            $appendData = $products->appends(array(
                'search' => $search,
            ));
        } else {
            $products = Product::where([['status', '已通過'], ['display', 'T']])->orderBy('date', 'desc')->paginate(10);
        }
        return view('admin.product', compact('products'));
    }

    public function index_product_apply()
    {
        $search = request('search');
        if ($search) {
            $products   = Product::where('status', '申請中')->where('name', 'like', '%' . $search . '%')->orderBy('date', 'desc')->paginate(10);
            $appendData = $products->appends(array(
                'search' => $search,
            ));
        } else {
            $products = Product::where('status', '申請中')->orderBy('date', 'desc')->paginate(10);
        }
        return view('admin.product', compact('products'));
    }

    public function index_member()
    {
        $members = User::orderBy('id', 'desc')->paginate(10);
        return view('admin.member', compact('members'));
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
            $orders = Order::groupBy('orders.product_id')->selectRaw('product.price,product.name,product.id,creator.name as cr_name,count(*) as total,sum(orders.price) as sum')->join('product', 'product.id', '=', 'orders.product_id')->join('creator', 'product.creator_id', '=', 'creator.id')->where('product.name', 'like', '%' . $search . '%')->whereBetween('orders.date', [$from, $to])->orderBy('total', 'desc')->paginate(5);
        } else {
            $orders = Order::groupBy('orders.product_id')->selectRaw('product.price,product.name,product.id,creator.name as cr_name,count(*) as total,sum(orders.price) as sum')->join('product', 'product.id', '=', 'orders.product_id')->join('creator', 'product.creator_id', '=', 'creator.id')->whereBetween('orders.date', [$from, $to])->orderBy('total', 'desc')->paginate(5);
        }
        return view('admin.report', compact('orders', 'date'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function show_member($id)
    {
        $user = User::where('id', $id)->first();
        return view('auth.show', compact('user'));

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

    public function update_creator(Request $request, $id)
    {
        $creator = Creator::find($id);
        if ($creator->status == "T") {
            $creator->status = "F";
        } else {
            $creator->status = "T";
        }
        $creator->save();
        //return redirect()->back();

    }

    public function update_member(Request $request, $id)
    {
        // $user = User::find($id);

        // $user->ad_id       = "F";
        // $user->save();
        // return redirect()->back();

    }

    public function update_product(Request $request, $id)
    {
        $product = Product::find($id);
        if ($request->description) {
            $product->description = $request->description;
        }
        $product->display   = "F";
        $product->status = "未通過";
        $product->check_date     = date('Y/m/d H:i:s');
        $product->admins_id       = auth('admin')->user()->id;
        $product->save();
        return redirect()->back();
    }

    public function update_product_apply(Request $request, $id)
    {
        //return $request->description;
        $product              = Product::find($id);
        $product->display   = "T";
        $product->status = "已通過";
        $product->check_date     = date('Y/m/d H:i:s');
        $product->admins_id       = auth('admin')->user()->id;
        $product->save();
        if (substr($id, -4) != 0) {
            $s   = substr($id, 0, -4);
            $min = Product::where('id', 'like', $s . '____')->where('id', '!=', $id)->update(['display' => "F"]);
            $min = Product::where('id', 'like', $s . '____')->where('id', '!=', $id)->update(['status' => "紀錄"]);
            $min = Product::where('id', 'like', $s . '____')->where('id', '!=', $id)->update(['check_date' => date('Y/m/d H:i:s')]);
            $min = Product::where('id', 'like', $s . '____')->where('id', '!=', $id)->update(['admins_id' => auth('admin')->user()->id]);
            $product = Review::where('product_id', 'like', $s . '____')->update(['product_id' => $id]);
            $product = Order::where('product_id', 'like', $s . '____')->update(['product_id' => $id]);
            $product = Collect::where('product_id', 'like', $s . '____')->update(['product_id' => $id]);
        }
        //return redirect()->back();
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
    public function destroy_article($id)
    {
        $de = Message::where('article_id', $id)->delete();
        Article::destroy($id);
    }

    public function destroy_message($id)
    {
        Message::destroy($id);

    }

    public function download($id)
    {
        // $check = Order::where('product_id', $download)->first();
        // if (!$check) {
        //     abort(404);
        // }
        $product = Product::where('id', $id)->orderBy('date', 'desc')->first();
        if (!$product) {
            abort(404);
        }
        return response()->download($product->file, $product->name.'.exe');


    }
    

}
