<?php

namespace App\Models\customers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\customers\Contact;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'cpf_cnpj',
        'rg_ie',
        'name',
        'gender',
        'email',
        'phone',
        'cellphone',
        'address',
        'neighborhood',
        'number',
        'city',
        'state',
        'zip'
    ];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
    
}
