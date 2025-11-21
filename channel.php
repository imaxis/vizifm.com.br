<!DOCTYPE html>
<html lang="pt-br">
<?php include 'components/mod_head.php' ?>

<body class="not-front">

<div id="main">

    <?php
    require_once "load_ipanel.php";
    $musicasCtrl = new GenericCtrl("Musicas");
    $musicasRanking = $musicasCtrl->getObjectByField('rankingSemanal', 's', false, 0, 0, 'nomeMusica ASC');
    $musicasPopulares = array_slice((array) $musicasRanking, 0, 5);
    
    $viziMidiaCtrl = new GenericCtrl("ViziMidia");
    $viziMidiaItens = $viziMidiaCtrl->getObjects('', '', true, 3, 0, 'data DESC');
    ?>

    <?php include 'components/mod_header.php' ?>


    <div class="breadcrumbs1_wrapper">
        <div class="container">
            <div class="breadcrumbs1"><a href="index.php">Home</a><span>/</span>As Mais Tocadas</div>
        </div>
    </div>

    <div id="content">
        <div class="container">

            <div class="title2 animated" data-animation="fadeInUp" data-animation-delay="100">AS MAIS TOCADAS</div>

            <div class="title3 animated" data-animation="fadeInUp" data-animation-delay="200">Descubra os hits que estão dominando nossa programação! <br> As músicas mais pedidas e ouvidas pelos nossos ouvintes, reunidas em um só lugar.
            </div>

            <br><br><br>

            <div class="radios animated">
                <div class="radio1 head clearfix">
                    <div class="sec1">#</div>
                    <div class="sec2">Nome</div>
                    <div class="sec3">Artista</div>
                    <div class="sec4">Genêro</div>
                    <div class="sec5">Canal</div>
                    <div class="sec6">&nbsp;</div>
                </div>
                <?php if (!empty($musicasRanking)): ?>
                    <?php foreach ($musicasRanking as $index => $musica): ?>
                        <?php
                        $posicao = ($index + 1) . '.';
                        $nomeMusica = htmlspecialchars($musica->nomeMusica, ENT_QUOTES, 'UTF-8');
                        $artista = htmlspecialchars($musica->artista, ENT_QUOTES, 'UTF-8');
                        $genero = htmlspecialchars($musica->genero, ENT_QUOTES, 'UTF-8');
                        $canal = $musica->canal === 'Radio' ? 'Rádio' : 'Spotify';
                        $url = trim((string) $musica->url);
                        $arquivo = trim((string) $musica->arquivo);
                        $hasSpotify = $musica->canal === 'Spotify' && $url !== '';
                        $hasArquivo = $musica->canal === 'Radio' && $arquivo !== '';
                        $arquivoHref = $hasArquivo ? 'ipanel/uploads/musicas/' . $musica->id . '/' . rawurlencode($arquivo) : '';
                        $displayUrl = $hasSpotify ? $url : ($hasArquivo ? $arquivoHref : '');
                        $host = $hasSpotify ? parse_url($url, PHP_URL_HOST) : '';
                        ?>
                        <div class="radio1 clearfix">
                            <div class="sec1"><?php echo $posicao; ?></div>
                            <div class="sec2"><?php echo $nomeMusica; ?></div>
                            <div class="sec3"><?php echo $artista ?: '&mdash;'; ?></div>
                            <div class="sec4"><?php echo $genero ?: '&mdash;'; ?></div>
                            <div class="sec5"><?php echo $canal; ?></div>
                            <div class="sec6">
                                <?php if ($hasArquivo): ?>
                                    <div class="audio2">
                                        <audio class="audio" preload="none" style="width: 100%; visibility: hidden;" controls="controls">
                                            <source type="audio/mpeg" src="<?php echo htmlspecialchars($arquivoHref, ENT_QUOTES, 'UTF-8'); ?>" />
                                            <a href="<?php echo htmlspecialchars($arquivoHref, ENT_QUOTES, 'UTF-8'); ?>">Ouvir música</a>
                                        </audio>
                                    </div>
                                <?php elseif ($hasSpotify): ?>
                                    <div class="audio2">
                                        <audio
                                            class="audio spotify-trigger"
                                            data-url="<?php echo htmlspecialchars($url, ENT_QUOTES, 'UTF-8'); ?>"
                                            preload="none"
                                            style="width: 100%; visibility: hidden;"
                                            controls="controls">
                                            <source type="audio/mpeg" src="data:audio/mpeg;base64,//uQZAAAAAAAAAAAAAAAAAAAAAAASW5mbwAAAA8AAAACAAACcQCAAwAEABAAZGF0YQAAAAA=" />
                                            <a href="<?php echo htmlspecialchars($url, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener">Ouvir no Spotify</a>
                                        </audio>
                                    </div>
                                <?php else: ?>
                                    &mdash;
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="radio1 clearfix">
                        <div class="sec1">&mdash;</div>
                        <div class="sec2" style="width: auto; text-align: center;">Nenhuma música disponível no ranking semanal.</div>
                        <div class="sec3">&nbsp;</div>
                        <div class="sec4">&nbsp;</div>
                        <div class="sec5">&nbsp;</div>
                        <div class="sec6">&nbsp;</div>
                    </div>
                <?php endif; ?>
            </div>

            <script>
                (function() {
                    function bindSpotifyPlayers() {
                        var players = document.querySelectorAll('.spotify-trigger');
                        if (!players.length) {
                            return;
                        }
                        players.forEach(function(player) {
                            if (player.dataset.spotifyBound === 'true') {
                                return;
                            }
                            player.dataset.spotifyBound = 'true';
                            player.addEventListener('play', function(event) {
                                var url = player.getAttribute('data-url');
                                if (url) {
                                    event.preventDefault();
                                    player.pause();
                                    try {
                                        player.currentTime = 0;
                                    } catch (e) {}
                                    window.open(url, '_blank');
                                }
                            });
                        });
                    }
                    if (document.readyState === 'loading') {
                        document.addEventListener('DOMContentLoaded', bindSpotifyPlayers);
                    } else {
                        bindSpotifyPlayers();
                    }
                })();
            </script>


        </div>
    </div>


    <div class="bot1_wrapper">
      <div class="container">
        <div class="row">
          <div class="col-sm-4">

            <div class="logo2_wrapper">
              <a href="index.php" class="logo">
                <img src="images/logo.png" alt="" class="img-responsive">
              </a>
            </div>

            <div class="location1" style="margin-top:20px;">Av. Pref. Dedi B. Montagner, 250 - Centro, Dois Vizinhos</div>

            <div class="phone1">Whatsapp Comercial: (46) 9 9908-0290</div>
            <div class="phone1">Whatsapp Estúdio: (46) 3536-6656</div>

            <div class="mail1"><a href="mailto:admin@vizifm.com.br" style="text-decoration:none;">admin@vizifm.com.br</a></div>

          </div>
          <div class="col-sm-3">

            <div class="bot1_title">MÚSICAS POPULARES</div>

            <ul class="tags1 clearfix">
              <?php if (!empty($musicasPopulares)): ?>
                <?php foreach ($musicasPopulares as $musicaPopular): ?>
                  <?php
                  $musicaPopular = $musicaPopular ?? null;
                  $nomeMusicaPopular = !empty($musicaPopular->nomeMusica)
                    ? htmlspecialchars($musicaPopular->nomeMusica, ENT_QUOTES, 'UTF-8')
                    : 'Música sem título';
                  $artistaMusicaPopular = !empty($musicaPopular->artista)
                    ? htmlspecialchars($musicaPopular->artista, ENT_QUOTES, 'UTF-8')
                    : '';
                  $tituloMusicaPopular = trim($nomeMusicaPopular . ($artistaMusicaPopular ? ' - ' . $artistaMusicaPopular : ''));
                  ?>
                  <li>
                    <a href="javascript:void(0);" title="<?php echo $tituloMusicaPopular; ?>">
                      <?php echo $nomeMusicaPopular; ?>
                    </a>
                  </li>
                <?php endforeach; ?>
              <?php else: ?>
                <li><a href="javascript:void(0);">Em breve atualizaremos as músicas mais tocadas.</a></li>
              <?php endif; ?>
            </ul>
          </div>
          <div class="col-sm-4 col-sm-offset-1">

            <div class="bot1_title">VIZI NA MÍDIA</div>

            <?php if (!empty($viziMidiaItens)): ?>
              <?php
              $totalMidia = count($viziMidiaItens);
              foreach ($viziMidiaItens as $index => $midiaItem):
              ?>
                <?php
                $descricaoMidia = htmlspecialchars((string) $midiaItem->descricao, ENT_QUOTES, 'UTF-8');
                $dataMidia = '';
                $dataMidiaRaw = $midiaItem->data ?? null;
                if (is_array($dataMidiaRaw) && isset($dataMidiaRaw['date'])) {
                  $dataMidiaRaw = $dataMidiaRaw['date'];
                } elseif (is_object($dataMidiaRaw) && method_exists($dataMidiaRaw, 'format')) {
                  $dataMidiaRaw = $dataMidiaRaw->format('Y-m-d');
                }
                if (is_string($dataMidiaRaw) && trim($dataMidiaRaw) !== '') {
                  $timestampMidia = strtotime($dataMidiaRaw);
                  if ($timestampMidia) {
                    $dataMidia = date('d/m/Y', $timestampMidia);
                  }
                }
                $imgMidia = trim((string) $midiaItem->imgMin);
                $imgMidiaUrl = 'https://placehold.co/59x59';
                if (!empty($imgMidia)) {
                  $imgMidiaPath = 'ipanel/uploads/viziMidia/' . $midiaItem->id . '/' . $imgMidia;
                  if (is_file($imgMidiaPath)) {
                    $imgMidiaUrl = 'ipanel/uploads/viziMidia/' . $midiaItem->id . '/' . rawurlencode($imgMidia);
                  }
                }
                $midiaItemUrl = 'multimidia';
                $itemClass = 'latest1';
                if ($index === ($totalMidia - 1)) {
                  $itemClass .= ' last';
                }
                ?>
                <div class="<?php echo $itemClass; ?>">
                  <a href="<?php echo htmlspecialchars($midiaItemUrl, ENT_QUOTES, 'UTF-8'); ?>" class="clearfix">
                    <figure><img src="<?php echo htmlspecialchars($imgMidiaUrl, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo $descricaoMidia; ?>"></figure>
                    <div class="caption">
                      <div class="txt1"><?php echo $descricaoMidia; ?></div>
                      <?php if (!empty($dataMidia)): ?>
                        <div class="txt2"><?php echo htmlspecialchars($dataMidia, ENT_QUOTES, 'UTF-8'); ?></div>
                      <?php endif; ?>
                    </div>
                  </a>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <div class="latest1">
                <a href="multimidia" class="clearfix">
                  <figure><img src="https://placehold.co/59x59" alt=""></figure>
                  <div class="caption">
                    <div class="txt1">Em breve novas matérias da Vizi na mídia.</div>
                  </div>
                </a>
              </div>
            <?php endif; ?>

            <a href="multimidia" class="btn-default btn3">LEIA MAIS</a>

          </div>
        </div>
      </div>
    </div>

    <div class="bot2_wrapper">
      <div class="container">
        Copyright © <?php echo date('Y'); ?> Todos os Direitos Reservados <a href="" target="_blank"><b>VIZIFM</b></a>
      </div>
    </div>


</div>


    <?php include 'components/mod_scripts.php' ?>
</body>
</html>