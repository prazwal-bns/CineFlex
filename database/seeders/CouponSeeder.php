<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // Create sample coupons for testing
        $coupons = [
            [
                'code' => 'SAVE10',
                'description' => 'Save 10% on your movie tickets',
                'discount_type' => 'percentage',
                'percentage_discount' => 10.00,
                'fixed_discount' => null,
                'usage_limit' => 100,
                'times_used' => 0,
                'valid_from' => $now->copy()->subDays(7),
                'valid_until' => $now->copy()->addMonths(3),
                'is_active' => true,
            ],
            [
                'code' => 'SAVE20',
                'description' => 'Save 20% on your movie tickets',
                'discount_type' => 'percentage',
                'percentage_discount' => 20.00,
                'fixed_discount' => null,
                'usage_limit' => 50,
                'times_used' => 0,
                'valid_from' => $now->copy()->subDays(5),
                'valid_until' => $now->copy()->addMonths(2),
                'is_active' => true,
            ],
            [
                'code' => 'FLAT100',
                'description' => 'Get NPR 100 off on your booking',
                'discount_type' => 'fixed',
                'percentage_discount' => null,
                'fixed_discount' => 100.00,
                'usage_limit' => 25,
                'times_used' => 0,
                'valid_from' => $now->copy()->subDays(3),
                'valid_until' => $now->copy()->addMonths(1),
                'is_active' => true,
            ],
            [
                'code' => 'NEWUSER',
                'description' => 'Welcome offer for new users - 15% off',
                'discount_type' => 'percentage',
                'percentage_discount' => 15.00,
                'fixed_discount' => null,
                'usage_limit' => 200,
                'times_used' => 0,
                'valid_from' => $now->copy()->subDays(1),
                'valid_until' => $now->copy()->addMonths(6),
                'is_active' => true,
            ],
            [
                'code' => 'EXPIRED',
                'description' => 'This coupon has expired - for testing',
                'discount_type' => 'percentage',
                'percentage_discount' => 25.00,
                'fixed_discount' => null,
                'usage_limit' => 10,
                'times_used' => 0,
                'valid_from' => $now->copy()->subMonths(2),
                'valid_until' => $now->copy()->subDays(1),
                'is_active' => true,
            ],
            [
                'code' => 'INACTIVE',
                'description' => 'This coupon is inactive - for testing',
                'discount_type' => 'fixed',
                'percentage_discount' => null,
                'fixed_discount' => 50.00,
                'usage_limit' => 10,
                'times_used' => 0,
                'valid_from' => $now->copy()->subDays(1),
                'valid_until' => $now->copy()->addMonths(1),
                'is_active' => false,
            ],
        ];

        foreach ($coupons as $couponData) {
            Coupon::create($couponData);
        }

        $this->command->info('Sample coupons created successfully!');
        $this->command->info('Active coupons: SAVE10, SAVE20, FLAT100, NEWUSER');
        $this->command->info('Test coupons: EXPIRED (expired), INACTIVE (inactive)');
    }
}
