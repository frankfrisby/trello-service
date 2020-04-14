<?php
/**
 * Thinkmoat (c) 2020
 * MODEL
 *
 * Summary:         BOARD
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

class Board extends TrelloSupport
{
    /** @var string */ public $id;
    /** @var string */ public $name;
    /** @var string */ public $url;
    /** @var TList[] */ public $List;
    
    public function __construct() {
        parent::__construct($this);
    }

    public function SetBoard($JSONobject) {
        $o = $JSONobject;

        $this->id = $o["id"];
        $this->name = $o["name"];
        $this->url = $o["url"];
    }
}