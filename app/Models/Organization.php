<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $table = 'organizations';
    protected $primary_key  ='id';
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'address',
        'type',
        'estd',
        'vat_no',
    ];
}
