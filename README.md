## API - Tecnologia utilizada

- Framework Symfony: 5.1

## Versão do PHP

- Compatível com a versão 7.2 ou superior

## Versão do Mysql

- Utilizada versão 5.7

## Imagem do Docker com Ubuntu 18.04 e libs instaladas

[Docker: alylson/php72-ubuntu18](https://hub.docker.com/r/alylson/php72-ubuntu18)

## Uso com o Docker

Rodar o comando a partir da raiz do projeto:
```
$sudo docker-compose up -d
```

## 1 - Instalação

Fazendo build da aplicação.

Na raiz do projeto:
```
$composer install
```

Gerar chaves secretas:
```
$openssl genrsa -out config/jwt/private.pem -aes256 4096
$openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
```
Configurar o arquivo .env na raiz do projeto com as configurações do banco.

## 2 - Configuração

As tabelas da base de dados da API são criadas através de migrations.

OBS: Criar um schema no seu MySQL, com o nome promobit

Após certificar que a conexão com o banco está correta, executar as migrations:
```
$php bin/console doctrine:migration:migrate
```

Agora a API já está pronta.


Caso tenha optado pela criação de um novo container baseado na imagem acima, 
será necessário utilizar a porta 8086 para o correto funcionamento, caso não tenha sido alterada:

## Rotas disponíveis

###### Registrar

    method: POST
    url: http://pro.br:8086/register
    body: raw
    Ex:
        {
            "name": "admin",
            "email":"admin@admin.com",
            "roles":"admin",
            "password":"admin123"
        }
    
###### Login

    method: POST
    url: http://pro.br:8086/api/login_check
    body: raw
    Ex:
        {
            "email":"admin@admin.com",
            "password":"admin123"
        }

###### Listar Usuários

    method: GET
    url: http://pro.br:8086/api/users
    Headers: Authorization: Bearer {token}

###### Usuário Por Id

    method: GET
    url: http://pro.br:8086/api/cliente/1
    Headers: Authorization: Bearer {token}

###### Cadastrar Usuário

    method: POST
    url: http://pro.br:8086/api/user
    Headers: Authorization: Bearer {token}
    Body: raw
    Ex:
        {
            "name": "alylson",
            "email":"alylson@admin.com",
            "roles":"manager",
            "password":"123456"
        }

###### Atualizar Usuário

    method: PUT  
    url: http://pro.br:8086/api/user/{id}
    Headers: Authorization: Bearer {token}
    Body: raw
    Ex:
        {
            "name": "admin",
            "email":"admin@admin.com",
            "roles":"manager",
            "password":"123456"
        }

###### Excluir Usuário

    method: DELETE
    url: http://pro.br:8086/api/user/{id}
    Headers: Authorization: Bearer {token}

###### Recuperação de Senha


    
###### Logout

    method: POST
    url: http://pro.br:8086/api/auth/logout
    Headers: Authorization: Bearer {token}
