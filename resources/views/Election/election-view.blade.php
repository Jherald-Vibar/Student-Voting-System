@extends('layouts.app')
@section('content')


        <div class="bg-[#001f3f] text-white p-6 shadow-md mb-8">
            <h1 class="text-3xl font-bold">{{$election->title}} | {{$election->start_date}}</h1>
            <p class="mt-2 text-sm">{{$election->description}}</p>
        </div>

        <div class="flex justify-end mr-5">
            <button class="bg-blue-400 rounded-lg mt-5 px-6 py-3 font-bold hover:bg-white hover:text-black text-lg transition duration-300" onclick="openPositionModal()">
                Create Position
            </button>
        </div>

        <div id="addPosition" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6 animate-fade-in">
                <h2 class="text-xl font-semibold mb-4">Add Position</h2>
                <form action="{{route('position-store', ['id' => $election->id])}}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Position Title</label>
                        <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Position Description</label>
                        <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>

                    <div class="flex justify-between gap-3 pt-4">
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
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10 ml-5">
            @foreach($positions as $position)
            <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl text-center transition duration-300 hover:scale-105 transform">
                <a href="{{route('position-view', ['eid' => $election->id, 'pid' => $position->id])}}" class="flex items-center justify-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">{{ $position->title }}</h2>
                </a>
            </div>
            @endforeach
        </div>

<script>
    function openPositionModal()  {
        document.getElementById('addPosition').classList.remove('hidden');
    }

    function closePositionModal() {
        document.getElementById('addPosition').classList.add('hidden');
    }
</script>
@endsection
