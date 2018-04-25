<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 * @property mixed $email
 * @property mixed $profile
 */
class Customer extends Authenticatable
{
    use SoftDeletes, Notifiable, Uuids, LogsActivity;

    protected static $logAttributes = ['name', 'email', 'phone', 'country_prefix', 'national_number', 'password', 'verified', 'blocked'];

    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Customer has been {$eventName}";
    }

    public $incrementing = false;

    protected $connection = 'wilipay';

    protected $table = 'users';

    public function profile()
    {
        return $this->hasOne('App\Profile', 'user_id');
    }

    public function accounts()
    {
        return $this->hasMany('App\Account', 'user_id');
    }

    public function transactions()
    {
        return $this->hasManyThrough(
            'App\Transaction',
            'App\Account',
            'user_id',
            'account_id',
            'id',
            'id');
    }

    public function AauthAcessToken()
    {
        return $this->hasMany('App\OauthAccessToken');
    }

    public function cards()
    {
        return $this->hasMany('App\Card', 'user_id');
    }

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name', 'email', 'phone', 'country_prefix', 'national_number', 'password',
    ];

    protected $hidden = ['password', 'remember_token'];

//    protected $visible = ['email', 'phone', 'national_phone', 'profile', 'accounts', 'cards'];

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }
}
