<?php
/**
 * todo: big deprecated notice here
 */
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
    <link rel="icon" type="image/ico" href="/favicon.ico">
</head>
<!-- version is hard-coded for these pages -->
<body class="version-0-1">
<div id="main-wrap">
    <?php require($assets_root.'header.php'); ?>
    <div id="content">

        You're in version 0.1 - there were no articles on the Batcave back then.  Select a newer version of the site by selecting from the version list (upper right corner).  If you want to view the repository fork of version 0.1-0.2, the link will be provided soon.
        <br /><br />
        --Sam
        <br /><br />



    </div>
    <?php require($assets_root.'footer.php'); ?>
</div>

</body>

</html>
