<?php

namespace App\Http\Controllers;

use App\Models\ListItem;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ListItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = ListItem::all();

        return view('dashboard', $list);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $path = $request->file('insertedExel')->storeAs('exels', time() . '.xlsx', 'public');

        return redirect()->back()->with('answer', 'File uploaded and saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ListItem $listItem)
    {
        return view('home')->with('data', 1);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ListItem $listItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ListItem $listItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ListItem $listItem)
    {
        //
    }
}
