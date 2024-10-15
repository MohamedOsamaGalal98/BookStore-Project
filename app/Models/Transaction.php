<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_name',
        'user_email',
        'InvoiceId',
        'InvoiceStatus',
        'InvoiceReference',
        'InvoiceValue',
        'TransactionDate',
        'PaymentGateway',
        'ReferenceId',
        'TrackId',
        'TransactionId',
        'PaymentId',
        'AuthorizationId',
        'TransactionStatus',
        'TransationValue',
        'PaidCurrency',
        'IpAddress',
    ];

    public function users() 
    {
        return $this->belongsTo('App\Models\User');
    }


}
