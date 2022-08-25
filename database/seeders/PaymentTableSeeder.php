<?php

namespace Database\Seeders;

use App\Models\Merchant;
use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
      $merchant = new Payment();
      $merchant->merchant_id = 1;
      $merchant->external_id = 13;
      $merchant->status = 'new';
      $merchant->amount = 500;
      $merchant->amount_paid = 500;
      $merchant->save();

      $merchant = new Payment();
      $merchant->merchant_id = 2;
      $merchant->external_id = 73;
      $merchant->status = 'created';
      $merchant->amount = 700;
      $merchant->amount_paid = 700;
      $merchant->save();
    }
}
