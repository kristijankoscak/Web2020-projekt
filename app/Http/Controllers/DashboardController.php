<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Product;
use App\User;
use App\Product;
use App\Comment;


class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        if($user->user_type === "buyer" || $user->user_type === "admin"){
            return redirect('/products')->with('error','Niste registrirani kao prodavač.');
        }
        else{
            return view('dashboard')->with('products',$user->products);
        }
        
    }
    public function reportedComments(){
        if(auth()->user()->user_type == "admin"){
            $comments = Comment::where('is_reported','Y')->orderBy('created_at','desc')->get();
            return view('comments.reported')->with('comments',$comments);
        }
        else{
            return redirect('/')->with('error','Nemate pravo pristupa.');
        }
    }
    public function reportedProducts(){
        if(auth()->user()->user_type == "admin"){
            $products = Product::where('is_reported','Y')->orderBy('created_at','desc')->get();
            return view('products.reported')->with('products',$products);
        }
        else{
            return redirect('/')->with('error','Nemate pravo pristupa.');
        }
    }
}
