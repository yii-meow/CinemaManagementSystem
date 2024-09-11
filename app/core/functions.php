<?php 

function show($stuff)
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
function redirect($path)
{
	header("Location: " . ROOT."/".$path);
	die;
}
