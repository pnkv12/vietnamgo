<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentModel extends Model
{
    use HasFactory;
    protected $table = 'news';
    protected $primaryKey = 'id';
    protected $fillables = ['id', 'title', 'content', 'category_id', 'author', 'photo_id', 'created_at', 'updated_at', 'is_shown', 'views'];

    public function contentList()
    {
        $data = $this->select('*')
            ->leftjoin('images as i', 'news.photo_id', '=', 'i.photo_id')
            ->where('is_shown', 0);
        return $data->get();
    }

    public function showContent($id)
    {
        $data = $this->select(
            'news.id',
            'news.title',
            'news.content',
            'news.category_id',
            'news.author',
            'news.created_at',
            'news.updated_at',
            'news.is_shown',
            'news.views',
            'c.cate_name',
            'i.photo_id',
            'i.photo_name'
        )
            ->leftjoin('images as i', 'news.photo_id', '=', 'i.photo_id')
            ->leftjoin('category as c', 'news.category_id', '=', 'c.id')
            ->where('news.id', $id);
        return $data->first();
    }
}
