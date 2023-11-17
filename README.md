# Desafio IP4y Back End

Regra de negocios:

## Cliente

- Criar Opção para inserir cliente.

- Criar Opção para pegar todos os cliente.

- Criar Opção de deletar cliente.

- Criar Opção de editar cliente.

- Criar Validações de campos obrigatorios ( Nome, Sobrenome, Data de Nascimento, E-mail, Gênero).

## Requisitos que estou utilizando

- Composer
- PHP ^8.0.2 ou superior 
- Laravel ^9.19 ou superior
- Configuração do Banco de Dados

É necessário configurar os .env:

```dosini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ip4y
DB_USERNAME=root
DB_PASSWORD=
```

## Instale os pacotes e dependências

`composer install`

## Gerar key da aplicação

`php artisan key:generate`

## Rodar migrações do banco (ORM)

`php artisan migrate`

## Rodar o projeto

`php artisan serve --port=8001`

## Rotas criadas

| Rota                          | Descrição                       | Tipo  |
| ----------------------------- | ------------------------------- | ----- |
| api/teste.ip4y/               | Lista Clientes                  | GET   |
| api/teste.ip4y/show/{id}      | Lista Cliente                   | GET   |
| api/teste.ip4y/store          | Cria Cliente                    | POST  |
| api/teste.ip4y/edit/{id}      | Atualiza Cliente                | PUT   |
| api/teste.ip4y/delete/{id}    | Deleta Cliente                  | PUT   |


## Próximos Passos (melhorias)

- TUR -> Testes de Unidade de Recursividade

- TUEBD -> Testes de Unidade para Esquema de Banco de Dados 

- Opção de pegar os excluidos (trashed) 

###  Frameworks

- Laravel ^9.19
- PHP ^8.0.2

### Comunicação API

- JSON