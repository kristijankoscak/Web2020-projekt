<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;
use App\Comment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected function redirectUser(String $messageType, String $message){
        if(auth()->user()->user_type === "seller"){
            return redirect('/dashboard')->with($messageType,$message); 
        }
        else{
            return redirect('/products')->with($messageType,$message); 
        }
    }

    public function __construct()
    {
        $this->middleware('auth',['except'=>['show']]);
    }
    //
    public function show($id){
        //
        
        $user = User::find($id);
        if($user === null){
            return redirect('/')->with('error','Ne postoji taj korisnik.'); 
        }
        if($user->user_type === "seller"){
            $userProducts = Product::where('user_id',$id)->get();
            $userComments = Comment::where('belongs_to',$id)->orderBy('created_at','desc')->get();
            $average = 0;
            if(count($userComments)>0){
                $count = 0;
                foreach($userComments as $comment){
                    $count += $comment->grade;
                }
                $average = round( ($count / count($userComments)),2);
            }
            $data = array(
                'user' => $user, 'userProducts' => $userProducts,'userComments' => $userComments,'average'=>$average
            );
            return view('user.show')->with($data);
        }
        else{
            return redirect('/products')->with('error','Ne postoji taj prodavač ili korisnik nije prodavač!');
        }
        

    }
    public function passwordChange($id){
        $user = User::find($id);

            if(auth()->user()->id !== $user->id){
                return redirect('/products')->with('error','Nedozvoljena radnja!');
            }
            return view('user.password-change')->with('user',$user);

    }
    public function edit($id){
        //
        $user = User::find($id);

            if(auth()->user()->id !== $user->id){
                return redirect('/products')->with('error','Nedozvoljena radnja!');
            }
            
            return view('user.edit')->with('user',$user);
    }
    public function destroy($id)
    {
        $user =User::find($id);
        if(auth()->user()->id !== $user->id){
            return redirect('products')->with('error','Nedozvoljena radnja!');
        }
        if($user->user_type === "seller"){
            $products = Product::where('user_id',$id)->get();
            if(count($products)>0){
                foreach($products as $product){
                    Storage::delete('/public/product_images/'.$product->image_link);
                    $product->delete();
                }   
            }
        }
        $comments = Comment::where('author_id',$id)->get();
        if(count($comments)>0){
            foreach($comments as $comment){
                $comment->delete();
            } 
        }
        Storage::delete('/public/user_images/'.$user->image_link);
        $user->delete();
        return redirect('/');
    }
    public function update(Request $request, $id)
    {
        $customMessages = [
            'name.required'  => 'Ime je obavezno!',
            'email.required' => 'Email je obavezan!',
            'userPlace.required' => 'Lokacija je obavezna!',
            'userOPG.required' => 'Ime OPG-a je obavezno!',
            'userAddress.required' => 'Adresa je obavezna!',
            'contact.required' => 'Kontakt je obavezan!'

          ];
        $user =User::find($id);
        $requirments = [
            'name' => 'required',
            'email' => 'required',
            'userPlace' => 'required',
            'userOPG' => 'required',
            'userAddress' => 'required',
            'contact' => 'required'
        ];
        if($user->user_type === "seller"){
            $requirments = array_merge($requirments,['userOPG'=>'required']);
        }
        if($request->hasFile('userImage')){
            $image_requirment = ['userImage' => 'required|image|max:1999'];
            $requirments = array_merge($requirments,$image_requirment);
        }
       
        $this->validate($request,$requirments,$customMessages);

         if($request->hasFile('userImage')){
            $chosenFile = $request->file('userImage')->getClientOriginalName();
            $filename = pathinfo($chosenFile,PATHINFO_FILENAME);
            $extension = $request->file('userImage')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('userImage')->storeAs('public/user_images',$fileNameToStore);
        }
        
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if($user->user_type === "seller"){
            $user->user_opg = $request->input('userOPG');
        }
        $user->county = $request->input('userCounty');
        $user->city = $request->input('userPlace');
        $user->contact = $request->input('contact');
        $user->address = $request->input('userAddress');
        if($request->hasFile('userImage')){
            Storage::delete('/public/user_images/'.$user->image_link);
            $user->image_link = $fileNameToStore;
        }
        $user->save();
        return $this->redirectUser('success','Račun ažuriran.');
    }

    public function updatePassword(Request $request, $id){
        if($request->password !== $request->password_confirmation || $request->password === null ||  $request->password_confirmation === null){
            $requirments = [
            'password' => 'required|min:8|confirmed',
            'password-confirmation' => 'required'
            ];
            $this->validate($request,$requirments);
        }
        else{
            $user =User::find($id);
            $user->password = Hash::make($request->password);
            $user->save(); 
            return $this->redirectUser('success','Lozinka promijenjena.');
        }
    }
    
}
