<main class="bg-neutral-800 w-full rounded-lg flex justify-center p-20 border-2
border-zinc-900 shadow-2xl mt-20">
    <div class="flex flex-col space-y-20 w-full">
        <div>
            <h2 class="text-red-800 font-semibold text-3xl shadow-text">YOUR FILES</h2>
        </div>
        <div class="w-full p-5 bg-red-500 rounded-lg overflow-y-auto h-screen">
            <div class="pb-10 @if ($depth == 0) hidden @endif">
                <i class="fa-solid fa-arrow-left text-4xl cursor-pointer"></i>
            </div>
            @foreach ($folders as $folder)
                <div class="flex flex-col space-y-2 w-fit">
                    <a wire:click="showFiles"><i class="fa-solid fa-folder cursor-pointer text-8xl"></i></a>
                    <span class="font-semibold text-2xl text-center">{{$folder->name}}</span>
                </div>
            @endforeach
            @foreach ($files as $file)
                <div class="flex flex-col space-y-2 w-fit">
                    <a><i class="fa-solid fa-file cursor-pointer text-8xl"></i></a>
                    <span class="font-semibold text-2xl text-center">{{$file->realName}}</span>
                </div>
            @endforeach
        </div>
    </div>
</main>