<?php
/**
 * Thinkmoat (c) 2020
 * MODEL
 *
 * Summary:         TRELLO FETCH
 * Purpose:         Set the root in php always back to the root directory
 * @Developer:		Frank Frisby
 * @Developed Date:	01/25/2019
 * @Revised by:		Frank Frisby
 * @Revised Date: 	01/25/2019
 *
 *
 ***********************************************************************************
 * CHANGE LOG
 * Date         Developer/Engineer          Description of Change
 * ----------   ------------------          ----------------------------------------
 *
 ***********************************************************************************/

namespace trello;

class File 
{
    public static function GetRootDirectory($FileLocation, $stop = "trello") 
    {
        $dir = dirname($FileLocation);
        $pathList = explode("\\", $dir);
        $length = count($pathList);

        for ($i = $length - 1; $i > 0; $i--) {
            if (strtolower($pathList[$i]) == strtolower($stop)) {
                break;
            }

            unset($pathList[$i]);
        }

        $path = implode("\\", $pathList) . "\\";
        
        return $path;
    }

    public static function GetJsonData($uri) 
    {
        $json = file_get_contents($uri);
        $config = json_decode($json, true);

        return $config;
    }
}