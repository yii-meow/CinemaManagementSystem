<?php
spl_autoload_register(function ($classname) {
    // Remove the 'App\' namespace prefix if it exists
    $classname = str_replace('App\\', '', $classname);

    // Convert namespace separators to directory separators
    $classname = str_replace('\\', '/', $classname);

    $directories = [
        '../app/models/',
        '../app/controllers/',
        '../app/core/'
    ];

    foreach ($directories as $directory) {
        $filename = $directory . $classname . ".php";
        if (file_exists($filename)) {
            include_once $filename;
            return true;
        }
    }

    return false;
});

// These files should be autoloaded if they're in the correct directories and namespaced properly
// If they're not namespaced, you might still need to require them manually
require 'config.php';
require 'functions.php';

// Optional: If these classes are not properly namespaced, you might need to keep these requires
// require 'Database.php';
// require 'Model.php';
// require 'Controller.php';
// require 'App.php';