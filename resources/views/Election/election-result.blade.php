@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto py-10 px-6">
    @if($elections->count())
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">
        @foreach($elections as $election)
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition duration-300">
            <a href="{{route('admin-result-all', ['id' => $election->id])}}"  class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-800">{{ $election->title }}</h2>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 014-4h3m4 0H5m4-4V7a4 4 0 014-4h3" />
                </svg>
            </a>
            <p class="text-gray-600 text-sm mb-4">{{ \Illuminate\Support\Str::limit($election->description, 100) }}</p>

            <div class="text-sm text-gray-500 mb-2">
                <span class="font-medium text-gray-700">Start:</span> {{ \Carbon\Carbon::parse($election->start_date)->format('M d, Y h:i A') }}
            </div>
            <div class="text-sm text-gray-500">
                <span class="font-medium text-gray-700">End:</span> {{ \Carbon\Carbon::parse($election->end_date)->format('M d, Y h:i A') }}
            </div>
        </div>
        @endforeach
    </div>
    @else
        <p class="text-center text-gray-500 mt-10">No elections created yet.</p>
    @endif
</div>
@endsection
