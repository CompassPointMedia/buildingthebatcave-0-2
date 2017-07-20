<?php
$functionVersions['js_email_encryptor']=1.00;
function js_email_encryptor($email,$text='',$class='',$style=''){
	/*
	2009-01-21: based on js function write_check() in /Library/js/common_04_i1.js
	options
		text
		class
		style
		return vs echo
	*/
	$a=func_get_args();
	if(is_array($a[1])){
		unset($text);//2nd param
		extract($a[1]);//same thing
	}
	if(!empty($return)) ob_start();
	$rand=rand(0,10000);
	echo PHP_EOL;
	?><script language="javascript" type="text/javascript">
var v<?php echo $rand?> ='write_check("<?php
//email
for($i=0;$i<strlen($email);$i++) echo ','.ord($email[$i]);
?>","<?php
$text=($text?$text:$email);
//text
for($i=0;$i<strlen($text);$i++) echo ','.ord($text[$i]);
?>"<?php
if($class || $style)echo ',"'.$class.'"';
if($style)echo ',"'.$style.'"';

?>);';
eval(v<?php echo $rand?>);
</script><?php
    echo PHP_EOL;
	if(!empty($return)) {
        $out = ob_get_contents();
        ob_end_clean();
        return $out;
    }
}
