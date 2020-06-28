@extends('layouts.app')

@section('content')
    <div class="container pt-5 pb-5" id="productsBlock">
        <div class="row colorGreenDark-op-07 rounded-top">
            {!!Form::open(['action'=>'ProductsController@index','method'=>'GET','class'=>'d-inline-block']) !!}
            <div class="col" id="zupanijaBlok" >
                <div class="form-inline">
                    <label for="zupanija" class="nav-link letterColor h4">Županija: </label>
                    <select class="custom-select w-25" id="zupanija" name="zupanija">
                        <option value="Odaberite županiju" selected>Odaberite županiju</option>
                    </select>
                    <label for="selectProductType" class="nav-link letterColor h4">Vrsta: </label>
                    <select class="custom-select w-25" id="selectProductType" name="selectProductType">
                        <option class="option-item" value="Odaberite vrstu" selected>Odaberite vrstu</option>
                        <option class="option-item" value="Suhomesnati proizvodi">Suhomesnati proizvodi</option>
                        <option class="option-item" value="Voće">Voće</option>
                        <option class="option-item" value="Povrće">Povrće</option>
                    </select> 
                    <button id="buttonFilterSearch" class="btn btn-outline-secondary letterColor ml-2" type="submit">Pretraži</button>   
                </div>     
            </div>
            {!!Form::close() !!}
        </div>
        <div class="row productsBorder" id="allProducts">
                @if(count($products)>0)
                    @foreach($products as $product)
                        <div class="col-lg-4 col-md-6 mt-2 mb-2">
                          <div class="colorGreenDark-op-07 card h-100 align-middle">
                            <div class="container p-0" style="height:152px; width:152px;"> 
                                <img class="rounded mx-auto d-block" src="/Kopg/public/storage/product_images/{{$product->image_link}}" alt="Product image" style="width:100%; height:100%;"> 
                            </div>
                            <div class="card-body textCenter">
                              <h4 class="card-title">
                                <p class="m-0 p-0 letterColor">Vrsta:{{$product->type}}</p>
                                <p class="m-0 p-0 letterColor">Pod vrsta:{{$product->detail_type}}</p>
                              </h4>
                              <h5 class="letterColor">Cijena:{{$product->price}} {{$product->quantity}}</h5>
                              <p class="m-0 p-0 letterColor">Lokacija:{{$product->location}}</p> 
                            </div>
                            <div class="card-footer d-flex justify-content-center">
                                <a href="/Kopg/public/products/{{$product->id}}"><i class="productInfo mt-2 float-left fas fa-info-circle fa-lg" title="Pogledaj proizvod"></i></a>
                                @if(Auth::check())
                                    @if(Auth::user()->id !== $product->user_id)
                                        <a href="/Kopg/public/products/{{$product->id}}/report"><i class="productReport mt-2 ml-2 float-left fa fa-bug fa-lg text-white" title="Prijavi proizvod"></i></a>
                                    @endif
                                @endif
                            </div>
                          </div>
                        </div>
                    @endforeach
                @else
                    <p>Nema proizvoda u bazi podataka.</p>
                @endif
        </div>
            {{-- </div>  --}}
         
        <div class="container d-flex justify-content-center mt-3">
            {{$products->links()}}
        </div>
    </div>
@endsection