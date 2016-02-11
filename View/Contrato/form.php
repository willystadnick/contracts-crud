<?php include __RAIZ__ . '/View/Layout/top.php';?>

<h1>Contrato</h1>

<hr/>

<form method="POST" class="form-horizontal" action="?modelo=contrato&acao=<?php echo $contrato['id'] ? 'atualizar&id=' . $contrato['id'] : 'armazenar'; ?>">
    <input name="id" type="hidden" id="id" value="<?php echo $contrato['id']; ?>">

    <div class="form-group ">
        <label for="codigo" class="col-sm-3 control-label">Código: </label>
        <div class="col-sm-6">
            <input class="form-control" name="codigo" type="text" id="codigo" value="<?php echo $contrato['codigo']; ?>">
        </div>
    </div>

    <div class="form-group ">
        <label for="cliente_id" class="col-sm-3 control-label">Cliente: </label>
        <div class="col-sm-6">
            <select class="form-control" name="cliente_id" type="text" id="cliente_id">
                <option value="0">Selecione...</option>
                <?php foreach ($clientes as $cliente): ?>
                <option value="<?php echo $cliente['id']; ?>"<?php echo ($cliente['id'] == $contrato['cliente_id']) ? 'selected="selected"' : ''; ?> ><?php echo $cliente['nome']; ?> (<?php echo $cliente['cpf']; ?>)</option>
                <?php endforeach;?>
                <option value="novo">Novo...</option>
            </select>
        </div>
    </div>

    <div class="form-group ">
        <label for="valor" class="col-sm-3 control-label">Valor: </label>
        <div class="col-sm-6">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">R$</span>
                <input type="text" class="form-control valor" name="valor" type="text" id="valor" value="<?php echo App\Model\Model::valor($contrato['valor'], 'tela'); ?>">
            </div>
        </div>
    </div>


    <div class="form-group ">
        <label for="cadastro" class="col-sm-3 control-label">Cadastro: </label>
        <div class="col-sm-6">
            <input class="form-control data" name="cadastro" type="text" id="cadastro" value="<?php echo App\Model\Model::data($contrato['cadastro'], 'tela'); ?>">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            <input class="btn btn-primary form-control" type="submit" value="Salvar">
        </div>
    </div>

</form>

<?php $js = '
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
<script>
$(document).ready(function(){
    $("#cliente_id").change(function() {
        if ($(this).val() == "novo") {
            if (confirm("Deseja realmente cadastrar um novo cliente?")) {
                window.location.href = "?modelo=cliente&acao=criar";
            }
        }
    });
    $(".valor").mask("000.000.000.000.000.000,00", {reverse: true});
    $(".data").mask("00/00/0000");
});
</script>
';?>

<?php include __RAIZ__ . '/View/Layout/bottom.php';?>
