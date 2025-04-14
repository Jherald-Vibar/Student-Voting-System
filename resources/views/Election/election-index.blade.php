@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-6">
    <h1 class="text-2xl font-bold mb-6">Create New Election</h1>
    <div class="flex justify-end mb-4">
        <button onclick="openElectionModal()" class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-all duration-200 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Create Election
        </button>
    </div>
    <div id="addElection" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6 animate-fade-in">
            <h2 class="text-xl font-semibold mb-4">New Election</h2>
            <form action="{{route('election-store')}}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Election Title</label>
                    <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                        <input type="datetime-local" name="start_date" id="start_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                        <input type="datetime-local" name="end_date" id="end_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" onclick="closeElectionModal()" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-xl hover:bg-gray-400 transition">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

        @if($elections->count())
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">
            @foreach($elections as $election)
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition duration-300">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">{{ $election->title }}</h2>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 014-4h3m4 0H5m4-4V7a4 4 0 014-4h3" />
                    </svg>
                </div>

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
<style>
    @keyframes fade-in {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
    .animate-fade-in {
        animation: fade-in 0.2s ease-out;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function openElectionModal() {
        document.getElementById('addElection').classList.remove('hidden');
    }

    function closeElectionModal() {
        document.getElementById('addElection').classList.add('hidden');
    }


    @if (session('success'))
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Verification',
                text: '{{ session('success') }}',
                icon: 'success',
            });
        });
    @endif

    @if (session('error'))
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Verification',
                text: '{{ session('error') }}',
                icon: 'error',
            });
        });
    @endif
</script>
</script>
@endsection
