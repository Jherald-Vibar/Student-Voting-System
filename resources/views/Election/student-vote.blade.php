@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-xl rounded-2xl p-8">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">
            🗳️ Vote in <span class="text-blue-600">{{ $election->title }}</span>
        </h2>
        <p class="text-center text-gray-500 mb-10">Select one candidate for each position, then submit.</p>

        <form action="{{route('votes-store', ['eid' => $election->id])}}" method="POST">
            @csrf
            @foreach ($election->positions as $position)
                <div class="mb-10">
                    <h3 class="text-xl font-semibold text-white bg-[#001f3f] rounded-t-lg px-4 py-2">
                        {{ $position->title }}
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 bg-gray-50 p-6 rounded-b-lg border border-t-0 border-gray-200">
                        @forelse ($position->candidates as $candidate)
                            <label for="candidate{{ $candidate->id }}"
                                   class="cursor-pointer bg-white rounded-xl shadow-md p-4 flex flex-col items-center text-center border border-gray-200 hover:shadow-lg transition">
                                <img src="{{ asset('candidate_images/' . $candidate->image) }}"
                                     alt="{{ $candidate->student->name }}"
                                     class="w-24 h-24 rounded-full object-cover border mb-4">

                                <h4 class="text-lg font-medium text-gray-800">{{ $candidate->student->name }}</h4>
                                <input type="radio"
                                       id="candidate{{ $candidate->id }}"
                                       name="votes[{{ $position->id }}]"
                                       value="{{ $candidate->id }}"
                                       class="mt-3 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300"
                                       required>
                            </label>
                        @empty
                            <p class="text-sm text-gray-400">No candidates available for this position.</p>
                        @endforelse
                    </div>
                </div>
            @endforeach
            <div class="text-center mt-10">
                <button type="submit"
                        class="inline-flex items-center justify-center w-full md:w-auto bg-[#001f3f] hover:bg-[#004080] text-white text-lg font-semibold py-3 px-8 rounded-xl transition gap-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         width="24" height="24"
                         viewBox="0 0 24 24"
                         fill="none"
                         class="text-white">
                        <path fill="currentColor"
                              d="M5 22q-.825 0-1.412-.587T3 20v-4.55l2.75-3.125l1.425 1.425l-2 2.25h13.65l-1.95-2.2l1.425-1.425L21 15.45V20q0 .825-.587 1.413T19 22zm5.6-7.6l-3.475-3.525Q6.55 10.3 6.55 9.45t.575-1.425l4.9-4.9q.575-.575 1.425-.575t1.425.575L18.4 6.6q.575.575.588 1.412t-.563 1.413l-5 5q-.575.575-1.412.563T10.6 14.4M17 8l-3.55-3.5L8.5 9.45l3.55 3.5z"/>
                    </svg>
                    Submit All Votes
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if (session('success'))
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Success',
                text: '{{ session('success') }}',
                icon: 'success',
            });
        });
    @endif

    @if (session('error'))
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Error',
                text: '{{ session('error') }}',
                icon: 'error',
            });
        });
    @endif
</script>
@endsection

