@include('layouts.header')

<div class="d-flex user-profile">
    <aside class="p-5">
        <img src="{{ $user->avatar }}" alt="" class="avatar rounded-circle d-block mb-5">

        <ul class="list-unstyled font-weight-bold text-uppercase">
            <li class="mb-4 mt-1">
                <a href="{{ route('users.show', $user) }}" class="d-block @if (Route::is('users.show')) active @endif">
                    <i class="fas fa-home mr-3"></i> Overview
                </a>
            </li>

            <li class="mb-4">
                <a href="{{ route('users.edit', $user) }}" class="d-block @if (Route::is('users.edit')) active @endif">
                    <i class="fas fa-user-edit mr-3"></i> Edit profile
                </a>
            </li>

            <li class="mb-4">
                <a href="{{ route('users.verify', $user) }}" class="d-block @if (Route::is('users.verify')) active @endif">
                    <i class="fab fa-cc-stripe mr-3"></i> Verification
                </a>
            </li>
        </ul>
    </aside>

    <main>
        @yield('content')
    </main>
</div>

@include('layouts.footer')

@include('sweetalert::alert')
