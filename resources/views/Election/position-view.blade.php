@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        @include('layouts.breadcrumb')
        <div class="flex justify-start mb-6">
            <button
                class=" bg-[#001f3f] text-white rounded-lg px-6 py-3 font-semibold hover:text-blue-600 ansition duration-300"
                onclick="window.location.href='{{ route('admin-home') }}'">
                &larr;
            </button>
        </div>
        <div class="bg-[#001f3f] text-white p-6 rounded-xl shadow-md mb-6">
            <h1 class="text-3xl font-bold">Candidates for {{ $election->title }} | {{ $position->title }}</h1>
        </div>

        <div class="flex justify-end mb-6">
            <button onclick="openCreateCandidateModal()" class="bg-[#001f3f] hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-medium transition duration-300">
                + Add Candidate
            </button>
        </div>
        <div id="createCandidateModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-xl p-8 relative animate-fade-in">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Create Candidate</h2>
                <form action="{{ route('candidate-store', ['eid' => $election->id, 'pid' => $position->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    <div>
                        <label for="student_id" class="block text-sm font-medium text-gray-700 mb-1">Select Student</label>
                        <select name="student_id" id="student_id" class="w-full rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 p-2" required>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->email }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Upload Image</label>
                        <input type="file" name="image" id="image" class="w-full border border-gray-300 rounded-lg p-2">
                    </div>

                    <div class="flex justify-end gap-4 pt-4">
                        <button type="button" onclick="closeCreateCandidateModal()" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg transition">
                            Cancel
                        </button>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
            @foreach ($candidates as $candidate)
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-md p-6 flex flex-col items-center text-center">
                <img class="w-24 h-24 rounded-full object-cover shadow-md mb-4" src="{{ asset('candidate_images/' . $candidate->image) }}" alt="{{ $candidate->student->name }}">
                <h5 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $candidate->student->name }}</h5>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 mb-4">{{ $candidate->position->title }}</p>

                <div class="flex space-x-2">
                    <button onclick="openEditCandidateModal({{ $candidate->id }}, '{{ $candidate->student_id }}', '{{ $candidate->image }}')" class="text-sm px-4 py-2 border rounded-lg text-blue-600 border-blue-300 hover:bg-blue-100 transition">
                        Edit
                    </button>
                    <form action="{{route('candidate-delete', ['id'=>$candidate->id])}}" id="deleteForm-{{$candidate->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="confirmDelete({{$candidate->id}})" class="text-sm px-4 py-2 border rounded-lg text-red-600 border-red-300 hover:bg-red-100 transition">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div id="editCandidateModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-xl p-8 relative animate-fade-in">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Candidate</h2>
            <form id="editCandidateForm" action="{{route('candidate-update', ['id' => $candidate->id])}}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="edit_student_id" class="block text-sm font-medium  text-gray-700 mb-1" id="student_id">Select Student</label>
                    <select name="student_id" id="edit_student_id" class="w-full rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 p-2" required>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->email }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="edit_image" class="block text-sm font-medium text-gray-700 mb-1">Change Image</label>
                    <input type="file" name="image" id="edit_image" class="w-full border border-gray-300 rounded-lg p-2">
                </div>

                <div class="flex justify-end gap-4 pt-4">
                    <button type="button" onclick="closeEditCandidateModal()" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg transition">
                        Cancel
                    </button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openCreateCandidateModal() {
            document.getElementById('createCandidateModal').classList.remove('hidden');
        }

        function closeCreateCandidateModal() {
            document.getElementById('createCandidateModal').classList.add('hidden');
        }

        function confirmDelete(id) {
            Swal.fire({
            title: 'Are you sure?',
            text: "This action will delete the candidates permanently!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`deleteForm-${id}`).submit();
            }
        });
        }

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

        function openEditCandidateModal(id, studentId, image) {
            document.getElementById('edit_student_id').value = studentId;
            document.getElementById('editCandidateModal').classList.remove('hidden');
        }

        function closeEditCandidateModal() {
            document.getElementById('editCandidateModal').classList.add('hidden');
        }

    </script>
@endsection
