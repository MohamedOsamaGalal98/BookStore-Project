<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'Customer_id',
        'CustomerName',
        'CustomerEmail',
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


}
