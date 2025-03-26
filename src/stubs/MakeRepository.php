<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "make:repository {name} {--s : Include a service file}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Creates a repository, interface, and optional service file.";

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        $includeService = $this->option('s');

        if (empty($name)) {
            $this->error("Invalid repository name.");
            return Command::FAILURE;
        }

        // Generate files
        $this->generateInterface($name);
        $this->generateRepository($name);

        if ($includeService) {
            $this->generateService($name);
        }

        // Bind repository in service provider if inside a Laravel app
        $this->bindToServiceProvider($name);

        // Success message
        $message = ["✅ {$name} Repository and Interface created successfully."];
        if ($includeService) {
            $message[] = "Service file included.";
        }
        $this->info(implode(' ', $message));

        return Command::SUCCESS;
    }

    protected function generateInterface($name): void
    {
        $namespace = 'App\Repositories\Interfaces';
        $path = $this->getBasePath("app/Repositories/Interfaces/{$name}Interface.php");
        $this->createFile($path, $this->getInterfaceTemplate($name, $namespace));
    }

    protected function generateRepository($name): void
    {
        $namespace = 'App\Repositories';
        $path = $this->getBasePath("app/Repositories/{$name}Repository.php");
        $this->createFile($path, $this->getRepositoryTemplate($name, $namespace));
    }

    protected function generateService($name): void
    {
        $namespace = 'App\Services';
        $path = $this->getBasePath("app/Services/{$name}Service.php");
        $this->createFile($path, $this->getServiceTemplate($name, $namespace));
    }

    protected function bindToServiceProvider($name): void
    {
        $providerPath = $this->getBasePath('app/Providers/RepositoryServiceProvider.php');

        if (!File::exists($providerPath)) {
            return;
        }

        $bindStatement = "\n        \$this->app->bind(\\App\\Repositories\\Interfaces\\{$name}Interface::class, \\App\\Repositories\\{$name}Repository::class);";
        $content = file_get_contents($providerPath);

        if (!str_contains($content, $bindStatement)) {
            $content = preg_replace('/(public function boot\(\)\s*\{)/', "$1" . $bindStatement, $content);
            File::put($providerPath, $content);
        }
    }

    protected function getBasePath(string $path = ''): string
    {
        return base_path($path);
    }

    protected function createFile(string $path, string $content): void
    {
        $directory = dirname($path);
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        File::put($path, $content);
    }

    protected function getInterfaceTemplate(string $name, string $namespace): string
    {
        return "<?php\n\nnamespace {$namespace};\n\ninterface {$name}Interface\n{\n    // Define methods here\n}\n";
    }

    protected function getRepositoryTemplate(string $name, string $namespace): string
    {
        return "<?php\n\nnamespace {$namespace};\n\nuse App\Repositories\Interfaces\\{$name}Interface;\n\nclass {$name}Repository extends BaseRepository implements {$name}Interface\n{\n    // Define methods here\n}\n";
    }

    protected function getServiceTemplate(string $name, string $namespace): string
    {
        return "<?php\n\nnamespace {$namespace};\n\nclass {$name}Service\n{\n    // Define methods here\n}\n";
    }
}
