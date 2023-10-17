![Logo AI Solutions](http://aisolutions.tec.br/wp-content/uploads/sites/2/2019/04/logo.png)

# AI Solutions

## Teste para novos candidatos (PHP/Laravel)

### Introdução

Este teste utiliza PHP 8.1, Laravel 10 e um banco de dados SQLite simples.

1. Faça o clone desse repositório;
1. Execute o `composer install`;
1. Crie e ajuste o `.env` conforme necessário
1. Execute as migrations e os seeders;

### Primeira Tarefa:

Crítica das Migrations e Seeders: Aponte problemas, se houver, e solucione; Implemente melhorias;

### Segunda Tarefa:

Crie a estrutura completa de uma tela que permita adicionar a importação do arquivo `storage/data/2023-03-28.json`, para a tabela `documents`. onde cada registro representado neste arquivo seja adicionado a uma fila para importação.

Feito isso crie uma tela com um botão simples que dispara o processamento desta fila.

Utilize os padrões que preferir para as tarefas.

Boa sorte!

### Executando Projeto:

1. Faça o clone desse repositório;
2. Crie o arquivo .env `cp .env.example .env`
3. Suba os containers do projeto, execute `docker-compose up -d`;
4. Acesse o container app com o bash `docker-compose exec app bash`
5. Instale as dependências do projeto `composer install`
6. Gere a key do projeto Laravel `php artisan key:generate`
7. Rodar as migrations `php artisan migrate`
8. Rodar os seeders `php artisan db:seed`
8. Rodar as queues `php artisan queue:work --queue=documents`

### Explicação do Desenvolvedor:

Desenvolvi todo o sistema com os cruds de categorias e documentos utilizando padrões de porjeto: Services, Repositories, Adapters, DTO, Interpreters. Alguns arquivos de Helpers e Traits.

No diretorio principal tem o arquivo `AI Solutions.postman_collection.json`para usar no Postman

#### Requests do Postman:
- categories
    - store
    - update/:id
    - destroy/:id
    - show/:id
    - index

- documents
    - store
    - update/:id
    - destroy/:id
    - show/:id
    - index
    - import
