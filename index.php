<?php

require 'vendor/autoload.php';

/**
    Imagine you have a bike and a driving license. You also found a job board with a list of companies offering a job. 
    To get the job, you need to fulfill some requirements

    "Company A" requires an apartment or house, and property insurance.
    "Company B" requires 5 door car or 4 door car, and a driver's license and car insurance.
    "Company C" requires a social security number and a work permit. 
    "Company D" requires an apartment or a flat or a house.
    "Company E" requires a driver's license and a 2 door car or a 3 door car or a 4 door car or a 5 door car.
    "Company F" requires a scooter or a bike, or a motorcycle and a driver's license and motorcycle insurance.
    "Company G" requires a massage qualification certificate and a liability insurance.
    "Company H" requires a storage place or a garage.
    "Company J" doesn't require anything, you can come and start working immediately.
    "Company K" requires a PayPal account.
    "Company L" requires a driving licence.
 */

 /**
  Your task is to write code that will calculate for which companies you can work and for which you can't. 
  You can convert the statements like "Company J requires PayPal account" to whatever form or structure you need
*/

use App\Works;

class Job {
    
    public function calculateSuitableCompanies()
    {
        $suitableWorks = [];

        $works = str_replace([',', '.'], ['', ''], Works::getWorks());

        foreach(explode(PHP_EOL, $works) as $work){
        
            $requires = trim(substr($work, strpos($work, 'requires') + strlen('requires'), strlen($work)));

            $hasAny = [];
            if(!preg_match('/ and /', $requires)){
                $hasAny = explode(" or ", $requires);
            }else{
                $mustHave = explode(" and ", $requires);
            }

            if(count(array_intersect($hasAny, Works::getMyAbilities()))){
                $suitableWorks[] = $work;
                continue;
            }
            
            
            foreach($mustHave as $have){
                
                $isOk = false;
                foreach(Works::getMyAbilities() as $ability){
                    if(false !== strpos($have, $ability))
                        $isOk = true;
                } 
                
                if(!$isOk)
                    break;

            }

            if($isOk){
                $suitableWorks[] = $work;
            }
        }

        echo 'You can work the following jobs: '.PHP_EOL;
        var_dump($suitableWorks);
        
    }
}

(new Job)->calculateSuitableCompanies();