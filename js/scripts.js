/*----------------------------------------------------*/
/* MOBILE DETECT FUNCTION
 /*----------------------------------------------------*/
var isMobile = {
  Android: function() {
    return navigator.userAgent.match(/Android/i);
  },
  BlackBerry: function() {
    return navigator.userAgent.match(/BlackBerry/i);
  },
  iOS: function() {
    return navigator.userAgent.match(/iPhone|iPad|iPod/i);
  },
  Opera: function() {
    return navigator.userAgent.match(/Opera Mini/i);
  },
  Windows: function() {
    return navigator.userAgent.match(/IEMobile/i);
  },
  any: function() {
    return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
  }
};



/////////////////////// ready
$(document).on('ready', function() {
  "use strict";


  

  /*----------------------------------------------------*/
  // Camera slideshow
  /*----------------------------------------------------*/
  var oa = $('#camera_wrap');
  if (oa.length > 0) {
    oa.camera({
      //thumbnails: true
      alignment     : 'centerTop',
      autoAdvance     : false,
      mobileAutoAdvance : false,
      // fx          : 'scrollRight',
      height: '51%',
      hover: false,
      loader: 'none',
      navigation: false,
      navigationHover: false,
      mobileNavHover: false,
      playPause: false,
      pauseOnClick: false,
      pagination      : false,
      time: 5000,
      transPeriod: 1000,
      minHeight: '300px'
    });
  }

  // Player de rádio ao vivo - implementação igual ao viziservidor
  var bgMusicElement = document.getElementById('bg-music');
  var liveRadioPlayer = document.getElementById('live-radio-player');
  
  if (bgMusicElement) {
    bgMusicElement.volume = 0.15;
    
    $('a[data-target="bg-music-toggle"]').on("click", function () {
      if (bgMusicElement.paused) {
        bgMusicElement.play();
        $(this).addClass("playing");
      } else {
        bgMusicElement.pause();
        $(this).removeClass("playing");
      }
      return false;
    });
  }
  



  /*----------------------------------------------------*/
  // player.
  /*----------------------------------------------------*/

  MediaElementPlayer.prototype.prevbuilder = function(player, controls, layers, media){
    var prevbut = $('<div class="mejs-button mejs-previous-button mejs-cust1-button">' +
        '</div>')
      // append it to the toolbar
        .appendTo(controls)
      // add a click toggle event
        .click(function(){
          // window.open(player.options.logo.link, '_blank');
          player.options.prevFunc.apply(this);
        });
  };



  MediaElementPlayer.prototype.buildcust3 = function(player, controls, layers, media) {
    var
        cust3 =
            $('<div class="mejs-button mejs-cust3-button "><button></button></div>')
              // append it to the toolbar
                .appendTo(controls);
  };

  MediaElementPlayer.prototype.buildcust4 = function(player, controls, layers, media) {
    var
        cust4 =
            $('<div class="mejs-button mejs-cust4-button "><button></button></div>')
              // append it to the toolbar
                .appendTo(controls);
  };




  if($('body').find('.liveRadio').length !== 0) {
      $('#audio4_html5_white').audio4_html5({
          playerWidth:1200,
          skin: 'whiteControllers',
          initialVolume:0.5,
          responsive:false,
          showPlaylistOnInit:false,
          showCategories:false,
          showSearchArea:false
      });
  }



  $('.audio1 audio').not('#live-radio-player').mediaelementplayer({
    //features: ['cust1','playpause','cust2','progress','current','duration','cust3','cust4','volume']
    features: ['playlistfeature', 'prevtrack', 'playpause', 'nexttrack', 'progress', 'current', 'volume']
  });
  
  // Player de rádio ao vivo - controla o bg-music diretamente
  if ($('#live-radio-player').length && bgMusicElement) {
    var livePlayerInstance = $('#live-radio-player').mediaelementplayer({
      features: ['playpause', 'progress', 'current', 'volume'],
      success: function(mediaElement, domObject) {
        // Quando o player for inicializado, fazer ele controlar o bg-music
        var meMedia = mediaElement;
        var mePlayer = this; // MediaElementPlayer instance
        
        // Aguardar um pouco para o player estar totalmente inicializado
        setTimeout(function() {
          // Interceptar cliques no botão play/pause do MediaElementPlayer
          $(mePlayer.container).on('click', '.mejs-playpause-button button', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            if (bgMusicElement.paused) {
              bgMusicElement.play().then(function() {
                $('#play-pause-radio').addClass("playing");
                // Atualizar visual do player
                $(mePlayer.container).find('.mejs-playpause-button').removeClass('mejs-play').addClass('mejs-pause');
              }).catch(function(err) {
                console.log('Erro ao tocar:', err);
              });
            } else {
              bgMusicElement.pause();
              $('#play-pause-radio').removeClass("playing");
              // Atualizar visual do player
              $(mePlayer.container).find('.mejs-playpause-button').removeClass('mejs-pause').addClass('mejs-play');
            }
            
            // Pausar o player visual imediatamente para não tocar duas vezes
            meMedia.pause();
            
            return false;
          });
          
          // Interceptar eventos de play/pause do mediaElement
          meMedia.addEventListener('play', function(e) {
            e.preventDefault();
            meMedia.pause();
            if (bgMusicElement.paused) {
              bgMusicElement.play().then(function() {
                $('#play-pause-radio').addClass("playing");
                $(mePlayer.container).find('.mejs-playpause-button').removeClass('mejs-play').addClass('mejs-pause');
              });
            }
          });
          
          meMedia.addEventListener('pause', function(e) {
            // Não fazer nada, apenas manter sincronizado
          });
          
          // Sincronizar quando o bg-music mudar de estado (do botão do header)
          bgMusicElement.addEventListener('play', function() {
            // Atualizar visual do player para mostrar como "playing"
            $(mePlayer.container).find('.mejs-playpause-button').removeClass('mejs-play').addClass('mejs-pause');
          });
          
          bgMusicElement.addEventListener('pause', function() {
            // Atualizar visual do player para mostrar como "paused"
            $(mePlayer.container).find('.mejs-playpause-button').removeClass('mejs-pause').addClass('mejs-play');
          });
          
          // Sincronizar volume
          meMedia.addEventListener('volumechange', function() {
            if (bgMusicElement.volume !== meMedia.volume) {
              bgMusicElement.volume = meMedia.volume;
            }
          });
        }, 500);
      }
    });
  }

  $('.audio2 audio').mediaelementplayer({
    features: ['playpause','progress']
  });



  $('.mejs-prevtrack-button').addClass('mejs-cust1-button');
  $('.mejs-nexttrack-button').addClass('mejs-cust2-button');


  /*----------------------------------------------------*/
  // carouFredSel.
  /*----------------------------------------------------*/
  var ob = $('#testim').find('.carousel.main ul');
  if (ob.length > 0) {
    ob.carouFredSel({
      auto: {
        timeoutDuration: 8000
      },
      responsive: true,
      // prev: '.popular_prev',
      // next: '.popular_next',
      pagination: '.testim_pagination',
      width: '100%',
      scroll: {
        // fx : "crossfade",
        items: 1,
        duration: 1000,
        easing: "easeOutExpo"
      },
      items: {
        width: '1000',
        height: 'variable', //  optionally resize item-height
        visible: {
          min: 1,
          max: 1
        }
      },
      mousewheel: false,
      swipe: {
        onMouse: true,
        onTouch: true
      }
    });
  }

  $(window).on("resize",updateSizes_vat).on("load",updateSizes_vat);
  function updateSizes_vat(){
    $('#testim').find('.carousel.main ul').trigger("updateSizes");


  }
  updateSizes_vat();


  /*----------------------------------------------------*/
  // Sticky.
  /*----------------------------------------------------*/
  $("#top2").sticky({
    topSpacing:0,
    getWidthFrom: 'body',
    responsiveWidth: true
  });

  /*----------------------------------------------------*/
  // PRELOADER CALLING
  /*----------------------------------------------------*/
  $("body.onepage").queryLoader2({
    //barColor: "#fff",
    //backgroundColor: "#000",
    percentage: true,
    barHeight: 3,
    completeAnimation: "fade",
    minimumTime: 200
  });



  /*----------------------------------------------------*/
  // MENU SMOOTH SCROLLING
  /*----------------------------------------------------*/
  $(".navbar_ .nav a, .menu_bot a, .scroll-to").on('click',function(event){

    //$(".navbar_ .nav a a").removeClass('active');
    //$(this).addClass('active');
    // var headerH = $('#top1').outerHeight();
    var headerH = $('#top2').outerHeight();

    if ($(this).attr("href")=="#home") {
      $("html, body").animate({
        scrollTop: 0 + 'px'
        // scrollTop: $($(this).attr("href")).offset().top + 'px'
      }, {
        duration: 1200,
        easing: "easeInOutExpo"
      });
    }
    else {
      $("html, body").animate({
        scrollTop: $($(this).attr("href")).offset().top - headerH + 'px'
        // scrollTop: $($(this).attr("href")).offset().top + 'px'
      }, {
        duration: 1200,
        easing: "easeInOutExpo"
      });
    }



    event.preventDefault();
  });

  /*----------------------------------------------------*/
  // Slick
  /*----------------------------------------------------*/
  var promoSlider = $('.promocoes-slider');
  if (promoSlider.length) {
    promoSlider.slick({
      centerMode: true,
      centerPadding: '0px',
      slidesToShow: 3,
      autoplay: true,
      autoplaySpeed: 7000,
      arrows: true,
      responsive: [
        {
          breakpoint: 2700,
          settings: {
            arrows: true,
            centerMode: true,
            centerPadding: '0px',
            slidesToShow: 3
          }
        },
        {
          breakpoint: 1024,
          settings: {
            arrows: true,
            centerMode: true,
            centerPadding: '80px',
            slidesToShow: 2
          }
        },
        {
          breakpoint: 767,
          settings: {
            arrows: true,
            centerMode: true,
            centerPadding: '150px',
            slidesToShow: 1
          }
        },
        {
          breakpoint: 600,
          settings: {
            arrows: true,
            centerMode: true,
            centerPadding: '20px',
            slidesToShow: 1
          }
        }
      ]
    });
  }

  var locutorSlider = $('.locutor-slider');
  if (locutorSlider.length) {
    locutorSlider.each(function() {
      var $slider = $(this);
      var slideCount = $slider.children().length;
      var desktopShow = Math.min(slideCount >= 3 ? 3 : slideCount, 3) || 1;
      var tabletShow = slideCount >= 2 ? Math.min(2, slideCount) : 1;
      var shouldCenter = slideCount > 1;

      $slider.slick({
        slidesToShow: desktopShow,
        slidesToScroll: 1,
        infinite: slideCount > desktopShow,
        arrows: true,
        dots: false,
        centerMode: shouldCenter,
        centerPadding: '0px',
        focusOnSelect: true,
        autoplay: slideCount > 1,
        autoplaySpeed: 2000,
        pauseOnHover: true,
        pauseOnFocus: true,
        adaptiveHeight: false,
        responsive: [
          {
            breakpoint: 1200,
            settings: {
              slidesToShow: desktopShow,
              centerMode: shouldCenter
            }
          },
          {
            breakpoint: 992,
            settings: {
              slidesToShow: tabletShow,
              centerMode: tabletShow > 1,
              centerPadding: tabletShow > 1 ? '60px' : '0px'
            }
          },
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 1,
              centerMode: true,
              centerPadding: '40px',
              focusOnSelect: true
            }
          }
        ]
      });
    });
  }

  /*----------------------------------------------------*/
  // Appear
  /*----------------------------------------------------*/
  $('.animated').appear(function() {
    // console.log("111111111111");
    var elem = $(this);
    var animation = elem.data('animation');
    if ( !elem.hasClass('visible') ) {
      var animationDelay = elem.data('animation-delay');
      if ( animationDelay ) {
        setTimeout(function(){
          elem.addClass( animation + " visible" );
        }, animationDelay);
      } else {
        elem.addClass( animation + " visible" );
      }
    }
  });

  /////// jrumble
  $('.speaker-img').find("img").jrumble({
    x: 1,
    y: 1,
    rotation: 2,
    speed: 30,
    opacity: true,
    opacityMin: .05
  }).trigger('startRumble');
  
  
  function setter() {
    var winWidth = $(window).width();
    var gavy = parseInt(winWidth)+15;
    if(gavy < 992 && gavy > 767) {
        var mina = gavy/2;
        var min = mina+170;
    }
    else if (gavy < 768) {
        var min = gavy-210;
    }
    else {
        var yop = gavy/2;
        var min = yop-190;
    }


    if(gavy < 1200) {
        $('.VolumeSlider').css('width',min);
    }
    else {
        $('.VolumeSlider').css('width','468px');
    }

  }
  
  
  setTimeout(function() {
    setter();
  }, 100);
  
  $(window).resize(function() {
      setter();
  });



});

