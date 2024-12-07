<?php

namespace App\Services\Domoplaner;

/**
 * DomoplanerFeedService получение данных обо всех квартирах
 */
class DomoplanerFeedService extends DomoplanerBaseService
{
    const CACHE_KEY = 'all';

     /**
     * getAllItems
     * Получение данных обо всех квартирах
     * @return array
     */
    public function getAllItems(): array
    {
        $data = $this->getFeed();

        if(!$data){
            return $this->error();
        }

        return $data;
    }

    /**
     * getFeed
     * Проверяет наличие данных в кеше. Если в кеше нет данных, то выполняет запрос к домопланеру
     * @return array
     */
    private function getFeed(): array|null
    {
        $data = $this->getCache(self::CACHE_KEY);

        if (empty($data) || !isset($data['data'])) {

            $url = config('domoplaner.feed_url');

            $data = $this->request([
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_CUSTOMREQUEST => 'GET'
            ]);

            if (!$data) {
                return null;
            }
            $this->setCache(self::CACHE_KEY, $data);
        }

        $parsed = json_decode($data, 1);

        return $parsed['data'];
    }
}
