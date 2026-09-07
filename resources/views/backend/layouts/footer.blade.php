 <!-- Footer -->
    <footer id="footer">
        &copy; <?php echo date('Y'); ?> OXSOFTS. www.oxsofts.com . All Rights Reserved.
    </footer>
    <!-- /Footer -->

</div>
<!-- /#wrapper -->

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<!-- start my custom js -->

<script src="{{asset('backend/js/pages/post-delete.js')}}"></script>
<script src="{{asset('backend/js/pages/admin-menu.js')}}"></script>
<script src="{{asset('backend/js/pages/all-autocomplete.js')}}"></script>
<script src="{{asset('backend/js/pages/new-toggle-switch.js')}}"></script>


<!-- end my custom js -->

<!-- start autocomplete display -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    
    <!-- Include Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        // Initialize Select2 on your select element
        $(document).ready(function() {
            $('.my-select').select2();
        });
    </script> 
    

    
    <!-- Include Date Flatpickr JS -->

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- German Language Support -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/de.js"></script>

<!-- End Date Flatpickr JS -->


<!-- Summernote JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

<script>
    $('#summernote').summernote({
        placeholder: 'Write your content here...',
        tabsize: 2,
        height: 400,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ],
        callbacks: {
            onInit: function() {
                // Set the default font size
                $(this).summernote('fontSize', 20); // Adjust 14 to your preferred default font size
            },
            onImageUpload: function(files) {
                let editor = $(this);
                let data = new FormData();
                data.append('file', files[0]);

                // Simulate server upload or handle directly
                const reader = new FileReader();
                reader.onload = function(event) {
                    // Insert the resized image into the editor
                    editor.summernote('insertImage', event.target.result, function($image) {
                        $image.css('max-width', '100%');
                        $image.css('height', 'auto');
                    });
                };
                reader.readAsDataURL(files[0]);
            }
        }
    });
</script>


<!--JavaScript (or jQuery) to automatically hide the error message after 5 seconds.-->

<script>
        setTimeout(function() {
            var errorMessage = document.getElementById('error-message');
            if (errorMessage) {
                errorMessage.style.display = 'none';
            }
        }, 3000); // 5000 milliseconds = 5 seconds
    </script>





@yield('scripts')



