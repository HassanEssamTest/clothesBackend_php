<?php
/**
 * File name: RoleHasPermissionsTableSeeder.php
 * Last modified: 2020.05.06 at 10:12:55
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

use Illuminate\Database\Seeder;

class RoleHasPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('role_has_permissions')->delete();
        
        \DB::table('role_has_permissions')->insert(array (
            0 => 
            array (
                'permission_id' => 1,
                'role_id' => 2,
            ),
            1 => 
            array (
                'permission_id' => 1,
                'role_id' => 3,
            ),
            2 => 
            array (
                'permission_id' => 1,
                'role_id' => 4,
            ),
            3 => 
            array (
                'permission_id' => 2,
                'role_id' => 2,
            ),
            4 => 
            array (
                'permission_id' => 3,
                'role_id' => 2,
            ),
            5 => 
            array (
                'permission_id' => 3,
                'role_id' => 3,
            ),
            6 =>
                array(
                    'permission_id' => 3,
                    'role_id' => 4,
                ),
            7 =>
                array (
                    'permission_id' => 4,
                    'role_id' => 2,
                ),
            8 =>
                array(
                    'permission_id' => 4,
                    'role_id' => 3,
                ),
            9 =>
                array(
                    'permission_id' => 4,
                    'role_id' => 4,
                ),
            10 =>
                array(
                    'permission_id' => 5,
                    'role_id' => 2,
                ),
            11 => 
            array (
                'permission_id' => 5,
                'role_id' => 3,
            ),
            12 => 
            array (
                'permission_id' => 6,
                'role_id' => 2,
            ),
            13 => 
            array (
                'permission_id' => 9,
                'role_id' => 2,
            ),
            14 => 
            array (
                'permission_id' => 10,
                'role_id' => 2,
            ),
            15 => 
            array (
                'permission_id' => 14,
                'role_id' => 2,
            ),
            16 => 
            array (
                'permission_id' => 15,
                'role_id' => 2,
            ),
            17 => 
            array (
                'permission_id' => 16,
                'role_id' => 2,
            ),
            18 => 
            array (
                'permission_id' => 17,
                'role_id' => 2,
            ),
            19 => 
            array (
                'permission_id' => 18,
                'role_id' => 2,
            ),
            20 => 
            array (
                'permission_id' => 19,
                'role_id' => 2,
            ),
            21 => 
            array (
                'permission_id' => 20,
                'role_id' => 2,
            ),
            22 => 
            array (
                'permission_id' => 21,
                'role_id' => 2,
            ),
            23 => 
            array (
                'permission_id' => 22,
                'role_id' => 2,
            ),
            24 => 
            array (
                'permission_id' => 23,
                'role_id' => 2,
            ),
            25 => 
            array (
                'permission_id' => 24,
                'role_id' => 2,
            ),
            26 => 
            array (
                'permission_id' => 26,
                'role_id' => 2,
            ),
            27 => 
            array (
                'permission_id' => 27,
                'role_id' => 2,
            ),
            28 => 
            array (
                'permission_id' => 27,
                'role_id' => 3,
            ),
            29 =>
                array(
                    'permission_id' => 27,
                    'role_id' => 4,
                ),
            30 =>
                array(
                    'permission_id' => 28,
                    'role_id' => 2,
                ),
            31 => 
            array (
                'permission_id' => 29,
                'role_id' => 2,
            ),
            32 => 
            array (
                'permission_id' => 30,
                'role_id' => 2,
            ),
            33 => 
            array (
                'permission_id' => 30,
                'role_id' => 3,
            ),
            34 => 
            array (
                'permission_id' => 30,
                'role_id' => 4,
            ),
            35 => 
            array (
                'permission_id' => 31,
                'role_id' => 2,
            ),
            36 => 
            array (
                'permission_id' => 32,
                'role_id' => 2,
            ),
            37 => 
            array (
                'permission_id' => 33,
                'role_id' => 2,
            ),
            38 => 
            array (
                'permission_id' => 33,
                'role_id' => 3,
            ),
            39 => 
            array (
                'permission_id' => 34,
                'role_id' => 2,
            ),
            40 => 
            array (
                'permission_id' => 34,
                'role_id' => 3,
            ),
            41 => 
            array (
                'permission_id' => 35,
                'role_id' => 2,
            ),
            42 => 
            array (
                'permission_id' => 36,
                'role_id' => 2,
            ),
            43 => 
            array (
                'permission_id' => 37,
                'role_id' => 2,
            ),
            44 => 
            array (
                'permission_id' => 38,
                'role_id' => 2,
            ),
            45 => 
            array (
                'permission_id' => 39,
                'role_id' => 2,
            ),
            46 => 
            array (
                'permission_id' => 40,
                'role_id' => 2,
            ),
            47 => 
            array (
                'permission_id' => 41,
                'role_id' => 2,
            ),
            48 => 
            array (
                'permission_id' => 42,
                'role_id' => 2,
            ),
            49 => 
            array (
                'permission_id' => 42,
                'role_id' => 3,
            ),
            50 => 
            array (
                'permission_id' => 43,
                'role_id' => 2,
            ),
            51 => 
            array (
                'permission_id' => 44,
                'role_id' => 2,
            ),
            52 => 
            array (
                'permission_id' => 45,
                'role_id' => 2,
            ),
            53 => 
            array (
                'permission_id' => 46,
                'role_id' => 2,
            ),
            54 => 
            array (
                'permission_id' => 47,
                'role_id' => 2,
            ),
            55 => 
            array (
                'permission_id' => 48,
                'role_id' => 2,
            ),
            56 => 
            array (
                'permission_id' => 48,
                'role_id' => 3,
            ),
            57 => 
            array (
                'permission_id' => 50,
                'role_id' => 2,
            ),
            58 => 
            array (
                'permission_id' => 51,
                'role_id' => 2,
            ),
            59 => 
            array (
                'permission_id' => 52,
                'role_id' => 2,
            ),
            60 => 
            array (
                'permission_id' => 52,
                'role_id' => 3,
            ),
            61 => 
            array (
                'permission_id' => 52,
                'role_id' => 4,
            ),
            62 => 
            array (
                'permission_id' => 53,
                'role_id' => 2,
            ),
            63 => 
            array (
                'permission_id' => 53,
                'role_id' => 3,
            ),
            64 => 
            array (
                'permission_id' => 54,
                'role_id' => 2,
            ),
            65 => 
            array (
                'permission_id' => 54,
                'role_id' => 3,
            ),
            66 => 
            array (
                'permission_id' => 55,
                'role_id' => 2,
            ),
            67 => 
            array (
                'permission_id' => 55,
                'role_id' => 3,
            ),
            68 => 
            array (
                'permission_id' => 56,
                'role_id' => 2,
            ),
            69 => 
            array (
                'permission_id' => 56,
                'role_id' => 3,
            ),
            70 => 
            array (
                'permission_id' => 57,
                'role_id' => 2,
            ),
            71 => 
            array (
                'permission_id' => 57,
                'role_id' => 3,
            ),
            72 => 
            array (
                'permission_id' => 58,
                'role_id' => 2,
            ),
            73 => 
            array (
                'permission_id' => 58,
                'role_id' => 3,
            ),
            74 => 
            array (
                'permission_id' => 59,
                'role_id' => 2,
            ),
            75 => 
            array (
                'permission_id' => 59,
                'role_id' => 3,
            ),
            76 => 
            array (
                'permission_id' => 60,
                'role_id' => 2,
            ),
            77 => 
            array (
                'permission_id' => 60,
                'role_id' => 3,
            ),
            78 => 
            array (
                'permission_id' => 61,
                'role_id' => 2,
            ),
            79 => 
            array (
                'permission_id' => 61,
                'role_id' => 3,
            ),
            80 => 
            array (
                'permission_id' => 62,
                'role_id' => 2,
            ),
            81 => 
            array (
                'permission_id' => 62,
                'role_id' => 3,
            ),
            82 => 
            array (
                'permission_id' => 63,
                'role_id' => 2,
            ),
            83 => 
            array (
                'permission_id' => 63,
                'role_id' => 3,
            ),
            84 => 
            array (
                'permission_id' => 64,
                'role_id' => 2,
            ),
            85 => 
            array (
                'permission_id' => 64,
                'role_id' => 3,
            ),
            86 => 
            array (
                'permission_id' => 64,
                'role_id' => 4,
            ),
            87 => 
            array (
                'permission_id' => 67,
                'role_id' => 2,
            ),
            88 => 
            array (
                'permission_id' => 67,
                'role_id' => 3,
            ),
            89 => 
            array (
                'permission_id' => 67,
                'role_id' => 4,
            ),
            90 => 
            array (
                'permission_id' => 68,
                'role_id' => 2,
            ),
            91 => 
            array (
                'permission_id' => 68,
                'role_id' => 3,
            ),
            92 => 
            array (
                'permission_id' => 68,
                'role_id' => 4,
            ),
            93 => 
            array (
                'permission_id' => 69,
                'role_id' => 2,
            ),
            94 => 
            array (
                'permission_id' => 76,
                'role_id' => 2,
            ),
            95 => 
            array (
                'permission_id' => 76,
                'role_id' => 3,
            ),
            96 => 
            array (
                'permission_id' => 77,
                'role_id' => 2,
            ),
            97 => 
            array (
                'permission_id' => 77,
                'role_id' => 3,
            ),
            98 => 
            array (
                'permission_id' => 78,
                'role_id' => 2,
            ),
            99 => 
            array (
                'permission_id' => 78,
                'role_id' => 3,
            ),
            100 => 
            array (
                'permission_id' => 80,
                'role_id' => 2,
            ),
            101 => 
            array (
                'permission_id' => 80,
                'role_id' => 3,
            ),
            102 => 
            array (
                'permission_id' => 81,
                'role_id' => 2,
            ),
            103 => 
            array (
                'permission_id' => 81,
                'role_id' => 3,
            ),
            104 => 
            array (
                'permission_id' => 82,
                'role_id' => 2,
            ),
            105 => 
            array (
                'permission_id' => 82,
                'role_id' => 3,
            ),
            106 => 
            array (
                'permission_id' => 83,
                'role_id' => 2,
            ),
            107 => 
            array (
                'permission_id' => 83,
                'role_id' => 3,
            ),
            108 => 
            array (
                'permission_id' => 83,
                'role_id' => 4,
            ),
            109 => 
            array (
                'permission_id' => 85,
                'role_id' => 2,
            ),
            110 => 
            array (
                'permission_id' => 86,
                'role_id' => 2,
            ),
            111 => 
            array (
                'permission_id' => 86,
                'role_id' => 3,
            ),
            112 => 
            array (
                'permission_id' => 86,
                'role_id' => 4,
            ),
            113 => 
            array (
                'permission_id' => 87,
                'role_id' => 2,
            ),
            114 => 
            array (
                'permission_id' => 88,
                'role_id' => 2,
            ),
            115 => 
            array (
                'permission_id' => 89,
                'role_id' => 2,
            ),
            116 => 
            array (
                'permission_id' => 90,
                'role_id' => 2,
            ),
            117 => 
            array (
                'permission_id' => 91,
                'role_id' => 2,
            ),
            118 => 
            array (
                'permission_id' => 92,
                'role_id' => 2,
            ),
            119 => 
            array (
                'permission_id' => 92,
                'role_id' => 3,
            ),
            120 => 
            array (
                'permission_id' => 92,
                'role_id' => 4,
            ),
            121 =>
                array(
                    'permission_id' => 95,
                    'role_id' => 2,
                ),
            122 => 
            array (
                'permission_id' => 95,
                'role_id' => 3,
            ),
            123 => 
            array (
                'permission_id' => 95,
                'role_id' => 4,
            ),
            124 =>
                array(
                    'permission_id' => 96,
                    'role_id' => 2,
                ),
            125 =>
                array(
                    'permission_id' => 96,
                    'role_id' => 3,
                ),
            126 =>
                array(
                    'permission_id' => 96,
                    'role_id' => 4,
                ),
            127 => 
            array (
                'permission_id' => 97,
                'role_id' => 2,
            ),
            128 => 
            array (
                'permission_id' => 98,
                'role_id' => 2,
            ),
            129 => 
            array (
                'permission_id' => 98,
                'role_id' => 3,
            ),
            130 => 
            array (
                'permission_id' => 98,
                'role_id' => 4,
            ),
            131 => 
            array (
                'permission_id' => 103,
                'role_id' => 2,
            ),
            132 => 
            array (
                'permission_id' => 103,
                'role_id' => 3,
            ),
            133 => 
            array (
                'permission_id' => 103,
                'role_id' => 4,
            ),
            134 => 
            array (
                'permission_id' => 104,
                'role_id' => 2,
            ),
            135 => 
            array (
                'permission_id' => 104,
                'role_id' => 3,
            ),
            136 => 
            array (
                'permission_id' => 104,
                'role_id' => 4,
            ),
            137 => 
            array (
                'permission_id' => 107,
                'role_id' => 2,
            ),
            138 => 
            array (
                'permission_id' => 107,
                'role_id' => 3,
            ),
            139 => 
            array (
                'permission_id' => 107,
                'role_id' => 4,
            ),
            140 => 
            array (
                'permission_id' => 108,
                'role_id' => 2,
            ),
            141 => 
            array (
                'permission_id' => 108,
                'role_id' => 3,
            ),
            142 => 
            array (
                'permission_id' => 109,
                'role_id' => 2,
            ),
            143 => 
            array (
                'permission_id' => 109,
                'role_id' => 3,
            ),
            144 => 
            array (
                'permission_id' => 110,
                'role_id' => 2,
            ),
            145 => 
            array (
                'permission_id' => 110,
                'role_id' => 3,
            ),
            146 => 
            array (
                'permission_id' => 111,
                'role_id' => 2,
            ),
            147 => 
            array (
                'permission_id' => 111,
                'role_id' => 3,
            ),
            148 => 
            array (
                'permission_id' => 111,
                'role_id' => 4,
            ),
            149 => 
            array (
                'permission_id' => 112,
                'role_id' => 2,
            ),
            150 => 
            array (
                'permission_id' => 113,
                'role_id' => 2,
            ),
            151 => 
            array (
                'permission_id' => 113,
                'role_id' => 3,
            ),
            152 => 
            array (
                'permission_id' => 113,
                'role_id' => 4,
            ),
            153 => 
            array (
                'permission_id' => 114,
                'role_id' => 2,
            ),
            154 => 
            array (
                'permission_id' => 114,
                'role_id' => 3,
            ),
            155 => 
            array (
                'permission_id' => 114,
                'role_id' => 4,
            ),
            156 => 
            array (
                'permission_id' => 117,
                'role_id' => 2,
            ),
            157 => 
            array (
                'permission_id' => 117,
                'role_id' => 3,
            ),
            158 => 
            array (
                'permission_id' => 117,
                'role_id' => 4,
            ),
            159 => 
            array (
                'permission_id' => 118,
                'role_id' => 2,
            ),
            160 => 
            array (
                'permission_id' => 119,
                'role_id' => 2,
            ),
            161 => 
            array (
                'permission_id' => 120,
                'role_id' => 2,
            ),
            162 => 
            array (
                'permission_id' => 121,
                'role_id' => 2,
            ),
            163 => 
            array (
                'permission_id' => 122,
                'role_id' => 2,
            ),
            164 => 
            array (
                'permission_id' => 123,
                'role_id' => 2,
            ),
            165 => 
            array (
                'permission_id' => 124,
                'role_id' => 2,
            ),
            166 =>
                array(
                    'permission_id' => 127,
                    'role_id' => 2,
                ),
            167 =>
                array(
                    'permission_id' => 128,
                    'role_id' => 2,
                ),
            168 => 
            array (
                'permission_id' => 129,
                'role_id' => 2,
            ),
            169 => 
            array (
                'permission_id' => 130,
                'role_id' => 2,
            ),
            170 => 
            array (
                'permission_id' => 130,
                'role_id' => 3,
            ),
            171 => 
            array (
                'permission_id' => 131,
                'role_id' => 2,
            ),
            172 => 
            array (
                'permission_id' => 134,
                'role_id' => 2,
            ),
            173 => 
            array (
                'permission_id' => 134,
                'role_id' => 3,
            ),
            174 => 
            array (
                'permission_id' => 135,
                'role_id' => 2,
            ),
            175 => 
            array (
                'permission_id' => 135,
                'role_id' => 3,
            ),
            176 => 
            array (
                'permission_id' => 137,
                'role_id' => 2,
            ),
            177 => 
            array (
                'permission_id' => 137,
                'role_id' => 3,
            ),
            178 => 
            array (
                'permission_id' => 138,
                'role_id' => 2,
            ),
            179 => 
            array (
                'permission_id' => 144,
                'role_id' => 2,
            ),
            180 => 
            array (
                'permission_id' => 145,
                'role_id' => 2,
            ),
            181 => 
            array (
                'permission_id' => 145,
                'role_id' => 3,
            ),
            182 => 
            array (
                'permission_id' => 146,
                'role_id' => 2,
            ),
            183 => 
            array (
                'permission_id' => 146,
                'role_id' => 3,
            ),
            184 => 
            array (
                'permission_id' => 148,
                'role_id' => 2,
            ),
            185 => 
            array (
                'permission_id' => 149,
                'role_id' => 2,
            ),
            186 => 
            array (
                'permission_id' => 150,
                'role_id' => 2,
            ),
            187 =>
                array(
                    'permission_id' => 150,
                    'role_id' => 3,
                ),
            188 =>
                array(
                    'permission_id' => 99,
                    'role_id' => 3,
                ),
            189 =>
                array(
                    'permission_id' => 99,
                    'role_id' => 4,
                ),
            190 =>
                array(
                    'permission_id' => 102,
                    'role_id' => 3,
                ),
            191 =>
                array(
                    'permission_id' => 102,
                    'role_id' => 4,
                ),
            192 => 
                array (
                    'permission_id' => 151,
                    'role_id' => 2,
                ),
            193 =>
                array(
                    'permission_id' => 152,
                    'role_id' => 3,
                ),
            194 =>
                array(
                    'permission_id' => 153,
                    'role_id' => 3,
                ),
            195 =>
                array(
                    'permission_id' => 154,
                    'role_id' => 2,
                ),
            196 =>
                array(
                    'permission_id' => 154,
                    'role_id' => 3,
                ),
            197 =>
                array(
                    'permission_id' => 155,
                    'role_id' => 2,
                ),
            197 =>
                array(
                    'permission_id' => 155,
                    'role_id' => 3,
                ),
            198 =>
                array(
                    'permission_id' => 156,
                    'role_id' => 2,
                ),
            199 =>
                array(
                    'permission_id' => 156,
                    'role_id' => 3,
                ),
            200 =>
                array(
                    'permission_id' => 100,
                    'role_id' => 3,
                ),
            201 =>
                array(
                    'permission_id' => 100,
                    'role_id' => 4,
                ),
            202 => 
                array (
                    'permission_id' => 151,
                    'role_id' => 3,
                ),
            203 => 
                array (
                    'permission_id' => 155,
                    'role_id' => 2,
                ),
            204 =>
                array(
                    'permission_id' => 157,
                    'role_id' => 2,
                ),
            205 =>
                array(
                    'permission_id' => 158,
                    'role_id' => 2,
                ),
            206 =>
                array(
                    'permission_id' => 159,
                    'role_id' => 2,
                ),
            207 =>
                array(
                    'permission_id' => 160,
                    'role_id' => 2,
                ),
            208 => 
                array (
                    'permission_id' => 161,
                    'role_id' => 2,
                ),
            209 => 
                array (
                    'permission_id' => 162,
                    'role_id' => 2,
                ),
            210 =>
                array(
                    'permission_id' => 163,
                    'role_id' => 2,
                ),
            211 =>
                array(
                    'permission_id' => 164,
                    'role_id' => 2,
                ),
            212 =>
                array(
                    'permission_id' => 165,
                    'role_id' => 2,
                ),
            213 =>
                array(
                    'permission_id' => 166,
                    'role_id' => 2,
                ),
            214 => 
                array (
                    'permission_id' => 167,
                    'role_id' => 2,
                ),
            215 => 
                array (
                    'permission_id' => 168,
                    'role_id' => 2,
                ),
            216 =>
                array(
                    'permission_id' => 169,
                    'role_id' => 2,
                ),
            217 =>
                array(
                    'permission_id' => 170,
                    'role_id' => 2,
                ),
            218 =>
                array(
                    'permission_id' => 171,
                    'role_id' => 2,
                ),
            219 =>
                array(
                    'permission_id' => 172,
                    'role_id' => 2,
                ),
            220 => 
                array (
                    'permission_id' => 173,
                    'role_id' => 2,
                ),
            221 => 
                array (
                    'permission_id' => 174,
                    'role_id' => 2,
                ),
            222 =>
                array(
                    'permission_id' => 175,
                    'role_id' => 2,
                ),
            223 =>
                array(
                    'permission_id' => 176,
                    'role_id' => 2,
                ),
            224 =>
                array(
                    'permission_id' => 177,
                    'role_id' => 2,
                ),
            225 =>
                array(
                    'permission_id' => 178,
                    'role_id' => 2,
                ),
            226 => 
                array (
                    'permission_id' => 179,
                    'role_id' => 2,
                ),
            227 => 
                array (
                    'permission_id' => 180,
                    'role_id' => 2,
                ),
            228 =>
                array(
                    'permission_id' => 181,
                    'role_id' => 2,
                ),
            229 =>
                array(
                    'permission_id' => 182,
                    'role_id' => 2,
                ),
            230 =>
                array(
                    'permission_id' => 183,
                    'role_id' => 2,
                ),
            231 =>
                array(
                    'permission_id' => 184,
                    'role_id' => 2,
                ),
            232 => 
                array (
                    'permission_id' => 185,
                    'role_id' => 2,
                ),
            233 => 
                array (
                    'permission_id' => 186,
                    'role_id' => 2,
                ),
            234 =>
                array(
                    'permission_id' => 187,
                    'role_id' => 2,
                ),
            235 =>
                array(
                    'permission_id' => 188,
                    'role_id' => 2,
                ),
            236 =>
                array(
                    'permission_id' => 189,
                    'role_id' => 2,
                ),
            237 =>
                array(
                    'permission_id' => 190,
                    'role_id' => 2,
                ),
            238 => 
                array (
                    'permission_id' => 191,
                    'role_id' => 2,
                ),
            239 => 
                array (
                    'permission_id' => 192,
                    'role_id' => 2,
                ),
                

            240 =>
                array(
                    'permission_id' => 243,
                    'role_id' => 2,
                ),
            241 =>
                array(
                    'permission_id' => 244,
                    'role_id' => 2,
                ),
            242 =>
                array(
                    'permission_id' => 245,
                    'role_id' => 2,
                ),
            243 =>
                array(
                    'permission_id' => 246,
                    'role_id' => 2,
                ),
            244 => 
                array (
                    'permission_id' => 247,
                    'role_id' => 2,
                ),
            245 => 
                array (
                    'permission_id' => 248,
                    'role_id' => 2,
                ),
            246 => 
                array (
                    'permission_id' => 249,
                    'role_id' => 2,
                ),
            247 =>
                array(
                    'permission_id' => 250,
                    'role_id' => 2,
                ),
            248 =>
                array(
                    'permission_id' => 251,
                    'role_id' => 2,
                ),
            249 =>
                array(
                    'permission_id' => 252,
                    'role_id' => 2,
                ),
            250 => 
                array (
                    'permission_id' => 253,
                    'role_id' => 2,
                ),
            251 => 
                array (
                    'permission_id' => 254,
                    'role_id' => 2,
                ),
            252 => 
                array (
                    'permission_id' => 255,
                    'role_id' => 2,
                ),
        ));
        
        
    }
}