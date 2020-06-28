@extends('layouts.app')

@section('content')

    <div class="container">
            <div class="row ">
                <div class="col-lg-5 col-md-6 mt-4 mb-4">
                    <div class="opacity-0 card h-100 align-items-middle">
                        <div class="row p-0 m-0 rounded-top colorGreenDark-op-07">
                            <div class="col m-0 p-0 d-flex  justify-content-center">
                                <div class="container p-0 m-1" style="height:202px; width:202px;"> 
                                    <img class="rounded mx-auto d-block" src="/Kopg/public/storage/user_images/{{$user->image_link}}" alt="Product image" style="width:100%; height:100%;"> 
                                </div>
                            </div>
                            <div class="col m-0 p-0 textCenter">
                                <p class="h3 letterColor mt-4">Broj proizvoda:</p>
                                <p class="h4 letterColor">{{count($userProducts)}}</p>
                                <p class="h3 letterColor">Ocjena:</p>
                                <p class="h4 letterColor">{{$average}}</p>
                            </div>
                        </div>
                        <div class="card-body textCenter border border-white border-top-0">
                            <h4 class="card-title">
                                <p class="h4 letterColor">{{$user->name}}</p>
                                <p class="h3">{{$user->county}}</p>
                                <p class="h3">{{$user->city}}</p>
                                <p class="h3">{{$user->address}}</p>
                                <p class="h3">{{$user->contact}}</p>
                                <p class="h2 letterColor"><b>{{$user->user_opg}}</b></p>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 mt-4 mb-4">
                    <div class="container overflow-auto" style="height:450px"> {{-- 4 messages --}}
                        @if(count($userComments)>0)
                            @foreach($userComments as $comment)
                                <div class="opacity-05 container rounded mt-2">
                                    <div class="row align-items-center">
                                        <div class="col-2 " >
                                            <div class="container-flex mt-1" style="height:52px; width:52px;">
                                                <img class='rounded-circle border border-dark' src='/Kopg/public/storage/user_images/{{$comment->author_image}}' alt="Product image" style="width:100%; height:100%;"> 
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <p> - "{{$comment->comment}}"</p>
                                        </div>
                                        <div class="col-1 ml-1 mr-2">&#9733; {{$comment->grade}}</div>
                                    </div>
                                    <div class="row m-0 p-0">
                                        <div class="col-sm pl-0 pr-0">Korisnik: <br>{{$comment->author_name}}</div>
                                        <div class="col-sm pl-0 pr-0">Datum: <br>{{date("d.m.y H:i", strtotime($comment->created_at))}}</div>
                                        <div class="col-2 pl-0 pr-0">
                                            @if(Auth::check())
                                                <span class="float-right">Akcije:</span><br>
                                                @if((Auth::user()->id == $comment->author_id)||(Auth::user()->user_type === "admin"))
                                                    {!!Form::open(['action'=>['CommentsController@destroy',$comment->belongs_to,$comment->id],'method'=>'POST','class'=>'float-right ml-2']) !!}
                                                        {{Form::hidden('_method','DELETE')}}
                                                        {{Form::button('<i class="h5 fa fa-trash text-danger" aria-hidden="true" title="Obriši"></i>',['type'=>'submit','class'=>'p-0','style="background:none;border:none;"'])}} 
                                                    {!!Form::close() !!}
                                                    
                                                @endif
                                                @if(Auth::user()->id != $comment->author_id)
                                                {!!Form::open(['action'=>['CommentsController@report',$comment->belongs_to,$comment->id],'method'=>'POST','class'=>'float-right']) !!}
                                                    {{Form::button('<a href="/Kopg/public/user/'.$user->id.'/comment/'.$comment->id.'"><i class="h5 fas fa-exclamation-circle text-warning" title="Prijavi"></i></a>',['type'=>'submit','class'=>'p-0','style="background:none;border:none;"'])}} 
                                                {!!Form::close() !!}
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>
                @if(Auth::check())
                    @if(Auth::user()->id !== $user->id)
                    <div class="col-1 ml-1 mt-5">
                        <a class="btn btn-success p-1" href="/Kopg/public/user/{{$user->id}}/comment"><i class="fa fa-2x fa-plus-circle mt-1"></i></a>
                    </div>
                    @endif
                @endif
            </div>
    </div>

@endsection