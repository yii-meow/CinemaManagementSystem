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
	header("Location: " . ROOT."/".$path);
	die;
}
