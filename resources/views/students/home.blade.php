@extends('layouts.app')

@section('content')
<div class="p-10">
    <!-- Breadcrumb -->
    <nav class="flex flex-center mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse flex-row">
            <li class="flex items-center space-x-2">
                <svg class="w-4 h-4 text-gray-600 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                </svg>
                <a href="#" class="text-sm font-medium text-gray-800 hover:text-blue-600">Student</a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-3 h-3 text-gray-400 mx-1" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="text-sm font-medium text-gray-500">Home</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Student Dashboard -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="bg-[#001f3f] text-white p-6 rounded-lg shadow-md mb-8">
            <h1 class="text-3xl font-bold">Welcome, {{ Auth::guard('student')->user()->email ?? 'Student' }}!</h1>
            <p class="mt-2 text-sm">Get ready to make your vote count. Your opinion matters.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="p-4 bg-blue-100 rounded shadow flex items-center">
                <svg class="w-8 h-8 text-blue-600 mr-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M17 7.77l-5.03-5.03a4 4 0 0 0-5.94 5.63L10 13l2.97-4.96a4 4 0 0 0 3.03-6.27zM10 3a7 7 0 1 0 7 7 7 7 0 0 0-7-7z" />
                </svg>
                <div>
                    <h2 class="text-lg font-semibold mb-2">Vote Now</h2>
                    <p class="text-sm text-gray-700">Participate in the current election.</p>
                    <a href="" class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Go to Vote</a>
                </div>
            </div>
            <div class="p-4 bg-green-100 rounded shadow flex items-center">
                <svg class="w-8 h-8 text-green-600 mr-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M17 7h-6V1h-2v6H3v2h6v6h2V9h6V7z" />
                </svg>
                <div>
                    <h2 class="text-lg font-semibold mb-2">View Results</h2>
                    <p class="text-sm text-gray-700">Check the latest election results.</p>
                    <a href="" class="inline-block mt-4 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">View Results</a>
                </div>
            </div>
            <div class="p-4 bg-yellow-100 rounded shadow flex items-center">
                <svg class="w-8 h-8 text-yellow-600 mr-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M16 4h2v12h-2V4zM10 4h2v12h-2V4zM4 4h2v12H4V4z" />
                </svg>
                <div>
                    <h2 class="text-lg font-semibold mb-2">Voting History</h2>
                    <p class="text-sm text-gray-700">Review your past voting records.</p>
                    <a href="" class="inline-block mt-4 px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">View History</a>
                </div>
            </div>
            <div class="p-4 bg-purple-100 rounded shadow flex items-center">
                <svg class="w-8 h-8 text-purple-600 mr-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 10a4 4 0 1 0 4 4 4 4 0 0 0-4-4zm0-6a6 6 0 1 0 6 6 6 6 0 0 0-6-6zM4 16a6 6 0 0 1 6-6h4a6 6 0 0 1 6 6v4H4v-4z" />
                </svg>
                <div>
                    <h2 class="text-lg font-semibold mb-2">My Profile</h2>
                    <p class="text-sm text-gray-700">Manage your account details.</p>
                    <a href="" class="inline-block mt-4 px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">Go to Profile</a>
                </div>
            </div>
        </div>
        <div class="mt-5">
            <h2 class="text-2xl font-semibold mb-4 text-gray-800">Current & Recent Election</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($elections as $election )
                <div class="bg-white p-5 rounded shadow hover:shadow-lg transition">
                        <h3 class="text-xl font-bold text-[#001f3f] mb-2">{{$election->title}}</h3>
                        <p class="text-gray-700 mb-4">{{$election->description}}</p>
                        <p class="text-sm text-gray-500 mb-2">{{\Carbon\Carbon::parse($election->end_date)}}</p>
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
