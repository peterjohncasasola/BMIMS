<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Blotter extends Model
{
    protected $guarded = ['id'];

    public function complained()
    {
        return $this->belongsTo('App\Resident', 'complained_residentid');
    }

    public function complainant()
    {
        return $this->belongsTo('App\Resident', 'complainant_residentid');
    }

    public function officer()
    {
        return $this->belongsTo('App\Official', 'officer_residentid');
    }
}
