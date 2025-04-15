<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ShieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin']);
        $theaterManagerRole = Role::firstOrCreate(['name' => 'theater_manager']);
        $customerRole = Role::firstOrCreate(['name' => 'customer']);

        $permissions = [
            'view_user', 'view_any_user', 'create_user', 'update_user', 'delete_user', 'delete_any_user',
            'view_movie', 'view_any_movie', 'create_movie', 'update_movie', 'delete_movie', 'delete_any_movie',
            'view_theater', 'view_any_theater', 'create_theater', 'update_theater', 'delete_theater', 'delete_any_theater',
            'view_screen', 'view_any_screen', 'create_screen', 'update_screen', 'delete_screen', 'delete_any_screen',
            'view_seat', 'view_any_seat', 'create_seat', 'update_seat', 'delete_seat', 'delete_any_seat',
            'view_showtime', 'view_any_showtime', 'create_showtime', 'update_showtime', 'delete_showtime', 'delete_any_showtime',
            'view_booking', 'view_any_booking', 'create_booking', 'update_booking', 'delete_booking', 'delete_any_booking',
            'view_booking::seat', 'view_any_booking::seat', 'create_booking::seat', 'update_booking::seat', 'delete_booking::seat', 'delete_any_booking::seat',
            'view_payment', 'view_any_payment', 'create_payment', 'update_payment', 'delete_payment', 'delete_any_payment',
            'view_coupon', 'view_any_coupon', 'create_coupon', 'update_coupon', 'delete_coupon', 'delete_any_coupon',
            'page_Profile', 'widget_CustomAccountWidget',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $superAdminRole->syncPermissions($permissions);

        $theaterManagerPermissions = [
            'view_user', 'view_any_user',
            'view_movie', 'view_any_movie', 'create_movie', 'update_movie', 'delete_movie', 'delete_any_movie',
            'view_theater', 'view_any_theater', 'update_theater',
            'view_screen', 'view_any_screen', 'create_screen', 'update_screen', 'delete_screen', 'delete_any_screen',
            'view_seat', 'view_any_seat', 'create_seat', 'update_seat', 'delete_seat', 'delete_any_seat',
            'view_showtime', 'view_any_showtime', 'create_showtime', 'update_showtime', 'delete_showtime', 'delete_any_showtime',
            'view_booking', 'view_any_booking', 'create_booking', 'update_booking', 'delete_booking', 'delete_any_booking',
            'view_booking::seat', 'view_any_booking::seat', 'create_booking::seat', 'update_booking::seat', 'delete_booking::seat', 'delete_any_booking::seat',
            'view_payment', 'view_any_payment', 'create_payment', 'update_payment', 'delete_payment', 'delete_any_payment',
            'view_coupon', 'view_any_coupon', 'create_coupon', 'update_coupon', 'delete_coupon', 'delete_any_coupon',
            'page_Profile', 'widget_CustomAccountWidget',
        ];
        $theaterManagerRole->syncPermissions($theaterManagerPermissions);

        $customerPermissions = [
            'view_movie', 'view_any_movie',
            'view_theater', 'view_any_theater',
            'view_screen', 'view_any_screen',
            'view_seat', 'view_any_seat',
            'view_showtime', 'view_any_showtime',
            'view_booking', 'view_any_booking', 'create_booking', 'update_booking',
            'view_booking::seat', 'view_any_booking::seat', 'create_booking::seat', 'update_booking::seat',
            'view_payment', 'view_any_payment', 'create_payment',
            'view_coupon', 'view_any_coupon',
            'page_Profile', 'widget_CustomAccountWidget',
        ];
        $customerRole->syncPermissions($customerPermissions);
    }
}
