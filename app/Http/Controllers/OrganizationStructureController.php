<?php

namespace App\Http\Controllers;

use App\Models\OrganizationStructure;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class OrganizationStructureController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:Admin'])->except(['index']);
    }

    public function index()
    {
        $structures = OrganizationStructure::where('is_active', true)
            ->orderBy('order')
            ->get();
        return view('organization.index', compact('structures'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/organization');
            $data['photo_path'] = Storage::url($path);
        }

        OrganizationStructure::create($data);

        return redirect()->route('organization.index')
            ->with('success', 'Pengurus berhasil ditambahkan');
    }
}
