<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class FileController extends Controller
{
    // Get folders list
    public function index()
    {
        $path = 'assets/files';
        $folderNameList = [];
        $folderList = scandir($path);

        // Get all folders names
        foreach ($folderList as $folder) {
            if (basename($folder) != '.' && basename($folder) != '..') {
                if (is_dir($path . "/" . basename($folder))) {
                    array_push($folderNameList, basename($folder));
                }
            }
        }

        // Get all file names
        foreach ($folderList as $folder) {
            if (basename($folder) != '.' && basename($folder) != '..') {
                if (!is_dir($path . "/" . basename($folder))) {
                    $this->setFileInfo($folder, $path);
                } else {
                    $subDir = scandir($path . "/" . basename($folder));
                    foreach ($subDir as $folder2) {
                        if (basename($folder2) != '.' && basename($folder2) != '..') {
                            if (!is_dir($path . "/" . basename($folder) . "/" . basename($folder2))) {
                                $this->setFileInfo($folder2, $path . "/" . basename($folder));
                            } else {
                                $subDir2 = scandir($path . "/" . basename($folder) . "/" . basename($folder2));
                                foreach ($subDir2 as $folder3) {
                                    if (basename($folder3) != '.' && basename($folder3) != '..') {
                                        if (!is_dir($path . "/" . basename($folder) . "/" . basename($folder2) . "/" .
                                            basename($folder3))) {
                                            $this->setFileInfo($folder3, $path . "/" . basename($folder) . "/" .
                                                basename($folder2));
                                        } else {
                                            $subDir3 = scandir($path . "/" . basename($folder) . "/" . basename($folder2) .
                                                "/" . basename($folder3));
                                            foreach ($subDir3 as $folder4) {
                                                if (basename($folder4) != '.' && basename($folder4) != '..') {
                                                    if (!is_dir($path . "/" . basename($folder) . "/" . basename($folder2) . "/" .
                                                        basename($folder3) . "/" . basename($folder4))) {
                                                        $this->setFileInfo($folder4, $path . "/" . basename($folder) . "/" .
                                                            basename($folder2) . "/" . $folder3);
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return view('main', [
            "folders" => $folderNameList,
            "files" => File::all(),
        ]);
    }

    // Set files
    private function setFileInfo($file, $path)
    {
        // Set file name
        $filterFile = explode(".", basename($file));
        $readableName = $filterFile[1] . "." . $filterFile[2];
        // Set file path
        $filePath = $path;
        // Set file size
        $fileSize = round(filesize($path . "/" . basename($file)));
        $editedFileSize = "";
        if ($fileSize <= 1024.4 * 1000) {
            $editedFileSize = round($fileSize / 1024.4, 1) . " " . "KB";
        }
        if ($fileSize <= (1024.4 * 1000) * 1000 && $fileSize > 1024.4 * 1000) {
            $editedFileSize = round($fileSize / 1024.4 / 1024.4, 1) . " " . "MB";
        }
        if ($fileSize > (1024.4 * 1000) * 1000) {
            $editedFileSize = round($fileSize / 1024.4 / 1024.4 / 1024.4, 1) . " " . "GB";
        }
        // Set file extension
        $filterFileExtension = explode(".", basename($file));
        $fileExtension = $filterFileExtension[2];

        // Check if the file entry has already been created
        $fileRecord = File::where('realName', "=", basename($file))->first();

        if ($fileRecord === null) {
            File::create([
                "realName" => basename($file),
                "name" => $readableName,
                "location" => $filePath,
                "size" => $editedFileSize,
                "format" => $fileExtension,
            ]);
        }
    }

    // Route to confirmation page
    public function toConfirmation()
    {
        return view('confirmation');
    }

    // Get sub folders
    public function getSubDir(Request $request)
    {
        $subFolderList = [];

        if ($request->input('parent') != "choose") {
            $path = "assets/files/" . $request->input('parent');
            $parentDir = scandir($path);

            foreach ($parentDir as $sub) {
                if (
                    basename($sub) != "." && basename($sub) != ".."
                    && is_dir($path . "/" . $sub)
                ) {
                    array_push($subFolderList, basename($sub));
                }
            }

            if (empty($subFolderList)) {
                return Response()->json('nope');
            } else {
                return Response()->json($subFolderList);
            }
        } else {
            return Response()->json('nope');
        }
    }

    // Create new folder
    public function createFolder(Request $request)
    {
        if ($request->input('subfolderPath') == 'choose' && $request->input('folderPath') != 'choose') {
            $path = "assets/files/" . $request->input('folderPath') .
                "/" . $request->input('folderName');
            $simplePath = $request->input('folderPath') .
                "/" . $request->input('folderName');
        } else if ($request->input('subfolderPath') != 'choose' && $request->input('folderPath') != 'choose') {
            $path = "assets/files/" . $request->input('folderPath') .
                "/" . $request->input('subfolderPath') . "/" . $request->input('folderName');
            $simplePath = $request->input('folderPath') .
                "/" . $request->input('subfolderPath') . "/" . $request->input('folderName');
        } else if ($request->input('folderPath') == 'choose') {
            $path = "assets/files/" . $request->input('folderName');
            $simplePath = $request->input('folderName');
        }

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
            $this->fileUpload($request->file('files'), $simplePath);
            return redirect("/confirmation")->with('createSuccess', 'Folder created successfully and file uploaded
            to the same path.');
        } else {
            return redirect("/confirmation")->with('createError', 'The folder already exists!');
        }
    }

    // Upload file after folder creation
    private function fileUpload($files, $path)
    {
        //Storage::disk('files')->put($path, $file);
        foreach ($files as $file) {
            $file->storeAs($path, md5($file->getRealPath()) . "." . $file->getClientOriginalName(), 'files');
        }
    }

    // Stand alone upload file
    public function uploadFile(Request $request)
    {
        if ($request->input('subfolderPath') == 'choose' && $request->input('folderPath') != 'choose') {
            $path = $request->input('folderPath');
        } else if ($request->input('subfolderPath') != 'choose' && $request->input('folderPath') != 'choose') {
            $path = $request->input('folderPath') . "/" . $request->input('subfolderPath');
        } else if ($request->input('folderPath') == 'choose') {
            $path = "";
        }

        if (!file_exists($path)) {
            $files = $request->file('files');
            foreach ($files as $file) {
                $file->storeAs($path, md5($file->getRealPath()) . "." . $file->getClientOriginalName(), 'files');
                return redirect("/confirmation")->with('uploadSuccess', 'File uploaded successfully.');
            }
        } else {
            return redirect("/confirmation")->with('uploadError', 'The file already exists!');
        }
    }
}

// Manage upload of multiple files (to do)