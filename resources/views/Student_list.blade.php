@extends('layouts.app')
@section('content')
<div class="relative shadow-md sm:rounded-lg">
<table class="w-3/4 table-auto text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mx-auto text-center">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">Student Name</th>
            <th scope="col" class="px-6 py-3">Section</th>
            <th scope="col" class="px-6 py-3">Status</th>
            <th scope="col" class="px-6 py-3">SPCC Email</th>
            <th scope="col" class="px-6 py-3">Modality</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $student)
        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{$student[5] . ' ' . $student[4] . ' ' . $student[6]}}
            </th>
            <td class="px-6 py-4">
                {{$student[11] ?? 'No Section'}}
            </td>
            <td class="px-6 py-4">
                {{$student[9]}}
            </td>
            <td class="px-6 py-4">
                {{$student[7]}}
            </td>
            <td class="px-6 py-4">
                {{$student[10]}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>


@endsection
