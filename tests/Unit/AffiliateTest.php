<?php

namespace Tests\Unit;


use App\Services\AffiliatesService;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class AffiliateTest extends TestCase
{
    /**
     * A basic unit test affiliate.
     *
     * @return void
     */
    public function test_affiliate()
    {
        $content = Storage::disk('public')->get('affiliates.txt');
        if ($content) {
            $this->assertTrue(true);
        } else {
            $this->assertFalse(true);
        }
    }

    public function test_filtered_affiliates()
    {
        $content = Storage::disk('public')->get('affiliates.txt'); // Read file from storage

        $data = explode(PHP_EOL, $content); // Explode content
        $distanceUnit = 'km'; //km, mi
        $range = 10;
        $centerPoint = ['lat' => '53.3340285', 'lng' => '-6.2535495'];
        $affiliatesService = new AffiliatesService();

        $affiliates = $affiliatesService->getAffiliatesWithinRange($data, $centerPoint, $range, $distanceUnit);

        if(count($affiliates) === 1 && $affiliates[0]['id'] === 4) {
            $this->assertTrue(true);
        } else {
            $this->assertFalse(true);
        }
    }
}
