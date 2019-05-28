<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    protected $guarded = ['id'];


    public function voter()
    {

        return $this->hasOne('App\Voter');
    }

    public function blotters()
    {
        return $this->hasMany('App\Blotter', 'complainant_residentid');
    }

    public function complained()
    {
        return $this->hasMany('App\Blotter', 'complained_residentid');
    }

    public function getResidentIdAttribute()
    {
        return $this->id;
    }
}
