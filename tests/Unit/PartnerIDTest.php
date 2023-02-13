<?php

namespace Tests\Unit;

use App\Models\Partner;
use App\Models\PartnerID;
use App\Models\Subpartner;
use Tests\TestCase;

class PartnerIDTest extends TestCase
{

    public function testModelExists()
    {
        $object = PartnerID::first();
        return $this->assertTrue($object !== null);
    }

    public function testPartnerHasNeededParams()
    {
        $object = PartnerID::first();
        $this->assertTrue(in_array('lotNumber', $object->getFillable()));
        $this->assertTrue(in_array('procurementNumber', $object->getFillable()));
        $this->assertTrue(in_array('threeDigitId', $object->getFillable()));
        $this->assertTrue(in_array('comments', $object->getFillable()));
    }

    public function testPartnerHasNeededRelations()
    {
        $object = PartnerID::first();
        $this->assertIsObject($object->subpartner);
        $this->assertInstanceOf(Subpartner::class, $object->subpartner);
    }
}
