<div id="header">
    <h1>Building the Batcave</h1>
    <ul class="<?php echo version_compare($thisVersion, '0.2', 'le') ? 'nav': '';?>">
        <?php
        foreach($content[$thisVersion]['navigation'] as $fileName=>$data){
            ?>
            <li><a href="<?php
                echo $linkRoot.
                ($fileName == 'index.php' || $fileName == 'index' ? '' : str_replace('.php','',$fileName) . ($thisVersion=='0.1'? '.php' : ''));?>" title="<?php echo htmlspecialchars($data[1]);?>"><?php echo $data[0];?></a> </li>
            <?php
        }
        ?>
    </ul>
    <div class="version">Site version:
        <script language="JavaScript" type="text/javascript">
            var mostCurrentVersion='<?php echo $mostCurrentVersion;?>';
            var serverTld = '<?php echo $serverTld;?>';

            function toggleLocationVersion(version){
                var l = window.location + '';
                var n = l;
                var protocol = l.match(/^https/) ? 'https' : 'http';
                n = n.replace(/http:\/\/[^\/]+/,'');

                //a little tweaking to handle the original site version with hard-coded php pages
                if(version =='0.1'){
                    if(n.match(/^\/journal\b/)) n=n.replace(/^\/journal\b/,'/journal.php');
                    if(n.match(/^\/articles\b/)) n=n.replace(/^\/articles\b/,'/articles.php');
                    if(n.match(/^\/version\b/)) n=n.replace(/^\/version\b/,'/version.php');
                }else{
                    n=n.replace('/journal.php','/journal')
                        .replace('/articles.php','/articles')
                        .replace('/version.php','/version');
                }
                n = protocol + '://' + (version == mostCurrentVersion ? 'www' : 'version' + version.replace('.','-')) + '.' + serverTld + n;
                window.location = n;
            }
        </script>
    <select name="version" onchange="toggleLocationVersion(this.value)">
        <?php
        $options ='';
        foreach($content as $n=>$v){
            ob_start();
            ?><option value="<?php echo $n?>" <?php if($thisVersion==$n)echo 'selected';?>><?php
            if($n==$mostCurrentVersion){
                echo 'Current ('.$n.')';
            }else{
                echo $n;
            }
            ?></option><?php
            $str=ob_get_contents();
            ob_end_clean();
            //place in descending order
            $options = $str."\n".$options;
        }
        echo $options;
        ?>
    </select>
    </div>
</div>