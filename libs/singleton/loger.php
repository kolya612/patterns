<?php
namespace libs\singleton;

require_once 'libs\singleton\singleton.php';

class Logger extends Singleton
{
    /**
     * Ресурс указателя файла файла журнала.
     */
    private $fileHandle;

    /**
     * Поскольку конструктор Одиночки вызывается только один раз, постоянно
     * открыт всего лишь один файловый ресурс.
     *
     * Обратите внимание, что для простоты мы открываем здесь консольный поток
     * вместо фактического файла.
     */
    protected function __construct()
    {
        $this->fileHandle = fopen('log.txt', 'a');
    }

    /**
     * Пишем запись в журнале в открытый файловый ресурс.
     */
    public function writeLog(string $message): void
    {
        $date = date('Y-m-d H.i.s');
        fwrite($this->fileHandle, "$date: $message\n");
    }

    /**
     * Просто удобный ярлык для уменьшения объёма кода, необходимого для
     * регистрации сообщений из клиентского кода.
     */
    public static function log(string $message): void
    {
        $logger = static::getInstance();
        $logger->writeLog($message);
    }
}