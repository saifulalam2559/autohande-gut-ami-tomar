@extends('frontend.layouts.master')
@section('content')









<!-- preload -->
<div class="preload preload-container">
    <div class="preload-logo">
        <div class="spinner"></div>
    </div>
</div>
<!-- /preload -->
<div id="wrapper" style="margin-top:80px;">




    <!-- page-title -->
    <div class="tf-page-title cardgradient">
        <div class="container-full">
            <div class="heading text-center">Einloggen</div>
        </div>
    </div>
    <!-- /page-title -->

    <!-- page-cart -->
    <section class="flat-spacing-11">


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
              @include('backend.layouts.notification')
            <div class="card cardgradient" >
                <center>  <div class="card-header"><h6>Barcode Stock Management | TechZube</h6></div></center> 

                <div class="card-body"><br>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Passwort') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Daten merken') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('Jetzt anmelden') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}" style="color:#0c6efd;text-decoration: none; display:none;">
                                        {{ __('Passwort vergessen?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div class="row mb-0" style="display:none;">
                            <div class="col-md-12 offset-md-4" style="font-size:15px;font-weight:400;font-family: "Albert Sans", sans-serif;">
                                Noch nicht registriert? <a  href="{{route('register')}}" style="color:#0c6efd;text-decoration: none;"> Erstelle ein Konto</a>


                                
                            </div>
                            
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>





    </section>
    <!-- page-cart -->

   
</div>
<style>



</style>

@endsection





@section('scripts')




@endsection

