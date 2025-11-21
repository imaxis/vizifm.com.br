<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <?php include "mod_head.php" ?>
        <!-- (Engine) -->
        <meta name="image" content="https://vizifm.com.br/assets/img/logo_vizi.png">
        <meta name="description" content="VIZI FM - A melhor estacao para compartilhar!">

        <!-- (Google) -->
        <meta itemprop="name" content="VIZI FM">
        <meta itemprop="description" content="A melhor estacao para compartilhar!">
        <meta itemprop="image" content="https://vizifm.com.br/assets/img/logo_vizi.png">

        <!-- (Twitter) -->
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="VIZI FM">
        <meta name="twitter:description" content=A melhor estacao para compartilhar!">
        <meta name="twitter:image:src" content="https://vizifm.com.br/assets/img/logo_vizi.png">

        <!-- (Faceook) -->
        <meta property="og:title" content="VIZI FM">
        <meta property="og:description" content="A melhor estacao para compartilhar!">
        <meta property="og:image" content="https://vizifm.com.br/assets/img/logo_vizi.png">
        <meta property="og:url" content="https://vizifm.com.br/">
        <meta property="og:site_name" content="VIZI FM">
        <meta property="og:locale" content="pt_BR">
        <meta property="og:type" content="article">
    </head>
    <body onload="onload()">
        
        <audio id="bg-music">
            <source src="https://ice.fabricahost.com.br/vizifmpr" type="audio/mpeg">            
        </audio>
        <div id="page-loader" class="bg-white">
            <div class="loader"><div><span></span></div><div><span></span></div><div><span></span></div><div><span></span></div><div><span></span></div><div><span></span></div><div><span></span></div></div>
        </div>
        
        <?php $index = true; ?>
        <?php include "mod_header.php" ?>
        <?php $bannerCtrl = new GenericCtrl('Banner');
        $banner = $bannerCtrl->getAllObjects(true, 1, 0, "id DESC");
        $banner = $banner[0];
        ?>

        <div id="content" data-scroll-easing="easeOutCubic">
            <a href="<?php echo $banner->link ?>" <?php echo $banner->target == 1 ? 'target="_blank"' : ''; ?>>
            <section id="home" class="section fullheight bg-blue dark padding-v-130">
                <div class="bg-image  infinite zooming"><img src="<?php echo $bannerCtrl->showImage($banner, "Banner") ?>?time=<?php echo time() ?>" alt=""></div>
            </section>
            </a>
            
            <?php include "mod_sobre.php" ?>
            
            <?php include "mod_promocoes.php" ?>
            
           <hr class="sep-line">
            
            <section class="section section-bent bg-white">

                <div class="section-top bg-white"></div>
                <div class="section-bottom bg-white"></div>

                <?php include "mod_abrangencia.php" ?>

                
                <hr class="sep-line">

                <?php include "mod_equipe.php" ?>

            </section>


            <?php include "mod_programacao.php" ?>

            <?php include "mod_pedidos_contato.php" ?>

        </div>
        
        <script type="text/javascript" src="assets/js/jquery.mask.js"></script>

        <!-- JS Plugins -->
        <script>
        var playing = false;

        window.paceOptions = {
            target: '#page-loader',
            ajax: false
        };


        function onload() {
            var vid = document.getElementById("bg-music");
            vid.volume = 1;
            $('#page-loader').hide();
            $('body').click(function () {
                radioPlay();
            });
            function radioPlay() {
                if (!playing) {
                    $('#play-pause-radio').click();
                    playing = true;
                }
            }
            //document.getElementById('bg-music').volume+= 0.8;
        }

        $(document).ready(function () {
            $('#cpf').mask('000.000.000-00', {reverse: true});
            $('#telefone').mask('(00)00000-0000');
        });
        
        
        function isMobile() {
            var check = false; //wrapper no check
            (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))check = true})(navigator.userAgent||navigator.vendor||window.opera);
            return check;
        }
        
        if(isMobile()){
            $('#page-loader').hide();
        }

        </script>
        <script src="assets/js/player.js"></script>
        <script src="assets/js/plugins.js"></script>

        <script src="assets/js/coreVizi.js"></script>
		
		<?php
$popUpCtrl = new GenericCtrl("Popup");
$fields = array('status');
$values = array('S');
$popUp = $popUpCtrl->getObjectByField('status', 'S', true, 1, 0, "id DESC");
if (count($popUp) > 0) {
    $popUp = $popUp[0];
} else {
    $popUp = null;
}
?>

<?php if ($popUp != null && $page == null && $page != 'promocao') { ?>
    <div id="myModal" class="modal">
        <span class="close" id="close" style="color: #fff !important; opacity: 1;">&times;</span>
        <?php if ($popUp['link'] != '') { ?>
            <img class="modal-content" style="cursor: pointer" onclick="window.open('<?php echo $popUp['link'] ?>', '_blank');" src="https://vizifm.com.br/<?php echo $popUpCtrl->showImage($popUp, "Banner") ?>" id="img01">
        <?php } else { ?>
            <img class="modal-content" src="https://vizifm.com.br/<?php echo $popUpCtrl->showImage($popUp, "Banner") ?>" id="img01">
        <?php } ?>
    </div>
    <style>

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 999; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
        }

        /* Modal Content (Image) */
        .modal-content {
            margin: auto;
            width: 80%;
            max-width: 700px;
        }

        /* Caption of Modal Image (Image Text) - Same Width as the Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation - Zoom in the Modal */
        .modal-content, #caption {
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @keyframes zoom {
            from {transform:scale(0)}
            to {transform:scale(1)}
        }

        /* The Close Button */
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px){
            .modal-content {
                width: 100%;
            }
        }
    </style>
    <script type='text/javascript'>
        var modal = document.getElementById("myModal");
        modal.style.display = "block";
		
        var span = document.getElementById("close");
        span.onclick = function () {
            modal.style.display = "none";
            writeCookie('popup', true, 1);
        }
        if(document.getElementById("myModal") !== null) {
            if (readCookie('popup') == 'true') {
                modal.style.display = "none";
            }
        }
    </script>
<?php } ?>
		  
    
    
    </body>
</html>
