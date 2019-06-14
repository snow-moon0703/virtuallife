<?php

namespace App\Http\Controllers;

use App\Creator;
use App\Http\Requests\ProductPost;
use App\News;
use App\Order;
use App\product;
use App\Product_image;
use App\Review;
use App\Collect;
use Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
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
            $products   = Product::where('display', 'T')->where('name', 'like', '%' . $search . '%')->orderBy('date', 'desc')->paginate(12);
            $appendData = $products->appends(array(
                'search' => $search,
            ));
        } else {
            $products = Product::where('display', 'T')->orderBy('date', 'desc')->paginate(12);
        }
        return view('product.index', compact('products'));
    }
    public function index_home()
    {
        $news         = News::orderBy('date', 'desc')->paginate(3);
        $products     = Product::where('display', 'T')->orderBy('date', 'desc')->paginate(4);
        $products_new = Product::where('display', 'T')->orderBy('date', 'desc')->paginate(5);
        $products_hot = Order::groupBy('product_id')->selectRaw('*,count(*) as total')->where('product_id', '>', 1)->orderBy('total', 'desc')->paginate(5);
        $videos       = Product::where('display', 'T')->where('video', '!=', null)->paginate(4);

        return view('index', compact('products', 'products_new', 'products_hot', 'news', 'videos'));
    }

    public function index_ranking($rank)
    {
        if ($rank == 1) {
            $products = Product::where('display', 'T')->orderBy('date', 'desc')->paginate(10);
            return view('product.ranking', compact('products'));
        } else {
            $orders = Order::groupBy('product_id')->selectRaw('*,count(*) as total')->where('product_id', '>', 1)->orderBy('total', 'desc')->paginate(10);
            return view('product.ranking', compact('orders'));
        }

    }

    public function index_type($type)
    {
        $search = request('search');
        if ($search) {
            $products   = Product::where([['display', 'T'], ['type_id', $type]])->where('name', 'like', '%' . $search . '%')->orderBy('date', 'desc')->paginate(10);
            $appendData = $products->appends(array(
                'search' => $search,
            ));
        } else {
            $products = Product::where([['display', 'T'], ['type_id', $type]])->orderBy('date', 'desc')->paginate(10);
        }
        return view('product.index', compact('products'));
    }

    public function index_my()
    {
        $search = request('search');
        if ($search) {
            $products   = Product::where('display', 'T')->where('name', 'like', '%' . $search . '%')->paginate(10);
            $appendData = $products->appends(array(
                'search' => $search,
            ));
        } else {
            $products = Product::where([['display', 'T'], ['creator_id', Auth::id()]])->paginate(10);
        }
        return view('product.index', compact('products'));
    }

    public function management()
    {
        $search = request('search');
        if ($search) {
            $products   = Product::where('creator_id', Auth::id())->where('status', '!=', '紀錄')->where('name', 'like', '%' . $search . '%')->orderBy('date', 'desc')->paginate(10);
            $appendData = $products->appends(array(
                'search' => $search,
            ));
        } else {
            $products = Product::where('creator_id', Auth::id())->where('status', '!=', '紀錄')->orderBy('date', 'desc')->paginate(10);
        }
        return view('product.management', compact('products'));
    }

    public function show_record($id)
    {
        $product = Product::where('id', $id)->first();
        if (!$product) {
            abort('404');
        }
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }
    public function store_review(Request $request)
    {
        $rules = [
            'content' => 'required|string|max:400',
        ];
        $messages = [
        ];
        request()->validate($rules, $messages);
        $review             = new Review;
        $review->product_id = $request->id;
        $review->date       = date('Y/m/d H:i:s');
        $review->content    = $request->content;
        $review->member_id  = Auth::id();
        $review->save();
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductPost $request)
    {
        $check = Creator::where('id', Auth::id())->first();
        if ($check['status'] != "T") {
            return redirect()->route('error')->with('find', '創作者權限已鎖定，請洽管理員!!');
        }
        $maxid = Product::max('id');
        if ($maxid == 1) {
            $newid = 1;
        } else {
            $newid = substr($maxid, 0, -4) + 1; //ID
        }
        $newid = $newid . "0000";
        $this->save($request, $newid);
        return redirect()->route('management.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $s       = substr($id, 0, -4);
        $product = Product::where([['id', 'like', $s . '____'], ['display', 'T']])->orderBy('date', 'desc')->first();
        $reviews = Review::where('product_id', $id)->orderBy('date', 'desc')->paginate(3);
        $order   = Order::where('product_id', $id)->count();
        if (!$product) {
            abort('404');
        }
        return view('product.show', compact('product', 'reviews', 'order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('product.create', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductPost $request, $id)
    {
        $check = Creator::where('id', Auth::id())->first();
        if ($check['status'] != "T") {
            return redirect()->route('error')->with('find', '創作者權限已鎖定，請洽管理員!!');
        }
        $product_ch = Product::find($id);
        if ($product_ch->creator_id != Auth::id()) {
            return redirect()->route('product.create');
        }
        $s          = substr($id, 0, -4);
        $product_ch = Product::where([['id', 'like', $s . '____'], ['status', '申請中']])->first();
        if ($product_ch) {
            return redirect()->route('error')->with('find', '作品已提出申請修改，請待審核完畢後再次提出修改!!');
        }
        $newid = Product::where('id', 'like', $s . '____')->max('id') + 1;
        $this->save($request, $newid);

        return redirect()->route('management.index');
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

    public function save($request, $id)
    {
        if (substr($id, -4) == "9999") {
            $s = substr($id, 0, -4);
            $product_old = Product::where([['id', 'like', $s . '____'], ['status', '已通過']])->first();
            if (!$product_old) {
                $old         = $id - 1;
                $product_old = Product::where('id', $old)->first();
            } else {
                $old = $product_old->id;
            }
            $product_images = Product_image::where('product_id', $old)->get();
            $maxid = Product::max('id');
            if ($maxid == 1) {
                $newid = 1;
            } else {
                $newid = substr($maxid, 0, -4) + 1;
            }
            $newid = $newid . "0000";
            $product = new Product;
            $product->id =  $newid;
            $product->name       = $product_old->name;
            $product->type_id    = $product_old->type_id;
            $product->summary    = $product_old->summary;
            $product->price      = $product_old->price;
            $product->rating     = $product_old->rating;
            $product->date       = $product_old->date;
            $product->video       = $product_old->video;
            $product->file       = $product_old->file;
            $product->display    = $product_old->display;
            $product->status     = $product_old->status;
            $product->description     = $product_old->description;
            $product->check_date = $product_old->check_date;
            $product->creator_id = $product_old->creator_id;
            $product->admins_id     = $product_old->admins_id;
            $product->save();

            $product_old->display="F";
            $product_old->status="紀錄";
            $product_old->save();

            $product = Review::where('product_id', 'like', $s . '____')->update(['product_id' => $newid]);
            $product = Order::where('product_id', 'like', $s . '____')->update(['product_id' => $newid]);
            $product = Collect::where('product_id', 'like', $s . '____')->update(['product_id' => $newid]);
            $id=$newid+1;
            foreach ($product_images as $i => $img) {
                $product_img             = new Product_image;
                $product_img->product_id = $newid;
                $product_img->image      = $img->image;
                $product_img->save();
            }
        }

        $product = new Product;
        if ($request->hasFile('video')) {
            if ($request->file('video')->isValid()) {
                $destinationPath = base_path() . '/public/videos';
                $extension       = $request->file('video')->getClientOriginalExtension();
                $fileName        = date('U') . "." . $extension;
                $request->file('video')->move($destinationPath, $fileName);
                $product->video = "videos/" . $fileName;
            }
        }
        if ($request->hasFile('file')) {
            if ($request->file('file')->isValid()) {
                $destinationPath = base_path() . '/public/file';
                $extension       = $request->file('file')->getClientOriginalExtension();
                $fileName        = date('U') . "." . $extension;
                $request->file('file')->move($destinationPath, $fileName);
                $product->file = "file/" . $fileName;
            }
        }
        $product->id         = $id;
        $product->name       = $request->name;
        $product->type_id    = $request->type;
        $product->summary    = $request->summary;
        $product->price      = $request->price;
        $product->rating     = $request->rating;
        $product->date       = date('Y/m/d H:i:s');
        $product->display    = "F";
        $product->status     = "申請中";
        $product->creator_id = Auth::id();
        $product->save();
        $imgs            = array();
        $destinationPath = base_path() . '/public/image/product';
        if ($request->hasFile('img0')) {
            array_push($imgs, $request->img0);
        }
        if ($request->hasFile('img1')) {
            array_push($imgs, $request->img1);
        }
        if ($request->hasFile('img2')) {
            array_push($imgs, $request->img2);
        }
        if ($request->hasFile('img3')) {
            array_push($imgs, $request->img3);
        }
        if ($request->hasFile('img4')) {
            array_push($imgs, $request->img4);
        }
        foreach ($imgs as $i => $img) {
            $product_img = new Product_image;
            $extension   = $img->getClientOriginalExtension();
            $fileName    = date('U') . "_" . $i . "." . $extension;
            $img->move($destinationPath, $fileName);
            $product_img->product_id = $id;
            $product_img->image      = "image/product/" . $fileName;
            $product_img->save();
        }
    }
    public function download($download)
    {
        $product = Product::where('id', $download)->orderBy('date', 'desc')->first();
        if (!$product) {
            abort(404);
        }
        if($product->member==Auth::id()){
            return response()->download($product->file, $product->name.'.exe');
        }else{
            $check = Order::where('product_id', $download)->first();
            if (!$check) {
                abort(404);
            }
        }
        return response()->download($product->file, $product->name.'.exe');
    }
}
