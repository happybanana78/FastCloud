<div class="bg-neutral-800 w-full rounded-lg p-20 border-2
border-zinc-900 shadow-2xl mt-20 overflow-y-auto h-screen">
    <div class="pb-10 hidden">
        <i class="fa-solid fa-arrow-left text-4xl cursor-pointer"></i>
    </div>
    @foreach ($folders as $folder)
        @if ($folder->sorting == 0)
            <div class="flex flex-col space-y-2 w-fit">
                <a wire:click="getFiles({{1}})">
                    <i class="fa-solid fa-folder-plus cursor-pointer text-8xl"></i>
                </a>
                <span class="font-semibold text-2xl text-center">{{$folder->name}}</span>
            </div>
        @endif
    @endforeach
</div>