<!DOCTYPE html>
<html lang="pt-br">
<?php 
// Tratamento de erros para debug
error_reporting(E_ALL);
ini_set('display_errors', 0); // Não mostrar erros na produção, mas logar

try {
    require_once "load_ipanel.php";
    $promocaoCtrl = new GenericCtrl("Promocao");

    // Pegar ID da URL (pode vir de GET ou da URL amigável)
    $promocaoId = isset($_GET['id']) ? intval($_GET['id']) : null;

    // Se não veio pelo GET, tentar pegar da URL
    if (!$promocaoId) {
        $requestUri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
        // Remove query string se houver
        $requestUri = strtok($requestUri, '?');
        if (preg_match('/promocao[\/]?(\d+)/', $requestUri, $matches)) {
            $promocaoId = intval($matches[1]);
        }
    }

    if (!$promocaoId || $promocaoId <= 0) {
        $homeUrl = defined('BASE_URL') ? rtrim(BASE_URL, '/') : '/vizifmnovo.com.br';
        header('Location: ' . $homeUrl . '/');
        exit;
    }

    $promocao = $promocaoCtrl->getObject($promocaoId);

    if (!$promocao) {
        $homeUrl = defined('BASE_URL') ? rtrim(BASE_URL, '/') : '/vizifmnovo.com.br';
        header('Location: ' . $homeUrl . '/');
        exit;
    }

    function formatRegulamento($content) {
        if (empty($content)) {
            return '';
        }

        $hasTextarea = stripos($content, '<textarea') !== false;

        if ($hasTextarea) {
            $content = preg_replace('#<textarea[^>]*>#i', '', $content);
            $content = preg_replace('#</textarea>#i', '', $content);
            $content = trim($content);
            $content = nl2br($content);
        }

        return $content;
    }
} catch (Exception $e) {
    error_log("Erro em promocao.php: " . $e->getMessage());
    $homeUrl = defined('BASE_URL') ? rtrim(BASE_URL, '/') : '/vizifmnovo.com.br';
    header('Location: ' . $homeUrl . '/');
    exit;
}
?>
<head>
    <?php require_once "load_ipanel.php"; ?>
    <title>VIZI FM - <?php echo htmlspecialchars($promocao['titulo']); ?></title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="<?php echo htmlspecialchars($promocao['premio']); ?>">
    <meta name="keywords" content="Your keywords" />
    <meta name="author" content="Your name" />
    <meta property="og:title" content="VIZI FM - <?php echo htmlspecialchars($promocao['titulo']); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($promocao['premio']); ?>">
    <?php if (!empty($promocao->imagem)): ?>
    <meta property="og:image" content="<?php echo $promocaoCtrl->showImage($promocao, 'Capa'); ?>">
    <?php endif; ?>

    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/font-awesome.css" rel="stylesheet" />
    <link href="css/camera.css" rel="stylesheet" />
    <link href="css/mediaelementplayer.css" rel="stylesheet" />
    <link href="css/slick.css" rel="stylesheet" />
    <link href="css/slick-theme.css" rel="stylesheet" />
    <link href="css/animate.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />

    <style>
        .locutor {
            position: absolute;
            left: 20%;
            bottom: 0;
        }

        .locutorDir {
            position: absolute;
            right: 0;
            bottom: -60% !important;
        }

        .locutor img,
        .locutorDir img {
            height: 90vh;
            object-fit: contain;
        }
    </style>
    <?php require_once './ipanel/app/core/config.php'; ?>
</head>

