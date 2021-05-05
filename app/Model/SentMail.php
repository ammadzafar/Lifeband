<?php

namespace App\Model;

use App\Traits\UuId;
use Illuminate\Database\Eloquent\Model;

class SentMail extends Model
{
    use UuId;
    protected $guarded = ['id'];
}
