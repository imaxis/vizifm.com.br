<? include "modTopView.php" ?>
<script src="../js/busca.js"  type="text/javascript" language="javascript"></script>

<div class="lt" style="padding-bottom:0px !important">
    <div class="lt_topo">
        <?= $this->getImage() ?>
        <div class="lt_menu_topo">
            <h1><?= $this->getCurrentTitle() ?></h1>
            <ul>
                <?= $this->getCurrentDescription() ?>
                <div class="clear"></div>
            </ul>
            <div class="clear"></div>
        </div>
        <div id="statusRegistro" class="status_search">
            <h3>Listagem de registros em <?= $this->getCurrentAlias() ?></h3>
            <?= $this->writeStatusOptions() ?>
            <?= $this->writeSearchForm($fieldSearch, $valueIniRetorno, $valueEndRetorno, $_GET) ?>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div class="lt">
    <div class="tool_list_top"><? include "modActions.php" ?></div>
    <div class="list_full">

        <form name="FormLista" action="../app/cms/processa.php?lc=<?= $this->getArea() ?><?= $parametersUrl ?>" enctype="multipart/form-data" method="post" onSubmit="return Confirma()">
        <input type="hidden" name="prm" value="<?= $this->parametrosAdd ?>"/>
        <input type="hidden" name="action" value="DeleteList"/>

  <?
     /**
      *  Gera o grid dinamicamente
      *
      */
      print $this->writeGrid($arrayList, $parametersUrl);
  ?>

        </form>
    </div>
   <? include ("modPaginacao.php") ?>
</div>