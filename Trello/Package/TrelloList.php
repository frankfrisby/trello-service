<?php
/**
 * Thinkmoat (c) 2020
 * MODEL
 *
 * Summary:         TRELLO LIST
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

class TrelloList
{
    /** @var string */ private $BoardID;
    /** @var Fetch */ private $fetch;

    public function __construct($Token = null, $BoardID) {
        $this->fetch = new Fetch($Token);
        $this->BoardID = $BoardID;
    }

    public function GetBoardList() {
        try 
        {  
            $url = "https://api.trello.com/1/action/" . $this->BoardID
            . "?display=true&fields=name,url&key=" . $this->fetch->GetAPIkey() 
            . "&token=" . $this->fetch->GetToken();

            $data = $this->fetch->Get($url);

            $List = [];
            foreach($data as $r) {
                $item = new TList();
                $item->SetList($r);
                $List[] = $item;
            }
            
            return $List;
        }
        catch(\Exception $e) {
            throw $e;
        } 
    }

    public function GetOneList(int $ListID): TList {
        try 
        {  
            $url = "https://api.trello.com/1/List/" . $this->BoardID
            . "?display=true&fields=name,url&key=" . $this->fetch->GetAPIkey() 
            . "&token=" . $this->fetch->GetToken();

            $data = $this->fetch->Get($url);

            $item = new TList();
            $item->SetList($data);

            return $item;
        }
        catch(\Exception $e) {
            throw $e;
        } 
    }
 
    public function AddList(TList $List) {
        try 
        {  
            $url = "https://api.trello.com/1/lists?";

            $h = $List->QueryString($this->fetch->GetAPIkey(), $this->fetch->GetToken());

            $data = $this->fetch->Post($url, $h);

            if ($data == null) {
                throw new \Excception("The method did not work or return it back.");
            }

            return true;
        }
        catch(\Exception $e) {
            throw $e;
        } 
    }

    public function UpdateList(tList $List) {
        try 
        {  
            $url = "https://api.trello.com/1/lists/" . $List->id;

            $h = $List->QueryString($this->fetch->GetAPIkey(), $this->fetch->GetToken());

            $data = $this->fetch->Put($url, $h);

            if ($data == null) {
                throw new \Exception("The method did not return a value.");
            }

            return true;
        }
        catch(\Exception $e) {
            throw $e;
        } 
    }

    public function ArchiveList(string $ListID) {
        try 
        {  
            $url = "https://api.trello.com/1/lists/" . $ListID . "/closed";

            $Li = new TList();
            $h = $Li->QueryString($this->fetch->GetAPIkey(), $this->fetch->GetToken());

            $data = $this->fetch->Put($url, $h);
            return $data;
        }
        catch(\Exception $e) {
            throw $e;
        } 
    }


    public function ArchiveAllCardsInList(string $ListID) {
        try 
        {  
            $url = "https://api.trello.com/1/lists/" . $ListID . "/archiveAllCards";

            $Li = new TList();
            $h = $Li->QueryString($this->fetch->GetAPIkey(), $this->fetch->GetToken());

            $data = $this->fetch->Post($url, $h);
            return $data;
        }
        catch(\Exception $e) {
            throw $e;
        } 
    }    

    public function MoveListToBoard(int $ListID, string $NewBoardID) {
        try 
        {  
            $url = "https://api.trello.com/1/lists/" . $ListID . "/" . $NewBoardID;

            $Li = new TList();
            $h = $Li->QueryString($this->fetch->GetAPIkey(), $this->fetch->GetToken());

            $data = $this->fetch->Put($url, $h);
            return true;
        }
        catch(\Exception $e) {
            throw $e;
        } 
    }
}