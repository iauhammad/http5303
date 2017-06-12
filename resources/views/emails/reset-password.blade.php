<h1>Hello, {{ $user->display_name }}</h1>

<div>
    Please click the following link to <a href="{{ env('APP_URL') }}/reset/{{ $code }}">reset your password</a>.
</div>