@extends('layouts.app')
    
@section('content')

    <div class="mainContainerHeight container">
        <div class="container pt-5 textCenter m-0 p-0">
            <h1 class="letterColor colorGreenDark-op-07 m-0 p-5">Dobro došli na stranicu {{ config('app.name', 'mojOPG!') }}!</h1>
        </div>
        <div class="container  opacity-05 border border-white mt-0 pt-0">
            <p id="welcomeText" class="h5 pl-5 pr-5 ml-5 mr-5">
                Stranica je napravljena kako bi olakšala reklamiranje proizvoda OPG-ovaca diljem RH. 
                Nastala je kao projektni zadatak na Fakultet elektrotehnike, računarstva i informacijskih 
                tehnologija Osijek iz kolegija Web programiranje.<br>
                Za više informacija,provjerite stranicu <a href="/Kopg/public/instructions">s uputama</a>.<br>
                Za bilo kakvu nejasnoću,problem ili grešku slobodno se obratite na mail: mojopg@gmail.com.
            </p>
        </div>
        
    </div>
@endsection
