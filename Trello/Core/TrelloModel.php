<?php
/**
 * Thinkmoat (c) 2020
 * MODEL
 *
 * Summary:         TRELLOMODEL
 * Purpose:         This class initializes tne entire board.
 *                  There are better ways of doing this. But
 *                  for the sake of time, it was constructed this way.
 * 
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

class TrelloModel 
{
    /** @var User */ private $user;
    public function __construct(User $user) {
        $this->user = $user;         
    }

    public function TrelloMapping() 
    {
        $trello = new TrelloBoard($this->user->Token(), $this->user->ID());
        $Lists = $trello->GetListsForBoard($this->user->BoardList()[0]);
        $cards = $trello->GetCardsForBoard($this->user->BoardList()[0]);
        $Board = $trello->GetBoard($Lists[0]->idBoard);

        $CardListHash = [];
        foreach($cards as $card) {
            $CardListHash[$card->idList] = isset($CardListHash[$card->idList]) ? $CardListHash[$card->idList]: [];
            $CardListHash[$card->idList][] = $card;
        }

        $ListBoardHash = [];
        foreach($Lists as $List) {
            $ListBoardHash[$List->idBoard] = isset($ListBoardHash[$List->idBoard]) ? $ListBoardHash[$List->idBoard]: [];

            $UseCards = isset($CardListHash[$List->id]) ? $CardListHash[$List->id]: [];
            $List->Cards = $UseCards;

            $ListBoardHash[$List->idBoard][] = $List;
        }

        $BoardList = $ListBoardHash[$Board->id];
        $Board->List = $BoardList;

        return $Board;
    }
}