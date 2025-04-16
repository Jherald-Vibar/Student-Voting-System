@extends('layouts.app')

@section('content')
<div class="max-w-5xl w-full mx-auto py-10 px-6">
    @include('layouts.breadcrumb')
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Edit Election</h1>
    <div class="bg-white p-8 rounded-2xl shadow-lg">
        <form action="{{ route('election-update', ['id' => $election->id]) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Election Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $election->title) }}" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" id="description" rows="4" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none resize-none">{{ old('description', $election->description) }}</textarea>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                    <input type="datetime-local" name="start_date" id="start_date" value="{{ \Carbon\Carbon::parse($election->start_date)->format('Y-m-d\TH:i') }}" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                    <input type="datetime-local" name="end_date" id="end_date" value="{{ \Carbon\Carbon::parse($election->end_date)->format('Y-m-d\TH:i') }}" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>
            </div>
            <div class="mt-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Positions</h3>

                @foreach($election->positions as $position)
                    <div class="flex items-center space-x-4 mb-3">
                        <input type="text" name="positions[{{ $position->id }}]" value="{{ old('positions.' . $position->id, $position->title) }}" class="flex-1 border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                    </div>
                @endforeach
                <div id="new-positions"></div>
                <button type="button" onclick="addPosition()" class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition">
                    + Add Position
                </button>
            </div>
            <div class="flex justify-end space-x-4 pt-6">
                <a href="{{ route('election-index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-xl hover:bg-gray-300 transition">Cancel</a>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition">Update Election</button>
            </div>
        </form>
    </div>
</div>


<script>
    function addPosition() {
        const container = document.getElementById('new-positions');
        const div = document.createElement('div');
        div.className = 'flex items-center space-x-4 mb-3';
        div.innerHTML = `
            <input type="text" name="positions[new][]" class="flex-1 border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
            <button type="button" onclick="removePosition(this)" class="text-red-500 hover:text-red-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        `;
        container.appendChild(div);
    }

    function removePosition(button) {
    const container = button.closest('div');
    const input = container.querySelector('input[name^="positions["]');
    const match = input.name.match(/positions\[(\d+)\]/);

    if (match) {
        const removedId = match[1];
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'removed_positions[]';
        hiddenInput.value = removedId;
        document.querySelector('form').appendChild(hiddenInput);
    }

    container.remove();
    }
</script>
@endsection
