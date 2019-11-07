<?php
namespace App;

class Works {
 
    public static function getWorks()
    {
        $list = 
        <<<EOT
    "Company L" requires a driver's license and a bike.
    "Company A" requires an apartment or house, and property insurance.
    "Company B" requires 5 door car or 4 door car, and a driver's license and car insurance.
    "Company C" requires a social security number and a work permit. 
    "Company D" requires an apartment or a flat or a house.
    "Company E" requires a driver's license and a 2 door car or a 3 door car or a 4 door car or a 5 door car.
    "Company F" requires a scooter or a bike, or a motorcycle and motorcycle insurance.
    "Company G" requires a massage qualification certificate and a liability insurance.
    "Company H" requires a storage place or a garage.
    "Company J" doesn't require anything, you can come and start working immediately.
    "Company K" requires a PayPal account or a driver's license.
    "Company L" requires a driver's license.
EOT;

        return $list;
    }

    public static function getMyAbilities()
    {
        return [
            "a bike", "a driver's license", "2 door car"
        ];
    }
}