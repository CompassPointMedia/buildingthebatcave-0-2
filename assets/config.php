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

define('SITE_ROOT', str_replace('assets/config.php', '', __FILE__));
define('ASSET_ROOT', SITE_ROOT.'assets/');
define('CONTENT_ROOT', SITE_ROOT.'content/');
define('VENDOR_ROOT', ASSET_ROOT.'vendors/');
define('FUNCTION_ROOT', ASSET_ROOT.'functions/');

//require old-fashioned but useful utility functions
require_once(VENDOR_ROOT.'functions/function_get_file_assets_v100.php');
require_once(VENDOR_ROOT.'functions/function_js_email_encryptor_v100.php');

//--------------- 2017-01-02 begin first Batcave logic for route handling --------------
//create working variable for parsing
$req_uri = $_SERVER['REQUEST_URI'];

$__env = new stdClass();

//NOTE: Apache shouldn't contain the hash in the _SERVER environment but let's approach this from extensibility
//Any actual # should be URLencoded
$hash = strpos($req_uri, '#');
if($hash === false || !strlen($strHash = substr($req_uri, $hash+1, strlen($req_uri) - $hash))){
    $_env->hash = '';
}else{
    $_env->hash = $strHash;
    $req_uri = explode('#', $req_uri);
    $req_uri = $req_uri[0];
}

$query = strpos($req_uri, '?');
if($query === false || !strlen($strQuery = substr($req_uri, $query+1, strlen($req_uri) - $query))){
    $_env->rawQuerystring = '';
}else{
    $_env->rawQuerystring = $strQuery;
    $req_uri = explode('?', $req_uri);
    $req_uri = $req_uri[0];
}

//now let's deal with the /r/ or /s/ splitter - we want the first instance only but either works
$a = preg_split('#/(r|s)/#i',$req_uri);
if(count($a)>1){
    $_env->paramSchema = (strtolower(substr($req_uri,strlen($a[0]),3))=='/r/' ? 'request' : 'unspecified_request');
    $_env->rawParams = substr($req_uri, strlen($a[0])+3, strlen($req_uri) - strlen($a[0])+3);
    if($_env->paramSchema == 'request'){
        $tmp = explode('/',trim($_env->rawParams,'/'));
        for($i=0; $i<count($tmp)/2; $i+=2){
            $_env->params[$tmp[$i]] = isset($tmp[$i+1]) ? $tmp[$i+1] : '';
        }
    }else{
        $_env->params = explode('/', trim($_env->rawParams,'/'));
    }
    $req_uri = $a[0];
}else{
    $_env->paramSchema = '';
    $_env->rawParams = '';
    $_env->params = '';
}

$a = explode('/', trim($req_uri,'/'));
if(count($a) && !empty($a[0])){
    $_env->page = urldecode(array_pop($a));
    $_env->path = $a;
}else{
    $_env->page = 'index.php'; //by convention
    $_env->path = array(); //empty
}
//handle query and param requests - note param requests cannot be array, must be scalar
if($_env->rawParams){
    if($_env->paramSchema == 'request'){
        $a = explode('/', trim($_env->rawParams,'/'));
        foreach($a as $n=>$v){
            if($n % 2)continue; //only odd instances
            //note use of URLdecode; this is automatic for query strings but not so for a URL path
            $_env->params[$v]=(isset($a[$n+1]) ? urldecode($a[$n+1]) : ''); //default value blank
        }
    }else{ //unspecified_request
        $_env->params = explode('/',trim($_env->rawParams,'/'));
    }
}else{
    $_env->params = array();
}
if($_env->rawQuerystring){
    parse_str($_env->rawQuerystring, $_env->query);
}else{
    $_env->query = array();
}
//alias
$fileName = $_env->page;
#print_r($_env);
//--------------- end Batcave logic for route handling --------------



