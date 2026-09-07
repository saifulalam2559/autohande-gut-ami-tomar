<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountDeletion extends Model
{
    use HasFactory;
    protected $table = 'account_deletions';

    protected $fillable = [
        'user_id',
        'deleted_at',
        'kundennummer',
        'reason',  // If you collect the reason from the user
        'ip_address',
        'browser_details',
    ];
    
    
}
