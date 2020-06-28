@extends('layouts.app')

@section('content')

    <div class=" container">
        <div class="row">
            <div class="col-lg-5 col-md-6 mt-2 mb-2">
                <div class="border border-white opacity-0 card h-100 align-middle">
                    <div class="card-body p-0 textCenter">
                        <div class="row p-0 m-0 justify-content-center">
                            <div class="container-flex p-0 m-3" style="height:302px; width:302px;"> 
                                <img class="rounded mx-auto d-block" src="/Kopg/public/storage/product_images/{{$product->image_link}}" alt="Product image" style="width:100%; height:100%;"> 
                            </div>
                        </div>
                        <div class="row p-0 m-0 colorGreenDark-op-07 mainContainerBorders">
                            <div class="col">
                                <div class="container-flex  p-1" style="height:102px; width:102px;">
                                    <img class="rounded mx-auto d-block" src="/Kopg/public/storage/user_images/{{$user->image_link}}" alt="Product image" style="width:100%; height:100%;"> 
                                </div>
                            </div>
                            <div class="col textCenter">
                                <p class="letterColor">Prodavač:<br> <b>{{$product->user}}</b></p>
                                <p class="letterColor">Proizvod:<br> <b>{{$product->detail_type}}</b></p>
                            </div>
                            <div class="col textCenter">
                                <p class="letterColor">Cijena:<br> <b>{{$product->price}} {{$product->quantity}}</b></p>
                                <p class="letterColor">Lokacija:<br> <b>{{$product->location}}</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer colorGreenDark-op-07 p-0 m-0">
                        <div class="row align-middle">
                            <div class="col textCenter">
                                <a class="letterColor" href="/Kopg/public/user/{{$product->user_id}}">Pogledaj profil</a><br>
                                @if(Auth::check())
                                    @if(Auth::user()->id !== $product->user_id)
                                        <a class="letterColor" href="/Kopg/public/products/{{$product->id}}/report">Prijavi proizvod</a>
                                    @endif
                                @endif
                            </div>
                            <div class="col textCenter">
                                <p class="letterColor">Adresa:<br> <b>{{$user->address}}</b></p>
                            </div>
                            <div class="col textCenter">
                                <p class="letterColor">Kontakt:<br> <b>{{$product->contact}}</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="col-lg-6 col-md-6 mt-2 mb-2">
                <div class="container ml-2 mr-2">
                    <div class="container colorGreenDark-op-07 d-flex justify-content-center rounded-top">
                        <p class="h3 textCenter letterColor">Svi proizvodi ovog prodavača:</p>
                    </div>
                    <div class="container border border-white overflow-auto" style="height:352px"> {{-- 7 products --}}
                        @if(count($userProducts)>0)
                            @foreach($userProducts as $product)
                                
                                <div class="row p-0 ml-1 mr-1 justify-content-center border-bottom border-white mb-1">
                                    <div class="col-2 p-0 m-0">
                                        <div class="container-flex" style="height:52px; width:52px;">
                                            <img class="rounded d-block" src="/Kopg/public/storage/product_images/{{$product->image_link}}" alt="Product image" style="width:100%; height:100%;"> 
                                        </div>
                                    </div>
                                    <div class="col-sm textCenter">
                                        <p class="mt-3 letterColor">{{$product->detail_type}}</p>
                                    </div>
                                    <div class="col-sm textCenter">
                                        <p class="mt-3 letterColor">{{$product->price}} {{$product->quantity}}</p>
                                    </div>
                                    <div class="col-1 textCenter">
                                        <a  href="/Kopg/public/products/{{$product->id}}">
                                            <i class="productInfo mt-4 fas fa-info-circle fa-lg"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>Nema drugih proizvoda ovog prodavača.</p>
                        @endif
                    </div>
                </div>  
            </div>  
        </div>
    </div>
@endsection