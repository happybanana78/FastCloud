<?php

namespace App\Http\Livewire\files;

use App\Models\File;
use App\Models\Folder;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $folders;    // List of folders
    public Folder $folder;  // Data of specific clicked folder
    public $files = []; // List of files in folder
    public $depth = 0;  // Depth level of clicked folder
    public $showFilesIfNull;    // Don't show files in folder if $folder value is null
    public $uploadedFile;   // Uploaded file data

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

        $this->getFiles();
        $this->getFolders();
    }

    // Handle new file upload
    public function upload() {
        $file = $this->uploadedFile->store('public/files');
        $splitFile = explode("/", $file);
        $fileTempName = $splitFile[count($splitFile) - 1];
        $fileExtension = explode(".", $fileTempName)[1];
        $fileSize = $this->uploadedFile->getSize();

        File::create([
            'realName' => $fileTempName,
            'name' => $this->uploadedFile->getClientOriginalName(),
            'size' => $fileSize,
            'format' => $fileExtension,
            'folder_id' => $this->folder->id,
        ]);

        $this->getFiles();
        $this->getFolders();
    }

    public function render()
    {
        return view('livewire.files.index');
    }
}
