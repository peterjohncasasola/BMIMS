<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Voter extends Model
{
    protected $guarded = ['id'];

    public function resident()
    {
        return $this->belongsTo('App\Resident', 'resident_id');
    }
}
