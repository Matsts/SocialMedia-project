@extends('layouts.app')
@section('content')
<head>
    <script src=https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js></script>
    <link rel="stylesheet" href=https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css>
    <link rel="stylesheet" href=https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css>
    <link rel="stylesheet" href=https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .mySlides {display:none;}
        .background {
                background: repeating-linear-gradient(114.3deg, rgb(19, 126, 57) 0.2%, rgb(0, 0, 0) 68.5%);
                background-size: cover;
                background-attachment: fixed;
                color: white;
                background-repeat: repeat;
            }

            .cont {
                position: relative;
                text-align: left;
                color: white;
            }
            .naam {
                position: absolute;
                font-size: 5px;
            }
            .cap {
                position: absolute;
                font-size: 18px;
                padding-bottom: 3px;
            }
    </style>

</head>
<body>
<br><br>
@php
    use App\Models\User;
@endphp
@php
$pfp = $user->getMedia($user->imageId)->first();
$pfp = $user->getMedia($user->imageId)->first();

@endphp
<div class="cont">
        <a style="color:white; text-decoration: none;"href="/user/show/{{$user->id}}"><div style="font-size:30px; padding-bottom:5px;" >&nbsp;&nbsp;<img width="40" height="40" src="{{ asset($pfp->getUrl()) }}" style="border-radius: 50%; ">&nbsp;{{  $user->name }}</div></a>
    <div class="owl-carousel owl-theme">
        @foreach ($image as $media)
        @foreach ($media->getMedia($user->id, ['postUuid' => $uuid]) as $images)
        <div class="item" style="position: relative">
        <img style="padding-bottom:5px; padding-top:4px; background:white;" width="200" height="550" src="{{ asset($images->getUrl()) }}"></div>
        @endforeach
        @endforeach
        </div>
    </div>

            <div class="cap">
         <b>{{ $user->name }}</b><br>
            {{ $post->caption }}
        </div></div>
        <br><br>
        <form action="/createComment/{{$post->uuid}}" id="createComment">
            <input type="text" class="form-control" name="comment" id="comment" placeholder="Typ een comment">
            <input type="hidden" value="{{ Auth::id() }}" name="userId">
        </form>
        <br>
        @foreach($comments as $comment)
        @php
            $test = User::where('name', $comment->username)->get();
            $pfp2 = $test->first()->getMedia($test[0]->imageId)->first();
        @endphp
        <a style="color:white; text-decoration: none;"href="/user/show/{{$comment->userId}}"><img width="30" height="30" src="{{ asset($pfp2->getUrl()) }}" style="border-radius: 50%; "></a>
        <b>{{ $comment->username }}</b><br>
        {{ $comment->comment }}<br>
        @endforeach
        <br>
        <br>
        <br>
        <br>
  </body>
  <script src=https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js></script>
  <script src=https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js></script>
    <script>
    document.getElementById("comment").onchange = function() {
    document.getElementById("createComment").submit();
};
$('.owl-carousel').owlCarousel({
    loop:false,
    margin:10,
    pagination: false,
    dots: false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})
    </script>

</html>
@endsection
