<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\CrawlUser;
use App\AuthToken;
use App\Http\Controllers\AuthTokenController;

class CrawlUserController extends Controller
{
    function newCrawl(Request $request, CrawlUser $crawlModel, AuthToken $authModel, AuthTokenController $authController, Str $str){
        
        $req=$request->dataReq;
        $token_status=false;

        $token=(isset($req['token']))?$req['token']:'';

        $splitIdToken=explode('_', $token);
        $idToken=$splitIdToken[0];
        
        $verifyToken=$authModel::where('id', $idToken)->first();
        if($verifyToken){
            if($verifyToken->token==$token){
                $id=$idToken;
                $token_status=true;
            }
        }


        if($token_status==false){
            $new=$authController->createToken($authModel, $str, $request);
            $id=$new['id'];
            $token=$new['token'];

            $splitIdToken2=explode('_', $token);
            $idToken=$splitIdToken2[0];
            
        }
        
        $id=(isset($id))?$id:0;

        $post_id=(isset($req['post_id']))?$req['post_id']:0;
        $page_name=(isset($req['page_name']))?$req['page_name']:'Unknown';
        
        $newCrawl=new $crawlModel;
        $newCrawl->user_id=$idToken;
        $newCrawl->post_id=$post_id;
        $newCrawl->page_name=$page_name;

        $newCrawl->save();


        $res['token']=$token;
        return $res;

    }
}
