@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-10">
    @include('layouts.breadcrumb')

    <h1 class="text-3xl font-bold text-center text-white bg-slate-900 py-4 px-6 rounded-lg shadow mb-10">
        Election Results
    </h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($elections as $election)
            @php
                $allCandidates = collect($election->positions)->flatMap(fn($position) => $position->candidates);
                $ongoing = now()->lt($election->end_date);
            @endphp

            <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 p-6 flex flex-col h-full">
                <div class="text-2xl font-semibold text-gray-800 mb-4">
                    {{ $election->title }}
                </div>

                @if ($ongoing)
                    <div class="bg-yellow-100 text-yellow-700 font-semibold text-center p-3 rounded mb-6 shadow">
                        Election is Ongoing
                    </div>
                @else
                    <div class="space-y-5 flex-1">
                        @foreach ($election->positions as $position)
                            @php
                                $positionCandidates = $position->candidates;
                                $winner = $positionCandidates->sortByDesc(fn($candidate) => $candidate->votes->count())->first();
                            @endphp

                            <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $position->title }}</h3>

                                @if ($winner)
                                    <div class="flex items-center space-x-4 text-green-700">
                                        <img src="{{ asset('candidate_images/' . $winner->image) }}" width="40" height="40" alt="Winner's Image" class="rounded-full border border-gray-300 shadow-sm">
                                        <div>
                                            <div class="font-semibold">{{ $winner->student->name }}</div>
                                            <div class="text-sm text-gray-600">
                                                Winner with <strong>{{ $winner->votes->count() }}</strong> votes
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="text-red-600 text-sm font-medium">
                                        No votes recorded yet.
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection
