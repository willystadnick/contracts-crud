# Avaliação técnica - Desenvolvedor - Stormtech

## Enunciado

Um dos clientes da empresa Stormtech solicitou o desenvolvimento de um sistema. O cliente informou que precisa fazer o modelo de contratos e clientes, ele também informa que o volume de clientes e contratos será na média de 50 mil contratos por mês e cada contrato tem sempre um cliente associado.

Desenvolva um CRUD onde possa ser cadastrados clientes, e contratos. Lembrando que esses dados devem ser persistidos em um banco de dados.

Faça uma query que traga os dados dos contratos e dos clientes relacionados.

Lembrando que a aplicação deve ser desenvolvida em PHP(5.3+) e o banco de dados usar o MySql(5.6+)

O contrato deve conter as seguintes informações (código contrato, cliente, valor contrato(R$), data cadastro).

O cliente deve ter as seguintes informações (Nome, cpf, cidade, estado, telefone, data nascimento)

## Instalação

1. Ajuste as variáveis de configuração do banco de dados no arquivo [index.php](https://github.com/willystadnick/stormtech-teste/blob/master/index.php#L12-L15)
2. Acesse a url do projeto pelo navegador
