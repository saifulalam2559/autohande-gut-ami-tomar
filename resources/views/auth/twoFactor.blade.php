@extends('frontend.layouts.master')
@section('content')









       <!-- preload -->
       <div class="preload preload-container" >
        <div class="preload-logo">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- /preload -->
    <div id="wrapper" style="margin-top:80px;">
       



        <!-- page-title -->
        <div class="tf-page-title">
            <div class="container-full">
                <div class="heading text-center">Zweistufige Authentifizierung</div>
            </div>
        </div>
        <!-- /page-title -->
   
        <!-- page-cart -->
        <section class="flat-spacing-11">
            <div class="container">
                
                              <div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card-group">
          
            <div class="card p-4">
                <div class="card-body">
                    <h6>
            
                    </h6>
                    @if(session()->has('message'))
                        <p class="alert alert-info">
                            {{ session()->get('message') }}
                        </p>
                    @endif
                    <form method="POST" action="{{ route('verify.store') }}">
                        {{ csrf_field() }}
                     
                        <p class="text-mutedxx" style="font-size:18px;">
                             Geben Sie den 6-stelligen Code ein, den wir an <b> {{ $user->email }}</b> gesendet haben.<br>
                     
                            Sie haben die Nachricht nicht erhalten? Vielleicht ist sie im Spam-Ordner gelandet.
                            Wenn Sie keine Code mit Ihrem Authentifizierungscode erhalten haben, klicken Sie erneut<b> <a style="color:blue;" href="{{ route('verify.resend') }}"> hier </a></b>.
                        </p><br>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-lock"></i>
                                </span>
                            </div>
                            <input name="two_factor_code" type="text" class="input form-control{{ $errors->has('two_factor_code') ? ' is-invalid' : '' }}" required autofocus placeholder="Two Factor Code">
                            @if($errors->has('two_factor_code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('two_factor_code') }}
                                </div>
                            @endif
                            
                            
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-6">
                               
                                <button type="submit" class="btn btn-dark px-4">
                                    Senden
                                </button>
                            </div>
                            <div class="col-6 text-right" style="display:none;">
                                <a class="btn btn-danger px-4" href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                 Abmelden <!--  {{ trans('global.logout') }}-->
                                </a>
                            </div>
                    
                        </div>
                    </form>
                </div>
            </div>
            
            
        </div>
    </div>
</div>

<form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>

            </div>
        </section>
        <!-- page-cart -->
       
       </form>
     </div>  
 <style>
     
   
        
 </style>

 @endsection
 
 

 
 
 @section('scripts')
 

 

 @endsection