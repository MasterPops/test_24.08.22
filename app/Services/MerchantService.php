<?php

namespace App\Services;

use App\Models\Payment;
use Exception;
use Illuminate\Support\Arr;

class MerchantService
{
  /**
   * @throws Exception
   */
  public function updatedPayment(array $data, string $signatureDelimiter)
  {
    if ($this->verifySignature($data['signature'], $data['received_data'],
      $signatureDelimiter, $data['key'], $data['hash'])) {

      $paymentModel = Payment::whereMerchantId($data['merchant_id'])
        ->whereExternalId($data['external_payment_id'])
        ->firstOrFail();

      $paymentModel->update([
        'status' => $data['status'],
      ]);
    } else {
      throw new Exception('Подпись не валидна!');
    }
  }

  public function verifySignature(string $signature, array $data, string $delimiter, string $key, string $hash): bool
  {
    return $signature === $this->generateSignature($data, $delimiter, $key, $hash);
  }

  public function generateSignature(array $data, string $delimiter, string $key, string $hash): string
  {
    $signature = '';
    $data = Arr::sort($data);

    foreach ($data as $field) {
      $signature .= $field . $delimiter;
    }

    $signature .= $key;


    return hash('sha256', $signature);
  }
}