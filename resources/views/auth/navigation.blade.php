@section('nav-auth')
<ul>
    @guest
        <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
        <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
    @else
        <li>
            <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>
            <ul>
                <li>
                    <form id="logout" action="{{ route('logout') }}" method="POST">
                        <input type="submit" value="Logout"/>
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    @endguest
</ul>
@endsection