# mds-backup

Berdasarkan kode sumber terbuka dari https://github.com/larkinwhitaker/laravel-db-backup

Dapat digunakan pada Laravel versi 5, 5.1, 5.2, 5.3

Instalasi
----
Update file `composer.json` lalu masukan package ini 
```json
"Mydisha/laravel-db-backup": "dev-master"
```
Masukkan ini pada Service Provider yang ada di lokasi `config/app.php`
```php
'providers' => array(
    'Mydisha\MdsBackup\DBBackupServiceProvider'
)
```

# Konfigurasi

Publish file konfigurasi ke dalam project dengan perintah
```
php artisan vendor:publish
```