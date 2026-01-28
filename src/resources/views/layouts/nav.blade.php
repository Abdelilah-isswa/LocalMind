<nav style="padding:10px; display:flex; justify-content:space-between">

    <div>
        <a href="{{ route('home') }}">Home</a>
    </div>

    <div>
        @auth
            <span>{{ auth()->user()->name }}</span>

            <details style="display:inline-block">
                <summary style="cursor:pointer">Menu</summary>

                <div style="border:1px solid #000; padding:5px">
                    <a href="{{ route('questions.mine') }}">My Questions</a><br>
                    <a href="{{ route('questions.create') }}">Create Question</a><br>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </div>
            </details>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @endauth
    </div>

</nav>
