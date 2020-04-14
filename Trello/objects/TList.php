<?php
/**
 * Thinkmoat (c) 2020
 * MODEL
 *
 * Summary:         TLIST
 * Purpose:         Named TList because List is taken but is a trello struct
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

class TList extends TrelloSupport
{
    /** @var string */ public $id;
    /** @var string */ public $name;
    /** @var bool */ public $closed;
    /** @var string */ public $idBoard;
    /** @var int */ public $pos;
    /** @var bool */ public $subscribed;
    /** @var int */ public $softLimit;
    /** @var Card[] */ public $Cards;
    
    public function __construct() {
        parent::__construct($this);
    }

    public function SetList($JSONobject) {
        $o = $JSONobject;

        $this->id = $o["id"];
        $this->name = $o["name"];
        $this->closed = $o["closed"];
        $this->idBoard = $o["idBoard"];
        $this->pos = $o["pos"];
        $this->subscribed = $o["subscribed"];
        $this->softLimit = $o["softLimit"];
    }
}