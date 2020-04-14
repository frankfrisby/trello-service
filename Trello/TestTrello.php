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

namespace trello;                                   // All files are set with a namespace "trello"

require 'init.php';                                 // Initializes the files needed to run the code.

$dir = File::GetRootDirectory(__FILE__);            // Gets the root directory.
$path = $dir . "userconfig.json";                   // Gets the path fo the userconfig.json
$userobj = File::GetJsonData($path);                // Gets the user data from the userconfig file and turns it into an object.
$user = new User($userobj);                         // Initializes the user object.
                                             
                                                    // START TEST - CREATING A CARD

$Model = new TrelloModel($user);                    // Initializes the Trello Board based on the user config.  
$Board = $Model->TrelloMapping();                   // Fetches sets all data for the board for the user. Do this once and keep in memory. Don't keep doing this. It's taxing. Improvement needed.
$ListID = $Board->List[0]->id;                      // Get the string id for the first list. But if a list doesn't exist then this will fail.
$Hook = new TrelloCards($user->Token(), $ListID);   // Initlaizes the trello card with token and list id
$card = new Card();                                 // Starts a new card object.
$card->idList = $ListID;                            // Setting the values of the list ID (always set the parent id to know where to fall.)
$card->name = "I love working on Trello";           // Start adding the diffrent parameters. In this parameter is the name.
$card->AddToQueryObject($card->name);               // Need to add the name of display of the card.
$card->AddToQueryObject($card->idList);             // Need to add the List id that the card belongs to. (Always need the parent id)

$NewCard = $Hook->AddCard($card);                   // This hook will now add the card to Trello by running the api. Trello should be updated now. Check the browser.

var_export($NewCard);                               // This new card will return the card with it's details from trello.


// To run this code:
// ---------------------------
// Navigate to this directory:
// Assuming you php environment variables setup on your marchine.

// Type "php TestTrello.php"  Enter
// You should get a result and check the browser to see 

// For more examples go to /Tests/TrelloTest.php and pull them into this file to test.