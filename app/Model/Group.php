<?php

namespace App\Model;

use App\Traits\UuId;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use UuId;
    protected $guarded = ['id'];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
    public function familyAccount()
    {
        return $this->belongsTo(FamilyAccount::class);
    }
    public function users()
    {
        return $this->hasMany(UserAccount::class);
    }
}
