<?php include __RAIZ__ . '/View/Layout/top.php';?>

<h1>Cliente</h1>

<hr/>

<dl class="dl-horizontal">
    <dt>Nome:</dt>
    <dd><?php echo $cliente['nome']; ?></dd>

    <dt>CPF:</dt>
    <dd><?php echo $cliente['cpf']; ?></dd>

    <dt>Cidade:</dt>
    <dd><?php echo $cliente['cidade']; ?></dd>

    <dt>Estado:</dt>
    <dd><?php echo $cliente['estado']; ?></dd>

    <dt>Telefone:</dt>
    <dd><?php echo $cliente['telefone']; ?></dd>

    <dt>Nascimento:</dt>
    <dd><?php echo App\Model\Model::data($cliente['nascimento'], 'tela'); ?></dd>

    <dt>Contratos:</dt>
    <dd>
        <?php if (count($contratos) > 0): ?>
        <ul>
            <?php foreach ($contratos as $contrato): ?>
            <li><a href="?modelo=contrato&acao=exibir&id=<?php echo $contrato['id']; ?>"><?php echo $contrato['codigo']; ?> (R$ <?php echo App\Model\Model::valor($contrato['valor'], 'tela'); ?>)</a></li>
            <?php endforeach;?>
        </ul>
        <?php else: ?>
        Nenhum contrato cadastrado...
        <?php endif;?>
    </dd>
</dl>

<?php include __RAIZ__ . '/View/Layout/bottom.php';?>
