<?php
/**
 * Created by PhpStorm.
 * User: Samuel Fullman
 * Date: 12/30/2016
 * Time: 7:13 PM
 * OK, Alfred, let's get the following done:
 *  1. this first excavation will be called batcave 0.1.  This will not be the main home site for long as it's below minimum viable release, but I  want to keep it for historical value.  It will eventually be version0-1.buildingthebatcave.com and I want all the links to reflect this; we should be able (within update limits) to see the site in previous versions
 *  2. Global stylesheet of course
 *  3. version of the site in upper right corner
 *  4. that's about it.
 */

//use require_once, make this work in any folder
require_once($_SERVER['DOCUMENT_ROOT'].'/assets/config.php');


//--- customize this coding
$versionClass = $thisVersion;
$versionClass = explode('.', $versionClass);
$versionClass = $versionClass[0] . (!empty($versionClass[1]) ? '-' . $versionClass[1] : '');

?><!DOCTYPE HTML>
<html>
<!-- document structure compliments of https://css-tricks.com/snippets/html/html5-page-structure/ -->
<head>
    <?php if(version_compare($thisVersion, '0.3', 'ge')) { ?>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <?php } ?>

    <link rel="stylesheet" type="text/css" href="/assets/css/style-global.css" />
    <script language="JavaScript" type="text/javascript" src="/assets/js/common.js" ></script>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php
        $f = strtolower($fileName).(substr($fileName, -4) == '.php' ? '' : '.php');
        echo !empty($content[$thisVersion]['navigation'][$f][1]) ? $content[$thisVersion]['navigation'][$f][1] : $f
        ?></title>
    <link rel="icon" type="image/ico" href="/favicon.ico">
</head>
<body class="version-<?php echo $versionClass;?>">
