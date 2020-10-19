<?php

namespace App\Http\Controllers;

use App\HistoryOfChange;
use App\Comment;

class HistoryOfChangeController extends Controller
{
    public function getAllList($generalId, HistoryOfChange $historyOfChangeModel)
    {



        $list=$historyOfChangeModel::where('general_id', $generalId);

        if($list->count()>0){
            $all=$list->get(['old_comment', 'updated_at']);
            $old=$list->first()->comment;
            
            if($old->clean){

                $res['status']=true;
                $res['delete']=false;
                $res['last_comment']=['name'=> $old->name, 'comment'=> $old->comment, 'date'=> $old->updated_at];
                $res['list_history_comments']=$all;
    
            }else{
                $res['status']=true;
                $res['delete']=true;

            }

        }else{
            $res['status']=false;
        }


        return $res;


    }
}