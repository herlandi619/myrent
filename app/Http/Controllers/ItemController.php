<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Branch;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('branch')->get();
        return view('items.index', compact('items'));
    }

    public function create()
    {
        $branches = Branch::all();
        return view('items.create', compact('branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'branch_id'   => 'required',
            'name'        => 'required',
            'hourly_rate' => 'required|numeric',
        ]);

        Item::create($request->all());
        return redirect()->route('items.index')->with('success', 'Alat berhasil ditambahkan');
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $branches = Branch::all();
        return view('items.edit', compact('item', 'branches'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'branch_id'   => 'required',
            'name'        => 'required',
            'hourly_rate' => 'required|numeric'
        ]);

        Item::findOrFail($id)->update($request->all());
        return redirect()->route('items.index')->with('success', 'Alat berhasil diupdate');
    }

    public function destroy($id)
    {
        Item::findOrFail($id)->delete();
        return redirect()->route('items.index')->with('success', 'Alat berhasil dihapus');
    }
}
