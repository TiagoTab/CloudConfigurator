<?php

namespace Tests\Unit;

use App\Exceptions\InvalidServerSpecFormatException;
use App\Helpers\ServerSpecsHelper;
use PHPUnit\Framework\TestCase;

class ServerSpecsHelperTest extends TestCase
{
    /**
     * A basic string test example.
     *
     * @return void
     */
    public function test_server_disk_size_parser()
    {
        $diskSize = ServerSpecsHelper::getHDDSizeGB("1x480GBSSD");
        $this->assertEquals(480, $diskSize);

        $diskSize = ServerSpecsHelper::getHDDSizeGB("4x480gBSAS");
        $this->assertEquals(1920, $diskSize);

        $diskSize = ServerSpecsHelper::getHDDSizeGB("4x20tbSSD");
        $this->assertEquals(81920, $diskSize);
    }

    /**
     * Test the ram type variations.
     *
     * @return void
     */
    public function test_disk_type_parser()
    {
        $hddType = ServerSpecsHelper::getHDDType("4x20tbSsD");
        $this->assertEquals('ssd', $hddType);

        $hddType = ServerSpecsHelper::getHDDType("4x480gBSAS");
        $this->assertEquals('sas', $hddType);

        $hddType = ServerSpecsHelper::getHDDType("4x480gBsaTA");
        $this->assertEquals('sata', $hddType);
    }

    /**
     * Test the ram type variations.
     *
     * @return void
     */
    public function test_ram_type_parser()
    {
        $ramType = ServerSpecsHelper::getRamType("128GBDDR4");
        $this->assertEquals('ddr4', $ramType);


        $ramType = ServerSpecsHelper::getRamType("4gbddr3");
        $this->assertEquals('ddr3', $ramType);
    }

    /**
     * Test that exceptions are thrown
     *
     * @return void
     */
    public function test_exception_ram_type(){
        $this->expectException(InvalidServerSpecFormatException::class);
        ServerSpecsHelper::getRamType("1TBddr5");
    }

    /**
     * Test the ram type variations.
     *
     * @return void
     */
    public function test_ram_quantity_parser()
    {
        $ramType = ServerSpecsHelper::getRamSizeGB("128GBDDR4");
        $this->assertEquals('128', $ramType);

        $ramType = ServerSpecsHelper::getRamSizeGB("1gbddr3");
        $this->assertEquals('1', $ramType);

    }
}
