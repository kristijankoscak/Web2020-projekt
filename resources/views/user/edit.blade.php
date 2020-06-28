@extends('layouts.app')

@section('content')
@csrf
    <div class="container mt-4 mb-5">
        <div class="row m-0 d-flex justify-content-center pt-1">
            <div class="col-md-12">
                <div class="card opacity-05">
                    <div class="card-header colorGreenDark-op-07 textCenter">
                        Ažuriraj podatke
                    </div>
                    <div class="card-body">
                        {!! Form::open(['action' => ['UserController@update',$user->id], 'method'=>'POST','enctype'=>'multipart/form-data']) !!}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    {{Form::label('name','Ime i prezime',['class'=>'col-md-4 col-form-label text-md-right'])}}
                                    <div class="col-md-6">
                                        {{Form::text('name',$user->name,['class'=>'form-control','autofocus'=>'true', 'autocomplete'=>'name'])}}
                                        @if ($errors->has('name')) 
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                
                                <div class="form-group row">
                                    {{Form::label('email','E-Mail adresa',['class'=>'col-md-4 col-form-label text-md-right'])}}
                                    <div class="col-md-6">
                                        {{Form::email('email',$user->email,['class'=>'form-control','autofocus'=>'true', 'autocomplete'=>'email'])}}
                                        @if ($errors->has('email')) 
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                @if( Auth::user()->user_type === "seller")
                                    <div class="form-group row">
                                        {{Form::label('userOPG','Ime OPG-a',['class'=>'col-md-4 col-form-label text-md-right'])}}
                                        <div class="col-md-6">
                                            {{Form::text('userOPG',$user->user_opg,['class'=>'form-control','autofocus'=>'true', 'autocomplete'=>'userOPG'])}}
                                            @if ($errors->has('userOPG')) 
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('userOPG') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group row">
                                    {{Form::label('contact','Kontakt',['class'=>'col-md-4 col-form-label text-md-right'])}}
                                    <div class="col-md-6">
                                        {{Form::text('contact',$user->contact,['class'=>'form-control','autofocus'=>'true', 'autocomplete'=>'contact'])}}
                                        @if ($errors->has('contact')) 
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $errors->first('contact') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                
                                <div class="form-group row">
                                    {{Form::label('zupanija','Županija',['class'=>'col-md-4 col-form-label text-md-right'])}}
                                    <div class="col-md-6">
                                        {{Form::select('userCounty', [$user->county => $user->county],$user->county,['class'=>'custom-select','id'=>'zupanija'])}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    {{Form::label('userPlace','Mjesto',['class'=>'col-md-4 col-form-label text-md-right'])}}
                                    <div class="col-md-6">
                                        {{Form::text('userPlace',$user->city,['class'=>'form-control','autofocus'=>'true', 'autocomplete'=>'userPlace'])}}
                                        @if ($errors->has('userPlace')) 
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $errors->first('userPlace') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{Form::label('userAddress','Adresa',['class'=>'col-md-4 col-form-label text-md-right'])}}
                                    <div class="col-md-6">
                                        {{Form::text('userAddress',$user->address,['class'=>'form-control','autofocus'=>'true', 'autocomplete'=>'userAddress'])}}
                                        @if ($errors->has('userAddress')) 
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $errors->first('userAddress') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{Form::label('userImage','Korisnička slika',['class'=>'col-md-4 col-form-label text-md-right'])}}
                                    <div class="col-md-6">
                                        <div class="container-flex  mt-1" style="height:102px; width:102px;">
                                            <img id="chosenUserImage" class="rounded mx-auto d-block" src="/Kopg/public/storage/user_images/{{$user->image_link}}" alt="Product image" style="width:100%; height:100%;"> 
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        {{Form::file('userImage',['class'=>'form-control-file ml-5','id'=>'userImage'])}}
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="form-group row mb-0 d-flex justify-content-center">
                            <div class="col-md-6 offset-md-4">
                                {{Form::hidden('_method','PUT')}}
                                {{Form::submit('Izmjeni podatke',['class'=>'btn btn-success mt-1 mb-1'])}}  
                            </div>
                        </div>
                        {!! Form::close() !!}
                        <div class="row float-right">
                            {!! Form::open(['action' => ['UserController@destroy',$user->id], 'method'=>'POST']) !!}
                            <div class="form-group row mb-0 d-flex justify-content-center">
                                <div class="col-md-6 offset-md-4">
                                    {{Form::hidden('_method','DELETE')}}
                                    {{Form::submit('Obriši korisnički račun',['class'=>'btn btn-danger letterColor float-right mt-1 mb-1'])}}  
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
@endsection
