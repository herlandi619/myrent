<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    // public function index()
    // {
    //     $branches = Branch::all();
    //     return view('branches.index', compact('branches'));
    // }

    // public function create()
    // {
    //     return view('branches.create');
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name'    => 'required',
    //         'address' => 'required'
    //     ]);

    //     Branch::create($request->all());
    //     return redirect()->route('branches.index')->with('success', 'Cabang berhasil ditambahkan');
    // }

    // public function show($id)
    // {
    //     $branch = Branch::findOrFail($id);
    //     return view('branches.show', compact('branch'));
    // }

    // public function edit($id)
    // {
    //     $branch = Branch::findOrFail($id);
    //     return view('branches.edit', compact('branch'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'name'    => 'required',
    //         'address' => 'required'
    //     ]);

    //     Branch::findOrFail($id)->update($request->all());
    //     return redirect()->route('branches.index')->with('success', 'Cabang berhasil diupdate');
    // }

    // public function destroy($id)
    // {
    //     Branch::findOrFail($id)->delete();
    //     return redirect()->route('branches.index')->with('success', 'Cabang berhasil dihapus');
    // }

     public function index() { return view('admin.branches.index', ['branches'=>Branch::all()]); }
    public function create() { return view('admin.branches.create'); }

    public function store(Request $request) {
        $request->validate(['name'=>'required','address'=>'required']);
        Branch::create($request->all());
        return redirect()->back()->with('success','Cabang ditambahkan');
    }

    public function edit(Branch $branch) { return view('admin.branches.edit', compact('branch')); }

    public function update(Request $request, Branch $branch) {
        $branch->update($request->all());
        return redirect()->back()->with('success','Cabang diperbarui');
    }

    public function destroy(Branch $branch) {
        $branch->delete();
        return back()->with('success','Cabang dihapus');
    }


}
