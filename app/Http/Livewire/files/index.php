<?php

namespace App\Http\Livewire\files;

use App\Models\File;
use App\Models\Folder;
use Livewire\Component;

class Index extends Component
{
    public $folders;
    public $files = [];
    public $depth = 0;

    public function mount() {
        
        $this->getFolders();
    }

    public function showFiles() {
        $this->depth += 1;  // show file/folders contained in clicked folder

        $this->getFiles();

        $this->getFolders();
    }

    private function getFolders() {

        $this->folders = Folder::select()
            ->where('sorting', $this->depth)
            ->get();
    }

    private function getFiles() {

        $this->files = File::select()
            ->where('folder_id', 1)
            ->get();
    }

    public function render()
    {
        return view('livewire.files.index');
    }
}
