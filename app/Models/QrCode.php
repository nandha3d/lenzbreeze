<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QrCode extends Model
{
    protected $fillable = [
        'label',
        'content',
        'fg_color',
        'size',
        'scan_count',
    ];

    protected $casts = [
        'size'       => 'integer',
        'scan_count' => 'integer',
    ];

    /**
     * Increment the scan counter.
     */
    public function incrementScans(): void
    {
        $this->increment('scan_count');
    }
}
