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
        try {
            $file = File::findOrFail($id);
            return Inertia::render('views/Show', [
                'file' => $file
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }
    public function search()
    {
        return Inertia::render('views/Search', [
            'items' => File::all()
        ]);
    }

    // http://127.0.0.1:8000/images/search?query=image.jpg
    public function searchImages(Request $request)
    {
        try {
            $request->validate([
                'query' => 'required|string|min:3',
            ]);

            $query = $request->input('query');
            $results = File::where('original_file_name', 'like', '%' . $query . '%')->paginate(12);

            if ($results->isEmpty()) {
                return response()->json(['message' => 'Файл не найден.'], 404);
            }

            return response()->json($results, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Server Error'], 500);
        }

    }
    public function edit($id)
    {
        try {
            $file = File::findOrFail($id);
            return Inertia::render('views/Update', [
                'file' => $file
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }
    public function update(Request $request)
    {
        try {

            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($request->hasFile('file')) {
                $originFile = $request->get('originFile');
                $fileDelete = "public/files/" . $originFile;
                Storage::delete($fileDelete);
                $file = $request->file('file');
                $name = $request->get('name');
                $fileName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $size = $request->file('file')->getSize();
                $path = 'public/files/' . $fileName;
                Storage::disk('local')->put($path, file_get_contents($file));
                $pathOriginal = url('/storage/files/'. $fileName);
                $updateFile = File::find($request->get('id'));
                $updateFile->update([
                    'user_entered_name' => $name,
                    'original_file_name' => $fileName,
                    'path' => $pathOriginal,
                    'size' => $size,
                    'extension' => $extension,
                ]);
                return to_route('home');
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    public function create()
    {
        return Inertia::render('views/Create');
    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

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
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $files_db = File::findOrFail($request->id);
            $file = "public/files/" . $files_db->original_file_name;
            Storage::delete($file);
            $files_db->delete();
            return to_route('home');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

}