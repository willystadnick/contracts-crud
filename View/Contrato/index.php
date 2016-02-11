<?php include __RAIZ__ . '/View/Layout/top.php';?>

<h1>Contratos <a href="?modelo=contrato&acao=criar" class="btn btn-primary pull-right btn-sm">Novo</a></h1>

<hr/>

<?php if (count($contratos) == 0): ?>
<p>Nenhum contrato cadastrado...</p>
<?php else: ?>
<div class="table">
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>Código</th>
                <th>Cliente</th>
                <th>Valor (R$)</th>
                <th>Cadastro</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contratos as $contrato): ?>
            <tr>
                <td><?php echo $contrato['codigo']; ?></td>
                <?php $cliente = App\Model\Cliente::primeiro('id=' . $contrato['cliente_id']);?>
                <td><a href="?modelo=cliente&acao=exibir&id=<?php echo $cliente['id']; ?>"><?php echo $cliente['nome']; ?> (<?php echo $cliente['cpf']; ?>)</a></td>
                <td><?php echo App\Model\Model::valor($contrato['valor'], 'tela'); ?></td>
                <td><?php echo App\Model\Model::data($contrato['cadastro'], 'tela'); ?></td>
                <td class="col-sm-2 text-center">
                    <div class="btn-group btn-group-xs" role="group">
                        <a href="?modelo=contrato&acao=exibir&id=<?php echo $contrato['id']; ?>" class="btn btn-info" role="button">Exibir</a>
                        <a href="?modelo=contrato&acao=editar&id=<?php echo $contrato['id']; ?>" class="btn btn-primary" role="button">Editar</a>
                        <a href="?modelo=contrato&acao=excluir&id=<?php echo $contrato['id']; ?>" class="btn btn-danger" role="button">Excluir</a>
                    </div>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
<?php endif;?>
</div>

<?php $js = '
<script>
$(".btn-danger").click(function(){
    return confirm("Deseja realmente excluir esse contrato?");
});
</script>
';?>

<?php include __RAIZ__ . '/View/Layout/bottom.php';?>
