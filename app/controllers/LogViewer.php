<?php

namespace App\controllers;

use App\core\Controller;
use App\Facade\CinemaFacade;

class LogViewer
{
    use Controller;

    private $cinemaFacade;
    private $logDirectory;

    public function __construct()
    {
        $this->cinemaFacade = new CinemaFacade();
        $this->logDirectory = __DIR__ . '/../Logger/logs/';
    }

    public function index()
    {
        $logFiles = glob($this->logDirectory . '*.log');
        $selectedDate = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

        $logs = $this->getLogsForDate($selectedDate);

        return $this->view('Admin/Log/LogViewer', [
            'logs' => $logs,
            'logDates' => $this->getLogDates($logFiles),
            'selectedDate' => $selectedDate
        ]);
    }

    private function getLogsForDate($date)
    {
        $logFile = $this->logDirectory . "cinema_operations-{$date}.log";
        $logs = [];

        if (file_exists($logFile)) {
            $lines = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                // Parse each line
                if (preg_match('/\[(.*?)\] (\w+): (.*?) (.*)/', $line, $matches)) {
                    $logs[] = [
                        'datetime' => $matches[1],
                        'level_name' => $matches[2],
                        'message' => $matches[3],
                        'context' => json_decode($matches[4], true) ?? $matches[4]
                    ];
                }
            }
        }

        return array_reverse($logs);
    }

    private function getLogDates($logFiles)
    {
        $dates = [];
        foreach ($logFiles as $file) {
            preg_match('/cinema_operations-(\d{4}-\d{2}-\d{2})\.log/', basename($file), $matches);
            if (isset($matches[1])) {
                $dates[] = $matches[1];
            }
        }
        rsort($dates);
        return $dates;
    }
}