<?php
/**
 * Formulário personalizado para Musicas.
 * Reutiliza o layout padrão e aplica regras dinâmicas
 * para exibição/validação dos campos de acordo com o canal selecionado.
 */

include __DIR__ . '/formDefault.php';
?>
<script type="text/javascript">
(function ($) {
  function applyValidationRules($arquivoField, $urlField, isRadio, isSpotify) {
    var validator = $('#formreg').data('validator');
    if (!validator) {
      return;
    }

    if ($arquivoField.length) {
      $arquivoField.rules('remove');
      if (isRadio) {
        $arquivoField.rules('add', {
          required: true,
          accept: "mp3"
        });
      }
    }

    if ($urlField.length) {
      $urlField.rules('remove');
      if (isSpotify) {
        $urlField.rules('add', { required: true, url: true });
      }
    }
  }

  function toggleFields(runDeferred) {
    var canalValue = $('#canal').val();
    var isRadio = canalValue === 'Radio';
    var isSpotify = canalValue === 'Spotify';

    var $arquivoField = $('#arquivo');
    var $arquivoWrapper = $arquivoField.closest('.input_field');
    var $arquivoLabel = $arquivoWrapper.prev('.sptl_fieldname');

    var $urlField = $('#url');
    var $urlWrapper = $urlField.closest('.input_field');
    var $urlLabel = $urlWrapper.prev('.sptl_fieldname');

    if ($arquivoField.length) {
      $arquivoWrapper.toggle(isRadio);
      $arquivoLabel.toggle(isRadio);
      if (!isRadio) {
        try { $arquivoField.val(''); } catch (e) {}
      }
    }

    if ($urlField.length) {
      $urlWrapper.toggle(isSpotify);
      $urlLabel.toggle(isSpotify);
      if (!isSpotify) {
        $urlField.val('');
      }
    }

    applyValidationRules($arquivoField, $urlField, isRadio, isSpotify);

    if (runDeferred !== false && !$('#formreg').data('validator')) {
      window.setTimeout(function () {
        toggleFields(false);
      }, 100);
    }
  }

  $(function () {
    toggleFields();
    $('#canal').change(function () {
      toggleFields(false);
    });
  });
})(jQuery);
</script>

