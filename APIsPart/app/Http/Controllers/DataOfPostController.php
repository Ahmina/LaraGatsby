<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataOfPost;

class DataOfPostController extends Controller
{
    function new($count, $id, $dataOfPostModel){

        $n=$count;
        while($n<$id){
            $new = new $dataOfPostModel;
            $new->read_time=1;

            $new->save();
            
            $n++;
        }

    }
}
