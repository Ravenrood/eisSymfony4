<?php
/**
 * Created by PhpStorm.
 * User: KamilWi
 * Date: 23.03.2019
 * Time: 20:44
 */
declare(strict_types=1);

namespace App\Service;

use Faker\Factory as Factory;

class GenerateUserList
{
    /**
     * @var array
     */
    private $userData = [];

    /**
     * Generate user array by given amount
     * @param int $amount
     * @return array
     */
    public function __invoke(int $amount): array
    {
        $this->userData = [];
        $generator = Factory::create();
        $counter = 0;
        while ($counter<$amount) {
            $this->userData[] = [
                'FirstName' => $generator->firstName,
                'LastName' => $generator->lastName,
                'Address' => $generator->address,
                ];
            $counter++;
        }
        return $this->userData;
    }
}