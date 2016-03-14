<?php

class Mock 
{
    
    function getRandomFlights($db, $countryA, $countryB, $num, $minPrice=10.5, $maxPrice=250.0) {
        
            $citiesA = DB::getCitiesByCountry($db,$countryA);
            $citiesB = DB::getCitiesByCountry($db,$countryB);
        
            $citiesEmpty = empty($citiesA) || empty($citiesB);
        
            $flights = array();
        
            for($i=0; $i<$num; $i++){
                
                if($citiesEmpty)
                    break;
                
                $flights[$i] = array(
                                        $citiesA[array_rand($citiesA)],
                                        $citiesB[array_rand($citiesB)],
                                        rand($minPrice,$maxPrice)
                                    );
            }
        
            return $flights;  
    }
    
}
    
?>