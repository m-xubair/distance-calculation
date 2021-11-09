<?php

namespace App\Http\Controllers;

use App\Services\AffiliatesService;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AffiliatesController extends Controller
{
    protected $affiliateService;

    public function __construct(AffiliatesService $affiliateService) {
        $this->affiliateService = $affiliateService;
    }
    /**
     * Read affiliates from text file to filter by distance using Haversine formula and passed it to view
     * $latitudeFrom Latitude of start point in [deg decimal]
     * $longitudeFrom Longitude of start point in [deg decimal]
     * $toSingleAffiliateLat Latitude of target point in [deg decimal]
     * $toSingleAffiliateLong Longitude of target point in [deg decimal]
     * $earthRadius is earth radius in [km]
     * $distance is distance between individual affiliate and Dublin office in [km]
     */

    public function index()
    {
        $content = Storage::disk('public')->get('affiliates.txt'); // Read file from storage

        $data = explode(PHP_EOL, $content); // Explode content

        $distanceUnit = 'km'; //km, mi
        $range = 100;
        $centerPoint = ['lat' => '53.3340285', 'lng' => '-6.2535495'];

        $affiliates = $this->affiliateService->getAffiliatesWithinRange($data, $centerPoint, $range, $distanceUnit);

        // Passing final data to view
        return view("affiliates", ["affiliates" => $affiliates, 'unit' => $distanceUnit,
            'range' => $range]);
    }
}
