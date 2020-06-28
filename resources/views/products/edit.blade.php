@extends('layouts.app')

@section('content')

    <div class="container  mainContainerHeight pt-5 pb-5">
        <div class="row m-0 p-0 colorGreenDark-op-07 rounded-top d-flex justify-content-center">
            <p class="h2 mt-4 letterColor textCenter">Izmjenite svoj proizvod:</p>
        </div>
        <div class="row m-0 p-0 border border-white">
            <div class="col-sm p-0 m-0">
                {!! Form::open(['action' => ['ProductsController@update',$product->id], 'method'=>'POST','enctype'=>'multipart/form-data']) !!}
                    <div class="row m-0 p-0">
                        <div class="col-sm">
                            <div id="uploadImage" class="container d-flex justify-content-center mt-1" style="height:152px; width:202px;">
                                <img id="chosenImage" class="img-thumbnail d-block" src="/Kopg/public/storage/product_images/{{$product->image_link}}" alt="Product image"> {{-- https://via.placeholder.com/150 --}}
                            </div>
                            {{Form::file('productImage',['class'=>'form-control-file mt-2','id'=>'productImage'])}}
                            <div class="form-group row mt-2">
                                {{Form::label('inputPrice','Cijena',['class'=>'letterColor col-sm-2 col-form-label'])}}
                                <div class="col-sm-10">
                                    {{Form::text('inputPrice',$product->price,['class'=>'form-control w-75','placeholder'=>'10.00'])}}
                                    @if ($errors->has('inputPrice')) 
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('inputPrice') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> 
                            <div class="col-sm-12 d-flex justify-content-center">
                                <div class="form-check">
                                    {{Form::radio('gridRadios','kn/g',true,['id'=>'gridRadios1','class'=>'form-check-input'])}}
                                    {{Form::label('gridRadios','kn/g',['class'=>'letterColor form-check-label'])}}
                                </div>
                                <div class="form-check ml-2">
                                    {{Form::radio('gridRadios','kn/kg',false,['id'=>'gridRadios2','class'=>'form-check-input'])}}
                                    {{Form::label('gridRadios','kn/kg',['class'=>'letterColor form-check-label'])}}
                                </div>
                                <div class="form-check ml-2">
                                    {{Form::radio('gridRadios','kn/t',false,['id'=>'gridRadios3','class'=>'form-check-input'])}}
                                    {{Form::label('gridRadios','kn/t',['class'=>'letterColor form-check-label'])}}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm ">
                            <div class="form-group row mt-2">
                                {{Form::label('inputType','Vrsta',['class'=>'letterColor col-sm-2 col-form-label'])}}
                                <div class="col-sm-10">
                                    {{Form::select('inputType', ['Suhomesnati proizvodi' => 'Suhomesnati proizvodi', 'Voće' => 'Voće', 'Povrće' => 'Povrće'],$product->type,['id'=>'inputType','class'=>'form-control w-75'])}}
                                </div>
                            </div>     
                            <div class="form-group row">
                                {{Form::label('inputDetailType','Podvrsta',['class'=>'letterColor col-sm-2 col-form-label'])}}
                                <div class="col-sm-10">
                                    {{Form::text('inputDetailType',$product->detail_type,['class'=>'form-control w-75','placeholder'=>'npr.Mrkva..'])}}
                                    @if ($errors->has('inputDetailType')) 
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('inputDetailType') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                {{Form::label('inputCounty','Županija',['class'=>'letterColor col-sm-2 col-form-label'])}}
                                <div class="col-sm-10">
                                    {{Form::select('inputCounty', [$product->county=>$product->county],$product->county,['id'=>'zupanija','class'=>'form-control w-75'])}}
                                </div>
                            </div>
                            <div class="form-group row">
                                {{Form::label('inputLocation','Lokacija',['class'=>'letterColor col-sm-2 col-form-label'])}}
                                <div class="col-sm-10">
                                    {{Form::text('inputLocation',$product->location,['class'=>'form-control w-75','placeholder'=>'npr.Jarmina..'])}}
                                    @if ($errors->has('inputLocation')) 
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('inputLocation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                {{Form::label('inputContact','Kontakt',['class'=>'letterColor col-sm-2 col-form-label'])}}
                                <div class="col-sm-10">
                                    {{Form::text('inputContact',$product->contact,['class'=>'form-control w-75','placeholder'=>'npr.0923344556..'])}}
                                    @if ($errors->has('inputContact')) 
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('inputContact') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                   
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        {{Form::hidden('_method','PUT')}}
                        {{Form::submit('Izmjeni proizvod',['class'=>'btn btn-success'])}}  
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection