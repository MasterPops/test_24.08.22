<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Services\MerchantService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class MerchantController extends Controller
{
  /**
   * @throws Exception
   */
  public function merchantOne(MerchantService $merchantService, Request $request)
  {
    $receivedData = json_decode($request->getContent(), true);

    $signature = $receivedData['sign'];
    $receivedData = Arr::except($receivedData, ['sign']);

    $merchantModel = Merchant::whereExternalId($receivedData['merchant_id'])->firstOrFail();


    $data = [
      'received_data' => $receivedData,
      'signature' => $signature,
      'key' => $merchantModel->key,
      'merchant_id' => $merchantModel->id,
      'external_payment_id' => $receivedData['payment_id'],
      'status' => $receivedData['status'],
      'hash' => 'sha256',
    ];

    $merchantService->updatedPayment($data, ':');
  }

  /**
   * @throws Exception
   */
  public function merchantTwo(MerchantService $merchantService, Request $request)
  {
    $receivedData = $request->only([
      'project',
      'invoice',
      'status',
      'amount',
      'amount_paid',
      'rand',
    ]);

    $merchantModel = Merchant::whereExternalId($receivedData['project'])->firstOrFail();

    $signature = $request->header('authorization');

    $data = [
      'received_data' => $receivedData,
      'signature' => $signature,
      'key' => $merchantModel->key,
      'merchant_id' => $merchantModel->id,
      'external_payment_id' => $receivedData['invoice'],
      'status' => $receivedData['status'],
      'hash' => 'md5',
    ];

    $merchantService->updatedPayment($data, '.');
  }
}
