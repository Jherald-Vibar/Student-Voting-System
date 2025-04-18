@extends('layouts.app')
@section('content')
<div class="container mx-auto px-4 mt-5">
    @include('layouts.breadcrumb')
    <div class="flex justify-start mb-6">
        <button
            class=" bg-[#001f3f] text-white rounded-lg px-6 py-3 font-semibold hover:text-blue-600 ansition duration-300"
            onclick="window.location.href='{{ route('admin-home') }}'">
            &larr;
        </button>
    </div>
    @if($elections->count())
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">
        @foreach($elections as $election)
        @php
            $hasEnded = \Carbon\Carbon::parse($election->end_date)->lt(now());
        @endphp

        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition duration-300 border-l-4 {{ $hasEnded ? 'border-red-500' : 'border-green-500' }}">
            <a href="{{ route('admin-result-all', ['id' => $election->id]) }}" class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-800">{{ $election->title }}</h2>
                <span class="text-xs font-bold px-2 py-1 rounded-full
                    {{ $hasEnded ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                    {{ $hasEnded ? 'Ended' : 'Ongoing' }}
                </span>
            </a>

            <p class="text-gray-600 text-sm mb-4">
                {{ \Illuminate\Support\Str::limit($election->description, 100) }}
            </p>

            <div class="text-sm text-gray-500 mb-2">
                <span class="font-medium text-gray-700">Start:</span>
                {{ \Carbon\Carbon::parse($election->start_date)->format('M d, Y h:i A') }}
            </div>
            <div class="text-sm text-gray-500">
                <span class="font-medium text-gray-700">End:</span>
                {{ \Carbon\Carbon::parse($election->end_date)->format('M d, Y h:i A') }}
            </div>
        </div>
    @endforeach
    </div>
    @else
        <p class="text-center text-gray-500 mt-10">No elections created yet.</p>
    @endif
</div>
@endsection
