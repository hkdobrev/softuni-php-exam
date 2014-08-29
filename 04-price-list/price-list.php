<?php

$html = $_GET['priceList'];

define('PRODUCT', 0);
define('CATEGORY', 1);
define('PRICE', 2);
define('CURRENCY', 3);

$indexes = [
	PRODUCT  => 'product',
	CATEGORY => 'category',
	PRICE    => 'price',
	CURRENCY => 'currency',
];

$doc = new DOMDocument('1.0', 'UTF-8');
libxml_use_internal_errors(true);
$doc->loadHTML($html);
libxml_clear_errors();

$products = [];

$xpath = new DOMXPath($doc);

$rows = $xpath->query('//tr');

$isHeaderPassed = false;

foreach ($rows as $row) {
	if (!$isHeaderPassed) {
		$isHeaderPassed = true;
		continue;
	}
	$product = [];
	$cells = $row->childNodes;
	$index = 0;
	foreach ($cells as $cell) {
		if (isset($cell->nodeName) and $cell->nodeName === 'td') {
			$product[$indexes[$index]] = trim($cell->nodeValue);
			$index++;
		}
	}

	if ($product) {
		$category = $product['category'];
		unset($product['category']);
		$products [$category][] = $product;
	}
}

ksort($products);

foreach ($products as $category => &$categoryProducts) {
	usort($categoryProducts, function($a, $b) {
		return strcmp($a['product'], $b['product']);
	});
}

echo json_encode($products);
