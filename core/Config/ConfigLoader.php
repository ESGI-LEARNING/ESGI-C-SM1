<?php

namespace Core\Config;

class ConfigLoader
{
    private static ?ConfigLoader $instance = null;
    private array $config                  = [];

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
        $this->loadEnv();
        $files = glob('../config/*.php');

        foreach ($files as $file) {
            $config                  = include $file;
            $filename                = pathinfo($file, PATHINFO_FILENAME);
            $this->config[$filename] = $config;
        }
    }

    private function loadEnv(): void
    {
        $filepath = '../.env';

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

    public function setEnv(string $key, string $value): void
    {
        putenv("$key=$value");

        $env = file_get_contents('../.env');
        $env = preg_replace("/$key=(.*)/", "$key=$value", $env);
        file_put_contents('../.env', $env);
    }
}
