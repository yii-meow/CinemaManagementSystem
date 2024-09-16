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

    $start = str_pad($parts[0], 2, '0', STR_PAD_LEFT);
    $end = str_pad($parts[1], 2, '0', STR_PAD_LEFT);

    $formatted_start = date("g:i A", strtotime($start . ":00"));
    $formatted_end = date("g:i A", strtotime($end . ":00"));

    return $formatted_start . ' - ' . $formatted_end;
}

function jsonResponse($data)
{
    header('Content-Type: application/json');
    echo json_encode($data);
}

?>
