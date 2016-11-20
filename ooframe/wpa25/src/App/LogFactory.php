<?php 

namespace Wpa25\App;

class LogFactory
{
	// File
	// Redis
    public function getLog($type = 'file', array $options) {
    	// chage to lower case
        $type = strtolower($type);
        // file
        $class = "Log_".ucfirst($type);
        // Log_File
        // Log_Mysql
        // Log/Mysql
        $file = DD . "/wpa25/" . str_replace("_", DIRECTORY_SEPARATOR, $class) . ".php";

        // Log/File.php
        // Log/Mysql.php
        // Log/Redis.php

        require_once $file;

        $log = new $class();

        switch($type) {
            case 'file':
                $log->setPath($options[0]);
                break;
            case 'mysql':
                // $log->setUser($options[0]);
                // $log->setPassword($options[1]);
                // $log->setDBName($options[2]);
                break;
            case 'sqlite':
                $log->setDBPath($options[0]);
                break;
            case 'redis':
                $log->setPath($options[0]);
        }
        return $log;
    }
}

 ?>