<?php

namespace App\Model;

use App\Traits\UuId;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    static $ADMIN = 'admin';
    static $ORGANIZATION = 'organization';
    static $FAMILY = 'family';
    static $INDIVIDUAL = 'individual';

    use UuId;
    protected $guarded = ['id'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
