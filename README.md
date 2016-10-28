# mds-backup

Based on open source project https://github.com/larkinwhitaker/laravel-db-backup

Support Laravel Version 5, 5.1, 5.2, 5.3.

Installation
----
Update `composer.json` and put this package
```json
"mydisha/mds-backup": "dev-master"
```
Or run following command
```bash
composer require mydisha/mds-backup
```
Next step,
Edit Service Provider, located in `config/app.php` and put this into `'providers'` array.
```php
'providers' => array(
    'Mydisha\MdsBackup\DBBackupServiceProvider'
)
```

# Configuration
Publish the configuration file into your project by run this command
```
php artisan vendor:publish
```
## Usage

### Backup
Create mysql dump file with default location in /storage/backup_db
```sh
php artisan db:backup
```

###### For specific database

```sh
php artisan db:backup --database=mysql
```
### Restore
To restore the dump mysql file, run this following command

```sh
php artisan db:restore [dbname]
```

To show list of dump file, run this following command
```sh
php artisan db:restore
```

### Change Initial Dump Filename
by default this package using datetime as file name, but you can change the filename started with your custome name, ex : laravel-date.sql

you can change at config file `mds-backup.php`
```php
    'initial_name' => '',
```
## Original Contributor
https://github.com/larkinwhitaker
