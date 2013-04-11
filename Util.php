<?php

class Util {
    
    protected static $memStart;
    protected static $timeStart;


    public static function bmStart(){
        self::$memStart = memory_get_usage();
        $timeStart = explode(' ', microtime());
        self::$timeStart = $timeStart[0] + $timeStart[1];
    }
    
    public static function getMemUsage(){
        return round((memory_get_usage() - self::$memStart)/1024, 2).' kb.';
    }
    
    public static function getTimeUsage(){
        $mtimeEnd = explode(' ', microtime());
        return round($mtimeEnd[0] + $mtimeEnd[1] - self::$timeStart, 3).' s.';
    }
    
    public static function printBenchMark(){
        echo PHP_EOL.'Mem: '.self::getMemUsage().' | Time: '.self::getTimeUsage();
    }
    
}