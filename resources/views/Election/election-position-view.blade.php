@extends('layouts.app')
@section('content')
<div class="container mx-auto px-4">
    <div class="bg-[#001f3f] text-white p-6 shadow-md mb-8 rounded-xl">
        <h1 class="text-3xl font-bold">{{ $election->title }} | {{ $election->start_date }}</h1>
        <p class="mt-2 text-sm">{{ $election->description }}</p>
    </div>

    @include('layouts.breadcrumb')

    <div class="flex justify-start mb-6">
        <button
            class=" bg-[#001f3f] text-white rounded-lg px-6 py-3 font-semibold hover:text-blue-600 ansition duration-300"
            onclick="window.location.href='{{ route('election-index', ['id' => $election->id]) }}'">
            &larr;
        </button>
    </div>
    <div class="flex justify-end mb-6">
        <button onclick="openPositionModal()" class="bg-[#001f3f] hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-medium transition duration-300">
            + Add Position
        </button>
    </div>
    <div id="addPosition" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6 animate-fade-in">
            <h2 class="text-xl font-semibold mb-4">Add Position</h2>
            <form action="{{ route('position-store', ['id' => $election->id]) }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Position Title</label>
                    <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Position Description</label>
                    <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" onclick="closePositionModal()" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-xl hover:bg-gray-400 transition">
                        Cancel
                    </button>
                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition duration-300">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-10">
        @foreach($positions as $position)
        <div class="relative group">
            <a href="{{ route('position-view', ['eid' => $election->id, 'pid' => $position->id]) }}">
                <div class="bg-white p-6 rounded-xl shadow-md text-center hover:shadow-xl transition duration-300 hover:scale-105 transform">
                    <h2 class="text-xl font-semibold text-gray-800">{{ $position->title }}</h2>
                </div>
            </a>
            <form action="{{route('position-delete', ['id' => $position->id])}}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this position?');"
                class="absolute top-5 right-2 hidden group-hover:block">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white rounded-full p-2 hover:bg-red-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </form>
        </div>
        @endforeach
    </div>

</div>

<script>
    function openPositionModal() {
        document.getElementById('addPosition').classList.remove('hidden');
    }

    function closePositionModal() {
        document.getElementById('addPosition').classList.add('hidden');
    }
</script>
@endsection
