![Alt text](https://raw.githubusercontent.com/lc-lucascunha/laravel-api-rest-vue/master/public/images/git.png)

## Versões utilizadas

- **PHP** (7.2.34)
- **LARAVEL** (7.30.6)
- **COMPOSER** (2.5.5)
- **NODE** (12.22.12)
- **NPM** (6.14.16)

## Instalação e Configuração

Clone o repositório em uma pasta
```
git clone https://github.com/lc-lucascunha/laravel-api-rest-vue.git
```

Acesse a pasta do projeto
```
cd laravel-api-rest-vue/
```

Instale as dependência
```
composer install
```

Faça uma cópia do arquivo de configuração
```
cp .env.example .env
```

Após criar a DATABASE, abra o arquivo .env e definida as configurações da base de dados 
```
nano .env
```
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

Gere uma chave para a sua aplicação
```
php artisan key:generate
```

Execute a migração da base de dados
```
php artisan migrate
```

Caso não queira utilizar **migrate**, você pode executar o arquivo (**ddl.sql**)
```
cat database/mysql/ddl.sql
```
Não se esqueça de definir as permissões (caso necessário) nas pasta /bootstrap, /storage, /database.

## Iniciando a aplicação (API + VUE)

```
php artisan serve
```


