@extends('layout')

@section('content')
    @include('partials._uploadModal')
    <main class="bg-neutral-800 w-full rounded-lg flex justify-center p-20 border-2
    border-zinc-900 shadow-2xl mt-20">
        <div class="flex flex-col space-y-20 w-full">
            <div>
                <h2 class="text-red-800 font-semibold text-3xl shadow-text">YOUR FILES</h2>
            </div>
            <div class="flex flex-col font-semibold w-full shadow-text
            space-y-5">
                <div class="flex justify-between text-2xl text-red-800">
                    <div class="w-full flex justify-center">
                        <span>File Name</span>
                    </div>
                    <div class="w-full flex justify-center">
                        <span>File Size</span>
                    </div>
                    <div class="w-full flex justify-center">
                        <span>File Path</span>
                    </div>
                    <div class="w-full flex justify-center">
                        <span>File Format</span>
                    </div>
                    <div class="w-full flex justify-center">
                        <span>File Date</span>
                    </div>
                    <div class="w-full flex justify-center">
                        <span></span>
                    </div>
                </div>
                @foreach ($files as $file)
                    <div class="flex justify-between text-xl text-white items-center">
                        <div class="w-full flex justify-center items-center">
                            <span>{{$file['name']}}</span>
                        </div>
                        <div class="w-full flex justify-center items-center">
                            <span>{{$file['size']}}</span>
                        </div>
                        <div class="w-full flex justify-center items-center">
                            <span class="">{{$file['location']}}</span>
                        </div>
                        <div class="w-full flex justify-center items-center">
                            <span>{{$file['format']}}</span>
                        </div>
                        <div class="w-full flex justify-center items-center">
                            <span>{{$file['created_at']}}</span>
                        </div>
                        <div class="w-full flex justify-center items-center">
                            <span>
                                <a href="{{$file['location']}}">
                                    <i class="fa-solid fa-download cursor-pointer
                                    text-3xl"></i>
                                </a>
                            </span>
                        </div>
                    </div>
                @endforeach
            </div> 
        </div>
    </main>
@endsection