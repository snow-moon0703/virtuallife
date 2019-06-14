<?php

namespace App\Http\Controllers;

use App\Collect;
use Auth;
use Illuminate\Http\Request;

class CollectController extends Controller
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
            $collects   = Collect::where('collect.member_id', Auth::id())->where('product.name', 'like', '%' . $search . '%')->join('product', 'collect.product_id', '=', 'product.id')->paginate(8);
            $appendData = $collects->appends(array(
                'search' => $search,
            ));
        } else {
            $collects = Collect::where('member_id', Auth::id())->paginate(8);

        }
        return view('collect.index', compact('collects'));

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
    public function store($id)
    {
        $collect         = new Collect;
        $collect->member_id   = Auth::id();
        $collect->product_id   = $id;
        $collect->date = date('Y/m/d H:i:s');
        $collect->save();
        // return redirect()->route('product.show', $request->id);
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
        $deletedRows = Collect::where([['product_id', $id], ['member_id', Auth::id()]])->delete();
        //return redirect()->route('product.show', $id);

    }
}
