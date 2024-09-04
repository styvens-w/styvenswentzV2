<?php

namespace App\DataFixtures;

use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeFixtures extends Fixture
{
    public const array TYPES = [
        'Formation',
        'Expérience',
        'Indépendant',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::TYPES as $typeName) {
            $type = new Type();
            $type->setName($typeName);
            $manager->persist($type);
            $this->addReference('type_' . $typeName, $type);
        }

        $manager->flush();
    }
}
