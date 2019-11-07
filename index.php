<?php

require 'vendor/autoload.php';

use App\Works;

class Job {
    
    public function calculateSuitableCompanies()
    {
        $suitableWorks = [];

        $works = str_replace([',', '.'], ['', ''], Works::getWorks()); //clear comma and dots

        foreach(explode(PHP_EOL, $works) as $work){ //handle each line

            if($this->checkNoRequirement($work)){ //check if the job has no requirements
                $suitableWorks[] = $work;
                continue;
            }                
        
            $requires = $this->getRequires($work);

            $hasAny = [];

            if(!preg_match('/ and /', $requires)){ //if no "and" statement exists
                $hasAny = explode(" or ", $requires);
            }else{
                $mustHave = explode(" and ", $requires);
            }

            if(count(array_intersect($hasAny, Works::getMyAbilities()))){
                $suitableWorks[] = $work;
                continue;
            }            
            
            foreach($mustHave as $have){
                
                $isFullfillAllRequirements = false;

                foreach(Works::getMyAbilities() as $ability){
                    if(false !== strpos($have, $ability))
                        $isFullfillAllRequirements = true;
                } 
                
                if(!$isFullfillAllRequirements)
                    break;

            }

            if($isFullfillAllRequirements){
                $suitableWorks[] = $work;
            }
        }

        echo 'You can work on the following jobs: '.PHP_EOL;
        var_dump($suitableWorks);
        
    }

    private function checkNoRequirement($work)
    {
        /*if contains doesn't require add possible companies */
        return strpos($work, "doesn't require anything") !== false || strpos($work, "does not require anything") !== false;
    }

    private function getRequires($work)
    {
        return trim(substr($work, strpos($work, 'requires') + strlen('requires'), strlen($work))); //get the sentence's last part after requires phrase...
    }
}

(new Job)->calculateSuitableCompanies();