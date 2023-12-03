<?php

namespace Core;

class ConfigLoader
{
    private static ConfigLoader $instance;
    private array $config = [];

    public static function getInstance(): ConfigLoader
    {
        if (!self::$instance) {
            self::$instance = new self();
            self::$instance->load();
        }

        return self::$instance;
    }

    public function load(): void
    {
        $this->loadEnv('../.env');
        $files = glob('../config/*.php');

        foreach ($files as $file) {
            $config                  = include $file;
            $filename                = pathinfo($file, PATHINFO_FILENAME);
            $this->config[$filename] = $config;
        }
    }

    public function loadEnv(string $filepath): void
    {
        if (file_exists($filepath)) {
            $envConfig = parse_ini_file($filepath, false, INI_SCANNER_TYPED);

            foreach ($envConfig as $key => $value) {
                putenv("$key=$value");
            }
        }
    }

    public function get(string $key): mixed
    {
        list($file, $configKey) = explode('.', $key, 2);

        if (false !== getenv($key)) {
            return getenv($key);
        }

        return $this->config[$file][$configKey] ?? null;
    }
}
