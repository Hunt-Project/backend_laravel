<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nations extends Model {
    use HasFactory;

    protected $fillable = [
        'name',
    ];  
}

class Cities extends Model {
    use HasFactory;

    protected $fillable = [
        'name', 
        'nation_id'
    ];  
}
