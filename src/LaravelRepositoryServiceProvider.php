<?php

namespace BlaiseBueno\LaravelRepository;

use Illuminate\Support\ServiceProvider;

class LaravelRepositoryServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $publishable = [
            __DIR__ . '/stubs/RepositoryServiceProvider.php' => app_path('Providers/RepositoryServiceProvider.php'),
            __DIR__ . '/stubs/MakeRepository.php' => app_path('Console/Commands/MakeRepository.php'),
            __DIR__ . '/stubs/BaseRepository.php' => app_path('Repositories/BaseRepository.php'),
            __DIR__ . '/stubs/EloquentInterface.php' => app_path('Repositories/Interfaces/EloquentInterface.php'),
        ];
    
        // Ensure directories exist before publishing files
        foreach ($publishable as $sourceFile => $targetFile) {
            $targetDir = dirname($targetFile);
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
        }
    
        $this->publishes($publishable, 'laravel-repository');
    }

    public function register()
    {

    }
}
