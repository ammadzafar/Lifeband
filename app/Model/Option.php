<?php

namespace App\Model;

use App\Traits\UuId;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use UuId;
    protected $guarded = ['id'];

    public function question()
    {
        return $this->belongsTo(Questionnaire::class);
    }
}
