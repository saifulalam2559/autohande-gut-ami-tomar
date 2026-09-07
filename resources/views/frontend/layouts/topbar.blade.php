<div id="topheaderbg" class="tf-top-bar bg_white line">
            <div class="px_15 lg-px_40">
                <div class="tf-top-bar_wrap grid-3 gap-30 align-items-center">

                    
                    <div class="text-center overflow-hidden">
                     
                    </div>

                    <div class="top-bar-language tf-cur justify-content-end" >
                        @if(Auth::check() && !Auth::user()->ifItAdmin())
                        <div class="tf-currencies">
  <a href="{{route('login')}}" class="item-link">Hallo, {{Auth::user()->last_name}}</a>
                        </div>
                        @else

             
                        <div class="tf-languages" style="float: right">
           <a href="{{route('login')}}" class="item-link">Anmelden</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>