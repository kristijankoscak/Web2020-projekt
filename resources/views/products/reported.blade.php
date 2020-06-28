@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="container-flex border overflow-auto" style="height:70vh;">
                <div class="card opacity-05">
                    <div class="card-header colorGreenDark-op-07">
                        <span style="margin-top:0.375rem; padding-bottom:0.375rem;">Prijavljeni proizvodi:</span>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        
                        @if(count($products)>0)
                            @foreach($products as $product)
                                <div class="row border">
                                    <div class="col-3">
                                        <div class="container-flex mt-2" style="height:102px; width:102px;">
                                            <img class="rounded mx-auto d-block" src="/Kopg/public/storage/product_images/{{$product->image_link}}" alt="Product image" style="width:100%; height:100%;"> 
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                    <p>ID: <b>{{$product->id}}</b></p>
                                    <p>Vrsta: {{$product->type}}</p>
                                    <p>Podvrsta: {{$product->detail_type}}</p>
                                    </div>
                                    <div class="col-3">
                                        <div class="container pull-right">
                                            <a href="/Kopg/public/products/{{$product->id}}"><button class="btn btn-sm btn-info mr-2 mb-2 mt-2">Pogledaj</button></a>
                                            <a href="/Kopg/public/products-reported/{{$product->id}}"><button class="btn btn-sm btn-warning mr-2 mb-2 mt-2">Ukloni prijavu</button></a>
                                            {!!Form::open(['action'=>['ProductsController@destroy',$product->id],'method'=>'POST','class'=>'d-inline-block mb-2 mt-2']) !!}
                                                {{Form::hidden('_method','DELETE')}}
                                                {{Form::submit('Izbriši', ['class'=>'btn btn-sm btn-danger'])}}
                                            {!!Form::close() !!}
                                        </div>  
                                    </div>
                                </div> 
                            @endforeach
                        @else
                            <p>Nema prijavljenih proizvoda.</p>
                        @endif      
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
