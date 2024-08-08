<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanDetails extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'loan_details';

    // Specify the primary key if it's not the default 'id'
    protected $primaryKey = 'id';

    // Allow mass assignment for these attributes
    protected $fillable = [
        'clientid',
        'num_of_payment',
        'first_payment_date',
        'last_payment_date',
        'loan_amount',
    ];

    // If you are using timestamps, make sure to set this to true
    public $timestamps = true;

}
