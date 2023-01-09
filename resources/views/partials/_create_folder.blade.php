<div x-on:click="folderCreate = false" 
class="fixed top-0 left-0 modal-bg h-screen w-full"></div>
<div class="fixed z-20 w-96 bg-red-600 p-5 rounded-lg
left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2">
    <form wire:submit.prevent="createFolder" class="flex flex-col space-y-4">
        <input type="text" placeholder="Folder name..." class="py-2 px-2 text-lg
        rounded-lg" wire:model="folderName">
        <div class="flex justify-center">
            <button type="submit" class="py-1 px-4 font-semibold text-xl text-white
            bg-red-900 w-1/2 rounded-lg" x-on:click="folderCreate = false">Create</button>
        </div>
    </form>
</div>