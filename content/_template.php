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

?><?php
//--- customize this coding

?><!DOCTYPE HTML>
<html>
<!-- document structure compliments of https://css-tricks.com/snippets/html/html5-page-structure/ -->
<head>
    <link rel="stylesheet" type="text/css" href="/assets/style-global.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php
    echo $content[$thisVersion]['navigation'][$fileName][1];
    ?></title>
    <link rel="icon" type="image/ico" href="/favicon.ico">
</head>
<body class="version-<?php echo str_replace('.','-',$thisVersion);?>">
<div id="main-wrap">
    <?php require(ASSET_ROOT.'header.php'); ?>
    <div id="content">
        <h2>Batcave Component Template</h2>
        This is the template file - you're on your own
        <br /><br /><br /><br /><br /><br /><br /><br /><br /><br />



    </div>
    <?php require(ASSET_ROOT.'footer.php'); ?>
</div>

</body>

</html>
