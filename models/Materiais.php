<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiais extends Model
{
    use HasFactory;

    public function materiaisDevolvidos(){
        return $this->belongsTo(materiaisDevolvidos::class);
    }
    
    public function estoque(){
        return $this->belongsTo(estoque::class);
    }
}
