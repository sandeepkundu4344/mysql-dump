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

I have created Laravel command file for mysql backups which is inside the directory app/Console/Commands/MysqlDump.php. 
 
These are the .env config variables you need to set to make this script run 
DB_CONNECTION=mysql \
DB_HOST=127.0.0.1 \
DB_PORT=3306 \
DB_DATABASE=putdbnamehere \
DB_USERNAME=putusernamehere \
DB_PASSWORD=putpasswordhere \
MYSQL_DUMP_PATH=mysqldump \
GZIP=true \
MYSQL_DB_BACKUP=current -- we can provide either current(for current db backup) or ALL to backup all dbs 

## further explaination of above config vars 
MYSQL_DUMP_PATH=/mysqldump -- this should be the path to mysqldump command default is mysqldump \
GZIP=true   --- if you want gzip compression for final dump file \
MYSQL_DB_BACKUP=current   -- to make backup of current database only user current or ALL for full backup with all databases for example 4 as per your task. \
MYSQL_DB_BACKUP=ALL    -- to make a backup of all dbs \

Backups are stored inside storage directory in mysqlbackups folder if you want to change directory name you can pass in below .env variable
MYSQL_BACKUP_FOLDER=folder_name    --this will create backups inside storage/folder_name/date_sql.gz




## app/Console/Commands/MysqlDump.php
this file designed in a way that in future we can add multiple commands for our backup whether database is percona,rds or maria db with commands like innoddbbackup

