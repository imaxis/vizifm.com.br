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

        // Carregar Patrocinadores
        $patrocinadoresCtrl = new GenericCtrl("Patrocinadores");
        $patrocinadores = $patrocinadoresCtrl->getObjects('', '', true, 0, 0, 'nome ASC');
        ?>

        <?php include 'components/mod_header.php' ?>


        <div class="breadcrumbs1_wrapper">
            <div class="container">
                <div class="breadcrumbs1"><a href="/">Home</a><span>/</span>Patrocinadores</div>
            </div>
        </div>

        <div id="collection2">
            <div class="container">

                <div class="title2 animated" data-animation="fadeInUp" data-animation-delay="200">PATROCINADORES</div>

                <div class="title3 animated" data-animation="fadeInUp" data-animation-delay="300">Os patrocinadores são parceiros essenciais que acreditam em nosso propósito e investem para que este projeto se torne realidade.<br> Agradecemos a confiança e o apoio contínuo, que nos permitem evoluir, inovar e entregar resultados cada vez melhores.
                </div>

                <br><br>

                <?php if (!empty($patrocinadores)): ?>
                    <?php foreach ($patrocinadores as $index => $patrocinador): ?>
                        <?php
                        $nomePatrocinador = htmlspecialchars($patrocinador->nome ?? '', ENT_QUOTES, 'UTF-8');
                        $setorPatrocinador = htmlspecialchars($patrocinador->setor ?? '', ENT_QUOTES, 'UTF-8');
                        $sobrePatrocinador = $patrocinador->sobre ?? '';
                        $localizacaoPatrocinador = htmlspecialchars($patrocinador->localizacao ?? '', ENT_QUOTES, 'UTF-8');
                        $linkPatrocinador = !empty($patrocinador->link) ? htmlspecialchars($patrocinador->link, ENT_QUOTES, 'UTF-8') : '#';
                        $animationDelay = 200 + ($index * 100);
                        
                        $imagemUrl = 'images/best0.png';
                        if (!empty($patrocinador->imagem)) {
                            $imagemUrl = $patrocinadoresCtrl->showImage($patrocinador, 'Capa') . '?time=' . time();
                        }
                        ?>
                        <div class="row" style="<?php echo $index > 0 ? 'margin-top: 50px;' : ''; ?>">
                            <div class="col-sm-4 animated" data-animation="fadeInUp" data-animation-delay="<?php echo $animationDelay; ?>">
                                <img src="<?php echo htmlspecialchars($imagemUrl, ENT_QUOTES, 'UTF-8'); ?>" 
                                     alt="<?php echo $nomePatrocinador; ?>" 
                                     class="img-responsive disk1-img">
                            </div>
                            <div class="col-sm-7 col-sm-offset-1 animated" data-animation="fadeInUp" data-animation-delay="<?php echo $animationDelay + 50; ?>">
                                <div class="disk1">
                                    <?php if (!empty($setorPatrocinador)): ?>
                                    <div class="txt1"><span>Setor</span> &nbsp;|&nbsp; <?php echo $setorPatrocinador; ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($nomePatrocinador)): ?>
                                    <div class="txt2"><?php echo $nomePatrocinador; ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($sobrePatrocinador)): ?>
                                    <div class="txt3"><?php echo $sobrePatrocinador; ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($localizacaoPatrocinador)): ?>
                                    <div class="txt4"><?php echo $localizacaoPatrocinador; ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($linkPatrocinador) && $linkPatrocinador !== '#'): ?>
                                    <div class="txt5"><a href="<?php echo $linkPatrocinador; ?>" target="_blank" class="btn-default btn2">CONHECER AGORA</a></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="row">
                        <div class="col-sm-12 animated" data-animation="fadeInUp" data-animation-delay="200">
                            <p style="text-align: center; color: #ccc; padding: 50px 0;">Nenhum patrocinador cadastrado ainda.</p>
                        </div>
                    </div>
                <?php endif; ?>

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