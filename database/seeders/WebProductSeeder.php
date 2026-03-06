<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebProductSeeder extends Seeder
{
    public function run(): void
    {
        // Skip if already seeded
        if (DB::table('web_products')->count() > 0) {
            return;
        }

        // Ensure product_categories exist
        $this->seedCategories();

        // Seed the web products (website product catalog)
        $categories = DB::table('product_categories')->pluck('id', 'slug');

        $products = [
            [
                'category_id' => $categories['progressive-lenses'] ?? null,
                'brand' => 'EYE MEK',
                'name' => 'Eye Mek Premium Progressive RX',
                'slug' => 'premium-progressive-rx',
                'tagline' => 'Seamless Sight, Absolute Protection.',
                'description' => '<p>High-Performance Optics. EYE MEK Progressive lenses deliver superior multi-distance vision with our signature Drive X Technology for optimized road clarity. Available with Blue Cut, Photochromic, and Polarized options.</p><p>From the boardroom to the open road, experience crystal-clear vision at every distance with our premium progressive lens series.</p>',
                'technologies' => json_encode(['Progressive', 'Photochromic', 'Blue Cut']),
                'specifications' => json_encode([
                    'variants' => [
                        [
                            'name' => 'Multi-Distance',
                            'icon_type' => 'clear',
                            'description' => 'Classic progressive design for seamless near, intermediate and distance vision.',
                            'details' => [
                                'summary' => 'Our signature progressive lens with smooth transition zones optimized for daily wear.',
                                'benefits' => [
                                    'Vision: Seamless transition between near, intermediate and far distances',
                                    'Comfort: Wide corridor design reduces peripheral distortion',
                                    'Quality: Premium CR-39 material for lightweight comfort',
                                    'Protection: Built-in UV400 protection'
                                ],
                                'specs' => [
                                    ['label' => 'Material', 'value' => 'CR-39'],
                                    ['label' => 'Index', 'value' => '1.56'],
                                    ['label' => 'UV Protection', 'value' => 'UV400'],
                                    ['label' => 'Corridor Width', 'value' => 'Wide'],
                                ],
                                'highlight_title' => 'Drive X Technology',
                                'highlight_desc' => 'Optimized peripheral clarity for confident driving. Wider distance zone with reduced swim effect.'
                            ]
                        ],
                        [
                            'name' => 'Driving',
                            'icon_type' => 'driving',
                            'description' => 'Drive X Technology for optimized road clarity.',
                            'details' => [
                                'summary' => 'Enhanced driving progressive with wider distance zone and reduced peripheral swim.',
                                'benefits' => [
                                    'Road Clarity: Extra-wide distance zone for dashboard-to-road vision',
                                    'Low Distortion: Minimized swim effect during head turns',
                                    'Night Vision: Enhanced contrast for low-light driving',
                                    'Quick Adapt: Fast adaptation period for new wearers'
                                ],
                                'specs' => [
                                    ['label' => 'Material', 'value' => 'CR-39'],
                                    ['label' => 'Index', 'value' => '1.56'],
                                    ['label' => 'Technology', 'value' => 'Drive X'],
                                    ['label' => 'Corridor', 'value' => 'Extra Wide'],
                                ],
                                'highlight_title' => 'Drive X Optimized',
                                'highlight_desc' => 'Specifically tuned for automotive use cases. Wider field of view and reduced lateral aberrations.'
                            ]
                        ],
                        [
                            'name' => 'Professionals',
                            'icon_type' => 'office',
                            'description' => 'Office and digital screen optimized progressive.',
                            'details' => [
                                'summary' => 'Designed for professionals who spend long hours on screens and documents.',
                                'benefits' => [
                                    'Screen Comfort: Optimized intermediate zone for monitor distance',
                                    'Blue Light: Optional Blue Cut coating for digital eye strain',
                                    'Workspace: Enhanced near and intermediate zones',
                                    'All-Day: Lightweight design for extended wear'
                                ],
                                'specs' => [
                                    ['label' => 'Material', 'value' => 'CR-39'],
                                    ['label' => 'Index', 'value' => '1.56'],
                                    ['label' => 'Coating', 'value' => 'HMC + Blue Cut'],
                                    ['label' => 'Focus', 'value' => 'Near + Intermediate'],
                                ],
                                'highlight_title' => 'Digital Workspace',
                                'highlight_desc' => 'Extended intermediate zone provides comfortable viewing at typical screen distances (50-70cm).'
                            ]
                        ]
                    ]
                ]),
                'image' => 'images/progressive-lens1.jpeg',
                'is_featured' => true,
                'display_order' => 1,
                'is_active' => true,
            ],
            [
                'category_id' => $categories['single-vision-lenses'] ?? null,
                'brand' => 'EYE MEK',
                'name' => 'Eye Mek Single Vision',
                'slug' => 'single-vision-rx',
                'tagline' => 'Your Vision, Upgraded.',
                'description' => '<p>Welcome to the next level of visual clarity. EYE MEK SV isn\'t just a lens; it\'s a premium vision solution. Advanced HD Digital technology meets premium protection with our Blue Cut, Anti-Glare, and Photochromic options.</p><p>From the boardroom to the Great Outdoors, our lenses adapt to your world. See sharper. Live better.</p>',
                'technologies' => json_encode(['Anti-Glare', 'Blue Cut', 'Polarized']),
                'specifications' => json_encode([
                    'variants' => [
                        [
                            'name' => 'HD Clear',
                            'icon_type' => 'clear',
                            'description' => 'Crystal clear HD Digital optics with premium HMC Anti-Glare.',
                            'details' => [
                                'summary' => 'Our foundational single vision lens with HD Digital clarity and premium multi-coat for everyday wear.',
                                'benefits' => [
                                    'Clarity: HD Digital optics for edge-to-edge sharpness',
                                    'Protection: UV400 blocks 99.9% of harmful UV rays',
                                    'Durability: Hard multi-coat resists scratches and smudges',
                                    'Comfort: Lightweight CR-39 for all-day wear'
                                ],
                                'specs' => [
                                    ['label' => 'Material', 'value' => 'CR-39'],
                                    ['label' => 'Index', 'value' => '1.56'],
                                    ['label' => 'Coating', 'value' => 'HMC Anti-Glare'],
                                    ['label' => 'UV Protection', 'value' => 'UV400'],
                                ],
                                'highlight_title' => 'HD Digital Technology',
                                'highlight_desc' => 'Precision-surfaced for superior optical clarity across the entire lens surface.'
                            ]
                        ],
                        [
                            'name' => 'Blue Cut',
                            'icon_type' => 'bluecut',
                            'description' => 'Advanced blue light filtering for digital lifestyles.',
                            'details' => [
                                'summary' => 'Blue light filtering technology that reduces digital eye strain while maintaining color accuracy.',
                                'benefits' => [
                                    'Digital Protection: Filters harmful blue light from screens',
                                    'Reduced Strain: Minimizes digital eye fatigue',
                                    'True Color: Maintains natural color perception',
                                    'Sleep Quality: Reduces blue light exposure before bedtime'
                                ],
                                'specs' => [
                                    ['label' => 'Material', 'value' => 'CR-39'],
                                    ['label' => 'Index', 'value' => '1.56'],
                                    ['label' => 'Blue Block', 'value' => '40-45%'],
                                    ['label' => 'Coating', 'value' => 'HMC + Blue Cut'],
                                ],
                                'highlight_title' => 'Blue Shield Technology',
                                'highlight_desc' => 'Selectively filters harmful high-energy blue light while allowing beneficial wavelengths through.'
                            ]
                        ],
                        [
                            'name' => 'Photochromic Grey',
                            'icon_type' => 'photochromic',
                            'description' => 'Adaptive tint that darkens in sunlight.',
                            'sub_variants' => ['Grey'],
                            'details' => [
                                'summary' => 'Automatically adapts from clear indoors to dark grey outdoors for seamless sun protection.',
                                'benefits' => [
                                    'Adaptive: Automatically adjusts to light conditions',
                                    'Sun Protection: Darkens to sunglass-level tint outdoors',
                                    'Convenience: No need to switch between glasses',
                                    'UV Shield: Complete UV400 protection at all tint levels'
                                ],
                                'specs' => [
                                    ['label' => 'Material', 'value' => 'CR-39'],
                                    ['label' => 'Index', 'value' => '1.56'],
                                    ['label' => 'Tint Color', 'value' => 'Grey'],
                                    ['label' => 'Activation', 'value' => 'UV-Responsive'],
                                ],
                                'highlight_title' => 'Adaptive Photochromic',
                                'highlight_desc' => 'High-speed activation with fade-back in under 3 minutes for seamless indoor-outdoor transitions.'
                            ]
                        ],
                        [
                            'name' => 'Photochromic Brown',
                            'icon_type' => 'photochromic',
                            'description' => 'Warm brown adaptive tint for enhanced contrast.',
                            'sub_variants' => ['Brown'],
                            'details' => [
                                'summary' => 'Brown photochromic tint that enhances contrast and depth perception, ideal for outdoor activities.',
                                'benefits' => [
                                    'Contrast: Enhanced depth perception with warm brown tint',
                                    'Outdoor Ready: Perfect for sports and outdoor activities',
                                    'Natural Vision: Warm tone reduces glare without color distortion',
                                    'Full Protection: UV400 at all tint levels'
                                ],
                                'specs' => [
                                    ['label' => 'Material', 'value' => 'CR-39'],
                                    ['label' => 'Index', 'value' => '1.56'],
                                    ['label' => 'Tint Color', 'value' => 'Brown'],
                                    ['label' => 'Best For', 'value' => 'Outdoor Activities'],
                                ],
                                'highlight_title' => 'Warm Contrast Boost',
                                'highlight_desc' => 'Brown tint enhances contrast and depth perception, particularly effective in variable light conditions.'
                            ]
                        ],
                        [
                            'name' => 'HMC Green',
                            'icon_type' => 'hmc',
                            'description' => 'Premium green multi-coat anti-reflective coating.',
                            'details' => [
                                'summary' => 'Our classic green-tinted HMC anti-reflective coating for reduced glare and natural color rendering.',
                                'benefits' => [
                                    'Anti-Reflective: Reduces glare from artificial lighting',
                                    'Natural Colors: Green tint maintains warm natural tones',
                                    'Easy Clean: Hydrophobic top coat repels water and oil',
                                    'Scratch Guard: Hard coat layer for extended lens life'
                                ],
                                'specs' => [
                                    ['label' => 'Material', 'value' => 'CR-39'],
                                    ['label' => 'Index', 'value' => '1.56'],
                                    ['label' => 'Coating', 'value' => 'HMC Green'],
                                    ['label' => 'Type', 'value' => 'Anti-Reflective'],
                                ],
                                'highlight_title' => 'Classic Green Coat',
                                'highlight_desc' => 'Time-tested green multi-coat formula for superior anti-reflective performance and natural color balance.'
                            ]
                        ],
                        [
                            'name' => 'Night Vision',
                            'icon_type' => 'night',
                            'description' => 'Anti-glare coating optimized for night driving.',
                            'details' => [
                                'summary' => 'Specialized anti-glare technology that reduces headlight glare and improves contrast for night driving.',
                                'benefits' => [
                                    'Night Driving: Reduces oncoming headlight glare by up to 80%',
                                    'Enhanced Contrast: Clearer vision in low-light conditions',
                                    'Halo Reduction: Minimizes light halos around street lights',
                                    'Safety: Improved reaction time with clearer night vision'
                                ],
                                'specs' => [
                                    ['label' => 'Material', 'value' => 'CR-39'],
                                    ['label' => 'Index', 'value' => '1.56'],
                                    ['label' => 'Coating', 'value' => 'Night Drive AR'],
                                    ['label' => 'Glare Reduction', 'value' => 'Up to 80%'],
                                ],
                                'highlight_title' => 'Night Drive Clarity',
                                'highlight_desc' => 'Specialized wavelength filtering reduces the scattering effect of LED and HID headlights for safer night driving.'
                            ]
                        ],
                        [
                            'name' => 'Polarized',
                            'icon_type' => 'polarized',
                            'description' => 'Premium polarization for ultimate glare elimination.',
                            'details' => [
                                'summary' => 'True polarized lens technology that eliminates reflected glare for the clearest outdoor vision.',
                                'benefits' => [
                                    'Glare Elimination: Blocks 99% of reflected horizontal glare',
                                    'Color Enhancement: Richer, more vivid colors outdoors',
                                    'Eye Comfort: Reduces squinting in bright conditions',
                                    'Water Sports: Eliminates surface glare on water'
                                ],
                                'specs' => [
                                    ['label' => 'Material', 'value' => 'CR-39 Polarized'],
                                    ['label' => 'Index', 'value' => '1.56'],
                                    ['label' => 'Polarization', 'value' => '99% Efficiency'],
                                    ['label' => 'Best For', 'value' => 'Outdoor / Driving'],
                                ],
                                'highlight_title' => 'True Polarization',
                                'highlight_desc' => 'Multi-layer polarization film bonded between lens layers for distortion-free glare elimination.'
                            ]
                        ]
                    ]
                ]),
                'image' => 'images/single-vision-banner1.jpeg',
                'is_featured' => true,
                'display_order' => 2,
                'is_active' => true,
            ],
            [
                'category_id' => $categories['bifocal-lenses'] ?? null,
                'brand' => 'EYE MEK',
                'name' => 'Kryptok Bifocal (KBF)',
                'slug' => 'kryptok-bifocals',
                'tagline' => 'The Bifocal You Know.',
                'description' => '<p>See the world clearly—from the book in your hand to the view on the horizon. EYE MEK KBF series features the classic round segment bifocal design with premium EYE MEK quality.</p><p>Available with our full range of coatings and protection options.</p>',
                'technologies' => json_encode(['Bifocal', 'Photochromic', 'Anti-Glare']),
                'specifications' => json_encode([
                    'variants' => [
                        [
                            'name' => 'Classic KBF',
                            'icon_type' => 'clear',
                            'description' => 'Traditional round segment bifocal with HD clarity.',
                            'details' => [
                                'summary' => 'The time-tested Kryptok (round segment) bifocal design with EYE MEK premium optics.',
                                'benefits' => [
                                    'Near + Far: Clear dual-zone vision for reading and distance',
                                    'Seamless Segment: Invisible round segment blends naturally',
                                    'Proven Design: The classic bifocal trusted by millions',
                                    'Lightweight: CR-39 material for comfortable all-day wear'
                                ],
                                'specs' => [
                                    ['label' => 'Material', 'value' => 'CR-39'],
                                    ['label' => 'Segment Type', 'value' => 'Round (Kryptok)'],
                                    ['label' => 'UV Protection', 'value' => 'UV400'],
                                    ['label' => 'Coating', 'value' => 'HMC'],
                                ],
                                'highlight_title' => 'Invisible Segment',
                                'highlight_desc' => 'The round segment design offers the most cosmetically appealing bifocal — the segment line is nearly invisible.'
                            ]
                        ],
                        [
                            'name' => 'Photochromic',
                            'icon_type' => 'photochromic',
                            'description' => 'Adaptive bifocal that darkens in sunlight.',
                            'details' => [
                                'summary' => 'Kryptok bifocal with built-in photochromic technology for seamless indoor-outdoor transitions.',
                                'benefits' => [
                                    'Adaptive Tint: Darkens automatically in sunlight',
                                    'Dual Zone: Clear near and distance vision',
                                    'All-Weather: Works in all light conditions',
                                    'UV Protection: Full UV400 at all tint levels'
                                ],
                                'specs' => [
                                    ['label' => 'Material', 'value' => 'CR-39'],
                                    ['label' => 'Segment Type', 'value' => 'Round (Kryptok)'],
                                    ['label' => 'Tint', 'value' => 'Photochromic Grey'],
                                    ['label' => 'Activation', 'value' => 'UV-Responsive'],
                                ],
                                'highlight_title' => 'Adaptive Bifocal',
                                'highlight_desc' => 'Combines the convenience of photochromic technology with the trusted Kryptok bifocal design.'
                            ]
                        ],
                        [
                            'name' => 'Near + Far Vision',
                            'icon_type' => 'clear',
                            'description' => 'Enhanced bifocal for high prescription users.',
                            'details' => [
                                'summary' => 'Optimized for patients with higher prescriptions who need the reliability of a round segment bifocal.',
                                'benefits' => [
                                    'High Rx Support: Suitable for stronger prescriptions',
                                    'Clear Zones: Well-defined near and distance areas',
                                    'Stable Vision: Consistent clarity across both segments',
                                    'Comfortable: Balanced thickness even at higher powers'
                                ],
                                'specs' => [
                                    ['label' => 'Material', 'value' => 'CR-39'],
                                    ['label' => 'Index', 'value' => '1.56'],
                                    ['label' => 'Segment Type', 'value' => 'Round (Kryptok)'],
                                    ['label' => 'Recommended For', 'value' => 'Rx > ±4.00D'],
                                ],
                                'highlight_title' => 'High-Rx Optimized',
                                'highlight_desc' => 'Specially designed for higher prescriptions with balanced lens thickness and consistent optical power.'
                            ]
                        ]
                    ]
                ]),
                'image' => 'images/kryptok-bi-focal.jpg',
                'is_featured' => false,
                'display_order' => 3,
                'is_active' => true,
            ],
            [
                'category_id' => $categories['bifocal-lenses'] ?? null,
                'brand' => 'EYE MEK',
                'name' => 'D-Bifocal / Flat Top BF (DBF)',
                'slug' => 'd-bifocal-lens',
                'tagline' => 'Wide View. Sharp Focus.',
                'description' => '<p>Tired of narrow reading zones? Step into the wide-angle view of EYE MEK DBF. Our Flat Top design provides an immediate, easy-to-find segment for near-vision.</p><p>Making it the perfect companion for everything from your morning newspaper to your evening hobbies. Lightweight, durable, and crystal clear—it\'s the classic bifocal, perfected by EYE MEK.</p>',
                'technologies' => json_encode(['Bifocal']),
                'specifications' => json_encode([
                    'variants' => [
                        [
                            'name' => 'Reading',
                            'icon_type' => 'clear',
                            'description' => 'Wide flat-top segment for easy reading.',
                            'details' => [
                                'summary' => 'Our D-segment (flat top) bifocal with an extra-wide reading zone for comfortable near vision.',
                                'benefits' => [
                                    'Wide Segment: Larger reading area than round bifocals',
                                    'Easy to Find: Flat-top segment is immediately accessible',
                                    'Clear Line: Well-defined transition for predictable vision',
                                    'First-Time Friendly: Easiest bifocal to adapt to'
                                ],
                                'specs' => [
                                    ['label' => 'Material', 'value' => 'CR-39'],
                                    ['label' => 'Segment Type', 'value' => 'D-Segment (Flat Top)'],
                                    ['label' => 'Segment Width', 'value' => '28mm'],
                                    ['label' => 'UV Protection', 'value' => 'UV400'],
                                ],
                                'highlight_title' => 'Wide-Angle Near Vision',
                                'highlight_desc' => 'The D-segment flat-top design provides up to 40% more reading area than traditional round bifocals.'
                            ]
                        ],
                        [
                            'name' => 'Wide View',
                            'icon_type' => 'clear',
                            'description' => 'Extended segment for wider field of near vision.',
                            'details' => [
                                'summary' => 'Extended D-segment offering the widest near vision field in our bifocal range.',
                                'benefits' => [
                                    'Extra Wide: Maximum reading zone width',
                                    'Multi-Task: Easy to read and work at the same time',
                                    'Stable: No shift in near zone position',
                                    'Durable: Hard-coated for long-lasting clarity'
                                ],
                                'specs' => [
                                    ['label' => 'Material', 'value' => 'CR-39'],
                                    ['label' => 'Segment Type', 'value' => 'D-Segment (Flat Top)'],
                                    ['label' => 'Segment Width', 'value' => '35mm'],
                                    ['label' => 'Coating', 'value' => 'HMC'],
                                ],
                                'highlight_title' => 'Maximum Near View',
                                'highlight_desc' => 'Extended 35mm segment width provides the most comfortable and widest reading experience in our bifocal lineup.'
                            ]
                        ],
                        [
                            'name' => 'Multi-Use DBF',
                            'icon_type' => 'clear',
                            'description' => 'Versatile flat-top for books, tablets, and crafting.',
                            'details' => [
                                'summary' => 'All-purpose D-bifocal suitable for reading, tablet use, and detailed work like crafting.',
                                'benefits' => [
                                    'Versatile: Works for reading, tablets, and hobby work',
                                    'Ergonomic: Natural head position for near tasks',
                                    'Adaptive: Works well in both indoor and outdoor lighting',
                                    'Value: Excellent optics at an accessible price point'
                                ],
                                'specs' => [
                                    ['label' => 'Material', 'value' => 'CR-39'],
                                    ['label' => 'Index', 'value' => '1.56'],
                                    ['label' => 'Segment Type', 'value' => 'D-Segment (Flat Top)'],
                                    ['label' => 'Coating', 'value' => 'Standard HC'],
                                ],
                                'highlight_title' => 'Everyday Bifocal',
                                'highlight_desc' => 'The go-to bifocal for first-time wearers and those who want reliable near vision without complexity.'
                            ]
                        ]
                    ]
                ]),
                'image' => 'images/bifocal-lens.jpeg',
                'is_featured' => false,
                'display_order' => 4,
                'is_active' => true,
            ],
        ];

        $now = now();
        foreach ($products as &$product) {
            $product['created_at'] = $now;
            $product['updated_at'] = $now;
        }

        DB::table('web_products')->insert($products);
    }

    private function seedCategories(): void
    {
        if (DB::table('product_categories')->count() > 0) {
            return;
        }

        $now = now();
        DB::table('product_categories')->insert([
            [
                'name' => 'Single Vision Lenses',
                'slug' => 'single-vision-lenses',
                'description' => 'Premium single vision lenses with advanced coatings.',
                'image' => null,
                'display_order' => 1,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Progressive Lenses',
                'slug' => 'progressive-lenses',
                'description' => 'Multi-focal progressive lenses for seamless vision at all distances.',
                'image' => null,
                'display_order' => 2,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Blue Cut Lenses',
                'slug' => 'blue-cut-lenses',
                'description' => 'Lenses with blue light filtering technology.',
                'image' => null,
                'display_order' => 3,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Photochromic Lenses',
                'slug' => 'photochromic-lenses',
                'description' => 'Adaptive lenses that darken in sunlight.',
                'image' => null,
                'display_order' => 4,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Polarized Lenses',
                'slug' => 'polarized-lenses',
                'description' => 'Polarized lenses for glare reduction.',
                'image' => null,
                'display_order' => 5,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Anti-Glare Lenses',
                'slug' => 'anti-glare-lenses',
                'description' => 'Anti-reflective coated lenses.',
                'image' => null,
                'display_order' => 6,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Bifocal Lenses',
                'slug' => 'bifocal-lenses',
                'description' => 'Dual-zone bifocal lenses for near and distance vision.',
                'image' => null,
                'display_order' => 7,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
