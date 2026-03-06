<?php

namespace App\Helpers;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

class DNS2D
{
    public static function getBarcodePNG($code, $type = 'QRCODE', $w = 3, $h = 3, $color = array(0, 0, 0))
    {
        if (empty($code)) return '';
        try {
            $options = new QROptions([
                'outputType'   => QRCode::OUTPUT_IMAGE_PNG,
                'eccLevel'     => QRCode::ECC_L,
                'scale'        => max($w, 3), // Ensure scale is not too small
                'imageBase64'  => false,
            ]);

            $qrcode = new QRCode($options);
            $image = $qrcode->render($code);
            return base64_encode($image);
        } catch (\Exception $e) {
            return '';
        }
    }
}
