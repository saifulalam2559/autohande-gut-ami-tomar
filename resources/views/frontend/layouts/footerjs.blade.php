
   <!-- Javascript -->
    <script src="{{asset('frontend/app/js/jquery.min.js') }}"></script>
    <script src="{{asset('frontend/app/js/jquery.easing.js') }}"></script>
    <script src="{{asset('frontend/app/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{asset('frontend/app/js/bootstrap.min.js') }}"></script>
    <script src="{{asset('frontend/app/js/plugin.js') }}"></script>
    <script src="{{asset('frontend/app/js/switcher.js') }}"></script>
    <script src="{{asset('frontend/app/js/shortcodes.js') }}"></script>
    <script src="{{asset('frontend/app/js/main.js') }}"></script>
    <script src="{{asset('frontend/app/js/sibforms.js') }}" defer></script>
    <script>
        window.REQUIRED_CODE_ERROR_MESSAGE = 'Please choose a country code';
        window.LOCALE = 'en';
        window.EMAIL_INVALID_MESSAGE = window.SMS_INVALID_MESSAGE = "The information provided is invalid. Please review the field format and try again.";

        window.REQUIRED_ERROR_MESSAGE = "This field cannot be left blank. ";

        window.GENERIC_INVALID_MESSAGE = "The information provided is invalid. Please review the field format and try again.";

        window.translation = {
            common: {
                selectedList: '{quantity} list selected',
                selectedLists: '{quantity} lists selected'
            }
        };

        var AUTOHIDE = Boolean(0);
    </script>

    <!-- Javascript -->
    <script src="{{asset('frontend/app/js/swiper-bundle.min.js') }}"></script>
    <script src="{{asset('frontend/app/js/swiper.js') }}"></script>
    <script src="{{asset('frontend/app/js/jquery-validate.js') }}"></script>
    <script src="{{asset('frontend/app/js/price-ranger.js') }}"></script>
 

  






@yield('scripts')