/////////////////////// load
$(window).on('load', function() {

  /*----------------------------------------------------*/
  // LOAD
  /*----------------------------------------------------*/
  //$('#load').fadeOut(2000).remove();
  $("#load").fadeOut( 200, function() {
    $(this).remove();
  });

  // Modal de Promoção
  $('.open-promo-form').on('click', function(e) {
    e.preventDefault();
    var promocaoId = $(this).data('promocao-id');
    var promocaoData = $(this).data('promocao-data');
    
    if (promocaoData && promocaoId) {
      openPromocaoModal(promocaoData);
    }
  });

  // Fechar modal ao clicar no overlay
  $('.promocao-modal-overlay').on('click', function(e) {
    if ($(e.target).hasClass('promocao-modal-overlay')) {
      closePromocaoModal();
    }
  });

  // Enviar formulário de promoção
  $('#promocao-form').on('submit', function(e) {
    e.preventDefault();
    
    var formData = $(this).serialize();
    var submitBtn = $(this).find('button[type="submit"]');
    var originalText = submitBtn.text();
    
    submitBtn.prop('disabled', true).text('ENVIANDO...');
    $('#form-message').hide().removeClass('success error');
    
    $.ajax({
      url: 'salva_inscricao.php',
      type: 'POST',
      data: formData + '&action=promo',
      dataType: 'text',
      success: function(response) {
        response = response.trim();
        if (response === 'SEND') {
          $('#form-message').removeClass('error').addClass('success').html('Inscrição realizada com sucesso!').fadeIn();
          $('#promocao-form')[0].reset();
          setTimeout(function() {
            closePromocaoModal();
          }, 2000);
        } else if (response === 'DUPLICATE') {
          $('#form-message').removeClass('success').addClass('error').html('Você já está inscrito nesta promoção!').fadeIn();
        } else if (response === 'SEMANA') {
          $('#form-message').removeClass('success').addClass('error').html('Esta promoção é apenas para aniversariantes da semana!').fadeIn();
        } else {
          $('#form-message').removeClass('success').addClass('error').html('Erro ao realizar inscrição. Tente novamente.').fadeIn();
        }
        submitBtn.prop('disabled', false).text(originalText);
      },
      error: function() {
        $('#form-message').removeClass('success').addClass('error').html('Erro ao enviar formulário. Tente novamente.').fadeIn();
        submitBtn.prop('disabled', false).text(originalText);
      }
    });
  });

});

