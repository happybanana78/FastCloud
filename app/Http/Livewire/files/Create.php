<?php

namespace App\Http\Livewire\files;

use App\Models\File;
use App\Models\Folder;
use Livewire\Component;

class Create extends Component
{
    public $folders;
    public $files;

    public function mount() {
        $this->folders = Folder::all();
    }

    public function getFiles($path) {
        $this->files = File::select()
            ->where(File::with('file.folder'), $path)
            ->get();
        dd($this->files);
    }

    public function render()
    {
        return view('livewire.files.create');
    }
}
