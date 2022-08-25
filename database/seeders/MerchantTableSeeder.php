<?php

namespace Database\Seeders;

use App\Models\Merchant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MerchantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
      $merchant = new Merchant();
      $merchant->external_id = 6;
      $merchant->key = 'KaTf5tZYHx4v7pgZ';
      $merchant->save();

      $merchant = new Merchant();
      $merchant->external_id = 816;
      $merchant->key = 'rTaasVHeteGbhwBx';
      $merchant->save();
    }
}
