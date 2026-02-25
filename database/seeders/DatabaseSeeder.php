<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::updateOrCreate(
            ['email' => 'admin@lenzbreeze.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        // Product Categories
        $categories = [
            ['name' => 'Single Vision Lenses', 'slug' => 'single-vision', 'description' => 'Clear vision for everyday use, available in multiple coatings and materials.', 'display_order' => 1],
            ['name' => 'Progressive Lenses', 'slug' => 'progressive', 'description' => 'Seamless transition from distance to near vision, designed for modern lifestyles.', 'display_order' => 2],
            ['name' => 'Blue Cut Lenses', 'slug' => 'blue-cut', 'description' => 'Advanced blue light filtering technology to protect your eyes from digital screens.', 'display_order' => 3],
            ['name' => 'Photochromic Lenses', 'slug' => 'photochromic', 'description' => 'Lenses that adapt to changing light conditions — clear indoors, tinted outdoors.', 'display_order' => 4],
            ['name' => 'Polarized Lenses', 'slug' => 'polarized', 'description' => 'Superior glare reduction for driving, water sports, and outdoor activities.', 'display_order' => 5],
            ['name' => 'Anti-Glare Lenses', 'slug' => 'anti-glare', 'description' => 'Multi-layer anti-reflective coating for crystal-clear vision and reduced eye strain.', 'display_order' => 6],
            ['name' => 'Bifocal Lenses', 'slug' => 'bifocal', 'description' => 'Double-vision lenses for distance and near reading in one lens.', 'display_order' => 7],
        ];

        foreach ($categories as $cat) {
            ProductCategory::updateOrCreate(['slug' => $cat['slug']], $cat);
        }

        // Clear existing products
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        Product::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        // Technical Data Structures
        $data_cr39 = [
            'summary' => 'CR-39 (Columbia Resin #39) is the industry standard for "plastic" eyeglass lenses, providing a lightweight, shatter-resistant alternative to glass.',
            'highlight_title' => 'Thermoset Durability',
            'highlight_desc' => 'Unlike some plastics, CR-39 is a "thermoset" material, meaning it won\'t melt or warp easily under high heat and is resistant to most household chemicals.',
            'specs' => [
                ['label' => 'Material', 'value' => 'Allyl Diglycol Carbonate (ADC)'],
                ['label' => 'Refractive Index', 'value' => '1.498 (Standard Index)'],
                ['label' => 'Abbe Value', 'value' => '58 (Highest optical clarity)'],
                ['label' => 'Specific Gravity', 'value' => '1.32 (Roughly half the weight of glass)'],
            ],
            'benefits' => [
                'Superior Optics: High Abbe value means very low chromatic aberration for blur-free edges.',
                'Affordability: The most budget-friendly premium lens material currently available.',
                'Lightweight: About 50% lighter than glass, making it comfortable for all-day wear.',
                'Exceptional Tinting: Porous enough to absorb dyes easily for custom fashion gradients.',
            ]
        ];

        $data_hard_coat = [
            'summary' => 'A clear, durable protection layer applied to extend the lifespan of your lenses by resisting daily abrasions.',
            'highlight_title' => 'Polysiloxane Barrier',
            'highlight_desc' => 'Our hard coat is a clear, durable layer applied by dipping the lens and curing it with UV light to form a tough shield against scratches.',
            'specs' => [
                ['label' => 'Base Treatment', 'value' => 'Polysiloxane Dip/Spin Coat'],
                ['label' => 'Durability', 'value' => 'High Scratch Resistance'],
                ['label' => 'Visibility', 'value' => '100% Optically Clear'],
                ['label' => 'Foundation', 'value' => 'Required for Anti-Glare (ARC)'],
            ],
            'benefits' => [
                'Extended Lifespan: Resists daily abrasions from wiping with microfiber cloths.',
                'Surface Integrity: Prevents fine hairline scratches that cause hazy vision over time.',
                'Smooth Finish: Creates a perfectly flat foundation for secondary high-tech coatings.',
            ]
        ];

        $data_photochromic = [
            'summary' => 'Light-adaptive lenses that change their tint automatically based on ultraviolet (UV) light exposure.',
            'highlight_title' => 'Molecule Adaptation',
            'highlight_desc' => 'Lenses contain millions of light-sensitive molecules (like naphthopyrans) that undergo structural change when exposed to UV, absorbing visible light.',
            'specs' => [
                ['label' => 'Technology', 'value' => 'Naphthopyran Molecular Transition'],
                ['label' => 'Activation', 'value' => 'Rapid Darkening (Sunlight)'],
                ['label' => 'Deactivation', 'value' => 'Fades back to Clear (Indoors)'],
                ['label' => 'Protection', 'value' => '100% UVA & UVB Blockage'],
            ],
            'benefits' => [
                '2-in-1 Convenience: Eliminates the need to carry separate prescription sunglasses.',
                'Reduced Fatigue: Less squinting and eye strain when moving between lighting conditions.',
                'UV Shield: Provides constant protection against harmful atmospheric solar radiation.',
            ]
        ];

        $data_blue_cut = [
            'summary' => 'Designed to protect eyes from digital strain by filtering high-energy visible (HEV) blue light from screens.',
            'highlight_title' => 'Blue Light Shield',
            'highlight_desc' => 'Filters blue light (380nm–450nm) via a specialized surface reflective coating or a monomer absorber mixed directly into the lens.',
            'specs' => [
                ['label' => 'Filtering Range', 'value' => '380nm – 450nm (HEV Blue Light)'],
                ['label' => 'Method', 'value' => 'Monomer Absorption / Surface Reflection'],
                ['label' => 'Residual Tint', 'value' => 'Very slight warm/yellowish tone'],
                ['label' => 'Clarity', 'value' => 'High Definition Digital Viewing'],
            ],
            'benefits' => [
                'Screen Comfort: Reduces dry eyes and headaches from prolonged computer or gaming use.',
                'Sleep Support: Preserves natural circadian rhythms by reducing nighttime blue light.',
                'Sharp Contrast: Enhances visual comfort when reading small text on digital displays.',
            ]
        ];

        $data_hd_digital = [
            'summary' => 'Representing a massive leap in precision, these lenses move from mechanical grinding to 3D computer-aided laser surfacing.',
            'highlight_title' => 'Precision Surfacing',
            'highlight_desc' => 'Manufactured using CNC surfacing, carving the prescription onto the back of the lens accurately to 1/100th of a diopter.',
            'specs' => [
                ['label' => 'Manufacturing', 'value' => 'Freeform 3D Digital Surfacing'],
                ['label' => 'Precision', 'value' => '1/100th Diopter Accuracy'],
                ['label' => 'Field of View', 'value' => 'Wide, Edge-to-Edge Clarity'],
                ['label' => 'Customization', 'value' => 'Point-by-Point Tailored Optics'],
            ],
            'benefits' => [
                'Maximum Clarity: Deeply crisp vision across the entire lens surface.',
                'Zero Distortion: Eliminates the "swim" effect and peripheral blurriness.',
                'Sharper Contrast: Provides brighter, high-definition vision in all conditions.',
            ]
        ];

        $data_polarized = [
            'summary' => 'The gold standard for bright light, using microscopic vertical filters to block intense horizontal glare.',
            'highlight_title' => 'Light Polarization',
            'highlight_desc' => 'Acts like a window blind, allowing useful vertical light in while completely blocking horizontal glare from reflective surfaces.',
            'specs' => [
                ['label' => 'Filter Type', 'value' => 'Micro-Aligned Polyvinyl Alcohol Film'],
                ['label' => 'Glare Reduction', 'value' => 'Up to 99.9% Horizontal Glare removal'],
                ['label' => 'Outdoor Performance', 'value' => 'Premium Contrast & Detail'],
                ['label' => 'Environment', 'value' => 'Ideal for Water, Snow, and Wet Roads'],
            ],
            'benefits' => [
                'Visual Comfort: Drastically reduces blinding glare in bright midday sun.',
                'Driving Safety: Removes intense reflections from wet roads and car hoods.',
                'True Colors: Delivers more accurate color perception than standard tinted lenses.',
            ]
        ];

        $data_hmc = [
            'summary' => 'Crucial for visual clarity, HMC uses microscopic oxide layers to neutralize light waves bouncing off the lens surface.',
            'highlight_title' => 'Destructive Interference',
            'highlight_desc' => 'Metallic oxide layers (titanium/silicon) are applied in a vacuum to neutralize light waves, allowing more light through.',
            'specs' => [
                ['label' => 'Light Transmission', 'value' => 'Up to 99% Through-put (Sharper Vision)'],
                ['label' => 'Technology', 'value' => 'Vacuum-layered Metallic Oxides'],
                ['label' => 'Aesthetic Colour', 'value' => 'Emerald Green or Sapphire Blue reflection'],
                ['label' => 'Reflection Loss', 'value' => 'Reduced from 8-10% down to less than 1%'],
            ],
            'benefits' => [
                'Night Safety: Drastically reduces halos around headlights and streetlights.',
                'Invisible Look: People see your eyes clearly instead of a distracting reflection.',
                'Crisper View: Sharpens vision by eliminating internal "ghost images" and haze.',
            ]
        ];

        // Products
        $products = [
            [
                'category_id' => 2, 'brand' => 'EYE MEK', 'name' => 'Eye Mek Premium Progressive RX',
                'slug' => 'premium-progressive-rx', 'tagline' => 'Seamless Sight. Absolute Protection.',
                'image' => 'images/progressive-lens3.jpeg',
                'gallery' => ['images/progressive-lens3.jpeg', 'images/products/premium-progressive-rx-tech.jpg'],
                'description' => '<span class="block text-xl font-bold text-brand-600 mb-3">High-Performance Optics. 🚀</span> EYE MEK Progressive line, the inclusion of Drive X and HD Digital technology moves this into the "High-Performance" category. Modern progressives often struggle with peripheral "swim" or glare while driving; EYE MEK highlights how these specific pain points are solved for a seamless experience.',
                'features' => [
                    'Drive X: Specialized filter to reduce night-time glare and sharpen road details.',
                    'HD Digital: Wider corridors and reduced "swim effect" for faster adaptation.',
                    'HMC: Choose Green for a natural look or Blue for a modern, tech-focused aesthetic.',
                    'Photochromic: Rapid darkening in Grey or Brown for 2-in-1 indoor/outdoor use.'
                ],
                'specifications' => [
                    'Material' => 'CR-39 / High Index',
                    'variants' => [
                        ['name' => 'CR 39 white', 'icon_type' => 'clear', 'image' => 'images/variants/cr-39.jpg', 'details' => $data_cr39],
                        ['name' => 'Uncoated', 'icon_type' => 'clear', 'image' => 'images/variants/cr-39.jpg', 'details' => array_merge($data_cr39, ['summary' => 'Pure lens material without external treatments.', 'details' => ['specs' => [['label' => 'Coating', 'value' => 'None']]]])],
                        ['name' => 'Hard Coat', 'icon_type' => 'clear', 'image' => 'images/variants/hard-coat.jpg', 'details' => $data_hard_coat],
                        ['name' => 'Photochromic', 'icon_type' => 'photochromic', 'image' => 'images/variants/photochromic.jpg', 'details' => array_merge($data_photochromic, ['summary' => 'Rapid darkening in Grey or Brown for 2-in-1 indoor/outdoor use.']), 'sub_variants' => ['Photo Grey', 'Photo Brown']],
                        ['name' => 'Blue cut', 'icon_type' => 'blue_cut', 'image' => 'images/variants/blu-cut.jpg', 'details' => $data_blue_cut],
                        ['name' => 'HD digital', 'icon_type' => 'blue_cut', 'image' => 'images/variants/hd.jpg', 'details' => array_merge($data_hd_digital, ['summary' => 'Wider corridors and reduced "swim effect" for faster adaptation.'])],
                        ['name' => 'Polarized', 'icon_type' => 'polarized', 'image' => 'images/variants/polarized.jpg', 'details' => $data_polarized],
                        ['name' => 'HMC (Antiglare)', 'icon_type' => 'antiglare', 'image' => 'images/variants/hmc.jpg', 'details' => array_merge($data_hmc, ['summary' => 'Choose Green for a natural look or Blue for a modern, tech-focused aesthetic.']), 'sub_variants' => ['Emerald Green ARC', 'Sapphire Blue ARC']],
                        ['name' => 'Drive x', 'icon_type' => 'drive', 'image' => 'images/variants/hmc.jpg', 'details' => array_merge($data_hmc, ['name' => 'Drive x', 'summary' => 'Specialized filter to reduce night-time glare and sharpen road details.'])],
                    ]
                ],
                'technologies' => ['Progressive', 'Photochromic', 'Blue Cut', 'Polarized', 'Anti-Glare'],
                'is_featured' => true, 'display_order' => 1,
            ],
            // Single Vision
            [
                'category_id' => 1, 'brand' => 'EYE MEK', 'name' => 'Eye Mek Single Vision',
                'slug' => 'single-vision-rx', 'tagline' => 'Your Vision, Upgraded.',
                'image' => 'images/single-vision.jpeg',
                'description' => '<span class="block text-xl font-bold text-brand-600 mb-3">Welcome to the next level of visual clarity.</span> EYE MEK isn\'t just a lens; it’s a premium vision solution tailored to your lifestyle. Whether you\'re navigating a digital workspace, driving under the sun, or looking for everyday durability, we have the perfect fit.<br><br>Here is a breakdown of the EYE MEK Single Vision (SV) collection, crafted for those who refuse to compromise on quality.',
                'features' => [
                    'Ultra-lightweight & crystal clear.',
                    'Enhanced durability & scratch resistance.',
                    'Seamlessly tints to Grey or Brown.',
                    'Filters harmful high-energy blue light.',
                    'Precision-surfaced for edge-to-edge clarity.',
                    'Eliminates blinding glare and reflections.',
                    'Available in Emerald Green or Sapphire Blue.'
                ],
                'specifications' => [
                    'Material' => 'CR-39 / Polycarbonate',
                    'variants' => [
                        ['name' => 'CR 39 white', 'icon_type' => 'clear', 'image' => 'images/variants/cr-39.jpg', 'details' => $data_cr39],
                        ['name' => 'Hard Coat', 'icon_type' => 'clear', 'image' => 'images/variants/hard-coat.jpg', 'details' => $data_hard_coat],
                        ['name' => 'Photochromic', 'icon_type' => 'photochromic', 'image' => 'images/variants/photochromic.jpg', 'details' => $data_photochromic, 'sub_variants' => ['Photo Grey', 'Photo Brown']],
                        ['name' => 'Blue cut', 'icon_type' => 'blue_cut', 'image' => 'images/variants/blu-cut.jpg', 'details' => $data_blue_cut],
                        ['name' => 'HD digital', 'icon_type' => 'blue_cut', 'image' => 'images/variants/hd.jpg', 'details' => $data_hd_digital],
                        ['name' => 'Polarized', 'icon_type' => 'polarized', 'image' => 'images/variants/polarized.jpg', 'details' => $data_polarized],
                        ['name' => 'HMC (Antiglare)', 'icon_type' => 'antiglare', 'image' => 'images/variants/hmc.jpg', 'details' => $data_hmc],
                    ]
                ],
                'technologies' => ['Anti-Glare', 'Blue Cut', 'Polarized', 'Photochromic'],
                'is_featured' => true, 'display_order' => 2,
            ],
            // Bifocals
            [
                'category_id' => 7, 'brand' => 'EYE MEK', 'name' => 'Kryptok Bifocal (KBF)',
                'slug' => 'kryptok-bifocals', 'tagline' => 'The Bifocal You Know.',
                'image' => 'images/kryptok-bi-focal1.jpg',
                'description' => 'See the world clearly—from the book in your hand to the view on the horizon. EYE MEK KBF lenses offer a seamless transition for your daily needs. Choose our Grey or Brown Photochromic options for effortless indoor-to-outdoor comfort. It’s the bifocal you know, with the premium protection you deserve.',
                'features' => [
                    'Kryptok Design: Distinct segments for instant near-and-far focus.',
                    'Blue Cut: Essential shielding for the modern digital era.',
                    'Photochromic: Smart light adaptation in Grey and Brown.',
                    'HMC (2 Types): Green for natural clarity; Blue for a modern look.',
                    'Lenticular KT: Specialized thin design for high-power prescriptions.',
                    'Hard Coat: Industrial-grade scratch resistance for daily longevity.'
                ],
                'specifications' => [
                    'Material' => 'CR-39 White',
                    'variants' => [
                        ['name' => 'CR 39 white', 'icon_type' => 'clear', 'image' => 'images/variants/cr-39.jpg', 'details' => $data_cr39],
                        ['name' => 'Hard Coat', 'icon_type' => 'clear', 'image' => 'images/variants/hard-coat.jpg', 'details' => $data_hard_coat],
                        ['name' => 'Photochromic', 'icon_type' => 'photochromic', 'image' => 'images/variants/photochromic.jpg', 'details' => $data_photochromic],
                        ['name' => 'Blue cut', 'icon_type' => 'blue_cut', 'image' => 'images/variants/blu-cut.jpg', 'details' => $data_blue_cut],
                        ['name' => 'HMC (Antiglare)', 'icon_type' => 'antiglare', 'image' => 'images/variants/hmc.jpg', 'details' => $data_hmc],
                    ]
                ],
                'technologies' => ['Bifocal', 'Photochromic', 'Anti-Glare'],
                'is_featured' => true, 'display_order' => 3,
            ],
            [
                'category_id' => 7, 'brand' => 'EYE MEK', 'name' => 'D-Bifocal / Flat Top BF (DBF)',
                'slug' => 'd-bifocal-lens', 'tagline' => 'Wide View. Sharp Focus.',
                'image' => 'images/bifocal-lens.jpeg',
                'description' => 'Tired of narrow reading zones? Step into the wide-angle view of EYE MEK DBF. Our Flat Top design provides an immediate, easy-to-find segment for near-vision, making it the perfect companion for everything from your morning newspaper to your evening hobbies. Lightweight, durable, and crystal clear—it’s the classic bifocal, perfected by EYE MEK.',
                'features' => [
                    'The "Easy-Adapt" Segment: The flat top makes it incredibly easy for first-time bifocal wearers to find their "sweet spot" for reading.',
                    'Edge-to-Edge Sharpness: By using premium CR-39, we ensure minimal chromatic aberration, meaning colors stay true and lines stay sharp.',
                    'Feather-Light Comfort: Optimized for all-day wear, reducing the pressure on the bridge of the nose.'
                ],
                'specifications' => [
                    'variants' => [
                        ['name' => 'CR 39 white', 'icon_type' => 'clear', 'details' => $data_cr39],
                        ['name' => 'Hard Coat', 'icon_type' => 'clear', 'details' => $data_hard_coat],
                        ['name' => 'HMC (Antiglare)', 'icon_type' => 'antiglare', 'details' => $data_hmc],
                    ]
                ],
                'technologies' => ['Bifocal'],
                'is_featured' => false, 'display_order' => 4,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(['slug' => $product['slug']], $product);
        }

        // Settings
        $settings = [
            'company_name' => 'Lenz Breeze Optical Pvt. Ltd.',
            'company_email' => 'info@lenzbreeze.com',
            'company_phone' => '+91 89211 65871',
            'address_trivandrum' => 'TC 81/781, Near Baba Tourist Home, Thampanoor, Thiruvananthapuram - 695 001',
            'address_kochi' => '34/1735(A1 & A2), Gokul Chambers, Kannanthodath Lane, Edappally, Cochin - 682024',
        ];

        foreach ($settings as $key => $value) {
            Setting::set($key, $value);
        }
    }
}
