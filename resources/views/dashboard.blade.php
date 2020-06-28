@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="container-flex border overflow-auto" style="height:70vh;">
                <div class="card opacity-05">
                    <div class="card-header colorGreenDark-op-07">
                        <span style="margin-top:0.375rem; padding-bottom:0.375rem;">Vaši oglasi:</span>
                        <a class="btn btn-success float-right p-0 m-0" href="/Kopg/public/products/create"><i class="fas fa-plus" ></i></a>
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
                                            <a href="/Kopg/public/products/{{$product->id}}/edit"><button class="btn btn-outline-info mr-2 mb-2 mt-2">Izmjeni</button></a>
                                            {!!Form::open(['action'=>['ProductsController@destroy',$product->id],'method'=>'POST','class'=>'d-inline-block']) !!}
                                                {{Form::hidden('_method','DELETE')}}
                                                {{Form::submit('Izbriši', ['class'=>'btn btn-outline-danger'])}}
                                            {!!Form::close() !!}
                                        </div>  
                                    </div>
                                </div> 
                            @endforeach
                        @else
                            <p>Nemate postavljenih proizvoda.</p>
                        @endif      
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
