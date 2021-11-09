<?php
namespace App\Services;

class AffiliatesService {
    public function getAffiliatesWithinRange($data, $centerPoint, $range = 100, $unit = 'km') {
        $desiredAffiliates = [];
        foreach($data as $line) {

            $singleAffiliate = json_decode($line, true); // Decode every single line
            $toSingleAffiliateLat = $singleAffiliate['latitude']; // Latitude of single affiliate
            $toSingleAffiliateLong = $singleAffiliate['longitude']; // Longitude of single affiliate
            $toSingleAffiliateId = $singleAffiliate['affiliate_id']; // ID of single affiliate
            $toSingleAffiliateName = $singleAffiliate['name']; // Name of single affiliate


            $latitudeFrom = $centerPoint['lat'];//'53.3340285'; // Latitude of Dublin Office
            $longitudeFrom = $centerPoint['lng'];//'-6.2535495'; // Longitude of Dublin Office

            $earthRadius = 6371; // Earth radius in km

            // convert from degrees to radians
            $latFrom = deg2rad($latitudeFrom);
            $lonFrom = deg2rad($longitudeFrom);
            $latTo = deg2rad($toSingleAffiliateLat);
            $lonTo = deg2rad($toSingleAffiliateLong);

            $latDelta = $latTo - $latFrom;
            $lonDelta = $lonTo - $lonFrom;

            // Application of Haversine Formula to calculate circular distance
            $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                    cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

            $distance = $angle * $earthRadius;
            if($unit === 'mi') {
                $distance = $distance * 0.621371;
            }

            $distance = round($distance, 2);

            // Create set of affiliates which are within 100km from Dublin office
            if ($distance <= $range) {
                $desiredAffiliates[] = ["id" => $toSingleAffiliateId, "name" => $toSingleAffiliateName,
                    "distance" => $distance, 'unit' => $unit];
            }
        }

        return collect($desiredAffiliates)->sortBy('id', true)->toArray();
    }
}
