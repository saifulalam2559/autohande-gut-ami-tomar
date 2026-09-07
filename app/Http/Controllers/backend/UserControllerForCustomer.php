<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AccountDeletion;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Image;
use PDF;
use App\Notifications\TwoFactorCode;
use HTMLPurifier;
use HTMLPurifier_Config;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Returntable;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Services\DHLService;
use Carbon\Carbon;
use App\Notifications\AccountDeleted; // For sending the notification
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;






class UserControllerForCustomer extends Controller {
    
        protected $dhlService;
        
        public function __construct(DHLService $dhlService) {
            
        $this->dhlService = $dhlService;
        $this->middleware('auth');
        
    }
    

       public function userIndex() {

         $user = User::where('id',Auth::user()->id)->get(); 
        return view('backend.customer.user.index', compact('user'));
    }
    
    
    
         public function userAddress() {
        
         $user = Auth::user();
        // dd($user);
        
         return view('backend.customer.user.address', compact('user'));
        
    }
    
    
            public function useraccountDetail() {
        
         $user = Auth::user();
        // dd($user);
        
         return view('frontend.user.account_detail', compact('user'));
        
    }
    
    
        private function purifier() {
        // Create a new HTMLPurifier configuration
        $config = HTMLPurifier_Config::createDefault();
        
        // Add any configuration options here, if needed
        // For example: $config->set('HTML.Allowed', 'p,b,a[href],i'); // Allow specific tags

        return new HTMLPurifier($config);
    }
    
    
      
    
    public function userBillingAddress(Request $request, $id) {
        
        $user = User::findOrFail($id);

        // Sanitize the inputs
        $purifier = $this->purifier();
        $user->first_name = $purifier->purify($request->first_name);
        $user->last_name = $purifier->purify($request->last_name);
        $user->street_and_number = $purifier->purify($request->street_and_number);
        $user->postcode = $purifier->purify($request->postcode);
        $user->city = $purifier->purify($request->city);
        $user->state = $purifier->purify($request->state);
        $user->country = $purifier->purify($request->country);
        $user->phone = $purifier->purify($request->phone);
        $user->house_no = $purifier->purify($request->house_no);

        if ($user->save()) {
            return back()->with('success', 'Rechnungsadresse erfolgreich aktualisiert!');
        } else {
            return back()->with('error', 'Da stimmt etwas nicht!');
        }
    }

    public function userShippingAddress(Request $request, $id) {
        
        $user = User::findOrFail($id);

        // Sanitize the inputs
        $purifier = $this->purifier();
        $user->sfirst_name = $purifier->purify($request->sfirst_name);
        $user->slast_name = $purifier->purify($request->slast_name);
        $user->sstreet_and_number = $purifier->purify($request->sstreet_and_number);
        $user->spostcode = $purifier->purify($request->spostcode);
        $user->scity = $purifier->purify($request->scity);
        $user->sstate = $purifier->purify($request->sstate);
        $user->scountry = $purifier->purify($request->scountry);
        $user->sphone = $purifier->purify($request->sphone);
        $user->shouse_no = $purifier->purify($request->shouse_no);

        if ($user->save()) {
            return back()->with('success', 'Lieferadresse erfolgreich aktualisiert!');
        } else {
            return back()->with('error', 'Da stimmt etwas nicht!');
        }
    }
    
    
    
        public function editUserAccount($id) {
        
        $user = User::where('id', $id)->first();
     
        return view('backend.customer.user.edit', compact('user',));
        
    }

    
    
