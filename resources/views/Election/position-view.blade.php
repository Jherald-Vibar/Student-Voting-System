@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="bg-[#001f3f] text-white p-6 shadow-md mb-8">
            <h1 class="text-3xl font-bold"> Candidates for {{$election->title}} | {{$position->title}}</h1>
        </div>
        <div class="flex justify-end mb-4">
            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg" onclick="openCreateCandidateModal()">Add Candidate</button>
        </div>
    </div>
    <div id="createCandidateModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6 animate-fade-in">
            <h2 class="text-xl font-semibold mb-4">Create Candidate</h2>
            <form action="{{route('candidate-store', ['eid' => $election->id, 'pid' => $position->id])}}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div>
                    <label for="student_id" class="block text-sm font-medium text-gray-700">Student</label>
                    <select name="student_id" id="student_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->email }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Candidate Image</label>
                    <input type="file" name="image" id="image" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="flex justify-between gap-3 pt-4">
                    <button type="button" onclick="closeCreateCandidateModal()" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-xl hover:bg-gray-400 transition">
                        Cancel
                    </button>
                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition duration-300">
                        Save Candidate
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="flex flex-wrap justify-center items-stretch gap-6 p-4">
        @foreach ($candidates as $candidate)
            <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-end px-4 pt-4">
                    <button id="dropdownButton" data-dropdown-toggle="dropdown" class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5" type="button">
                        <span class="sr-only">Open dropdown</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                            <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                        </svg>
                    </button>
                </div>
                <div class="flex flex-col items-center gap-6 pb-10 mb-5 h-full">
                    <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{asset('candidate_images/' . $candidate->image)}}" alt="{{$candidate->student->name}} image"/>
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{$candidate->student->name}}</h5>
                    <span class="text-sm text-gray-500 dark:text-gray-400">{{$candidate->position->title}}</span>
                    <div class="flex mt-4 md:mt-6">
                        <a href="#" class="py-2 px-4 ms-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <script>
        function openCreateCandidateModal() {
            document.getElementById('createCandidateModal').classList.remove('hidden');
        }

        function closeCreateCandidateModal() {
            document.getElementById('createCandidateModal').classList.add('hidden');
        }
    </script>
@endsection
