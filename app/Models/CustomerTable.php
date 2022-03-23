<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerTable extends Model
{
    use HasFactory;
    protected $table = 'customers';         //Tên table
    protected $primaryKey = 'cus_id'; //Tên khóa chính
    protected $fillable = [
        'cus_id',
        'firstname',
        'lastname',
        'email',
        'phone',
        'address',
        'members',
        'notes',
        'created_at',
        'updated_at'
    ];

    public function storeCus($customer)
    {
        return $this->create($customer)->{$this->primaryKey};
    }
}
