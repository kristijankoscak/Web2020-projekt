@extends('layouts.app')
    
@section('content')
    <div class="mainContainerHeight container">
        <div class="container ">
            <ul class="list-group ">
                <li class="list-group-item opacity-05 m-0 p-0 mt-2">
                    <div class="container-flex colorGreenDark-op-07 textCenter">
                        <p class="h4 letterColor">Registracija</p>
                    </div>
                    <div class="container justify-content-start">
                       <p>
                            Prilikom registracije imate mogućnost odabrati, želite li se registrirati kao kupac ili 
                            prodavač. Potrebno je da unesete sve obavezne podatke. Nakon registracije prijavit će vas
                            automatski na stranicu i možete započeti s radom.
                            <br>
                            Ono što kao kupac dobivate registracijom je mogućnost ostavljanja komentara kod pojedinog
                            prodavača, što kao gost na stranici ne možete (za sad).
                       </p>
                    </div>
                </li>   
                <li class="list-group-item opacity-05 m-0 p-0">
                    <div class="container-flex colorGreenDark-op-07 textCenter">
                        <p class="h4 letterColor">Prijava</p>
                    </div>
                    <div class="container justify-content-start">
                        <p>
                            Nakon uspješne prijave na stranicu prodavač može pogledati:
                        </p> 
                        <p class="textCenter">
                            svoj profil, <br>
                            svoje oglase, <br>
                            predat oglas, <br>
                            ažurirat osobne podatke i promjenit lozinku.<br> 
                        </p>
                        <p>
                            Kupac može samo ažurirat podatke i promjenit
                            lozinku.
                        </p>
                            
                       
                    </div>
                </li> 
                <li class="list-group-item opacity-05 m-0 p-0">
                    <div class="container-flex colorGreenDark-op-07 textCenter">
                        <p class="h4 letterColor">Predaja oglasa</p>
                    </div>
                    <div class="container justify-content-start">
                       <p>
                            Odabirom opcije predaj oglas, ili klikom na ikonicu za dodavanje oglasa na stranici moji oglasi
                            prodavač može predati oglas nakon popunjavanja zahtjevanih podataka. Svaki prodavač ima uvid 
                            u svoje oglase na stranici moji oglasi gdje ih može izmjenjivati ili brisati.
                       </p>
                    </div>
                </li> 
                <li class="list-group-item opacity-05 m-0 p-0">
                    <div class="container-flex colorGreenDark-op-07 textCenter">
                        <p class="h4 letterColor">Komentari</p>
                    </div>
                    <div class="container justify-content-start">
                       <p>
                           Komentari se ostavljaju na stranici prodavača. Do pojedinog prodavača se dolazi pretraživanjem ili
                           preko proizvoda pojedinog prodavača. 
                       </p>
                    </div>
                </li> 
            </ul>   
        </div>
    </div>
@endsection
