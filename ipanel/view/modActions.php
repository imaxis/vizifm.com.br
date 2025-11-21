<p class="left" style="text-align:left;">
    <span>
        <select name="action" id="action" onchange="executeAction()">
            <option value="">Ações em Massa</option>
            <option value="Selecionar">Selecionar todos</option>
            <option value="Inverter">Inverter Seleção</option>
            <option value="Excluir">Excluir Registros</option>
        </select>
    </span>
    <? if($this->getConfig()->getParameter("showAddButton") && $this->verificaPermissao($this->getArea(), "Incluir")){ ?>
            <a title="Adicionar Novo Registro" href="?lc=<?= $this->getArea() ?>&md=Form" class="bt_azul">Novo Registro</a>
    <? } ?>
    <a title="Atualizar Listagem" href="?lc=<?= $this->getArea() ?>&md=Lista" class="bt_azul">Atualizar Lista</a>
</p>
<div class="clear"></div>
