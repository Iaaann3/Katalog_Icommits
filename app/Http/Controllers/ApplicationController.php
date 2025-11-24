<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::latest()->get();
        return view('pages.admin.dashboard', compact('applications'));
    }

    public function create()
    {
        return view('pages.admin.create');
    }

    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name'        => 'required|string|max:255',
        'slug'        => 'required|alpha_dash|unique:applications',
        'description' => 'required|string',
        'demo_url'    => 'required|url',
        'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        // multiple image clip
        'image_clip'      => 'nullable|array|max:4',
        'image_clip.*'    => 'image|mimes:jpeg,png,jpg,gif|max:2048',

        'status'      => 'sometimes|boolean',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $data = $request->only(['name', 'slug', 'description', 'demo_url']);
    $data['status'] = $request->has('status');

    if (empty($data['slug'])) {
        $data['slug'] = Str::slug($data['name']);
    }

    // UPLOAD 1 GAMBAR UTAMA
    if ($request->hasFile('image')) {
        $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
        $destinationPath = public_path('storage/images/apps');

        if (!File::isDirectory($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true, true);
        }

        $request->file('image')->move($destinationPath, $fileName);
        $data['image'] = '/storage/images/apps/' . $fileName;
    }

    // UPLOAD MULTIPLE IMAGE_CLIP
   $clips = [];

if ($request->hasFile('image_clip')) {

    foreach ($request->file('image_clip') as $clip) {

        $fileName = time() . '_' . $clip->getClientOriginalName();
        $clipPath = public_path('storage/images/apps/clips');

        if (!File::isDirectory($clipPath)) {
            File::makeDirectory($clipPath, 0755, true, true);
        }

        $clip->move($clipPath, $fileName);
        $clips[] = '/storage/images/apps/clips/' . $fileName;
    }
}

$data['image_clip'] = json_encode($clips);

    Application::create($data);

    return redirect()->route('pages.admin.dashboard')
        ->with('success', 'Aplikasi berhasil ditambahkan!');
}


    public function edit(Application $application)
    {
        return view('pages.admin.edit', compact('application'));
    }


    public function update(Request $request, Application $application)
{
    $validator = Validator::make($request->all(), [
        'name'        => 'required|string|max:255',
        'slug'        => 'required|alpha_dash|unique:applications,slug,' . $application->id,
        'description' => 'required|string',
        'demo_url'    => 'required|url',

        // gambar utama
        'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        // clip max 5
        'image_clip'      => 'nullable|array',
        'image_clip.*'    => 'image|mimes:jpeg,png,jpg,gif|max:2048',

        'status'      => 'sometimes|boolean',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $data = $request->only(['name', 'slug', 'description', 'demo_url']);
    $data['status'] = $request->has('status');

    // -------- UPDATE GAMBAR UTAMA --------
    if ($request->hasFile('image')) {
        if ($application->image) {
            $oldFilePath = public_path(ltrim($application->image, '/'));
            if (File::exists($oldFilePath)) {
                File::delete($oldFilePath);
            }
        }

        $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
        $destinationPath = public_path('storage/images/apps');

        if (!File::isDirectory($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true, true);
        }

        $request->file('image')->move($destinationPath, $fileName);
        $data['image'] = '/storage/images/apps/' . $fileName;
    }

    // -------- UPDATE MULTIPLE IMAGE_CLIP --------
   // pastikan existing selalu array
$existing = $application->image_clip;

if (is_string($existing)) {
    $existing = json_decode($existing, true);
}

$existing = $existing ?? []; // kalo null jadikan array kosong

$newCount = $request->hasFile('image_clip') ? count($request->file('image_clip')) : 0;

// LIMIT 5 FOTO
if (count($existing) + $newCount > 5) {
    return redirect()->back()
        ->withErrors(['image_clip' => 'Total image clip tidak boleh lebih dari 5.'])
        ->withInput();
}

// upload clip baru
if ($request->hasFile('image_clip')) {

    foreach ($request->file('image_clip') as $clip) {

        $fileName = time() . '_' . $clip->getClientOriginalName();
        $clipPath = public_path('storage/images/apps/clips');

        if (!File::isDirectory($clipPath)) {
            File::makeDirectory($clipPath, 0755, true, true);
        }

        $clip->move($clipPath, $fileName);
        $existing[] = '/storage/images/apps/clips/' . $fileName;
    }
}

    $data['image_clip'] = json_encode($existing);
    $application->update($data);

    return redirect()->route('pages.admin.dashboard')
        ->with('success', 'Aplikasi berhasil diupdate!');
}




    public function destroy(Application $application)
    {
        // Hapus file gambar jika ada
        if ($application->image) {
            $filePath = public_path(ltrim($application->image, '/'));
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        $application->delete();

        return redirect()->route('pages.admin.dashboard')
            ->with('success', 'Aplikasi berhasil dihapus!');
    }
}