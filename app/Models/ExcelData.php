<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcelData extends Model
{
    use HasFactory;

    protected $rowCount = 0;

    public function model(array $row)
    {
        $this->rowCount++;
        // Define your logic to map the data here
        // You can also save the data to the database if needed
    }

    public function getRowCount()
    {
        return $this->rowCount;
    }
}
