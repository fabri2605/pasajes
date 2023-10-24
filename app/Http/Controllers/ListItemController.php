<?php

namespace App\Http\Controllers;

use App\Models\ListItem;
use App\Models\ExcelData;
use DateTime;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ListItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = ListItem::all();
        return view('dashboard', ['list' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = 'createLists';
        return view('dashboard', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $file = request()->file('insertedExel');

        $excelData = Excel::toCollection(new ExcelData, $file);

        $enters = [];

        foreach ($excelData[0] as $data) {

            if ($data[0] === 'Id')
                continue;

            $theTime = date("d-m-Y", strtotime("+0 second", $data[2]));;

            $someData = new ListItem([
                'id' => $data[0],
                'nombre' => $data[1],
                'nacimiento' => $theTime,
                'ingresos' => $data[4],
            ]);

            //$someData->save();

            $enters[] = $someData;

            echo '<pre>';
            echo var_dump($enters);
            echo '<pre>';
        }
        /* $path = $file->storeAs('exels', date('l dS \o\f F Y h:i:s A', time()) . '.xlsx', 'public');

        return redirect()->back()->with('answer', 'File uploaded and saved successfully.');
     */}

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {

        echo 'Hola';

        /* $file = request()->file('excel_file');

        Excel::import(new ExcelData, $file);

        // You can process the data or save it to the database here

        return redirect()->back()->with('success', 'Excel file imported successfully.'); */
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
