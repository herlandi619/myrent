<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Branch;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    // public function index()
    // {
    //     $items = Item::with('branch')->get();
    //     return view('items.index', compact('items'));
    // }

    // public function create()
    // {
    //     $branches = Branch::all();
    //     return view('items.create', compact('branches'));
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'branch_id'   => 'required',
    //         'name'        => 'required',
    //         'hourly_rate' => 'required|numeric',
    //     ]);

    //     Item::create($request->all());
    //     return redirect()->route('items.index')->with('success', 'Alat berhasil ditambahkan');
    // }

    public function index() {
        return view('admin.items.index', ['items' => Item::all()]);
    }

    public function create() {
        return view('admin.items.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name'=>'required', 'type'=>'required',
            'hourly_rate'=>'required', 'daily_rate'=>'required',
            'branch_id'=>'required'
        ]);
        Item::create($request->all());
        return redirect()->route('items.index')->with('success','Item berhasil ditambahkan!');
    }
}
