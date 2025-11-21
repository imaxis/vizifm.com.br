<!DOCTYPE html>
<html lang="pt-br">
<?php include 'components/mod_head.php' ?>
<?php
$promocaoCtrl = new GenericCtrl("Promocao");
$promocoes = $promocaoCtrl->getObjectByField("status", "S", false, 0, 0, "id DESC");
?>
<head>
    <title>VIZI FM - Promoções</title>
    <meta name="description" content="Confira todas as promoções da VIZI FM">
</head>

<body class="onepage front" data-spy="scroll" data-target="#top1" data-offset="92" onload="onload()">

  <div id="load"></div>

  <audio id="bg-music">
    <source src="https://ice.fabricahost.com.br/vizifmpr" type="audio/mpeg">
  </audio>

  <div id="main">
    <?php include 'components/mod_header.php' ?>

    <div id="featured">
      <div class="container">
        <div class="title2 animated" data-animation="fadeInUp" data-animation-delay="300">
          PROMOÇÕES
        </div>
        <div class="kand1 animated" data-animation="fadeInUp" data-animation-delay="200"></div>
      </div>

      <?php if (count($promocoes) > 0): ?>
        <div class="container" style="margin-top: 50px;">
          <div class="row">
            <?php foreach ($promocoes as $promocao): ?>
              <div class="col-lg-4 col-md-6 col-sm-6" style="margin-bottom: 40px;">
                <div class="slick-slider-inner" style="background: #1b1b1b; border: 2px solid #c80913;">
                  <figure>
                    <img
                      src="<?php echo $promocaoCtrl->showImage($promocao, 'Capa'); ?>?time=<?php echo time(); ?>"
                      alt="<?php echo htmlspecialchars($promocao['titulo']); ?>"
                      class="img-responsive"
                      style="height: 300px; object-fit: cover; width: 100%;">
                  </figure>

                  <div class="caption" style="padding: 20px;">
                    <div class="txt1">
                      <span>Participe e concorra a: </span>
                    </div>
                    <div class="txt2">
                      <span class="text-participe"><?php echo htmlspecialchars($promocao['premio']); ?></span>
                    </div>
                    <div class="txt3" style="margin-top: 20px;">
                      <?php if ($promocao['cadastro'] == 'S'): ?>
                        <a href="promocao/<?php echo $promocao['id']; ?>" class="btn-default btn1">
                          PARTICIPAR
                        </a>
                      <?php elseif (strlen($promocao['regulamento']) > 10): ?>
                        <a href="promocao/<?php echo $promocao['id']; ?>" class="btn-default btn1">
                          CONFIRA
                        </a>
                      <?php elseif (!empty($promocao['link'])): ?>
                        <a href="<?php echo htmlspecialchars($promocao['link']); ?>" target="_blank" class="btn-default btn1">
                          CONFIRA
                        </a>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      <?php else: ?>
        <div class="container">
          <div class="title3 text-center animated" data-animation="fadeInUp" data-animation-delay="200">
            Nenhuma promoção ativa no momento. Fique ligado na programação!
          </div>
        </div>
      <?php endif; ?>
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

