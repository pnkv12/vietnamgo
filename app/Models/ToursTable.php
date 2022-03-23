<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToursTable extends Model
{
    use HasFactory;
    protected $table = 'tours';
    protected $primaryKey = 'id';
    protected $fillables = ['id', 'tour_code', 'name', 'departure', 'return', 'price', 'vehicle', 'details', 'slots', 'created_at', 'updated_at'];


    public function viewList()
    {
        $data = $this->select(
            'tours.id',
            'tour_code',
            'name',
            'departure',
            'return',
            'price',
            'vehicle',
            'details',
            'slots',
            'created_at',
            'updated_at',
            'c.cate_name'
        )
            ->leftjoin('category as c', 'tours.id', '=', 'c.id')
            ->orderBy('id', 'DESC')
            ->orderBy('slots', 'ASC');
        return $data->latest()->paginate(6);
    }

    public function showTour($id)
    {
        $data = $this->select(
            'id',
            'tour_code',
            'name',
            'departure',
            'return',
            'price',
            'vehicle',
            'details',
            'slots',
        )
            ->where('id', $id);
        return $data->first();
    }

    public function getTravel()
    {
        return $this->select('*')
            ->paginate(3);
    }

    public function getLimit()
    {
        return $this->select('slots')
            ->get();
    }
}
