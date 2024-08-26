<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use WisdomDiala\Countrypkg\Models\Country;
use WisdomDiala\Countrypkg\Models\State;

class Atm extends Model
{
    use HasFactory;
 
    protected $guarded=[];
  
    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function countrie()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
