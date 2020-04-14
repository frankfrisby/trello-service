<?php
/**
 * Thinkmoat (c) 2020
 * MODEL
 *
 * Summary:         TRELLO HOOK
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


class TrelloHook {

    /** @var user */ private $user;
    /** @var Board */ private $BoardState;
    /** @var TrelloModel */ private $trello;
    /** @var TrelloBoard */ private $TrelloBoard;
    /** @var TrelloList */ public $TrelloList;
    /** @var TrelloCards */ public $TrelloCards;

    public function __construct(user $user) {
        $this->user = $user;

        $this->trello = new TrelloModel($this->user);
        $this->FetchState();

        $this->TrelloBoard = new TrelloBoard($user->Token(), $user->ID());
        $this->TrelloList = new TrelloList($user->Token(), $this->BoardState->id);
    }

    public function FetchState() {
        try 
        {
            $this->BoardState = $this->trello->TrelloMapping();
        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    public function State() {
        try 
        {
            return $this->BoardState;
        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    public function Board() {
        try 
        {
            $b = $this->BoardState;
            $Board = new Board();
            $Board->id = $b->id;
            $Board->id = $b->name;
            $Board->url = $b->url;

            return $Board;
        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    public function Lists() {
        try 
        {
            $List = $this->BoardState->List;
            return $List;
        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    public function List(string $ListID) {
        try 
        {
            $Lists = $this->BoardState->List;

            foreach($Lists as $list) {
                if($list->id == $ListID) {
                    return $list;
                }
            }

            return new TList();
        }
        catch(\Exception $e) {
            throw $e;
        }
    } 

    public function AddList(string $name, int $pos = 0) {
        try 
        {
            $List = new TList();
            $List->name = $name;
            $List->idBoard = $this->BoardState->id;
            $List->pos = $pos;

            $List->AddToQueryObject($List->name);
            $List->AddToQueryObject($List->pos);
            $List->AddToQueryObject($List->idBoard);

            return $this->TrelloList->AddList($List);
        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    public function UpdateList(string $name, string $ListID, int $pos = 0) {
        try 
        {
            $List = new TList();
            $List->name = $name;
            $List->idBoard = $this->BoardState->id;

            $Lists = $this->BoardState->List;

            /** @var TList */ $Lit = new TList();
            foreach($Lists as $Li) {
                if ($Li->id == $ListID) {
                    $Lit = $Li;
                    break;
                }
            }

            $Lit->name = $name;

            $Lit->AddToQueryObject($Lit->name);
            $Lit->AddToQueryObject($Lit->pos);
            $Lit->AddToQueryObject($Lit->id);

            return $this->TrelloList->UpdateList($Lit);
        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    public function DeleteList(string $ListID) {
        try 
        {
            return $this->TrelloList->ArchiveList($ListID);           
        }
        catch (\Exception $e) {
            throw $e;
        }     
    }

    public function Cards() {
        try 
        {
            /** @var Card[] */ $Cards = [];
            foreach($this->BoardState->List as $List) {
                /** @var Card[] */ $Cards = array_merge($Cards, $List->Cards);
            }

            return $Cards;
        }
        catch (\Exception $e) {
            throw $e;
        } 
    }

    public function Card(string $CardID) {
        try 
        {
            /** @var Card[] */ $Cards = [];
            foreach($this->BoardState->List as $List) {
                foreach($List as $Card) {
                    if ($Card->id == $CardID) { 
                        return $Card;
                    }
                }
            }

            throw new \Exception("No Card can be found.");
        }
        catch (\Exception $e) {
            throw $e;
        } 
    }

    public function AddCard(string $name, int $pos = 0) {
        try 
        {
            $Card = new Card();
            $Card->name = $name;
            
            return $this->TrelloCards->AddCard($Card);
        }
        catch (\Exception $e) {
            throw $e;
        } 
    }

    public function UpdateCard(string $CardID, string $name, int $pos = 0) {
        try 
        {
            $Card = $this->Card($CardID);
            $Card->name = $name;
            $Card->pos = $pos;

            return $this->TrelloCards->UpdateCard($Card);
        }
        catch (\Exception $e) {
            throw $e;
        } 
    }

    public function DeleteCard(string $CardID) {
        try 
        {
            return $this->TrelloCards->DeleteCard($CardID);
        }
        catch (\Exception $e) {
            throw $e;
        } 
    }
}