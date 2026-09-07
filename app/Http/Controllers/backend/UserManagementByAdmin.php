<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Notifications\TwoFactorCode;
use HTMLPurifier;
use HTMLPurifier_Config;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;



class UserManagementByAdmin extends Controller {

    public function __construct() {

        $this->middleware('auth');
    }
    
            private function purifier() {
        // Create a new HTMLPurifier configuration
        $config = HTMLPurifier_Config::createDefault();
        
        // Add any configuration options here, if needed
        // For example: $config->set('HTML.Allowed', 'p,b,a[href],i'); // Allow specific tags

        return new HTMLPurifier($config);
    }
    

    public function index() {

        $users = User::orderBy('id', 'DESC')->paginate(10);
        return view('backend.user.index', compact('users'));
    }

    public function userStatus(Request $request) {


        if ($request->modeUserControl == 'true') {

            User::where('id', $request->id)->update(['status' => 'active']);
        } else {

            User::where('id', $request->id)->update(['status' => 'inactive']);
        }

        return response()->json(['msg' => 'Successfully Status Updated', 'status' => true]);
    }

   



public function search(Request $request) {
    $query = User::query();

    if ($request->filled('kundennummer')) {
        $query->where('kundennummer', 'LIKE', "%{$request->kundennummer}%");
    }

    if ($request->filled('email')) {
        $query->where('email', 'LIKE', "%{$request->email}%");
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }
    
    if ($request->filled('has_admin_note')) {
        if ($request->has_admin_note === 'yes') {
            $query->whereNotNull('admin_note')->where('admin_note', '!=', '');
        } elseif ($request->has_admin_note === 'no') {
            $query->where(function ($q) {
                $q->whereNull('admin_note')->orWhere('admin_note', '');
            });
        }
    }

    if ($request->filled('email_verified_at')) {
        if ($request->email_verified_at === 'yes') {
            $query->whereNotNull('email_verified_at');
        } elseif ($request->email_verified_at === 'no') {
            $query->whereNull('email_verified_at');
        }
    }

    $users = $query->orderBy('id', 'DESC')->paginate(10);

    return view('backend.user.index', compact('users'));
}

    
    
    
    
        public function autocomplete(Request $request) {
           $search = $request->get('term');
           $field = $request->get('field'); // Get the field type (kundennummer or email)

           $query = User::query();

           if ($field === 'kundennummer') {
               $users = $query->where('kundennummer', 'LIKE', "%{$search}%")
                              ->limit(10)
                              ->get(['kundennummer']);
           } elseif ($field === 'email') {
               $users = $query->where('email', 'LIKE', "%{$search}%")
                              ->limit(10)
                              ->get(['email']);
           } else {
               // Return empty if no field is specified
               return response()->json([]);
           }

           // Format results based on the field
           $results = $users->map(function ($user) use ($field) {
               return ['label' => $user[$field], 'value' => $user[$field]];
           });

           return response()->json($results);
       }






    public function create() {
        return view('backend.user.create');
    }

    public function store(Request $request) {

        $this->validate($request, [
            'first_name' => 'string|required ',
            'last_name' => 'string|required ',
            'photo' => 'required',
            'email' => 'email|required|unique:users,email',
            'password' => 'min:4|required',
            'phone' => 'string|nullable',
            'role' => 'required|in:admin,customer,seller',
            'status' => 'nullable|in:active,inactive',
                ],
        );

        $data = $request->all();
        $data['password'] = Hash::make($request->password);




       $image = $request->file('photo');

        if ($image) {

            $image_one = uniqid() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/users/');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $manager = new ImageManager(new Driver());

            $resizedImage = $manager->decode($image);

            // Resize while keeping aspect ratio
            $resizedImage->scale(height: 800);

            $resizedImage->save($destinationPath . $image_one);

            $data['photo'] = $image_one;

            $status = User::create($data);

            if ($status) {
                return redirect()->route('usermanagement.index')
                    ->with('success', 'User has been created successfully!');
            }

            return redirect()->back()->with('error', 'Something went wrong');
        }
        
        
    }

    
    
