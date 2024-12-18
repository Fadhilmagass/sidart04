<?php

namespace App\Http\Controllers;

use App\Models\RtProfile;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RtProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:Admin'])->except(['index', 'show']);
    }

    public function index()
    {
        $profile = RtProfile::first();
        return view('rt-profile.index', compact('profile'));
    }

    public function edit()
    {
        $profile = RtProfile::first();
        return view('rt-profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        ]);

        $profile = RtProfile::first();
        $profile->update($request->all());
    }
}
