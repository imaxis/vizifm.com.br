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
        <div class="breadcrumbs1"><a href="/">Home</a><span>/</span>Sobre Nós</div>
      </div>
    </div>

    <div id="content">
      <div class="container">

        <h3 class="animated" data-animation="fadeInUp" data-animation-delay="100">SOBRE NÓS</h3>

        <div class="thumb6 animated" data-animation="fadeInLeft" data-animation-delay="200">
          <div class="thumbnail clearfix">
            <figure class="">
              <img src="images/about1.png" alt="" class="img-responsive">
            </figure>
            <div class="caption">
              <div class="title">O Histórico da Vizi FM 104.1: Inovação e Conexão em Dois Vizinhos</div>
              <p>
                Depois de anos de trabalho dos fundadores Valdir Luiz Pagnoncelli e Marilda Orben, a Vizinhança FM iniciou suas transmissões experimentais em 18 de novembro de 1991, na frequência 91,3 FM, com 250 watts. Em 28 de novembro de 1991, data em que Dois Vizinhos completou 30 anos, a emissora entrou no ar em caráter definitivo, tornando-se a primeira FM da cidade. Ao longo dos anos, os ouvintes passaram a adotar carinhosamente a abreviatura de Vizi FM para se referir a emissora.
              </p>
            </div>
          </div>
        </div>

        <div class="thumb6 right animated" data-animation="fadeInRight" data-animation-delay="200">
          <div class="thumbnail clearfix">
            <figure class="">
              <img src="https://via.placeholder.com/570x303" alt="" class="img-responsive">
            </figure>
            <div class="caption">
              <div class="title">A Jornada da Inovação Tecnológica</div>
              <p>
                A história da Vizi FM é marcada pela constante busca por inovação, transitando de forma pioneira entre o analógico e o digital.
              </p>
              <p>
                <strong>Transição de Mídias (1993-1994):</strong> Um dos primeiros grandes investimentos em modernização foi a substituição dos discos de vinil pelo Compact Disc (CD). Os irmãos Giovani (atual diretor) e Giuliano (in memoriam) foram encarregados de construir a nova "CDteca", garantindo maior agilidade na reprodução musical e uma fidelidade sonora nítida para os ouvintes.
              </p>
              <p>
                <strong>A Era Digital no Estúdio (Anos 2000):</strong> Com a chegada de profissionais como Marcos Rogério Scalabrin, a rádio abraçou a revolução digital. A Vizi FM foi uma das primeiras emissoras a informatizar sua operação, trocando equipamentos analógicos como cartucheiras por sistemas informatizados.
              </p>
              <p>
                <strong>Sucessão na Direção:</strong> Dando continuidade a esse legado de modernização e crescimento, Giovani Pagnoncelli assumiu a direção da Vizi FM em 2005 e permanece no cargo até hoje, assegurando o foco da emissora na evolução tecnológica e no alcance regional.
              </p>
            </div>
          </div>
        </div>

        <div class="thumb6 animated" data-animation="fadeInLeft" data-animation-delay="200">
          <div class="thumbnail clearfix">
            <figure class="">
              <img src="https://via.placeholder.com/570x303" alt="" class="img-responsive">
            </figure>
            <div class="caption">
              <div class="title">Liderança e Expansão de Audiência</div>
              <p>
                A Vizi FM demonstrou ser uma líder ao expandir seu alcance muito além do sinal terrestre:
              </p>
              <p>
                <strong>Pioneirismo na Web (Ano 2000):</strong> A emissora foi pioneira ao lançar seu site oficial, vizifm.com.br, que alavancou a audiência em um momento em que poucas rádios transmitiam online.
              </p>
              <p>
                <strong>Streaming e Eventos (2003):</strong> A inovação continuou com o início da transmissão online por streaming em novembro de 2003. Além disso, a Vizi FM inovou nas transmissões ao vivo direto da Expovizinhos, fortalecendo sua conexão com a comunidade.
              </p>
              <p>
                A credibilidade e o prestígio da marca são sustentados por uma equipe sólida, com comunicadores experientes — alguns com mais de 20 anos de casa, como Douglas Augusto Crescencio que atua dando aula na comunicação até os dias de hoje. Nomes como Cleiton Basso figuram como um dos grandes locutores que marcaram a história da Vizi com sua longa presença. Campanhas icônicas, como o "Vizi Verão", ainda fazem muito sucesso. O público espera ansioso todos os anos para o "Vizi Visita Sua Casa" e, atualmente, o "Concurso Você Locutor da Vizi", está ganhando o coração de nossos ouvintes e mostra que a Vizi é inovadora e está sempre à frente na interação com ouvintes e internautas.
              </p>
            </div>
          </div>
        </div>

        <div class="thumb6 right animated" data-animation="fadeInRight" data-animation-delay="200">
          <div class="thumbnail clearfix">
            <figure class="">
              <img src="https://via.placeholder.com/570x303" alt="" class="img-responsive">
            </figure>
            <div class="caption">
              <div class="title">A Rádio Conectada</div>
              <p>
                Atualmente, a Vizi FM continua investindo em tecnologia para cumprir sua missão de promover informação, música e entretenimento de qualidade. Mantendo a essência de "rádio próxima, vibrante e humana", a emissora se expandiu para o ambiente digital por meio de seu site, aplicativo exclusivo para smartphones, presença ativa em redes sociais (Instagram, Facebook, TikTok e LinkedIn) e em plataformas globais como o Rádio Garden, garantindo que seu alcance ultrapasse um milhão de ouvintes em qualquer lugar do mundo.
              </p>
              <p>
                A Vizi FM, carinhosamente conhecida como "a rádio que tem a cara do seu público e do seu tempo", segue firme em sua Visão de ser uma emissora inovadora e referência regional, unindo tradição, excelência e paixão pelo rádio.
              </p>
            </div>
          </div>
        </div>

        <div class="row" style="margin-top: 80px; margin-bottom: 60px;">
          <div class="col-sm-4 animated" data-animation="fadeInUp" data-animation-delay="100">
            <div class="mvp-card" style="text-align: center; padding: 40px 30px; background: linear-gradient(135deg, #2a2a2a 0%, #1a1a1a 100%); border-radius: 15px; height: 100%; position: relative; overflow: hidden; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5); border: 1px solid #3a3a3a; transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;">
              <div style="position: relative; z-index: 1;">
                <div style="width: 80px; height: 80px; margin: 0 auto 25px; background: #333; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 2px solid #555; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);">
                  <i class="fa fa-bullseye" style="font-size: 35px; color: #fff;"></i>
                </div>
                <div class="title2" style="margin-bottom: 20px; color: #fff; font-size: 28px; font-weight: bold; letter-spacing: 2px; text-transform: uppercase;">MISSÃO</div>
                <p style="line-height: 1.8; color: #ccc; position: relative; z-index: 1; text-align: left;">
                  Promover informação, música e entretenimento de qualidade, fortalecendo a conexão com a comunidade e valorizando a cultura local. Atuamos com responsabilidade, criatividade e proximidade, oferecendo conteúdo relevante que faça diferença no dia a dia dos nossos ouvintes.
                </p>
              </div>
            </div>
          </div>
          <div class="col-sm-4 animated" data-animation="fadeInUp" data-animation-delay="200">
            <div class="mvp-card" style="text-align: center; padding: 40px 30px; background: linear-gradient(135deg, #2a2a2a 0%, #1a1a1a 100%); border-radius: 15px; height: 100%; position: relative; overflow: hidden; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5); border: 1px solid #3a3a3a; transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;">
              <div style="position: relative; z-index: 1;">
                <div style="width: 80px; height: 80px; margin: 0 auto 25px; background: #333; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 2px solid #555; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);">
                  <i class="fa fa-eye" style="font-size: 35px; color: #fff;"></i>
                </div>
                <div class="title2" style="margin-bottom: 20px; color: #fff; font-size: 28px; font-weight: bold; letter-spacing: 2px; text-transform: uppercase;">VISÃO</div>
                <p style="line-height: 1.8; color: #ccc; position: relative; z-index: 1; text-align: left;">
                  Ser uma emissora inovadora e referência regional, reconhecida pela credibilidade, pela excelência em comunicação e pelo relacionamento com ouvintes, parceiros e anunciantes. Buscamos evoluir continuamente, acompanhando as tendências do rádio e das novas plataformas.
                </p>
              </div>
            </div>
          </div>
          <div class="col-sm-4 animated" data-animation="fadeInUp" data-animation-delay="300">
            <div class="mvp-card" style="text-align: center; padding: 40px 30px; background: linear-gradient(135deg, #2a2a2a 0%, #1a1a1a 100%); border-radius: 15px; height: 100%; position: relative; overflow: hidden; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5); border: 1px solid #3a3a3a; transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;">
              <div style="position: relative; z-index: 1;">
                <div style="width: 80px; height: 80px; margin: 0 auto 25px; background: #333; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 2px solid #555; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);">
                  <i class="fa fa-star" style="font-size: 35px; color: #fff;"></i>
                </div>
                <div class="title2" style="margin-bottom: 20px; color: #fff; font-size: 28px; font-weight: bold; letter-spacing: 2px; text-transform: uppercase;">VALORES E PRINCÍPIOS</div>
                <ul style="text-align: left; line-height: 1.9; list-style: none; padding-left: 0; color: #ccc; position: relative; z-index: 1;">
                  <li style="margin-bottom: 10px;">• Ética, respeito e transparência em todas as relações.</li>
                  <li style="margin-bottom: 10px;">• Compromisso com a verdade e com a informação responsável.</li>
                  <li style="margin-bottom: 10px;">• Inovação constante em tecnologia, conteúdo e formatos.</li>
                  <li style="margin-bottom: 10px;">Valorização da cultura e da identidade da nossa comunidade.</li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <style>
          /* Aumentar tamanho do texto em 2px, exceto títulos */
          .thumb6 .caption p {
            font-size: 14px !important;
          }

          .mvp-card p {
            font-size: 18px !important;
          }

          .mvp-card ul {
            font-size: 16px !important;
          }

          .mvp-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.7) !important;
            border-color: #555 !important;
          }

          .mvp-card:hover .fa {
            transform: scale(1.1);
            transition: transform 0.3s ease;
          }

          .mvp-card .fa {
            transition: transform 0.3s ease;
          }

          @media (max-width: 768px) {
            .mvp-card {
              margin-bottom: 30px !important;
            }
          }
        </style>


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
</body>

</html>