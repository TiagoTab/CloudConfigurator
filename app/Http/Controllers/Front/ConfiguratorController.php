<?php

namespace App\Http\Controllers\Front;
use App\Models\Server;
use Illuminate\Routing\Controller;

class ConfiguratorController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $configuratorLimits['entries'] = Server::getAllAvailable();
        if($configuratorLimits['entries'] == null){

            //Nothing available...
            $errorMsg = "Please set the database connection first and run php artisan migrate";
            return response()->view('errors.config-error',compact('errorMsg'), 500);
        }

        $configuratorLimits['ram'] = Server::getRamOptions();
        $configuratorLimits['storage'] = Server::getStorageOptions();
        $configuratorLimits['storage_type'] = Server::getStorageTypeOptions();
        $configuratorLimits['location'] = Server::getLocationOptions();
        $configuratorLimits['price'] = Server::getPriceOptions();

        return view('front.configurator',compact('configuratorLimits'));
    }
}
