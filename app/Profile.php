<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property mixed $user
 */
class Profile extends Model
{
    use SoftDeletes, Uuids;

    public $incrementing = false;

    protected $connection = 'wilipay';

    public function customer()
    {
        return $this->belongsTo('App\Customer', 'user_id');
    }

    protected $dateFormat = 'Y-m-d H:i:sO';
    protected $visible = ['first_name', 'last_name', 'birthday',
        'gender', 'avatar_url', 'country', 'region', 'city', 'postal_code', 'street', 'language'];
    protected $dates = ['deleted_at'];
    protected $guarded = ['user_id'];
}
