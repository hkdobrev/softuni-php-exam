<?php

$text = $_GET['text'];
$result = preg_match_all('/(?:(?<![A-Za-z])|^)([A-Z]+)(?:(?![A-Za-z])|$)/m', $text, $matches);

if ($result === FALSE) {
	throw new ErrorException("preg_match() returned an error");
}

if ($result) {

	foreach ($matches[1] as $match) {
		// Reverse the word
		$result = strrev($match);

		if ($match === $result) {
			$result = implode('', array_map(function($char)
			{
				return $char.$char;
			}, str_split($result)));
		}


		$text = preg_replace('/(^|(?<![A-Za-z]))'.$match.'($|(?![A-Za-z]))/', '$1'.$result.'$2', $text);
	}
}

echo '<p>'.htmlspecialchars($text).'</p>';
