<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\UserRoleController;

use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\frontend\VerifyEmailController;

use App\Http\Controllers\backend\UserManagementByAdmin;

use App\Http\Controllers\backend\UserControllerForCustomer;

use App\Http\Controllers\backend\BrandController;

use App\Http\Controllers\backend\ModelController;

use App\Http\Controllers\backend\BodyTypeController;

use App\Http\Controllers\backend\FuelTypeController;

use App\Http\Controllers\backend\TransmissionController;


use App\Http\Controllers\backend\ColorController;


use App\Http\Controllers\backend\VehicleConditionController;


use App\Http\Controllers\backend\EmissionClassController;


use App\Http\Controllers\backend\FeatureCategoryController;


use App\Http\Controllers\backend\FeatureController;


use App\Http\Controllers\backend\AutoController;



use App\Http\Controllers\backend\AutoImageController;








use App\Http\Controllers\frontend\FrontendIndexController;








/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/




// start 2FA
Route::get('verify/resend',[TwoFactorController::class, 'resend'])->name('verify.resend');
Route::resource('verify', TwoFactorController::class)->only(['index', 'store']);
// end 2FA

Auth::routes(); // This includes the password reset routes


Route::get('/email/verify/form',[VerifyEmailController::class, 'showVerificationForm'])->name('verification.form');
Route::post('/verify-email', [VerifyEmailController::class, 'verify'])->name('verify.email');

Route::post('/resend-verification-code', [VerifyEmailController::class, 'resendVerificationCode'])->name('resend.verification.code');
       



//  logout
Route::get('/logout',[UserRoleController::class, 'logout'])->name('logout');
Route::post('/logout',[UserRoleController::class, 'logout'])->name('logout');



// Admin Middlewere Group
Route::group(['prefix'=>'admin', 'middleware'=> ['auth','isAdmin','role.redirect'] ], function(){
    
    
       
      // Routes requiring twofactor middleware
    Route::group(['middleware' => 'twofactor'], function() {
       
         
         Route::get('dashboard',[UserRoleController::class, 'adminDashboard'])->name('admin.dashboard');
 
    });
    
    
    // Routes to enable/disable 2FA (these don't use twofactor middleware)        
    Route::post('/dashboard/enable2fa/{id}', [UserManagementByAdmin::class, 'enableTwoFactor'])->name('dashboard.enable2fa');
    Route::post('/dashboard/disable2fa/{id}', [UserManagementByAdmin::class, 'disableTwoFactor'])->name('dashboard.disable2fa');


    
    
   // user management Section by Admin
   Route::resource('usermanagement', UserManagementByAdmin::class);
  
  // user management Ajax
   Route::post('user-status',[UserManagementByAdmin::class,'userStatus'])->name('user.status');


// user search and autocomplete function
    
  Route::get('/admin/users/search', [UserManagementByAdmin::class, 'search'])->name('admin.user.search');
  
  Route::get('/admin/user/autocomplete', [UserManagementByAdmin::class, 'autocomplete'])->name('admin.user.autocomplete');

 // End user search and autocomplete function  
  
  // Brand
   Route::resource('marke', BrandController::class);
   
   
     // Model
   Route::resource('modell', ModelController::class);
   
   
        // Body Type
   Route::resource('fahrzeugtyp', BodyTypeController::class);
   
   
      // FuelType
   Route::resource('kraftstoffart', FuelTypeController::class);
   
   
   
         // TransmissionController
   Route::resource('getriebe', TransmissionController::class);
   
   
   
       // Color
   Route::resource('color', ColorController::class);
   
   
   
          // Color
   Route::resource('fahrzeugzustand', VehicleConditionController::class);
  
   
        // EmissionClass
   Route::resource('schadstoffklasse', EmissionClassController::class);
   
   
   
           // Feature category
   Route::resource('ausstattungcategory', FeatureCategoryController::class);
   
   
        // Feature
   Route::resource('ausstattung', FeatureController::class);
   
   
   
      // Auto images
   Route::resource('autobilder', AutoImageController::class);
   
   
   
      // Auto
   Route::resource('auto', AutoController::class);
  


    
});


    

  // End ADMIN Section
  // End ADMIN Section
  // End ADMIN Section



// Seller Middlewere Group
Route::group(['prefix'=>'seller', 'middleware'=> ['auth','seller', 'twofactor'] ], function(){
    
    Route::get('dashboard',[UserRoleController::class, 'sellerDashboard'])->name('seller.dashboard');
    Route::get('profile',[UserRoleController::class, 'sellerProfile'])->name('seller.profile');
});

// end Seller Middlewere Group


// start customer dashboard
// start customer dashboard
// start customer dashboard


Route::group(['prefix'=>'customer', 'middleware'=> ['auth','customer','custom.verified','role.redirect'] ], function(){
    
    
   
       
      // Routes requiring twofactor middleware
    Route::group(['middleware' => 'twofactor'], function() {
       
         
    Route::get('dashboard',[UserRoleController::class, 'customerDashboard'])->name('customer.dashboard');
    
     });


         // start customer user account
  
         Route::get('/user',[UserControllerForCustomer::class,'userIndex'])->name('userIndex');
        Route::get('/address',[UserControllerForCustomer::class,'userAddress'])->name('userAddress');
        Route::get('/account-detail',[UserControllerForCustomer::class,'useraccountDetail'])->name('useraccountDetail');


         
         //Route for Edit user account
          Route::get('/edit/user-account/{id}',[UserControllerForCustomer::class, 'editUserAccount'])->name('edit.user.account');
         // user account update
         Route::post('/update-account/{id}',[UserControllerForCustomer::class,'userUpdateAccount'])->name('user.accountupdate');
         

         
         Route::get('/account/delete', [UserControllerForCustomer::class, 'showDeleteForm'])->name('useraccount.delete.form');
         Route::post('/account/delete', [UserControllerForCustomer::class, 'deleteUserAccount'])->name('useraccount.delete');
    
    
    
          // Routes to enable/disable 2FA (these don't use twofactor middleware)        
    Route::post('/dashboard/enable2fa/{id}', [UserControllerForCustomer::class, 'enableTwoFactor'])->name('dashboard.customerenable2fa');
    Route::post('/dashboard/disable2fa/{id}', [UserControllerForCustomer::class, 'disableTwoFactor'])->name('dashboard.customerdisable2fa');


        

    
 });

// end customer dashboard
// end customer dashboard
// end customer dashboard



 // FRONTEND Section
 // FRONTEND Section
 // FRONTEND Section



Route::get('/', [FrontendIndexController::class,'home'])->name('fronthome');

Route::get('/dashboard',[UserRoleController::class, 'index'])->name('dashboard');


Route::get('/fahrzeugliste', [FrontendIndexController::class, 'FrontendFahrzeugListe'])
    ->name('fahrzeugliste');



