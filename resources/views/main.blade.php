@extends('layout')

@section('content')
    @include('partials._uploadModal')
    <main class="bg-neutral-800 w-full rounded-lg flex justify-center p-20 border-2
    border-zinc-900 shadow-2xl mt-20">
        <div class="flex flex-col space-y-20 w-full">
            <div>
                <h2 class="text-red-800 font-semibold text-3xl shadow-text">YOUR FILES</h2>
            </div>
            <div class="flex justify-between items-center font-semibold text-xl text-red-800
            w-full shadow-text">
                <span>File Name</span>
                <span>File Size</span>
                <span>File Format</span>
                <span>Upload Date</span>
            </div> 
        </div>
    </main>
@endsection