<body class="onepage front" data-spy="scroll" data-target="#top1" data-offset="92" onload="onload()">

  <div id="load"></div>

  <audio id="bg-music">
    <source src="https://ice.fabricahost.com.br/vizifmpr" type="audio/mpeg">
  </audio>

  <div id="main">
    <?php include 'components/mod_header.php' ?>

    <div id="content">
      <div class="container">
        <div class="title2 animated" data-animation="fadeInUp" data-animation-delay="100" style="margin-top: 50px;">
          <?php echo htmlspecialchars($promocao['titulo']); ?>
        </div>
        
        <?php if (!empty($promocao->imagem)): ?>
        <div class="animated" data-animation="fadeInUp" data-animation-delay="200" style="margin: 30px 0; text-align: center;">
          <img src="<?php echo $promocaoCtrl->showImage($promocao, 'Capa'); ?>?time=<?php echo time(); ?>" 
               alt="<?php echo htmlspecialchars($promocao['titulo']); ?>" 
               class="img-responsive" 
               style="max-width: 100%; height: auto; display: inline-block;">
        </div>
        <?php endif; ?>

        <?php if ($promocao['cadastro'] == 'S'): ?>
        <div class="title3 animated" data-animation="fadeInUp" data-animation-delay="300" style="margin-bottom: 30px; text-align: left; font-size: 18px;">
          <strong>Participe e concorra a: </strong><?php echo htmlspecialchars($promocao['premio']); ?>
        </div>

        <?php if (!empty($promocao['regulamento'])): ?>
        <div class="animated" data-animation="fadeInUp" data-animation-delay="400" style="margin-bottom: 50px;">
          <div class="regulamento">
            <?php echo formatRegulamento($promocao['regulamento']); ?>
          </div>
        </div>
        <?php endif; ?>
        <div class="animated" data-animation="fadeInUp" data-animation-delay="500" style="margin-top: 50px;">
          <div class="title3" style="margin-bottom: 30px; font-size: 22px;">
            <strong>CADASTRE-SE</strong>
          </div>
          <div id="promocao-form-container">
            <form id="promocao-form-page" class="promocao-form">
              <input type="hidden" id="promocao-id-page" name="promocaoId" value="<?php echo $promocao['id']; ?>">
              
              <div class="form-group">
                <label for="nome-page">Nome Completo *</label>
                <input type="text" class="form-control" id="nome-page" name="nome" required>
              </div>

              <div class="form-group" id="nascimento-group-page" style="<?php echo ($promocao['dtNascimento'] == 'S') ? '' : 'display: none;'; ?>">
                <label for="nascimento-page">Data de Nascimento *</label>
                <input type="text" class="form-control" id="nascimento-page" name="nascimento" placeholder="DD/MM/AAAA" <?php echo ($promocao['dtNascimento'] == 'S') ? 'required' : ''; ?>>
              </div>

              <div class="form-group">
                <label for="telefone-page">Telefone *</label>
                <input type="text" class="form-control" id="telefone-page" name="telefone" placeholder="(00) 00000-0000" required>
              </div>

              <div class="form-group" id="email-group-page" style="<?php echo ($promocao['email'] == 'S') ? '' : 'display: none;'; ?>">
                <label for="email-page">E-mail *</label>
                <input type="email" class="form-control" id="email-page" name="email" <?php echo ($promocao['email'] == 'S') ? 'required' : ''; ?>>
              </div>

              <div class="form-group" id="cpf-group-page" style="<?php echo ($promocao['cpf'] == 'S') ? '' : 'display: none;'; ?>">
                <label for="cpf-page">CPF *</label>
                <input type="text" class="form-control" id="cpf-page" name="cpf" placeholder="000.000.000-00" <?php echo ($promocao['cpf'] == 'S') ? 'required' : ''; ?>>
              </div>

              <div class="form-group">
                <label for="cidade-page">Cidade *</label>
                <input type="text" class="form-control" id="cidade-page" name="cidade" required>
              </div>

              <div class="form-group" id="bairro-group-page">
                <label for="bairro-page">Bairro</label>
                <input type="text" class="form-control" id="bairro-page" name="bairro">
              </div>

              <div class="form-group" id="endereco-group-page" style="<?php echo ($promocao['endereco'] == 'S') ? '' : 'display: none;'; ?>">
                <label for="endereco-page">Endereço *</label>
                <input type="text" class="form-control" id="endereco-page" name="endereco" <?php echo ($promocao['endereco'] == 'S') ? 'required' : ''; ?>>
              </div>

              <div class="form-group" id="facebook-group-page" style="<?php echo ($promocao['facebook'] == 'S') ? '' : 'display: none;'; ?>">
                <label for="facebook-page">Facebook *</label>
                <input type="text" class="form-control" id="facebook-page" name="facebook" <?php echo ($promocao['facebook'] == 'S') ? 'required' : ''; ?>>
              </div>

              <div class="form-group" id="instagram-group-page" style="<?php echo ($promocao['instagram'] == 'S') ? '' : 'display: none;'; ?>">
                <label for="instagram-page">Instagram *</label>
                <input type="text" class="form-control" id="instagram-page" name="instagram" <?php echo ($promocao['instagram'] == 'S') ? 'required' : ''; ?>>
              </div>

              <div class="form-group" id="pix-group-page" style="<?php echo ($promocao['pix'] == 'S') ? '' : 'display: none;'; ?>">
                <label for="pix-page">Chave PIX *</label>
                <input type="text" class="form-control" id="pix-page" name="pix" <?php echo ($promocao['pix'] == 'S') ? 'required' : ''; ?>>
              </div>

              <div class="form-group" id="mensagem-group-page">
                <label for="mensagem-page">Mensagem</label>
                <textarea class="form-control" id="mensagem-page" name="mensagem" rows="3"></textarea>
              </div>

              <!-- Perguntas dinâmicas -->
              <div id="perguntas-container-page"></div>

              <!-- Pergunta de seleção -->
              <div class="form-group" id="pergunta-select-group-page" style="<?php echo (!empty($promocao['pergunta_select'])) ? '' : 'display: none;'; ?>">
                <label id="pergunta-select-label-page"><?php echo htmlspecialchars($promocao['pergunta_select'] ?? ''); ?> *</label>
                <select class="form-control" id="resposta-select-page" name="resposta_select" <?php echo (!empty($promocao['pergunta_select'])) ? 'required' : ''; ?>>
                  <option value="">Selecione uma opção</option>
                  <?php if (!empty($promocao['resposta_select'])): 
                    $opcoes = explode(';', $promocao['resposta_select']);
                    foreach ($opcoes as $opcao): 
                      $opcao = trim($opcao);
                      if ($opcao): ?>
                        <option value="<?php echo htmlspecialchars($opcao); ?>"><?php echo htmlspecialchars($opcao); ?></option>
                      <?php endif;
                    endforeach;
                  endif; ?>
                </select>
              </div>

              <div class="form-group" id="termos-group-page" style="<?php echo (!empty($promocao['termos'])) ? '' : 'display: none;'; ?>">
                <div class="termos-content-page" style="background: #252525; padding: 15px; border: 1px solid #404040; max-height: 200px; overflow-y: auto; margin-bottom: 15px; color: #ccc; font-size: 13px; line-height: 1.6;">
                  <?php echo $promocao['termos'] ?? ''; ?>
                </div>
                <label class="checkbox-label">
                  <input type="checkbox" id="aceito-termos-page" name="aceito_termos" <?php echo (!empty($promocao['termos'])) ? 'required' : ''; ?>>
                  <span>Li e aceito os termos e condições *</span>
                </label>
              </div>

              <div id="form-message-page" class="form-message" style="display: none;"></div>

              <div class="form-actions">
                <button type="submit" class="btn-default btn1" style="font-size: 14px; padding: 12px 30px;">ENVIAR INSCRIÇÃO</button>
              </div>
            </form>
          </div>
        </div>
        <?php else: ?>
        <div class="title3 animated" data-animation="fadeInUp" data-animation-delay="300" style="margin-bottom: 50px; text-align: left; font-size: 18px;">
          <strong>Participe e concorra a: </strong><?php echo htmlspecialchars($promocao['premio']); ?>
        </div>

        <?php if (!empty($promocao['regulamento'])): ?>
        <div class="animated" data-animation="fadeInUp" data-animation-delay="400" style="margin-bottom: 50px;">
          <div class="regulamento">
            <?php echo formatRegulamento($promocao['regulamento']); ?>
          </div>
        </div>
        <?php endif; ?>
          
        <div class="animated" data-animation="fadeInUp" data-animation-delay="500" style="margin-top: 50px; padding: 30px; background: #1b1b1b; border-left: 3px solid #c80913;">
          <h5 style="color: #fff; margin-bottom: 20px;"><strong>POLÍTICA DE PRIVACIDADE</strong></h5>
          <p style="color: #ccc; line-height: 1.8; text-align: justify;">
            A ViziFM se compromete a coletar, tratar e proteger os dados pessoais, informados na plataforma, de acordo com as bases legais previstas nas hipóteses dos Arts. 7 e/ou 11 da Lei 13.709/2018 (Lei Geral de Proteção de Dados Pessoais - LGPD).
          </p>
          <p style="color: #ccc; line-height: 1.8; text-align: justify; margin-top: 15px;">
            O documento detalhado sobre a política de privacidade no acesso ao website <a href="https://vizifmnovo.com.br" style="font-weight: bold; color: #c80913;">www.vizifmnovo.com.br</a> pode ser consultado em <a href="https://vizifmnovo.com.br/privacidade" target="_blank" style="font-weight: bold; color: #c80913;">www.vizifmnovo.com.br/privacidade</a>.
          </p>
        </div>

        <?php if (!empty($promocao['link'])): ?>
        <div class="animated" data-animation="fadeInUp" data-animation-delay="600" style="margin-top: 50px; text-align: center;">
          <a href="<?php echo htmlspecialchars($promocao['link']); ?>" target="_blank" class="btn-default btn1" style="font-size: 14px; padding: 12px 30px;">
            CLIQUE PARA ACESSAR
          </a>
        </div>
        <?php endif; ?>
        <?php endif; ?>
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

    // Configurar perguntas dinâmicas na página
    <?php if ($promocao['cadastro'] == 'S'): ?>
    $(document).ready(function() {
      var promocaoData = <?php echo json_encode($promocao); ?>;
      var perguntasHtml = '';
      
      for (var i = 1; i <= 15; i++) {
        var pergunta = promocaoData['pergunta_' + i];
        if (pergunta && pergunta.trim() !== '') {
          perguntasHtml += '<div class="form-group pergunta-group">';
          perguntasHtml += '<label for="pergunta_' + i + '_page">' + pergunta + ' *</label>';
          perguntasHtml += '<div class="pergunta-options">';
          perguntasHtml += '<label class="radio-label"><input type="radio" name="pergunta_rd_' + i + '" value="Sim" required> Sim</label>';
          perguntasHtml += '<label class="radio-label"><input type="radio" name="pergunta_rd_' + i + '" value="Não" required> Não</label>';
          perguntasHtml += '</div>';
          perguntasHtml += '<input type="hidden" name="pergunta_' + i + '" value="' + pergunta + '">';
          perguntasHtml += '</div>';
        }
      }
      $('#perguntas-container-page').html(perguntasHtml);

      // Máscaras para campos do formulário na página
      $('#telefone-page').on('input', function() {
        var value = $(this).val().replace(/\D/g, '');
        if (value.length <= 10) {
          value = value.replace(/^(\d{2})(\d{4})(\d{0,4}).*/, '($1) $2-$3');
        } else {
          value = value.replace(/^(\d{2})(\d{5})(\d{0,4}).*/, '($1) $2-$3');
        }
        $(this).val(value);
      });
      
      $('#cpf-page').on('input', function() {
        var value = $(this).val().replace(/\D/g, '');
        value = value.replace(/^(\d{3})(\d{3})(\d{3})(\d{0,2}).*/, '$1.$2.$3-$4');
        $(this).val(value);
      });
      
      $('#nascimento-page').on('input', function() {
        var value = $(this).val().replace(/\D/g, '');
        value = value.replace(/^(\d{2})(\d{2})(\d{0,4}).*/, '$1/$2/$3');
        $(this).val(value);
      });

      // Enviar formulário da página
      $('#promocao-form-page').on('submit', function(e) {
        e.preventDefault();
        
        var formData = $(this).serialize();
        var submitBtn = $(this).find('button[type="submit"]');
        var originalText = submitBtn.text();
        
        submitBtn.prop('disabled', true).text('ENVIANDO...');
        $('#form-message-page').hide().removeClass('success error');
        
        $.ajax({
          url: 'salva_inscricao.php',
          type: 'POST',
          data: formData + '&action=promo',
          dataType: 'text',
          success: function(response) {
            response = response.trim();
            if (response === 'SEND') {
              $('#form-message-page').removeClass('error').addClass('success').html('Inscrição realizada com sucesso!').fadeIn();
              $('#promocao-form-page')[0].reset();
            } else if (response === 'DUPLICATE') {
              $('#form-message-page').removeClass('success').addClass('error').html('Você já está inscrito nesta promoção!').fadeIn();
            } else if (response === 'SEMANA') {
              $('#form-message-page').removeClass('success').addClass('error').html('Esta promoção é apenas para aniversariantes da semana!').fadeIn();
            } else {
              $('#form-message-page').removeClass('success').addClass('error').html('Erro ao realizar inscrição. Tente novamente.').fadeIn();
            }
            submitBtn.prop('disabled', false).text(originalText);
          },
          error: function() {
            $('#form-message-page').removeClass('success').addClass('error').html('Erro ao enviar formulário. Tente novamente.').fadeIn();
            submitBtn.prop('disabled', false).text(originalText);
          }
        });
      });
    });
    <?php endif; ?>
  </script>
</body>
</html>

