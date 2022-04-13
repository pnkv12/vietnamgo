<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToursTable extends Model
{
    use HasFactory;
    protected $table = 'tours';
    protected $primaryKey = 'id';
    protected $fillables = ['id', 'photo_id', 'tour_code', 'name', 'departure', 'return', 'price', 'vehicle', 'details', 'slots', 'created_at', 'updated_at'];


    public function viewList()
    {
        $data = $this->select(
            'tours.id',
            'tours.photo_id',
            'tours.tour_code',
            'tours.name',
            'tours.departure',
            'tours.return',
            'tours.price',
            'tours.vehicle',
            'tours.details',
            'tours.slots',
            'tours.created_at',
            'tours.updated_at',
            'c.cate_name',
            'i.photo_id',
            'i.photo_name'
        )
            ->leftjoin('category as c', 'tours.id', '=', 'c.id')
            ->leftjoin('images as i', 'tours.photo_id', '=', 'i.photo_id')
            ->orderBy('id', 'DESC')
            ->orderBy('slots', 'ASC');
        return $data->latest()->paginate(6);
    }

    public function showTour($id)
    {
        $data = $this->select(
            'tours.id',
            'tours.photo_id',
            'tours.tour_code',
            'tours.name',
            'tours.departure',
            'tours.return',
            'tours.price',
            'tours.vehicle',
            'tours.details',
            'tours.slots',
            'i.photo_name'
        )
            ->leftjoin('images as i', 'tours.photo_id', '=', 'i.photo_id')
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
