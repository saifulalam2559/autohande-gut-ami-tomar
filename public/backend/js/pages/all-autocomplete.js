/* 
 * All page jQuery Auto Complete

 */



  // autoComSubSubC for backend Create Sub Sub Category
  
     $(document).ready(function(){
            
            var path = "{{route('autoComSubSubC')}}";
            
            $('#sub_category_id').autocomplete({
                
                source:function(request,response){
                    
                    minLength:0;
                    
                    
                    $.ajax({
                        
                        url:path,
                        dataType:"JSON",
                        data:{
                            
                            term: request.term
                            
                        }, //  data:{
                        
                        success:function(data){
                            
                            response(data);
                            
                        } //  success:function(data){
                        
                        
                        
                    }); // $.ajax({
                    
                    
                } // source:function(request,response){
                
                
              
                
            }); // $('#search_text').autocomplete({
            
            
            
            
        });  //  $(document).ready(function(){
        
        
        
      
        
   
    