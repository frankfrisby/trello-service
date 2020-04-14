<?php
/**
 * Thinkmoat (c) 2020
 * MODEL
 *
 * Summary:         TRELLO FETCH
 * Purpose:
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

class Fetch 
{
    /** @var string */ private $urlbase;
    /** @var string */ private $apikey;
    /** @var string */ private $secret;
    /** @var string */ private $token;

    public function __construct($Token = null) {
        $this->SetDefaultParams();
        $this->token = $Token;
    }
    
    public function GetAPIkey() {
        return $this->apikey;
    }

    public function GetToken() {
        return $this->token;
    }

    public function Get(string $url) 
    {
        try 
        {
            $token_json = file_get_contents($url);

            $ch = \curl_init($url);

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array());

            $token_json = curl_exec($ch);
                     
            if (! $token_json) {
                throw new \Exception("Trello denied the GET request for security reasons.");
            }

            if (is_string($token_json) && explode(" ", $token_json)[0] == "Cannot") {
                throw new \Exception("Trello did not accept GET request");
            }

            $exchange_token = json_decode($token_json,true);

            curl_close($ch); 

            return $exchange_token;
        }
        catch(\Exception $e)
        {
            echo $e->getMessage();
            throw $e;
        }   
    }

    public function Put(string $url, $querystring) 
    {
        try 
        {
            $ch = curl_init($url);
      
            curl_setopt($ch, CURLOPT_POSTFIELDS, $querystring);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array());

            $token_json = curl_exec($ch);

            if (! $token_json) {
                throw new \Exception("Trello denied the PUT request for security reasons.");
            }

            if (is_string($token_json) && explode(" ", $token_json)[0] == "Cannot") {
                throw new \Exception("Trello did not accept PUT request");
            }

            $exchange_token = json_decode($token_json,true);

            curl_close($ch); 
            
            return $exchange_token;
        }
        catch(\Exception $e)
        {
            echo $e->getMessage();
            throw $e;
        }      
    }

    public function Post(string $url, $querystring) {

        try 
        {
            $ch = curl_init($url);

            curl_setopt($ch, CURLOPT_POSTFIELDS, $querystring);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array());

            $token_json = curl_exec($ch);

            if (! $token_json) {
                throw new \Exception("Trello denied the POST request for security reasons.");
            }

            if (is_string($token_json) && explode(" ", $token_json)[0] == "Cannot") {
                throw new \Exception("Trello did not accept POST request");
            }

            $exchange_token = json_decode($token_json,true);

            curl_close($ch); 
            
            return $exchange_token;
        }
        catch(\Exception $e)
        {
            echo $e->getMessage();
            throw $e;
        }    
    }

    public function Delete($url) {
        try {
            $ch = curl_init($url);
      
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array());


            $token_json = curl_exec($ch);

            if (! $token_json) {
                throw new \Exception("Trello denied the DELETE request for security reasons.");
            }

            if (is_string($token_json) && explode(" ", $token_json)[0] == "Cannot") {
                throw new \Exception("Trello did not accept DELETE request");
            }

            $exchange_token = json_decode($token_json,true);
            curl_close($ch); 
            
            return $exchange_token;
        }
        catch(\Exception $e)
        {
            throw $e;
        }   
    }

    private function SetDefaultParams() {
        $dir = File::GetRootDirectory(__FILE__);
        $path = $dir . "config.json";
        $config = File::GetJsonData($path);

        $this->apikey = $config["apikey"];
        $this->secret = $config["secret"];
        $this->urlbase = $config["url"];
    }
}