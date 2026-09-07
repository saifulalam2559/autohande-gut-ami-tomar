    <section class="flat-spacing-24 pb_0 tf-slideshow tf-form-sneaker">
            <div class="banner-wrapper">
                <img class="lazyload" data-src="{{asset('frontend/homeimages/furniture-banner-collection.jpg')}}" src="{{asset('frontend/homeimages/furniture-banner-collection.jpg')}}" alt="collection-img" style="height:600px;">
                <div class="container-full">
                    <div class="box-content bg_white">
                        <div class="flat-title text-center mb_1 wow fadeInUp" data-wow-delay="0s">
                            <span class="title text_black fw-7">ANMELDUNG FÜR  <br> UNSEREN NEWSLETTER! </span>
                            <p class="sub-title text_black">Möchten Sie die neusten Informationen über unsere Produkte, Sonderangebote, Rabatte und Deko-Inspirationen erhalten? </p>
                        </div>
                        <div class="flat-subscrite-wrap">
                            <form class="form-newsletter" id="subscribe-form" method="POST" action="{{ route('subscribe.store') }}" accept-charset="utf-8" data-mailchimp="true">
                                @csrf
                                <div id="subscribe-content" class="subscribe-content">
                                    <fieldset class="email">
                                        <input type="email" name="email" id="subscribe-emailXX" placeholder="Enter email address" tabindex="0" aria-required="true" required style="border:1px solid gray;">
                                    </fieldset>
                                    <div class="button-submit">
                                        <button type="submit" id="subscribe-buttonXX" class="tf-btn mt-0  btn-sm animate-hover-btn text-uppercase letter-2 fw-6" style="background-color: #000;color:#fff;">Absenden</button>
                                    </div>
                                    


                                </div>
                                <center>                           
   <label style="display: flex; align-items: center; gap: 8px;margin-top:10px;max-width:450px;">
       <input  type="checkbox" name="privacy_policy" required >
       <span style="font-size: 14px;font-weight: 300;text-align: left;">Ich habe die <a href="" target="_blank" style="color: #005e8b; ">Datenschutzerklärung</a> gelesen und stimme diesen zu (Pflichtfeld).</span>
</label>
                                     </center>   
    
                                <div id="subscribe-msgXX"></div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>



@section('scripts')






@endsection