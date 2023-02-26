<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    use HasFactory;
//    use SoftDelets; 

    public function commandes(){
        return $this->belongsToMany(Commande::class)
        ->withPivot('qte');
    }

    
}
