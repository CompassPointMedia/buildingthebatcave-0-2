<?php
/**
 * Created by PhpStorm.
 * User: Samuel Fullman
 * Copied from initial template
 * Created: 8:48PM
 */

//use require_once, make this work in any folder
require_once($_SERVER['DOCUMENT_ROOT'].'/assets/config.php');

?><?php
//--- customize this coding

?><!DOCTYPE HTML>
<html>
<!-- document structure compliments of https://css-tricks.com/snippets/html/html5-page-structure/ -->
<head>
    <link rel="stylesheet" type="text/css" href="/assets/css/style-global.css" />
    <script language="JavaScript" type="text/javascript" src="/assets/js/common.js" ></script>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php
    echo $content[$thisVersion]['navigation'][$fileName][1];
    ?></title>
    <link rel="icon" type="image/ico" href="/favicon.ico">
</head>
<!-- version is hard-coded for these pages -->
<body class="version-0-1">
<div id="main-wrap">
    <?php require(ASSET_ROOT.'header.php'); ?>
    <div id="content">
    <!-- Alfred, go ahead and put content in here manually for now -->
    This is the version page.  Version: <?php echo $thisVersion;?>

        <span style="color:darkred;">We are in the site root, not the content folder!!</span>

    </div>
    <?php require(ASSET_ROOT.'footer.php'); ?>
</div>

</body>

</html>
