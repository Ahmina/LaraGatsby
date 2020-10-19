<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\AuthToken;
use App\HistoryOfChange;
use App\DataOfPost;
use App\Http\Controllers\DataOfPostController;

class CommentController extends Controller
{
    // function to verify (all req) the token..
    public function verifyToken($tokenModel, $token, $type)
    {
    
        $token_id=explode("_", $token);
        $id=$token_id[0];
        
        if($id>0){
            $verifyToken=$tokenModel::find($id);
    
            if($verifyToken){
                if($verifyToken->token==$token){
                    $res['status']=true;
                    $res['read']=false;
                    if($type=='read'){
                        $timeNow=time();
                        if($verifyToken->last_time_read+25<$timeNow){
                            $verifyToken->last_time_read=$timeNow;
                            $verifyToken->read_u_time=$verifyToken->read_u_time+1;
                            $res['read']=true;                    
                        }

                    }else if($type=='new'){
                        $dateNow=date("Y-m-d 00:00:00");
                        if($dateNow==$verifyToken->last_ddc){
                            $verifyToken->today_ncs=$verifyToken->today_ncs+1;
                            $verifyToken->ncs=$verifyToken->ncs+1;
                        }else{
                            $verifyToken->today_ncs=1;
                            $verifyToken->ncs=$verifyToken->ncs+1;
                            $verifyToken->last_ddc=$dateNow;
                        }

                    }else if($type!="noread"){
                        $verifyToken->n_commit=$verifyToken->n_commit+1;
                    }

                    $verifyToken->save();


                    $res['status']=true;

                }else{
                    $res['status']=false;
                    return false;

                }
            }

        }else{
            $res['status']=false;
        }

        return $res;
    
    }

    
    //get/fetch all undeleted comments (clean=1) of a post by id of post (id  =~ post_id)
    public function getCommentsByPodtId($id, Comment $comment){

        $comments=$comment::where(['post_id'=> $id, 'clean'=> 1])->orderBy('comment_on')->get(['id', 'comment_id', 'comment_on', 'token_id', 'name', 'comment', 'modified', 'updated_at']);
        return $comments;

    }

    //

    public function getNewAndUpdateComments($id, Request $request, AuthToken $authToken, Comment $comment, DataOfPostController $dataOfPostController){
        $req=$request->dataReq;
        $type=($req['read']==true)?'read':'noread';
        $verifyToken=$this->verifyToken($authToken, $req['token'], $type);
        
        if($verifyToken['status']){

            if($verifyToken['read']){
                $count=DataOfPost::count();
                if($id<=$count){
                    $readTime=DataOfPost::find($id);
                    $readTime->read_time+=1;
                    $readTime->save();
                }else{
                    $dataOfPostController->new($count, $id, DataOfPost::class);
                }
            }

            $commentsCount=$comment::where(['post_id'=> $id, 'clean'=> 1])->count();

            $updatedNewComments=$comment::where([['post_id', $id], ['clean', 1], ['updated_at', '>' , $req['last_updated']]])->get(['id', 'comment_id', 'comment_on', 'token_id', 'name', 'comment', 'modified', 'updated_at']);
            

            $res['status']=true;
            $res['count_comments']=$commentsCount;
            $res['updated_new_comments']=$updatedNewComments;

            return $res;
        }

    }

    //
    public function newComment(Comment $comment, AuthToken $authToken, Request $request, DataOfPostController $dataOfPostController){
        $req=$request['dataReq'];

        $validationReq= $request->validate([
            'dataReq.token'=> ['required'],
            'dataReq.post_id'=> ['required'],
            'dataReq.name'=> ['required'],
            'dataReq.mail'=> ['required'],
            'dataReq.comment'=> ['required', 'max:500']
        ]);

        if($validationReq){

            $verifyToken=$this->verifyToken($authToken, $req['token'], 'new');
            if($verifyToken['status']){

                $post_id=$req['post_id'];
                $comment_id=$comment::Where('post_id', $post_id)->count()+1;
        
                $commentOnId=$req['comment_on_id'];
                if($commentOnId<=0){
                    $commentOnId=$comment_id;
                }else{
                    $testClean=$comment::where(['post_id'=> $post_id, 'comment_id'=> $commentOnId])->first('clean');
                    if($testClean->clean!=1){
                        $commentOnId=$comment_id;
                    }
                }

                $token_id=explode("_", $req['token']);
        
                $newComment= new $comment;
                $newComment->post_id=$post_id;
                $newComment->comment_id=$comment_id;
                $newComment->comment_on=$commentOnId;
                $newComment->token_id=+$token_id[0];
                $newComment->name=$req['name'];
                $newComment->mail=$req['mail'];
                $newComment->comment=$req['comment'];
                $newComment->modified=false;
                $newComment->clean=true;
                $newComment->save();
                

                
                //this method is not the fastest but it is the easiest.
                $data=$this->getNewAndUpdateComments($req['post_id'], $request, $authToken, $comment, $dataOfPostController);
                $res['data']=$data['updated_new_comments'];


                $splitMail=explode('@', $req['mail']);
                
                if(count($splitMail)>=2){
                    $plitMailPt=explode('.', $splitMail[1]);
                }else{
                    $plitMailPt='';
                }
                
                if(count($splitMail)>=2 && count($plitMailPt)>=2){
                    $res['status']=true;
                    $res['comment_env']=true;
                    $res['mail']=true;
                }else{
                    $res['status']=true;
                    $res['comment_env']=true;
                    $res['mail']=false;
                }
            }else{
                //The token is wrong
                $res['status']=false;
                $res['token_error']=true;
            }
        }else{
            $res['status']=true;
            $res['msg_env']=false;
        }


        return $res;


    }

