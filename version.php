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
    <link rel="stylesheet" type="text/css" href="/assets/style-global.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php
    echo $content[$thisVersion]['navigation'][$fileName][1];
    ?></title>
</head>
<body>
<div id="main-wrap">
    <?php require($assets_root.'header.php'); ?>
    <div id="content">
    <!-- Alfred, go ahead and put content in here manually for now -->
    This is the version page.  Version: <?php echo $thisVersion;?>
    </div>
    <?php require($assets_root.'footer.php'); ?>
</div>

</body>

</html>
