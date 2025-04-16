<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name')}}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" href="{{asset('img/spcc.png')}}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap"
    rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100" style="font-family: 'Poppins', sans-serif;">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 h-screen bg-[#001f3f] text-white fixed top-0 left-0 p-4">
            <div class="flex items-center gap-3 mb-8 ml-10">
                <img src="{{ asset('img/spcc.png') }}" width="150px" alt="SPCC" class="rounded-md">
            </div>
            <nav class="mt-4 space-y-4">
                @auth('student')
                    <div class="flex items-center space-x-3 px-4 py-2 hover:bg-[#003366] rounded-md">
                        <img src="{{ asset('student_images/' . Auth::guard('student')->user()->image) }}"
                             alt="Student Image" width="40" height="40" class="rounded-full border-2 border-white">
                        <div class="text-sm font-medium text-white">
                            {{ Auth::guard('student')->user()->name ?? 'N/A' }}
                        </div>
                    </div>
                    <div class="flex items-center space-x-2 px-4 py-2 hover:bg-[#003366] rounded-md">
                        <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 5a2 2 0 1 0 2 2 2 2 0 0 0-2-2zM4 5a2 2 0 1 0 2 2 2 2 0 0 0-2-2zM4 10a2 2 0 1 0 2 2 2 2 0 0 0-2-2zM10 10a2 2 0 1 0 2 2 2 2 0 0 0-2-2zM4 15a2 2 0 1 0 2 2 2 2 0 0 0-2-2zM10 15a2 2 0 1 0 2 2 2 2 0 0 0-2-2z"/>
                        </svg>
                        <span class="text-sm text-white">BSIT{{ Auth::guard('student')->user()->year ?? 'N/A' }}01{{ Auth::guard('student')->user()->section ?? 'N/A' }}</span>
                    </div>
                    <a href="{{ route('student.home') }}" class="flex items-center px-4 py-2 hover:bg-[#003366] rounded-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M3 12l2-2m0 0l7-7 7 7m-9 8v6h4v-6m-4 0h4" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Home
                    </a>
                    <a href="{{ route('studentElection') }}" class="flex items-center px-4 py-2 hover:bg-[#003366] rounded-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M4 6h16M4 12h16M4 18h7" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Election
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="flex items-center px-4 py-2 hover:bg-[#003366] rounded-md">
                        @csrf
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M17 16l4-4m0 0l-4-4m4 4H7" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M3 12a9 9 0 0118 0" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <button type="submit">Logout</button>
                    </form>
                @endauth

                @auth('web')
                    <div class="px-4 py-2 text-white">
                        <h1 class="block">User: {{ Auth::user()->name }}</h1>
                    </div>
                    <a href="{{ route('admin-home') }}" class="flex items-center px-4 py-2 hover:bg-[#003366] rounded-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M3 12l2-2m0 0l7-7 7 7m-9 8v6h4v-6m-4 0h4" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Home
                    </a>
                    <a href="{{ route('student_list') }}" class="flex items-center px-4 py-2 hover:bg-[#003366] rounded-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-2a4 4 0 100-8 4 4 0 000 8zm6 2a4 4 0 00-3-3.87" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Student List
                    </a>

                    <a href="{{ route('election-index') }}" class="flex items-center px-4 py-2 hover:bg-[#003366] rounded-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M4 6h16M4 12h16M4 18h7" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Election
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="flex items-center px-4 py-2 hover:bg-[#003366] rounded-md">
                        @csrf
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M17 16l4-4m0 0l-4-4m4 4H7" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M3 12a9 9 0 0118 0" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <button type="submit">Logout</button>
                    </form>
                @endauth

                @guest
                    <a href="{{ route('home') }}" class="flex items-center px-4 py-2 hover:bg-[#003366] rounded-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M3 12l2-2m0 0l7-7 7 7m-9 8v6h4v-6m-4 0h4" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Home
                    </a>

                    <a href="{{ route('login') }}" class="flex items-center px-4 py-2 hover:bg-[#003366] rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24"><path fill="#fff" d="M12 21v-2h7V5h-7V3h7q.825 0 1.413.588T21 5v14q0 .825-.587 1.413T19 21zm-2-4l-1.375-1.45l2.55-2.55H3v-2h8.175l-2.55-2.55L10 7l5 5z"/></svg>
                        Login
                    </a>
                @endguest
            </nav>
        </aside>
        <main class="flex-1 ml-0 md:ml-64">
          <div class="p-4 bg-gray-100 md:hidden">
            <button
                class="bg-gray-800 text-white px-4 py-2 rounded-md"
                onclick="toggleSidebar()">
              Toggle Sidebar
            </button>
          </div>
          @yield('content')
        </main>
      </div>
      <footer class="bg-[#001f3f] text-white py-6 mt-8 ml-24 relative z-50">
        <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row items-center justify-between">
            <p class="text-center md:text-left text-sm">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All Rights Reserved.
            </p>
            <div class="mt-4 md:mt-0 flex gap-6">
                <a href="" class="text-sm hover:underline">Terms of Service</a>
                <a href="" class="text-sm hover:underline">Privacy Policy</a>
                <a href="mailto:support@itsa.com" class="text-sm hover:underline">Contact Support</a>
            </div>
            <div class="mt-4 md:mt-0 flex gap-4">
                <a href="https://facebook.com" target="_blank" class="text-white hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M18 2C19.104 2 20 2.896 20 4V20C20 21.104 19.104 22 18 22H6C4.896 22 4 21.104 4 20V4C4 2.896 4.896 2 6 2H18Z" />
                        <path d="M12 8V12H9V8H12ZM12 12V16H9V12H12ZM16 8H13V9.5H15C15.552 9.5 16 10.052 16 10.5V13.5C16 14.052 15.552 14.5 15 14.5H13V16H15C16.104 16 17 15.104 17 14V10C17 8.896 16.104 8 15 8H12V7.5H13.5C14.048 7.5 14.5 7.048 14.5 6.5V4.5C14.5 4.052 14.048 3.5 13.5 3.5H12V2H13.5C14.552 2 15.5 3.048 15.5 4.5V6.5C15.5 7.052 15.048 7.5 14.5 7.5H12Z" />
                    </svg>
                </a>
                <a href="https://twitter.com" target="_blank" class="text-white hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M23 3a10.89 10.89 0 0 1-3.07.84A4.48 4.48 0 0 0 22.46 2a10.93 10.93 0 0 1-3.47 1.32A4.48 4.48 0 0 0 15.8 6.26c-1.54 0-3.06.74-4.03 1.97a4.55 4.55 0 0 0-.61 3.43c-3.57-.18-6.75-1.88-8.86-4.48-1.5 2.57-.75 5.93 1.28 7.66a4.47 4.47 0 0 1-2.04-.56c-.05 2.27 1.61 4.37 4.03 4.83a4.5 4.5 0 0 1-2.02.07c.56 1.77 2.17 3.04 4.04 3.08a9.14 9.14 0 0 1-5.67 1.96A9.45 9.45 0 0 1 0 21.23c3.21-1.98 6.88-3.18 10.69-3.18 3.25 0 6.4 1.1 8.91 2.94a9.39 9.39 0 0 0 4.6-2.49A9.46 9.46 0 0 0 23 3z" />
                    </svg>
                </a>
            </div>
        </div>
    </footer>

      <script>
        const sidebar = document.getElementById('sidebar');

        function toggleSidebar() {
          if (sidebar.classList.contains('-translate-x-full')) {
            sidebar.classList.remove('-translate-x-full');
          } else {
            sidebar.classList.add('-translate-x-full');
          }
        }


      </script>
 @yield('scripts')
</body>
</html>
