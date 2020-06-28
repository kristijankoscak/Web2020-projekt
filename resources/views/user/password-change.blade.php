@extends('layouts.app')

@section('content')
@csrf
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center pt-3 pb-4">
            <div class="col-md-8 mt-5 mb-5">
                <div class="card opacity-05 mt-4 mb-4">
                    <div class="card-header colorGreenDark-op-07">
                        Promjenite lozinku:
                    </div>
                    <div class="card-body">
                    {!! Form::open(['action' => ['UserController@updatePassword',$user->id], 'method'=>'POST','enctype'=>'multipart/form-data']) !!}
                        <div class="form-group row">
                            {{Form::label('password','Lozinka',['class'=>'col-md-4 col-form-label text-md-right'])}}
                            <div class="col-md-6">
                                {{Form::password('password',['id'=>'password','class'=>'form-control w-75','autofocus'=>'true'])}}
                                @if ($errors->has('password')) 
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            {{Form::label('password-confirm','Ponovite lozinku',['class'=>'col-md-4 col-form-label text-md-right'])}}
                            <div class="col-md-6">
                                {{Form::password('password_confirmation',['id'=>'password_confirmation','class'=>'form-control w-75','autofocus'=>'true'])}}
                                @if ($errors->has('password_confirmation')) 
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('password-confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-center">
                            {{Form::hidden('_method','PUT')}}
                            {{Form::submit('Promjeni lozinku',['class'=>'btn btn-success'])}}  
                        </div>
                    {!! Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
