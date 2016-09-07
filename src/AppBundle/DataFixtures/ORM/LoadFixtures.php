<?php
/**
 * Created by PhpStorm.
 * User: danbevan
 * Date: 06/09/2016
 * Time: 15:40
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use AppBundle\Entity\UserHobby;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;

class LoadFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $objects = Fixtures::load(
            __DIR__.'/fixtures.yml',
            $manager,
            [
                'providers' => [$this]
            ]
        );
    }

    public function name()
    {
        $names = [
            'Daniel',
            'Thomas',
            'David',
            'Henry',
            'Scott',
            'Sarah',
            'Nicola',
            'Rachel',
            'Andy',
            'Mark',
        ];

        $key = array_rand($names);
        return $names[$key];

    }

}