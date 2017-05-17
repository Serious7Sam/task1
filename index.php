<?php

require_once __DIR__ . '/vendor/autoload.php';

if (count($argv) < 3) {
    echo 'Please enter file path and items';
    exit;
}

list (, $filePath, $mealsString) = $argv;

if (!file_exists($filePath)) {
    echo 'Entered file does not exist';
    exit;
}

$meals = array_map('trim', explode(',', $mealsString));

$app = (new \Application\BestRestaurantCalculatorFactory())->create($filePath);

$result = $app->getResult($meals);

if (!$result) {
    echo 'Restaurant: none';
} else {
    echo 'Restaurant: ' . $result->getRestaurantId();
    echo 'Total cost: ' . round($result->getTotalPrice(), 2);
}
