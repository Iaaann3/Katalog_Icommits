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
            'status'      => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['name', 'slug', 'description', 'demo_url', 'status']);
        $data['status'] = $request->has('status');

        // Generate slug jika kosong
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        // Handle upload image — SIMPAN LANGSUNG KE public/
        if ($request->hasFile('image')) {
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $destinationPath = public_path('storage/images/apps');

            // Buat folder jika belum ada
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            $request->file('image')->move($destinationPath, $fileName);
            $data['image'] = '/storage/images/apps/' . $fileName;
        }

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
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status'      => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['name', 'slug', 'description', 'demo_url', 'status']);
        $data['status'] = $request->has('status');

        // Handle image upload
        if ($request->hasFile('image')) {
            // Hapus file lama jika ada
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