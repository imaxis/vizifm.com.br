<?
/*****************************************************************************************************
*                                                                                                    *
*                              Arquivo de Controle Geral                                             *
*                            Desenvolvido por Agência Studio iMAXIS                                  *
*                                                                                                    *
*****************************************************************************************************/

require_once(APP_PATH."/controller/AcessoCtrl.php");
if(!class_exists('Data'))
require_once(APP_PATH."/util/Data.php");
$data = new Data();
$controlAcessos = new AcessoCtrl();
?>
<style type="text/css">
<!--
.style1 {color: #003399}
-->
</style>

<script language="javascript" type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
<script language="javascript" type="text/javascript" src="../js/excanvas.js"></script>
<script language="javascript" type="text/javascript" src="../js/jquery.jqplot.js"></script>
<script language="javascript" type="text/javascript" src="../js/jqplot.dateAxisRenderer.js"></script>
<script language="javascript" type="text/javascript" src="../js/jqplot.barRenderer.js"></script>
<script language="javascript" type="text/javascript" src="../js/jqplot.categoryAxisRenderer.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.jqplot.css" />
<style type="text/css" media="screen">
    .jqplot-axis {
      font-size: 0.7em;
    }
  </style>
  <script type="text/javascript" language="javascript">

  $(document).ready(function(){
      $.jqplot.config.enablePlugins = true;

acessosSite  = <?= $controlAcessos->getArrayAcessos("Site",15); ?>;
acessosAdmin = <?= $controlAcessos->getArrayAcessos("Admin",15); ?>;


plot1 = $.jqplot('chart', [acessosSite], {
    seriesDefaults:{renderer:$.jqplot.CanvasAxisTickRenderer, rendererOptions:{barPadding:8, barMargin:5}},
	series:[
        {label: "Acessos ao Site"}
    ],

    legend: {show:true, location: 'nw'},
    axes:{xaxis:{renderer:$.jqplot.CategoryAxisRenderer, rendererOptions:{sortMergedLabels:false}}, yaxis:{min:0,  numberTicks:6}}
    });

plot1 = $.jqplot('chart2', [acessosAdmin], {
    seriesDefaults:{renderer:$.jqplot.CanvasAxisTickRenderer, rendererOptions:{barPadding:8, barMargin:5}},
  series:[
        {label: "Acessos ao Admin"}
    ],

    legend: {show:true, location: 'nw'},
    axes:{xaxis:{renderer:$.jqplot.CategoryAxisRenderer, rendererOptions:{sortMergedLabels:false}}, yaxis:{min:0,  numberTicks:6}}
    });
  });
  </script>


<div class="lt" style="padding-bottom:0px!important;">
    <div class="lt_topo">
        <div class="lt_menu_topo" style="padding-bottom: 0px">
            No momento voc&ecirc; est&aacute;
            utilizando a vers&atilde;o 3.0 do Ipanel CMS <br/>Desenvolvido
            por Agência Studio iMAXIS.<br/>
            <strong>Utilize o menu ao lado para iniciar a sua navegação. </strong>
        </div>
        <h2>Acessos ao Site</h2>
        <div id="chart" style="margin-top:0px; margin-left:0px; width:100%; height:250px;"></div>
        <h2>Acessos ao Sistema</h2>
        <div id="chart2" style="margin-top:0px; margin-left:0px; width:100%; height:250px;"></div>
        
        <div class="list_full" style="padding-top: 15px">
            <h2>Últimos Acessos ao Setor Administrativo</h2>
            <table width="98%">
                      <tr class="list_top">
                        <td width="3%"></td>
                        <td width="41%">Usuário</td>
                        <td width="15%">IP</td>
                        <td width="15%">Data</td>
                        <td width="10%">Hora</td>
                        <td width="15%">Host</td>
                      </tr>
            <?
                  $ultimosAcessos = $controlAcessos->getLastAcessosAdmin(20);
                  $count = 0;
                  foreach($ultimosAcessos as $acesso){
            ?>
                      <tr class="iten_list sptl">
                          <td><img src="img/usr.gif"/></td>
                          <td height="25">&nbsp;<strong><?= $acesso['nome'] ?></strong></td>
                        <td><?= $acesso['ip'] ?></td>
                        <td><?= $data->convertDateSqlToDateBRExtense($acesso['data']) ?></td>
                        <td><?= $acesso['hora'] ?></td>
                         <td><?= $acesso['host'] ?></td>
                      </tr>
            <? } ?>
                      <tr class="list_top">
                        <td></td>
                        <td>Usuário</td>
                        <td>IP</td>
                        <td>Data</td>
                        <td>Hora</td>
                        <td>Host</td>
                      </tr>
                    </table>
                </div>
    </div>
</div>
