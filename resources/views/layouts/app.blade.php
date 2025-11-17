<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Triple A</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Heroicons (untuk ikon logout & menu) -->
    <script src="https://unpkg.com/feather-icons"></script>

</head>

<body class="bg-gray-100">

    <!-- NAVBAR TAILWIND -->
    <nav class="bg-gray-900 text-white shadow-md">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex items-center justify-between h-16">

                <!-- Brand -->
                <a href="/" class="text-xl font-semibold tracking-wide">
                    Triple-A
                </a>

                <!-- Hamburger untuk mobile -->
                <button id="menuBtn" class="lg:hidden focus:outline-none">
                    <i data-feather="menu" class="w-6 h-6"></i>
                </button>

                <!-- Menu Desktop -->
                <ul class="hidden lg:flex space-x-6 items-center">

                    @if(auth()->check())
                        <li>
                            <a href="/bookings"
                            class="hover:text-gray-300 
                            {{ Request::is('bookings*') ? 'text-yellow-400 font-semibold' : 'text-white' }}">
                                Booking
                            </a>
                        </li>

                        <li>
                            <a href="/schedules"
                            class="hover:text-gray-300 
                            {{ Request::is('schedules*') ? 'text-yellow-400 font-semibold' : 'text-white' }}">
                                Schedules
                            </a>
                        </li>

                        @if(auth()->user()->role === 'admin')
                            <li><a href="/items" class="hover:text-gray-300">Items</a></li>
                            <li><a href="/branches" class="hover:text-gray-300">Cabang</a></li>
                            <li><a href="/finance-reports" class="hover:text-gray-300">Keuangan</a></li>
                        @endif

                        <!-- Logout Button Icon -->
                        <li>
                            <form action="/logout" method="POST" class="flex items-center">@csrf
                                <button class="hover:text-red-400" title="Logout">
                                    <i data-feather="log-out" class="w-5 h-5"></i>
                                </button>
                            </form>
                        </li>

                    @else
                        <li><a href="/login" class="hover:text-gray-300">Login</a></li>
                        <li><a href="/register" class="hover:text-gray-300">Register</a></li>
                    @endif

                </ul>
            </div>
        </div>

        <!-- Menu Mobile -->
        <div id="mobileMenu" class="hidden lg:hidden bg-gray-800 text-white px-4 pb-4">

            <ul class="space-y-3">

                @if(auth()->check())
                    <li><a href="/bookings" class="block hover:text-gray-300">Booking</a></li>

                    @if(auth()->user()->role === 'admin')
                        <li><a href="/items" class="block hover:text-gray-300">Items</a></li>
                        <li><a href="/branches" class="block hover:text-gray-300">Cabang</a></li>
                        <li><a href="/finance-reports" class="block hover:text-gray-300">Keuangan</a></li>
                    @endif

                    <li>
                        <form action="/logout" method="POST">@csrf
                            <button class="flex items-center space-x-2 text-red-400 hover:text-red-300">
                                <i data-feather="log-out" class="w-5 h-5"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>

                @else
                    <li><a href="/login" class="block hover:text-gray-300">Login</a></li>
                    <li><a href="/register" class="block hover:text-gray-300">Register</a></li>
                @endif

            </ul>
        </div>
    </nav>

    <!-- CONTENT -->
    <div class="max-w-6xl mx-auto p-4">
        @yield('content')
    </div>

    <script>
        // Mobile menu toggle
        const menuBtn = document.getElementById('menuBtn');
        const mobileMenu = document.getElementById('mobileMenu');

        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Load icons
        feather.replace();
    </script>

</body>
</html>
