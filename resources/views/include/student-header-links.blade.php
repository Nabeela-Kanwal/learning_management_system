@foreach ([['student.login', 'Login'], ['student.register', 'Register']] as [$studentRoute, $studentLabel])
    @if (Route::has($studentRoute))
        <a href="{{ route($studentRoute) }}">{{ $studentLabel }} <i class="la la-arrow-right" aria-hidden="true"></i></a>
    @else
        <span class="lms-header-unavailable" aria-disabled="true">{{ $studentLabel }} <small>Coming soon</small></span>
    @endif
@endforeach
