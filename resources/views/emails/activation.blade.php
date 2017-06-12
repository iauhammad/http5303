<h1>Hello, {{ $user->first_name }}</h1>

<div>
    Please click the following link to <a href="{{ env('APP_URL') }}/activate/{{ $code }}">activate your account</a>.
</div>