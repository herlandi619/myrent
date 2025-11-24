<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    
    public function index()
    {
        $branches = Branch::latest()->get();
        return view('branches.index', compact('branches'));
    }

    public function create()
    {
        return view('branches.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'address' => 'required'
        ]);

        Branch::create($request->only(['name','address']));

        return redirect()->route('branches.index')->with('success', 'Cabang berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $branch = Branch::findOrFail($id);
        return view('branches.edit', compact('branch'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'    => 'required',
            'address' => 'required'
        ]);

        Branch::findOrFail($id)->update($request->only(['name','address']));

        return redirect()->route('branches.index')->with('success', 'Cabang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Branch::findOrFail($id)->delete();
        return redirect()->route('branches.index')->with('success', 'Cabang berhasil dihapus.');
    }

}
