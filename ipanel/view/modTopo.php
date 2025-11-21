<div id="imxTop">
  <div class="topoPg">
    <div class="topo_logomarca"> <a title="Painel Administrativo" alt="Painel Administrativo" href="?lc=Iniciar&md=Inicio"><img src="img/logo_ipanel.png" width="117" height="37" /></a> </div>
    <div class="logo_info left">
      <div class="info_cliente">
        <h1>Vizi FM</h1>
        <h2><a title="Acessar site" alt="Acessar Site" href="http://www.vizifmnovo.com.br">http://www.vizifmnovo.com.br</a></h2>
      </div>
    </div>
    <div class="user_service">
      <h1>Olá <?= $userNome ?></h1>
      <ul>
        <li><a title="Acessar E-mail" alt="Acessar e-mail" target="_blank" href="http://webmail.vizifmnovo.com.br/"><img src="img/ico_mail.gif" width="12" height="8" /> E-mail</a></li>
        <!-- <li><a title="Área de Suporte" alt="área de Suporte" href="suporte.php">Suporte</a></li> -->
        <li><a title="Sair do Setor Administrativo" alt="Sair do Setor Administrativo" 
               href="javascript:if(confirm('Deseja realmente finalizar esta sessão ?')){window.parent.location ='../app/cms/processa.php?action=Logoff'}">Sair</a></li>
      </ul>
    </div>
  </div>
</div>
