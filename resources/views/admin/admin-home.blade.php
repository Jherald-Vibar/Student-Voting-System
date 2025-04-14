@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="#" class="block bg-white shadow-md rounded-2xl p-5 hover:bg-gray-100 transition">
            <h2 class="text-xl font-semibold mb-2">Manage Elections</h2>
            <p class="text-gray-600">Create, update, or delete elections.</p>
        </a>

        <a href="#" class="block bg-white shadow-md rounded-2xl p-5 hover:bg-gray-100 transition">
            <h2 class="text-xl font-semibold mb-2">Manage Positions</h2>
            <p class="text-gray-600">Add or remove positions for candidates.</p>
        </a>

        <a href="#" class="block bg-white shadow-md rounded-2xl p-5 hover:bg-gray-100 transition">
            <h2 class="text-xl font-semibold mb-2">Manage Candidates</h2>
            <p class="text-gray-600">Assign candidates to positions and elections.</p>
        </a>

        <a href="#" class="block bg-white shadow-md rounded-2xl p-5 hover:bg-gray-100 transition">
            <h2 class="text-xl font-semibold mb-2">View Votes</h2>
            <p class="text-gray-600">Track voting statistics and results.</p>
        </a>

        <a href="#" class="block bg-white shadow-md rounded-2xl p-5 hover:bg-gray-100 transition">
            <h2 class="text-xl font-semibold mb-2">Manage Students</h2>
            <p class="text-gray-600">Add, update, or remove student voters.</p>
        </a>

        <a href="#" class="block bg-white shadow-md rounded-2xl p-5 hover:bg-gray-100 transition">
            <h2 class="text-xl font-semibold mb-2">Admin Settings</h2>
            <p class="text-gray-600">Manage admin accounts and system settings.</p>
        </a>
    </div>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <h2 class="text-xl font-semibold mb-4">Students Who Voted</h2>
                    <table class="min-w-full text-center text-sm font-light text-surface dark:text-white">
                        <thead class="border-b border-neutral-200 bg-[#001f3f] font-medium text-white dark:border-white/10">
                            <tr>
                                <th scope="col" class="px-6 py-4">#</th>
                                <th scope="col" class="px-6 py-4">Name</th>
                                <th scope="col" class="px-6 py-4">Email</th>
                                <th scope="col" class="px-6 py-4">Section</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($students) && $students->count())
                                @foreach ($students as $student)
                                <tr class="border-b border-neutral-200 dark:border-white/10">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $student->id }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $student->name }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $student->email }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $student->section }}</td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-sm font-semibold text-slate-900">
                                        No Student Voted Yet
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
