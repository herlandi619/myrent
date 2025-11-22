<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Termwind\Components\Dd;

class ItemController extends Controller
{
    

    // public function index() {
    //     return view('admin.items.index', ['items' => Item::all()]);
    // }

    // public function create() {
    //     return view('admin.items.create');
    // }

    // public function store(Request $request) {
    //     $request->validate([
    //         'name'=>'required', 'type'=>'required',
    //         'hourly_rate'=>'required', 'daily_rate'=>'required',
    //         'branch_id'=>'required'
    //     ]);
    //     Item::create($request->all());
    //     return redirect()->route('items.index')->with('success','Item berhasil ditambahkan!');
    // }

    public function index()
    {
        $items = Item::with('branch')->paginate(10);
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
            'branch_id' => 'required',
            'name' => 'required|unique:items,name',
            'type' => 'required',
            'hourly_rate' => 'required|numeric|min:1',
            'daily_rate' => 'required|numeric|min:1',
        ]);

        Item::create($request->all());
        return redirect()->route('items.index')->with('success', 'Alat berhasil ditambahkan.');
    }

    public function edit(Item $item)
    {
        $branches = Branch::all();
        return view('items.edit', compact('item', 'branches'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'branch_id' => 'required',
            'name' => 'required',
            'type' => 'required',
            'hourly_rate' => 'required|numeric|min:1',
            'daily_rate' => 'required|numeric|min:1',
        ]);

        $item->update($request->all());

        return redirect()->route('items.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(Item $item)
    {
        if ($item->status == 'booked') {
            return back()->with('error', 'Item sedang dibooking dan tidak dapat dihapus.');
        }

        $item->delete();
        return redirect()->route('items.index')->with('success', 'Item berhasil dihapus.');
    }

}
