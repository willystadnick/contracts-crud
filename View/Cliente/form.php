<?php include __RAIZ__ . '/View/Layout/top.php';?>

<h1>Cliente</h1>

<hr/>

<form method="POST" class="form-horizontal" action="?modelo=cliente&acao=<?php echo $cliente['id'] ? 'atualizar&id=' . $cliente['id'] : 'armazenar'; ?>">
    <input name="id" type="hidden" id="id" value="<?php echo $cliente['id']; ?>">

    <div class="form-group ">
        <label for="nome" class="col-sm-3 control-label">Nome: </label>
        <div class="col-sm-6">
            <input class="form-control" name="nome" type="text" id="nome" value="<?php echo $cliente['nome']; ?>">
        </div>
    </div>

    <div class="form-group ">
        <label for="cpf" class="col-sm-3 control-label">CPF: </label>
        <div class="col-sm-6">
            <input class="form-control cpf" name="cpf" type="text" id="cpf" value="<?php echo $cliente['cpf']; ?>">
        </div>
    </div>

    <div class="form-group ">
        <label for="cidade" class="col-sm-3 control-label">Cidade: </label>
        <div class="col-sm-6">
            <input class="form-control" name="cidade" type="text" id="cidade" value="<?php echo $cliente['cidade']; ?>">
        </div>
    </div>

    <div class="form-group ">
        <label for="estado" class="col-sm-3 control-label">Estado: </label>
        <div class="col-sm-6">
            <input class="form-control" name="estado" type="text" id="estado" value="<?php echo $cliente['estado']; ?>">
        </div>
    </div>

    <div class="form-group ">
        <label for="telefone" class="col-sm-3 control-label">Telefone: </label>
        <div class="col-sm-6">
            <input class="form-control fone" name="telefone" type="text" id="telefone" value="<?php echo $cliente['telefone']; ?>">
        </div>
    </div>

    <div class="form-group ">
        <label for="nascimento" class="col-sm-3 control-label">Nascimento: </label>
        <div class="col-sm-6">
            <input class="form-control data" name="nascimento" type="text" id="nascimento" value="<?php echo App\Model\Model::data($cliente['nascimento'], 'tela'); ?>">
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
    $(".cpf").mask("000.000.000-00", {reverse: true});
    $(".fone").mask("(00) 0000-0000");
    $(".data").mask("00/00/0000");
});
</script>
';?>

<?php include __RAIZ__ . '/View/Layout/bottom.php';?>
