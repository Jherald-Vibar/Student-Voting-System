<!-- resources/views/notifications/index.blade.php -->
@extends('layouts.app')
@vite(['resources/css/app.css','resources/js/app.js'])
@section('content')
    <div class="container">
        <h1>Overdue Borrowers</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Borrower</th>
                    <th>Due Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($borrowers as $borrower)
                    <tr>
                        <td>{{ $borrower->name }}</td>
                        <td>{{ $borrower->due_date->format('Y-m-d') }}</td>
                        <td>
                            <form action="{{ route('notifications.sendEmail', $borrower->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Send Email</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

