<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;


class MessageController extends Controller
{

    //
    public function newMessage(Message $message, Request $request){

        $req=$request->dataReq;

        $validationReq= $request->validate([
            'dataReq.token'=> ['required'],
            'dataReq.name'=> ['required'],
            'dataReq.mail'=> ['required'],
            'dataReq.message'=> ['required']
        ]);


        $splitMail=explode('@', $req['mail']);
        $plitMailPt=explode('.', $splitMail[1]);
        
        
        if($validationReq){

            $splitIdToken=explode('_', $req['token']);
            $idToken=$splitIdToken[0];

            $newMessage= new $message;
        
            $newMessage->token_id=$idToken;
            $newMessage->name=$req['name'];
            $newMessage->mail=$req['mail'];
            $newMessage->message=$req['message'];
            
    
            $newMessage->save();
    

            if(count($splitMail)>=2 && count($plitMailPt)>=2){
                $res['status']=true;
                $res['msg_env']=true;
                $res['mail']=true;
            }else{
                $res['status']=true;
                $res['msg_env']=true;
                $res['mail']=false;
            }

        }else{
            $res['status']=true;
            $res['msg_env']=false;
        }

        return $res;


    }
    
}