 public function userUpdateAccount(Request $request, $id) {
    $this->validate($request, [
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'phone' => 'required', 
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:500', 
        'newpassword' => 'nullable|min:8',
    ], [
        'first_name.required' => 'Vorname ist erforderlich.',
        'first_name.string' => 'Vorname muss ein gültiger Text sein.',
        'last_name.required' => 'Nachname ist erforderlich.',
        'last_name.string' => 'Der Nachname muss ein gültiger Text sein.',
        'phone.required' => 'Telefonnummer ist erforderlich.',
        'photo.image' => 'Die hochgeladene Datei muss ein Bild sein.',
        'photo.mimes' => 'Erlaubte Bildformate: jpeg, png, jpg, gif, svg.',
        'photo.max' => 'Die Bildgröße darf 500 KB nicht überschreiten.',
        'newpassword.min' => 'Das Passwort muss mindestens 8 Zeichen lang sein.',
    ]);

    $user = User::findOrFail($id);
    $hashpassword = $user->password;

    // Sanitize the inputs
    $purifier = $this->purifier();
    $first_name = $purifier->purify($request->first_name);
    $last_name = $purifier->purify($request->last_name);
    $phone = $purifier->purify($request->phone);

    // Handle Image Upload
    if ($request->hasFile('photo')) {
        $image = $request->file('photo');
        
                // Validate image file with getimagesize() to check if it's a real image
        $imageSize = getimagesize($image);
        if ($imageSize === false) {
            // Not a valid image
            return redirect()->back()->with('error', 'Die hochgeladene Datei ist keine gültige Bilddatei.');
        }
        
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('images/users/');

        // Create directory if not exists
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        // Resize and Save Image
        $resizedImage = Image::make($image)->resize(300, 300);
        $resizedImage->save($destinationPath . '/' . $imageName);

        // Delete the old photo if exists
        if ($user->photo && file_exists(public_path('images/users/' . $user->photo))) {
            unlink(public_path('images/users/' . $user->photo));
        }

        // Save new photo in DB
        $user->photo = $imageName;
    }

    // Update user details
    $user->first_name = $first_name;
    $user->last_name = $last_name;
    $user->phone = $phone;

    // Handle password update
    if ($request->oldpassword && $request->newpassword) {
        if (\Hash::check($request->oldpassword, $hashpassword)) {   
            if (!\Hash::check($request->newpassword, $hashpassword)) {                
                $user->password = Hash::make($request->newpassword);
            } else {
                return back()->with('error', 'Das neue Passwort darf nicht mit dem alten Passwort identisch sein!');
            }
        } else {
            return back()->with('error', 'Altes Passwort stimmt nicht überein!');
        }
    }

    // Save user data
    $user->save();

    return back()->with('success', 'Konto erfolgreich aktualisiert!');
}




    
    
    
       // Show Delete Account Page
    public function showDeleteForm()
    {
        return view('backend.customer.user.delete');
    }
    
    
    // Handle Account Deletion
    public function deleteUserAccount(Request $request)
    {
        $request->validate([
            'password' => 'required',
            
        ]);

        $user = Auth::user();

        // Check Password
        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Falsches Passwort.');
        }
        
        
         // Retrieve kundennummer from the latest order of the user
     // Kundennummer generation
    $prefix = 'EEK'; // Example prefix
    $year = Carbon::now()->format('y'); // Current year (e.g., "24")

    // Start a database transaction to prevent race conditions
    DB::beginTransaction();
    try {
        // Get the sequence record and lock it for update to prevent race conditions
        $sequenceRecord = \App\Models\KundennummerSequence::where('prefix', $prefix)
            ->lockForUpdate()
            ->first();

        if (!$sequenceRecord) {
            // Create a new record if none exists
            $sequenceRecord = \App\Models\KundennummerSequence::create([
                'prefix' => $prefix,
                'last_sequence' => 0
            ]);
        }

        // Increment the sequence safely
        $sequence = $sequenceRecord->last_sequence ;
        $sequenceRecord->last_sequence = $sequence;
        $sequenceRecord->save();

        // Generate the kundennummer
        $kundennummer = "{$year}{$prefix}" . str_pad($sequence, 7, '0', STR_PAD_LEFT);

        // Commit the transaction after updating kundennummer_sequences
        DB::commit();

    } catch (\Exception $e) {
        // Rollback in case of error
        DB::rollBack();
        throw $e;
    }
    
    // end Kundennummer generation
        
        
            // Sanitize the inputs
           $purifier = $this->purifier();

        // Store deletion info in the account_deletions table
        AccountDeletion::create([
            'user_id' => Auth::user()->id,
            'kundennummer' => $kundennummer,
            'reason' => $purifier->purify($request->input('reason')),
            'deleted_at' => now(),
            'ip_address' => $request->ip(), // Capture the IP address
            'browser_details' => $request->header('User-Agent'), // Capture browser details
        ]);
        
        
        
        // Send notification to admin about the deletion
        $adminUsers = User::where('role', 'admin')->get();
        Notification::send($adminUsers, new AccountDeleted($user));

        // Delete the user photo if it exists
        if ($user->photo && file_exists(public_path('images/users/' . $user->photo))) {
            unlink(public_path('images/users/' . $user->photo));
        }

        // Delete the user account
        $user->delete();


        return redirect('login')->with('success', ' Ihr Konto wurde erfolgreich gelöscht.');
        
        
    }

    


    
       // Enable Two-Factor Authentication for a specific user
    public function enableTwoFactor(Request $request, $userId)
    {
        $user = User::findOrFail($userId); // Find the user by ID

         // Check if two-factor authentication is enabled
    if ($user->two_factor_enabled == 1) {
        $user->generateTwoFactorCode();
        $user->notify(new TwoFactorCode());
    }
        // Enable two-factor authentication
        $user->two_factor_enabled = true;
        $user->save();

        return redirect()->back()->with('success', 'Zwei-Faktor Authentifizierung aktiviert für ' . $user->first_name . ' '.$user->last_name );
    }

    // Disable Two-Factor Authentication for a specific user
    public function disableTwoFactor(Request $request, $userId)
    {
        
        
        $user = User::findOrFail($userId); // Find the user by ID

        // Disable two-factor authentication
        $user->two_factor_enabled = false;
        $user->resetTwoFactorCode();
        $user->save();

        return redirect()->back()->with('error', 'Zwei-Faktor Authentifizierung deaktiviert für ' . $user->first_name . ' '.$user->last_name);
    }
    
    
    




    
    

    



       
       






    
} // END