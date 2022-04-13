<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoModel extends Model
{
    use HasFactory;
    protected $table = 'images';
    protected $primaryKey = 'photo_id';
    protected $fillable = ['photo_id', 'photo_name', 'size', 'created_at', 'updated_at'];

    // public function getPhoto()
    // {
    //     return $this->select('photo_id', 'photo_name')
    //         ->get();
    // }
}
