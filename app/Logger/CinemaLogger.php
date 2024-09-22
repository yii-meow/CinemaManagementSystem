<?php
/**
 * @author Chong Yik Soon
 */
namespace App\Logger;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Formatter\LineFormatter;

class CinemaLogger
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger('cinema_operations');

        $formatter = new LineFormatter(
            "[%datetime%] %level_name%: %message% %context%\n",
            "Y-m-d H:i:s"
        );

        // Log to file
        $fileHandler = new RotatingFileHandler(
            __DIR__ . '/logs/cinema_operations.log',
            0,
            Logger::DEBUG,
            true,
            0664
        );
        $fileHandler->setFormatter($formatter);

        $this->logger->pushHandler($fileHandler);
    }

    public function log($level, $message, array $context = [])
    {
        $this->logger->log($level, $message, $context);
    }

    public function info($message, array $context = [])
    {
        $this->logger->info($message, $context);
    }

    public function error($message, array $context = [])
    {
        $this->logger->error($message, $context);
    }

    public function getLogs($date = null)
    {
        $date = $date ?: date('Y-m-d');
        $logFile = __DIR__ . "/logs/cinema_operations-{$date}.log";
        $logs = [];

        if (file_exists($logFile)) {
            $lines = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                $logs[] = json_decode($line, true);
            }
        }

        return array_reverse($logs);
    }
}