@extends('layouts.app')

@section('content')
<div class="p-4 sm:p-6 md:p-10">
    <!-- Breadcrumb -->
    <nav class="flex flex-wrap items-center mb-6 text-sm" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="flex items-center space-x-2">
                <svg class="w-4 h-4 text-gray-600 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                </svg>
                <a href="#" class="text-gray-800 hover:text-blue-600">Student</a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-3 h-3 text-gray-400 mx-1" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="text-gray-500">Home</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Student Dashboard -->
    <div class="bg-white rounded-lg shadow-md p-4 sm:p-6">
        <div class="bg-[#001f3f] text-white p-4 sm:p-6 rounded-lg shadow-md mb-6 sm:mb-8">
            <h1 class="text-2xl sm:text-3xl font-bold">Welcome, {{ Auth::guard('student')->user()->email ?? 'Student' }}!</h1>
            <p class="mt-1 sm:mt-2 text-sm">Get ready to make your vote count. Your opinion matters.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
            <div class="p-4 bg-blue-100 rounded shadow flex flex-col sm:flex-row items-center">
             <svg version="1.1"  id="30"  class="mr-5 w-24  h-24" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 0 297 297" xml:space="preserve">
                                            <g>
                                                <g>
                                    <g>
                                        <g>
                                            <circle style="fill:#34495E;" cx="148.5" cy="148.5" r="148.5"/>
                                        </g>
                                    </g>
                                </g>
                                                        <path style="fill:#1D3747;" d="M188.953,67.704C160.709,78.958,142.286,90.498,139.5,116.5c-1,8-8,15-11,22c-11,27-14,55-36,77
                            c-7.393,6.571-3.52,19.791-6.984,29.157l52.043,51.941c3.613,0.263,7.261,0.402,10.941,0.402
                            c73.45,0,134.435-53.328,146.373-123.376L188.953,67.704z"/>
                        <g>
                            <polygon style="fill:#ECF0F1;" points="214.5,132 214.5,132 198,148.5 99,148.5 82.5,132 99,99 198,99 		"/>
                        </g>
                        <g>
                            <rect x="123.75" y="110.994" style="fill:#345065;" width="49.5" height="5"/>
                        </g>
                        <g>
                            <polygon style="fill:#82D9C8;" points="110.402,83.296 143.134,115.011 188.953,67.704 156.221,35.989 		"/>
                        </g>
                        <g>
                            <path style="fill:#D0D5D9;" d="M92.5,247.5h112c5.523,0,10-4.477,10-10V132h-132v105.5C82.5,243.023,86.977,247.5,92.5,247.5z"/>
                        </g>
                        <g>
                            <rect x="107.25" y="181.5" style="fill:#5D7486;" width="82.5" height="33"/>
                        </g>
                    </g>
                    </svg>
                <div class="text-center sm:text-left">
                    <h2 class="text-lg font-semibold mb-1">Vote Now</h2>
                    <p class="text-sm text-gray-700">Participate in the current election.</p>
                    <a href="{{route('studentElection')}}" class="inline-block mt-3 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Go to Vote</a>
                </div>
            </div>

            <div class="p-4 bg-green-100 rounded shadow flex flex-col sm:flex-row items-center">
                <svg class="w-8 h-8 text-green-600 mb-2 sm:mb-0 sm:mr-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M17 7h-6V1h-2v6H3v2h6v6h2V9h6V7z" />
                </svg>
                <div class="text-center sm:text-left">
                    <h2 class="text-lg font-semibold mb-1">View Results</h2>
                    <p class="text-sm text-gray-700">Check the latest election results.</p>
                    <a href="{{route('student-election-winner')}}" class="inline-block mt-3 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">View Results</a>
                </div>
            </div>
        </div>

        <div class="mt-6 sm:mt-10">
            <h2 class="text-xl sm:text-2xl font-semibold mb-4 text-gray-800">Current & Recent Elections</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                @foreach ($elections as $election )
                <div class="bg-white p-4 rounded shadow hover:shadow-lg transition">
                    <h3 class="text-lg sm:text-xl font-bold text-[#001f3f] mb-2">{{$election->title}}</h3>
                    <p class="text-gray-700 text-sm mb-3">{{$election->description}}</p>
                    <p class="text-xs text-gray-500 mb-2">{{\Carbon\Carbon::parse($election->end_date)}}</p>
                    <a href="{{route('student-vote-form', ['eid' => $election->id])}}"
                       class="text-blue-600 hover:underline text-sm font-medium">
                        Vote →
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
