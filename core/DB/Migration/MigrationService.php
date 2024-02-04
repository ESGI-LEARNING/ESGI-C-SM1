<?php

namespace Core\DB\Migration;

class MigrationService
{
    public function createDb(): void
    {
        $files = glob('../src/Migrations/*.php');

        foreach ($files as $file) {
            require_once $file;

            $filename  = $this->filename($file);
            $class     = 'App\\Migrations\\'.ucfirst($filename);
            $migration = new $class();

            if (class_exists($class)) {
                $migration = new $class();

                if (method_exists($migration, 'up')) {
                    $migration->up();
                } else {
                    echo "Method 'up' not found in $class";
                }
            } else {
                echo "Class $class not found";
            }
        }
    }

    private function filename($file): string
    {
        $filename = pathinfo($file, PATHINFO_FILENAME);

        $className = preg_replace('/[0-9]+/', '', $filename);
        $className = str_replace('_', ' ', $className);
        $className = ucwords($className);

        return str_replace(' ', '', $className);
    }
}
