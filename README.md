<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">URLer: Yii 2 URL shortener</h1>
    <br>
</p>

URL shortener based on [Yii 2](http://www.yiiframework.com/) Basic Project Template.

The application contains form for submiting URL to be shortened and about page and processing the redirection of short URL to destination full URL

The lenght of generatedshort URL code can be configured in `.env` file by changing value of the key `URL_LENGHT` by default it is equal to 6 characters.

The time to live of the short URL in days can be configured in `.env` file by changing value of the key `URL_LIFE_TIME_DAYS` by default it is equal to 20 days.

Application have CLI command to clear the expired URLs from DB:

```
php yii service/clear
``` 
it can be called from command line manual or can be added to cron.

INSTALLATION (dev environment)
------------

### CONFIGURATION

Edit the file `.env` for example:

```dotenv
APP_ENV=dev
MYSQL_HOST=urlersql
MYSQL_PORT=3306
MYSQL_DATABASE=urler
MYSQL_USER=local
MYSQL_PASSWORD=Pa$$w0rD
MYSQL_DB_CHARSET=utf8

URL_LENGHT=6
URL_LIFE_TIME_DAYS=15

##### DEVELOPMENT PARAMETERS ### BEGIN ###
###### DO NOT USE ON THE PRODUCTION ######

DEBUG_ENABLED=true
DEBUG_ALLOWED_IP=*

DOCKER_MAIN_DOMAIN=url.ld
DOCKER_HTTP_PORT=80
DOCKER_SSL_PORT=443
DOCKER_DEBUG_PORT=9009
DOCKER_USER_UID=1000
DOCKER_USER_GID=1000
DOCKER_MYSQL_PORT=3306
DOCKER_MYSQL_ROOT_PASSWORD=Jv8xHjSu

##### DEVELOPMENT PARAMETERS #### END ####
```


### Run Docker

> **Requiers** 
> *[docker-compose](https://docs.docker.com/compose/overview/) version 1.21.0 and higher*
>
> **Important ::**
> *All these commands must be executed in the project's root folder*

Start docker - first time

```
docker-compose up -d --build 
```

Start docker - regular

```
docker-compose up -d 
```

Check that all environments are up and running

```
docker-compose ps
```

Turn them off if needed

```
docker-compose down
```

### Install composer libraries 

To update libraries:

```
docker-compose exec main composer update
```

### Apply database migrations

Run standard yii migrations on your main container

```
docker-compose exec main php yii migrate/up --interactive=0
```

### CLI Service

Run CLI command to clear the expired URLs from DB
```
docker-compose exec main php yii service/clear
```


INSTALLATION (production environment)
------------

> **REQUIREMENTS::** 
> - Web server with [PHP 7](http://php.net/) support
>   - for [apache](https://httpd.apache.org/) webserver [mod_rewrite](https://httpd.apache.org/docs/current/mod/mod_rewrite.html) must be enabled and web root must be configured to `web/` folder inside the app
>   - for nginx you must configure `web/` folder as a server root and rewriting rules for all requests except files to `web/index.php` for example:
>       ```
>       server{
>            listen      80;
>            server_name urler.test;
>            root /var/www/web/;
>            location / {
>                    index  index.html index.php;
>                    if (!-e $request_filename){
>                        rewrite ^/(.*) /index.php?r=$1 last;
>                    }
>            }
>        }
>       ```   
> - Databse server [MySQL 5.7+](https://www.mysql.com/) or [MariaDB 10.3+](https://mariadb.com/) 
> - [Composer](https://getcomposer.org/) with [NPM/Bower Dependency Manager](https://packagist.org/packages/fxp/composer-asset-plugin) installed

### CONFIGURATION

Edit the file `.env` with real data, for example:

```dotenv
APP_ENV=production
MYSQL_HOST=host
MYSQL_PORT=3306
MYSQL_DATABASE=urler
MYSQL_USER=UrlerUser
MYSQL_PASSWORD=Pa$$w0rD
MYSQL_DB_CHARSET=utf8

URL_LENGHT=6
URL_LIFE_TIME_DAYS=15
```
### Install composer libraries 

To update libraries:

```
composer update
```

### Check application requriments
Run CLI script
```
php requirements.php
```


### Apply database migrations

Run standard yii migrations

```
php yii migrate/up --interactive=0
```
> **NOTES**
> - All these commands must be executed in the project's root folder
> - Yii won't create the database for you, this has to be done manually before you can access it.
> - Check and edit the other files in the `config/` directory to customize your application if required. 
> For example to change the application name you can edit file `config/web`
> ```php
> $config = [
>      ...
>      'name'       => 'URLer',
>      ...     
> ]
> ```