<?php

namespace App\Imports;

use App\Exceptions\InvalidServerSpecFormatException;
use App\Helpers\ServerSpecsHelper;
use App\Models\Server;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ServersImport implements ToModel, WithStartRow
{
    use Importable, SkipsErrors;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        try {
            return Server::updateOrCreate(['model' => $row[0]],[
                'model' => $row[0],
                'ram' => $row[1],
                'ram_size_gb' => ServerSpecsHelper::getRamSizeGB($row[1]),
                'ram_type' => ServerSpecsHelper::getRamType($row[1]),
                'hdd' => $row[2],
                'hdd_type' => ServerSpecsHelper::getHDDType($row[2]),
                'hdd_size_gb' => ServerSpecsHelper::getHDDSizeGB($row[2]),
                'location' => $row[3],
                'price' => $row[4],
            ]);
        } catch (InvalidServerSpecFormatException $e) {
            Log::alert("Invalid server spec found while parsing excel file: {$e->getMessage()}");
            return null;
        }
    }

    /**
     * Set the content start row
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}
