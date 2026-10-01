# prolog

Mari buat item menu dan tabel/form untuk mengelola produk

![image-03](http://laravel-filament-lms.test/filament-3/03.png)

# create filament resource

Setiap item menu di Filament disebut Resource, representasi visual dari Eloquent Model

`app/Models/Product.php :`

```php
class Product extends Model
{
    use HasFactory;
 
    protected $fillable = ['name', 'price'];
}
```

untuk membuat resource jalankan perintah

```php
php artisan make:filament-resource Product
```