    public function show($id) {
        //
    }

    public function edit($id) {



        $user = User::find($id);

        if ($user) {

            return view('backend.user.edit', compact('user'));
        } else {

            return back()->with('error', 'Data not found!!');
        }
    }

    public function update(Request $request, $id) {

        $user = User::find($id);

        if ($user) {


                $this->validate($request, [
                    'first_name' => 'required|string',
                    'last_name' => 'required|string',
                    'phone' => 'nullable', 
                    'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:500', 
                    'newpassword' => 'nullable|min:8',
                ], [
                    'first_name.required' => 'Vorname ist erforderlich.',
                    'first_name.string' => 'Vorname muss ein gültiger Text sein.',
                    'last_name.required' => 'Nachname ist erforderlich.',
                    'last_name.string' => 'Der Nachname muss ein gültiger Text sein.',
                    
                    'photo.image' => 'Die hochgeladene Datei muss ein Bild sein.',
                    'photo.mimes' => 'Erlaubte Bildformate: jpeg, png, jpg, gif, svg.',
                    'photo.max' => 'Die Bildgröße darf 500 KB nicht überschreiten.',
                    'newpassword.min' => 'Das Passwort muss mindestens 8 Zeichen lang sein.',
                    'newpassword.confirmed' => 'Passwörter stimmen nicht überein.',
                ]);

                $user = User::findOrFail($id);
                $user->password;
                $user->admin_note = $request->admin_note;

                // Sanitize the inputs
                $purifier = $this->purifier();
                $first_name = $purifier->purify($request->first_name);
                $last_name = $purifier->purify($request->last_name);
                $phone = $purifier->purify($request->phone);

                // Handle Image Upload
               if ($request->hasFile('photo')) {

                    $image = $request->file('photo');

                    $imageSize = getimagesize($image);

                    if ($imageSize === false) {
                        return redirect()->back()
                            ->with('error', 'Die hochgeladene Datei ist keine gültige Bilddatei.');
                    }

                    $imageName = time() . '.' . $image->getClientOriginalExtension();

                    $destinationPath = public_path('images/users/');

                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }


                    $manager = new ImageManager(new Driver());

                    $resizedImage = $manager->decode($image);

                    $resizedImage->cover(300, 300);

                    $resizedImage->save($destinationPath . $imageName);


                    if ($user->photo && file_exists($destinationPath . $user->photo)) {
                        unlink($destinationPath . $user->photo);
                    }

                    $user->photo = $imageName;
                }

                // Update user details
                $user->first_name = $first_name;
                $user->last_name = $last_name;
                $user->phone = $phone;
                
                // Handle password update if provided
                if (!empty($request->newpassword)) {
                    $user->password = Hash::make($request->newpassword);
                }
                
                


                // Save user data
                $user->save();
                return redirect()->route('usermanagement.index')->with('success', 'User update has been created successfully !');
            } else {

            return back()->with('error', 'Data not found!!');
        }
    }

public function destroy($id)
{
    $user = User::find($id);

    if (!$user) {
        return back()->with('error', 'User not found!');
    }

    if ($user->photo && file_exists(public_path('images/users/' . $user->photo))) {
        unlink(public_path('images/users/' . $user->photo));
    }

    $user->delete();

    return redirect()->route('usermanagement.index')
        ->with('success', 'User has been deleted successfully!');
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

        return redirect()->back()->with('success', 'Two-factor authentication enabled for ' . $user->first_name . '  '.$user->last_name);
    }

    // Disable Two-Factor Authentication for a specific user
    public function disableTwoFactor(Request $request, $userId)
    {
        $user = User::findOrFail($userId); // Find the user by ID

        // Disable two-factor authentication
        $user->two_factor_enabled = false;
        $user->resetTwoFactorCode();
        $user->save();

        return redirect()->back()->with('error', 'Two-factor authentication disabled for ' . $user->first_name . '  '.$user->last_name);
    }
    
    


}