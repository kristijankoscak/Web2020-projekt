@extends('layouts.app')

@section('content')
<div class="container mt-2 mb-2">
    <div class="row m-0 d-flex justify-content-center pt-3 pb-2">
        <div class="col-md-12">
            <div class="card opacity-05">
                <div class="card-header colorGreenDark-op-07 textCenter">
                    <p>{{ __('Registracija') }}</p>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype='multipart/form-data'>
                        @csrf
                        <div class="row justify-content-center">
                            <div id="userType">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="userType" id="inlineRadio1" value="prodavac" checked>
                                    <label class="form-check-label" for="inlineRadio1">Kao prodavač</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="userType" id="inlineRadio2" value="kupac">
                                    <label class="form-check-label" for="inlineRadio2">Kao kupac</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Ime i prezime') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail adresa') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Lozinka') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Ponovite lozinku') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="zupanija" class="col-md-4 col-form-label text-md-right">{{ __('Županija') }}</label>
        
                                    <div class="col-md-6">
                                        <select class="custom-select " id="zupanija" name="userCounty">
                                            <option selected>Odaberite županiju</option>
                                        </select>  
                                    </div>
                                </div>
                                <div class="form-group row" id="userOPGBlock">
                                    <label for="userOPG" class="col-md-4 col-form-label text-md-right">{{ __('Ime OPG-a') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="userOPG" type="text" class="form-control @error('userOPG') is-invalid @enderror" name="userOPG" value="{{ old('userOPG') }}" autocomplete="userOPG">
        
                                        @error('userOPG')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label for="userContact" class="col-md-4 col-form-label text-md-right">{{ __('Broj telefona') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="userContact" type="text" class="form-control @error('userContact') is-invalid @enderror" name="userContact" value="{{ old('userContact') }}" required autocomplete="userContact">
                                        @error('userContact')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="userPlace" class="col-md-4 col-form-label text-md-right">{{ __('Mjesto') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="userPlace" type="text" class="form-control @error('userPlace') is-invalid @enderror" name="userPlace" value="{{ old('userPlace') }}" required autocomplete="userPlace">
                                        @error('userPlace')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="userAddress" class="col-md-4 col-form-label text-md-right">{{ __('Adresa') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="userAddress" type="text" class="form-control @error('userAddress') is-invalid @enderror" name="userAddress" value="{{ old('userAddress') }}" required autocomplete="userAddress">
                                        @error('userAddress')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="userImage" class="col-md-4 col-form-label text-md-right">{{ __('Korisnička slika') }}</label>
                                    <div class="col-md-6">
                                        <div class="container-flex  mt-1" style="height:102px; width:102px;">
                                            <img id="chosenUserImage" class="rounded mx-auto d-block" src="https://via.placeholder.com/100" alt="Product image" style="width:100%; height:100%;"> 
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input id="userImage" type="file"  name="userImage" class="form-control-file ml-5 @error('userImage') is-invalid @enderror">
                                        @error('userImage')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                
                            </div>  

                        </div>
                       

                        <div class="form-group row mb-0 d-flex justify-content-center">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Registriraj me') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
