Tianos, configuracion inicial
=============================

> para instalar el projecto


crear database
==============
* Now that Doctrine can connect to your database, the following command can automatically generate an empty tianos_db database for you:
* ejecutar el siguiente comando: 

```php
php bin/console doctrine:database:create
```


crear la database con config: mysql utf8
========================================
* para que la base de datos se cree con las modificaciones nuevas
* Ingresar a: nano /etc/mysql/my.cnf
* agregar: 

```mysql
[mysqld]
# Version 5.5.3 introduced "utf8mb4", which is recommended
collation-server     = utf8mb4_general_ci # Replaces utf8_general_ci
character-set-server = utf8mb4            # Replaces utf8
```

* para chequear el puerto en el que fue creado mysql
```mysql
mysql> SHOW GLOBAL VARIABLES LIKE 'PORT';
```


crear las tablas iniciales - Doctrine Migration
===============================================
* ejecutar el siguiente comando:: 

```php
php bin/console doctrine:migration:status
php bin/console doctrine:migration:migrate
```
