<?php

namespace App\Http\Controllers\API;

use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ConfiguratorFilterAPI extends Controller
{

    /**
     * Get servers after applying filters
     *
     * @param Request $request
     * @return false|string
     */
    public function updateData(Request $request)
    {

        $filters = [];

        $ramFilters = $request->get('selectedRamOptions');
        if($ramFilters != null){
            $filters['ram'] = $ramFilters;
        }
        $hddTypeFilter = $request->get('selectedStorageType');
        if($hddTypeFilter != null){
            $filters['hdd_type'] = $hddTypeFilter;
        }
        $hddFilters = $request->get('selectedStorageOptions');
        if($hddFilters != null){
            $filters['hdd'] = $hddFilters;
        }
        $locationFilter = $request->get('selectedLocation');
        if($locationFilter != null){
            $filters['location'] = $locationFilter;
        }


        $configuratorLimits['entries'] = Server::getAllAvailable($filters);

        return json_encode($configuratorLimits);
    }


}
