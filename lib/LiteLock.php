<?php
/**
 * flock()を使ったシンプルなロック機能を実現するクラス
 *
 */
class LiteLock
{
    private $fp;

    public function __construct($lock_file = '')
    {
        $this->fp = fopen($lock_file, "a+");
        set_file_buffer($this->fp, 0);
    }

    public function lock()
    {
        if (flock($this->fp, LOCK_EX)) {
            $lock_time = date('H:i:s') . PHP_EOL;
            fwrite($this->fp, date("H:i:s") . ' : ' . $lock_time);
        }
    }

    public function unlock()
    {
        flock($this->fp, LOCK_UN);
        fclose($this->fp);
    }
}

/*
var_dump(date('Y-m-d H:i:s'));
$lock_file = dirname(__FILE__) . '/lock.txt';
$lock = new LiteLock($lock_file);
$lock->lock();
var_dump(date('Y-m-d H:i:s'));
$lock->unlock();
 */


