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

        // Carregar Artista do Momento
        $artistaMomentoCtrl = new GenericCtrl("artistaMomento");
        $artistaMomento = $artistaMomentoCtrl->getObjects('', '', true, 1, 0, 'id DESC');
        $artista = !empty($artistaMomento) ? $artistaMomento[0] : null;
        ?>

        <?php include 'components/mod_header.php' ?>


        <div id="collection">
            <div class="container">

                <div class="title2 animated" data-animation="fadeInUp" data-animation-delay="200">ARTISTA DO MOMENTO
                </div>

                <div class="title3 animated" data-animation="fadeInUp" data-animation-delay="300">O talento que está dominando as paradas e conquistando o público com autenticidade, presença e criatividade.<br> A nova referência da música atual — conectado com o que o público sente e transformando emoção em ritmo.
                </div>

                <br><br>

                <?php if ($artista): ?>
                <div class="row">
                    <div class="col-sm-9 animated">
                        <?php if (!empty($artista->imagem)): ?>
                            <?php 
                            $imagemPath = 'ipanel/uploads/artistaMomento/' . $artista->id . '/' . rawurlencode($artista->imagem);
                            if (file_exists($imagemPath)) {
                                $imagemUrl = $imagemPath . '?time=' . time();
                            } else {
                                $imagemUrl = 'images/best0.png';
                            }
                            ?>
                            <img src="<?php echo htmlspecialchars($imagemUrl, ENT_QUOTES, 'UTF-8'); ?>" 
                                 alt="<?php echo htmlspecialchars($artista->nomeArtista ?? 'Artista do Momento', ENT_QUOTES, 'UTF-8'); ?>" 
                                 class="img-responsive">
                        <?php else: ?>
                            <img src="images/best0.png" alt="" class="img-responsive">
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-3 animated">

                        <div class="best0">
                            <div class="txt1"><?php echo htmlspecialchars($artista->musicaPrincipal ?? '', ENT_QUOTES, 'UTF-8'); ?></div>
                            <div class="txt2"><?php echo htmlspecialchars($artista->nomeArtista ?? '', ENT_QUOTES, 'UTF-8'); ?></div>
                            <div class="kand2" style="z-index:1 !important;"></div>
                            <div class="best_list">
                                <?php if (!empty($artista->musicaPrincipal)): ?>
                                <div class="clearfix">
                                    <div class="left"><span>1</span>. <?php echo htmlspecialchars($artista->musicaPrincipal, ENT_QUOTES, 'UTF-8'); ?></div>
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($artista->musica2)): ?>
                                <div class="clearfix">
                                    <div class="left"><span>2</span>. <?php echo htmlspecialchars($artista->musica2, ENT_QUOTES, 'UTF-8'); ?></div>
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($artista->musica3)): ?>
                                <div class="clearfix">
                                    <div class="left"><span>3</span>. <?php echo htmlspecialchars($artista->musica3, ENT_QUOTES, 'UTF-8'); ?></div>
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($artista->musica4)): ?>
                                <div class="clearfix">
                                    <div class="left"><span>4</span>. <?php echo htmlspecialchars($artista->musica4, ENT_QUOTES, 'UTF-8'); ?></div>
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($artista->musica5)): ?>
                                <div class="clearfix">
                                    <div class="left"><span>5</span>. <?php echo htmlspecialchars($artista->musica5, ENT_QUOTES, 'UTF-8'); ?></div>
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($artista->musica6)): ?>
                                <div class="clearfix">
                                    <div class="left"><span>6</span>. <?php echo htmlspecialchars($artista->musica6, ENT_QUOTES, 'UTF-8'); ?></div>
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($artista->musica7)): ?>
                                <div class="clearfix">
                                    <div class="left"><span>7</span>. <?php echo htmlspecialchars($artista->musica7, ENT_QUOTES, 'UTF-8'); ?></div>
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($artista->musica8)): ?>
                                <div class="clearfix">
                                    <div class="left"><span>8</span>. <?php echo htmlspecialchars($artista->musica8, ENT_QUOTES, 'UTF-8'); ?></div>
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($artista->musica9)): ?>
                                <div class="clearfix">
                                    <div class="left"><span>9</span>. <?php echo htmlspecialchars($artista->musica9, ENT_QUOTES, 'UTF-8'); ?></div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <div class="row">
                    <div class="col-sm-12 animated">
                        <p style="text-align: center; color: #ccc; padding: 50px 0;">Nenhum artista do momento cadastrado ainda.</p>
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