<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreViajeRequest;
use App\Http\Requests\UpdateViajeRequest;
use App\Models\Viaje;
use App\Models\ExcelData;
use Carbon\Carbon;
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
        $viajes = Viaje::orderBy('FECHA', 'desc')->orderBy('HORA', 'desc')->paginate(20);
        return view('livewire.show-viajes', ['viajes' => Viaje::orderBy('FECHA', 'desc')->paginate(20)]);
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
        $request->validate([
            'insertedExel' => 'required|file|mimes:xls,xlsx,xlsm',
        ], [
            'insertedExel.mimes' => 'Only Excel files (xls , xlsx and xlsm) are allowed.',
        ]);

        $file = request()->file('insertedExel');

        $excelData = Excel::toCollection(new ExcelData, $file);

        // Define the batch size (adjust as needed)
        $batchSize = 100;
        $bulkInsertData = [];
        $skipHeaders = true;

        foreach ($excelData[0] as $data) {
            if ($skipHeaders) {
                if ($data[0] === 'Evento') {
                    $skipHeaders = false;
                }
                continue; // Skip header rows
            }

            if (is_null($data[0]))
                break;

            // Parsing the Date
            $timestamp = PHPExcel_Shared_Date::ExcelToPHP($data[7]);
            $formattedDate = date('Y-m-d', $timestamp);
            $formattedTime = date('H:i', $timestamp);

            $viajeData = [
                'EVENTO' => $data[0],
                'CUIL' => $data[1],
                'TARJETA' => $data[2],
                'CANTIDAD' => $data[3],
                'TARIFA' => $data[4],
                'IMPORTE' => $data[5],
                'TRAMO' => $data[6],
                'FECHA' => $formattedDate,
                'HORA' => $formattedTime,
                'LATITUD' => $data[8],
                'LONGITUD' => $data[9],
            ];

            $bulkInsertData[] = $viajeData;

            if (count($bulkInsertData) >= $batchSize) {
                try {
                    Viaje::insert($bulkInsertData);
                } catch (Exception $e) {
                    return redirect()->back()->with('error', $e->getMessage());
                }

                $bulkInsertData = [];
            }

        }
        // Insert any remaining data in the bulk insert array
        if (!empty($bulkInsertData)) {
            try {
                Viaje::insert($bulkInsertData);
            } catch (Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
        return redirect()->back()->with('answer', 'Los registros fueron subidos correctamente!');
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
