<?php
/**
 * Thinkmoat (c) 2020
 * MODEL
 *
 * Summary:         TRELLO CARDS
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

class TrelloCards
{
    /** @var string */ private $ListID;
    /** @var Fetch */ private $fetch;

    public function __construct($Token = null, $ListID) {
        $this->fetch = new Fetch($Token);
        $this->ListID = $ListID;
    }

    public function GetCards() {
        try 
        {
            $url = "https://api.trello.com/1/action/" . $this->ListID
            . "?display=true&fields=name,url&key=" . $this->fetch->GetAPIkey() 
            . "&token=" . $this->fetch->GetToken();

            $data = $this->fetch->Get($url);

            $List = [];
            foreach($data as $r) {
                $item = new Card();
                $item->SetCard($r);
                $List[] = $item;
            }

            return $List; 
        }
        catch(\Exception $e) {
            throw $e;
        }  
    }

    public function GetListCards() {
        try 
        {
            $url = "https://api.trello.com/1/lists/" . $this->ListID
            . "/cards?fields=name,url&key=" . $this->fetch->GetAPIkey() 
            . "&token=" . $this->fetch->GetToken();

            $data = $this->fetch->Get($url);

            $List = [];
            foreach($data as $r) {
                $item = new Card();
                $item->SetCard($r);
                $List[] = $item;
            }

            return $List; 
        }
        catch(\Exception $e) {
            throw $e;
        }  
    }

    public function GetCard(int $CardID) {
        try 
        {
            $url = "https://api.trello.com/1/action/" . $CardID 
            . "?display=true&fields=name,url&key=" . $this->fetch->GetAPIkey() 
            . "&token=" . $this->fetch->GetToken();

            $data = $this->fetch->Get($url);

            $item = new Card();
            $item->SetCard($data);

            return $item;   
        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    public function UpdateCard(Card $Card) {
        try 
        {
            $url = "https://api.trello.com/1/cards/" . $Card->id;

            $h = $Card->QueryString($this->fetch->GetAPIkey(), $this->fetch->GetToken());

            $data = $this->fetch->Put($url, $h);
            return $data;
        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    public function AddCard($Card) {
        try 
        {
            $url = "https://api.trello.com/1/cards/" . $Card->id;

            $h = $Card->QueryString($this->fetch->GetAPIkey(), $this->fetch->GetToken());

            $data = $this->fetch->Post($url, $h);

            $item = new Card();
            $item->SetCard($data);

            return $item;
        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    public function GetCardUrl($Card) {
        try 
        {
            $url = "/cards/" . $Card->id;
        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    public function RunBatch($urls = []) {
        try 
        {
            $urlList = implode(",", $urls);

            $url = "https://api.trello.com/1/batch/?urls=" . $urlList . 
            "&key=" . $this->fetch->GetAPIkey() .
            "&token=" . $this->fetch->GetToken();

            $data = $this->fetch->Get($url);
            return $data;
        }
        catch(\Exception $e) {
            throw $e;
        }     
    }


    public function DeleteCard(string $CardID) {
        try 
        {
            $url = "https://api.trello.com/1/cards/" . $CardID
            . "?&key=" . $this->fetch->GetAPIkey() 
            . "&token=" . $this->fetch->GetToken();

            $data = $this->fetch->Delete($url);
            return $data;   
        }
        catch(\Exception $e) {
            throw $e;
        } 
    }

    public function LabelCard(string $CardID, $color = null, $name = null) {
        try 
        {
            $url = "https://api.trello.com/1/cards/" . $CardID 
            . "/labels?color=$color&name=$name";

            $Card = new Card();
            $h = $Card->QueryString($this->fetch->GetAPIkey(), $this->fetch->GetToken());

            $data = $this->fetch->Post($url, $h);
            return $data;   
        }
        catch(\Exception $e) {
            throw $e;
        } 
    }
}