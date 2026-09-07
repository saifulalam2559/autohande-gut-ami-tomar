/* 
 * All pages index post delete js

 */


 $(document).ready(function(){
     
     
 $(document).on('click', '.confirmDelete', function(e) {
    e.preventDefault();

    let form = $(this).closest('form');

    Swal.fire({
        title: "Are you sure?",
        text: "Do you really want to delete this item?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "Cancel",
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6"
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();   // normal form submit
        }
    });
});


    
    
});