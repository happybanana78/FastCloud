@extends('layout')

@section('confirmation')
    <section class="mt-20 px-20">
        <div class="bg-red-500 p-5 space-y-10">
            <div class="w-full flex justify-center">
                @if (session()->has("uploadSuccess"))
                    <span class="font-semibold text-white text-3xl">
                        {{session()->get("uploadSuccess")}}
                    </span>
                @endif
                @if (session()->has("uploadError"))
                    <span class="font-semibold text-white text-3xl">
                        {{session()->get("uploadError")}}
                    </span>
                @endif
                @if (session()->has("createSuccess"))
                    <span class="font-semibold text-white text-3xl">
                        {{session()->get("createSuccess")}}
                    </span>
                @endif
                @if (session()->has("createError"))
                    <span class="font-semibold text-white text-3xl">
                        {{session()->get("createError")}}
                    </span>
                @endif
            </div>
            <div class="w-full flex justify-center">
                <a href="/" class="px-4 py-2 bg-red-800 border-2 border-red-900 text-white font-semibold
                rounded-lg flex items-center text-2xl hover:border-red-200 ease-in duration-200">
                    <i class="fa-solid fa-house mr-2"></i>
                    <span>Back to home</span>
                </a>
            </div>
        </div>
    </section>
@endsection