@extends('layouts.app')

@section('content')
<section class="gradient-form h-full bg-neutral-200 dark:bg-neutral-700">
    <div class="container h-full p-10">
        <div class="flex h-full flex-wrap items-center justify-center text-neutral-800 dark:text-neutral-200">
            <div class="w-full">
                <div class="block rounded-lg bg-white shadow-lg dark:bg-neutral-800">
                    <div class="g-0 lg:flex lg:flex-wrap">
                        <div class="px-4 md:px-0 lg:w-6/12">
                            <div class="md:mx-6 md:p-12">
                                <div class="text-center">
                                    <img class="mx-auto w-32 mb-5" src="{{asset('img/spcc.png')}}" alt="logo" />
                                </div>
                                <form method="POST" action="{{ route('verification') }}">
                                    @csrf
                                    <p class="mb-4">Create a new account</p>
                                    <div class="relative mb-4" data-twe-input-wrapper-init>
                                        <input type="text" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear dark:text-white dark:placeholder:text-neutral-300"
                                            id="student_number" name="student_number" placeholder="Student Number" value="{{ old('student_number') }}" required autofocus />
                                    </div>
                                    <div class="mb-12 pb-1 pt-1 text-center">
                                        <button type="submit" class="mb-3 inline-block w-full rounded px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-dark-3 transition duration-150 ease-in-out hover:shadow-dark-2 focus:shadow-dark-2 focus:outline-none focus:ring-0 active:shadow-dark-2 dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong bg-gray-700">
                                            Verify Student Number
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="flex items-center rounded-b-lg lg:w-6/12 lg:rounded-e-lg lg:rounded-bl-none bg-contain bg-center" style="background-image: url({{asset('img/right-img.jpg')}});">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if (session('success'))
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Verification',
                text: '{{ session('success') }}',
                icon: 'success',
            });
        });
    @endif

    @if (session('error'))
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Verification',
                text: '{{ session('error') }}',
                icon: 'error',
            });
        });
    @endif
</script>

<script>
    import { Input, Ripple, initTWE } from "tw-elements";
    initTWE({ Input, Ripple });
</script>

@endsection
