<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rice;

class RiceController extends Controller
{
    public function index() {
        $rices = Rice::latest()->get();
        return view('rice.index', compact('rices'));
    }

    public function create(){
        return view('rice.create');
    }

    public function store(Request $request){
        $request->validate([
            'rice_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string|max:255'
        ]);

        Rice::create($request->all());
        return redirect()->route('dashboard')->with('success', 'Rice added successfully.');
    }

    public function edit(Request $request, $id){
        $rice = Rice::findOrFail($id);
        return view('rice.edit', compact('rice'));
    }

    public function update(Request $request, $id)
    {
        $rice = Rice::findOrFail($id);

        $request->validate([
            'rice_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string|max:255'
        ]);

        $rice->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Rice updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $rice = Rice::findOrFail($id);
        $rice->delete();
        return redirect()->route('dashboard')->with('success', 'Rice deleted successfully.');
    }
}


