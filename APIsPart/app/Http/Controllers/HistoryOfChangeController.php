<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryOfChangeController extends Controller
{
    public function getAllList()
    {
        $res['status']=true;

        $fakeData=[];
        $fakeData[0]=["name"=> 'Merro', "date"=> 'يوم كذا كذا كذا', "comment"=> 'هذا مثال فقط'];
        $fakeData[1]=["name"=> 'Merro', "date"=> 'يوم كذا كذا كذا', "comment"=> 'هذا مثال فقط'];

        $res['list_history_comments']=$fakeData;
        
        return $res;
    }
}
