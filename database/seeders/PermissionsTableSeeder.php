<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 418,
                'name' => 'view_attachment',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            1 => 
            array (
                'id' => 419,
                'name' => 'view_any_attachment',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            2 => 
            array (
                'id' => 420,
                'name' => 'create_attachment',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            3 => 
            array (
                'id' => 421,
                'name' => 'update_attachment',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            4 => 
            array (
                'id' => 422,
                'name' => 'restore_attachment',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            5 => 
            array (
                'id' => 423,
                'name' => 'restore_any_attachment',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            6 => 
            array (
                'id' => 424,
                'name' => 'replicate_attachment',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            7 => 
            array (
                'id' => 425,
                'name' => 'reorder_attachment',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            8 => 
            array (
                'id' => 426,
                'name' => 'delete_attachment',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            9 => 
            array (
                'id' => 427,
                'name' => 'delete_any_attachment',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            10 => 
            array (
                'id' => 428,
                'name' => 'force_delete_attachment',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            11 => 
            array (
                'id' => 429,
                'name' => 'force_delete_any_attachment',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            12 => 
            array (
                'id' => 430,
                'name' => 'view_contact::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            13 => 
            array (
                'id' => 431,
                'name' => 'view_any_contact::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            14 => 
            array (
                'id' => 432,
                'name' => 'create_contact::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            15 => 
            array (
                'id' => 433,
                'name' => 'update_contact::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            16 => 
            array (
                'id' => 434,
                'name' => 'restore_contact::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            17 => 
            array (
                'id' => 435,
                'name' => 'restore_any_contact::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            18 => 
            array (
                'id' => 436,
                'name' => 'replicate_contact::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            19 => 
            array (
                'id' => 437,
                'name' => 'reorder_contact::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            20 => 
            array (
                'id' => 438,
                'name' => 'delete_contact::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            21 => 
            array (
                'id' => 439,
                'name' => 'delete_any_contact::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            22 => 
            array (
                'id' => 440,
                'name' => 'force_delete_contact::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            23 => 
            array (
                'id' => 441,
                'name' => 'force_delete_any_contact::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            24 => 
            array (
                'id' => 442,
                'name' => 'view_country',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            25 => 
            array (
                'id' => 443,
                'name' => 'view_any_country',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            26 => 
            array (
                'id' => 444,
                'name' => 'create_country',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            27 => 
            array (
                'id' => 445,
                'name' => 'update_country',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            28 => 
            array (
                'id' => 446,
                'name' => 'restore_country',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            29 => 
            array (
                'id' => 447,
                'name' => 'restore_any_country',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            30 => 
            array (
                'id' => 448,
                'name' => 'replicate_country',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            31 => 
            array (
                'id' => 449,
                'name' => 'reorder_country',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            32 => 
            array (
                'id' => 450,
                'name' => 'delete_country',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            33 => 
            array (
                'id' => 451,
                'name' => 'delete_any_country',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            34 => 
            array (
                'id' => 452,
                'name' => 'force_delete_country',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            35 => 
            array (
                'id' => 453,
                'name' => 'force_delete_any_country',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            36 => 
            array (
                'id' => 454,
                'name' => 'view_featured::user',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            37 => 
            array (
                'id' => 455,
                'name' => 'view_any_featured::user',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            38 => 
            array (
                'id' => 456,
                'name' => 'create_featured::user',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            39 => 
            array (
                'id' => 457,
                'name' => 'update_featured::user',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            40 => 
            array (
                'id' => 458,
                'name' => 'restore_featured::user',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            41 => 
            array (
                'id' => 459,
                'name' => 'restore_any_featured::user',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            42 => 
            array (
                'id' => 460,
                'name' => 'replicate_featured::user',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            43 => 
            array (
                'id' => 461,
                'name' => 'reorder_featured::user',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            44 => 
            array (
                'id' => 462,
                'name' => 'delete_featured::user',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            45 => 
            array (
                'id' => 463,
                'name' => 'delete_any_featured::user',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            46 => 
            array (
                'id' => 464,
                'name' => 'force_delete_featured::user',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            47 => 
            array (
                'id' => 465,
                'name' => 'force_delete_any_featured::user',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            48 => 
            array (
                'id' => 466,
                'name' => 'view_global::announcement',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            49 => 
            array (
                'id' => 467,
                'name' => 'view_any_global::announcement',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            50 => 
            array (
                'id' => 468,
                'name' => 'create_global::announcement',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            51 => 
            array (
                'id' => 469,
                'name' => 'update_global::announcement',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            52 => 
            array (
                'id' => 470,
                'name' => 'restore_global::announcement',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            53 => 
            array (
                'id' => 471,
                'name' => 'restore_any_global::announcement',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            54 => 
            array (
                'id' => 472,
                'name' => 'replicate_global::announcement',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            55 => 
            array (
                'id' => 473,
                'name' => 'reorder_global::announcement',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            56 => 
            array (
                'id' => 474,
                'name' => 'delete_global::announcement',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            57 => 
            array (
                'id' => 475,
                'name' => 'delete_any_global::announcement',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            58 => 
            array (
                'id' => 476,
                'name' => 'force_delete_global::announcement',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            59 => 
            array (
                'id' => 477,
                'name' => 'force_delete_any_global::announcement',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            60 => 
            array (
                'id' => 478,
                'name' => 'view_invoice',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            61 => 
            array (
                'id' => 479,
                'name' => 'view_any_invoice',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            62 => 
            array (
                'id' => 480,
                'name' => 'create_invoice',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            63 => 
            array (
                'id' => 481,
                'name' => 'update_invoice',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            64 => 
            array (
                'id' => 482,
                'name' => 'restore_invoice',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            65 => 
            array (
                'id' => 483,
                'name' => 'restore_any_invoice',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            66 => 
            array (
                'id' => 484,
                'name' => 'replicate_invoice',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            67 => 
            array (
                'id' => 485,
                'name' => 'reorder_invoice',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            68 => 
            array (
                'id' => 486,
                'name' => 'delete_invoice',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            69 => 
            array (
                'id' => 487,
                'name' => 'delete_any_invoice',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            70 => 
            array (
                'id' => 488,
                'name' => 'force_delete_invoice',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            71 => 
            array (
                'id' => 489,
                'name' => 'force_delete_any_invoice',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            72 => 
            array (
                'id' => 490,
                'name' => 'view_notification',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            73 => 
            array (
                'id' => 491,
                'name' => 'view_any_notification',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            74 => 
            array (
                'id' => 492,
                'name' => 'create_notification',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            75 => 
            array (
                'id' => 493,
                'name' => 'update_notification',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            76 => 
            array (
                'id' => 494,
                'name' => 'restore_notification',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            77 => 
            array (
                'id' => 495,
                'name' => 'restore_any_notification',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            78 => 
            array (
                'id' => 496,
                'name' => 'replicate_notification',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            79 => 
            array (
                'id' => 497,
                'name' => 'reorder_notification',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            80 => 
            array (
                'id' => 498,
                'name' => 'delete_notification',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            81 => 
            array (
                'id' => 499,
                'name' => 'delete_any_notification',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            82 => 
            array (
                'id' => 500,
                'name' => 'force_delete_notification',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            83 => 
            array (
                'id' => 501,
                'name' => 'force_delete_any_notification',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            84 => 
            array (
                'id' => 502,
                'name' => 'view_payment::request',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            85 => 
            array (
                'id' => 503,
                'name' => 'view_any_payment::request',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            86 => 
            array (
                'id' => 504,
                'name' => 'create_payment::request',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            87 => 
            array (
                'id' => 505,
                'name' => 'update_payment::request',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            88 => 
            array (
                'id' => 506,
                'name' => 'restore_payment::request',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            89 => 
            array (
                'id' => 507,
                'name' => 'restore_any_payment::request',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            90 => 
            array (
                'id' => 508,
                'name' => 'replicate_payment::request',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            91 => 
            array (
                'id' => 509,
                'name' => 'reorder_payment::request',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            92 => 
            array (
                'id' => 510,
                'name' => 'delete_payment::request',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            93 => 
            array (
                'id' => 511,
                'name' => 'delete_any_payment::request',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            94 => 
            array (
                'id' => 512,
                'name' => 'force_delete_payment::request',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            95 => 
            array (
                'id' => 513,
                'name' => 'force_delete_any_payment::request',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            96 => 
            array (
                'id' => 514,
                'name' => 'view_poll',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            97 => 
            array (
                'id' => 515,
                'name' => 'view_any_poll',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            98 => 
            array (
                'id' => 516,
                'name' => 'create_poll',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            99 => 
            array (
                'id' => 517,
                'name' => 'update_poll',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            100 => 
            array (
                'id' => 518,
                'name' => 'restore_poll',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            101 => 
            array (
                'id' => 519,
                'name' => 'restore_any_poll',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            102 => 
            array (
                'id' => 520,
                'name' => 'replicate_poll',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            103 => 
            array (
                'id' => 521,
                'name' => 'reorder_poll',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            104 => 
            array (
                'id' => 522,
                'name' => 'delete_poll',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            105 => 
            array (
                'id' => 523,
                'name' => 'delete_any_poll',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            106 => 
            array (
                'id' => 524,
                'name' => 'force_delete_poll',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            107 => 
            array (
                'id' => 525,
                'name' => 'force_delete_any_poll',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            108 => 
            array (
                'id' => 526,
                'name' => 'view_poll::answer',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            109 => 
            array (
                'id' => 527,
                'name' => 'view_any_poll::answer',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            110 => 
            array (
                'id' => 528,
                'name' => 'create_poll::answer',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            111 => 
            array (
                'id' => 529,
                'name' => 'update_poll::answer',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            112 => 
            array (
                'id' => 530,
                'name' => 'restore_poll::answer',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            113 => 
            array (
                'id' => 531,
                'name' => 'restore_any_poll::answer',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            114 => 
            array (
                'id' => 532,
                'name' => 'replicate_poll::answer',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            115 => 
            array (
                'id' => 533,
                'name' => 'reorder_poll::answer',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            116 => 
            array (
                'id' => 534,
                'name' => 'delete_poll::answer',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            117 => 
            array (
                'id' => 535,
                'name' => 'delete_any_poll::answer',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            118 => 
            array (
                'id' => 536,
                'name' => 'force_delete_poll::answer',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            119 => 
            array (
                'id' => 537,
                'name' => 'force_delete_any_poll::answer',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            120 => 
            array (
                'id' => 538,
                'name' => 'view_poll::user::answer',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            121 => 
            array (
                'id' => 539,
                'name' => 'view_any_poll::user::answer',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            122 => 
            array (
                'id' => 540,
                'name' => 'create_poll::user::answer',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            123 => 
            array (
                'id' => 541,
                'name' => 'update_poll::user::answer',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            124 => 
            array (
                'id' => 542,
                'name' => 'restore_poll::user::answer',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            125 => 
            array (
                'id' => 543,
                'name' => 'restore_any_poll::user::answer',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            126 => 
            array (
                'id' => 544,
                'name' => 'replicate_poll::user::answer',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            127 => 
            array (
                'id' => 545,
                'name' => 'reorder_poll::user::answer',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            128 => 
            array (
                'id' => 546,
                'name' => 'delete_poll::user::answer',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            129 => 
            array (
                'id' => 547,
                'name' => 'delete_any_poll::user::answer',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            130 => 
            array (
                'id' => 548,
                'name' => 'force_delete_poll::user::answer',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            131 => 
            array (
                'id' => 549,
                'name' => 'force_delete_any_poll::user::answer',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            132 => 
            array (
                'id' => 550,
                'name' => 'view_post',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            133 => 
            array (
                'id' => 551,
                'name' => 'view_any_post',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            134 => 
            array (
                'id' => 552,
                'name' => 'create_post',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            135 => 
            array (
                'id' => 553,
                'name' => 'update_post',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            136 => 
            array (
                'id' => 554,
                'name' => 'restore_post',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            137 => 
            array (
                'id' => 555,
                'name' => 'restore_any_post',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            138 => 
            array (
                'id' => 556,
                'name' => 'replicate_post',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            139 => 
            array (
                'id' => 557,
                'name' => 'reorder_post',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            140 => 
            array (
                'id' => 558,
                'name' => 'delete_post',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            141 => 
            array (
                'id' => 559,
                'name' => 'delete_any_post',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            142 => 
            array (
                'id' => 560,
                'name' => 'force_delete_post',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            143 => 
            array (
                'id' => 561,
                'name' => 'force_delete_any_post',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            144 => 
            array (
                'id' => 562,
                'name' => 'view_post::comment',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            145 => 
            array (
                'id' => 563,
                'name' => 'view_any_post::comment',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            146 => 
            array (
                'id' => 564,
                'name' => 'create_post::comment',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            147 => 
            array (
                'id' => 565,
                'name' => 'update_post::comment',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            148 => 
            array (
                'id' => 566,
                'name' => 'restore_post::comment',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            149 => 
            array (
                'id' => 567,
                'name' => 'restore_any_post::comment',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            150 => 
            array (
                'id' => 568,
                'name' => 'replicate_post::comment',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            151 => 
            array (
                'id' => 569,
                'name' => 'reorder_post::comment',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            152 => 
            array (
                'id' => 570,
                'name' => 'delete_post::comment',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            153 => 
            array (
                'id' => 571,
                'name' => 'delete_any_post::comment',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            154 => 
            array (
                'id' => 572,
                'name' => 'force_delete_post::comment',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            155 => 
            array (
                'id' => 573,
                'name' => 'force_delete_any_post::comment',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            156 => 
            array (
                'id' => 574,
                'name' => 'view_public::page',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            157 => 
            array (
                'id' => 575,
                'name' => 'view_any_public::page',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            158 => 
            array (
                'id' => 576,
                'name' => 'create_public::page',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            159 => 
            array (
                'id' => 577,
                'name' => 'update_public::page',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            160 => 
            array (
                'id' => 578,
                'name' => 'restore_public::page',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            161 => 
            array (
                'id' => 579,
                'name' => 'restore_any_public::page',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            162 => 
            array (
                'id' => 580,
                'name' => 'replicate_public::page',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            163 => 
            array (
                'id' => 581,
                'name' => 'reorder_public::page',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            164 => 
            array (
                'id' => 582,
                'name' => 'delete_public::page',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            165 => 
            array (
                'id' => 583,
                'name' => 'delete_any_public::page',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            166 => 
            array (
                'id' => 584,
                'name' => 'force_delete_public::page',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            167 => 
            array (
                'id' => 585,
                'name' => 'force_delete_any_public::page',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            168 => 
            array (
                'id' => 586,
                'name' => 'view_reaction',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            169 => 
            array (
                'id' => 587,
                'name' => 'view_any_reaction',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            170 => 
            array (
                'id' => 588,
                'name' => 'create_reaction',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            171 => 
            array (
                'id' => 589,
                'name' => 'update_reaction',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            172 => 
            array (
                'id' => 590,
                'name' => 'restore_reaction',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            173 => 
            array (
                'id' => 591,
                'name' => 'restore_any_reaction',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            174 => 
            array (
                'id' => 592,
                'name' => 'replicate_reaction',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            175 => 
            array (
                'id' => 593,
                'name' => 'reorder_reaction',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            176 => 
            array (
                'id' => 594,
                'name' => 'delete_reaction',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            177 => 
            array (
                'id' => 595,
                'name' => 'delete_any_reaction',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            178 => 
            array (
                'id' => 596,
                'name' => 'force_delete_reaction',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            179 => 
            array (
                'id' => 597,
                'name' => 'force_delete_any_reaction',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            180 => 
            array (
                'id' => 598,
                'name' => 'view_reward',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            181 => 
            array (
                'id' => 599,
                'name' => 'view_any_reward',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            182 => 
            array (
                'id' => 600,
                'name' => 'create_reward',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            183 => 
            array (
                'id' => 601,
                'name' => 'update_reward',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            184 => 
            array (
                'id' => 602,
                'name' => 'restore_reward',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            185 => 
            array (
                'id' => 603,
                'name' => 'restore_any_reward',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            186 => 
            array (
                'id' => 604,
                'name' => 'replicate_reward',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            187 => 
            array (
                'id' => 605,
                'name' => 'reorder_reward',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            188 => 
            array (
                'id' => 606,
                'name' => 'delete_reward',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            189 => 
            array (
                'id' => 607,
                'name' => 'delete_any_reward',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            190 => 
            array (
                'id' => 608,
                'name' => 'force_delete_reward',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            191 => 
            array (
                'id' => 609,
                'name' => 'force_delete_any_reward',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            192 => 
            array (
                'id' => 610,
                'name' => 'view_role',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            193 => 
            array (
                'id' => 611,
                'name' => 'view_any_role',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            194 => 
            array (
                'id' => 612,
                'name' => 'create_role',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            195 => 
            array (
                'id' => 613,
                'name' => 'update_role',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            196 => 
            array (
                'id' => 614,
                'name' => 'delete_role',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            197 => 
            array (
                'id' => 615,
                'name' => 'delete_any_role',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            198 => 
            array (
                'id' => 616,
                'name' => 'view_stream',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            199 => 
            array (
                'id' => 617,
                'name' => 'view_any_stream',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            200 => 
            array (
                'id' => 618,
                'name' => 'create_stream',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            201 => 
            array (
                'id' => 619,
                'name' => 'update_stream',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            202 => 
            array (
                'id' => 620,
                'name' => 'restore_stream',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            203 => 
            array (
                'id' => 621,
                'name' => 'restore_any_stream',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            204 => 
            array (
                'id' => 622,
                'name' => 'replicate_stream',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            205 => 
            array (
                'id' => 623,
                'name' => 'reorder_stream',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            206 => 
            array (
                'id' => 624,
                'name' => 'delete_stream',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            207 => 
            array (
                'id' => 625,
                'name' => 'delete_any_stream',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            208 => 
            array (
                'id' => 626,
                'name' => 'force_delete_stream',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            209 => 
            array (
                'id' => 627,
                'name' => 'force_delete_any_stream',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            210 => 
            array (
                'id' => 628,
                'name' => 'view_stream::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            211 => 
            array (
                'id' => 629,
                'name' => 'view_any_stream::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            212 => 
            array (
                'id' => 630,
                'name' => 'create_stream::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            213 => 
            array (
                'id' => 631,
                'name' => 'update_stream::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            214 => 
            array (
                'id' => 632,
                'name' => 'restore_stream::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            215 => 
            array (
                'id' => 633,
                'name' => 'restore_any_stream::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            216 => 
            array (
                'id' => 634,
                'name' => 'replicate_stream::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            217 => 
            array (
                'id' => 635,
                'name' => 'reorder_stream::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            218 => 
            array (
                'id' => 636,
                'name' => 'delete_stream::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            219 => 
            array (
                'id' => 637,
                'name' => 'delete_any_stream::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            220 => 
            array (
                'id' => 638,
                'name' => 'force_delete_stream::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            221 => 
            array (
                'id' => 639,
                'name' => 'force_delete_any_stream::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            222 => 
            array (
                'id' => 640,
                'name' => 'view_subscription',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            223 => 
            array (
                'id' => 641,
                'name' => 'view_any_subscription',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            224 => 
            array (
                'id' => 642,
                'name' => 'create_subscription',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            225 => 
            array (
                'id' => 643,
                'name' => 'update_subscription',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            226 => 
            array (
                'id' => 644,
                'name' => 'restore_subscription',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            227 => 
            array (
                'id' => 645,
                'name' => 'restore_any_subscription',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            228 => 
            array (
                'id' => 646,
                'name' => 'replicate_subscription',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            229 => 
            array (
                'id' => 647,
                'name' => 'reorder_subscription',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            230 => 
            array (
                'id' => 648,
                'name' => 'delete_subscription',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            231 => 
            array (
                'id' => 649,
                'name' => 'delete_any_subscription',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            232 => 
            array (
                'id' => 650,
                'name' => 'force_delete_subscription',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            233 => 
            array (
                'id' => 651,
                'name' => 'force_delete_any_subscription',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            234 => 
            array (
                'id' => 652,
                'name' => 'view_tax',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            235 => 
            array (
                'id' => 653,
                'name' => 'view_any_tax',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            236 => 
            array (
                'id' => 654,
                'name' => 'create_tax',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            237 => 
            array (
                'id' => 655,
                'name' => 'update_tax',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            238 => 
            array (
                'id' => 656,
                'name' => 'restore_tax',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            239 => 
            array (
                'id' => 657,
                'name' => 'restore_any_tax',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            240 => 
            array (
                'id' => 658,
                'name' => 'replicate_tax',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            241 => 
            array (
                'id' => 659,
                'name' => 'reorder_tax',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            242 => 
            array (
                'id' => 660,
                'name' => 'delete_tax',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            243 => 
            array (
                'id' => 661,
                'name' => 'delete_any_tax',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            244 => 
            array (
                'id' => 662,
                'name' => 'force_delete_tax',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            245 => 
            array (
                'id' => 663,
                'name' => 'force_delete_any_tax',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            246 => 
            array (
                'id' => 664,
                'name' => 'view_transaction',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            247 => 
            array (
                'id' => 665,
                'name' => 'view_any_transaction',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            248 => 
            array (
                'id' => 666,
                'name' => 'create_transaction',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            249 => 
            array (
                'id' => 667,
                'name' => 'update_transaction',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            250 => 
            array (
                'id' => 668,
                'name' => 'restore_transaction',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            251 => 
            array (
                'id' => 669,
                'name' => 'restore_any_transaction',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            252 => 
            array (
                'id' => 670,
                'name' => 'replicate_transaction',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            253 => 
            array (
                'id' => 671,
                'name' => 'reorder_transaction',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            254 => 
            array (
                'id' => 672,
                'name' => 'delete_transaction',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            255 => 
            array (
                'id' => 673,
                'name' => 'delete_any_transaction',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            256 => 
            array (
                'id' => 674,
                'name' => 'force_delete_transaction',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            257 => 
            array (
                'id' => 675,
                'name' => 'force_delete_any_transaction',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            258 => 
            array (
                'id' => 676,
                'name' => 'view_user',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            259 => 
            array (
                'id' => 677,
                'name' => 'view_any_user',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            260 => 
            array (
                'id' => 678,
                'name' => 'create_user',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            261 => 
            array (
                'id' => 679,
                'name' => 'update_user',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            262 => 
            array (
                'id' => 680,
                'name' => 'restore_user',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            263 => 
            array (
                'id' => 681,
                'name' => 'restore_any_user',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            264 => 
            array (
                'id' => 682,
                'name' => 'replicate_user',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            265 => 
            array (
                'id' => 683,
                'name' => 'reorder_user',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            266 => 
            array (
                'id' => 684,
                'name' => 'delete_user',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            267 => 
            array (
                'id' => 685,
                'name' => 'delete_any_user',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            268 => 
            array (
                'id' => 686,
                'name' => 'force_delete_user',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            269 => 
            array (
                'id' => 687,
                'name' => 'force_delete_any_user',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            270 => 
            array (
                'id' => 688,
                'name' => 'view_user::bookmark',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            271 => 
            array (
                'id' => 689,
                'name' => 'view_any_user::bookmark',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            272 => 
            array (
                'id' => 690,
                'name' => 'create_user::bookmark',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            273 => 
            array (
                'id' => 691,
                'name' => 'update_user::bookmark',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            274 => 
            array (
                'id' => 692,
                'name' => 'restore_user::bookmark',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            275 => 
            array (
                'id' => 693,
                'name' => 'restore_any_user::bookmark',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            276 => 
            array (
                'id' => 694,
                'name' => 'replicate_user::bookmark',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            277 => 
            array (
                'id' => 695,
                'name' => 'reorder_user::bookmark',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            278 => 
            array (
                'id' => 696,
                'name' => 'delete_user::bookmark',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            279 => 
            array (
                'id' => 697,
                'name' => 'delete_any_user::bookmark',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            280 => 
            array (
                'id' => 698,
                'name' => 'force_delete_user::bookmark',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            281 => 
            array (
                'id' => 699,
                'name' => 'force_delete_any_user::bookmark',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            282 => 
            array (
                'id' => 700,
                'name' => 'view_user::list',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            283 => 
            array (
                'id' => 701,
                'name' => 'view_any_user::list',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            284 => 
            array (
                'id' => 702,
                'name' => 'create_user::list',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            285 => 
            array (
                'id' => 703,
                'name' => 'update_user::list',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            286 => 
            array (
                'id' => 704,
                'name' => 'restore_user::list',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            287 => 
            array (
                'id' => 705,
                'name' => 'restore_any_user::list',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            288 => 
            array (
                'id' => 706,
                'name' => 'replicate_user::list',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            289 => 
            array (
                'id' => 707,
                'name' => 'reorder_user::list',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            290 => 
            array (
                'id' => 708,
                'name' => 'delete_user::list',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            291 => 
            array (
                'id' => 709,
                'name' => 'delete_any_user::list',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            292 => 
            array (
                'id' => 710,
                'name' => 'force_delete_user::list',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            293 => 
            array (
                'id' => 711,
                'name' => 'force_delete_any_user::list',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            294 => 
            array (
                'id' => 712,
                'name' => 'view_user::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            295 => 
            array (
                'id' => 713,
                'name' => 'view_any_user::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            296 => 
            array (
                'id' => 714,
                'name' => 'create_user::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            297 => 
            array (
                'id' => 715,
                'name' => 'update_user::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            298 => 
            array (
                'id' => 716,
                'name' => 'restore_user::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            299 => 
            array (
                'id' => 717,
                'name' => 'restore_any_user::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            300 => 
            array (
                'id' => 718,
                'name' => 'replicate_user::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            301 => 
            array (
                'id' => 719,
                'name' => 'reorder_user::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            302 => 
            array (
                'id' => 720,
                'name' => 'delete_user::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            303 => 
            array (
                'id' => 721,
                'name' => 'delete_any_user::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            304 => 
            array (
                'id' => 722,
                'name' => 'force_delete_user::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            305 => 
            array (
                'id' => 723,
                'name' => 'force_delete_any_user::message',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            306 => 
            array (
                'id' => 724,
                'name' => 'view_user::report',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            307 => 
            array (
                'id' => 725,
                'name' => 'view_any_user::report',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            308 => 
            array (
                'id' => 726,
                'name' => 'create_user::report',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            309 => 
            array (
                'id' => 727,
                'name' => 'update_user::report',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:26',
                'updated_at' => '2025-07-06 15:44:26',
            ),
            310 => 
            array (
                'id' => 728,
                'name' => 'restore_user::report',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            311 => 
            array (
                'id' => 729,
                'name' => 'restore_any_user::report',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            312 => 
            array (
                'id' => 730,
                'name' => 'replicate_user::report',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            313 => 
            array (
                'id' => 731,
                'name' => 'reorder_user::report',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            314 => 
            array (
                'id' => 732,
                'name' => 'delete_user::report',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            315 => 
            array (
                'id' => 733,
                'name' => 'delete_any_user::report',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            316 => 
            array (
                'id' => 734,
                'name' => 'force_delete_user::report',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            317 => 
            array (
                'id' => 735,
                'name' => 'force_delete_any_user::report',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            318 => 
            array (
                'id' => 736,
                'name' => 'view_user::tax',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            319 => 
            array (
                'id' => 737,
                'name' => 'view_any_user::tax',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            320 => 
            array (
                'id' => 738,
                'name' => 'create_user::tax',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            321 => 
            array (
                'id' => 739,
                'name' => 'update_user::tax',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            322 => 
            array (
                'id' => 740,
                'name' => 'restore_user::tax',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            323 => 
            array (
                'id' => 741,
                'name' => 'restore_any_user::tax',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            324 => 
            array (
                'id' => 742,
                'name' => 'replicate_user::tax',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            325 => 
            array (
                'id' => 743,
                'name' => 'reorder_user::tax',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            326 => 
            array (
                'id' => 744,
                'name' => 'delete_user::tax',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            327 => 
            array (
                'id' => 745,
                'name' => 'delete_any_user::tax',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            328 => 
            array (
                'id' => 746,
                'name' => 'force_delete_user::tax',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            329 => 
            array (
                'id' => 747,
                'name' => 'force_delete_any_user::tax',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            330 => 
            array (
                'id' => 748,
                'name' => 'view_user::verify',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            331 => 
            array (
                'id' => 749,
                'name' => 'view_any_user::verify',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            332 => 
            array (
                'id' => 750,
                'name' => 'create_user::verify',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            333 => 
            array (
                'id' => 751,
                'name' => 'update_user::verify',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            334 => 
            array (
                'id' => 752,
                'name' => 'restore_user::verify',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            335 => 
            array (
                'id' => 753,
                'name' => 'restore_any_user::verify',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            336 => 
            array (
                'id' => 754,
                'name' => 'replicate_user::verify',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            337 => 
            array (
                'id' => 755,
                'name' => 'reorder_user::verify',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            338 => 
            array (
                'id' => 756,
                'name' => 'delete_user::verify',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            339 => 
            array (
                'id' => 757,
                'name' => 'delete_any_user::verify',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            340 => 
            array (
                'id' => 758,
                'name' => 'force_delete_user::verify',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            341 => 
            array (
                'id' => 759,
                'name' => 'force_delete_any_user::verify',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            342 => 
            array (
                'id' => 760,
                'name' => 'view_wallet',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            343 => 
            array (
                'id' => 761,
                'name' => 'view_any_wallet',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            344 => 
            array (
                'id' => 762,
                'name' => 'create_wallet',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            345 => 
            array (
                'id' => 763,
                'name' => 'update_wallet',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            346 => 
            array (
                'id' => 764,
                'name' => 'restore_wallet',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            347 => 
            array (
                'id' => 765,
                'name' => 'restore_any_wallet',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            348 => 
            array (
                'id' => 766,
                'name' => 'replicate_wallet',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            349 => 
            array (
                'id' => 767,
                'name' => 'reorder_wallet',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            350 => 
            array (
                'id' => 768,
                'name' => 'delete_wallet',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            351 => 
            array (
                'id' => 769,
                'name' => 'delete_any_wallet',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            352 => 
            array (
                'id' => 770,
                'name' => 'force_delete_wallet',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            353 => 
            array (
                'id' => 771,
                'name' => 'force_delete_any_wallet',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            354 => 
            array (
                'id' => 772,
                'name' => 'view_withdrawal',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            355 => 
            array (
                'id' => 773,
                'name' => 'view_any_withdrawal',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            356 => 
            array (
                'id' => 774,
                'name' => 'create_withdrawal',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            357 => 
            array (
                'id' => 775,
                'name' => 'update_withdrawal',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            358 => 
            array (
                'id' => 776,
                'name' => 'restore_withdrawal',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            359 => 
            array (
                'id' => 777,
                'name' => 'restore_any_withdrawal',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            360 => 
            array (
                'id' => 778,
                'name' => 'replicate_withdrawal',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            361 => 
            array (
                'id' => 779,
                'name' => 'reorder_withdrawal',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            362 => 
            array (
                'id' => 780,
                'name' => 'delete_withdrawal',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            363 => 
            array (
                'id' => 781,
                'name' => 'delete_any_withdrawal',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            364 => 
            array (
                'id' => 782,
                'name' => 'force_delete_withdrawal',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            365 => 
            array (
                'id' => 783,
                'name' => 'force_delete_any_withdrawal',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            366 => 
            array (
                'id' => 784,
                'name' => 'page_ManageAdminSettings',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            367 => 
            array (
                'id' => 785,
                'name' => 'page_ManageAiSettings',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            368 => 
            array (
                'id' => 786,
                'name' => 'page_ManageCodeAndAdsSettings',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            369 => 
            array (
                'id' => 787,
                'name' => 'page_ManageColorsSettings',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            370 => 
            array (
                'id' => 788,
                'name' => 'page_ManageComplianceSettings',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            371 => 
            array (
                'id' => 789,
                'name' => 'page_ManageEmailsSettings',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            372 => 
            array (
                'id' => 790,
                'name' => 'page_ManageFeedSettings',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            373 => 
            array (
                'id' => 791,
                'name' => 'page_ManageGeneralSettings',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            374 => 
            array (
                'id' => 792,
                'name' => 'page_ManageLicenseSettings',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            375 => 
            array (
                'id' => 793,
                'name' => 'page_ManageMediaSettings',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            376 => 
            array (
                'id' => 794,
                'name' => 'page_ManagePaymentsSettings',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            377 => 
            array (
                'id' => 795,
                'name' => 'page_ManageProfilesSettings',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            378 => 
            array (
                'id' => 796,
                'name' => 'page_ManageReferralSettings',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            379 => 
            array (
                'id' => 797,
                'name' => 'page_ManageSecuritySettings',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            380 => 
            array (
                'id' => 798,
                'name' => 'page_ManageSocialSettings',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            381 => 
            array (
                'id' => 799,
                'name' => 'page_ManageStorageSettings',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            382 => 
            array (
                'id' => 800,
                'name' => 'page_ManageStreamsSettings',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            383 => 
            array (
                'id' => 801,
                'name' => 'page_ManageWebsocketsSettings',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            384 => 
            array (
                'id' => 802,
                'name' => 'page_ViewLog',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            385 => 
            array (
                'id' => 803,
                'name' => 'widget_StorageSymlinkWarningWidget',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            386 => 
            array (
                'id' => 804,
                'name' => 'widget_PdoMysqlndWarningWidget',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            387 => 
            array (
                'id' => 805,
                'name' => 'widget_StatsOverviewWidget',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            388 => 
            array (
                'id' => 806,
                'name' => 'widget_UsersChart',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:27',
                'updated_at' => '2025-07-06 15:44:27',
            ),
            389 => 
            array (
                'id' => 807,
                'name' => 'widget_PostsChart',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:28',
                'updated_at' => '2025-07-06 15:44:28',
            ),
            390 => 
            array (
                'id' => 808,
                'name' => 'widget_TransactionsChart',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:28',
                'updated_at' => '2025-07-06 15:44:28',
            ),
            391 => 
            array (
                'id' => 809,
                'name' => 'widget_StreamsChart',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:28',
                'updated_at' => '2025-07-06 15:44:28',
            ),
            392 => 
            array (
                'id' => 810,
                'name' => 'widget_ProductLinksWidget',
                'guard_name' => 'web',
                'created_at' => '2025-07-06 15:44:28',
                'updated_at' => '2025-07-06 15:44:28',
            ),
        ));
        
        
    }
}