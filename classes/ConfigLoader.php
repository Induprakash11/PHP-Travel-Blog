<?php 
class ConfigLoader {
    public static $config;

    public static function setconfig($configPath) {
        if (!file_exists($configPath)) {
            throw new Exception("Error: Configuration file not found at '$configPath'.");
        }

        $jsonContent = file_get_contents($configPath);
        self::$config = json_decode($jsonContent, true);

        if (self::$config === null) {
            throw new Exception("Error: Invalid JSON format in configuration file.");
        }
        return self::$config;
    }

    public static function getconfig($key, $default = null) {
        if (array_key_exists($key, self::$config)) {
            return self::$config[$key];
        }

        if ($default !== null) {
            return $default;
        } else{
            throw new Exception("Error: Missing configuration key '$key'.");
        }
    }
}
?>
