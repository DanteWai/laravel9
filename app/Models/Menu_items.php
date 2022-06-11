<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu_items extends Model
{
    use HasFactory;

    protected $table = 'menu_items';
    protected $guarded = [];
    public $timestamps = false;
}
