<?php
/**
 * File name: DemoPermissionsPermissionsTableSeeder.php
 * Last modified: 2020.05.04 at 09:04:19
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

use Illuminate\Database\Seeder;

class DemoPermissionsPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        //\DB::table('role_has_permissions')->delete();
        \DB::table('permissions')->delete();

        \DB::table('permissions')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'users.profile',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:02',
                    'updated_at' => '2020-03-29 14:58:02',
                    'deleted_at' => NULL,
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'dashboard',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:02',
                    'updated_at' => '2020-03-29 14:58:02',
                    'deleted_at' => NULL,
                ),
            2 =>
                array (
                    'id' => 3,
                    'name' => 'medias.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:02',
                    'updated_at' => '2020-03-29 14:58:02',
                    'deleted_at' => NULL,
                ),
            3 =>
                array (
                    'id' => 4,
                    'name' => 'medias.delete',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:02',
                    'updated_at' => '2020-03-29 14:58:02',
                    'deleted_at' => NULL,
                ),
            4 =>
                array (
                    'id' => 5,
                    'name' => 'medias',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:03',
                    'updated_at' => '2020-03-29 14:58:03',
                    'deleted_at' => NULL,
                ),
            5 =>
                array (
                    'id' => 6,
                    'name' => 'permissions.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:03',
                    'updated_at' => '2020-03-29 14:58:03',
                    'deleted_at' => NULL,
                ),
            6 =>
                array (
                    'id' => 7,
                    'name' => 'permissions.edit',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:03',
                    'updated_at' => '2020-03-29 14:58:03',
                    'deleted_at' => NULL,
                ),
            7 =>
                array (
                    'id' => 8,
                    'name' => 'permissions.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:03',
                    'updated_at' => '2020-03-29 14:58:03',
                    'deleted_at' => NULL,
                ),
            8 =>
                array (
                    'id' => 9,
                    'name' => 'permissions.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:03',
                    'updated_at' => '2020-03-29 14:58:03',
                    'deleted_at' => NULL,
                ),
            9 =>
                array (
                    'id' => 10,
                    'name' => 'roles.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:03',
                    'updated_at' => '2020-03-29 14:58:03',
                    'deleted_at' => NULL,
                ),
            10 =>
                array (
                    'id' => 11,
                    'name' => 'roles.edit',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:03',
                    'updated_at' => '2020-03-29 14:58:03',
                    'deleted_at' => NULL,
                ),
            11 =>
                array (
                    'id' => 12,
                    'name' => 'roles.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:03',
                    'updated_at' => '2020-03-29 14:58:03',
                    'deleted_at' => NULL,
                ),
            12 =>
                array (
                    'id' => 13,
                    'name' => 'roles.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:03',
                    'updated_at' => '2020-03-29 14:58:03',
                    'deleted_at' => NULL,
                ),
            13 =>
                array (
                    'id' => 14,
                    'name' => 'customFields.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:03',
                    'updated_at' => '2020-03-29 14:58:03',
                    'deleted_at' => NULL,
                ),
            14 =>
                array (
                    'id' => 15,
                    'name' => 'customFields.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:03',
                    'updated_at' => '2020-03-29 14:58:03',
                    'deleted_at' => NULL,
                ),
            15 =>
                array (
                    'id' => 16,
                    'name' => 'customFields.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:03',
                    'updated_at' => '2020-03-29 14:58:03',
                    'deleted_at' => NULL,
                ),
            16 =>
                array (
                    'id' => 17,
                    'name' => 'customFields.show',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:03',
                    'updated_at' => '2020-03-29 14:58:03',
                    'deleted_at' => NULL,
                ),
            17 =>
                array (
                    'id' => 18,
                    'name' => 'customFields.edit',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:03',
                    'updated_at' => '2020-03-29 14:58:03',
                    'deleted_at' => NULL,
                ),
            18 =>
                array (
                    'id' => 19,
                    'name' => 'customFields.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:04',
                    'updated_at' => '2020-03-29 14:58:04',
                    'deleted_at' => NULL,
                ),
            19 =>
                array (
                    'id' => 20,
                    'name' => 'customFields.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:04',
                    'updated_at' => '2020-03-29 14:58:04',
                    'deleted_at' => NULL,
                ),
            20 =>
                array (
                    'id' => 21,
                    'name' => 'users.login-as-user',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:04',
                    'updated_at' => '2020-03-29 14:58:04',
                    'deleted_at' => NULL,
                ),
            21 =>
                array (
                    'id' => 22,
                    'name' => 'users.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:04',
                    'updated_at' => '2020-03-29 14:58:04',
                    'deleted_at' => NULL,
                ),
            22 =>
                array (
                    'id' => 23,
                    'name' => 'users.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:04',
                    'updated_at' => '2020-03-29 14:58:04',
                    'deleted_at' => NULL,
                ),
            23 =>
                array (
                    'id' => 24,
                    'name' => 'users.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:04',
                    'updated_at' => '2020-03-29 14:58:04',
                    'deleted_at' => NULL,
                ),
            24 =>
                array (
                    'id' => 25,
                    'name' => 'users.show',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:04',
                    'updated_at' => '2020-03-29 14:58:04',
                    'deleted_at' => NULL,
                ),
            25 =>
                array (
                    'id' => 26,
                    'name' => 'users.edit',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:04',
                    'updated_at' => '2020-03-29 14:58:04',
                    'deleted_at' => NULL,
                ),
            26 =>
                array (
                    'id' => 27,
                    'name' => 'users.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:04',
                    'updated_at' => '2020-03-29 14:58:04',
                    'deleted_at' => NULL,
                ),
            27 =>
                array (
                    'id' => 28,
                    'name' => 'users.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:04',
                    'updated_at' => '2020-03-29 14:58:04',
                    'deleted_at' => NULL,
                ),
            28 =>
                array (
                    'id' => 29,
                    'name' => 'app-settings',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:04',
                    'updated_at' => '2020-03-29 14:58:04',
                    'deleted_at' => NULL,
                ),
            29 =>
                array (
                    'id' => 30,
                    'name' => 'shops.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:04',
                    'updated_at' => '2020-03-29 14:58:04',
                    'deleted_at' => NULL,
                ),
            30 =>
                array (
                    'id' => 31,
                    'name' => 'shops.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:04',
                    'updated_at' => '2020-03-29 14:58:04',
                    'deleted_at' => NULL,
                ),
            31 =>
                array (
                    'id' => 32,
                    'name' => 'shops.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:04',
                    'updated_at' => '2020-03-29 14:58:04',
                    'deleted_at' => NULL,
                ),
            32 =>
                array (
                    'id' => 33,
                    'name' => 'shops.edit',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:04',
                    'updated_at' => '2020-03-29 14:58:04',
                    'deleted_at' => NULL,
                ),
            33 =>
                array (
                    'id' => 34,
                    'name' => 'shops.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:05',
                    'updated_at' => '2020-03-29 14:58:05',
                    'deleted_at' => NULL,
                ),
            34 =>
                array (
                    'id' => 35,
                    'name' => 'shops.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:05',
                    'updated_at' => '2020-03-29 14:58:05',
                    'deleted_at' => NULL,
                ),
            35 =>
                array (
                    'id' => 36,
                    'name' => 'categories.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:05',
                    'updated_at' => '2020-03-29 14:58:05',
                    'deleted_at' => NULL,
                ),
            36 =>
                array (
                    'id' => 37,
                    'name' => 'categories.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:05',
                    'updated_at' => '2020-03-29 14:58:05',
                    'deleted_at' => NULL,
                ),
            37 =>
                array (
                    'id' => 38,
                    'name' => 'categories.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:05',
                    'updated_at' => '2020-03-29 14:58:05',
                    'deleted_at' => NULL,
                ),
            38 =>
                array (
                    'id' => 39,
                    'name' => 'categories.edit',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:05',
                    'updated_at' => '2020-03-29 14:58:05',
                    'deleted_at' => NULL,
                ),
            39 =>
                array (
                    'id' => 40,
                    'name' => 'categories.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:05',
                    'updated_at' => '2020-03-29 14:58:05',
                    'deleted_at' => NULL,
                ),
            40 =>
                array (
                    'id' => 41,
                    'name' => 'categories.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:05',
                    'updated_at' => '2020-03-29 14:58:05',
                    'deleted_at' => NULL,
                ),
            41 =>
                array (
                    'id' => 42,
                    'name' => 'faqCategories.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:06',
                    'updated_at' => '2020-03-29 14:58:06',
                    'deleted_at' => NULL,
                ),
            42 =>
                array (
                    'id' => 43,
                    'name' => 'faqCategories.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:06',
                    'updated_at' => '2020-03-29 14:58:06',
                    'deleted_at' => NULL,
                ),
            43 =>
                array (
                    'id' => 44,
                    'name' => 'faqCategories.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:06',
                    'updated_at' => '2020-03-29 14:58:06',
                    'deleted_at' => NULL,
                ),
            44 =>
                array (
                    'id' => 45,
                    'name' => 'faqCategories.edit',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:06',
                    'updated_at' => '2020-03-29 14:58:06',
                    'deleted_at' => NULL,
                ),
            45 =>
                array (
                    'id' => 46,
                    'name' => 'faqCategories.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:06',
                    'updated_at' => '2020-03-29 14:58:06',
                    'deleted_at' => NULL,
                ),
            46 =>
                array (
                    'id' => 47,
                    'name' => 'faqCategories.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:06',
                    'updated_at' => '2020-03-29 14:58:06',
                    'deleted_at' => NULL,
                ),
            47 =>
                array (
                    'id' => 48,
                    'name' => 'orderStatuses.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:06',
                    'updated_at' => '2020-03-29 14:58:06',
                    'deleted_at' => NULL,
                ),
            48 =>
                array (
                    'id' => 49,
                    'name' => 'orderStatuses.show',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:06',
                    'updated_at' => '2020-03-29 14:58:06',
                    'deleted_at' => NULL,
                ),
            49 =>
                array (
                    'id' => 50,
                    'name' => 'orderStatuses.edit',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:06',
                    'updated_at' => '2020-03-29 14:58:06',
                    'deleted_at' => NULL,
                ),
            50 =>
                array (
                    'id' => 51,
                    'name' => 'orderStatuses.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:07',
                    'updated_at' => '2020-03-29 14:58:07',
                    'deleted_at' => NULL,
                ),
            51 =>
                array (
                    'id' => 52,
                    'name' => 'clothes.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:07',
                    'updated_at' => '2020-03-29 14:58:07',
                    'deleted_at' => NULL,
                ),
            52 =>
                array (
                    'id' => 53,
                    'name' => 'clothes.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:07',
                    'updated_at' => '2020-03-29 14:58:07',
                    'deleted_at' => NULL,
                ),
            53 =>
                array (
                    'id' => 54,
                    'name' => 'clothes.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:07',
                    'updated_at' => '2020-03-29 14:58:07',
                    'deleted_at' => NULL,
                ),
            54 =>
                array (
                    'id' => 55,
                    'name' => 'clothes.edit',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:07',
                    'updated_at' => '2020-03-29 14:58:07',
                    'deleted_at' => NULL,
                ),
            55 =>
                array (
                    'id' => 56,
                    'name' => 'clothes.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:07',
                    'updated_at' => '2020-03-29 14:58:07',
                    'deleted_at' => NULL,
                ),
            56 =>
                array (
                    'id' => 57,
                    'name' => 'clothes.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:07',
                    'updated_at' => '2020-03-29 14:58:07',
                    'deleted_at' => NULL,
                ),
            57 =>
                array (
                    'id' => 58,
                    'name' => 'galleries.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:07',
                    'updated_at' => '2020-03-29 14:58:07',
                    'deleted_at' => NULL,
                ),
            58 =>
                array (
                    'id' => 59,
                    'name' => 'galleries.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:07',
                    'updated_at' => '2020-03-29 14:58:07',
                    'deleted_at' => NULL,
                ),
            59 =>
                array (
                    'id' => 60,
                    'name' => 'galleries.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:08',
                    'updated_at' => '2020-03-29 14:58:08',
                    'deleted_at' => NULL,
                ),
            60 =>
                array (
                    'id' => 61,
                    'name' => 'galleries.edit',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:08',
                    'updated_at' => '2020-03-29 14:58:08',
                    'deleted_at' => NULL,
                ),
            61 =>
                array (
                    'id' => 62,
                    'name' => 'galleries.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:08',
                    'updated_at' => '2020-03-29 14:58:08',
                    'deleted_at' => NULL,
                ),
            62 =>
                array (
                    'id' => 63,
                    'name' => 'galleries.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:08',
                    'updated_at' => '2020-03-29 14:58:08',
                    'deleted_at' => NULL,
                ),
            63 =>
                array (
                    'id' => 64,
                    'name' => 'clothesReviews.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:08',
                    'updated_at' => '2020-03-29 14:58:08',
                    'deleted_at' => NULL,
                ),
            64 =>
                array (
                    'id' => 65,
                    'name' => 'clothesReviews.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:08',
                    'updated_at' => '2020-03-29 14:58:08',
                    'deleted_at' => NULL,
                ),
            65 =>
                array (
                    'id' => 66,
                    'name' => 'clothesReviews.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:08',
                    'updated_at' => '2020-03-29 14:58:08',
                    'deleted_at' => NULL,
                ),
            66 =>
                array (
                    'id' => 67,
                    'name' => 'clothesReviews.edit',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:08',
                    'updated_at' => '2020-03-29 14:58:08',
                    'deleted_at' => NULL,
                ),
            67 =>
                array (
                    'id' => 68,
                    'name' => 'clothesReviews.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:08',
                    'updated_at' => '2020-03-29 14:58:08',
                    'deleted_at' => NULL,
                ),
            68 =>
                array (
                    'id' => 69,
                    'name' => 'clothesReviews.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:08',
                    'updated_at' => '2020-03-29 14:58:08',
                    'deleted_at' => NULL,
                ),
            69 =>
                array (
                    'id' => 70,
                    'name' => 'extras.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:09',
                    'updated_at' => '2020-03-29 14:58:09',
                    'deleted_at' => NULL,
                ),
            70 =>
                array (
                    'id' => 71,
                    'name' => 'extras.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:09',
                    'updated_at' => '2020-03-29 14:58:09',
                    'deleted_at' => NULL,
                ),
            71 =>
                array (
                    'id' => 72,
                    'name' => 'extras.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:09',
                    'updated_at' => '2020-03-29 14:58:09',
                    'deleted_at' => NULL,
                ),
            72 =>
                array (
                    'id' => 73,
                    'name' => 'extras.show',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:10',
                    'updated_at' => '2020-03-29 14:58:10',
                    'deleted_at' => NULL,
                ),
            73 =>
                array (
                    'id' => 74,
                    'name' => 'extras.edit',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:10',
                    'updated_at' => '2020-03-29 14:58:10',
                    'deleted_at' => NULL,
                ),
            74 =>
                array (
                    'id' => 75,
                    'name' => 'extras.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:10',
                    'updated_at' => '2020-03-29 14:58:10',
                    'deleted_at' => NULL,
                ),
            75 =>
                array (
                    'id' => 76,
                    'name' => 'extras.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:10',
                    'updated_at' => '2020-03-29 14:58:10',
                    'deleted_at' => NULL,
                ),
            76 =>
                array (
                    'id' => 77,
                    'name' => 'payments.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:10',
                    'updated_at' => '2020-03-29 14:58:10',
                    'deleted_at' => NULL,
                ),
            77 =>
                array (
                    'id' => 78,
                    'name' => 'payments.show',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:10',
                    'updated_at' => '2020-03-29 14:58:10',
                    'deleted_at' => NULL,
                ),
            78 =>
                array (
                    'id' => 79,
                    'name' => 'payments.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:10',
                    'updated_at' => '2020-03-29 14:58:10',
                    'deleted_at' => NULL,
                ),
            79 =>
                array (
                    'id' => 80,
                    'name' => 'faqs.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:10',
                    'updated_at' => '2020-03-29 14:58:10',
                    'deleted_at' => NULL,
                ),
            80 =>
                array (
                    'id' => 81,
                    'name' => 'faqs.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:11',
                    'updated_at' => '2020-03-29 14:58:11',
                    'deleted_at' => NULL,
                ),
            81 =>
                array (
                    'id' => 82,
                    'name' => 'faqs.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:11',
                    'updated_at' => '2020-03-29 14:58:11',
                    'deleted_at' => NULL,
                ),
            82 =>
                array (
                    'id' => 83,
                    'name' => 'faqs.edit',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:11',
                    'updated_at' => '2020-03-29 14:58:11',
                    'deleted_at' => NULL,
                ),
            83 =>
                array (
                    'id' => 84,
                    'name' => 'faqs.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:11',
                    'updated_at' => '2020-03-29 14:58:11',
                    'deleted_at' => NULL,
                ),
            84 =>
                array (
                    'id' => 85,
                    'name' => 'faqs.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:11',
                    'updated_at' => '2020-03-29 14:58:11',
                    'deleted_at' => NULL,
                ),
            85 =>
                array (
                    'id' => 86,
                    'name' => 'shopReviews.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:11',
                    'updated_at' => '2020-03-29 14:58:11',
                    'deleted_at' => NULL,
                ),
            86 =>
                array (
                    'id' => 87,
                    'name' => 'shopReviews.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:11',
                    'updated_at' => '2020-03-29 14:58:11',
                    'deleted_at' => NULL,
                ),
            87 =>
                array (
                    'id' => 88,
                    'name' => 'shopReviews.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:12',
                    'updated_at' => '2020-03-29 14:58:12',
                    'deleted_at' => NULL,
                ),
            88 =>
                array (
                    'id' => 89,
                    'name' => 'shopReviews.edit',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:12',
                    'updated_at' => '2020-03-29 14:58:12',
                    'deleted_at' => NULL,
                ),
            89 =>
                array (
                    'id' => 90,
                    'name' => 'shopReviews.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:12',
                    'updated_at' => '2020-03-29 14:58:12',
                    'deleted_at' => NULL,
                ),
            90 =>
                array (
                    'id' => 91,
                    'name' => 'shopReviews.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:12',
                    'updated_at' => '2020-03-29 14:58:12',
                    'deleted_at' => NULL,
                ),
            91 =>
                array (
                    'id' => 92,
                    'name' => 'favorites.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:12',
                    'updated_at' => '2020-03-29 14:58:12',
                    'deleted_at' => NULL,
                ),
            92 =>
                array (
                    'id' => 93,
                    'name' => 'favorites.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:12',
                    'updated_at' => '2020-03-29 14:58:12',
                    'deleted_at' => NULL,
                ),
            93 =>
                array (
                    'id' => 94,
                    'name' => 'favorites.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:12',
                    'updated_at' => '2020-03-29 14:58:12',
                    'deleted_at' => NULL,
                ),
            94 =>
                array (
                    'id' => 95,
                    'name' => 'favorites.edit',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:12',
                    'updated_at' => '2020-03-29 14:58:12',
                    'deleted_at' => NULL,
                ),
            95 =>
                array (
                    'id' => 96,
                    'name' => 'favorites.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:12',
                    'updated_at' => '2020-03-29 14:58:12',
                    'deleted_at' => NULL,
                ),
            96 =>
                array (
                    'id' => 97,
                    'name' => 'favorites.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:13',
                    'updated_at' => '2020-03-29 14:58:13',
                    'deleted_at' => NULL,
                ),
            97 =>
                array (
                    'id' => 98,
                    'name' => 'orders.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:13',
                    'updated_at' => '2020-03-29 14:58:13',
                    'deleted_at' => NULL,
                ),
            98 =>
                array (
                    'id' => 99,
                    'name' => 'orders.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:13',
                    'updated_at' => '2020-03-29 14:58:13',
                    'deleted_at' => NULL,
                ),
            99 =>
                array (
                    'id' => 100,
                    'name' => 'orders.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:13',
                    'updated_at' => '2020-03-29 14:58:13',
                    'deleted_at' => NULL,
                ),
            100 =>
                array (
                    'id' => 101,
                    'name' => 'orders.show',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:13',
                    'updated_at' => '2020-03-29 14:58:13',
                    'deleted_at' => NULL,
                ),
            101 =>
                array (
                    'id' => 102,
                    'name' => 'orders.edit',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:13',
                    'updated_at' => '2020-03-29 14:58:13',
                    'deleted_at' => NULL,
                ),
            102 =>
                array (
                    'id' => 103,
                    'name' => 'orders.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:13',
                    'updated_at' => '2020-03-29 14:58:13',
                    'deleted_at' => NULL,
                ),
            103 =>
                array (
                    'id' => 104,
                    'name' => 'orders.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:13',
                    'updated_at' => '2020-03-29 14:58:13',
                    'deleted_at' => NULL,
                ),
            104 =>
                array (
                    'id' => 105,
                    'name' => 'notifications.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:14',
                    'updated_at' => '2020-03-29 14:58:14',
                    'deleted_at' => NULL,
                ),
            105 =>
                array (
                    'id' => 106,
                    'name' => 'notifications.show',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:14',
                    'updated_at' => '2020-03-29 14:58:14',
                    'deleted_at' => NULL,
                ),
            106 =>
                array (
                    'id' => 107,
                    'name' => 'notifications.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:14',
                    'updated_at' => '2020-03-29 14:58:14',
                    'deleted_at' => NULL,
                ),
            107 =>
                array (
                    'id' => 108,
                    'name' => 'carts.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:14',
                    'updated_at' => '2020-03-29 14:58:14',
                    'deleted_at' => NULL,
                ),
            108 =>
                array (
                    'id' => 109,
                    'name' => 'carts.edit',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:14',
                    'updated_at' => '2020-03-29 14:58:14',
                    'deleted_at' => NULL,
                ),
            109 =>
                array (
                    'id' => 110,
                    'name' => 'carts.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:14',
                    'updated_at' => '2020-03-29 14:58:14',
                    'deleted_at' => NULL,
                ),
            110 =>
                array (
                    'id' => 111,
                    'name' => 'carts.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:14',
                    'updated_at' => '2020-03-29 14:58:14',
                    'deleted_at' => NULL,
                ),
            111 =>
                array (
                    'id' => 112,
                    'name' => 'currencies.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:14',
                    'updated_at' => '2020-03-29 14:58:14',
                    'deleted_at' => NULL,
                ),
            112 =>
                array (
                    'id' => 113,
                    'name' => 'currencies.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:15',
                    'updated_at' => '2020-03-29 14:58:15',
                    'deleted_at' => NULL,
                ),
            113 =>
                array (
                    'id' => 114,
                    'name' => 'currencies.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:15',
                    'updated_at' => '2020-03-29 14:58:15',
                    'deleted_at' => NULL,
                ),
            114 =>
                array (
                    'id' => 115,
                    'name' => 'currencies.edit',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:15',
                    'updated_at' => '2020-03-29 14:58:15',
                    'deleted_at' => NULL,
                ),
            115 =>
                array (
                    'id' => 116,
                    'name' => 'currencies.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:15',
                    'updated_at' => '2020-03-29 14:58:15',
                    'deleted_at' => NULL,
                ),
            116 =>
                array (
                    'id' => 117,
                    'name' => 'currencies.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:15',
                    'updated_at' => '2020-03-29 14:58:15',
                    'deleted_at' => NULL,
                ),
            117 =>
                array (
                    'id' => 118,
                    'name' => 'deliveryAddresses.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:15',
                    'updated_at' => '2020-03-29 14:58:15',
                    'deleted_at' => NULL,
                ),
            118 =>
                array (
                    'id' => 119,
                    'name' => 'deliveryAddresses.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:15',
                    'updated_at' => '2020-03-29 14:58:15',
                    'deleted_at' => NULL,
                ),
            119 =>
                array (
                    'id' => 120,
                    'name' => 'deliveryAddresses.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:15',
                    'updated_at' => '2020-03-29 14:58:15',
                    'deleted_at' => NULL,
                ),
            120 =>
                array (
                    'id' => 121,
                    'name' => 'deliveryAddresses.edit',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:16',
                    'updated_at' => '2020-03-29 14:58:16',
                    'deleted_at' => NULL,
                ),
            121 =>
                array (
                    'id' => 122,
                    'name' => 'deliveryAddresses.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:16',
                    'updated_at' => '2020-03-29 14:58:16',
                    'deleted_at' => NULL,
                ),
            122 =>
                array (
                    'id' => 123,
                    'name' => 'deliveryAddresses.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:16',
                    'updated_at' => '2020-03-29 14:58:16',
                    'deleted_at' => NULL,
                ),
            123 =>
                array (
                    'id' => 124,
                    'name' => 'earnings.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:17',
                    'updated_at' => '2020-03-29 14:58:17',
                    'deleted_at' => NULL,
                ),
            124 =>
                array (
                    'id' => 125,
                    'name' => 'earnings.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:17',
                    'updated_at' => '2020-03-29 14:58:17',
                    'deleted_at' => NULL,
                ),
            125 =>
                array (
                    'id' => 126,
                    'name' => 'earnings.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:17',
                    'updated_at' => '2020-03-29 14:58:17',
                    'deleted_at' => NULL,
                ),
            126 =>
                array (
                    'id' => 127,
                    'name' => 'earnings.show',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:17',
                    'updated_at' => '2020-03-29 14:58:17',
                    'deleted_at' => NULL,
                ),
            127 =>
                array (
                    'id' => 128,
                    'name' => 'earnings.edit',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:17',
                    'updated_at' => '2020-03-29 14:58:17',
                    'deleted_at' => NULL,
                ),
            128 =>
                array (
                    'id' => 129,
                    'name' => 'earnings.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:17',
                    'updated_at' => '2020-03-29 14:58:17',
                    'deleted_at' => NULL,
                ),
            129 =>
                array (
                    'id' => 130,
                    'name' => 'earnings.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:17',
                    'updated_at' => '2020-03-29 14:58:17',
                    'deleted_at' => NULL,
                ),
            130 =>
                array (
                    'id' => 131,
                    'name' => 'shopsPayouts.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:18',
                    'updated_at' => '2020-03-29 14:58:18',
                    'deleted_at' => NULL,
                ),
            131 =>
                array (
                    'id' => 132,
                    'name' => 'shopsPayouts.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:18',
                    'updated_at' => '2020-03-29 14:58:18',
                    'deleted_at' => NULL,
                ),
            132 =>
                array (
                    'id' => 133,
                    'name' => 'shopsPayouts.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:18',
                    'updated_at' => '2020-03-29 14:58:18',
                    'deleted_at' => NULL,
                ),
            133 =>
                array (
                    'id' => 134,
                    'name' => 'shopsPayouts.show',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:18',
                    'updated_at' => '2020-03-29 14:58:18',
                    'deleted_at' => NULL,
                ),
            134 =>
                array (
                    'id' => 135,
                    'name' => 'shopsPayouts.edit',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:18',
                    'updated_at' => '2020-03-29 14:58:18',
                    'deleted_at' => NULL,
                ),
            135 =>
                array (
                    'id' => 136,
                    'name' => 'shopsPayouts.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:19',
                    'updated_at' => '2020-03-29 14:58:19',
                    'deleted_at' => NULL,
                ),
            136 =>
                array (
                    'id' => 137,
                    'name' => 'shopsPayouts.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:19',
                    'updated_at' => '2020-03-29 14:58:19',
                    'deleted_at' => NULL,
                ),
            137 =>
                array (
                    'id' => 138,
                    'name' => 'permissions.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:59:15',
                    'updated_at' => '2020-03-29 14:59:15',
                    'deleted_at' => NULL,
                ),
            138 =>
                array (
                    'id' => 139,
                    'name' => 'permissions.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:59:15',
                    'updated_at' => '2020-03-29 14:59:15',
                    'deleted_at' => NULL,
                ),
            139 =>
                array (
                    'id' => 140,
                    'name' => 'permissions.show',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:59:15',
                    'updated_at' => '2020-03-29 14:59:15',
                    'deleted_at' => NULL,
                ),
            140 =>
                array (
                    'id' => 141,
                    'name' => 'roles.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:59:15',
                    'updated_at' => '2020-03-29 14:59:15',
                    'deleted_at' => NULL,
                ),
            141 =>
                array (
                    'id' => 142,
                    'name' => 'roles.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:59:15',
                    'updated_at' => '2020-03-29 14:59:15',
                    'deleted_at' => NULL,
                ),
            142 =>
                array (
                    'id' => 143,
                    'name' => 'roles.show',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:59:16',
                    'updated_at' => '2020-03-29 14:59:16',
                    'deleted_at' => NULL,
                ),
            143 =>
                array (
                    'id' => 144,
                    'name' => 'extraGroups.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            144 =>
                array (
                    'id' => 145,
                    'name' => 'extraGroups.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            145 =>
                array (
                    'id' => 146,
                    'name' => 'extraGroups.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            146 =>
                array (
                    'id' => 147,
                    'name' => 'extraGroups.edit',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            147 =>
                array (
                    'id' => 148,
                    'name' => 'extraGroups.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            148 =>
                array (
                    'id' => 149,
                    'name' => 'extraGroups.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            149 =>
                array (
                    'id' => 150,
                    'name' => 'requestedshops.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-13 14:58:02',
                    'updated_at' => '2020-08-13 14:58:02',
                    'deleted_at' => NULL,
                ),
            150 =>
                array (
                    'id' => 151,
                    'name' => 'offers.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            151 =>
                array (
                    'id' => 152,
                    'name' => 'offers.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            152 =>
                array (
                    'id' => 153,
                    'name' => 'offers.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            153 =>
                array (
                    'id' => 154,
                    'name' => 'offers.edit',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            154 =>
                array (
                    'id' => 155,
                    'name' => 'offers.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            155 =>
                array (
                    'id' => 156,
                    'name' => 'offers.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            156 =>
                array (
                    'id' => 157,
                    'name' => 'colourCategories.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-13 14:58:02',
                    'updated_at' => '2020-08-13 14:58:02',
                    'deleted_at' => NULL,
                ),
            157 =>
                array (
                    'id' => 158,
                    'name' => 'colourCategories.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            158 =>
                array (
                    'id' => 159,
                    'name' => 'colourCategories.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            159 =>
                array (
                    'id' => 160,
                    'name' => 'colourCategories.edit',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            160 =>
                array (
                    'id' => 161,
                    'name' => 'colourCategories.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            161 =>
                array (
                    'id' => 162,
                    'name' => 'colourCategories.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            162 =>
                array (
                    'id' => 163,
                    'name' => 'sizeCategories.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-13 14:58:02',
                    'updated_at' => '2020-08-13 14:58:02',
                    'deleted_at' => NULL,
                ),
            163 =>
                array (
                    'id' => 164,
                    'name' => 'sizeCategories.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            164 =>
                array (
                    'id' => 165,
                    'name' => 'sizeCategories.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            165 =>
                array (
                    'id' => 166,
                    'name' => 'sizeCategories.edit',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            166 =>
                array (
                    'id' => 167,
                    'name' => 'sizeCategories.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            167 =>
                array (
                    'id' => 168,
                    'name' => 'sizeCategories.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            168 =>
                array (
                    'id' => 169,
                    'name' => 'clothesCategories.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-13 14:58:02',
                    'updated_at' => '2020-08-13 14:58:02',
                    'deleted_at' => NULL,
                ),
            169 =>
                array (
                    'id' => 170,
                    'name' => 'clothesCategories.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            170 =>
                array (
                    'id' => 171,
                    'name' => 'clothesCategories.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            171 =>
                array (
                    'id' => 172,
                    'name' => 'clothesCategories.edit',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            172 =>
                array (
                    'id' => 173,
                    'name' => 'clothesCategories.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            173 =>
                array (
                    'id' => 174,
                    'name' => 'clothesCategories.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            174 =>
                array (
                    'id' => 175,
                    'name' => 'shopCategories.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-13 14:58:02',
                    'updated_at' => '2020-08-13 14:58:02',
                    'deleted_at' => NULL,
                ),
            175 =>
                array (
                    'id' => 176,
                    'name' => 'shopCategories.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            176 =>
                array (
                    'id' => 177,
                    'name' => 'shopCategories.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            177 =>
                array (
                    'id' => 178,
                    'name' => 'shopCategories.edit',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            178 =>
                array (
                    'id' => 179,
                    'name' => 'shopCategories.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            179 =>
                array (
                    'id' => 180,
                    'name' => 'shopCategories.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            180 =>    
                array(
                    'id' => 181,
                    'name' => 'slides.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            181 => 
                array(
                    'id' => 182,
                    'name' => 'slides.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            182 => 
                array(
                    'id' => 183,
                    'name' => 'slides.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            183 => 
                array(
                    'id' => 184,
                    'name' => 'slides.edit',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            184 => 
                array(
                    'id' => 185,
                    'name' => 'slides.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            185 => 
                array(
                    'id' => 186,
                    'name' => 'slides.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            186 => 
                array(
                    'id' => 187,
                    'name' => 'coupons.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            187 => 
                array(
                    'id' => 188,
                    'name' => 'coupons.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            188 => 
                array(
                    'id' => 189,
                    'name' => 'coupons.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            189 => 
                array(
                    'id' => 190,
                    'name' => 'coupons.edit',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            190 => 
                array(
                    'id' => 191,
                    'name' => 'coupons.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            191 => 
                array(
                    'id' => 192,
                    'name' => 'coupons.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            196 => 
                array(
                    'id' => 200,
                    'name' => 'subcategory.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            197 => 
                array(
                    'id' => 201,
                    'name' => 'subcategory.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            198 => 
                array(
                    'id' => 202,
                    'name' => 'subsize.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            199 => 
                array(
                    'id' => 203,
                    'name' => 'subsize.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            200 => 
                array(
                    'id' => 204,
                    'name' => 'clothessubcategory.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            201 => 
                array(
                    'id' => 205,
                    'name' => 'clothessubcategory.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            202 => 
                array(
                    'id' => 206,
                    'name' => 'shopsubcategory.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            203 => 
                array(
                    'id' => 207,
                    'name' => 'shopsubcategory.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            204 => 
                array(
                    'id' => 208,
                    'name' => 'subcategory.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            205 => 
                array(
                    'id' => 209,
                    'name' => 'subcategory.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),

            207=> 
                array(
                    'id' => 211,
                    'name' => 'governorate.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            208=> 
                array(
                    'id' => 212,
                    'name' => 'governorate.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),  
            209=> 
                array(
                    'id' => 213,
                    'name' => 'governorate.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ), 
            210=> 
                array(
                    'id' => 214,
                    'name' => 'governorate.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            211=> 
                array(
                    'id' => 215,
                    'name' => 'city.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            212=> 
                array(
                    'id' => 216,
                    'name' => 'city.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),  
            213=> 
                array(
                    'id' => 217,
                    'name' => 'city.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ), 
            214=> 
                array(
                    'id' => 218,
                    'name' => 'city.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            215=> 
                array(
                    'id' => 219,
                    'name' => 'mediaLibrary.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            216=> 
                array(
                    'id' => 220,
                    'name' => 'mediaLibrary.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),  
            217=> 
                array(
                    'id' => 221,
                    'name' => 'mediaLibrary.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ), 
            218=> 
                array(
                    'id' => 222,
                    'name' => 'mediaLibrary.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            219=> 
                array(
                    'id' => 223,
                    'name' => 'mediaLibrary.show',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            220=> 
                array(
                    'id' => 224,
                    'name' => 'mediaLibrary.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            221=> 
                array(
                    'id' => 225,
                    'name' => 'images.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            226 => 
                array(
                    'id' => 226,
                    'name' => 'factory.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            227 => 
                array(
                    'id' => 227,
                    'name' => 'factory.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            228 => 
                array(
                    'id' => 228,
                    'name' => 'factory.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            229 => 
                array(
                    'id' => 229,
                    'name' => 'factory.edit',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            230 => 
                array(
                    'id' => 230,
                    'name' => 'factory.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            231 => 
                array(
                    'id' => 231,
                    'name' => 'factory.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            232 => 
                array(
                    'id' => 232,
                    'name' => 'factory.show',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            233 => 
                array(
                    'id' => 233,
                    'name' => 'factory.filter',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            234 => 
                array(
                    'id' => 234,
                    'name' => 'factory.all',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            235 => 
                array(
                    'id' => 235,
                    'name' => 'brand.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            236 => 
                array(
                    'id' => 236,
                    'name' => 'brand.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            237 => 
                array(
                    'id' => 237,
                    'name' => 'brand.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            238 => 
                array(
                    'id' => 238,
                    'name' => 'brand.edit',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            239 => 
                array(
                    'id' => 239,
                    'name' => 'brand.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            240 => 
                array(
                    'id' => 240,
                    'name' => 'brand.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
           241 => 
                array(
                    'id' =>241,
                    'name' => 'brand.show',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            242 => 
                array(
                    'id' =>242,
                    'name' => 'image.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            243 =>
                array (
                    'id' => 243,
                    'name' => 'topCategories.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:02',
                    'updated_at' => '2020-03-29 14:58:02',
                    'deleted_at' => NULL,
                ),
            244 =>
                array (
                    'id' => 244,
                    'name' => 'topCategories.delete',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:02',
                    'updated_at' => '2020-03-29 14:58:02',
                    'deleted_at' => NULL,
                ),
            245 =>
                array (
                    'id' => 245,
                    'name' => 'topCategories.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:03',
                    'updated_at' => '2020-03-29 14:58:03',
                    'deleted_at' => NULL,
                ),
            246 =>
                array (
                    'id' => 246,
                    'name' => 'topCategories.edit',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:03',
                    'updated_at' => '2020-03-29 14:58:03',
                    'deleted_at' => NULL,
                ),
            247 =>
                array (
                    'id' => 247,
                    'name' => 'topCategories.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:03',
                    'updated_at' => '2020-03-29 14:58:03',
                    'deleted_at' => NULL,
                ),
            248 =>
                array (
                    'id' => 248,
                    'name' => 'topCategories.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:03',
                    'updated_at' => '2020-03-29 14:58:03',
                    'deleted_at' => NULL,
                ),
            249 =>
                array (
                    'id' => 249,
                    'name' => 'topCategories.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-03-29 14:58:03',
                    'updated_at' => '2020-03-29 14:58:03',
                    'deleted_at' => NULL,
                ),
            250 =>
                array (
                    'id' => 250,
                    'name' => 'pricings.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            251 =>
                array (
                    'id' => 251,
                    'name' => 'pricings.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            252 =>
                array (
                    'id' => 252,
                    'name' => 'pricings.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            253 =>
                array (
                    'id' => 253,
                    'name' => 'pricings.edit',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            254 =>
                array (
                    'id' => 254,
                    'name' => 'pricings.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
            255 =>
                array (
                    'id' => 255,
                    'name' => 'pricings.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-04-11 15:04:40',
                    'updated_at' => '2020-04-11 15:04:40',
                    'deleted_at' => NULL,
                ),
        ));


    }
}