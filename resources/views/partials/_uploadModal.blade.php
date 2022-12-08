<div id="modal-back" class="fixed top-0 left-0 h-screen w-full modal-back-bg z-10 hidden"></div>
<div id="upload-modal" class="p-10 bg-red-800 w-1/2 rounded-lg z-20 hidden
absolute top-48 left-1/2 -translate-x-1/2">
    <div id="upload-buttons" class="flex items-center space-x-10">
        <button id="upload" class="w-full px-4 py-2 rounded-full bg-red-500 border-2 border-red-900
        text-xl text-white">UPLOAD</button>
        <button id="create-folder" class="w-full px-4 py-2 rounded-full bg-red-500 border-2 border-red-900
        text-xl text-white">CREATE FOLDER</button>
    </div>
    <form id="upload-form" action="" class="hidden">
        @csrf
        <div>
            <div class="relative">
                <div class="absolute top-0 left-0 text-4xl text-white">
                    <i id="upload-back" class="fa-solid fa-arrow-left cursor-pointer"></i>
                </div>
                <div class="flex justify-center mb-10">
                    <label class="text-4xl text-white font-semibold" for="">
                        UPLOAD
                    </label>
                </div>
                <div class="flex items-center space-x-5">
                    <select name="" id="" class="w-full p-2 text-2xl rounded-lg bg-neutral-800 text-white">
                        <option value="" selected>Choose folder</option>
                        <option value="">2</option>
                        <option value="">2</option>
                        <option value="">2</option>
                    </select>
                    <select name="" id="" class="w-full p-2 text-2xl rounded-lg bg-neutral-800 text-white">
                        <option value="" selected>Choose sub folder</option>
                        <option value="">2</option>
                        <option value="">2</option>
                        <option value="">2</option>
                    </select>
                    <button class="w-full px-4 py-2 rounded-full bg-red-500 border-2 border-red-900
                    text-2xl text-white font-semibold">
                        Select File
                    </button>
                </div>
                <div class="flex justify-center text-7xl text-white items-center mt-20">
                    <i class="fa-solid fa-cloud-arrow-up rounded-full
                    bg-red-900 p-10 cursor-pointer"></i>
                </div>
            </div>
        </div>
    </form>
    <form id="create-form" action="/files/folder/create" method="POST" class="hidden">
        @csrf
        <div>
            <div class="relative">
                <div class="absolute top-0 left-0 text-4xl text-white">
                    <i id="create-back" class="fa-solid fa-arrow-left cursor-pointer"></i>
                </div>
                <div class="flex justify-center mb-10">
                    <label class="text-4xl text-white font-semibold">
                        CREATE FOLDER
                    </label>
                </div>
                <div class="flex items-center space-x-5">
                    <input type="text" placeholder="Folder name..." name="folderName" autocomplete="off"
                    class="w-full p-2 text-2xl rounded-lg 
                    bg-neutral-800 text-white">
                    <input type="file" id="folder-file" class="hidden">
                    <select name="folderPath" id="folder-path" 
                    class="w-full p-2 text-2xl rounded-lg bg-neutral-800 text-white">
                        <option value="" selected>Choose folder path</option>
                        @foreach ($folders as $folder)
                            <option value="{{$folder}}">{{$folder}}</option>
                        @endforeach
                    </select>
                    @if (!$isSub)
                        <select name="subfolderPath" id="subfolder-path" 
                        class="w-full p-2 text-2xl rounded-lg bg-neutral-800 text-white" disabled>
                            <option value="" selected>Choose sub folder path</option>
                        </select>
                    @endif
                    @if ($isSub)
                        <select name="subfolderPath" id="subfolder-path" 
                        class="w-full p-2 text-2xl rounded-lg bg-neutral-800 text-white">
                            <option value="" selected>Choose sub folder path</option>
                            @foreach ($subfolders as $subfolder)
                                <option value="{{$subfolder}}">{{$subfolder}}</option>
                            @endforeach
                        </select>
                    @endif
                    
                    <button class="w-full px-4 py-2 rounded-full bg-red-500 border-2 border-red-900
                    text-2xl text-white font-semibold" onclick="document.getElementById('folder-file').click()">
                        Select File
                    </button>
                </div>
                <div class="flex justify-center text-7xl text-white items-center mt-20">
                    <i class="fa-solid fa-cloud-arrow-up rounded-full
                    bg-red-900 p-10 cursor-pointer" 
                    onclick="document.getElementById('create-form').submit()"></i>
                </div>
            </div>
        </div>
    </form>
</div>
