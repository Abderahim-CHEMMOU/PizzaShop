<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    

    public function user(){
        return $this->belongsTo(User::class);
    }

    function pizzas(){
        return $this->belongsToMany(Pizza::class)
        ->withPivot('qte');
    }
        
}
