<?php

namespace App\Helpers;

use App\Exceptions\InvalidServerSpecFormatException;

class ServerSpecsHelper
{

    /**
     * Extract the ram size from the excel
     *
     * @param string $ram
     * @return int
     * @throws InvalidServerSpecFormatException
     */
    public static function getRamSizeGB(string $ram) : int
    {
        if(str_contains(strtolower($ram), 'gb')){
            $filteredNumbers = array_filter(preg_split("/\D+/", $ram));
            return reset($filteredNumbers);
        }

        throw new InvalidServerSpecFormatException("Invalid (Or new) Ram capacity unit detected");
    }

    /**
     * Extract the ram type from the excel
     *
     * @param string $ram
     * @return string
     * @throws InvalidServerSpecFormatException
     */
    public static function getRamType(string $ram) : string
    {
        if(str_contains(strtolower($ram), 'ddr3')){
            return 'ddr3';
        } else if (str_contains(strtolower($ram), 'ddr4')){
            return 'ddr4';
        }

        throw new InvalidServerSpecFormatException("Invalid (Or new) Ram format detected");
    }


    /**
     * Extract the hdd type from the excel
     *
     * @param string $hdd
     * @return string
     * @throws InvalidServerSpecFormatException
     */
    public static function getHDDType(string $hdd) : string
    {
        if(str_contains(strtolower($hdd), 'ssd')){
            return 'ssd';
        } else if (str_contains(strtolower($hdd), 'sas')){
            return 'sas';
        } else if (str_contains(strtolower($hdd), 'sata')){
            return 'sata';
        }

        throw new InvalidServerSpecFormatException("Invalid (Or new) HDD format detected: ".$hdd);
    }

    /**
     * Extract the HDD size from the excel
     *
     * @param string $hdd
     * @return int
     * @throws InvalidServerSpecFormatException
     */
    public static function getHDDSizeGB(string $hdd) : int
    {
        if(str_contains(strtolower($hdd), 'gb') || str_contains(strtolower($hdd), 'tb')){
            //Space in GB already
            preg_match_all('/((\d)(x){1}(\d+))(tb|gb)/', strtolower($hdd), $output_array);
            if(count($output_array) == 6){
                //Valid detection
                $numOfDrives = $output_array[2][0];
                $capacity = $output_array[4][0];
                $unit = $output_array[5][0];
                return $numOfDrives*$capacity*($unit == 'tb' ? 1024 : 1);
            }
            throw new InvalidServerSpecFormatException("Invalid (Or new) HDD capacity format detected: ".$hdd);
        }

        throw new InvalidServerSpecFormatException("Invalid (Or new) HDD capacity unity detected");
    }
}
