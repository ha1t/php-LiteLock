<?php
/**
 * 10秒かかる処理をロックして行うサンプル
 *
 * このプログラムを2つ同時に起動すると、先に実行された処理が終わるのを待ってから、次の処理が実行される。
 *
 * この仕組みを使うことで、必ず1秒以上感覚をあけてリクエストする事を要求されるAPIを、
 * Web上から安定して呼ぶ事ができる
 */

require_once dirname(dirname(__FILE__)) . '/LiteLock.php';

$lock_file = '/tmp/lock';
$lock = new LiteLock($lock_file);

echo "start lock:" . date('Y-m-d H:i:s') . PHP_EOL;
$lock->lock();
sleep(10);
$lock->unlock();
echo "end lock:" . date('Y-m-d H:i:s') . PHP_EOL;
