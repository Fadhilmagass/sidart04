<?php

namespace App\Http\Controllers;

use App\Models\Regulation;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class RegulationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:Admin'])->except(['index', 'show']);
    }

    public function index()
    {
        $regulations = Regulation::where('is_active', true)
            ->orderBy('effective_date', 'desc')
            ->get()
            ->groupBy('category');
        return view('regulations.index', compact('regulations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category' => 'required|in:rule,meeting,policy',
            'document' => 'nullable|mimes:pdf,doc,docx|max:2048',
            'effective_date' => 'required|date',
        ]);

        $data = $request->all();

        if ($request->hasFile('document')) {
            $path = $request->file('document')->store('public/regulations');
            $data['document_path'] = Storage::url($path);
        }

        Regulation::create($data);

        return redirect()->route('regulations.index')
            ->with('success', 'Peraturan berhasil ditambahkan');
    }
}
