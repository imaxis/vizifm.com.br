<?php
// Função para obter o caminho base do projeto (reutilizável)
if (!function_exists('getHomeUrl')) {
    function getHomeUrl() {
        // Tenta usar BASE_URL se estiver disponível
        if (defined('BASE_URL')) {
            $baseUrl = BASE_URL;
            // Remove protocolo e domínio, mantendo apenas o caminho
            $baseUrl = preg_replace('#^https?://[^/]+#', '', $baseUrl);
            return rtrim($baseUrl, '/');
        }
        
        // Detecta do SCRIPT_NAME
        $scriptDir = dirname($_SERVER['SCRIPT_NAME']);
        $scriptDir = str_replace('\\', '/', $scriptDir);
        
        // Se o script está na raiz, assume o subdiretório do RewriteBase
        if ($scriptDir === '/' || $scriptDir === '.') {
            // Detecta do REQUEST_URI
            $requestUri = strtok($_SERVER['REQUEST_URI'], '?');
            if (preg_match('#^/([^/]+)#', $requestUri, $matches)) {
                return '/' . $matches[1];
            }
            // Fallback para o RewriteBase conhecido
            return '/vizifmnovo.com.br';
        }
        
        return rtrim($scriptDir, '/');
    }
}

// Determina se estamos na página index ou outra página
$isIndexPage = basename($_SERVER['PHP_SELF']) === 'index.php' || 
               (isset($_SERVER['REQUEST_URI']) && 
                (rtrim($_SERVER['REQUEST_URI'], '/') === '/vizifmnovo.com.br' || 
                 rtrim($_SERVER['REQUEST_URI'], '/') === '/vizifmnovo.com.br/' ||
                 preg_match('#^/vizifmnovo\.com\.br/?$#', $_SERVER['REQUEST_URI'])));

$homeUrl = getHomeUrl();
$homeLink = $isIndexPage ? '#home' : $homeUrl . '/';
$menuLinkPrefix = $isIndexPage ? '#' : $homeUrl . '/#';
?>
<div id="top1">
  <div class="top2_wrapper" id="top2">
    <div class="container">

      <div class="top2 clearfix">

        <header>
          <div class="logo_wrapper" style="margin-top: -10px;">
            <a href="<?php echo $homeLink; ?>" class="logo <?php echo $isIndexPage ? 'scroll-to' : ''; ?>">
              <img src="images/logo.png" alt="" class="img-responsive">
            </a>
          </div>
        </header>

        <div class="menu_wrapper">
          <div class="navbar navbar_ navbar-default">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
              data-target=".navbar-collapse_">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <div class="navbar-collapse navbar-collapse_ collapse">
              <ul class="nav navbar-nav sf-menu clearfix">
                <li><a href="<?php echo $homeLink; ?>">Home</a>
                </li>
                <li><a href="sobre">SOBRE NÓS</a></li>
                <li><a href="#featured">PROMOÇÕES</a></li>
                <li class="sub-menu sub-menu-1"><a href="javascript:void(0);">PÁGINAS<em></em></a>
                  <ul>
                    <li><a href="aplicativo">APLICATIVO VIZIFM</a></li>
                    <li><a href="mais-tocadas">MAIS TOCADAS</a></li>
                    <li><a href="artista-do-momento">ARTISTA DO MOMENTO</a></li>
                    <li><a href="patrocinadores">PATROCINADORES</a></li>
                  </ul>
                </li>
                <li><a href="pdf/midiakit.pdf">MidiaKit</a></li>
                <li><a href="<?php echo $menuLinkPrefix; ?>contacts">CONTATOS</a></li>
                <div style="display: inline-block; float: right; background-color: #c6121a; margin-left: 10px; cursor: pointer">
                  <a class="bg-music-toggle pull-right" data-target="bg-music-toggle" id="play-pause-radio" style="filter: brightness(10); padding: 23px 15px;">
                    <strong>
                      OUÇA AO VIVO
                    </strong>
                    <span></span><span></span><span></span><span></span><span></span>
                  </a>
                </div>

              </ul>
            </div>
          </div>
        </div>


      </div>

    </div>
  </div>

</div>