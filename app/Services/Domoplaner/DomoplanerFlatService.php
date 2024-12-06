<?php

namespace App\Services\Domoplaner;

use App\Services\Domoplaner\DomoplanerBaseService;

/**
 * DomoplanerFlatService получение данных по конретной квартире
 */
class DomoplanerFlatService extends DomoplanerBaseService
{

    public function getFlat(int $flatId): array
    {
        $data = $this->getCache('flat_' . $flatId);

        if (!$data) {
            $url = config('domoplaner.host') . 'flats?ids=' . $flatId;

            $token = config('domoplaner.api_token');

            $headers = [
                'Authorization: Bearer ' . $token
            ];

            $data = $this->request([
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => $headers
            ]);

            $this->setCache('flat_' . $flatId, $data);
        }


        $parsed = json_decode($data, 1);

        if(empty($parsed['flats'])){
            return $this->error();
        }

        return $parsed['flats'][0];

    }
}
