<?php

namespace PHP\Singleton;

class Connection
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


    public static function getInstance(): Connection
    {
        $cls = static::class;
        if (!isset(self::$instance[$cls])) {
            self::$instance[$cls] = new static();
        }

        return self::$instance[$cls];
    }
}

//Client Code
$s1 = Connection::getInstance();
echo '<pre>';
\var_dump($s1);

$s2 = Connection::getInstance();
echo '<pre>';
\var_dump($s2);

if ($s1 === $s2) {
    echo 'Singleton works, both variables contains the same instance.';
} else {
    echo 'Singleton failed, variables contain different instances.';
}