<?php
$promocaoCtrl = new GenericCtrl("Promocao");
$promocoes = $promocaoCtrl->getObjectByField("status", "S", true, 6, 0, "id DESC");
?>

<div id="featured">
  <div class="container">
    <div class="title2 animated" data-animation="fadeInUp" data-animation-delay="300">
      PROMOÇÕES
    </div>
    <div class="kand1 animated" data-animation="fadeInUp" data-animation-delay="200"></div>
  </div>

  <?php if (count($promocoes) > 0): ?>
    <div class="slick-slider-wrapper promocoes-slider-wrapper">
      <div class="container">
        <div class="slick-slider slider center promocoes-slider">
          <?php foreach ($promocoes as $promocao): ?>
            <div>
              <div class="slick-slider-inner">
                <figure>
                  <img
                    src="<?php echo $promocaoCtrl->showImage($promocao, 'Capa'); ?>?time=<?php echo time(); ?>"
                    alt="<?php echo htmlspecialchars($promocao['titulo']); ?>"
                    class="img-responsive"
                    style="height: 360px; object-fit: cover;">
                </figure>

                <div class="caption">
                  <div class="txt1">
                    <span>Participe e concorra a: </span>
                  </div>
                  <div class="txt2">
                    <span class="text-participe"><?php echo $promocao['premio']; ?></span>
                  </div>
                  <div class="txt3">
                    <?php if ($promocao['cadastro'] == 'S'): ?>
                      <a href="promocao/<?php echo $promocao['id']; ?>" class="btn-default btn1">
                        PARTICIPAR
                      </a>
                    <?php elseif (strlen($promocao['regulamento']) > 10): ?>
                      <a href="promocao/<?php echo $promocao['id']; ?>" class="btn-default btn1">
                        CONFIRA
                      </a>
                    <?php elseif (!empty($promocao['link'])): ?>
                      <a href="<?php echo $promocao['link']; ?>" target="_blank" class="btn-default btn1">
                        CONFIRA
                      </a>
                    <?php endif; ?>
                  </div>
                </div>

                <div class="slick-slider-overlay"></div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <?php if (count($promocoes) > 6): ?>
      <div class="container">
        <div class="text-center" style="margin-top: 40px;">
          <a href="promocoes" class="btn-default btn1">
            <i class="fa fa-plus"></i> VER MAIS PROMOÇÕES
          </a>
        </div>
      </div>
    <?php endif; ?>
  <?php else: ?>
    <div class="container">
      <div class="title3 text-center" data-animation="fadeInUp" data-animation-delay="200">
        Nenhuma promoção ativa no momento. Fique ligado na programação!
      </div>
    </div>


  <?php endif; ?>
</div>

<!-- Modal de Inscrição em Promoção -->
<div id="promocao-modal" class="promocao-modal-overlay" style="display: none;">
  <div class="promocao-modal-container">
    <div class="promocao-modal-header">
      <h2 class="promocao-modal-title">INSCREVA-SE NA PROMOÇÃO</h2>
      <button type="button" class="promocao-modal-close" onclick="closePromocaoModal()">&times;</button>
    </div>
    <div class="promocao-modal-body">
      <form id="promocao-form" class="promocao-form">
        <input type="hidden" id="promocao-id" name="promocaoId" value="">
        
        <div class="form-group">
          <label for="nome">Nome Completo *</label>
          <input type="text" class="form-control" id="nome" name="nome" required>
        </div>

        <div class="form-group" id="nascimento-group" style="display: none;">
          <label for="nascimento">Data de Nascimento *</label>
          <input type="text" class="form-control" id="nascimento" name="nascimento" placeholder="DD/MM/AAAA" required>
        </div>

        <div class="form-group">
          <label for="telefone">Telefone *</label>
          <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(00) 00000-0000" required>
        </div>

        <div class="form-group" id="email-group" style="display: none;">
          <label for="email">E-mail *</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="form-group" id="cpf-group" style="display: none;">
          <label for="cpf">CPF *</label>
          <input type="text" class="form-control" id="cpf" name="cpf" placeholder="000.000.000-00" required>
        </div>

        <div class="form-group">
          <label for="cidade">Cidade *</label>
          <input type="text" class="form-control" id="cidade" name="cidade" required>
        </div>

        <div class="form-group" id="bairro-group" style="display: none;">
          <label for="bairro">Bairro</label>
          <input type="text" class="form-control" id="bairro" name="bairro">
        </div>

        <div class="form-group" id="endereco-group" style="display: none;">
          <label for="endereco">Endereço *</label>
          <input type="text" class="form-control" id="endereco" name="endereco" required>
        </div>

        <div class="form-group" id="facebook-group" style="display: none;">
          <label for="facebook">Facebook *</label>
          <input type="text" class="form-control" id="facebook" name="facebook" required>
        </div>

        <div class="form-group" id="instagram-group" style="display: none;">
          <label for="instagram">Instagram *</label>
          <input type="text" class="form-control" id="instagram" name="instagram" required>
        </div>

        <div class="form-group" id="pix-group" style="display: none;">
          <label for="pix">Chave PIX *</label>
          <input type="text" class="form-control" id="pix" name="pix" required>
        </div>

        <div class="form-group" id="mensagem-group" style="display: none;">
          <label for="mensagem">Mensagem</label>
          <textarea class="form-control" id="mensagem" name="mensagem" rows="3"></textarea>
        </div>

        <!-- Perguntas dinâmicas -->
        <div id="perguntas-container"></div>

        <!-- Pergunta de seleção -->
        <div class="form-group" id="pergunta-select-group" style="display: none;">
          <label id="pergunta-select-label"></label>
          <select class="form-control" id="resposta-select" name="resposta_select" required>
            <option value="">Selecione uma opção</option>
          </select>
        </div>

        <div class="form-group" id="termos-group" style="display: none;">
          <div class="termos-content"></div>
          <label class="checkbox-label">
            <input type="checkbox" id="aceito-termos" name="aceito_termos" required>
            <span>Li e aceito os termos e condições *</span>
          </label>
        </div>

        <div id="form-message" class="form-message" style="display: none;"></div>

        <div class="form-actions">
          <button type="submit" class="btn-default btn1">ENVIAR INSCRIÇÃO</button>
          <button type="button" class="btn-default btn2" onclick="closePromocaoModal()">CANCELAR</button>
        </div>
      </form>
    </div>
  </div>
</div>