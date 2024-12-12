@foreach ($user as $users)
<a href="{{ url('user/show/'.$users->id) }}">{{ $users->name }}</a>
<br><br>
@endforeach
