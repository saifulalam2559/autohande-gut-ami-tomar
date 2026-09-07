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
            <div class="heading text-center">Passwort zurücksetzen</div>
        </div>
    </div>
    <!-- /page-title -->

    <!-- page-cart -->
    <section class="flat-spacing-11">


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
               <div class="card cardgradient">
                <div class="card-header"><h6>{{ __('Passwort zurücksetzen') }}</h6></div>

                <div class="card-body"><br>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <center> <span style="font-size:16px;">Geben Sie Ihre E-Mail-Adresse ein und wir werden Ihnen in Kürze<br> einen Link zum Zurücksetzen des Passworts zusenden.</span></center><br>
                    <form method="POST" action="{{ route('password.email') }}">
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

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('Senden') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <br>
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
