@extends('layouts.app')

@section('content')

    <div class="container" style="height:500px">
            {!! Form::open(['action' => ['CommentsController@store',$user_id], 'method'=>'POST']) !!}
            <div class="container" style="padding-top:25vh;">
                <div class="form-group row d-flex justify-content-center">
                    {{Form::label('inputComment','Komentar',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-md-8">
                        {{Form::textArea('inputComment',null,['id'=>'inputComment','class'=>'form-control','style'=>'max-height:100px;','rows'=>1,'maxlength'=>160])}}
                        @if ($errors->has('inputComment')) 
                            <span class="text-danger" role="alert">
                                <strong>{{ $errors->first('inputComment') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row d-flex justify-content-center">
                    {{Form::label('grodRadops','Ocjena',['class'=>'col-sm-2 '])}}
                    <div class="col-lg-8 d-flex justify-content-center">
                        <div class="form-check">
                            {{Form::radio('gridRadios','1',false,['id'=>'gridRadios1','class'=>'form-check-input'])}}
                            {{Form::label('gridRadios','1',['class'=>'form-check-label mr-2'])}}
                        </div>
                        <div class="form-check">
                            {{Form::radio('gridRadios','2',false,['id'=>'gridRadios2','class'=>'form-check-input'])}}
                            {{Form::label('gridRadios','2',['class'=>'form-check-label mr-2'])}}
                        </div>
                        <div class="form-check">
                            {{Form::radio('gridRadios','3',true,['id'=>'gridRadios3','class'=>'form-check-input'])}}
                            {{Form::label('gridRadios','3',['class'=>'form-check-label mr-2'])}}
                        </div>
                        <div class="form-check">
                            {{Form::radio('gridRadios','4',false,['id'=>'gridRadios4','class'=>'form-check-input'])}}
                            {{Form::label('gridRadios','4',['class'=>'form-check-label mr-2'])}}
                        </div>
                        <div class="form-check">
                            {{Form::radio('gridRadios','5',false,['id'=>'gridRadios5','class'=>'form-check-input'])}}
                            {{Form::label('gridRadios','5',['class'=>'form-check-label mr-2'])}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="container d-flex justify-content-center">
                {{Form::submit('Predaj komentar',['class'=>'btn btn-success mt-2'])}}  
            </div>
            
            {!! Form::close() !!}

    </div>

@endsection