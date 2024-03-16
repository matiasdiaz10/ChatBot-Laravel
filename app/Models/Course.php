<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model{

    protected $table = "cursos";

    protected $fillable = [
        'nombre',
        'lenguaje'
    ];

}
