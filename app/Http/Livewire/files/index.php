<?php

namespace App\Http\Livewire\files;

use App\Models\File;
use App\Models\Folder;
use Livewire\Component;

class Index extends Component
{
    public $folders;    // List of folders
    public Folder $folder;  // Data of specific clicked folder
    public $files = []; // List of files in folder
    public $depth = 0;  // Depth level of clicked folder
    public $showFilesIfNull;    // Don't show files in folder if $folder value is null
    public $file;   // Uploaded file data

    public function mount() {
        
        $this->getFolders();
    }

    // Show all files and folders
    public function showFiles(Folder $folder) {
        $this->depth += 1;  // show file/folders contained in clicked folder
        $this->folder = $folder;
        $this->showFilesIfNull = true;

        $this->getFiles();

        $this->getFolders();
    }

    // Get all folders at the specified depth level
    private function getFolders() {

        $this->folders = Folder::select()
            ->where('sorting', $this->depth)
            ->get();
    }

    // Get all files in selected folder
    private function getFiles() {

        $this->files = File::select()
            ->where('folder_id', $this->folder->id)
            ->get();
    }

    // Navigate back to previous folders
    public function goBack() {
        $this->depth -= 1;
        $folderCheck = Folder::select()
            ->where('id', "<", $this->folder->id)
            ->orderBy('id')
            ->first();
        
        if (!is_null($folderCheck)) {
            $this->folder = $folderCheck;
            $this->getFiles();
        } else {
            $this->showFilesIfNull = false;
        }

        $this->getFolders();
    }

    // Handle new file upload
    public function upload() {
        // TO-DO
    }

    public function render()
    {
        return view('livewire.files.index');
    }
}
