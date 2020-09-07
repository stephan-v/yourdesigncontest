<div class="collapse navbar-collapse d-flex justify-content-between align-items-center">
    <a href="{{ route('home') }}" class="logo mb-0">YourDesignContest<span class="period">.</span></a>

    <ul class="navbar-nav d-none d-lg-flex">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
                Home <span class="sr-only">(current)</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('contests.index') }}">Contests</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('blog.index') }}">Blog</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('contact.form') }}">Contact</a>
        </li>
    </ul>

    <ul class="navbar-nav d-none d-lg-flex">
        @auth
            <li class="nav-item">
                    <span class="nav-link">
                        <notifications :initial-notifications='@json($user->unreadNotifications)'></notifications>
                    </span>
            </li>

            <li class="nav-item">
                <dropdown>
                    <span class="nav-link cursor-pointer" slot="header">{{ $user->name }}</span>

                    <div slot="menu" v-cloak>
                        <a class="nav-link pl-5 pr-5" href="{{ route('users.show', $user) }}">Profile</a>
                        <a class="nav-link pl-5 pr-5" href="{{ route('users.edit', $user) }}">Settings</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                        <a class="nav-link pl-5 pr-5"
                           href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                    </div>
                </dropdown>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link d-inline-block" href="{{ route('register') }}">Register</a>
                <a class="nav-link d-inline-block" href="{{ route('login') }}">Login</a>
            </li>
        @endauth
    </ul>

    <responsive-navigation class="d-lg-none">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">
                    Home <span class="sr-only">(current)</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('contests.index') }}">Contests</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('blog.index') }}">Blog</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('contact.form') }}">Contact</a>
            </li>
        </ul>

        <ul class="navbar-nav">
            @auth
                <li class="nav-item">
                    <span class="nav-link">
                        <notifications :initial-notifications='@json($user->unreadNotifications)'></notifications>
                    </span>
                </li>

                <li class="nav-item">
                    <dropdown>
                        <span class="nav-link cursor-pointer" slot="header">{{ $user->name }}</span>

                        <div slot="menu" v-cloak>
                            <a class="nav-link pl-5 pr-5" href="{{ route('users.show', $user) }}">Profile</a>
                            <a class="nav-link pl-5 pr-5" href="{{ route('users.edit', $user) }}">Settings</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                            <a class="nav-link pl-5 pr-5"
                               href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                        </div>
                    </dropdown>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link d-inline-block" href="{{ route('register') }}">Register</a>
                    <a class="nav-link d-inline-block" href="{{ route('login') }}">Login</a>
                </li>
            @endauth
        </ul>
    </responsive-navigation>
</div>
