<!DOCTYPE html>
<html lang="pt-br">
<?php include 'components/mod_head.php' ?>

<body class="onepage front" data-spy="scroll" data-target="#top1" data-offset="92" onload="onload()">

  <div id="load"></div>

  <audio id="bg-music">
    <source src="https://ice.fabricahost.com.br/vizifmpr" type="audio/mpeg">
  </audio>

  <?php
  $programaCtrl =  new ProgramaCtrl();
  $programa = $programaCtrl->getProgramaAtual();
  $locutorProgramaAtualCtrl = new GenericCtrl("Locutor");
  $locutorProgramaAtual = $locutorProgramaAtualCtrl->getObject($programa[0]->lcId);

  $musicasCtrl = new GenericCtrl("Musicas");
  $musicasRanking = $musicasCtrl->getObjectByField('rankingSemanal', 's', false, 0, 0, 'nomeMusica ASC');

  $musicasPopulares = array_slice((array) $musicasRanking, 0, 5);

  $mensagemDiaCtrl = new GenericCtrl("MensagemDia");
  $dataAtual = date('Y-m-d');
  $mensagemDiaAtual = null;
  $mensagemDiaAudio = null;
  $mensagemDiaDataFormatada = null;

  $viziMidiaCtrl = new GenericCtrl("ViziMidia");
  $viziMidiaItens = $viziMidiaCtrl->getObjects('', '', true, 3, 0, 'data DESC');

  $programasSegundaSexta = $programaCtrl->getObjectByField('dia', 'Segunda - Sexta', false, 0, 0, 'inicio ASC');
  $programasSabado = $programaCtrl->getObjectByField('dia', 'Sábado', false, 0, 0, 'inicio ASC');
  $programasDomingo = $programaCtrl->getObjectByField('dia', 'Domingo', false, 0, 0, 'inicio ASC');

  $programacaoBlocos = array(
    'Segunda - Sexta' => array(
      'id' => 'programacao-segunda-sexta',
      'titulo' => 'PROGRAMAÇÃO SEGUNDA - SEXTA',
      'descricao' => 'Toda a energia da nossa programação ao longo da semana pra você começar o dia com o pé direito.',
      'programas' => $programasSegundaSexta,
    ),
    'Sábado' => array(
      'id' => 'programacao-sabado',
      'titulo' => 'PROGRAMAÇÃO SÁBADO',
      'descricao' => 'A trilha sonora do seu fim de semana começa aqui, com os melhores programas de sábado.',
      'programas' => $programasSabado,
    ),
    'Domingo' => array(
      'id' => 'programacao-domingo',
      'titulo' => 'PROGRAMAÇÃO DOMINGO',
      'descricao' => 'Domingão na Vizi FM com muita música boa e as atrações que você já ama.',
      'programas' => $programasDomingo,
    ),
  );

  $mensagensDia = $mensagemDiaCtrl->getObjectByFields(
    array('dtExibicao'),
    array($dataAtual),
    false,
    0,
    0,
    'id DESC'
  );

  if (!empty($mensagensDia)) {
    $mensagemDiaAtual = $mensagensDia[0];
    if (!empty($mensagemDiaAtual->arquivo)) {
      $mensagemDiaAudio = 'ipanel/uploads/mensagemDia/' . $mensagemDiaAtual->id . '/' . rawurlencode($mensagemDiaAtual->arquivo);
    }
    if (!empty($mensagemDiaAtual->dtExibicao)) {
      $timestampMensagem = strtotime($mensagemDiaAtual->dtExibicao);
      if ($timestampMensagem) {
        $mensagemDiaDataFormatada = date('d/m/Y', $timestampMensagem);
      }
    }
  }

  $locutorCtrl = new GenericCtrl("Locutor");
  $locutores = $locutorCtrl->getAllObjects(false, 0, 0, 'nome ASC');
  ?>

  <div id="main">
    <div id="home">
      <div class="logo3_wrapper">
        <a href="<?php echo $homeLink; ?>" class="logo <?php echo $isIndexPage ? 'scroll-to' : ''; ?>">
          <img src="images/logo.png" alt="" class="img-responsive">
        </a>
      </div>
      <div id="slider_wrapper">
        <div class="go-down"><a href="#featured" class="scroll-to"></a></div>
        <div class="">
          <div id="slider_inner" class="clearfix">
            <div id="slider" class="clearfix">
              <div id="camera_wrap">
                <div data-src="images/imagemFundoTelaInicial.png">
                  <div class="camera_caption fadeFromLeft nav1 top-title">
                    <div class="txt1 txt"><?php echo $programa[0]->nome ?></div>
                    <div class="txt4"><?php echo $programa[0]->inicio ?> - <?php echo $programa[0]->fim ?></div>
                    <div class="txt5">
                      <a href="#song-player" class="btn-default btn0">OUVIR AGORA</a>
                    </div>
                  </div>
                </div>
                <!-- -->
                <div data-src="images/imagemFundoTelaInicial.png">
                  <div class="camera_caption fadeFromRight nav2">
                    <div class="txt1 txt">RADIO FM</div>
                    <div class="txt2 txt">WE ARE</div>
                    <div class="txt3 txt">LIVE</div>
                    <div class="txt4">06:00 - 24:00</div>
                    <div class="txt5">
                      <a href="#" class="btn-default btn0">MORE EPISODES</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="song1_wrapper" id="song-player">
        <div class="container">
          <div class="song1_inner clearfix">
            <div class="song1 clearfix">
              <div class="left clearfix">
                <?php
                $nomePrograma = 'Programa ao vivo';
                $nomeLocutor = 'Locutor';
                
                if (!empty($programa) && isset($programa[0])) {
                  $nomePrograma = htmlspecialchars($programa[0]->nome ?? 'Programa ao vivo', ENT_QUOTES, 'UTF-8');
                  
                  if (!empty($locutorProgramaAtual) && !empty($locutorProgramaAtual->nome)) {
                    $nomeLocutor = htmlspecialchars($locutorProgramaAtual->nome, ENT_QUOTES, 'UTF-8');
                  }
                }
                ?>
                <div class="caption">
                  <div class="txt1"><?php echo $nomePrograma; ?></div>
                  <div class="txt2">Com <?php echo $nomeLocutor; ?></div>
                </div>
              </div>
              <div class="right">
                <div class="audio1">
                  <audio id="live-radio-player" class="audio" preload="none" style="width: 100%; visibility: hidden;"
                    controls="controls">
                    <source type="audio/mpeg" src="https://ice.fabricahost.com.br/vizifmpr" />
                    <a href="https://ice.fabricahost.com.br/vizifmpr">Ouvir ao vivo</a>
                  </audio>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include 'components/mod_header.php' ?>

    <?php include 'mod_promocoes.php'; ?>

    <div id="collection2">
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

    <div id="testimonial">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 animated" data-animation="fadeInLeft" data-animation-delay="100">
            <div class="speaker-wrapper">
              <img src="images/mesagemDia.png" alt="" class="img-responsive">
            </div>
          </div>
          <div class="col-sm-6 animated" data-animation="fadeInRight" data-animation-delay="200">
            <div class="mensagem-dia-wrapper">
              <div class="title2">MENSAGEM DO DIA</div>
              <div class="title1" style="margin-bottom: 30px;">Reflexão especial para <?php echo $mensagemDiaDataFormatada ?: date('d/m/Y'); ?></div>
              <?php if ($mensagemDiaAtual): ?>
                <h3 class="mensagem-dia-titulo"><?php echo htmlspecialchars($mensagemDiaAtual->titulo, ENT_QUOTES, 'UTF-8'); ?></h3>
                <?php if (!empty($mensagemDiaAtual->autor)): ?>
                  <p class="mensagem-dia-autor">Por <?php echo htmlspecialchars($mensagemDiaAtual->autor, ENT_QUOTES, 'UTF-8'); ?></p>
                <?php endif; ?>
                <div class="mensagem-dia-texto" style="margin-bottom: 30px;">
                  <?php echo $mensagemDiaAtual->mensagem; ?>
                </div>
                <?php if ($mensagemDiaAudio): ?>
                  <div class="mensagem-dia-audio" style="margin-top: 20px;">
                    <div class="audio1" style="width: 100%;">
                      <audio class="audio" preload="none" style="width: 100%; visibility: hidden;" controls="controls">
                        <source type="audio/mpeg" src="<?php echo htmlspecialchars($mensagemDiaAudio, ENT_QUOTES, 'UTF-8'); ?>" />
                        <a href="<?php echo htmlspecialchars($mensagemDiaAudio, ENT_QUOTES, 'UTF-8'); ?>">Ouvir mensagem</a>
                      </audio>
                    </div>
                  </div>
                <?php endif; ?>
              <?php else: ?>
                <p class="mensagem-dia-indisponivel">Ainda não temos uma mensagem especial para hoje. Volte em breve e confira as novidades!</p>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Programação dinâmica por dia -->
    <section class="programacao-section" id="programacao">
      <div class="container">
        <?php foreach ($programacaoBlocos as $diaKey => $programacao): ?>
          <div class="programacao-dia-wrapper">
            <div class="title2 animated" data-animation="fadeInUp" data-animation-delay="200"><?php echo htmlspecialchars($programacao['titulo'], ENT_QUOTES, 'UTF-8'); ?></div>
            <?php if (!empty($programacao['descricao'])): ?>
              <div class="title3 animated" data-animation="fadeInUp" data-animation-delay="300">
                <?php echo htmlspecialchars($programacao['descricao'], ENT_QUOTES, 'UTF-8'); ?>
              </div>
            <?php endif; ?>

            <div class="program-listings row">
              <?php if (!empty($programacao['programas'])): ?>
                <?php foreach ($programacao['programas'] as $programa): ?>
                  <?php
                  $nomePrograma = htmlspecialchars((string) $programa->nome, ENT_QUOTES, 'UTF-8');
                  $descricaoPrograma = htmlspecialchars((string) $programa->descricao, ENT_QUOTES, 'UTF-8');
                  $inicioPrograma = substr((string) $programa->inicio, 0, 5);
                  $fimPrograma = substr((string) $programa->fim, 0, 5);
                  $horarioPrograma = trim($inicioPrograma) !== '' && trim($fimPrograma) !== '' ? $inicioPrograma . ' - ' . $fimPrograma : '';

                  $locutorNome = '';
                  if (!empty($programa->lcId)) {
                    $locutorDoPrograma = $locutorProgramaAtualCtrl->getObject($programa->lcId);
                    if ($locutorDoPrograma) {
                      $locutorNome = htmlspecialchars((string) $locutorDoPrograma->nome, ENT_QUOTES, 'UTF-8');
                    }
                  }

                  $uploadBasePath = 'ipanel/uploads/programas/' . $programa->id . '/';
                  $imagemProgramaUrl = 'https://placehold.co/480x320?text=Programa';
                  $capaArquivos = array('Capa.jpg', 'Capa.jpeg', 'Capa.png', 'Capa.webp');
                  $capaEncontrada = false;
                  foreach ($capaArquivos as $capaArquivo) {
                    $capaPath = $uploadBasePath . $capaArquivo;
                    if (is_file($capaPath)) {
                      $imagemProgramaUrl = $uploadBasePath . rawurlencode($capaArquivo);
                      $capaEncontrada = true;
                      break;
                    }
                  }
                  if (!$capaEncontrada) {
                    $imagemPrograma = trim((string) $programa->imagem);
                    if ($imagemPrograma !== '') {
                      $imagemOriginalPath = $uploadBasePath . $imagemPrograma;
                      if (is_file($imagemOriginalPath)) {
                        $imagemProgramaUrl = $uploadBasePath . rawurlencode($imagemPrograma);
                      }
                    }
                  }
                  ?>
                  <div class="col-lg-4 col-md-6 col-sm-6 program-card-column">
                    <div class="program-card animated" data-animation="fadeInUp" data-animation-delay="200">
                      <figure class="program-card-figure">
                        <img src="<?php echo htmlspecialchars($imagemProgramaUrl, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo $nomePrograma; ?>" class="img-responsive">
                      </figure>
                      <div class="program-card-body">
                        <?php if ($horarioPrograma !== ''): ?>
                          <div class="program-card-time"><?php echo htmlspecialchars($horarioPrograma, ENT_QUOTES, 'UTF-8'); ?></div>
                        <?php endif; ?>
                        <div class="program-card-title"><?php echo $nomePrograma; ?></div>
                        <?php if ($locutorNome !== ''): ?>
                          <div class="program-card-locutor">Com <?php echo $locutorNome; ?></div>
                        <?php endif; ?>
                        <?php if ($descricaoPrograma !== ''): ?>
                          <p class="program-card-description"><?php echo $descricaoPrograma; ?></p>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php else: ?>
                <div class="col-sm-12">
                  <div class="program-card-empty">
                    Ainda não temos programas cadastrados para este dia.
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

    <div id="content">
      <div class="container">

        <div class="title2 animated" data-animation="fadeInUp" data-animation-delay="200">NOSSA EQUIPE</div>
        <div class="title4 animated" data-animation="fadeInUp" data-animation-delay="300">Por trás de cada voz, há uma equipe apaixonada pelo que faz. Conheça quem leva o rádio até você com energia e dedicação!
        </div>

        <br><br><br>

        <?php if (!empty($locutores)): ?>
          <div class="locutor-slider-wrapper slick-slider-wrapper">
            <div class="slick-slider locutor-slider">
              <?php foreach ($locutores as $locutor): ?>
                <?php
                $nomeLocutor = htmlspecialchars((string) ($locutor['nome'] ?? ''), ENT_QUOTES, 'UTF-8');
                $profissaoLocutor = htmlspecialchars((string) ($locutor['profissao'] ?? ''), ENT_QUOTES, 'UTF-8');
                $fotoLocutor = trim((string) ($locutor['imagem'] ?? ''));

                $fotoLocutorUrl = 'https://placehold.co/360x540';
                if (!empty($fotoLocutor)) {
                  $fotoLocutorPath = 'ipanel/uploads/locutor/' . $locutor['id'] . '/' . $fotoLocutor;
                  if (is_file($fotoLocutorPath)) {
                    $fotoLocutorUrl = 'ipanel/uploads/locutor/' . $locutor['id'] . '/' . rawurlencode($fotoLocutor);
                  }
                }
                ?>
                <div>
                  <div class="slick-slider-inner locutor-slider-inner">
                    <figure>
                      <img src="<?php echo htmlspecialchars($fotoLocutorUrl, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo $nomeLocutor; ?>" class="img-responsive">
                    </figure>
                    <div class="caption">
                      <?php if (!empty($profissaoLocutor)): ?>
                        <div class="txt1 locutor-profissao"><?php echo $profissaoLocutor; ?></div>
                      <?php endif; ?>
                      <div class="txt2 locutor-nome"><?php echo $nomeLocutor; ?></div>
                    </div>
                    <div class="slick-slider-overlay"></div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php else: ?>
          <div class="row">
            <div class="col-sm-12">
              <p class="text-center">Nossos locutores serão divulgados em breve.</p>
            </div>
          </div>
        <?php endif; ?>


      </div>
    </div>

    <div id="contacts">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-sm-push-6 animated" data-animation="fadeInUp" data-animation-delay="200">
            <img src="images/dancer.png" alt="" class="img-responsive dancer">
          </div>
          <div class="col-sm-6 col-sm-pull-6 animated">
            <div class="title2 mb-3">CONTATOS</div>
            <div class="title1">Entre em contato conosco</div>

            <br>

            <p>
              Aqui você encontra o espaço ideal para participar da nossa programação!
              Peça a sua música favorita, envie perguntas, recados especiais, mensagens de aniversário, elogios ou sugestões para nossa equipe.
              Sua voz também faz parte do nosso som! Participe e interaja ao vivo com a rádio Vizinhança, deixando o seu momento registrado no ar.
            </p>

            <!-- Redes Sociais -->
            <div class="social_wrapper">
              <ul class="social clearfix">
                <li class="nav1"><a href="https://api.whatsapp.com/send/?phone=554635366656&text&type=phone_number&app_absent=0"><i class="fa fa-whatsapp"></i></a></li>
                <li class="nav2"><a href="https://www.facebook.com/vizifm/"><i class="fa fa-facebook"></i></a></li>
                <li class="nav3"><a href="https://www.instagram.com/vizifm/"><i class="fa fa-instagram"></i></a></li>
                <li class="nav4"><a href="https://open.spotify.com/user/xlinck9w7xx0v5buy267twlpl?si=JR25t46WS7iX3yamCDQj0Q&nd=1&dlsi=65d8d0370ec04b71"><i class="fa fa-spotify"></i></a></li>
              </ul>
            </div>
            <div id="note"></div>
            <div id="fields">
              <form id="ajax-contact-form" class="form-horizontal" action="javascript:alert('success!');">

                <div class="form-group">
                  <label for="inputName">Seu Nome</label>
                  <input type="text" class="form-control" id="inputName" name="name" value="Nome Completo"
                    onBlur="if(this.value=='') this.value='Nome Completo'"
                    onFocus="if(this.value =='Nome Completo' ) this.value=''">
                </div>

                <!-- Cidade -->
                <div class="form-group">
                  <label for="inputCidade">Cidade</label>
                  <input type="text" class="form-control" id="inputCidade" name="cidade"
                    value="Cidade" onBlur="if(this.value=='') this.value='Cidade'"
                    onFocus="if(this.value =='Cidade' ) this.value=''">
                </div>

                <!-- Música -->
                <div class="form-group">
                  <label for="inputMusica">Música</label>
                  <input type="text" class="form-control" id="inputMusica" name="musica"
                    value="Musica" onBlur="if(this.value=='') this.value='Musica'"
                    onFocus="if(this.value =='Musica' ) this.value=''">
                </div>


                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="inputMessage">Sua mensagem</label>
                      <textarea class="form-control" rows="5" id="inputMessage" name="content"
                        onBlur="if(this.value=='') this.value='Mensagem'"
                        onFocus="if(this.value =='Mensagem' ) this.value=''">Mensagem</textarea>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn-default btn-cf-submit">Enviar</button>
              </form>
            </div>


          </div>
        </div>
      </div>
    </div>

    <div class="bot1_wrapper">
      <div class="container">
        <div class="row">
          <div class="col-sm-4">

            <div class="logo2_wrapper">
              <a href="/" class="logo">
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

  <script>
    var playing = false;

    function onload() {
      var vid = document.getElementById("bg-music");
      if (vid) {
        vid.volume = 1;
        $('#load').hide();
        $('body').click(function() {
          radioPlay();
        });

        function radioPlay() {
          if (!playing) {
            $('#play-pause-radio').click();
            playing = true;
          }
        }
      }
    }
  </script>
</body>

</html>