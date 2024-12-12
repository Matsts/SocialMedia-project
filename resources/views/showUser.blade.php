@extends('layouts.app')
@section('content')
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
    $(function(){
        $("#upload_link").on('click', function(e){
            e.preventDefault();
            $("#upload:hidden").trigger('click');
        });
        });


    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>

            #upload_link{
                text-decoration:none;
            }
            #upload{
                display:none
            }

            .background {
                background: linear-gradient(114.3deg, rgb(19, 126, 57) 0.2%, rgb(0, 0, 0) 68.5%);
                background-size: cover;
                background-attachment: fixed;
                color: white;
                background-repeat: no-repeat;
            }
            .quicksand-uniquifier {
            font-family: "Quicksand", sans-serif;
            font-style: normal;
            color: white;
            }
            .title {
                font-size: 50px
            }
            .user{
                font-size: 40px
            }

            .tooltip-container {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            transition: all 0.3s;
            background-color: rgb(255, 255, 255);
            padding: 11px 18px;
            border-radius: 12px;
            cursor: pointer;
            border: 1px solid rgb(211, 211, 211);
            }

            .text {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 600;
            color: rgb(0, 0, 0);
            }
            .svgIcon {
            width: 16px;
            height: auto;
            }

            .naam {
             left: calc(50% + (-190px/2)) ;
             top: 30px;
            }

        </style>

</head>
<br><br><br>

@if($user->id == Auth::id())
<form enctype="multipart/form-data" id="profile" name="profile" action="/changePfp/{{ $user->id }}" method="POST">@csrf<input id="upload" name="upload" type="file"/></form>@endif
&nbsp;&nbsp;&nbsp;&nbsp;<a href="" id="upload_link"><img width="100" height="100" src="{{ asset($media->getUrl()) }}" style="border-radius: 50%"></a>
<div class="container naam"><div class="user">{{  $user->name }}</div>
</div>
<div class="tooltip-container">
    <span class="text">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 95 114"
        class="svgIcon"
      >
        <rect fill="black" rx="28.5" height="57" width="57" x="19"></rect>
        <path
          fill="black"
          d="M0 109.5C0 83.2665 21.2665 62 47.5 62V62C73.7335 62 95 83.2665 95 109.5V114H0V109.5Z"
        ></path>
      </svg>
      Verzoek</span><span class="text">|</span> <span class="text">
        <img width="30" height="30" src="https://img.icons8.com/ios/50/chat-message--v1.png" alt="chat-message--v1"/>
        <rect fill="black" rx="28.5" height="57" width="57" x="19"></rect>
        <path
          fill="black"
          d="M0 109.5C0 83.2665 21.2665 62 47.5 62V62C73.7335 62 95 83.2665 95 109.5V114H0V109.5Z"
        ></path>
      </svg>
      Bericht</span></div>
<br>
<div class=" border-bottom border-3 border-light">Biografie: blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah</div>
<br>
@foreach($post as $posts)
@foreach ($image as $medias)
@foreach ($medias->getMedia($posts->userId, ['postUuid' => $posts->uuid]) as $images)
@if($loop->first)
<a href="/post/{{$posts->userId}}/{{$posts->uuid}}"><img width="125" height="125" src="{{ asset($images->getUrl()) }}"></a>
@endif
@endforeach
@endforeach
@endforeach
<script>
    document.getElementById("upload").onchange = function() {
    document.getElementById("profile").submit();
};
</script>
@endsection
