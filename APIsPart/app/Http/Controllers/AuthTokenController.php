<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\AuthToken;
use Illuminate\Http\Request;

class AuthTokenController extends Controller
{

    function createToken(AuthToken $authModel, Str $str, Request $request){
    
        $ip=($request->ip())?$request->ip():"0";
        
        $rndStr=$str::random(22);
        $id=$authModel::count()+1;

        $newToken = new $authModel;

        $newToken->ncs=0;
        $newToken->today_ncs=0;
        $newToken->n_commit=0;
        $newToken->last_ddc=date("Y-m-d 00:00");
        $newToken->last_time_read=time();
        $newToken->read_u_time=0;
        $newToken->token=$id.'_'.$rndStr;
        $newToken->ip=$ip;

        $newToken->save();

        $res['id']=$id;
        $res['status']=true;
        $res['token']=$newToken->token;

        return $res;        

    }
}
