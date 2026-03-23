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
                'description' => '<p>High-Performance Optics. EYE MEK Progressive lenses deliver superior multi-distance vision with our signature Road Master Technology for optimized road clarity. Available with Blue Cut, Photochromic, and Polarized options.</p><p>From the boardroom to the open road, experience crystal-clear vision at every distance with our premium progressive lens series.</p>',
                'features' => json_encode([
                    'Road Master: Specialized filter to reduce night-time glare and sharpen road details for safer driving.',
                    'HD Digital: Wider corridors and reduced "swim effect" for faster adaptation and edge-to-edge clarity.',
                    'HMC: Choose Green for a natural look or Blue for a modern, tech-focused aesthetic with premium anti-reflective performance.',
                    'Photochromic: Rapid darkening in Grey or Brown for seamless 2-in-1 indoor/outdoor protection.'
                ]),
                'technologies' => json_encode(['Progressive', 'Photochromic', 'Blue Cut', 'Polarized', 'Anti-Glare', 'Road Master']),
                'specifications' => json_encode([
                    'variants' => [
                        [
                            'name' => 'CR 39 white',
                            'image' => 'images/variants/cr-39.avif',
                            'icon_type' => 'clear',
                            'description' => 'Industry standard for "plastic" eyeglass lenses, providing a lightweight, shatter-resistant alternative to glass.',
                            'details' => [
                                'summary' => 'The industry standard for lightweight, shatter-resistant optics.',
                                'benefits' => [
                                    'Superior Optics: High Abbe value for blur-free vision',
                                    'Affordability: Budget-friendly premium lens material',
                                    'Lightweight: 50% lighter than glass',
                                    'Exceptional Tinting: Perfect for custom fashion gradients'
                                ],
                                'specs' => [
                                    ['label' => 'Material', 'value' => 'ADC'],
                                    ['label' => 'Refractive Index', 'value' => '1.498'],
                                    ['label' => 'Abbe Value', 'value' => '58'],
                                    ['label' => 'Specific Gravity', 'value' => '1.32']
                                ],
                                'highlight_title' => 'Thermoset Durability',
                                'highlight_desc' => 'Highly resistant to heat and household chemicals.'
                            ]
                        ],
                        [
                            'name' => 'Uncoated',
                            'image' => 'images/variants/cr-39.avif',
                            'icon_type' => 'clear',
                            'description' => 'Pure lens material without external treatments.',
                            'details' => [
                                'summary' => 'Pure optics without external coatings.',
                                'benefits' => [
                                    'Superior Optics: High Abbe value for blur-free vision',
                                    'Affordability: Most budget-friendly premium lens',
                                    'Lightweight: 50% lighter than glass',
                                    'Natural Feel: No additional surface treatments'
                                ],
                                'specs' => [
                                    ['label' => 'Material', 'value' => 'ADC'],
                                    ['label' => 'Refractive Index', 'value' => '1.498'],
                                    ['label' => 'Abbe Value', 'value' => '58'],
                                    ['label' => 'Coating', 'value' => 'None']
                                ],
                                'highlight_title' => 'Thermoset Durability',
                                'highlight_desc' => 'Same durability characteristics as standard CR-39 material.'
                            ]
                        ],
                        [
                            'name' => 'Hard Coat',
                            'image' => 'images/variants/hard-coat.avif',
                            'icon_type' => 'hmc',
                            'description' => 'Clear, durable protection layer applied to resist daily abrasions and extend lens life.',
                            'details' => [
                                'summary' => 'A tough shield against scratches and daily wear.',
                                'benefits' => [
                                    'Extended Lifespan: Resists daily abrasions',
                                    'Surface Integrity: Prevents hairline scratches',
                                    'Smooth Finish: Flat foundation for secondary coatings',
                                    'Visual Longevity: Maintains clarity over time'
                                ],
                                'specs' => [
                                    ['label' => 'Base Treatment', 'value' => 'Polysiloxane Dip Coat'],
                                    ['label' => 'Durability', 'value' => 'High Scratch Resistance'],
                                    ['label' => 'Visibility', 'value' => '100% Optically Clear'],
                                    ['label' => 'Foundation', 'value' => 'Required for ARC']
                                ],
                                'highlight_title' => 'Polysiloxane Barrier',
                                'highlight_desc' => 'Durable layer cured with UV light to form a tough shield.'
                            ]
                        ],
                        [
                            'name' => 'Photochromic',
                            'image' => 'images/variants/photochromic.avif',
                            'icon_type' => 'photochromic',
                            'description' => 'Rapid darkening adaptive lenses for seamless 2-in-1 indoor/outdoor protection.',
                            'details' => [
                                'summary' => 'Adapts automatically to changing light conditions.',
                                'benefits' => [
                                    '2-in-1 Convenience: No need for separate sunglasses',
                                    'Reduced Fatigue: Less squinting in bright light',
                                    'UV Shield: Constant protection against solar radiation',
                                    'Rapid Transition: Fast darkening and fade-back'
                                ],
                                'specs' => [
                                    ['label' => 'Technology', 'value' => 'Naphthopyran Transition'],
                                    ['label' => 'Activation', 'value' => 'UV-Responsive'],
                                    ['label' => 'Protection', 'value' => '100% UVA & UVB'],
                                    ['label' => 'Versatility', 'value' => 'Indoor/Outdoor']
                                ],
                                'highlight_title' => 'Molecule Adaptation',
                                'highlight_desc' => 'Light-sensitive molecules undergo structural change when exposed to UV.'
                            ]
                        ],
                        [
                            'name' => 'Blue cut',
                            'image' => 'images/variants/blu-cut.avif',
                            'icon_type' => 'bluecut',
                            'description' => 'Designed to protect eyes from digital strain by filtering high-energy visible (HEV) blue light.',
                            'details' => [
                                'summary' => 'Essential protection for digital lifestyles.',
                                'benefits' => [
                                    'Screen Comfort: Reduces dry eyes and headaches',
                                    'Sleep Support: Preserves natural circadian rhythms',
                                    'Sharp Contrast: Enhances visual comfort for small text',
                                    'Digital Guard: Filters harmful HEV light'
                                ],
                                'specs' => [
                                    ['label' => 'Filtering Range', 'value' => '380nm – 450nm'],
                                    ['label' => 'Method', 'value' => 'Monomer / Reflection'],
                                    ['label' => 'Clarity', 'value' => 'HD Digital Viewing'],
                                    ['label' => 'Protection', 'value' => 'HEV Blue Light Shield']
                                ],
                                'highlight_title' => 'Blue Shield Technology',
                                'highlight_desc' => 'Selectively filters harmful high-energy blue light while allowing beneficial wavelengths through.'
                            ]
                        ],
                        [
                            'name' => 'HD digital',
                            'image' => 'images/variants/hd.avif',
                            'icon_type' => 'clear',
                            'description' => 'Wider corridors and reduced "swim effect" for faster adaptation and edge-to-edge clarity.',
                            'details' => [
                                'summary' => 'Precision optics for maximum clarity and fast adaptation.',
                                'benefits' => [
                                    'Maximum Clarity: Crisp vision across entire surface',
                                    'Zero Distortion: Eliminates the "swim effect"',
                                    'Sharper Contrast: Brighter, high-definition vision',
                                    'Quick Adapt: Reduces adaptation time'
                                ],
                                'specs' => [
                                    ['label' => 'Manufacturing', 'value' => 'Freeform 3D Digital'],
                                    ['label' => 'Precision', 'value' => '1/100th Diopter'],
                                    ['label' => 'Field of View', 'value' => 'Edge-to-Edge'],
                                    ['label' => 'Customization', 'value' => 'Tailored Optics']
                                ],
                                'highlight_title' => 'Precision Surfacing',
                                'highlight_desc' => 'CNC manufacturing carve prescription to 1/100th of a diopter accuracy.'
                            ]
                        ],
                        [
                            'name' => 'Polarized',
                            'image' => 'images/variants/polarized.avif',
                            'icon_type' => 'polarized',
                            'description' => 'The gold standard for bright light, using microscopic vertical filters to block intense horizontal glare.',
                            'details' => [
                                'summary' => 'Ultimate glare elimination for the brightest conditions.',
                                'benefits' => [
                                    'Visual Comfort: Reduces glare in brightest sun',
                                    'Driving Safety: Removes reflections from roads',
                                    'True Colors: Accurate outdoor color perception',
                                    'Eye Relaxation: Drastically reduces squinting'
                                ],
                                'specs' => [
                                    ['label' => 'Filter Type', 'value' => 'Polyvinyl Alcohol Film'],
                                    ['label' => 'Glare Reduction', 'value' => 'Up to 99.9%'],
                                    ['label' => 'Contrast', 'value' => 'Premium Outdoor Detail'],
                                    ['label' => 'Ideal For', 'value' => 'Water, Snow, & Driving']
                                ],
                                'highlight_title' => 'Light Polarization',
                                'highlight_desc' => 'Acts like a window blind, blocking horizontal glare while letting vertical light through.'
                            ]
                        ],
                        [
                            'name' => 'HMC (Antiglare)',
                            'image' => 'images/variants/hmc.avif',
                            'icon_type' => 'hmc',
                            'description' => 'Premium anti-reflective multi-coat for clear vision and natural appearance.',
                            'details' => [
                                'summary' => 'Reduces reflections for both the wearer and others.',
                                'benefits' => [
                                    'Night Safety: Reduces halos around headlights',
                                    'Invisible Look: People see your eyes clearly',
                                    'Crisper View: Sharpens vision by reducing ghost images',
                                    'Cosmetic Appeal: Eliminates distracting lens glare'
                                ],
                                'specs' => [
                                    ['label' => 'Light Transmission', 'value' => 'Up to 99%'],
                                    ['label' => 'Technology', 'value' => 'Vacuum Metallic Oxides'],
                                    ['label' => 'Reflection Loss', 'value' => 'Reduced to < 1%'],
                                    ['label' => 'Effect', 'value' => 'Anti-Reflective Purger']
                                ],
                                'highlight_title' => 'Destructive Interference',
                                'highlight_desc' => 'Multiple layers neutralize light waves for maximum transmission.'
                            ]
                        ],
                        [
                            'name' => 'Road Master',
                            'image' => 'images/variants/hmc.avif',
                            'icon_type' => 'driving',
                            'description' => 'Specialized filter to reduce night-time glare and sharpen road details for safer driving.',
                            'details' => [
                                'summary' => 'Optimized performance for road clarity and night safety.',
                                'benefits' => [
                                    'Night Safety: Cuts halos and headlight glare',
                                    'Driving Clarity: Sharpens dashboard and road detail',
                                    'Crisper View: Eliminates internal haze and ghosting',
                                    'Quick Focus: Faster visual switching during driving'
                                ],
                                'specs' => [
                                    ['label' => 'Transmission', 'value' => 'High-Contrast Optimized'],
                                    ['label' => 'Coating', 'value' => 'Road Master ARC'],
                                    ['label' => 'Night Performance', 'value' => 'Enhanced Visual Contrast'],
                                    ['label' => 'Technology', 'value' => 'Glare Purge Filter']
                                ],
                                'highlight_title' => 'Road Optimization',
                                'highlight_desc' => 'Specifically tailored for extreme road visibility and high-speed safety.'
                            ]
                        ]
                    ]
                ]),
                'image' => 'images/progressive-lens3.avif',
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
                'description' => '<p>Welcome to the next level of visual clarity. EYE MEK isn\'t just a lens; it’s a premium vision solution tailored to your lifestyle. Whether you\'re navigating a digital workspace, driving under the sun, or looking for everyday durability, we have the perfect fit.</p>',
                'features' => json_encode([
                    'Ultra-lightweight & crystal clear.',
                    'Enhanced durability & scratch resistance.',
                    'Seamlessly tints to Grey or Brown.',
                    'Filters harmful high-energy blue light.',
                    'Precision-surfaced for edge-to-edge clarity.',
                    'Eliminates blinding glare and reflections.',
                    'Available in Emerald Green or Sapphire Blue.',
                    'Road Master: Specialized filter to reduce night-time glare and sharpen road details.'
                ]),
                'technologies' => json_encode(['HD Digital Technology', 'Photochromic Technology', 'Blue Cut Protection', 'Polarized Precision', 'HMC (Hard Multi-Coat)', 'Road Master']),
                'specifications' => json_encode([
                    'variants' => [
                        [
                            'name' => 'CR 39 white',
                            'image' => 'images/variants/cr-39.avif',
                            'icon_type' => 'clear',
                            'description' => 'Industry standard lightweight/shatter-resistant plastic.',
                            'details' => [
                                'summary' => 'The industry standard for lightweight, shatter-resistant optics.',
                                'benefits' => [
                                    'Superior Optics: High Abbe value for blur-free vision',
                                    'Affordability: Budget-friendly premium lens material',
                                    'Lightweight: 50% lighter than glass',
                                    'Exceptional Tinting: Perfect for custom fashion gradients'
                                ],
                                'specs' => [
                                    ['label' => 'Material', 'value' => 'ADC'],
                                    ['label' => 'Refractive Index', 'value' => '1.498'],
                                    ['label' => 'Abbe Value', 'value' => '58'],
                                    ['label' => 'Specific Gravity', 'value' => '1.32']
                                ],
                                'highlight_title' => 'Thermoset Durability',
                                'highlight_desc' => 'Highly resistant to heat and household chemicals.'
                            ]
                        ],
                        [
                            'name' => 'Hard Coat',
                            'image' => 'images/variants/cr-39.avif',
                            'icon_type' => 'clear',
                            'description' => 'Durable protection layer to extend lens lifespan.',
                            'details' => [
                                'summary' => 'A tough shield against scratches and daily wear.',
                                'benefits' => [
                                    'Extended Lifespan: Resists daily abrasions',
                                    'Surface Integrity: Prevents hairline scratches',
                                    'Smooth Finish: Flat foundation for secondary coatings',
                                    'Visual Longevity: Maintains clarity over time'
                                ],
                                'specs' => [
                                    ['label' => 'Base Treatment', 'value' => 'Polysiloxane Dip Coat'],
                                    ['label' => 'Durability', 'value' => 'High Scratch Resistance'],
                                    ['label' => 'Visibility', 'value' => '100% Optically Clear'],
                                    ['label' => 'Foundation', 'value' => 'Required for ARC']
                                ],
                                'highlight_title' => 'Polysiloxane Barrier',
                                'highlight_desc' => 'Durable layer cured with UV light to form a tough shield.'
                            ]
                        ],
                        [
                            'name' => 'Photochromic',
                            'image' => 'images/variants/photochromic.avif',
                            'icon_type' => 'photochromic',
                            'description' => 'Light-adaptive lenses (Grey/Brown).',
                            'details' => [
                                'summary' => 'Adapts automatically to changing light conditions.',
                                'benefits' => [
                                    '2-in-1 Convenience: No need for separate sunglasses',
                                    'Reduced Fatigue: Less squinting in bright light',
                                    'UV Shield: Constant protection against solar radiation',
                                    'Rapid Transition: Fast darkening and fade-back'
                                ],
                                'specs' => [
                                    ['label' => 'Technology', 'value' => 'Naphthopyran Transition'],
                                    ['label' => 'Activation', 'value' => 'UV-Responsive'],
                                    ['label' => 'Protection', 'value' => '100% UVA & UVB'],
                                    ['label' => 'Versatility', 'value' => 'Indoor/Outdoor']
                                ],
                                'highlight_title' => 'Molecule Adaptation',
                                'highlight_desc' => 'Light-sensitive molecules undergo structural change when exposed to UV.'
                            ],
                            'sub_variants' => ['Photo Grey', 'Photo Brown']
                        ],
                        [
                            'name' => 'Blue cut',
                            'image' => 'images/variants/blu-cut.avif',
                            'icon_type' => 'bluecut',
                            'description' => 'Protects from digital strain/HEV blue light.',
                            'details' => [
                                'summary' => 'Essential protection for digital lifestyles.',
                                'benefits' => [
                                    'Screen Comfort: Reduces dry eyes and headaches',
                                    'Sleep Support: Preserves natural circadian rhythms',
                                    'Sharp Contrast: Enhances visual comfort for small text',
                                    'Digital Guard: Filters harmful HEV light'
                                ],
                                'specs' => [
                                    ['label' => 'Filtering Range', 'value' => '380nm – 450nm'],
                                    ['label' => 'Method', 'value' => 'Monomer / Reflection'],
                                    ['label' => 'Clarity', 'value' => 'HD Digital Viewing'],
                                    ['label' => 'Protection', 'value' => 'HEV Blue Light Shield']
                                ],
                                'highlight_title' => 'Blue Light Shield',
                                'highlight_desc' => 'Selectively filters harmful high-energy blue light while allowing beneficial wavelengths through.'
                            ]
                        ],
                        [
                            'name' => 'HD digital',
                            'image' => 'images/variants/hd.avif',
                            'icon_type' => 'clear',
                            'description' => '3D computer-aided laser surfacing for precision.',
                            'details' => [
                                'summary' => 'Precision optics for maximum clarity and fast adaptation.',
                                'benefits' => [
                                    'Maximum Clarity: Crisp vision across entire surface',
                                    'Zero Distortion: Eliminates the "swim effect"',
                                    'Sharper Contrast: Brighter, high-definition vision',
                                    'Quick Adapt: Reduces adaptation time'
                                ],
                                'specs' => [
                                    ['label' => 'Manufacturing', 'value' => 'Freeform 3D Digital'],
                                    ['label' => 'Precision', 'value' => '1/100th Diopter'],
                                    ['label' => 'Field of View', 'value' => 'Edge-to-Edge'],
                                    ['label' => 'Customization', 'value' => 'Tailored Optics']
                                ],
                                'highlight_title' => 'Precision Surfacing',
                                'highlight_desc' => 'CNC manufacturing carve prescription to 1/100th of a diopter accuracy.'
                            ]
                        ],
                        [
                            'name' => 'Polarized',
                            'image' => 'images/variants/polarized.avif',
                            'icon_type' => 'polarized',
                            'description' => 'Blocks intense horizontal glare for bright light.',
                            'details' => [
                                'summary' => 'Ultimate glare elimination for the brightest conditions.',
                                'benefits' => [
                                    'Visual Comfort: Reduces glare in brightest sun',
                                    'Driving Safety: Removes reflections from roads',
                                    'True Colors: Accurate outdoor color perception',
                                    'Eye Relaxation: Drastically reduces squinting'
                                ],
                                'specs' => [
                                    ['label' => 'Filter Type', 'value' => 'Polyvinyl Alcohol Film'],
                                    ['label' => 'Glare Reduction', 'value' => 'Up to 99.9%'],
                                    ['label' => 'Contrast', 'value' => 'Premium Outdoor Detail'],
                                    ['label' => 'Ideal For', 'value' => 'Water, Snow, & Driving']
                                ],
                                'highlight_title' => 'Light Polarization',
                                'highlight_desc' => 'Acts like a window blind, blocking horizontal glare while letting vertical light through.'
                            ]
                        ],
                        [
                            'name' => 'HMC (Antiglare)',
                            'image' => 'images/variants/hmc.avif',
                            'icon_type' => 'hmc',
                            'description' => 'Neutralizes light waves using oxide layers.',
                            'details' => [
                                'summary' => 'Reduces reflections for both the wearer and others.',
                                'benefits' => [
                                    'Night Safety: Reduces halos around headlights',
                                    'Invisible Look: People see your eyes clearly',
                                    'Crisper View: Sharpens vision by reducing ghost images',
                                    'Cosmetic Appeal: Eliminates distracting lens glare'
                                ],
                                'specs' => [
                                    ['label' => 'Light Transmission', 'value' => 'Up to 99%'],
                                    ['label' => 'Technology', 'value' => 'Vacuum Metallic Oxides'],
                                    ['label' => 'Reflection Loss', 'value' => 'Reduced to < 1%'],
                                    ['label' => 'Effect', 'value' => 'Anti-Reflective Purger']
                                ],
                                'highlight_title' => 'Destructive Interference',
                                'highlight_desc' => 'Multiple layers neutralize light waves for maximum transmission.'
                            ]
                        ],
                    ]
                ]),
                'image' => 'images/single-vision.avif',
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
                'image' => 'images/kryptok-bi-focal1.avif',
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
                'image' => 'images/bifocal-lens.avif',
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
