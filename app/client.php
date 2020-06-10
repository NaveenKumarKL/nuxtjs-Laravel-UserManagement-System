<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    protected $fillable = [
        'companyname', 'cid', 'address', 'phone', 'servicename', 'poc',
        'themename', 'licencecode', 'renewaldate',
    ];
}