// Funções para abrir/fechar modal de promoção
function openPromocaoModal(promocaoData) {
  $('#promocao-id').val(promocaoData.id);
  
  // Mostrar/ocultar campos baseado nas configurações da promoção
  $('#nascimento-group').toggle(promocaoData.dtNascimento === 'S');
  $('#email-group').toggle(promocaoData.email === 'S');
  $('#cpf-group').toggle(promocaoData.cpf === 'S');
  $('#endereco-group').toggle(promocaoData.endereco === 'S');
  $('#bairro-group').show(); // Sempre mostrar bairro
  $('#facebook-group').toggle(promocaoData.facebook === 'S');
  $('#instagram-group').toggle(promocaoData.instagram === 'S');
  $('#pix-group').toggle(promocaoData.pix === 'S');
  $('#mensagem-group').show(); // Sempre mostrar mensagem
  
  // Configurar perguntas
  var perguntasHtml = '';
  for (var i = 1; i <= 15; i++) {
    var pergunta = promocaoData['pergunta_' + i];
    if (pergunta && pergunta.trim() !== '') {
      perguntasHtml += '<div class="form-group pergunta-group">';
      perguntasHtml += '<label for="pergunta_' + i + '">' + pergunta + ' *</label>';
      perguntasHtml += '<div class="pergunta-options">';
      perguntasHtml += '<label class="radio-label"><input type="radio" name="pergunta_rd_' + i + '" value="Sim" required> Sim</label>';
      perguntasHtml += '<label class="radio-label"><input type="radio" name="pergunta_rd_' + i + '" value="Não" required> Não</label>';
      perguntasHtml += '</div>';
      perguntasHtml += '<input type="hidden" name="pergunta_' + i + '" value="' + pergunta + '">';
      perguntasHtml += '</div>';
    }
  }
  $('#perguntas-container').html(perguntasHtml);
  
  // Configurar pergunta de seleção
  if (promocaoData.pergunta_select && promocaoData.pergunta_select.trim() !== '') {
    $('#pergunta-select-label').text(promocaoData.pergunta_select + ' *');
    var opcoes = promocaoData.resposta_select ? promocaoData.resposta_select.split(';') : [];
    var selectHtml = '<option value="">Selecione uma opção</option>';
    opcoes.forEach(function(opcao) {
      opcao = opcao.trim();
      if (opcao) {
        selectHtml += '<option value="' + opcao + '">' + opcao + '</option>';
      }
    });
    $('#resposta-select').html(selectHtml);
    $('#pergunta-select-group').show();
  } else {
    $('#pergunta-select-group').hide();
  }
  
  // Configurar termos
  if (promocaoData.termos && promocaoData.termos.trim() !== '') {
    $('.termos-content').html(promocaoData.termos);
    $('#termos-group').show();
    $('#aceito-termos').prop('required', true);
  } else {
    $('#termos-group').hide();
    $('#aceito-termos').prop('required', false);
  }
  
  // Resetar formulário e mensagens
  $('#promocao-form')[0].reset();
  $('#form-message').hide().removeClass('success error');
  
  // Mostrar modal
  $('#promocao-modal').fadeIn();
  $('body').css('overflow', 'hidden');
}

