<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Webpatser\Uuid\Uuid;
use App\Models\Comments;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Crypt;
use App\Models\Attachment;
use App\Models\PaymentDataHandling;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permisssion\Traits\HasRoles;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;

// use Illuminate\Database\Eloquent\Concerns\HasUuids;
// use Illuminate\Contracts\Auth\MustVerifyEmail;



class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, LogsActivity;

    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'password',
        'email',
        'contact_number',
        'state'
        //'otp',
        //'otp_generated_at'
    ];







    //new code for logActivity start
    protected static $logAttributes = ["name", "last_name", "email", "contact_number","state"];
    protected static $logOnlyDirty = true;
    protected static $logName = 'user';
    protected static $recordEvents = ["created", "updated", "deleted"];
    public function getActivitylogOptions(): LogOptions
    {
        $logOptions = LogOptions::defaults();

        $logOptions->logAttributes = static::$logAttributes;
        $logOptions->logOnlyDirty = static::$logOnlyDirty;
        $logOptions->logName = static::$logName;
        // The getDescriptionForEvent method allows you to customize the description of logged events.
        // It is defined in your User model, and here's how you can use it:
        // $logOptions->setDescriptionForEvent(function (string $eventName) {
        //     return "you have {$eventName} user";
        // });
        return $logOptions;
    }
    public function getDescriptionForEvent(string $eventName): string
    {
        return "you have {$eventName} user";
    }
    //new code for logActivity start 






    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function documents()
    // {
    //     return $this->hasOne(Document::class);
    // }

    public function attachment()
    {
        return $this->hasMany(Attachment::class);
    }

    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    public function paymentDataHandling()
    {
        return $this->hasMany(PaymentDataHandling::class, 'user_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }

    protected $encryptable = [

        // 'name',
        // 'last_name',
        // 'email',
        // 'contact_number'      


    ];


    public function setNameAttribute($value)
    {
        if (in_array('name', $this->encryptable)) {
            $this->attributes['name'] = ($value !== null && trim($value) !== '') ? Crypt::encryptString($value) : null;
        } else {
            $this->attributes['name'] = $value;
        }
    }

    public function getNameAttribute($value)
    {
        if (in_array('name', $this->encryptable)) {
            return ($value !== null && trim($value) !== '') ? Crypt::decryptString($value) : null;
        }
        return $value;
    }

    public function setLastNameAttribute($value)
    {
        if (in_array('last_name', $this->encryptable)) {
            $this->attributes['last_name'] = ($value !== null && trim($value) !== '') ? Crypt::encryptString($value) : null;
        } else {
            $this->attributes['last_name'] = $value;
        }
    }

    public function getLastNameAttribute($value)
    {
        if (in_array('last_name', $this->encryptable)) {
            return ($value !== null && trim($value) !== '') ? Crypt::decryptString($value) : null;
        }
        return $value;
    }

    //     public function setEmailAttribute($value)
// {

    //     if (in_array('email', $this->encryptable)) {
//         $this->attributes['email'] = ($value !== null && trim($value) !== '') ? Crypt::encryptString($value) : null;
//     } else {
//         $this->attributes['email'] = $value;
//     }
//     //$this->attributes['email'] = ($value !== null && trim($value) !== '') ? Crypt::encryptString($value) : null;
// }

    // public function getEmailAttribute($value)
// {
//     if (in_array('email', $this->encryptable)) {
//         return ($value !== null && trim($value) !== '') ? Crypt::decryptString($value) : null;
//     }
//     return $value;
//     //return ($value !== null && trim($value) !== '') ? Crypt::decryptString($value) : null;
// }

    public function setContactNumberAttribute($value)
    {
        if (in_array('contact_number', $this->encryptable)) {
            $this->attributes['contact_number'] = ($value !== null && trim($value) !== '') ? Crypt::encryptString($value) : null;
        } else {
            $this->attributes['contact_number'] = $value;
        }
    }

    public function getContactNumberAttribute($value)
    {
        if (in_array('contact_number', $this->encryptable)) {
            return ($value !== null && trim($value) !== '') ? Crypt::decryptString($value) : null;
        }
        return $value;
    }



    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::generate()->string;
        });

    }


}