<?php

namespace App\Http\Controllers;

use App\Models\ContentModel;
use App\Models\ToursTable;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    protected $__content;
    protected $__travel;

    public function __construct(ToursTable $travel, ContentModel $content)
    {
        $this->__travel = $travel;
        $this->__content = $content;
    }
    public function showHomepage(Request $request)
    {
        $id = $request->id;
        $data = $this->__content->contentList($id);

        $travelTable = app(ToursTable::class);
        $travelItem  = $travelTable->getTravel();

        return view('home', ['data' => $data, 'travelItem' => $travelItem]);
    }

    public function viewContentAction(Request $request)
    {
        $id   = $request->id;
        $data = $this->__content->showContent($id);
        $data->increment('views');

        return view('content', ['data' => $data]);
    }
}
