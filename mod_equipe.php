<?php
    $equipeCtrl = new GenericCtrl("Locutor");
    $equipes = $equipeCtrl->getAllObjects(false, 0, 0, "nome ASC");
?>


<div class="relative container padding-t-30" id="equipe">
    <h2 class="text-center">Nossa <strong>equipe</strong>!</h2>
    <div class="row" style="margin-bottom: 250px"> 
        <div class="col-lg-8 col-lg-push-2">
            <div class="carousel text-center" data-items="2" data-items-desktop="[1199,2]" data-items-tablet="[979,2]" data-items-mobile="[400,1]" data-auto-play="2500">
                <?php foreach ($equipes as $equipe) { ?>
                    <?php if ($equipe['id'] != 36) { ?>
                        <div class="testimonial padding-15">
                            <div class="testimonial-author testimonial-with-photo">
                                <div class="testimonial-photo" style="width: 100px;">
                                    <img class="img-circle" src="http://vizifm.com.br/<?php echo $equipeCtrl->showImage($equipe, "Capa") ?>?time=<?php echo time() ?>" alt="<?php echo $equipe['nome'] ?>" title="<?php echo $equipe['nome'] ?>" />
                                </div>
                                <div class="testimonial-author-txt" style="margin-left: 115px; padding-top: 40px;">
                                    <span class="author-name"><?php echo $equipe['nome'] ?><strong></strong></span>
                                    <span class="text-muted"><?php echo $equipe['profissao'] ?></span>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>