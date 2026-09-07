<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail; 
use App\Mail\VerificationEmail;
use HTMLPurifier;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class RegisterController extends Controller
{
    use RegistersUsers;

    protected $purifier;

    public function __construct(HTMLPurifier $purifier)
    {
        $this->middleware('guest');
        $this->purifier = $purifier; // Injecting HTMLPurifier
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

   protected function create(array $data)
{
    // Validate input data, including ensuring kundennummer is unique
    $this->validate(request(), [
        'email' => 'required|string|email|max:255|unique:users',
    ]);

    // Sanitize input data
    $firstName = $this->purifier->purify($data['first_name']);
    $lastName = $this->purifier->purify($data['last_name']);
    $email = $this->purifier->purify($data['email']);
    $password = Hash::make($data['password']); // Hashing the password

    // Generate a random verification code
    $verificationCode = rand(100000, 999999);
    $expiresAt = now()->addMinutes(15);

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
        $sequence = $sequenceRecord->last_sequence + 1;
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

    // Proceed with user creation
    $user = User::create([
        'first_name' => $firstName,
        'last_name' => $lastName,
        'email' => $email,
        'password' => $password,
        'role' => 'customer',
        'verification_code' => $verificationCode,
        'expires_at' => $expiresAt,
        'kundennummer' => $kundennummer,
    ]);

    // Send the verification email
    $this->sendVerificationEmail($user);

    return $user;
}
    

    protected function registered($request, $user)
    {
        // Prevent automatic login and redirect to the verification form
        return redirect()->route('verification.form')->with('email', $user->email);
    }

    protected function sendVerificationEmail(User $user)
    {
        // You can use Laravel's Mail system to send the email
        Mail::to($user->email)->send(new VerificationEmail($user));
    }
}
