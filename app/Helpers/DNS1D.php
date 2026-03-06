<?php

namespace App\Helpers;

use Picqer\Barcode\BarcodeGeneratorPNG;

class DNS1D
{
    public static function getBarcodePNG($code, $type = 'C128', $w = 2, $h = 30, $color = array(0, 0, 0))
    {
        if (empty($code)) return '';
        try {
            $generator = new BarcodeGeneratorPNG();
            
            // Map milon/barcode types to picqer types if needed
            $barcodeType = $generator::TYPE_CODE_128;
            if ($type == 'C39') $barcodeType = $generator::TYPE_CODE_39;
            if ($type == 'C39+') $barcodeType = $generator::TYPE_CODE_39_CHECKSUM;
            if ($type == 'C39E') $barcodeType = $generator::TYPE_CODE_39_EXTENDED;
            if ($type == 'C39E+') $barcodeType = $generator::TYPE_CODE_39_EXTENDED_CHECKSUM;
            if ($type == 'C93') $barcodeType = $generator::TYPE_CODE_93;
            if ($type == 'EAN13') $barcodeType = $generator::TYPE_EAN_13;
            if ($type == 'EAN8') $barcodeType = $generator::TYPE_EAN_8;
            if ($type == 'UPCA') $barcodeType = $generator::TYPE_UPC_A;
            if ($type == 'UPCE') $barcodeType = $generator::TYPE_UPC_E;
            
            $barcode = $generator->getBarcode($code, $barcodeType, $w, $h, $color);
            return base64_encode($barcode);
        } catch (\Exception $e) {
            return '';
        }
    }
}
