<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\CustomResetPasswordNotification;
use App\Models\AccountDeletion;
use Illuminate\Database\Eloquent\Relations\HasOne; 


class User extends Authenticatable
{
    
            public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->encryptionKey = config('app.encryption_key');
    }
    
    
    // data was not displaying after the command php artisan config:clear
    
//        public function __construct(array $attributes = [])
//    {
//        parent::__construct($attributes);
//        $this->encryptionKey = env('ENCRYPTION_KEY'); // Fetches the key from the .env file
//    }
    
    

    
    use HasApiTokens, HasFactory, Notifiable;

    protected $encryptionKey;



    protected $fillable = [

        'first_name',
        'last_name',
        'company',
        'photo',
        'email',
        'password',
        'phone',
        'role',
        'status',
        'country',
        'city',
        'postcode',
        'state',
        'street_and_number',
        'sfirst_name',
        'slast_name',
        'scompany',
        'scountry',
        'scity',
        'spostcode',
        'sstate',
        'sstreet_and_number',
        'sphone' ,
        
        
        'two_factor_code',
        'two_factor_expires_at',
        'two_factor_enabled',
        
        'verification_code',
        'expires_at',
        'email_verified_at',
        'kundennummer',
        'house_no',
        'shouse_no',
        'admin_note',
    ];

        protected $dates = [
              'updated_at',
              'created_at',
              'two_factor_expires_at',
          ];

          protected $hidden = [
              'password',
              'remember_token',

          ];


          protected $casts = [
              'email_verified_at' => 'datetime',
              'password' => 'hashed',
          ];
    
    
    
            /**
            * Generate 6 digits MFA code for the User
            */
           public function generateTwoFactorCode()
           {
               $this->timestamps = false; //Dont update the 'updated_at' field yet

               $this->two_factor_code = rand(100000, 999999);
               $this->two_factor_expires_at = now()->addMinutes(10);
               $this->save();
           }

           /**
            * Reset the MFA code generated earlier
            */
           public function resetTwoFactorCode()
           {
               $this->timestamps = false; //Dont update the 'updated_at' field yet

               $this->two_factor_code = null;
               $this->two_factor_expires_at = null;
               $this->save();
           }



              public function yesAdmin() {

                     return $this->role == 'admin' ;

                   }


                 public function yesSeller() {

                     return $this->role == 'seller' ;

                   }

                     public function yesCustomer() {

                   return $this->role == 'customer' ;

                 }



            /**
            * encryption started
            */

    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = $this->encrypt($value);
    }

    public function getPhoneAttribute($value)
    {
        return $this->decrypt($value);
    }

    public function setCountryAttribute($value)
    {
        $this->attributes['country'] = $this->encrypt($value);
    }
      

    public function getCountryAttribute($value)
    {
        return $this->decrypt($value);
    }

    public function setCityAttribute($value)
    {
        $this->attributes['city'] = $this->encrypt($value);
    }

    public function getCityAttribute($value)
    {
        return $this->decrypt($value);
    }
    
    
        public function setPostcodeAttribute($value)
    {
        $this->attributes['postcode'] = $this->encrypt($value);
    }
    
            public function getPostcodeAttribute($value)
    {
        return $this->decrypt($value);
    }
    

            public function setStateAttribute($value)
    {
       $this->attributes['state'] = $this->encrypt($value);
    }
    
            public function getStateAttribute($value)
    {
        return $this->decrypt($value);
    }
    
    
            public function setStreetAndNumberAttribute($value)
         {
             $this->attributes['street_and_number'] = $this->encrypt($value);
         }

         public function getStreetAndNumberAttribute($value)
         {
             return $this->decrypt($value);
         }


    // Shipping address
         
      public function setSphoneAttribute($value)
    {
        $this->attributes['sphone'] = $this->encrypt($value);
    }

    public function getSphoneAttribute($value)
    {
        return $this->decrypt($value);
    }

    public function setScountryAttribute($value)
    {
        $this->attributes['scountry'] = $this->encrypt($value);
    }
      

    public function getScountryAttribute($value)
    {
        return $this->decrypt($value);
    }

    public function setScityAttribute($value)
    {
        $this->attributes['scity'] = $this->encrypt($value);
    }

    public function getScityAttribute($value)
    {
        return $this->decrypt($value);
    }
    
    
        public function setSpostcodeAttribute($value)
    {
        $this->attributes['spostcode'] = $this->encrypt($value);
    }
    
            public function getSpostcodeAttribute($value)
    {
        return $this->decrypt($value);
    }
    

            public function setSstateAttribute($value)
    {
       $this->attributes['sstate'] = $this->encrypt($value);
    }
    
            public function getSstateAttribute($value)
    {
        return $this->decrypt($value);
    }
    
    
            public function setSstreetAndNumberAttribute($value)
         {
             $this->attributes['sstreet_and_number'] = $this->encrypt($value);
         }

         public function getSstreetAndNumberAttribute($value)
         {
             return $this->decrypt($value);
         }
         
         
         // house_no
         
                     public function setHouseNoAttribute($value)
            {
               $this->attributes['house_no'] = $this->encrypt($value);
            }

                    public function getHouseNoAttribute($value)
            {
                return $this->decrypt($value);
            }
            
            
               public function setShouseNoAttribute($value)
            {
               $this->attributes['shouse_no'] = $this->encrypt($value);
            }

                    public function getShouseNoAttribute($value)
            {
                return $this->decrypt($value);
            }
    



         // end shipping 

            private function encrypt($data)
         {
             $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
             $encrypted = openssl_encrypt($data, 'aes-256-cbc', $this->encryptionKey, 0, $iv);
             return base64_encode($encrypted . '::' . $iv);
         }

         private function decrypt($data)
            {
                if (empty($data)) {
                    return null; // Return null if data is empty
                }

                $decodedData = base64_decode($data);
                if ($decodedData === false) {
                    return null; // Handle invalid base64 data
                }

                $parts = explode('::', $decodedData, 2);
                if (count($parts) !== 2) {
                    return null; // Handle invalid encrypted data format
                }

                list($encrypted_data, $iv) = $parts;

                return openssl_decrypt($encrypted_data, 'aes-256-cbc', $this->encryptionKey, 0, $iv);
            }

    
            /**
            * encryption ended
            */
    
                public function sendPasswordResetNotification($token)
            {
                $this->notify(new CustomResetPasswordNotification($token));
            }
            
          

            
            
            public function accountdelete(): HasOne
    {
        return $this->hasOne(AccountDeletion::class, 'user_id');
    }
    
    
    
    
            public function tickets()
        {
            return $this->hasMany(Ticket::class, 'user_id');
        }

            
           public function ifItAdmin() {

          return $this->role == 'admin' ;
          
        }    
        
        
          public function ifItCustomer() {

          return $this->role == 'customer' ;
          
        }   
            
            
    
}