$serverParts = explode('.', $_SERVER['SERVER_NAME']);
$serverDomainExtension = array_pop($serverParts);
if($serverParts[count($serverParts) - 1] == 'co'){
    //e.g. co.fr - but this is incomplete and we'd need much more logic in the Domain model;
    // see https://en.wikipedia.org/wiki/Second-level_domain
    $serverDomainExtension = array_pop($serverParts) . '.'.$serverDomainExtension;
}
$serverDomain = array_pop($serverParts);
$serverTld = $serverDomain.'.'.$serverDomainExtension;
$serverSubdomain = (empty($serverParts) ? '' : current($serverParts)); //!!!!!
$localSubdomain = $serverSubdomain . ($serverSubdomain ? '.': ''). $serverDomain.'.'.$serverDomainExtension;
$requestScheme = $_SERVER['REQUEST_SCHEME'];
//used in navigation
$linkRoot = $requestScheme.'://'.$localSubdomain.'/';


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
        'comments' => 'BTB version 0.2 - Getting Serious Quickly.  We are now using mod_rewrite with our own home-grown routing system (procedural like the old days), but if I do say so myself quite adaptable.  We\'ve introduced a `content` folder which is registered in .gitignore; still hard-coded pages (no blocks or templates yet), but better organized.  Also we have a version toggler so you can go back to 0.1, or forward when the next changes to the Batcave are made.',
        'navigation' => array(
            'index.php' => array('Home', 'Building the Batcave - Home Page'),
            'philosophy.php' => array('Philosophy', 'Building the Batcave Philosophy - What We\'re Accomplishing Here'),
            'articles.php' => array('Articles', 'Batcave technical articles'),
            'journal.php' => array('Journal', 'Building the Batcave - Development Journal'),
            'version.php' => array('Version', 'Version of this site'),
        ),
        'legal' => array(
            'license' => 'See the LICENSE file.  This site and all downloads from it are covered under the MIT license',
            'content' => 'This legal disclaimer is for Building the Batcave version 0.2, &copy;2017 by Sam Fullman.  If you really want to steal something on a site where I\'m giving everything away anyway then please take it and I hope you have a place to sleep tonight.  If you become a millionaire, let me know, and buy me lunch',
        ),
        'updates' => array(
            'Implemented `mod_rewrite`',
            'Implemented article system; article files are in `/content` folder with prefix granite (a tribute to the difficulties excavating the batcave',
            'Further improvements to the routing system; routes are not defined yet, but two types of pretty parameterization supported: 1) //my-page/s/hair/brown/eyes/blue/born/1989-02-23 creates three associative REQUEST parameters, and 2) //my-page/r/brown/blue/1989-02-23 creates the equivalent non-associative array, and it is up to the model to figure out what the variables mean',

        ),
        'repository' => array(
            'location' => 'https://github.com/CompassPointMedia/buildingthebatcave-0-2',
            'contact' => 'Samuel Fullman <sam-git@samuelfullman.com>',
            'final_commit' => '(unspecified)',
        ),

    ),
);

//last entry is most current version
foreach($content as $mostCurrentVersion => $null); //specify the most current version of the site

if(preg_match('/version([-0-9]+)/',$serverSubdomain,$m)){
    $thisVersion = str_replace('-','.',$m[1]);
}else{
    //to include www etc.
    $thisVersion = $mostCurrentVersion;
}

$contentFiles = get_file_assets(CONTENT_ROOT);

if($thisVersion !== '0.1'){
    //------------- route handling; map request to content assets -----------
    //this is dirt simple because our next dev step on the batcave will be to go to a framework

    if(empty($contentFiles[strtolower($fileName).(substr($fileName, -4) == '.php' ? '' : '.php')])){
        //this needs to be there
        $page = (!empty($contentFiles['404.php']) ? $contentFiles['404.php'] : exit('Could you please tell the developer that they "Need a `404.php` page in the /content folder"?  Maybe they\'re just really busy and weren\'t aware of this fact.'));
    }else{
        $page = $contentFiles[strtolower($fileName).(substr($fileName, -4) == '.php' ? '' : '.php')];
    }
    require_once(CONTENT_ROOT.$page['name']);
    exit;
    //------------------------- end route handling ---------------------------
}

//exceptions for 0.1 for home page - we leave it in the repository because it kind of documents the whole site growth process
if($thisVersion == '0.1'){
    if($fileName == 'index.php'){
        //this was the first home page on the site
        require_once(SITE_ROOT.'index-original.php');
        exit;

    }else if(file_exists(SITE_ROOT.$fileName) && empty($_env->path) && $fileName!=='config.php'){ // ..must be in the root of site
        //let them in - it's either the original articles.php, journal.php, or version.php

    }else if(file_exists(CONTENT_ROOT.$fileName . (substr($fileName, -4) == '.php' ? '' : '.php'))) {
        //next precedence for the content folder
        require_once(CONTENT_ROOT . $fileName . (substr($fileName, -4) == '.php' ? '' : '.php'));
        exit;
    }else{
        require_once(CONTENT_ROOT.'404.php');
        exit;
    }
}

