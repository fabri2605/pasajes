<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreViajeRequest;
use App\Http\Requests\UpdateViajeRequest;
use App\Models\Viaje;
use App\Models\ExcelData;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Shared_Date;
use PHPExcel_Style_NumberFormat;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ViajeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $viajes = Viaje::all();
        return view('livewire.show-viajes', ['viajes' => $viajes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('livewire.file-form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /* echo '<pre>';
        echo var_dump($e->getMessage());
        echo '<pre>'; */
        /* $request->validate([
            'insertedExel' => 'required|file|mimes:xls,xlsx,xlsm',
        ], [
            'insertedExel.mimes' => 'Only Excel files (xls , xlsx and xlsm) are allowed.',
        ]); */

        $file = request()->file('insertedExel');

        $excelData = Excel::toCollection(new ExcelData, $file);

        $enters = [];
        $errorValues = [];
        $active = 0;

        foreach ($excelData[0] as $data) {

            // Reading titles
            if ($active === 0 && $data[0] === 'Evento') {

                $active++;
                continue;

            } elseif ($active === 1) {

                // If there is no more data
                if (is_null($data[0]))
                    break;

                // Parsing the Date
                $data[7] = PHPExcel_Shared_Date::ExcelToPHP($data[7]);

                $formatedDate = date("d/m/Y H:i", $data[7]);

                $formatedDateTime = DateTime::createFromFormat('d/m/Y H:i', $formatedDate);

                $someData = new Viaje([
                    'EVENTO' => $data[0],
                    'CUIL' => $data[1],
                    'TARJETA' => $data[2],
                    'CANTIDAD' => $data[3],
                    'TARIFA' => $data[4],
                    'IMPORTE' => $data[5],
                    'TRAMO' => $data[6],
                    'FECHA' => $formatedDateTime,
                    'LATITUD' => $data[8],
                    'LONGITUD' => $data[9],
                ]);

                try {
                    $someData->save();
                    $enters[] = $someData;
                } catch (Exception $e) {
                    $errorValues[] = $someData;
                }
            }
        }
        if (count($errorValues) > 0) {
            return redirect()->back()->with('error', $errorValues);
        }

        return redirect()->back()->with('answer', 'File uploaded and saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Viaje $viaje)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Viaje $viaje)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateViajeRequest $request, Viaje $viaje)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Viaje $viaje)
    {
        //
    }
}
