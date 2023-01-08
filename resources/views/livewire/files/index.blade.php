<main class="bg-neutral-800 w-full rounded-lg flex justify-center p-20 border-2
border-zinc-900 shadow-2xl mt-20">
    <div class="flex flex-col space-y-20 w-full">
        <div>
            <h2 class="text-red-800 font-semibold text-3xl shadow-text">YOUR FILES</h2>
        </div>
        <div class="w-full p-5 bg-red-800 rounded-lg overflow-y-auto h-screen">
            <div class="pb-10 @if ($depth == 0) hidden @endif">
                <i wire:click="goBack" class="fa-solid fa-arrow-left text-4xl cursor-pointer"></i>
            </div>
            @foreach ($folders as $folder)
                <div class="flex items-center space-x-10">
                    <div class="flex flex-col space-y-2 w-fit">
                        <a wire:click="showFiles({{$folder}})">
                            <i class="fa-solid fa-folder cursor-pointer text-8xl"></i>
                        </a>
                        <span class="font-semibold text-2xl text-center">{{$folder->name}}</span>
                    </div>
                    <div>
                        <i class="fa-solid fa-folder-plus cursor-pointer text-6xl"></i>
                    </div>
                </div>
            @endforeach
            <div class="flex space-x-10">
                @foreach ($files as $file)  
                    <div class="flex flex-col space-y-2 w-24 text-center
                    @if (!$showFilesIfNull) hidden @endif">
                        <a download="{{$file->name}}" 
                        href="{{$file->folder->path . "/" . $file->realName}}">
                            <i class="fa-solid fa-file cursor-pointer text-8xl"></i>
                        </a>
                        <span class="font-semibold text-2xl text-center break-words">
                            {{$file->name}}
                        </span>
                    </div>
                @endforeach
                <div class="flex space-x-5 items-center @if (!$showFilesIfNull) hidden @endif">
                    <i class="fa-solid fa-folder-plus cursor-pointer text-6xl"></i>
                    <form wire:submit.prevent="upload" class="hidden">
                        <input 
                        id="file" 
                        type="file" 
                        wire:model="uploadedFile" 
                        onchange="setTimeout(() => {document.getElementById('uploadBtn').click()}, 1000)">
                        <button id="uploadBtn" type="submit"></button>
                    </form>
                    @error('uploadedFile') <span class="error">{{ $message }}</span> @enderror
                    <label for="file" 
                    class="fa-solid fa-file-circle-plus cursor-pointer text-6xl"></label>   
                </div>
            </div>
        </div>
    </div>
</main>