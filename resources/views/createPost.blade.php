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

</head><br><br><br>
            <form action="store" method="post" enctype="multipart/form-data"> @csrf
                <input type="text" id="caption" name="caption" placeholder="Caption.." class="form-control">
                <br>
                <a href="" id="upload_link"><img width="100" height="100" src="https://www.freeiconspng.com/thumbs/photography-icon-png/photo-album-icon-png-14.png" ></a>
                <input placeholder="Kies fotos" type="file" id="upload" name="image[]"  multiple>
                <label for="files">Kies foto's</label>
                <br><br>
                <input  type="hidden" id="userId" name="userId" value={{ Auth::id() }}>
                <input type="hidden" id="username" name="username" value="{{ Auth::user()->name }}">
                <input type="submit" class="btn btn-primary" value="Maak Post">
            </form>

            @endsection
