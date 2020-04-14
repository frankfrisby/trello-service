<?php
/**
 * Thinkmoat (c) 2020
 * MODEL
 *
 * Summary:         TRELLO OBJECTS
 * Purpose:         Pre-made methods that act as a hook that other programs could use.
 *                  THis needs more work but you use this to help create other
 *                  classes using this format.
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

class TrelloObjects
{
    /** @var User */ private $user;
    public function __construct(User $user) {
        $this->user = $user;         
    }

    public function GetBoards() 
    {
        $trello = new TrelloBoard($this->user->Token(), $this->user->ID());
        return $trello->GetBoards();
    }

    public function GetBoard() 
    {
        $trello = new TrelloBoard($this->user->Token(), $this->user->ID());
        return $trello->GetBoard($this->user->BoardList()[0]);
    }

    public function GetAllCardsForBoard() {
        $trello = new TrelloBoard($this->user->Token(), $this->user->ID());
        $cards = $trello->GetCardsForBoard($this->user->BoardList()[0]);

        return $cards;
    }

    public function GetAllListForBoard() {
        $trello = new TrelloBoard($this->user->Token(), $this->user->ID());
        $Lists = $trello->GetListsForBoard($this->user->BoardList()[0]);

        return $Lists;
    }

    public function UpdateCard(string $Name) {
        $trello = new TrelloBoard($this->user->Token(), $this->user->ID());
        $cards = $trello->GetCardsForBoard($this->user->BoardList()[0]);
        $card = $cards[0];

        $card->name = $Name;
        $card->AddToQueryObject($card->id);
        $card->AddToQueryObject($card->name);

        $TrelloCard = new TrelloCards($this->user->Token(), $card->idList);
        
        return $TrelloCard->UpdateCard($card);
    }

    public function UpdateList(string $Name) {
        $trello = new TrelloBoard($this->user->Token(), $this->user->ID());
        $lists = $trello->GetListsForBoard($this->user->BoardList()[0]);
        $lists = $lists[0];

        $lists->name = $Name;
        $lists->AddToQueryObject($lists->id);
        $lists->AddToQueryObject($lists->name);

        $TrelloList = new TrelloList($this->user->Token(), $lists->idBoard);
        
        return $TrelloList->UpdateList($lists);
    }

    public function AddCardToList(string $Name) {
        $trello = new TrelloBoard($this->user->Token(), $this->user->ID());
        $cards = $trello->GetCardsForBoard($this->user->BoardList()[0]);
        $card = $cards[0];
        $ListID = $card->idList;
         
        $NewCard = new Card();
        $NewCard->name = $Name;
        $NewCard->idList = $card->idList;

        $NewCard->AddToQueryObject($NewCard->idList);
        $NewCard->AddToQueryObject($NewCard->name);

        $TrelloCard = new TrelloCards($this->user->Token(), $card->idList);
        
        return $TrelloCard->AddCard($NewCard);
    }

    public function AddListToBoard(string $Name) {
        $trello = new TrelloBoard($this->user->Token(), $this->user->ID());
        $lists = $trello->GetListsForBoard($this->user->BoardList()[0]);
        $list = $lists[0];

        $NewList = new TList();
        $NewList->name = $Name;
        $NewList->idBoard = $list->idBoard;

        $NewList->AddToQueryObject($NewList->idBoard);
        $NewList->AddToQueryObject($NewList->name);

        $TrelloList = new TrelloList($this->user->Token(), $list->idBoard);   
        
        return $TrelloList->AddList($NewList);
    }
}