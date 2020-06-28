<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;
class CommentsController extends Controller
{
    //
    public function __construct()
    {
        // for exceptions add after 'auth' ,['except'=>['methodName1','methodName2']]
        $this->middleware('auth',['except'=>['list']]);
    }
    public function create($id){
        return view('comments.create')->with('user_id',$id);
    }

    public function store(Request $request,$id){
        $customMessages = [
            'inputComment.required'  => 'Komentar je obavezan!'
          ];

       $this->validate($request,[
            'inputComment' => 'required',
            'gridRadios' => 'required'
       ],$customMessages);

        $comment = new Comment;
        $comment->author_name = auth()->user()->name;
        $comment->author_id =  auth()->user()->id;
        $comment->author_image = auth()->user()->image_link;
        $comment->comment = $request->inputComment;
        $comment->grade = $request->gridRadios;
        $comment->belongs_to = $id;
        $comment->save();
            
        return redirect('/user/'.$id)->with('success','Komentar poslan.');
    }
    public function destroy($belongs_id,$comment_id){
        $comment = Comment::find($comment_id);
        if(auth()->user()->id != $comment->author_id && auth()->user()->user_type != 'admin'){
            return redirect('products')->with('error','Nedozvoljena radnja!');
        }
        $comment->delete();
        return redirect('/user/'.$comment->belongs_to)->with('success','Komentar obrisan.');
    }
    public function report($user_id,$comment_id){
        $comment = Comment::find($comment_id);
        $comment->is_reported = "Y";
        $comment->save();
        return redirect('/user/'.$user_id)->with('success','Komentar prijavljen!');
    }

    public function getReported(){
        $comments = Comment::where('is_reported','Y')->orderBy('created_at','desc')->get();
        return view('comments.reported')->with('comments',$comments);
    }
    public function removeReport($id){
        if(auth()->user()->user_type == "admin"){
            $comment = Comment::find($id);
            $comment->is_reported = "N";
            $comment->save();
            return redirect('/user/'.$comment->belongs_to)->with('success','Prijava na komentaru id:'.$comment->id.' uklonjena!');
        }
        else{
            return redirect('/')->with('error','Nedozvoljena radnja.');
        }
    }
    public function list(){
        $comments = Comment::orderBy('created_at','desc')->get();
        return ($comments); 
    }
}
