<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

## About Code

I have created command for mysql backups which is app/Console/Commands/MysqlDump.php. Here I have defined all confiugrations variables those can be provided through our .env files i.e. 

DB_CONNECTION=mysql \
DB_HOST=127.0.0.1 \
DB_PORT=8889 \
DB_DATABASE=safename \
DB_USERNAME=root \
DB_PASSWORD=root \
MYSQL_DUMP_PATH=/Applications/MAMP/Library/bin/mysqldump \
GZIP=true \
MYSQL_DB_BACKUP=current \

## importan config vars 
MYSQL_DUMP_PATH=/Applications/MAMP/Library/bin/mysqldump -- this should be the path to mysqldump \
GZIP=true   --- if you want gzip compression \
MYSQL_DB_BACKUP=current   -- to make db of current database only  right now in our env its set to current pls change accordingly \
MYSQL_DB_BACKUP=ALL    -- to make a backup of all dbs \
MYSQL_BACKUP_FOLDER=    --this is to specify folder of your wish inside storage directory default is mysqlbackups folder \




## app/Console/Commands/MysqlDump.php  \
this file designed in a way that in future we can add multiple commands for our backup whether database is percona,rds or maria db with commands like innoddbbackup

