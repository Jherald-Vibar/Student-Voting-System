@extends('layouts.app')

@section('content')

<div class="p-4">
    <div class="hidden sm:block overflow-x-auto shadow-md sm:rounded-lg">
        <table class="min-w-full table-auto text-sm text-left text-gray-500 dark:text-gray-400 text-center">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-6 py-3">Student Name</th>
                    <th class="px-6 py-3">Section</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">SPCC Email</th>
                    <th class="px-6 py-3">Modality</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $student)
                <tr class="odd:bg-white even:bg-gray-50 dark:odd:bg-gray-900 dark:even:bg-gray-800 border-b dark:border-gray-700">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $student[2] . ' ' . $student[1] . ' ' . $student[3] }}
                    </td>
                    <td class="px-6 py-4">{{ $student[8] ?? 'No Section' }}</td>
                    <td class="px-6 py-4">{{ $student[6] }}</td>
                    <td class="px-6 py-4">{{ $student[4] }}</td>
                    <td class="px-6 py-4">{{ $student[7] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="block sm:hidden space-y-4">
        @foreach ($data as $student)
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 border dark:border-gray-700">
            <p class="text-sm font-semibold text-gray-800 dark:text-white mb-1">
                {{ $student[2] . ' ' . $student[1] . ' ' . $student[3] }}
            </p>
            <p class="text-sm text-gray-600 dark:text-gray-300"><span class="font-medium">Section:</span> {{ $student[8] ?? 'No Section' }}</p>
            <p class="text-sm text-gray-600 dark:text-gray-300"><span class="font-medium">Status:</span> {{ $student[6] }}</p>
            <p class="text-sm text-gray-600 dark:text-gray-300"><span class="font-medium">SPCC Email:</span> {{ $student[4] }}</p>
            <p class="text-sm text-gray-600 dark:text-gray-300"><span class="font-medium">Modality:</span> {{ $student[7] }}</p>
        </div>
        @endforeach
    </div>
</div>

@endsection
