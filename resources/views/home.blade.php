@extends('layouts.app')

@section('content')
<div class=" p-8 bg-gray-100 min-h-screen">

    <div class="bg-[#001f3f] text-white p-6 rounded-lg shadow-md mb-8">
        <h1 class="text-3xl font-bold">Welcome, {{ Auth::guard('student')->user()->email ?? 'Student' }}!</h1>
        <p class="mt-2 text-sm">Get ready to make your vote count. Your opinion matters.</p>
    </div>

    <div class="mb-8">
        <a href=""
           class="inline-block bg-green-600 hover:bg-green-700 text-white text-lg font-semibold py-3 px-6 rounded shadow transition">
            🗳️ Vote Now
        </a>
    </div>

    <div>
        <h2 class="text-2xl font-semibold mb-4 text-gray-800">Current & Recent Election</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach ($elections as $election )
                <div class="bg-white p-5 rounded shadow hover:shadow-lg transition">
                    <h3 class="text-xl font-bold text-[#001f3f] mb-2">{{$election->title}}</h3>
                    <p class="text-gray-700 mb-4">{{$election->description}}</p>
                    <p class="text-sm text-gray-500 mb-2">{{\Carbon\Carbon::parse($election->end_date)}}</p>
                    <a href=""
                    class="text-blue-600 hover:underline text-sm font-medium">
                        View Details →
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
