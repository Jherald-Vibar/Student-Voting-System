@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-4xl font-bold mb-10 text-gray-800">Admin Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <div class="bg-gradient-to-br from-blue-500 to-blue-700 text-white p-6 rounded-2xl shadow-lg text-center">
            <div class="text-3xl font-bold mb-2">{{ $totalStudents }}</div>
            <div class="text-sm uppercase tracking-widest">Total Registered Students</div>
        </div>
        <div class="bg-gradient-to-br from-green-500 to-green-700 text-white p-6 rounded-2xl shadow-lg text-center">
            <div class="text-3xl font-bold mb-2">{{ $totalElections }}</div>
            <div class="text-sm uppercase tracking-widest">Total Elections</div>
        </div>
        <a href="{{ route('election-winner') }}" class="bg-gradient-to-br from-purple-500 to-purple-700 text-white p-6 rounded-2xl shadow-lg text-center hover:scale-105 transition-transform">
            <div class="text-3xl font-bold mb-2">🏆</div>
            <div class="text-sm uppercase tracking-widest">View Results</div>
        </a>
        <a href="{{ route('admin-result') }}" class="bg-gradient-to-br from-red-500 to-red-700 text-white p-6 rounded-2xl shadow-lg text-center hover:scale-105 transition-transform">
            <div class="text-3xl font-bold mb-2">📊</div>
            <div class="text-sm uppercase tracking-widest">Track Votes</div>
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800">Recently Voted Students</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Section</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if(!empty($students) && $students->count())
                        @foreach ($students as $student)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $student->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">{{ $student->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $student->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $student->section }}</td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">No Student Voted Yet</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
