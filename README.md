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
Otherwise, you need to manually register the service provider.

### **For Laravel 10 and Below**  
Add the service provider in `config/app.php`:

### **For Laravel 11 and Above**  
Add the service provider in `bootstrap/providers.php`:

```php
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

### **For Laravel 10 and Below**  
Add the service provider in `config/app.php`:

### **For Laravel 11 and Above**  
Add the service provider in `bootstrap/providers.php`:

```php
App\Providers\RepositoryServiceProvider::class,
```

### **Step 5: Register the `make:repository` Command**  
After publishing, register the command in `app/Console/Kernel.php`:

> ⚠️ In Laravel 11 and above, `Kernel.php` has been removed. Custom commands in `app/Console/Commands` are now auto-discovered.

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
- `app/Repositories/Interfaces/ExampleInterface.php`

If you want to generate a corresponding service file, add the `--s` flag:

This will additionally create:
- `app/Services/ExampleService.php`

Modify these files according to your needs.

## License

This package is open-source and available under the [MIT license](LICENSE).
