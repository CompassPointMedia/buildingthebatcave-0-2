function write_check(e,t,c,s){
	var a='&';
	var n='#';
	e=e.replace(/,/g,';'+a+n);
	e=e.replace(';','');
	t=t.replace(/,/g,';'+a+n);
	t=t.replace(';','');
	var s1='%3c%61%20%68%72%65%66%3d%22%6d%61%69%6c%74%6f%3a';
	var s2='%3c%2f%61%3e';
	document.write(unescape(s1)+e+'"'+(typeof c!='undefined'?' class="'+c+'"':'')+(typeof s!='undefined'?' style="'+s+'"':'')+'>'+t+unescape(s2));
}