    public function editComment(Comment $editComment, AuthToken $authToken, Request $request, HistoryOfChange $historyOfChangeModel)
    {

        $req=$request->dataReq;

        $validationReq= $request->validate([
            'dataReq.token'=> ['required'],
            'dataReq.general_id_of_comment'=> ['required'],
            'dataReq.comment'=> ['required', 'max:500']
        ]);
        

        if($validationReq){
            $verifyToken=$this->verifyToken($authToken, $req['token'], 'edit');
            if($verifyToken['status']){
                $token_id=explode("_", $req['token']);
                $edit= $editComment::where('id', $req['general_id_of_comment'])->first(['id', 'comment_id', 'comment_on', 'token_id', 'name', 'comment', 'modified', 'updated_at']);
                //already checks in the construction the existence of (all)token
                if($edit->token_id==$token_id[0]){
                    $oldTextCommentModel= new $historyOfChangeModel;
                    
                    $oldTextCommentModel->general_id=$edit->id;
                    $oldTextCommentModel->token_id=$edit->token_id;
                    $oldTextCommentModel->old_comment=$edit->comment;
                    $oldTextCommentModel->date=$edit->updated_at;
                    
                    
                    $oldTextCommentModel->save();

                    $edit->modified=true;
                    $edit->comment=$req['comment'];
                    $edit->save();

                    $res['status']=true;
                    $res['comment_edit']=true;
                    $res['data'][0]=$edit;


                }else{
                    $res['status']=true;
                    $res['comment_edit']=false;
                }
            }else{
                //The token is wrong
                $res['status']=false;
                $res['token_error']=true;

            }

        }else{
            $res['status']=true;
            $res['comment_edit']=false;
        }

        return $res;
    }

    public function deleteComment(Comment $comment, AuthToken $tokenModel, Request $request){

        $req=$request->dataReq;
        
        $validationReq= $request->validate([
            'dataReq.token'=> ['required'],
            'dataReq.general_id_of_comment'=> ['required'] // general id (~=id)
        ]);

        if($validationReq){

            $token=$req['token'];
            $verifyToken=$this->verifyToken($tokenModel, $token, 'delete');
            if($verifyToken['status']){

                $token_id=explode("_", $token);
                $id=$token_id[0];

                $idComment=$req['general_id_of_comment'];
                $commentShearch=$comment::where('id', $idComment)->first(['id', 'post_id', 'comment_id', 'comment_on', 'token_id']);
                if($commentShearch){

                    if($commentShearch->token_id==$id){
                        $res['status']=true;
                        $res['status_delete']=true;

                        if($commentShearch->comment_id==$commentShearch->comment_on){
                            $commnetDelete=$comment::where(['post_id'=> $commentShearch->post_id, 'comment_on'=>$commentShearch->comment_on, 'clean'=> 1]);
                            $res['comments_delete']=$commnetDelete->get('id');
                            $commnetDelete->update(['clean'=> 0]);
                        }else{
                            $commnetDelete=$comment::where(['post_id'=> $commentShearch->post_id, 'comment_id'=>$commentShearch->comment_id, 'clean'=> 1]);
                            $res['comments_delete']=$commnetDelete->get('id');
                            $commnetDelete->update(['clean'=> 0]);
                        }
                        


                    }else{
                        $res['status']=false;
                    }

                }


            }else{
                $res['status']=false;
                $res['token_error']=true;
            }


        }

        return $res;
    }

}
