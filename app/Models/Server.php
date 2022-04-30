<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\HasApiTokens;

class Server extends Model
{

    protected $table = 'servers';

    protected $fillable = ['model', 'ram', 'ram_size_gb', 'ram_type', 'hdd', 'hdd_type', 'hdd_size_gb', 'location', 'price'];

    /**
     * Get All Available servers according to the given filters
     *
     * @param $filters
     * @return mixed
     */
    static function getAllAvailable($filters = null)
    {

        $servers = Server::where('is_available', 1);
        if (empty($filters) == false) {
            //Set Ram Filters
            if (isset($filters['ram']) && is_array($filters['ram'])) {
                $servers->where(function ($query) use ($filters) {
                    foreach ($filters['ram'] as $key => $ramOption) {
                        if ($key === array_key_first($filters['ram'])) {
                            $query->where(['ram' => $ramOption]);
                        } else {
                            $query->orWhere(['ram' => $ramOption]);
                        }
                    }
                });
            }
            if (isset($filters['hdd_type']) && $filters['hdd_type'] != 'null') {
                $servers->where('hdd_type', $filters['hdd_type']);
            }
            //Set HDD Filters
            if (isset($filters['hdd']) && is_array($filters['hdd'])) {
                $servers->where(function ($query) use ($filters) {
                    foreach ($filters['hdd'] as $key => $hddOption) {
                        if ($key === array_key_first($filters['hdd'])) {
                            $query->where(['hdd' => $hddOption]);
                        } else {
                            $query->orWhere(['hdd' => $hddOption]);
                        }
                    }
                });
            }
            if (isset($filters['location']) && $filters['location'] != 'null') {
                $servers->where('location', $filters['location']);
            }
        }

        try {
            return $servers->get();
        } catch (\PDOException $e) {
            Log::critical("Database not set or query error");
            return null;
        }
    }

    static function getRamOptions()
    {
        return Server::where('is_available', 1)->groupBy('ram', 'ram_size_gb', 'ram_type')
            ->select(['ram', 'ram_size_gb', 'ram_type'])
            ->orderBy('ram_size_gb')
            ->get();
    }

    static function getStorageOptions()
    {
        return Server::groupBy('hdd_size_gb', 'hdd')
            ->selectRaw('hdd_size_gb,hdd, count(*) as total')
            ->orderBy('hdd_size_gb')
            ->get();
    }

    static function getStorageTypeOptions()
    {
        return Server::groupBy('hdd_type')
            ->selectRaw('hdd_type')
            ->get();
    }


    static function getLocationOptions()
    {
        return Server::groupBy('location')
            ->selectRaw('location, count(*) as total')
            ->get();
    }

    static function getPriceOptions()
    {
        return Server::groupBy('price')
            ->selectRaw('price, count(*) as total')
            ->get();
    }
}
