@include('layouts.header')

<div class="container mt-5">
    <div class="d-flex user-profile bg-white">
        <aside>
            <ul class="list-unstyled font-weight-bold">
                <li class="p-3 pl-4 @if (Route::is('users.edit')) active @endif">
                    <a href="{{ route('users.edit', $user) }}" class="d-block">
                        <i class="fas fa-user-edit mr-3"></i> Account
                    </a>
                </li>

                <li class="p-3 pl-4 @if (Route::is('users.edit.password')) active @endif">
                    <a href="{{ route('users.edit.password', $user) }}" class="d-block">
                        <i class="fas fa-lock mr-3"></i> Password
                    </a>
                </li>

                <li class="p-3 pl-4 @if (Route::is('users.verify')) active @endif">
                    <a href="{{ route('users.verify', $user) }}" class="d-block">
                        <i class="fab fa-cc-stripe mr-3"></i> Payout verification
                    </a>
                </li>
            </ul>
        </aside>

        <main class="p-5">
            @yield('content')
        </main>
    </div>
</div>

@include('layouts.footer')

@include('sweetalert::alert')
