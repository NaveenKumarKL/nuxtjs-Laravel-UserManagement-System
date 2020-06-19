<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'employeeid', 'name', 'joindate', 'designation', 'phone', 'image', 'imaged', 'imagedesd', 'address',
        'status', 'renumuration',
    ];
}