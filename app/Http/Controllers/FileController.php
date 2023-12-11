<?php

namespace App\Http\Controllers;

use App\Models\File;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index()
    {
        $files = File::paginate(50);

        return Inertia::render('views/Home', [
            'files' => $files
        ]);
    }


    public function show($id)
    {
        $file = File::findOrFail($id);

        return Inertia::render('views/Show', [
            'file' => $file
        ]);
    }

    public function search()
    {
        return Inertia::render('views/Search', [
            'items' => File::all()
        ]);
    }

    public function create()
    {
        return Inertia::render('views/Create');
    }

    public function store(Request $request)
    {
        if ($request->hasFile('file')) {

            $file = $request->file('file');

            $fileName = $file->getClientOriginalName();

            $extension = $file->getClientOriginalExtension();

            $size = $request->file('file')->getSize();

            $path = 'public/files/' . $fileName;

            Storage::disk('local')->put($path, file_get_contents($file));

            $pathOriginal = url('/storage/files/'. $fileName);

            File::create([
                'user_entered_name' => $request->name,
                'original_file_name' => $fileName,
                'path' => $pathOriginal,
                'size' => $size,
                'extension' => $extension,
            ]);

            return to_route('home');
        }

    }

    public function destroy(Request $request)
    {
        $files_db = File::findOrFail($request->id);

        $file = "public/files/" . $files_db->original_file_name;

        Storage::delete($file);

        $files_db->delete();

        return to_route('home');
    }

}