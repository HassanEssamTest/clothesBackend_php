<?php

use App\Models\Shop;
use Illuminate\Database\Seeder;

class CustomerShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('shops')->insertOrIgnore(
            array(
                'id'=>'1',
                'name' => 'Fawry',
                'description' => 'Clothes from other users',
                'latitude' => '37.4226133580664',
                'longitude' => '-122.086759655962',
                'information' => '<p>Monday - Thursday 10:00AM - 11:00PM</p><p>Friday - Sunday 12:00PM - 5:00AM<br></p>',
                'admin_commission' => 10.0,
                'delivery_fee' => 4.0,
                'delivery_range' => 7.0,
                'default_tax' => 0.0,
                'closed' => 0,
                'available_for_delivery' => 1,
                'created_at' => '2019-08-30 12:17:02',
                'updated_at' => '2020-03-29 17:36:19',
            ));
    //    Shop::insertOrIgnore($data);
    }
}
