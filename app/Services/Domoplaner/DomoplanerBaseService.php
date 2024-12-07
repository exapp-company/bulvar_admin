<?php

namespace App\Services\Domoplaner;

use App\Enums\HttpStatus;
use App\Services\CurlRequestService;
use Illuminate\Support\Facades\Cache;

/**
 * DomoplanerBaseService общие методы для работы сервиса
 */
class DomoplanerBaseService
{
    /**
     * request
     * Выполняет запрос к домопланеру для получения данных
     * @return string|null
     */
    protected function request(array $options): string|null
    {
        $request = new CurlRequestService();
        $request->setOptions($options);
        $result = $request->execute();
        $request->close();

        if ($request->getInfo(CURLINFO_HTTP_CODE) !== HttpStatus::ok) {
            return null;
        }

        return $result;
    }

    /**
     * getCache
     * Получение данных по ключу
     * @param  string $key ключ
     * @return void
     */
    protected function getCache(string $key)
    {
        if (Cache::has($key)) {
            return Cache::get($key);
        }

        return null;
    }

    /**
     * setCache
     * Запись данных в кэш
     * @param  string $key
     * @param  string $data
     * @return void
     */
    protected function setCache(string $key, string $data): void
    {
        Cache::add($key, $data, 3600);
    }

    /**
     * error
     * Возвращение ошибки
     * @return array
     */
    protected function error(): array
    {
        return [
            'status' => 'error',
            'message' => 'Something went wrong. Try again later'
        ];
    }
}
