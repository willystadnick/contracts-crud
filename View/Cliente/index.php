<?php include __RAIZ__ . '/View/Layout/top.php';?>

<h1>Clientes <a href="?modelo=cliente&acao=criar" class="btn btn-primary pull-right btn-sm">Novo</a></h1>

<hr/>

<?php if (count($clientes) == 0): ?>
<p>Nenhum cliente cadastrado...</p>
<?php else: ?>
<div class="table">
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>Telefone</th>
                <th>Nascimento</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $cliente): ?>
            <tr>
                <td><?php echo $cliente['nome']; ?></td>
                <td><?php echo $cliente['cpf']; ?></td>
                <td><?php echo $cliente['cidade']; ?></td>
                <td><?php echo $cliente['estado']; ?></td>
                <td><?php echo $cliente['telefone']; ?></td>
                <td><?php echo App\Model\Model::data($cliente['nascimento'], 'tela'); ?></td>
                <td class="col-sm-2 text-center">
                    <div class="btn-group btn-group-xs" role="group">
                        <a href="?modelo=cliente&acao=exibir&id=<?php echo $cliente['id']; ?>" class="btn btn-info" role="button">Exibir</a>
                        <a href="?modelo=cliente&acao=editar&id=<?php echo $cliente['id']; ?>" class="btn btn-primary" role="button">Editar</a>
                        <a href="?modelo=cliente&acao=excluir&id=<?php echo $cliente['id']; ?>" class="btn btn-danger" role="button">Excluir</a>
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
    return confirm("Deseja realmente excluir esse cliente?");
});
</script>
';?>

<?php include __RAIZ__ . '/View/Layout/bottom.php';?>
