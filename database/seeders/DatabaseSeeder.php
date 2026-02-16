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
        ];

        foreach ($categories as $cat) {
            ProductCategory::updateOrCreate(['slug' => $cat['slug']], $cat);
        }

        // Products - Lenz Breeze Brand
        $products = [
            [
                'category_id' => 1, 'brand' => 'Lenz Breeze', 'name' => 'ClearView SV',
                'slug' => 'clearview-sv', 'tagline' => 'Crystal clarity, everyday comfort',
                'description' => 'The ClearView SV is our flagship single vision lens, crafted with premium optical-grade materials for unmatched clarity. Featuring our proprietary HydroShield coating, it repels water, oil, and dust while maintaining a pristine surface throughout the day.',
                'features' => ['HydroShield Coating', 'UV400 Protection', 'Scratch Resistant', 'Anti-Static', 'Easy to Clean'],
                'specifications' => ['Material' => 'CR-39 / Polycarbonate', 'Refractive Index' => '1.56 / 1.61 / 1.67', 'Coating' => 'Multi-Layer AR + HydroShield', 'UV Protection' => 'UV400', 'Abbe Value' => '32-42'],
                'technologies' => ['Anti-Glare', 'UV Protection'],
                'is_featured' => true, 'display_order' => 1,
            ],
            [
                'category_id' => 2, 'brand' => 'Lenz Breeze', 'name' => 'ProVision HD',
                'slug' => 'provision-hd', 'tagline' => 'See life without limits',
                'description' => 'The ProVision HD progressive lens uses advanced free-form digital surfacing technology to deliver wider corridors and smoother transitions between distance, intermediate, and near zones. Perfect for professionals and active lifestyles.',
                'features' => ['Free-Form Digital Design', 'Wide Reading Zone', 'Smooth Transitions', 'Personalized Fitting', 'Reduced Swim Effect'],
                'specifications' => ['Material' => 'MR-8 / MR-7', 'Refractive Index' => '1.60 / 1.67 / 1.74', 'Design' => 'Digital Free-Form', 'Corridor Length' => '14mm / 17mm', 'Fitting Height' => 'Min 16mm'],
                'technologies' => ['Progressive', 'Anti-Glare'],
                'is_featured' => true, 'display_order' => 2,
            ],
            [
                'category_id' => 3, 'brand' => 'Lenz Breeze', 'name' => 'DigiShield Pro',
                'slug' => 'digishield-pro', 'tagline' => 'Your digital eye armor',
                'description' => 'DigiShield Pro lenses are engineered for the digital age. Our triple-layer blue light filter blocks up to 42% of harmful blue-violet light (380-455nm) while maintaining true color perception — no yellowish tint.',
                'features' => ['42% Blue Light Block', 'True Color Vision', 'Anti-Fatigue Design', 'EMI Shield', 'Oleophobic Coating'],
                'specifications' => ['Material' => 'NK-55 / Polycarbonate', 'Blue Cut Range' => '380-455nm', 'Block Rate' => '42%', 'Color Distortion' => 'Less than 3%', 'Available In' => 'SV / Progressive / Bifocal'],
                'technologies' => ['Blue Cut', 'Anti-Glare'],
                'is_featured' => true, 'display_order' => 3,
            ],
            [
                'category_id' => 4, 'brand' => 'Lenz Breeze', 'name' => 'AdaptLens Ultra',
                'slug' => 'adaptlens-ultra', 'tagline' => 'Adapts to your world',
                'description' => 'AdaptLens Ultra photochromic lenses featuring Gen-8 photochromic molecules activate in under 30 seconds and fade back in under 5 minutes. Works even behind car windshields thanks to our dual-activation technology.',
                'features' => ['30s Activation', '5min Fade-Back', 'Works Behind Windshield', 'Temperature Stable', 'Category 0-3 Darkness'],
                'specifications' => ['Material' => 'Polycarbonate / MR-8', 'Activation Speed' => '<30 seconds', 'Fade-Back' => '<5 minutes', 'Max Darkness' => 'Category 3 (85%)', 'Indoor Clarity' => '95% Light Transmission'],
                'technologies' => ['Photochromic', 'UV Protection'],
                'is_featured' => true, 'display_order' => 4,
            ],
            // EYE MEK Brand Products
            [
                'category_id' => 5, 'brand' => 'EYE MEK', 'name' => 'Polarized Single Vision',
                'slug' => 'polarized-single-vision', 'tagline' => 'Designed for those who demand ultimate clarity in the great outdoors.',
                'description' => 'The Eye Mek Polarized Single Vision lenses are engineered for the ultimate outdoor experience. By eliminating 99.9% of reflective glare from water, roads, and snow, these lenses provide unmatched visual comfort and safety.',
                'features' => [
                    'Advanced Polarization: Eliminates 99.9% of reflective glare.',
                    'True Color Perception: Enhanced contrast without distortion.',
                    'UV400 Protection: Full-spectrum defense against UVA/UVB.',
                    'Impact Resistance: Durable material for active lifestyles.'
                ],
                'specifications' => ['Material' => 'Polycarbonate / TAC', 'Polarizing Efficiency' => '99.9%', 'UV Protection' => 'UV400', 'Impact Resistance' => 'ANSI Z87.1'],
                'technologies' => ['Polarized', 'UV Protection'],
                'is_featured' => true, 'display_order' => 1,
            ],
            [
                'category_id' => 4, 'brand' => 'EYE MEK', 'name' => 'Progressive Photochromic',
                'slug' => 'progressive-photochromic', 'tagline' => 'The Lens That Thinks for You.',
                'description' => 'From the boardroom to the beach, Eye Mek Progressive Photochromic lenses adapt instantly to your environment. No more switching frames—just seamless, high-definition vision that darkens in seconds when you step outside.',
                'features' => [
                    'Seamless Multifocal: Clear vision at near, mid, and far.',
                    'Rapid Activation: Darkens in under 30 seconds.',
                    'Easy Adaptation: Smooth, fluid, and natural transitions.',
                    'Blue Light Shield: Built-in digital protection indoors.',
                    'Total UV Defense: Blocks 100% of harmful rays.'
                ],
                'specifications' => ['Material' => 'MR-8 / High Index', 'Design' => 'Digital Free-Form', 'Activation' => '< 30s', 'Fade-Back' => '< 5m'],
                'technologies' => ['Progressive', 'Photochromic', 'Blue Cut'],
                'is_featured' => true, 'display_order' => 2,
            ],
            [
                'category_id' => 6, 'brand' => 'EYE MEK', 'name' => 'CrystalCoat AR',
                'slug' => 'crystalcoat-ar', 'tagline' => 'See the difference clearly',
                'description' => 'CrystalCoat AR features a 7-layer anti-reflective coating stack that reduces surface reflections to less than 0.5%, providing the clearest vision possible. Enhanced with our DuraGuard top coat for lasting protection.',
                'features' => ['7-Layer AR Stack', '<0.5% Reflection', 'DuraGuard Top Coat', 'Anti-Static', 'Night Driving Optimized'],
                'specifications' => ['Material' => 'CR-39 / MR-8', 'AR Layers' => '7 Layers', 'Residual Reflection' => '<0.5%', 'Hardness' => '5H Pencil Test', 'Coating Warranty' => '2 Years'],
                'technologies' => ['Anti-Glare'],
                'is_featured' => false, 'display_order' => 6,
            ],
            [
                'category_id' => 1, 'brand' => 'EYE MEK', 'name' => 'EcoVision Green',
                'slug' => 'ecovision-green', 'tagline' => 'See green, live green',
                'description' => 'EcoVision Green lenses are manufactured using our sustainable production process with bio-based materials. Same optical quality, lower carbon footprint.',
                'features' => ['Bio-Based Materials', 'Carbon Neutral Production', 'Full UV Protection', 'Super Hydrophobic', 'Recyclable Packaging'],
                'specifications' => ['Material' => 'Bio-based Resin', 'Refractive Index' => '1.56', 'UV Protection' => 'UV400', 'Certification' => 'ISO 14001', 'Carbon Offset' => '100%'],
                'technologies' => ['UV Protection', 'Anti-Glare'],
                'is_featured' => false, 'display_order' => 7,
            ],
            [
                'category_id' => 3, 'brand' => 'EYE MEK', 'name' => 'ScreenGuard Plus',
                'slug' => 'screenguard-plus', 'tagline' => 'Work smarter, see better',
                'description' => 'ScreenGuard Plus combines blue cut technology with an occupational lens design optimized for near and intermediate distances — perfect for office workers and gamers.',
                'features' => ['Blue Cut + Occupational', 'Optimized for 40-100cm', 'Anti-Fatigue Zone', 'Low Color Shift', 'Gaming Ready'],
                'specifications' => ['Material' => 'MR-8', 'Blue Block' => '38%', 'Design' => 'Occupational Progressive', 'Near Zone Width' => 'Extra Wide', 'Color Accuracy' => '97%'],
                'technologies' => ['Blue Cut', 'Anti-Glare', 'Progressive'],
                'is_featured' => false, 'display_order' => 8,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(['slug' => $product['slug']], $product);
        }

        // Pages
        Page::updateOrCreate(
            ['slug' => 'privacy-policy'],
            [
                'title' => 'Privacy Policy',
                'content' => '<h2>Privacy Policy</h2><p>Last updated: ' . now()->format('F Y') . '</p><p>Lenz Breeze Optical Pvt. Ltd. ("we", "our", "us") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, and safeguard your information when you visit our website.</p><h3>Information We Collect</h3><p>We collect information you provide directly, such as your name, email address, phone number, and company name when you fill out our contact form or subscribe to our newsletter.</p><h3>How We Use Your Information</h3><p>We use the information to respond to your inquiries, send newsletter updates (with your consent), improve our website, and comply with legal obligations.</p><h3>Contact Us</h3><p>If you have any questions about this Privacy Policy, please contact us at info@lenzbreeze.com.</p>',
            ]
        );

        Page::updateOrCreate(
            ['slug' => 'terms-conditions'],
            [
                'title' => 'Terms & Conditions',
                'content' => '<h2>Terms & Conditions</h2><p>Last updated: ' . now()->format('F Y') . '</p><p>Welcome to Lenz Breeze. By accessing and using this website, you agree to comply with these Terms & Conditions.</p><h3>Use of Website</h3><p>This website is for informational purposes only. Product information, specifications, and images are provided as-is and may change without notice.</p><h3>Intellectual Property</h3><p>All content, logos, and trademarks on this website are the property of Lenz Breeze Optical Pvt. Ltd. Unauthorized use is prohibited.</p><h3>Limitation of Liability</h3><p>We make no warranties regarding the accuracy of information on this website. Use of information is at your own risk.</p>',
            ]
        );

        // Settings
        $settings = [
            'company_name' => 'Lenz Breeze Optical Pvt. Ltd.',
            'company_email' => 'info@lenzbreeze.com',
            'company_phone' => '+91 471 234 5678',
            'company_whatsapp' => '914712345678',
            'address_trivandrum' => 'TC 25/1234, Industrial Estate, Kazhakkoottam, Trivandrum, Kerala 695582',
            'address_kochi' => 'Door No. 12/456, Kakkanad Industrial Area, Kochi, Kerala 682030',
            'address_chennai' => 'Plot 45, SIDCO Industrial Estate, Ambattur, Chennai, Tamil Nadu 600098',
            'address_delhi' => 'B-23, Sector 63, Noida, Uttar Pradesh 201301',
            'social_facebook' => 'https://facebook.com/lenzbreeze',
            'social_instagram' => 'https://instagram.com/lenzbreeze',
            'social_linkedin' => 'https://linkedin.com/company/lenzbreeze',
            'social_youtube' => 'https://youtube.com/@lenzbreeze',
        ];

        foreach ($settings as $key => $value) {
            Setting::set($key, $value);
        }
    }
}
