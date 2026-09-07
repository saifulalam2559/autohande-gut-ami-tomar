<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\backend\StripeController;
use App\Models\Subcategory;
use App\Models\SubSubCategory;


class FrontendIndexController extends Controller
{
    
    public function home(Request $request)
    {

       
    
         return view('frontend.home.index');

        
    }
    
    
    
    
        public function FrontendFahrzeugListe( )
    {

       
    
         return view('frontend.pages.fahrzeugliste');

        
    }
    
    
     
    

   
    
    

} // END
