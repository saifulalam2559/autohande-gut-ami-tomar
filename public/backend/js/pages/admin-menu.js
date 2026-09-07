/* 
 * Admin menu js

 */



$(document).ready(function () {

    function setActiveLink() {

        // Current path only, without domain/query string
        var currentPath = window.location.pathname.replace(/\/+$/, '');

        // Remove previous active state and inline styling
        $('#sidebar-wrapper a').removeClass('active').css('background-color', '');

        // Close all submenus
        $('.collapse').collapse('hide');

        var matchedLink = null;
        var longestMatch = '';

        $('#sidebar-wrapper a[href]').each(function () {

            var href = $(this).attr('href');

            // Ignore empty, # and javascript links
            if (!href || href === '#' || href.indexOf('javascript:') === 0) {
                return;
            }

            // Convert href to URL and get pathname
            var linkPath;

            try {
                linkPath = new URL(href, window.location.origin)
                    .pathname
                    .replace(/\/+$/, '');
            } catch (e) {
                return;
            }

            // Exact path match
            if (
                linkPath === currentPath &&
                linkPath.length >= longestMatch.length
            ) {
                matchedLink = this;
                longestMatch = linkPath;
            }
        });

        // Highlight only the matching link
        if (matchedLink) {

            $(matchedLink)
                .addClass('active')
                .css('background-color', 'rgb(125 125 125)');

            // If it is a submenu item, open its parent submenu
            var submenu = $(matchedLink).closest('.submenu');

            if (submenu.length) {
                submenu.collapse('show');
            }
        }
    }


    // Set active menu when page loads
    setActiveLink();


    // Browser back/forward
    $(window).on('popstate', function () {
        setActiveLink();
    });


    // Sidebar toggle
    $("#menu-toggle").on('click', function (e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("toggled");
    });

});