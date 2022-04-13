@extends('layout')
@section('content')
<section style="margin-top:8rem">
    <div class="container overflow-hidden d-flex align-items-stretch" style="padding-top:2rem">
        <div>
            <h1>Latest News</h1>
            <hr>
            <div class="row gy-5" style="overflow: auto; height: 32rem; margin:1rem">
                @if(!empty($data) && $data['is_shown' == 0])
                @foreach($data->sortByDesc('created_at') as $item)
                <div class="col-4" style="margin-bottom:1rem">
                    <div class="p-2" style="min-height: 100%; height: 100%;">
                        <div class="card hover-shadow border" style="min-height: 100%; height: 100%;">
                            <div>
                                @if($item['created_at'] >= Carbon\Carbon::now()->subDays(3)) <span class="badge bg-danger">Latest</span>
                                @endif
                            </div>
                            @if($item['photo_id'] != 0 )
                            <img class="rounded card-img-top" src="{{asset('storage/image/'.$item['photo_name'])}}">
                            @else
                            <img class="rounded card-img-top" src="image/placeholder-image.png">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title text-warning text-center" style="cursor:pointer">{{$item['title']}}
                                </h5>

                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-warning m-1 btn-rounded" onclick="window.location='{{ route("home.content", $item['id']) }}'">Read</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <p>Error</p>
                @endif
            </div>
        </div>
    </div>
    <div class="container overflow-hidden d-flex align-items-stretch" style="padding-top:5rem; padding-bottom:2rem">
        <div>
            <h1>Most Views</h1>
            <hr>
            <div class="row gy-5" style="overflow: auto; height: 32rem; margin:1rem">
                @if(!empty($data) && $data['is_shown' == 0])
                @foreach($data->sortByDesc('views') as $item)
                <div class="col-4">
                    <div class="p-2" style="min-height: 100%; height: 100%;">
                        <div class="card hover-shadow border" style="min-height: 100%; height: 100%;">
                            @if($item['photo_id'] != 0 )
                            <img class="rounded card-img-top" src="{{asset('storage/image/'.$item['photo_name'])}}">
                            @else
                            <img class="rounded card-img-top" src="image/placeholder-image.png">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title text-warning text-center" style="cursor:pointer">{{$item['title']}}
                                </h5>

                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-warning m-1 btn-rounded" onclick="window.location='{{ route("home.content", $item['id']) }}'">Read</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <p>Error</p>
                @endif

            </div>
        </div>
    </div>
</section>

@endsection