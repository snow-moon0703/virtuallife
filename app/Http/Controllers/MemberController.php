<?php

namespace App\Http\Controllers;

use App\Creator;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $creator             = Creator::find(Auth::id());
        $creator->name    = $request->c_name;
        $creator->code    = $request->code;
        $creator->account = $request->account;
        $creator->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = User::where('id', Auth::id())->first();
        return view('auth.show', compact('user'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = User::where('id', Auth::id())->first();
        return view('auth.register', compact('user'));

    }

    public function edit_pass()
    {
        return view('auth.create_pass');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = [
            'name'    => 'required|string|max:255',
            'country' => 'required',
        ];
        $messages = [
        ];
        request()->validate($rules, $messages);

        $id               = Auth::id();
        $user             = User::find($id);
        $user->name       = $request->name;
        $user->country_id = $request->country;
        $user->save();
        if ($request->code) {
            $rules = [
                'c_name'  => 'required|string|min:1|max:15',
                'code'    => 'required|numeric|max:13',
                'account' => 'required|numeric|min:6',
            ];
            $messages = [
            ];

            request()->validate($rules, $messages);

            $creator             = Creator::find($id);
            $creator->name    = $request->c_name;
            $creator->code    = $request->code;
            $creator->account = $request->account;
            $creator->save();
        }
        return redirect()->route('member.show', $id);
    }

    public function update_pass(Request $request)
    {
        $id = Auth::id();
        if (Auth::attempt(['id' => $id, 'password' => $request->password_old])) {
            $user           = User::find($id);
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->route('member.show', $id);
        } else {
            return redirect()->back();
        }
        return redirect()->route('index');
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
