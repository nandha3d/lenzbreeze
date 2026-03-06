<?php

namespace Database\Seeders;

use App\Models\Retailer;
use App\Models\Warranty;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class WarrantySeeder extends Seeder
{
    public function run(): void
    {
        // Create retailers
        $retailers = [
            [
                'name' => 'Vision Plus Opticals',
                'owner_name' => 'Rajesh Kumar',
                'phone' => '9876543210',
                'address' => '45, MG Road, Near City Center',
                'city' => 'Coimbatore',
                'state' => 'Tamil Nadu',
            ],
            [
                'name' => 'Clear Sight Eye Care',
                'owner_name' => 'Priya Sharma',
                'phone' => '9876543211',
                'address' => '12, Anna Salai, T. Nagar',
                'city' => 'Chennai',
                'state' => 'Tamil Nadu',
            ],
            [
                'name' => 'Lens World',
                'owner_name' => 'Arun Mehta',
                'phone' => '9876543212',
                'address' => '78, Commercial Street',
                'city' => 'Bangalore',
                'state' => 'Karnataka',
            ],
            [
                'name' => 'Optic Gallery',
                'owner_name' => 'Deepa Nair',
                'phone' => '9876543213',
                'address' => '23, MG Road, Ernakulam',
                'city' => 'Kochi',
                'state' => 'Kerala',
            ],
            [
                'name' => 'Specs Hub',
                'owner_name' => 'Vijay Rajan',
                'phone' => '9876543214',
                'address' => '56, Race Course Road',
                'city' => 'Madurai',
                'state' => 'Tamil Nadu',
            ],
        ];

        $retailerModels = [];
        foreach ($retailers as $retailer) {
            $retailerModels[] = Retailer::create($retailer);
        }

        // Create sample warranties
        $warranties = [
            [
                'serial_number' => 'LB-DEMO0001',
                'product_name' => 'EYE MEK Polarized Single Vision',
                'customer_name' => 'Anand Krishnan',
                'customer_phone' => '9898989801',
                'customer_email' => 'anand@example.com',
                'customer_address' => '12, Lake View Road, RS Puram, Coimbatore 641002',
                'retailer_id' => $retailerModels[0]->id,
                'retailer_name' => $retailerModels[0]->name,
                'right_eye_sph' => -2.50, 'right_eye_cyl' => -0.75, 'right_eye_axis' => 90, 'right_eye_add' => 0,
                'left_eye_sph' => -3.00, 'left_eye_cyl' => -0.50, 'left_eye_axis' => 85, 'left_eye_add' => 0,
                'pupillary_distance' => 64.0,
                'lens_type' => 'Single Vision',
                'lens_coating' => 'Anti-Glare + Blue Cut',
                'lens_index' => '1.67',
                'manufacturing_date' => Carbon::now()->subMonths(2),
                'batch_number' => 'BATCH-2026-001',
                'purchase_date' => Carbon::now()->subMonth(),
                'warranty_months' => 12,
                'expiry_date' => Carbon::now()->addMonths(11),
                'status' => 'active',
            ],
            [
                'serial_number' => 'LB-DEMO0002',
                'product_name' => 'EYE MEK Progressive HD',
                'customer_name' => 'Lakshmi Venkatesh',
                'customer_phone' => '9898989802',
                'customer_email' => 'lakshmi@example.com',
                'customer_address' => '34, Besant Nagar, Chennai 600090',
                'retailer_id' => $retailerModels[1]->id,
                'retailer_name' => $retailerModels[1]->name,
                'right_eye_sph' => -1.25, 'right_eye_cyl' => -0.50, 'right_eye_axis' => 170, 'right_eye_add' => 2.00,
                'left_eye_sph' => -1.50, 'left_eye_cyl' => -0.25, 'left_eye_axis' => 10, 'left_eye_add' => 2.00,
                'pupillary_distance' => 62.5,
                'lens_type' => 'Progressive',
                'lens_coating' => 'Photochromic',
                'lens_index' => '1.60',
                'manufacturing_date' => Carbon::now()->subMonths(6),
                'batch_number' => 'BATCH-2025-089',
                'purchase_date' => Carbon::now()->subMonths(5),
                'warranty_months' => 24,
                'expiry_date' => Carbon::now()->addMonths(19),
                'status' => 'active',
            ],
            [
                'serial_number' => 'LB-DEMO0003',
                'product_name' => 'EYE MEK Bifocal',
                'customer_name' => 'Suresh Babu',
                'customer_phone' => '9898989803',
                'customer_address' => '67, Jayanagar, Bangalore 560041',
                'retailer_id' => $retailerModels[2]->id,
                'retailer_name' => $retailerModels[2]->name,
                'right_eye_sph' => 0.50, 'right_eye_cyl' => -1.00, 'right_eye_axis' => 45, 'right_eye_add' => 1.50,
                'left_eye_sph' => 0.75, 'left_eye_cyl' => -0.75, 'left_eye_axis' => 135, 'left_eye_add' => 1.50,
                'pupillary_distance' => 66.0,
                'lens_type' => 'Bifocal',
                'lens_coating' => 'HMC Green',
                'lens_index' => '1.56',
                'manufacturing_date' => Carbon::now()->subYear(),
                'purchase_date' => Carbon::now()->subMonths(11),
                'warranty_months' => 12,
                'expiry_date' => Carbon::now()->subMonth(),
                'status' => 'expired',
            ],
            [
                'serial_number' => 'LB-DEMO0004',
                'product_name' => 'EYE MEK Drive X Progressive',
                'customer_name' => 'Meena Rajan',
                'customer_phone' => '9898989804',
                'customer_email' => 'meena@example.com',
                'customer_address' => '89, Marine Drive, Kochi 682031',
                'retailer_id' => $retailerModels[3]->id,
                'retailer_name' => $retailerModels[3]->name,
                'right_eye_sph' => -4.00, 'right_eye_cyl' => -1.50, 'right_eye_axis' => 100, 'right_eye_add' => 2.50,
                'left_eye_sph' => -3.75, 'left_eye_cyl' => -1.25, 'left_eye_axis' => 80, 'left_eye_add' => 2.50,
                'pupillary_distance' => 63.0,
                'lens_type' => 'Progressive',
                'lens_coating' => 'Polarized + Blue Cut',
                'lens_index' => '1.74',
                'manufacturing_date' => Carbon::now()->subMonths(3),
                'purchase_date' => Carbon::now()->subMonths(2),
                'warranty_months' => 12,
                'expiry_date' => Carbon::now()->addMonths(10),
                'status' => 'under_claim',
                'claim_date' => Carbon::now()->subDays(5),
                'claim_notes' => 'Customer reports coating peeling on left lens edge after 2 months of use.',
            ],
            [
                'serial_number' => 'LB-DEMO0005',
                'product_name' => 'EYE MEK Single Vision',
                'customer_name' => 'Karthik Sundaram',
                'customer_phone' => '9898989805',
                'customer_address' => '12, KK Nagar, Madurai 625020',
                'retailer_id' => $retailerModels[4]->id,
                'retailer_name' => $retailerModels[4]->name,
                'right_eye_sph' => -5.50, 'right_eye_cyl' => -2.00, 'right_eye_axis' => 175, 'right_eye_add' => 0,
                'left_eye_sph' => -5.25, 'left_eye_cyl' => -1.75, 'left_eye_axis' => 5, 'left_eye_add' => 0,
                'pupillary_distance' => 65.5,
                'lens_type' => 'Single Vision',
                'lens_coating' => 'Anti-Glare',
                'lens_index' => '1.67',
                'manufacturing_date' => Carbon::now()->subMonths(4),
                'purchase_date' => Carbon::now()->subMonths(3),
                'warranty_months' => 6,
                'expiry_date' => Carbon::now()->addMonths(3),
                'status' => 'active',
            ],
        ];

        foreach ($warranties as $warranty) {
            Warranty::create($warranty);
        }
    }
}
