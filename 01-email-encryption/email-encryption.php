<?php

// Escape HTML data
$recipient = htmlspecialchars($_GET['recipient']);
$subject   = htmlspecialchars($_GET['subject']);
$body      = htmlspecialchars($_GET['body']);
$key       = $_GET['key'];

$email = <<<EMAIL
<p class='recipient'>{$recipient}</p><p class='subject'>{$subject}</p><p class='message'>{$body}</p>
EMAIL;

$j = 0;
$keyChars = str_split($key);
$keyLength = count($keyChars);

$keyCodes = array_map(function($char) {
	return ord($char);
}, $keyChars);

$result = [];

foreach (str_split($email) as $char) {
	if ($j === $keyLength) {
		$j = 0;
	}

	// Get ASCII code
	$charAsciiCode = ord($char);
	$keyAsciiCode = $keyCodes[$j];

	$product = $charAsciiCode * $keyAsciiCode;

	// Convert to hexadecimal
	$hexadecimalProduct = base_convert($product, 10, 16);

	$result []= $hexadecimalProduct;
	$j++;
}

echo '|'.implode('|', $result).'|';
