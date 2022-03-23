@extends('layout')
@section('content')
<section>
    <div class="container overflow-hidden d-flex align-items-stretch" style="margin-top:8rem">
        <div class="row gy-5">
            @if(!empty($data))
            @foreach($data->sortByDesc('created_at') as $item)
            <div class="col-4" style="margin-bottom:1rem">
                <div class="p-2" style="min-height: 100%; height: 100%;">
                    <div class="card hover-shadow border" style="min-height: 100%; height: 100%;">
                        <div>
                            @if($item['created_at'] >= Carbon\Carbon::now()) <span class="badge bg-danger">In Today!</span>
                            @endif
                        </div>
                        <img class="rounded card-img-top" src="image/placeholder-image.png" alt="Placeholder">
                        <div class="card-body">
                            <h5 class="card-title text-warning text-center" onclick="window.location='{{ route("travel.details", $item['id']) }}'" style="cursor:pointer">{{$item['name']}}</h5>
                            <p class="font-weight-bold text-danger text-center">${{$item['price']}}</p>
                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-outline-warning m-1 btn-rounded" onclick=" window.location='{{ route("travel.details", $item['id']) }}'">View</button>
                                @if ($item['slots'] > 0)
                                <button type="button" class="btn btn-warning m-1 btn-rounded" onclick="window.location='{{ route("travel.form", $item['id']) }}'"><i class="fa-solid fa-cart-flatbed"></i> Book Now!</button>
                                @else
                                <button class="btn btn-light m-1 btn-rounded" disabled>Sold Out</button>
                                @endif
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
    <div class="d-flex flex-row justify-content-center" style="margin:2rem 0rem 3rem 0rem">{{ $data->links() }}</div>

</section>
@endsection