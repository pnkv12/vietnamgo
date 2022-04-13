@extends('layout')
@section('content')
<section>

    <div style="margin-top: 6rem; margin-left: 4rem; margin-right: 4rem">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item active text-warning" aria-current="page">{{$data['title']}}</li>
            </ol>
        </nav>
        <hr>
    </div>
    <div style="margin:3rem 20rem 3rem 20rem">
        <div>
            <p class="h1 text-warning text-uppercase"><strong>{{$data['title']}}</strong></p>
            <p class="subtitle1 text-secondary fs-6">
                {{$data['created_at']}} | {{$data['cate_name']}}
            </p>

            <img src="{{asset('storage/image/'.$data['photo_name'])}}" class="img-fluid shadow-2-strong" />
        </div>
        <div style="margin-top:3rem">
            <p class="text-justify text-wrap text-break">{!! nl2br(e($data['content']))!!}</p>
        </div>
    </div>
</section>
@endsection