function closePromocaoModal() {
  $('#promocao-modal').fadeOut();
  $('body').css('overflow', '');
  $('#promocao-form')[0].reset();
  $('#form-message').hide().removeClass('success error');
}

// Máscaras para campos do formulário
$(document).ready(function() {
  // Máscara de telefone
  $(document).on('input', '#telefone', function() {
    var value = $(this).val().replace(/\D/g, '');
    if (value.length <= 10) {
      value = value.replace(/^(\d{2})(\d{4})(\d{0,4}).*/, '($1) $2-$3');
    } else {
      value = value.replace(/^(\d{2})(\d{5})(\d{0,4}).*/, '($1) $2-$3');
    }
    $(this).val(value);
  });
  
  // Máscara de CPF
  $(document).on('input', '#cpf', function() {
    var value = $(this).val().replace(/\D/g, '');
    value = value.replace(/^(\d{3})(\d{3})(\d{3})(\d{0,2}).*/, '$1.$2.$3-$4');
    $(this).val(value);
  });
  
  // Máscara de data de nascimento
  $(document).on('input', '#nascimento', function() {
    var value = $(this).val().replace(/\D/g, '');
    value = value.replace(/^(\d{2})(\d{2})(\d{0,4}).*/, '$1/$2/$3');
    $(this).val(value);
  });
});