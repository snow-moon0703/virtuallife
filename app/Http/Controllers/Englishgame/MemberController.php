<?php

namespace App\Http\Controllers\Englishgame;

use App\Http\Controllers\Controller;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (isset($user)) {
            if (Hash::check($request->password, $user->password)) {
                $vr = DB::connection('mysql2')->select('select * from member where m_id = ? ', [$user->id]);
                if ($vr) {
                } else {
                    $vr = DB::connection('mysql2')->insert('insert into  member(m_id, m_priority) values (?, ?)', [$user->id, 'Student']);
                }
                return $user->id;
            } else {
                return "0";
            }
        } else {
            return "00";
        }
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

    public function store_LevelRecord(Request $request)
    {
        if ($request->l_level == null || $request->l_time == null || $request->l_topic == null || $request->l_error == null) {
            return 00;
        }

        $vr = DB::connection('mysql2')->insert('insert into  LevelRecord(l_level,l_time,l_topic,l_error) values (?, ?,?,?)', [$request->l_level, $request->l_time, $request->l_topic, $request->l_error]);
        if ($vr) {
            $vr = DB::connection('mysql2')->select('select max(l_id) as l_id from LevelRecord where l_level = ? AND l_time= ? AND l_topic =? AND l_error = ?', [$request->l_level, $request->l_time, $request->l_topic, $request->l_error]);
            foreach ($vr as $user) {
                return $user->l_id;
            }
        } else {
            return 00;
        }
        //return response()->json($vr);
    }

    public function store_ErrorRecord(Request $request)
    {
        if ($request->l_id == null || $request->w_id == null) {
            return 0;
        }
        $vr = DB::connection('mysql2')->insert('insert into ErrorRecord(l_id,w_id) values (?, ?)', [$request->l_id, $request->w_id]);
        if ($vr) {
            return 1;
        } else {
            return 0;
        }
    }
    public function store_PlayRecord(Request $request)
    {
        try {
            if ($request->c_id == null || $request->s_id == null || $request->lv1_id == null || $request->lv2_id == null || $request->lv3_id == null || $request->p_topic == null || $request->p_error == null || $request->p_probability == null) {
                return 0;
            }
            $vr = DB::connection('mysql2')->insert('insert into  PlayRecord(c_id,s_id,lv1_id,lv2_id,lv3_id,p_topic,p_error,p_probability) values (?, ?,?,?,?,?,?,?)', [$request->c_id, $request->s_id, $request->lv1_id, $request->lv2_id, $request->lv3_id, $request->p_topic, $request->p_error, $request->p_probability]);
            return 1;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function store_CourseStudent(Request $request)
    {
        if ($request->m_id == null) {
            return 0;
        }
        $vr = DB::connection('mysql2')->select('select * from CourseStudent where c_id = ? AND s_id= ?', [1, $request->m_id]);
        if ($vr == null) {
            $vr = DB::connection('mysql2')->insert('insert into CourseStudent(c_id,s_id) values (?, ?)', [1, $request->m_id]);
            if ($vr) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }

        //return 1;
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

    public function show_coursestudent(Request $request)
    {
        //echo $request->m_id;
        $vr  = DB::connection('mysql2')->select('select c_id from member as m join coursestudent as cs on (cs.s_id=m.m_id) where m.m_id = ?', [$request->m_id]);
        $str = "";
        foreach ($vr as $i => $user) {
            if ($i == 0) {
                $str = $user->c_id;
            } else {
                $str .= "," . $user->c_id;
            }
        }
        return $str;
        //return response()->json($vr);
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
