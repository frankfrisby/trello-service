<?php
/**
 * Thinkmoat (c) 2020
 * MODEL
 *
 * Summary:         TRELLO BOARD
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

class TrelloBoard 
{
    /** @var string */ private $ID;
    /** @var Fetch */ private $fetch;

    public function __construct($Token = null, $ID) {
        $this->fetch = new Fetch($Token);
        $this->ID = $ID;
    }
 
    public function GetBoards() {
        try 
        {
            $url = "https://api.trello.com/1/action/" . $this->ID 
                        . "?display=true&fields=name,url&key=" . $this->fetch->GetAPIkey() 
                        . "&token=" . $this->fetch->GetToken();

            $data = $this->fetch->Get($url);

            $board = new Board();
            $board->SetBoard($data);

            return $board; 
        }
        catch(\Exception $e) {
            throw $e;
        } 
    }

    public function GetBoard(string $BoardID) {
        try 
        {
            $url = "https://api.trello.com/1/boards/" . $BoardID 
                        . "?display=true&fields=name,url&key=" . $this->fetch->GetAPIkey() 
                        . "&token=" . $this->fetch->GetToken();

            $data = $this->fetch->Get($url);

            $board = new Board();
            $board->SetBoard($data);

            return $board; 
        }
        catch(\Exception $e) {
            throw $e;
        }  
    }

    public function GetCardsForBoard(string $BoardID) {
        try 
        {
            $url = "https://api.trello.com/1/boards/" . $BoardID 
                        . "/cards?key=" . $this->fetch->GetAPIkey() 
                        . "&token=" . $this->fetch->GetToken();

            /** @var array */ $data = $this->fetch->Get($url);
            
            $List = [];
            foreach($data as $item) {
                $card = new Card();
                $card->SetCard($item);
                $List[] = $card;
            }

            return $List;
        }
        catch(\Exception $e) {
            throw $e;
        } 
    }

    public function GetListsForBoard(string $BoardID) {
        try 
        {   
            $url = "https://api.trello.com/1/boards/" . $BoardID 
                        . "/lists?key=" . $this->fetch->GetAPIkey() 
                        . "&token=" . $this->fetch->GetToken();

            /** @var array */ $data = $this->fetch->Get($url);
            
            $List = [];
            foreach($data as $item) {
                $card = new TList();
                $card->SetList($item);
                $List[] = $card;
            }

            return $List;
        }
        catch(\Exception $e) {
            throw $e;
        } 
    }

    public function UpdateBoard(string $BoardName) 
    {
        try 
        {
            $url = "https://api.trello.com/1/boards/";

            $Board = new Board();
            $Board->name = $BoardName;
            $Board->AddToQueryObject ($Board->name);

            $h = $Board->QueryString($this->fetch->GetAPIkey(), $this->fetch->GetToken());

            $data = $this->fetch->put($url, $h);

            $NewBoard = new Board();
            $NewBoard->SetBoard($data);

            return $NewBoard;
        }
        catch(\Exception $e) {
            throw $e;
        } 
    }

    public function AddBoard(string $BoardName) 
    {
        try 
        {
            $url = "https://api.trello.com/1/boards/";

            $Board = new Board();
            $Board->name = $BoardName;
            $Board->AddToQueryObject ($Board->name);

            $h = $Board->QueryString($this->fetch->GetAPIkey(), $this->fetch->GetToken());

            $data = $this->fetch->post($url, $h);

            $NewBoard = new Board();
            $NewBoard->SetBoard($data);

            return $NewBoard;
        }
        catch(\Exception $e) {
            throw $e;
        } 
    }

    public function DeleteBoard($BoardID) 
    {
        try 
        {
            $url = "https://api.trello.com/1/boards/". $BoardID;

            $Board = new Board();
            $h = $Board->QueryString($this->fetch->GetAPIkey(), $this->fetch->GetToken());
            $url .= $h;

            $data = $this->fetch->Delete($url);

            $NewBoard = new Board();
            $NewBoard->SetBoard($data);

            return $NewBoard;
        }
        catch(\Exception $e) {
            throw $e;
        } 
    }
}