<?php
require 'vendor/autoload.php';
$b = new \Picqer\Barcode\BarcodeGeneratorPNG();
$img = base64_encode($b->getBarcode('1003', $b::TYPE_CODE_128));
file_put_contents('test_img.html', "<img src='data:image/png;base64,$img'>");
echo "Done.";
