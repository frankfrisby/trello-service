<?php
/**
 * Thinkmoat (c) 2020
 * MODEL
 *
 * Summary:         INIT
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

require 'helpers/File.php';
require 'helpers/Fetch.php';
require 'User/User.php';
require 'objects/TrelloSupport.php';
require 'objects/Card.php';
require 'objects/TList.php';
require 'objects/Board.php';
require 'package/TrelloCards.php';
require 'package/TrelloBoard.php';
require 'package/TrelloList.php';
require 'Core/TrelloModel.php';
require 'Core/TrelloObjects.php';
require 'package/TrelloHook.php';
require 'Tests/TrelloTest.php';