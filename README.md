# Test Pratico utilizando Laravel 
### Aplicação API utilizando Laravel

#
## Instalação das Dependências
Execute na pasta do projeto:
~~~
composer update
~~~ 


## Banco de Dados
Será necessário criar uma database vazia em MySQL.

Após criar o banco, remova o ```.exemple``` e configure o arquivo ```.env```

~~~
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=user
DB_PASSWORD=senha
~~~

## Email
Será necessario mudar as informações no ```.env``` para poder testar a função de email

Recomendo a utilização do https://mailtrap.io/
~~~
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
~~~
#
## Popular o Banco
Execute ```php artisan migrate:fresh --seed``` para criar as tabelas do banco e popular o banco com dados de test

Se desejar iniciar com as tabelas vazias, utilizar ```php artisan migrate:fresh ```


## Testando API

Execute ```php artisan serve``` e deixe aberto para testar as rotas

Após isso está pronto para testar as API's

Rotas Produtos:
~~~
GET : 127.0.0.1:8000/api/produtos
POST : 127.0.0.1:8000/api/produtos (Mudar o form no body)
PUT : 127.0.0.1:8000/api/produtos (Mudar os Params)
GET (Apenas 1): 127.0.0.1:8000/api/produtos/{id}
DELETE: 127.0.0.1:8000/api/produtos/{id}
~~~

Rotas Lojas:
~~~
GET : 127.0.0.1:8000/api/lojas
POST : 127.0.0.1:8000/api/lojas (Mudar o form no body)
PUT : 127.0.0.1:8000/api/lojas (Mudar os Params)
GET (Apenas 1): 127.0.0.1:8000/api/lojas/{id}
DELETE: 127.0.0.1:8000/api/lojas/{id}
~~~



