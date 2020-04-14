<?php
/**
 * Thinkmoat (c) 2020
 * MODEL
 *
 * Summary:         TRELLO
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

class TrelloTest
{
    /** @var User */ private $user;
    public function __construct(User $user) {
        $this->user = $user;         
    }

    public function TestGetBoards() 
    {
        $trello = new TrelloBoard($this->user->Token(), $this->user->ID());
        $trello->GetBoards();
    }

    public function TestGetBoard() 
    {
        $trello = new TrelloBoard($this->user->Token(), $this->user->ID());
        $trello->GetBoard($this->user->BoardList()[0]);
    }

    public function TestGetAllCardsForBoard() {
        $trello = new TrelloBoard($this->user->Token(), $this->user->ID());
        $cards = $trello->GetCardsForBoard($this->user->BoardList()[0]);

        print_r($cards);
    }

    public function TestGetAllListForBoard() {
        $trello = new TrelloBoard($this->user->Token(), $this->user->ID());
        $Lists = $trello->GetListsForBoard($this->user->BoardList()[0]);

        print_r($Lists);
    }

    public function TestUpdateCard() {
        $trello = new TrelloBoard($this->user->Token(), $this->user->ID());
        $cards = $trello->GetCardsForBoard($this->user->BoardList()[0]);
        $card = $cards[0];

        $card->name = "Joe ... I am able to code an API into Trello.";
        $card->AddToQueryObject($card->id);
        $card->AddToQueryObject($card->name);

        $TrelloCard = new TrelloCards($this->user->Token(), $card->idList);
        $TrelloCard->UpdateCard($card);
    }

    public function TestUpdateList() {
        $trello = new TrelloBoard($this->user->Token(), $this->user->ID());
        $lists = $trello->GetListsForBoard($this->user->BoardList()[0]);
        $lists = $lists[0];

        $lists->name = "Let's see if this works";
        $lists->AddToQueryObject($lists->id);
        $lists->AddToQueryObject($lists->name);

        $TrelloList = new TrelloList($this->user->Token(), $lists->idBoard);
        $TrelloList->UpdateList($lists);
    }

    public function TestAddCardToList() {
        $trello = new TrelloBoard($this->user->Token(), $this->user->ID());
        $cards = $trello->GetCardsForBoard($this->user->BoardList()[0]);
        $card = $cards[0];
        $ListID = $card->idList;
         
        $NewCard = new Card();
        $NewCard->name = "I am able to change code ... it's cool. you see.";
        $NewCard->idList = $card->idList;

        $NewCard->AddToQueryObject($NewCard->idList);
        $NewCard->AddToQueryObject($NewCard->name);

        $TrelloCard = new TrelloCards($this->user->Token(), $card->idList);
        $TrelloCard->AddCard($NewCard);
    }

    public function TestAddListToBoard() {
        $trello = new TrelloBoard($this->user->Token(), $this->user->ID());
        $lists = $trello->GetListsForBoard($this->user->BoardList()[0]);
        $list = $lists[0];

        $NewList = new TList();
        $NewList->name = "Working on a list bro";
        $NewList->idBoard = $list->idBoard;

        $NewList->AddToQueryObject($NewList->idBoard);
        $NewList->AddToQueryObject($NewList->name);

        $TrelloList = new TrelloList($this->user->Token(), $list->idBoard);
        $TrelloList->AddList($NewList);
    }
}