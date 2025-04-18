@extends('layouts.app')
@section('content')
<div class="container mx-auto px-4 mt-5">
    @include('layouts.breadcrumb')
    <div class="flex justify-start mb-6">
        <button
            class=" bg-[#001f3f] text-white rounded-lg px-6 py-3 font-semibold hover:text-blue-600 ansition duration-300"
            onclick="window.location.href='{{ route('student.home') }}'">
            &larr;
        </button>
    </div>
    @if($elections->count())
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">
        @foreach($elections as $election)
        @php
            $hasEnded = $election->end_date < now();
        @endphp

        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition duration-300 mb-6 border-l-4 {{ $hasEnded ? 'border-red-500' : 'border-green-500' }}">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-800">{{ $election->title }}</h2>
                <span class="text-xs font-bold px-3 py-1 rounded-full
                    {{ $hasEnded ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                    {{ $hasEnded ? 'Ended' : 'Ongoing' }}
                </span>
            </div>

            <p class="text-gray-600 text-sm mb-4">
                {{ \Illuminate\Support\Str::limit($election->description, 100) }}
            </p>

            <div class="text-sm text-gray-500 mb-1">
                <span class="font-medium text-gray-700">Start:</span>
                {{ \Carbon\Carbon::parse($election->start_date)->format('M d, Y h:i A') }}
            </div>
            <div class="text-sm text-gray-500 mb-4">
                <span class="font-medium text-gray-700">End:</span>
                {{ \Carbon\Carbon::parse($election->end_date)->format('M d, Y h:i A') }}
            </div>

            <a href="{{ $hasEnded ? route('student-election-winner', ['id' => $election->id]) : route('student-vote-form', ['eid' => $election->id]) }}"
               class="inline-flex items-center gap-2 text-white px-4 py-2 rounded-lg text-sm font-medium
               {{ $hasEnded ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600' }} transition">
                {{ $hasEnded ? 'View Results' : 'Vote Now' }}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    @endforeach
    </div>
    @else
        <p class="text-center text-gray-500 mt-10">No elections created yet.</p>
    @endif
</div>
@endsection
