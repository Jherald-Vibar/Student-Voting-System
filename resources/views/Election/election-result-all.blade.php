@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-12">
    <h2 class="text-4xl font-extrabold text-center text-white mb-12 bg-[#001f3f] p-4 rounded-lg">
        Election Results - {{ $election->title }}
    </h2>
    <div class="grid grid-cols-1 lg:grid-cols-1 gap-5">
        <div class="lg:grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($candidates->groupBy('position_id') as $positionId => $cands)
                <div class="bg-white p-6 rounded-xl shadow-xl mb-8">
                    <div class="card-header bg-[#001f3f] text-white p-4 rounded-t-xl">
                        <h4 class="text-2xl font-semibold">{{ $cands->first()->position->title }}</h4>
                    </div>
                    <div class="card-body">
                        <ul class="space-y-4">
                            @foreach($cands as $candidate)
                                <li class="flex justify-between items-center p-4 bg-gray-50 rounded-lg shadow-lg hover:bg-gray-100 transition duration-300 ease-in-out transform hover:scale-105">
                                    <div class="flex items-center space-x-4">
                                        <img src="{{ asset('candidate_images/' . $candidate->image) }}" alt="{{ $candidate->student->name }}" class="rounded-full w-14 h-14 object-cover">
                                        <span class="font-medium text-xl text-gray-800">{{ $candidate->student->name }}</span>
                                    </div>
                                    <span class="bg-blue-500 text-white text-lg py-2 px-5 rounded-full shadow-md">
                                        {{ $candidate->votes->count() }} votes
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer bg-transparent text-center p-4">
                        <small class="text-gray-600">Election results as of {{ now()->format('F j, Y') }}</small>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

