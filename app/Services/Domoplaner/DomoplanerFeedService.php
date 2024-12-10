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
     * Тип объекта -
     *      null - будут возвращены все доступные фиду объекты
     *      0 - квартиры
     *      1 - паркинги
     *      2 - кладовые
     * @param  int $type - Тип объекта
     * @return array
     */

    public function getAllItems(int $type = null, array $filters = []): array
    {
        $data = $this->getFeed();

        if (!$data) {
            return $this->error();
        }

        if (!$type) {
            return $data;
        }

        return $this->mapData($data, $type);
    }

    /**
     * getFeed
     * Проверяет наличие данных в кеше. Если в кеше нет данных, то выполняет запрос к домопланеру
     * @return array
     */
    private function getFeed(): array|null
    {
        $data = $this->getCache(self::CACHE_KEY);

        if (empty($data)) {
            $url = config('domoplaner.feed_url');

            $data = $this->request([
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_CUSTOMREQUEST => 'GET'
            ]);


            $this->setCache(self::CACHE_KEY, $data);
        }

        $parsed = json_decode($data, 1);

        return $parsed['data'];
    }


    public function mapData(array $data, int $type) :array
    {
        $mapped = [];

        foreach($data as $item){
            if($item['type'] !== $type){
                continue;
            }
            $mapped[] = $item;
        }

        return $mapped;
    }
}
