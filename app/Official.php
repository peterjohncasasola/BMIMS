<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Official extends Model
{
    protected $guarded = ['id'];

    public function incharge()
    {
        return $this->hasMany('App\Blotter');
    }
}
