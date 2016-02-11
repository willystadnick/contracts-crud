<?php include __RAIZ__ . '/View/Layout/top.php';?>

<h1>Contrato</h1>

<hr/>

<dl class="dl-horizontal">
    <dt>Código:</dt>
    <dd><?php echo $contrato['codigo']; ?></dd>

    <dt>Cliente:</dt>
    <?php $cliente = App\Model\Cliente::primeiro('id=' . $contrato['cliente_id']);?>
    <dd><a href="?modelo=cliente&acao=exibir&id=<?php echo $cliente['id']; ?>"><?php echo $cliente['nome']; ?> (<?php echo $cliente['cpf']; ?>)</a></dd>

    <dt>Valor:</dt>
    <dd>R$ <?php echo App\Model\Model::valor($contrato['valor'], 'tela'); ?></dd>

    <dt>Cadastro:</dt>
    <dd><?php echo App\Model\Model::data($contrato['cadastro'], 'tela'); ?></dd>
</dl>

<?php include __RAIZ__ . '/View/Layout/bottom.php';?>
