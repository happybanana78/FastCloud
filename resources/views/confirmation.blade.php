@extends('layout')

@section('confirmation')
    <section class="mt-20 px-20">
        <div class="bg-red-500 p-5 space-y-10">
            <div class="w-full flex justify-center">
                
                    <span class="font-semibold text-white text-3xl">Folder created successfully and file
                        uploaded to the same path.</span>
                
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