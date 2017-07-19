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
<!-- version is hard-coded for these pages -->
<body class="version-0-1">
<div id="main-wrap">
    <?php require($assets_root.'header.php'); ?>
    <div id="content">
    <!-- Alfred, go ahead and put content in here manually for now -->

        This is the beginning of the Bat Cave!  I’ll explain more in subsequent posts and content updates to the site, but basically BTB is about taking all the technological skills available and getting “off the shoulders of giants” and learning the basics.  This introductory page will always be about this simple, but the source code for every step I took along the way (as well as getting the server set up, testing and archiving versions) will be available.
        <br /><br />

        If you have more questions, you can’t email me yet.  Why? Because we’re in the dark days right now before Javascript email encryptors were available, and you should never put your email on the web in plain text, unless you love spam.
        <br /><br />

        Think of this as a kind of “Back to the Future”.
        <br /><br />

        Also, all changes to this site are maintained in a git repository (to be revealed pretty soon).  Yes this is before the days of Git, but some things you just can’t live without and Git is one of them.
        <br /><br />

        As I started digging the cave, I quickly realized that a journal (non-database at this point, just an HTML page) is one of the most important resources, spiced with a healthy dose of hyperlinking.
        <br /><br />

        Stay tuned, the Batcave will be a great resource for Javascript, PHP, Object Oriented Programming, HTML, XML and CSS, e-commerce, and a healthy dose of RDBMS, with insights on NodeJS, Angular and ReactJS along the way.
        <br /><br />

    </div>
    <?php require($assets_root.'footer.php'); ?>
</div>

</body>

</html>
