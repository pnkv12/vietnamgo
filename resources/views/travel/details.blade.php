@extends('layout')
@section('content')
<section>
    <div style="margin-top: 6rem; margin-left: 4rem; margin-right: 4rem">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/travel">Travel List</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$data['name']}}</li>
            </ol>
        </nav>
        <hr>
    </div>
    <div style="margin:3rem 4rem 3rem 4rem">
        <div class="d-flex flex-row mb-2 justify-content-between">
            <img src="https://mdbcdn.b-cdn.net/img/new/slides/041.webp" class="img-fluid shadow-2-strong align-items-evenly" alt="Wild Landscape" style="width:60%" />
            <div>
                <p class="lead text-warning"><strong>{{$data['name']}}</strong></p>
                <p><strong>Code:</strong> {{$data['tour_code']}}</p>
                <p class="h4 text-info">Price/person: {{$data['price']}}</p>
                <p><strong>Departure Date:</strong> {{$data['departure']}}</p>
                <p><strong>Return Date:</strong> {{$data['return']}}</p>
                <p><strong>Remaining slots:</strong> {{$data['slots']}}</p>
                <p><strong>By:</strong>
                    <?php
                    if ($data['vehicle' == 0]) {
                        echo "Plane";
                    } elseif ($data['vehicle' == 1]) {
                        echo "Bus";
                    } else {
                        echo "Ship";
                    }
                    ?>
                <div class="p-3">
                    @if ($data['slots'] > 0)
                    <button class="btn btn-lg btn-warning btn-rounded" onclick="window.location='{{ route("travel.form", $data['id']) }}'"><i class="fa-solid fa-cart-flatbed"></i> Book This</button>
                    @else
                    <button class="btn btn-lg btn-light btn-rounded" disabled>Sold Out!</button>
                    @endif
                </div>
            </div>
            </p>
        </div>
        <div style="margin-top:3rem">
            <h3>Details</h3>
            <hr>

            <p>{!! nl2br(e($data['details']))!!}</p>
        </div>
    </div>
</section>
@endsection