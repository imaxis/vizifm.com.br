<?php
/**
 * Formulário personalizado para Mensagem do Dia.
 * Reutiliza o layout padrão garantindo que o campo de áudio
 * aceite apenas arquivos MP3 e mantenha a validação adequada.
 */

include __DIR__ . '/formDefault.php';
?>
<script type="text/javascript">
(function ($) {
  function ensureArquivoRules(runDeferred) {
    var $arquivoField = $('#arquivo');
    if (!$arquivoField.length) {
      return;
    }

    $arquivoField.attr('accept', 'audio/mpeg,.mp3');

    var validator = $('#formreg').data('validator');
    if (validator) {
      try {
        $arquivoField.rules('remove');
      } catch (e) {}
      $arquivoField.rules('add', {
        required: true,
        accept: "mp3"
      });
    } else if (runDeferred !== false) {
      window.setTimeout(function () {
        ensureArquivoRules(false);
      }, 100);
    }
  }

  $(function () {
    ensureArquivoRules();
  });
})(jQuery);
</script>

