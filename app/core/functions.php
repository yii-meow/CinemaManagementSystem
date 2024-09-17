<?php

function show($stuff)// let you to see whether got this result exists
{
    echo "<pre>";
    print_r($stuff);
    echo "</pre>";
}

function esc($str)
{
    return htmlspecialchars($str);
}

//This cannot be applied to redirect to the same Controller plz.
function redirect($path)// redirect to another page ***cannot redirect to the same controller, else it will keep looping
{
    header("Location: " . ROOT . "/" . $path);
    die;
}

function formatOpeningHours($hours)
{
    $parts = explode('-', $hours);
    if (count($parts) !== 2) {
        return $hours; // Return original if format is unexpected
    }

    $formatTime = function($time) {
        if (strlen($time) !== 4) {
            return $time; // Return original if format is unexpected
        }
        $hour = substr($time, 0, 2);
        $minute = substr($time, 2, 2);
        return date("g:i A", strtotime("$hour:$minute"));
    };

    $formatted_start = $formatTime($parts[0]);
    $formatted_end = $formatTime($parts[1]);

    return $formatted_start . ' - ' . $formatted_end;
}

function jsonResponse($data)
{
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

?>
