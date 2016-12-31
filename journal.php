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
<body class="version-<?php echo str_replace('.','-',$thisVersion);?>">
<div id="main-wrap">
    <?php require($assets_root.'header.php'); ?>
    <div id="content">
        <div class="headNotice">Note: items here entered newest to oldest</div>
    <!-- Alfred, go ahead and put content in here manually for now -->
        <div class="article">
            <h2>Next Steps for the Batcave</h2>
            <h3>Journal Entry #2, Dec. 31th 2016</h3>

            So we have a working site and can replicate the process we started up to a point: Copy a template page as a new php page, and register it in the assets/config.php file.  This will get difficult (and messy) really quick as we don't have a tree structure for our navigation, and my bat sensibilities tell me I don't want physical folders on my site.  Folders should mean logical structure of platform, not logical structure of a specific website.
            <br /><br />
            I'm going to introduce a /content folder and have .gitignore exclude it.  But I also want to have a system in place on the front-end routing so that I don't have any actual URL links to the /content folder.  "Content" means something internally, not to the URL or outside world.  So instead of `buildingthebatcave.com/content/journal.php` I would like `buildingthebatcave.com/journal` - much better SEO-wise I might add.
            <br /><br />
            This implies a couple things:
            <ol>
                <li>I need my first controller logic; ideally this should be modular</li>
                <li>This particular site will be content-centric.  A /page-name means a page by that name without any particular hierarchy.  So the controller mapping would be as follows:
                <ul>
                    <li>No page name at all maps to /content/index.php</li>
                    <li>A call to `buildingthebatcave.com/page-name` maps to a view page in /content/page-name.php.  We're a long way from object-oriented still but it's a start.</li>
                    <li>If none of the above apply, we have a 404.</li>
                    <li>This gives us two options: pages in the /content folder, including the default/index page, or a 404</li>
                    <li>We haven't dealt with requests in the URL yet, or any type of useful hierarchy such as `buildingthebatcave.com/downloads/utilities/email-utility/r/v/1.01`.  <strong>However</strong>, I'm choosing a restricted path value like `/r/` meaning request, with all variables (in this case v=1.01) being paired with values after this.</li>
                    <li>The above URL could also be expressed as `buildingthebatcave.com/downloads/utilities/email-utility?v=1.01`</li>
                </ul>
                </li>
            </ol>
            <br />
            Obviously it's time to implement mod_rewrite to make this work.
            <br /><br />
            Note that if I choose to refactor a future version on Zend or CodeIgniter or Yii, the controller constraints I have chosen and the system for implementing them may conflict.
            <br /><br />
            So specific steps in the process are:<br />
            <ul>
                <li/>index.php becomes /content/index-original.php
                <li/>make a note in journal.php and version.php - "this is a hard-coded page and is no longer used in the batcave"
                <li/>develop the controller
                <li/>specify new nav for version 0.02 in config
                <li/>at this point, we should be able to toggle between versions with no loss of content
                <li/>let's beging writing articles, for now with the keyword "granite" for the file name, e.g. /granite-working-with-nodejs
            </ul>

        </div>
        <div class="article">
            <h2>Building of the Batcave Begins</h2>
            <h3>Journal Entry #1, Dec. 30th 2016</h3>
            Today I started a new Git repository on bitbucket (yes I have a github account but use bitbucket more).  I developed the basic template site and used a simple php include() directive for a top and bottom navigation.  Boy is this a rough start!  But the HTML is solid.  I’m not at Minimum Viable Release point right now expect myself and Alfred to be tracking bad guys by mid-January, and have comm up (email) as well.
            <br /><br />

            So, if my system has enough memory to fire off Vagrant/VM, then I'll be able to have buildingthebatcave-local.com on my system and go through the standard test-local-deploy-remote dev process.  Vagrant up booting worked; here are the steps I'm taking:
            <br />
            <ol>
                <li>at bitbucket I create a new empty repository, `buildingthebatcave`
                <li>in my Vagrant box linked folder I create a folder called buildingthebatcave, then cd to it.  I type `git clone https://samfullman@bitbucket.org/samfullman/buildingthebatcave.git` and enter my password
                <li>I then rename the cloned folder to `src`
                <li>I also create one folder called `log` and one called `private`.  Log will be for error and traffic logs, and private will be for passwords, keeping my private passwords out of the repo entirely.  I don't like to depend on .gitignore for multiple deployment configs not being tracked; there should be no instance of a password in the git repository.  If you have a different stratety I'd love to hear from you on this.
            </ol>

            <h3>Running as a Website Locally</h3>
            I booted up my Vagrant VM (already configured for client work), then entered
            <br /><br />

            <code>ssh vagrant@192.168.33.10 #I am using ubuntu/trusty64</code>
            <br /><br />

            and added the following VirtualHost file as /etc/apache2/sites-available/buildingthebatcave-local.com.conf:
            <br /><br />

            <code><pre>
&lt;VirtualHost *:80&gt;
    ServerAdmin weshootspammers@not-a-real-website-dummy.com<
    DocumentRoot /var/www/buildingthebatcave/src
    ServerName buildingthebatcave-local.com
    ServerAlias www.buildingthebatcave-local.com admin.buildingthebatcave-local.com
    ErrorLog /var/www/buildingthebatcave/log/error.log
    CustomLog /var/www/buildingthebatcave/log/access.log combined
&lt;/VirtualHost&gt;
                </pre>
            </code>

            I then typed:
            <br /><br />

            <code>ln -s ../sites-available/buildingthebatcave-local.com.conf</code>

            in the ../sites-enabled folder
            <br /><br />

            Then
            <br /><br />

            <code>service apache2 restart<br />
                apache2 -S #verify the host is there</code>
            <br /><br />

            The "/etc/hosts" file on a Windows 10 machine is located at: `C:\Windows\System32\Drivers\etc\hosts`.  I added the following lines (you'll need to run notepad etc. as an administrator on this file):
            <br /><br />

            <code># Added 2016-12-30 - this should be good, Alfred<br />
            192.168.33.10	buildingthebatcave-local.com<br />
            192.168.33.10	www.buildingthebatcave-local.com<br />
            192.168.33.10	admin.buildingthebatcave-local.com #for future use<br />
            </code>
            <br /><br />

            Now it's time to start coding.  In /var/www/buildingthebatcave/src, I create index.php with:
            <br /><br />

            <code>
                &lt;?php phpinfo();  #omit the closing ?&gt; php tag
            </code>
            <br /><br />

            And.. Great Success!  I've got php working - but a little futuristic for this time in the batcave era, a whopping PHP Version 5.5.9-1ubuntu4.20 (be calm reader and remember the Batcave Philosophy - we're good).  I'm now ready to use PHPStorm by JetBrains to do some creating, and SourceTree to commit and get it up to my repository.
            <br /><br />

            At this point the most important thing is to function on a ticket-like system so as to add meaningful updates in contextual chunks along the way.
            <br /><br />


        </div>
    </div>
    <?php require($assets_root.'footer.php'); ?>
</div>

</body>

</html>
