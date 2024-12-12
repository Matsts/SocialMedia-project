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
<div class="text-center">
<form action="/createPost">
    <input type="submit" class="btn btn-dark" value="Maak post">
</form>
<div class="col text-center">---------------------------------------------</div><br>
</div>
@php
    use App\Models\User;
@endphp
@foreach($post as $posts)
@php
$test = User::where('name', $posts->username)->get();
$pfp = $test->first()->getMedia($test[0]->imageId)->first();
@endphp
<div class="cont">
        <a style="color:white; text-decoration: none;"href="user/show/{{$posts->userId}}"><div style="font-size:30px; padding-bottom:5px;" >&nbsp;&nbsp;<img width="40" height="40" src="{{ asset($pfp->getUrl()) }}" style="border-radius: 50%; ">&nbsp;{{  $posts->username }}</div></a>
    <div class="owl-carousel owl-theme">
        @foreach ($image as $media)
        @foreach ($media->getMedia($posts->userId, ['postUuid' => $posts->uuid]) as $images)
        <div class="item" style="position: relative">
            <a href="/post/{{$posts->userId}}/{{$posts->uuid}}"><img style="padding-bottom:5px; padding-top:4px; background:white;" width="200" height="550" src="{{ asset($images->getUrl()) }}"></a></div>
        @endforeach
        @endforeach
        </div>
    </div>

            <div class="cap">
            <b>{{ $posts->username }}</b><br>
            {{ $posts->caption }}
        </div></div>
        <br><br>
        <br>
        @endforeach
        <br>
        <br>
        <br><div class="text-center">Niks verder te scrollen...</div>
        <br>
        <br>
  </body>
  <script src=https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js></script>
  <script src=https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js></script>
    <script>
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
