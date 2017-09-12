@extends('layouts.app')

@section('content')

<style>

    .title-box {
        font-size: larger;
        padding: 2em;
        background-color: #000;
        color: white;
        text-transform: capitalize;
        text-align: center;
        height: 150px;
    }

    .title-box:hover {
        cursor: pointer;
        background-color: white;
        border: 2px solid rgb(0, 200, 100);
        color: black;
    }

    .detail-box {
        padding: 0.5em;
        background-color: rgb(0, 150, 100);
        color: #fff;
        font-size: small;
    }

    .col-md-3.col-sm-3.col-xs-3 {
        margin-bottom: 1em;
    }

    #posts {
        margin-top: 2em;
    }

    @media (max-width: 640px) {
        .col-md-3.col-sm-3.col-xs-3 {
            width: 100%;
        }
    }
</style>

<div class="container">

    @if($news->count() > 0)
    <div id='posts' class="row">
        @foreach($news as $newsItem)
        <div class="col-md-3 col-sm-3 col-xs-3">
            <a href="/news/{{$newsItem->id}}"><div class="title-box">{{str_limit($newsItem->title, $limit = 40, $end = '...')}}</div></a>
            <div class="detail-box"><p><span>Uploaded: {{$newsItem->created_at->diffForHumans()}}</span></p></div>
            <div class="detail-box">
                <form action="{{ url('news/'.$newsItem->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button type="submit" class="btn btn-xs btn-danger">
                        <i class="fa fa-btn fa-trash"></i>Remove
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    @if(method_exists($news, "links"))
    <div id="links">{{$news->links()}}</div>
    @endif
    @else
    <p><strong>There are no posts available...</strong></p>
    @endif

</div>
@endsection