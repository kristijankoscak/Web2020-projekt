<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Product;
use App\User;

class ProductsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show','list','filterList']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        if($request->selectProductType === null){
            $products = Product::orderBy('created_at','desc')->paginate(9);
            return view('products.index')->with('products',$products);
        }
        if($request->selectProductType !== null){
            $userProducts = null;
            if($request->zupanija === "Odaberite županiju"){
                $userProducts = Product::where('type',$request->selectProductType)->paginate(9);
            }
            if($request->selectProductType === "Odaberite vrstu"){
                $userProducts = Product::where('county',$request->zupanija)->paginate(9);
            }
            if($request->selectProductType !== "Odaberite vrstu" && $request->zupanija !== "Odaberite županiju"){
                $userProducts = Product::where('county',$request->zupanija)->where('type',$request->selectProductType)->paginate(9);
            }
            return view('products.index')->with('products',$userProducts);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->user_type === "seller"){
            return view('products.create');
        }
        else {
            return redirect('/')->with('error','Niste registrirani kao prodavač!'); 
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customMessages = [
            'inputPrice.required'  => 'Cijena je obavezna!',
            'inputDetailType.required' => 'Tip proizvoda je obavezan!',
            'inputLocation.required' => 'Lokacija je obavezna!',
            'inputContact.required' => 'Kontakt je obavezan!',
            'productImage.required' => 'Slika je obavezna!'

          ];
        $this->validate($request,[
            'inputPrice' => 'required',
            'inputDetailType' => 'required',
            'inputLocation' => 'required',
            'inputContact' => 'required',
            'productImage' => 'required|image|max:1999'
        ],$customMessages);

        if($request->hasFile('productImage')){
            $chosenFile = $request->file('productImage')->getClientOriginalName();
            $filename = pathinfo($chosenFile,PATHINFO_FILENAME);
            $extension = $request->file('productImage')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('productImage')->storeAs('public/product_images',$fileNameToStore);
         }
        else{
            $fileNameToStore = 'noimage.jpg';
        }

        $product = new Product;
        $product->type = $request->input('inputType');
        $product->detail_type = $request->input('inputDetailType');
        $product->price = $request->input('inputPrice');
        $product->quantity = $request->input('gridRadios');
        $product->county = $request->input('inputCounty');
        $product->location = $request->input('inputLocation');
        $product->contact = $request->input('inputContact');
        $product->user_id = auth()->user()->id;
        $product->user_opg = auth()->user()->user_opg;
        $product->image_link = $fileNameToStore;
        $product->user = auth()->user()->name;
        $product->save();
            
        return redirect('/products')->with('success','Proizvod dodan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if($product === null){
            return redirect('/products')->with('error','Ne postoji proizvod sa tim ID-om!');
        }
        $user = User::find($product->user_id);
        $userProducts = Product::where('user_id',$product->user_id)->orderBy('created_at','desc')->get();
        $data = array(
            'product' => $product, 'userProducts' => $userProducts, 'user' => $user
        );
        return view('products.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        if($product === null){
            return redirect('products')->with('error','Ne postoji takav proizvod.');
        }
        if(auth()->user()->id !== $product->user_id){
            return redirect('products')->with('error','Ne možete uređivati tuđe proizvode!');
        }
        return view('products.edit')->with('product',$product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customMessages = [
            'inputPrice.required'  => 'Cijena je obavezna!',
            'inputDetailType.required' => 'Tip proizvoda je obavezan!',
            'inputLocation.required' => 'Lokacija je obavezna!',
            'inputContact.required' => 'Kontakt je obavezan!'

          ];
        $this->validate($request,[
            'inputPrice' => 'required',
            'inputDetailType' => 'required',
            'inputLocation' => 'required',
            'inputContact' => 'required',
        ],$customMessages);

        if($request->hasFile('productImage')){
            $chosenFile = $request->file('productImage')->getClientOriginalName();
            $filename = pathinfo($chosenFile,PATHINFO_FILENAME);
            $extension = $request->file('productImage')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('productImage')->storeAs('public/product_images',$fileNameToStore);
        }

        $product =Product::find($id);
        $product->type = $request->input('inputType');
        $product->detail_type = $request->input('inputDetailType');
        $product->price = $request->input('inputPrice');
        $product->quantity = $request->input('gridRadios');
        $product->county = $request->input('inputCounty');
        $product->location = $request->input('inputLocation');
        $product->contact = $request->input('inputContact');
        if($request->hasFile('productImage')){
            Storage::delete('/public/product_images/'.$product->image_link);
            $product->image_link = $fileNameToStore;
        }
        $product->save();
            
        return redirect('/dashboard')->with('success','Proizvod izmjenjen.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if((auth()->user()->id !== $product->user_id) && (auth()->user()->user_type !== 'admin')){
            return redirect('products')->with('error','Nedozvoljena radnja!');
        }
        if($product->image_link != 'noimage.jpg'){
            Storage::delete('/public/product_images/'.$product->image_link);
        }
        $product->delete();
        return redirect('/products')->with('success','Proizvod obrisan.');
    }
    public function list(){
        $products = Product::orderBy('created_at','desc')->get();
        return ($products); 
    }
    public function filterList($county,$type){
        $products = Product::where('county',$county)->where('type',$type)->orderBy('created_at','desc')->get();
        return ($products); 
    }

    public function report($id){
        $product = Product::find($id);
        $product->is_reported = "Y";
        $product->save();
        return redirect('/products/'.$id)->with('success','Proizvod prijavljen!');
    }
    public function removeReport($id){
        if(auth()->user()->user_type == "admin"){
            $product = Product::find($id);
            $product->is_reported = "N";
            $product->save();
            return redirect('/products/'.$id)->with('success','Prijava na proizvodu id:'.$product->id.' uklonjena!');
        }
        else{
            return redirect('/')->with('error','Nedozvoljena radnja.');
        }
        
    }
}
