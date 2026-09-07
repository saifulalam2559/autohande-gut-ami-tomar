
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
    <div class="tf-page-title">
        <div class="container-full">
            <div class="heading text-center">E-Mail Verifizierung</div>
        </div>
    </div>
    <!-- /page-title -->

    <!-- page-cart -->
    <section class="flat-spacing-11">

     <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
   <div class="card">
                <div class="card-header">{{ __('Verifizieren Sie Ihre E-Mail Adresse') }}</div>

                <div class="card-body">
                    
                    <!-- Display success messages -->
                     @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                       @endif
                                        <!-- Display error messages -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                   <form method="POST" action="{{ route('verify.email') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="verification_code" class="form-label">{{ __('Bestätigungscode') }}</label>
                            <input type="text" class="form-control input @error('verification_code') is-invalid @enderror" 
                                   id="verification_code" 
                                   name="verification_code" 
                                   required>
                            @error('verification_code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <input type="hidden" name="email" value="{{ $email }}">

                        <button type="submit" class="btn btn-dark">{{ __('Verifizieren') }}</button>
                    </form>
                    

                    <div class="text-center mt-3">




    <form method="POST" action="{{ route('resend.verification.code') }}">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        <button type="submit" class="btn btn-link">
            Bestätigungscode erneut senden
        </button>
    </form>
</div>


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

