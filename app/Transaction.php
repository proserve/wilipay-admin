<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Transaction extends Model
{
    use SoftDeletes, Uuids;

    public $incrementing = false;

    protected $connection = 'wilipay';


    protected $fillable = [
        'purpose', 'beneficiary_id', 'type', 'amount', 'account_id'
    ];

    public function beneficiary()
    {
        return $this->belongsTo('App\Customer', 'beneficiary_id');
    }

    public function account()
    {
        return $this->belongsTo('App\Account');
    }

    protected $visible = [
        'purpose', 'beneficiary_id', 'type', 'amount', 'account_id', 'created_at', 'id', 'account'
    ];

    protected $dateFormat = 'Y-m-d H:i:sO';
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];
}
