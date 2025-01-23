<?php

namespace PHP\Singleton;

//ini_set('display_errors', 'stderr');
//\error_reporting(0);
class Singleton
{
    private static $instance = [];

    protected function __construct()
    {
    }

    protected function __clone()
    {
    }

    /**
     * Singleton can't restore from the string
     */
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }


    public static function getInstance(): Singleton
    {
        $cls = static::class;
        if (!isset(self::$instance[$cls])) {
            self::$instance[$cls] = new static();
        }

        return self::$instance[$cls];
    }
}

class Logger extends Singleton
{
    private $fileHandler;

    public function __construct()
    {
        $this->fileHandler = fopen('php://stdout', 'w');
    }

    public function writeLog(string $message): void
    {
       $date = date('Y-m-d h:m:s:i');
       fwrite($this->fileHandler, "$date# $message\n");
    }
    public static function log(string $message): void
    {
        $logger = static::getInstance();
        $logger->writeLog($message);
    }
}

class Config extends Singleton
{
    private $hashmap = [];

    protected function getValue(string $key): string
    {
        if (!isset($this->hashmap[$key])) {
            throw new \Exception('Wrong config param');
        }

        return $this->hashmap[$key];
    }

    public function setValue(string $key, string $value): void
    {
        $this->hashmap[$key] = $value;
    }

    public function get(string $key): string
    {
        try{
            return $this->getValue($key);
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            return $e->getMessage();
        }
    }
}

//Client Code
Logger::log("Let us start!");

$config = Config::getInstance();
$config->setValue('user', 'Joker');

Logger::log($config->get('user'));
Logger::log($config->get('user2'));
