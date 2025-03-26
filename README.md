# Laravel Repository Package

A Laravel package that provides a repository pattern implementation.

## Installation

### **Step 1: Install via Composer**  
Run the following command in your Laravel project:

```sh
composer require blaisebueno/laravel-repository
```

### **Step 2: Register the Service Provider for Publishing**  
If you are using Laravel 5.5+ with package auto-discovery, you can skip this step.  
Otherwise, manually add the service provider in `config/app.php` under the **Package Service Providers** section:

```php
/*
 * Package Service Providers...
 */
\BlaiseBueno\LaravelRepository\LaravelRepositoryServiceProvider::class,
```

### **Step 3: Publish Files**  
Run the following command to publish the repository stubs:

```sh
php artisan vendor:publish --provider="BlaiseBueno\LaravelRepository\LaravelRepositoryServiceProvider"
```

This will publish the following:

- `app/Providers/RepositoryServiceProvider.php`
- `app/Console/Commands/MakeRepository.php`
- `app/Repositories/BaseRepository.php`
- `app/Repositories/Interfaces/EloquentInterface.php`

### **Step 4: Register the Repository Service Provider**  
Add the repository service provider in `config/app.php` under the **Application Service Providers**:

```php
/*
 * Application Service Providers...
 */
App\Providers\RepositoryServiceProvider::class,
```

### **Step 5: Register the `make:repository` Command**  
After publishing, register the command in `app/Console/Kernel.php`:

```php
protected $commands = [
    \App\Console\Commands\MakeRepository::class,
];
```

### **Step 6: Usage**  
You can now generate a new repository using:

```sh
php artisan make:repository ExampleRepository
```

This will create:
- `app/Repositories/ExampleRepository.php`
- `app/Repositories/Interfaces/ExampleRepositoryInterface.php`

Modify these files according to your needs.

## License

This package is open-source and available under the [MIT license](LICENSE).
