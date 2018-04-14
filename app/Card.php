<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 */
class Card extends Model
{
    use SoftDeletes, Uuids;
    public $incrementing = false;

    protected $connection = 'wilipay';

    public function customers()
    {
        return $this->belongsTo('App\Customer', 'user_id');
    }

    protected $fillable = [
        'user_id', 'brand', 'last4', 'exp_year', 'exp_month', 'country', 'source_id'
    ];

    protected $visible = ['brand', 'exp_year', 'exp_month', 'country', 'last4', 'id'];

    protected $dates = ['deleted_at'];
}
