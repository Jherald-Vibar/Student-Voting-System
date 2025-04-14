@extends('layouts.app')
@section('content')
<section class="gradient-form h-full bg-neutral-200 dark:bg-neutral-700">
    <div class="container h-full p-10">
      <div class="flex h-full flex-wrap items-center justify-center text-neutral-800 dark:text-neutral-200">
        <div class="w-full">
          <div class="block rounded-lg bg-white shadow-lg dark:bg-neutral-800">
            <div class="g-0 lg:flex lg:flex-wrap">
              <!-- Left column container-->
              <div class="px-4 md:px-0 lg:w-6/12">
                <div class="md:mx-6 md:p-12">
                  <!--Logo-->
                  <div class="text-center">
                    <img class="mx-auto w-32 mb-5" src="{{asset('img/spcc.png')}}" alt="logo" />
                  </div>
                  <form action="{{route('authenticate')}}" method="POST">
                    @csrf
                    <p class="mb-4">Please login to your account</p>
                    <div class="relative mb-4" data-twe-input-wrapper-init>
                      <input
                        type="text"
                        placeholder="email"
                        class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear dark:text-white dark:placeholder:text-neutral-300"
                        id="exampleFormControlInput1"
                        name="email" />
                    </div>
                    <div class="relative mb-4" data-twe-input-wrapper-init>
                      <input
                        type="password"
                        placeholder="password"
                        class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear dark:text-white dark:placeholder:text-neutral-300"
                        id="exampleFormControlInput11"
                        name="password" />
                    </div>
                    <div class="mb-12 pb-1 pt-1 text-center">
                      <button
                        class="mb-3 inline-block w-full rounded px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-dark-3 transition duration-150 ease-in-out hover:shadow-dark-2 focus:shadow-dark-2 focus:outline-none focus:ring-0 active:shadow-dark-2 dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong bg-[#001f3f]"
                        type="submit"
                        data-twe-ripple-init
                        data-twe-ripple-color="light">
                        Log in
                      </button>
                      <a href="#!">Forgot password?</a>
                    </div>
                    <div class="flex items-center justify-between pb-6">
                      <p class="mb-0 me-2">Don't have an account?</p>
                      <button
                        type="button"
                        onclick="window.location.href='{{ route('verify') }}';"
                        class="inline-block rounded border-2  border-danger px-6 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-danger transition duration-150 ease-in-out hover:border-danger-600 hover:bg-danger-50/50 hover:text-danger-600 focus:border-danger-600 focus:bg-danger-50/50 focus:text-danger-600 focus:outline-none focus:ring-0 active:border-danger-700 active:text-danger-700 dark:hover:bg-rose-950 dark:focus:bg-rose-950"
                        data-twe-ripple-init
                        data-twe-ripple-color="light">
                        Register
                      </button>
                    </div>
                  </form>
                </div>
              </div>
              <div class="flex items-center rounded-b-lg lg:w-6/12 lg:rounded-e-lg lg:rounded-bl-none bg-cover bg-center bg-no-repeat"
              style="background-image: url('{{ asset('img/right-img.jpg') }}');">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<script>
  import { Input, Ripple, initTWE } from "tw-elements";

  initTWE({ Input, Ripple });
</script>
@endsection
