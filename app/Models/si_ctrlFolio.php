<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class si_ctrlFolio extends Model
{
    

   protected $table = 'si_ctrl_folio';
   protected $primaryKey = 'id';

   protected $fillable = [
        'curp'
    ];

    public $timestamps = true;
    public $incrementing = false;
}
