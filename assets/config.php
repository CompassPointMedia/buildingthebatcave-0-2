<?php
/**
* Created by PhpStorm.
* User: Samuel Fullman
* Date: 12/30/2016
* Time: 7:19 PM
*
 *
*/
//yes I would set these in an object sometime in the distant future..
$serverParts = explode('.', $_SERVER['SERVER_NAME']);
$serverTld = array_pop($serverParts);
$serverDomain = array_pop($serverParts);
$serverSubdomain = (empty($serverParts) ? '' : current($serverParts));
$localSubdomain = $serverSubdomain . ($serverSubdomain ? '.': ''). $serverDomain.'.'.$serverTld;
$requestScheme = $_SERVER['REQUEST_SCHEME'];
//used in navigation
$linkRoot = $requestScheme.'://'.$localSubdomain.'/';

//as long as we have physical pages, let's automate this
$fileName = trim($_SERVER['SCRIPT_NAME'],'/');

//where is this file stored
$assets_root = $_SERVER['DOCUMENT_ROOT'].'/assets/';

$mostCurrentVersion = '0.1'; //specify the most current version of the site
$content = array(
    //this mapping grows as the site versions up, but we keep a snapshot of the site at previous epochs.
    '0.1' => array(
        'comments' => 'Building the Batcave version 0.1 - A New Hope or something like that.  No OOP or even javascript yet, just a first blush look at what a template site might have looked like in the early days of excavation of the cave.  There is no database source yet.',
        'navigation' => array(
            'index.php' => array('Home','Building the Batcave - Home Page'),
            'journal.php' => array('Journal', 'Building the Batcave - Development Journal'),
            'version.php' => array('Version', 'Version of this site'),
        ),
        'legal' => array(
            'content' => 'This legal disclaimer was designed by no lawyer at all but hopefully it will sound scary anyway.  Let\'s be honest, you can probably take anything here and call it your own and get away with it.  Then again, maybe not - this is the Batcave, and bat ears are very sensitive, and they are everywhere..',
        ),
    ),
    '0.2' => array(
        /* to be defined and documented in the journal and the README */
    ),
);

if(preg_match('/version([-0-9]+)/',$serverSubdomain,$m)){
    $thisVersion = str_replace('-','.',$m[1]);
}else{
    $thisVersion = $mostCurrentVersion;
}

