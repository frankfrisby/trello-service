<?php
/**
 * Thinkmoat (c) 2020
 * MODEL
 *
 * Summary:         TRELLO SUPPORT
 * Purpose:         parent class to the children classes.
 * @Developer:		Frank Frisby
 * @Developed Date:	01/26/2019
 * @Revised by:		Frank Frisby
 * @Revised Date: 	01/26/2019
 *
 *
 ***********************************************************************************
 * CHANGE LOG
 * Date         Developer/Engineer          Description of Change
 * ----------   ------------------          ----------------------------------------
 *
 ***********************************************************************************/

namespace trello;

class TrelloSupport
{
    /** @var array[] */ protected $TrelloObject;
    /** @var array[] */ protected $ExistingObject;
    public function __construct($object) {
        $this->ExistingObject = $object;
        $this->TrelloObject = [];
    }

    public function QueryString(string $apikey, string $token) {
        $this->TrelloObject["key"] = $apikey;
        $this->TrelloObject["token"] = $token;

        return http_build_query($this->TrelloObject);
    }

    public function AddToQueryObject($value) {
        foreach($this->ExistingObject as $key => $val) {
            if ($val == $value) {
                $this->TrelloObject[$key] = $value;
            }
        }
    }

    protected function ClearObject() {
        $this->TrelloObject = [];
    }
}