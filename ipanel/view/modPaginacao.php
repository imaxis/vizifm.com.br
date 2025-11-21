<?
    $numStart = ($page * $resultByPage) - $resultByPage + 1;
    $numEnd = $numStart + count($arrayList) - 1;

    $field = $this->getConfig()->getParameter("searchLetterColumn");


    $array = array('A','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
    print '<div class="alfabeto">';
    print ' <ul>';

    for($i=0; $i < count($array); $i++){
        if($array[$i] == $_GET['letter']){
            $class = 'class="alfaSelect"';
        }else{
            $class = "";
        }
        print '  <li>';
        print '    <span '.$class.'>';
        print '       <a title="Letra '.$array[$i].'" alt="Letra '.$array[$i].'"';
        print '          href="?lc='.$this->getArea().'&md=Lista&letter='.$array[$i].'&field='.$field.'&resultByPage='.$resultByPage.$parameters.'">'.$array[$i].'</a>';
        print '    </span>';
        print '  </li>';
    }
	
	echo "<div style='clear:both;'> </div>";

    for($p = 1; $p <= $totalPages; $p++) {
        if($p == $page) {
            $class = 'class="alfaSelect"';
        }else{
          $class = "";
        }
        print '  <li>';
        print '     <span '.$class.'>';
        print '        <a title="Número "'.$p.' alt="Número '.$p.'" href="?lc='.$this->getArea().'&md=Lista&page='.$p.'&resultByPage='.$resultByPage.$parameters.'">'.$p.'</a>';
        print '     </span';
        print '  </li>';
    }
    
    print ' </ul>';
    print '</div>';
	
	echo "<div style='clear:both;'> </div>";
?>
	
    <div class="tool_list_top">
        <p class="left" style="text-align:left;">
            <span>
                <label>Ir Para:</label>
                <input id="irPara" name="irPara" onkeypress="irPara('?lc=<?= $this->getArea() ?>&md=Lista&resultByPage=<?= $resultByPage ?><?= $parameters ?>', event)" type="text"/>
            </span>
            <span style="padding:0px 10px">
                <label>Mostrar linhas:</label>
                <select name="" onChange="MM_jumpMenu('parent',this,0)">
                    <option value="?lc=<?= $this->getArea() ?>&md=Lista&resultByPage=5<?= $parameters ?>" <? if($resultByPage == 5)  print "selected"; ?> >5</option>
                    <option value="?lc=<?= $this->getArea() ?>&md=Lista&resultByPage=10<?= $parameters ?>" <? if($resultByPage == 10)  print "selected"; ?> >10</option>
                    <option value="?lc=<?= $this->getArea() ?>&md=Lista&resultByPage=20<?= $parameters ?>" <? if($resultByPage == 20) print "selected"; ?> >20</option>
                    <option value="?lc=<?= $this->getArea() ?>&md=Lista&resultByPage=30<?= $parameters ?>" <? if($resultByPage == 30) print "selected"; ?> >30</option>
                    <option value="?lc=<?= $this->getArea() ?>&md=Lista&resultByPage=40<?= $parameters ?>" <? if($resultByPage == 40) print "selected"; ?> >40</option>
                </select>
            </span>
        </p>
        <p class="right" style="text-align:right;">
            <span style="padding-right:5px;">
                <strong><?= $numStart." - ".$numEnd ?></strong> de <?= count($arrayListTotal) ?>
            </span>
            <span style="padding:3px 0px;">
                <?
                    $pageBefore = $page - 1;
                    $pageNext   = $page + 1;
                    if(($page - 1) > 0){
                        print '<a href="?lc='.$this->getArea().'&md=Lista&page='.($page - 1).'&resultByPage='.$resultByPage.$parameters.'">';
                        print '<img src="img/bt_backpg.gif" alt="Voltar" align="texttop" />';
                        print '</a>';
                    }else{
                        print '<input type="image" src="img/bt_backpg_off.gif" alt="Voltar" align="texttop" />';
                    }

                    if($pageNext <= $totalPages){
                        print '<a href="?lc='.$this->getArea().'&md=Lista&page='.($page + 1).'&resultByPage='.$resultByPage.$parameters.'">';
                        print '<img src="img/bt_nextpg.gif" alt="Avançar" align="texttop" />';
                        print '</a>';
                    }else{
                        print '<input type="image" src="img/bt_nextpg_off.gif" alt="Avançar" align="texttop" />';
                    }
                ?>
            </span>
        </p>
        <div class="clear" style="border-bottom:1px solid #CCC"></div>
    </div>
    <div class="clear"></div>