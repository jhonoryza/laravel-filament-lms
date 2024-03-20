# Prolog

Kita akan memasang Filament di existing project Laravel yang sudah ada. 

Pertama kita harus memiliki migration, model dan seeder, 

Lalu Filament akan membuat panel admin dan forms untuk data tersebut.

Jadi mari kita buat migration file, kita beri nama table "products" :

```php
Schema::create('products', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->integer('price');
    $table->timestamps();
});
```

Dan sekarang, mari instal Filament untuk mengelola produk tersebut

# Installation

jalankan perintah berikut

```bash
composer require filament/filament:"^3.0-stable" -W
php artisan filament:install --panels
```

Sekarang, kita dapat akses URL di `/admin`, 
yang akan mengarahkan kita secara otomatis ke `/admin/login`, 
dan Anda akan melihat login form

![image-01](http://laravel-filament-lms.test/filament-3/01.png)

tp tunggu bagaimana cara kita login ? apa credential nya ?

# Generate/Allow Users to Log In

Tentu saja, itu tergantung logika Anda kepada siapa kita ingin memberikan akses. 
Apakah kita sudah memiliki pengguna? Apakah mereka mempunyai peran? Atau apakah kita memulai proyek sepenuhnya dari awal?

Pertama, mari kita bahas kasus ini jika kita tidak memiliki user di tabel "users" default Laravel.

Kita dapat membuatnya dengan cepat. Filamen dilengkapi dengan perintah Artisan untuk ini:

```bash
php artisan make:filament-user
```

![image-02](http://laravel-filament-lms.test/filament-3/02.png)
