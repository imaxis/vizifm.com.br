<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CMS - Setor Administrativo iPanel 3.0</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script src="Scripts/Scripts_ipanel.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="imxDoc">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <td>
	<div id="imxBody">
    	<? include "mod_topo.php" ?>
        <div id="imxAlert"></div>        
        <div id="imxStage" class="wide">        
        	<?php /*?><? include "mod_menu.php" ?><?php */?>
        	<div class="stage">
                <div class="stage_conteudo">
                	<div class="lt" style="padding-bottom:0px!important;">
                        	<div class="lt_topo">
                                <div class="lt_menu_topo" style="padding-bottom:50px!important;">
                                    <h1>Multim&iacute;dia</h1>
                                    <ul>
                                    	<li class="cselet">
                                            <h2><a title="Conteúdo" alt="Conteúdo" href="#conteudo">Geral</a></h2>
                                            <span class="ctl"></span>
                                            <span class="ctr"></span>                                    
                                        </li>
                                        <li>
                                            <h2><a title="Conteúdo" alt="Conteúdo" href="#conteudo">Imagens</a></h2>
                                            <span class="ctl"></span>
                                            <span class="ctr"></span>                                    
                                        </li>
                                        <li>
                                            <h2><a title="Conteúdo" alt="Conteúdo" href="#conteudo">Vídeos</a></h2>
                                            <span class="ctl"></span>
                                            <span class="ctr"></span>                                    
                                        </li>
                                        <li>
                                            <h2><a title="Conteúdo" alt="Conteúdo" href="#conteudo">Áudios</a></h2>
                                            <span class="ctl"></span>
                                            <span class="ctr"></span>                                    
                                        </li>
                                        <li>
                                            <h2><a title="Conteúdo" alt="Conteúdo" href="#conteudo">Diversos</a></h2>
                                            <span class="ctl"></span>
                                            <span class="ctr"></span>                                    
                                        </li> 
                                        <li>
                                            <h2><a title="Conteúdo" alt="Conteúdo" href="#conteudo">Galerias</a></h2>
                                            <span class="ctl"></span>
                                            <span class="ctr"></span>                                    
                                        </li>                                  
                                        <div class="clear"></div>                                        
									</ul>
                                    <div class="clear"></div>
                                    <div class="midia_add">
                                    	<div class="left">
                                        	<h3>Listando Todos os Registros de Mídia</h3>
                                        </div>
                                        <div class="right bts_add">
                                        	<span>            
                                            <a title="Adicionar Anexo" class="bt_add_anexo"></a>
                                            <a title="Adicionar Vídeo" class="bt_add_video"></a>
                                            <a title="Adicionar Áudio" class="bt_add_audio"></a>
                                            <a title="Adicionar Imagem" class="bt_add_imagem"></a>
                                            </span>
                                            <span style="padding:10px; 5px;">Adicionar Mídia:</span>  
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                            	</div>                                
 								<div id="statusRegistro" class="status_search midia_tools">
                                    <h4>
                                    <a title="Listar Arquivos Originais" class="stselect" href="#originais">Arquivos Originais</a> (1752) | 
                                    <a title="Listar Arquivos Gerados" class="" href="#gerados">Arquivos Gerados</a> (2842) | 
                                    <a title="Listar Arquivos Externos" class="" href="#externos">Arquivos Externos</a> (158) | 
                                    <a title="Listar Vídeos do Youtube" class="" href="#youtube">YouTube</a> (125) | 
                                    <a title="Listar Arquivos Desanexados" class="" href="#desanexados">Desanexados</a> (22) 
                                    </h4>
                                    <div class="form">
                                        <input id="busca" type="text" class="busca" value="Buscar" onblur="this.value='Buscar',mudacor(this,'#fff','italic','','')" onfocus="this.value='',mudacor(this,'#e2e7ed','normal','#00223e','bold')" /></form>
                                        <script>
										(function($){
											
											// jQuery autoGrowInput plugin by James Padolsey
											// See related thread: http://stackoverflow.com/questions/931207/is-there-a-jquery-autogrow-plugin-for-text-fields
												
												$.fn.autoGrowInput = function(o) {
													
													o = $.extend({
														maxWidth: 270,
														minWidth: 0,
														comfortZone: 20
													}, o);
													
													this.filter('input:text#busca').each(function(){
														
														var minWidth = o.minWidth || $(this).width(),
															val = '',
															input = $(this),
															testSubject = $('<tester/>').css({
																position: 'absolute',
																top: -9999,
																left: -9999,
																width: 'auto',
																fontSize: input.css('fontSize'),
																fontFamily: input.css('fontFamily'),
																fontWeight: input.css('fontWeight'),
																letterSpacing: input.css('letterSpacing'),
																whiteSpace: 'nowrap'
															}),
															check = function() {
																
																if (val === (val = input.val())) {return;}
																
																// Enter new content into testSubject
																var escaped = val.replace(/&/g, '&amp;').replace(/\s/g,'&nbsp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
																testSubject.html(escaped);
																
																// Calculate new width + whether to change
																var testerWidth = testSubject.width(),
																	newWidth = (testerWidth + o.comfortZone) >= minWidth ? testerWidth + o.comfortZone : minWidth,
																	currentWidth = input.width(),
																	isValidWidthChange = (newWidth < currentWidth && newWidth >= minWidth)
																						 || (newWidth > minWidth && newWidth < o.maxWidth);
																
																// Animate width
																if (isValidWidthChange) {
																	input.width(newWidth);
																}
																
															};
															
														testSubject.insertAfter(input);
														
														$(this).bind('keyup keydown blur update', check);
														
													});
													
													return this;
												
												};
												
											})(jQuery);
											
											$('input').autoGrowInput();
										</script>
                                    </div>
                            	</div>
                            </div>
                        </div>
                        <div class="lt">
                       		<div class="tool_list_top">
                              <p class="left" style="text-align:left;">
                                    <span>
                                    <select name="">
                                        <option value="">Ações em Massa</option>
                                        <option value="20">Selecionar todos</option>
                                        <option value="50">Inverter Seleção</option>
                                        <option value="500">Enviar para a Lixeira</option>
                                      </select>
                                  </span>
                                                            
                              </p>
                              <div class="filder_data right">
                                	<span>Mostrando Resultados Entre:</span>
                               		<div id="data_filter" class="data_select right">
                                    <input value="16/07/11" type="date" id="dataIni" class="data_input" />
                                    /
                                    <input value="16/08/11" type="date" id="dataFim" class="data_input" />
                                    <input name="" type="image" src="img/bt_nextpg.gif" />                     
                                    </div>
                                    
                                    <script>
									// the french localization
									$.tools.dateinput.localize("pt-br",  {
									   months:        'Janeiro,Fevereiro,Mar&ccedil;o,Abril,Maio,Junho,Julho,Agosto,' +
														'Setembro,Outubro,Novembro,Dezembro',
									   shortMonths:   'Jan,Fev,Mar,Abr,Mai,Jun,Jul,Ago,Sep,Out,Nov,Dez',
									   days:          'Domingo,Segunda,Ter&ccedil;a,Quarta,Quinta,Sexta,S&aacute;bado',
									   shortDays:     'Dom,Seg,Ter,Qua,Qui,Sex,Sab'
									});
									
									
									// dateinput initialization. the language is specified with lang- option
									$("#dataFim, #dataIni").dateinput({ 
										lang: 'pt-br', 
										format: 'dd/mm/yy',
										offset: [30, 0]
									});                                       
									</script>                                    
                              </div>
                              <div class="clear"></div>
                            </div>
                            <div class="list_full">
                            	<table>
                                  <tr>
                                    <td>
                                    
                                        <table class="list_top">
                                          <tr>
                                            <td width="2%"><input name="" type="checkbox" value="" /></td>
                                            <td width="5%">&nbsp;</td>
                                            <td width="2%">ID</td>
                                            <td width="22%">T&iacute;tulo</td>
                                            <td width="29%">Anexo</td>
                                            <td width="24%">Marcadores</td>
                                            <td width="16%">Data</td>
                                          </tr>
                                        </table>
                                    
                                    </td>
                                  </tr>
                                  <tr onmouseover="javascript:this.mudaestilo('block')" onblur="javascript:this.mudaestilo('none'))">
                                    <td>
                                    <div class="apple_overlay" id="overlay" style="display:none;">
                                    	<a class="close"></a>
                                    	<div class="contentWrap"></div>
                                    </div>
                                    	<ul class="list_listing">
                                        	<li>
                                            	<table>
                                                <!--<tr onmouseover="mudaestilo(1,'block','iten_list bg_listing')" onmouseout="mudaestilo(1,'none','iten_list')" class="iten_list" id="reg1">-->
                                                <tr class="iten_list" id="reg1" style="border-bottom-style:dashed!important;">
                                                    <td width="2%"><input name="input2" type="checkbox" value="" /></td>
                                                    <td width="5%">
                                                   	  <a class="ico_thumb" href="#abrir" style="background-image: url(img/zz_img.jpg);"></a>
                                                  </td>
                                                    <td width="3%">12345</td>
                                                    <td width="16%" class="tx_titulo">
                                                    	<h1><strong>castelo_colorido</strong></h1>
                                                    	<div id="editTools1" class="list_actions" style="display:block!important;">
                                                       	<a title="Editar Artigo" href="#editar">Editar</a> |<a title="Apagar Artigo" href="#apagar">Apagar</a> | <a title="Visualizar Artigo" href="#visualizar">Visualizar</a> | <a title="Informa&ccedil;&otilde;es do Artigo" href="#visualizacao">Informa&ccedil;&otilde;es</a></div>
                                                    </td>
                                                    <td width="5%"><a class="ico_file ico_mp3" href="#abrir"></a></td>
                                                    <td width="29%" class="tx_titulo">
                                                    <h1>Cara&uacute;bas no Rio Grande Do Norte mais perto de Francisco Beltr&atilde;o</h1>
                                                    </td>
                                                    <td width="35%" class="tx_tags">ver&atilde;o, morte, afogamento, praia, bombeiros, mar, azul, mulher, desmaio, areia, ar, salva, vidas</td>
                                                    <td width="5%">
                                                    	<p>10/06/2011 - 12:13 Hr</p>                                                   	  
                                                    </td>
                                                  </tr>
                                                <tr class="iten_list">
                                                  <td colspan="8" class="midia_forms">
                                                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="midia_edit">
                                                    <tr id="midia_form">
                                                      <td width="50%">
                                                      	<form>
                                                        	<p>
                                                            	<label>Título:</label>
                                                            	<input name="titulo" type="text" title="Adicione o título principal" />
                                                            </p>
                                                            <p>                                                         
                                                            	<label>Texto Alternativo:</label> 
                                                            	<input name="textoAlt" type="text" title="Adicione o título alternativo" />
                                                            </p>
                                                            <p>
                                                            	<label>Legenda:</label>
                                                            	<input name="legenda" type="text" title="Legenda da imagem" />
                                                            </p>
                                                            <p>
                                                             	<label>Descrição:</label>
                                                                <textarea name="descricao" title="Pequeno texto sobre o que acontece/aparece na imagem"></textarea> 
                                                             </p>                                            
                                                        </form>                                           
                                                      </td>
                                                      <td width="50%">
                                                      <form>
                                                        	<p>
                                                            	<label>Copyright:</label>
                                                            	<input name="copyright" type="text" title="Propriedade da imagem" />
                                                            </p>
                                                            <p>                                                         
                                                            	<label>Tags:</label> 
                                                            	<input name="tags" type="text" title="Tags para melhor referência da imagem" />
                                                            </p>
                                                            <p>
                                                            	<label>URL:</label>
                                                            	<input value="http://www.imaxis.com.br/uploads/imgens/2011-07-20/54548451851548.jpg" name="url" type="text" title="Clique para copiar" onclick="this.execCommand('Copy')" readonly />
                                                            </p>
                                                            <p style="padding-top:20px;">
                                                            <a title="Salvar" href="#salvar" class="bt_azul">Salvar</a> 
                                                            <a title="Adcionar mais" href="#+" class="bt_azul">Adicionar Mais</a>                                                             
                                                            </p>                                            
                                                        </form>
                                                        
                                                        <script>
                                                        $("#midia_form :input").tooltip({
															// place tooltip on the right edge
															position: "top center",														
															// a little tweaking of the position
															offset: [100, -10],														
															// use the built-in fadeIn/fadeOut effect
															effect: "slide",														
															// custom opacity setting
															opacity: 0.7,															
															relative: "true",															
															tipClass: "tip_form",
															onShow: function() {
																this.getTrigger().fadeTo("slow", 0.8);
															}
																																
														});																											               
                                                        </script>               
                                                      </td>
                                                    </tr>
                                                  </table></td>
                                                  </tr>
                                                  <!--<tr onmouseover="javascript:mudaestilo(2,'block','iten_list bg_listing')" onmouseout="javascript:mudaestilo(2,'none','iten_list')" class="iten_list" id="reg2">-->
                                                  <tr class="iten_list" id="reg2">
                                                    <td width="2%" class="bg_check"><input name="input2" type="checkbox" value="" /></td>
                                                    <td width="5%">&nbsp;</td>
                                                    <td width="3%">12345</td>
                                                    <td width="16%" class="tx_titulo">
                                                    	<h1><span>Rascunho</span> Cara&uacute;bas no Rio Grande Do Norte mais perto de Francisco Beltr&atilde;o</h1>
                                                    	<div id="editTools2" class="list_actions">
                                                       	<a title="Editar Artigo" href="#editar">Editar</a> | <a title="Edi&ccedil;&atilde;o R&aacute;pida" href="#editarRapido">Edi&ccedil;&atilde;o R&aacute;pida</a> | <a title="Apagar Artigo" href="#apagar">Apagar</a> | <a title="Visualizar Artigo" href="#visualizar">Visualizar</a> | <a title="Informa&ccedil;&otilde;es do Artigo" href="#visualizacao">Informa&ccedil;&otilde;es</a></div>
                                                    </td>
                                                    <td width="5%">Everton</td>
                                                    <td width="29%" class="tx_tags">&nbsp;</td>
                                                    <td width="35%" class="tx_tags">Nenhuma Tag</td>
                                                    <td width="5%">
                                                   	<p>10/06/2011 - 12:13 Hr</p></td> 
                                                  </tr>
                                                </table>                                                                                                                                    
  </li>                                            
                                            <script>
											$(function() {
												// if the function argument is given to overlay,
												// it is assumed to be the onBeforeLoad event listener
												$("#comments_show a[rel]").overlay({											
													mask: '#fff',
													effect: 'apple',
													speed: 'fast',
													closeOnClick: 'false',											
													onBeforeLoad: function() {											
														var wrap = this.getOverlay().find(".contentWrap");
														wrap.load(this.getTrigger().attr("href"));
													}
											
												});
											});                                        
											</script>
                                    	</ul>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td><table class="list_top">
                                      <tr>
                                        <td width="2%"><input name="input" type="checkbox" value="" /></td>
                                        <td width="5%">&nbsp;</td>
                                        <td width="2%">ID</td>
                                        <td width="22%">T&iacute;tulo</td>
                                        <td width="29%">Anexo</td>
                                        <td width="24%">Marcadores</td>
                                        <td width="16%">Data</td>
                                      </tr>
                                    </table></td>
                                  </tr>
                                </table>                            
                            </div>
                      <div class="alfabeto">
                                <ul>
                                    <li>
                                    	<span>
                                        	<a title="Letra A" alt="Letra A" href="#A">A</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span>
                                        	<a title="Letra B" alt="Letra B" href="#B">B</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span class="alfaSelect">
                                        	<a title="Letra C" alt="Letra C" href="#C">C</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span>
                                        	<a title="Letra D" alt="Letra D" href="#D">D</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span>
                                        	<a title="Letra D" alt="Letra D" href="#D">D</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span>
                                        	<a title="Letra E" alt="Letra E" href="#a">E</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span>
                                        	<a title="Letra F" alt="Letra F" href="#F">F</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span>
                                        	<a title="Letra G" alt="Letra G" href="#G">G</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span>
                                        	<a title="Letra H" alt="Letra H" href="#H">H</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span>
                                        	<a title="Letra I" alt="Letra I" href="#a">I</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span>
                                        	<a title="Letra J" alt="Letra J" href="#a">J</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span>
                                        	<a title="Letra K" alt="Letra K" href="#a">K</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span>
                                        	<a title="Letra L" alt="Letra L" href="#L">L</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span>
                                        	<a title="Letra M" alt="Letra M" href="#M">M</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span>
                                        	<a title="Letra N" alt="Letra N" href="#N">N</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span>
                                        	<a title="Letra O" alt="Letra O" href="#a">O</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span>
                                        	<a title="Letra P" alt="Letra P" href="#P">P</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span>
                                        	<a title="Letra Q" alt="Letra Q" href="#Q">Q</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span>
                                        	<a title="Letra R" alt="Letra R" href="#R">R</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span>
                                        	<a title="Letra S" alt="Letra S" href="#S">S</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span>
                                        	<a title="Letra T" alt="Letra T" href="#a">T</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span>
                                        	<a title="Letra U" alt="Letra U" href="#U">U</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span>
                                        	<a title="Letra V" alt="Letra V" href="#V">V</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span>
                                        	<a title="Letra W" alt="Letra W" href="#X">W</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span>
                                        	<a title="Letra X" alt="Letra X" href="#a">X</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span>
                                        	<a title="Letra Y" alt="Letra Y" href="#Y">Y</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span>
                                        	<a title="Letra Z" alt="Letra Z" href="#Z">Z</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span>
                                        	<a title="Número 1" alt="Número 1" href="#1">1</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span>
                                        	<a title="Número 2" alt="Número 2" href="#2">2</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span>
                                        	<a title="Número 3" alt="Número 3" href="#3">3</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span>
                                        	<a title="Número 4" alt="Número 4" href="#4">4</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span>
                                        	<a title="Número 5" alt="Número 5" href="#5">5</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span>
                                        	<a title="Número 6" alt="Número 6" href="#6">6</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span>
                                        	<a title="Número 7" alt="Número 7" href="#7">7</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span>
                                        	<a title="Número 8" alt="Número 8" href="#8">8</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span>
                                        	<a title="Número 9" alt="Número 9" href="#9">9</a>
                                        </span>
                                    </li>
                                    <li>
                                    	<span>
                                        	<a title="Número 0" alt="Número 0" href="#0">0</a>
                                        </span>
                                    </li>                                    
                                 </ul>                              
                            </div>                            
                            <div class="tool_list_top">
                       	  <p class="left" style="text-align:left;">
                            <span>
                                	<label>Ir Para:</label>
                                	<input id="irPara" name="" type="text" />
                            </span>
                               	<span style="padding:0px 10px">
                                <label>Mostrar linhas:</label>
                                <select name="">
                                      <option value="20">20</option>
                                      <option value="50">50</option>
                                      <option value="100">100</option>
                                      <option value="300">300</option>
                                      <option value="500">500</option>
                                  </select>
                              </span>                            
                              </p>
                              <p class="right" style="text-align:right;">
                              	<span style="padding-right:5px;">
                                	<strong>41-61</strong> de 210
                                </span>
                              	<span style="padding:3px 0px;">
                                <input name="" type="image" src="img/bt_backpg.gif" alt="Voltar" align="texttop" />
                                <input name="" type="image" src="img/bt_nextpg.gif" alt="Voltar" align="texttop" />                                                         
                                </span>                                  
                              </p>
                              <div class="clear" style="border-bottom:1px solid #CCC"></div>
                            </div>
                            <div class="legends">
                            <strong>Legenda:</strong>
                            	<ul>
                                	<li>
                                    	<span class="ico_red"></span>
                                    	<p>Comentários novos</p>
                                    </li>
                                    <li>
                                    	<span class="ico_yellow"></span><p>Comentários rejeitados</p>
                                    </li>
                                    <li>
                                    	<span class="ico_green"></span><p>Comentários aprovados</p>
                                    </li>
                                    <li>
                                    	<span class="ico">
                                       	<img src="img/ico_clock.png" width="16" height="16" /> </span>
                                    	<p>Publica&ccedil;&atilde;o Programada</p>
                                    </li>
                                </ul>                            
                            </div>                            
                  </div>                                
                    <span class="stcl"></span>
                    <span class="stcr"></span>
                    <div class="clear"></div>
                </div>
            </div> 
            <div class="clear"></div>           
        </div>
        <div class="clear"></div>
    </div>
    <? include "mod_rodape.php" ?>
    </td>
    </tr>
</table>
</div>
</body>
</html>
