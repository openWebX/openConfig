<?php


namespace openWebX\openConfig;

use Noodlehaus\Config as ConfigClass;

/**
 * Class Config
 *
 * @package openWebX\openConfig\Config
 */
class Config {

    /**
     * @var ConfigClass|null
     */
    private static ?ConfigClass $config = null;

    /**
     * @param string $configName
     * @param mixed|null $default
     * @return mixed|null
     */
    public static function get(string $configName, mixed $default = null) {
        self::init();
        return $default ? self::$config->get($configName, $default) : self::$config->get($configName);
    }

    /**
     * @return array|null
     */
    public static function getAll(): ?array {
        self::init();
        return self::$config->all();
    }

    /**
     * @return ConfigClass
     */
    private static function init() {
        if (!self::$config) {
            $dir = __DIR__;
            while ($dir != '/'){
                $configFolder = $dir . DIRECTORY_SEPARATOR .  'config';
                if (file_exists($configFolder) && is_dir($configFolder)) {
                    self::$config = new ConfigClass($configFolder . '/');
                    break;
                } else {
                    $dir .= '/../';
                }
            }
        }
        return self::$config;
    }


}