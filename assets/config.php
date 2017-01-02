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


//require old-fashioned but useful utility functions
require_once('functions/function_get_file_assets_v100.php');

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
    $req_uri = $a[0];
}else{
    $_env->paramSchema = '';
    $_env->rawParams = '';
}

$a = explode('/', trim($req_uri,'/'));
if(count($a) && !empty($a[0])){
    $_env->page = urldecode(array_pop($a));
    $_env->path = $a;
}else{
    $_env->page = 'index'; //by convention
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
#print_r($_env);
//--------------- end Batcave logic for route handling --------------



$serverParts = explode('.', $_SERVER['SERVER_NAME']);
$serverDomainExtension = array_pop($serverParts);
$serverDomain = array_pop($serverParts);
$serverTld = $serverDomain.'.'.$serverDomainExtension;
$serverSubdomain = (empty($serverParts) ? '' : current($serverParts));
$localSubdomain = $serverSubdomain . ($serverSubdomain ? '.': ''). $serverDomain.'.'.$serverDomainExtension;
$requestScheme = $_SERVER['REQUEST_SCHEME'];
//used in navigation
$linkRoot = $requestScheme.'://'.$localSubdomain.'/';

//as long as we have physical pages, let's automate this
$fileName = trim($_SERVER['SCRIPT_NAME'],'/');

//where is this file stored
$assets_root = $_SERVER['DOCUMENT_ROOT'].'/assets/';
$content_root = $_SERVER['DOCUMENT_ROOT'].'/content/';


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
            'articles.php' => array('Articles', 'Batcave technical articles'),
            'journal.php' => array('Journal', 'Building the Batcave - Development Journal'),
            'version.php' => array('Version', 'Version of this site'),
        ),
        'legal' => array(
            'content' => 'This legal disclaimer is for Building the Batcave version 0.2, &copy;2017 by Sam Fullman.  If you really want to steal something on a site where I\'m giving everything away anyway then please take it and I hope you have a place to sleep tonight.  If you become a millionaire, let me know, and buy me lunch',
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

if($thisVersion !== '0.1' && substr(strtolower($_env->page),-4)!=='.php'){
    //------------- route handling; map request to content assets -----------
    //this is dirt simple because our next dev step on the batcave will be to go to a framework
    $contentFiles = get_file_assets($content_root);

    if(empty($contentFiles[strtolower($_env->page).'.php'])){
        //this needs to be there
        $page = '404.php';
    }else{
        $page = $contentFiles[strtolower($_env->page).'.php'];
    }
    require_once($content_root.'/'.$page['name']);
    exit;
    //------------------------- end route handling ---------------------------
}

//one last exception for 0.1 for home page - we leave it in the repository because it kind of documents the whole site growth process
if($thisVersion == '0.1' && $fileName=='index.php'){
    require_once($_SERVER['DOCUMENT_ROOT'].'/index-original.php');
    exit;
}
