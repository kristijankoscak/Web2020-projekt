@extends('layouts.app')
    
@section('content')

    <div class="mainContainerHeight container">
        <div class="container pt-2 textCenter m-0 p-0">
            <h5 class="letterColor colorGreenDark-op-07 m-0 p-2">Rezultati pretrage:</h5>
        </div>
        <div class="container overflow-auto opacity-05 border border-white mt-0 pt-0">
            <p id="welcomeText" class="h5 pl-5 pr-5 ml-5 mr-5">
                @foreach($search_result as $results)
                        @if(count($results)>0)
                            @foreach($results as $result)
                                 @if($result->name != null)
                                    <p>Korisnik: {{$result->name}} , <a class="letterColor" href="user/{{$result->id}}">poveznica na korisnika.</a></p>
                                @endif
                                @if($result->type != null)
                                    <p>Proizvod: {{$result->type}} ,  <a class="letterColor" href="products/{{$result->id}}">poveznica na proizvod.</a></p>
                                @endif
                            @endforeach
                        @endif
                @endforeach
            </p>
        </div>
        
    </div>
@endsection