<?php
/**
 * Thinkmoat (c) 2020
 * MODEL
 *
 * Summary:         USER
 * Purpose:
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

class User 
{
    /** 
     * @var string 
     * This is the username of the user in trello.
     */ 
    private $UserName;

    /** 
     * @var string 
     * This token is generated for user that is connected
     * to our (Thinkmoat) application. This is a unique
     * connection between Thinkmoat and the user.
     */ 
    private $Token;

    /** 
     * @var string 
     * The users id in trello system
     * this gets user the users member id. This id
     * is core to the user's experience.
     */ 
    private $id;

    /**
     * @var string[]
     * 
     * Summary of BoardList
     * ---
     * The list of all the boards strings.
     */
    private $BoardList = [];

    /**
     * Summary of User
     * ---
     * This method method constructs a json object.
     */
    public function __construct($userJsonObject = array()) {
        $o = $userJsonObject;

        $this->UserName = $o["username"];
        $this->Token = $o["token"];
        $this->id = $o["id"];
        
        $boards = $o["boards"];

        foreach($boards as $boardid) {
            $this->BoardList[] = $boardid["boardid"];
        } 
    }

    public function UserName() {
        return $this->UserName;
    }

    public function Token() {
        return $this->Token;
    }

    public function ID() {
        return $this->id;
    }

    public function BoardList() {
        return $this->BoardList;
    }
}