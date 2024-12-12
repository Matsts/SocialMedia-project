@extends('layouts.app')
@section('content')
<style>
    .mySlides {display:none;}
    .background {
            background: repeating-linear-gradient(114.3deg, rgb(19, 126, 57) 0.2%, rgb(0, 0, 0) 68.5%);
            background-size: cover;
            background-attachment: fixed;
            color: white;
            background-repeat: no-repeat;
        }
</style>
<div class="container">
    <br><br><br>
@foreach ($slot as $slots)
<div class="row">
    <div class="col">
{{ $slots->username }} </div><form action="/acceptAgenda/{{ $slots->id }}/{{$slots->username}}"> <div class="col"><input type="submit" class="btn btn-success" value="Accepteer"></div></form><form action="/declineAgenda/{{$slots->id}}/{{ $slots->username }}"> <div class="col"><input type="submit" class="btn btn-danger" value="Skip deze man!"></form></div><br>
@endforeach
@endsection
