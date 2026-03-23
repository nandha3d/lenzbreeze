<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Warranty;
use Illuminate\Support\Carbon;

class WarrantyTest extends TestCase
{
    /** @test */
    public function it_identifies_a_valid_warranty()
    {
        $warranty = new Warranty([
            'status' => Warranty::STATUS_ACTIVE,
            'expiry_date' => Carbon::now()->addMonth(),
        ]);

        $this->assertTrue($warranty->isValid());
        $this->assertFalse($warranty->isExpired());
    }

    /** @test */
    public function it_identifies_an_expired_warranty_by_status()
    {
        $warranty = new Warranty([
            'status' => Warranty::STATUS_EXPIRED,
            'expiry_date' => Carbon::now()->addMonth(),
        ]);

        $this->assertFalse($warranty->isValid());
        $this->assertTrue($warranty->isExpired());
    }

    /** @test */
    public function it_identifies_an_expired_warranty_by_date()
    {
        $warranty = new Warranty([
            'status' => Warranty::STATUS_ACTIVE,
            'expiry_date' => Carbon::now()->subDay(),
        ]);

        $this->assertFalse($warranty->isValid());
        $this->assertTrue($warranty->isExpired());
    }

    /** @test */
    public function it_generates_correct_verification_url()
    {
        $warranty = new Warranty([
            'serial_number' => 'LB-TEST1234',
        ]);

        $expectedUrl = url('/warranty?serial=LB-TEST1234');
        $this->assertEquals($expectedUrl, $warranty->getVerificationUrl());
    }

    /** @test */
    public function it_returns_correct_effective_status()
    {
        // Status is active but date is past
        $warranty = new Warranty([
            'status' => Warranty::STATUS_ACTIVE,
            'expiry_date' => Carbon::now()->subDay(),
        ]);

        $this->assertEquals(Warranty::STATUS_EXPIRED, $warranty->effective_status);
        
        // Status is active and date is future
        $warranty->expiry_date = Carbon::now()->addDay();
        $this->assertEquals(Warranty::STATUS_ACTIVE, $warranty->effective_status);
    }
}
