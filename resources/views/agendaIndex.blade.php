@extends('layouts.app')
@section('content')
<head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>

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
                font-size: 35px
            }
            .slots {
                font-size: 20px
            }
            .tijd {
                font-size: 12px;
            }
            .fixed-btn {
             position: fixed;
             left: calc(50% + (-225px/2)) ;
             top: 550px;
            }
            .fixed-pend {
             position: fixed;
             left: calc(50% + (25px/2)) ;
             top: 550px;
            }
            .users{
            position: fixed;
             left: calc(15% + (25px/2)) ;
             top: 200px;
            }

        </style>

</head>



@endsection
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://getbootstrap.com/docs/5.3/assets/css/docs.css"
      rel="stylesheet"
    />

  </head>
    <!-- Example Code -->
    <div id="carouselExampleIndicators" class="carousel slide pointer-event">
      <div class="carousel-inner">
        <div class="carousel-item active">
            <br><br><br><br><div class="text-center"><p1>Klik links of rechts om te beginnen</p1></div><br><br><br><br><br><br><br><br>
            <div  class="row text-center">
                <h1 class="title"><b>De Schuur</b></h1><br>
            </div>
            <div class="row text-center">
                <h1 class="slots">Agenda</h1><br><br>
                <form action="createAgenda">
                    @if(App\Http\Controllers\userController::admin())
                    <input type="submit" class="btn btn-success bottom" value="+">
                    @endif
                </form>
                <br><br><br><br>
                <br><br><br>

                </div>


        </div>

        @php
        \Carbon\Carbon::setLocale('nl');
        use App\Models\pending;
        use App\Models\User;
      @endphp
      @foreach ($agenda as $punt)
      @if ($punt->eind->isPast())
      @else
        <div class="carousel-item">
            <br><br>
            <div  class="row text-center">
                <h1 class="title"><b>{{ $punt->titel }}</b></h1><br>
            </div>
            <div class="row text-center">
                <h3 class="slots">Plaats: {{ $punt->slots }} mensen</h3><br>
                </div>
                @php
                $user = pending::where('agendaId', $punt->id)->get();
               @endphp
               <div class="row">
               <div class="col users">
               @foreach($user as $users)
               @php
                        $test = User::where('name', $users->username)->get();
                        $media = $test->first()->getMedia($test[0]->imageId)->first();
               @endphp


                <h1 class="user"><img width="50" height="50" src="{{ asset($media->getUrl()) }}" style="border-radius: 50%">&nbsp;<b>{{ $users->username }}</b>&nbsp;&nbsp;@if(App\Http\Controllers\userController::admin())<a href="kick/{{ $users->username }}/{{ $punt->id }}"><i style="color: red" class="fa-solid fa-user-minus fa-xs"></i></a>@endif</h1>
                @endforeach
               </div>
               </div>
                <div class="row">
                @if($punt->begin->isPast())<div class="col">
                <h4 class="tijd">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Begon: {{ $punt->begin->diffForHumans() }}</h4>
                    </div>
                @else <div class="col">
                <h4 class="tijd" style="vertical-align: text-bottom">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Begint: {{ $punt->begin->diffForHumans() }}</h4>
                </div>
                @endif
                <div class="col ">
                    <h4 class="tijd" style="vertical-align: text-bottom">&nbsp;&nbsp;&nbsp;&nbsp;Eindigt: {{ $punt->eind->diffForHumans() }}</h4>
                    </div>
                </div><div class="row">
                    <div class="col">
                <form action="addUser/{{ Auth::id() }}/{{ $punt->id }}">
                    <input type="submit" value="Aanmelden" class="btn btn-success fixed-btn" >
                </form>
                    </div><div class="col">
                <form action="agendaIndex/pending/{{$punt->id}}">
                    @if(App\Http\Controllers\userController::admin())
                        <button type="submit"class="btn btn-warning bottom fixed-pend" style="color:white">Pending</button>
                    @endif
                </form>
                <br><br><br><br><br><br><br><br><br><br><br><br>
                </div></div></div>
                @endif
                @endforeach
            </div></div></div></div>
            </div>

      <button
        class="carousel-control-prev"
        type="button"
        data-bs-target="#carouselExampleIndicators"
        data-bs-slide="prev"
      >
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button
        class="carousel-control-next"
        type="button"
        data-bs-target="#carouselExampleIndicators"
        data-bs-slide="next"
      >
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>


  </body>

</html>
