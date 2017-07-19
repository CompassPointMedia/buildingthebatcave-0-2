<?php

/**
 * @param $contentFiles
 */
function parse_articles($contentFiles){
    ?><ul><?php
    echo PHP_EOL;
    foreach($contentFiles as $n=>$v){
        if(substr($n,0,7) !== 'granite') continue;
        $name = str_replace('.php','',$v['name']);
        $name = str_replace('granite-','',$name);
        $name = str_replace('-',' ',$name);
        $name = ucwords($name);
        ?><li><a href="/<?php echo str_replace('.php','',$v['name']);?>"><?php echo $name;?></a></li><?php
        echo PHP_EOL;
    }
    ?></ul><?php
    echo PHP_EOL;
}