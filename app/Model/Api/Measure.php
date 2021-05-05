<?php

namespace App\Model\Api;

use App\Traits\UuId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Measure extends Model
{
    use UuId,SoftDeletes;
    protected $guarded = ['id'];
}
