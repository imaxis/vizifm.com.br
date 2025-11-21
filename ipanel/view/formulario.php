<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CMS - Setor Administrativo iPanel 3.0</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script src="../js/Scripts_ipanel.js"></script>
<!-- Load jQuery -->
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
		google.load("jquery", "1.3");		
</script>
<script type="text/javascript"> 
	function countChars(idElement){
	max_chars = 150; /*número máximo permitido de caracteres*/
	counter = document.getElementById(idElement);
	field = document.getElementById('titulo').value;
	field_length = field.length
	remaining_chars = max_chars-field_length;
	
	if(remaining_chars<=20)
	{
	document.getElementById('titulo').style.backgroundColor="#fff8b0"; 
	}
	if(remaining_chars<=10)
	{
	counter.style.color="#CC0000"; 
	}
	else
	{
	counter.style.color="#4e6381";
	document.getElementById('titulo').style.backgroundColor="#fff"; 
	}
	counter.innerHTML = remaining_chars;
	}
</script> 

<!-- Load jQuery build -->
<!-- 
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="imxDoc">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><div id="imxBody">
          < ? include "modTopo.php" ?>
          <div id="imxAlert"></div>
          <div id="imxStage" class="wide">
            < ?   include "___mod_menu.php" ?>
          
            <div class="stage">
              <div class="stage_conteudo"> -->

                <div class="lt" style="padding-bottom:0px!important;">
                  <div class="lt_topo">
                    <div class="lt_menu_topo form_top">
                      <h1>Not&iacute;cias</h1>
                      <ul>
                        <li class="cselet">
                          <h2>Noticiário</h2>
                          <span class="ctl"></span> <span class="ctr"></span> </li>
                        <div class="clear"></div>
                      </ul>
                      <div class="clear"></div>
                    </div>
                  </div>
                  <div class="stage_formulario">
                    <form method="post" action="#">
                      <div class="form_config">
                        <div class="title_forms" style="margin-bottom:20px;">
                          <h3>Configura&ccedil;&atilde;o</h3>
                        </div>
                      <div class="menu_config">
                        	Configura&ccedil;&otilde;es b&aacute;sicas
                        </div>
                      <ul>
                        	<li>
                            	<label>Criado por:</label>
                                <p></p>
                                <span>
                                <input class="" />
                              </span>
                            </li>
                            <li>
                            	<label>Criado por:</label>
                                <p></p>
                                <span>
                                <input class="" />
                                </span>
                            </li>
                            <li>
                            	<label>Criado por:</label>
                                <p></p>
                                <span>
                                <input class="" />
                                </span>
                            </li>
                            <li>
                            	<label>Criado por:</label>
                                <p></p>
                                <span>
                                <input class="" />
                                </span>
                            </li>
                        </ul>
                        <div class="menu_config">Meta-data</div>
                                                
                        <div class="menu_config">Imagens Padr&otilde;es</div>
                      </div>
                      <div class="box_forms">
                        <div class="title_forms">
                          <h3>Cadastro de not&iacute;cias</h3>
                        </div>
                        <div class="inputs_form">
                          <div class="input_titulo">
                            <input id="titulo" name="titulo" onKeyUp="javascript:countChars('counter_number')" />
                            <div class="cont_right"> <span id="counter_number" class="cont_text1"> ** </span> <span class="cont_text2"> caracteres </span> </div>
                          </div>                          
                          
                          <div class="sptl left">
                          	Editor de Texto:
                          </div>  
                          
                          <div class="right bts_add sptl">
                            <span>            
                            <a title="Adicionar Anexo" class="bt_add_anexo"></a>
                            <a title="Adicionar Vídeo" class="bt_add_video"></a>
                            <a title="Adicionar Áudio" class="bt_add_audio"></a>
                            <a title="Adicionar Imagem" class="bt_add_imagem"></a>
                            </span>
                            <span style="padding:10px; 5px;">Adicionar Mídia:</span>  
                          </div>                    
                          
                                                    
                          
                        </div>
                        
                        <div class="editor_form">
                        	<textarea name="content" style="width:100%"></textarea>
                      	</div>
                        <div class="clear">
                        	<p class="left"><input name="" type="button" class="bt_input" value="Salvar Rascunho" /></p>
                       	  <p class="right"><input name="" type="button" class="bt_input" value="Publicar" /></p>                      
                        </div>
                      </div> 
                    </form>
                  </div>
                  <div class="clear"></div>
                </div>
                <span class="stcl"></span> <span class="stcr"></span>
                <div class="clear"></div>
              <!--
              </div>

            </div>
          </div>
          <div class="clear"></div>
        </div>
        <div class="clear"></div>
        < ? include "modRodape.php" ?></td>
    </tr>
  </table>
</div>
</body>
</html> -->
