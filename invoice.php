<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    protected $fillable = [
        'clientid', 'invoicenumber', 'invoicetype', 'paymenttype', 'paymentstatus', 'totalamount', 'dueamount', 'status'

    ];
}