<?php

namespace App;

use App\Creator;
use Auth;
use DB;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    public $table = "member";
    use Notifiable;
    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     * 获取将存储在JWT的中的标识符token。
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     * 返回一个键值数组，其中包含要添加到JWT中的任何自定义声明
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'birthday', 'gender', 'country_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function creator()
    {
        $id = $this->hasOne('App\Creator', 'id');
        if ($id) {
            return $this->hasOne('App\Creator', 'id');
        }
        return "";
    }

    public function creator_name()
    {
        $name = Creator::where('id', Auth::id())->value('name');
        if ($name) {
            return __('Creator');
        }
        return __('Member');
    }

    public function creator_null()
    {
        $bo = Creator::where('id', Auth::id())->first();
        if ($bo) {
            return true;
        }
        return false;
    }

    public function creator_id()
    {
        $id = Creator::where('id', Auth::id())->value('id');
        if ($id) {
            return $id;
        }
        return 0;
    }

    public function country()
    {
        return $this->hasOne('App\Country', 'id', 'country_id');
    }

    public function englishVR()
    {
        $vr = DB::connection('mysql2')->select('select * from member where m_id = ? ', [Auth::id()]);
        foreach ($vr as $i => $user) {
            return $user->m_priority;
        }

    }
}
