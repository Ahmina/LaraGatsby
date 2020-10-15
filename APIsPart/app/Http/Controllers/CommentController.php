<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;


class CommentController extends Controller
{

    //get/fetch all undeleted comments (clean=1) of a post by id of post (id  =~ post_id)
    public function getCommentsByPodtId($id, Comment $comment){

        $comments=$comment::where(['post_id'=> $id, 'clean'=> 1])->orderBy('comment_on')->get(['id', 'comment_id', 'comment_on', 'token_id', 'name', 'comment', 'modified', 'updated_at']);
        return $comments;

    }

}
