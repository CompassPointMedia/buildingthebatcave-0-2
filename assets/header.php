<?php
/**
 * Created by PhpStorm.
 * User: Samuel Fullman
 * Date: 12/30/2016
 * Time: 7:42 PM
 */
?>

<div id="header">
    <h1>Building the Batcave</h1>
    <ul class="nav">
        <?php
        foreach($content[$thisVersion]['navigation'] as $fileName=>$data){
            ?>
            <li><a href="<?php echo $linkRoot.($fileName == 'index.php' ? '' :$fileName);?>" title="<?php echo htmlspecialchars($data[1]);?>"><?php echo $data[0];?></a> </li>
            <?php
        }
        ?>
    </ul>
    <div class="version">Site version: <?php echo $mostCurrentVersion;?></div>
</div>