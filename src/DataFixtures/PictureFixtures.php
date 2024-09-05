<?php

namespace App\DataFixtures;

use App\Entity\Picture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PictureFixtures extends Fixture implements DependentFixtureInterface
{
    public const array PICTURES = [
        [
            'name' => "Mon Portfolio.webp",
            'project' => "project_0",
        ],
        [
            'name' => "ETS Gaveriaux Raywan.webp",
            'project' => "project_1",
        ],
        [
            'name' => "Faites passer une librairie jQuery vers React 1.webp",
            'project' => "project_2",
        ],
        [
            'name' => "Faites passer une librairie jQuery vers React 2.webp",
            'project' => "project_2",
        ],
        [
            'name' => "Faites passer une librairie jQuery vers React 3.webp",
            'project' => "project_2",
        ],
        [
            'name' => "Utilisez une API pour un compte utilisateur bancaire avec React 1.webp",
            'project' => "project_3",
        ],
        [
            'name' => "Utilisez une API pour un compte utilisateur bancaire avec React 2.webp",
            'project' => "project_3",
        ],
        [
            'name' => "Utilisez une API pour un compte utilisateur bancaire avec React 3.webp",
            'project' => "project_3",
        ],
        [
            'name' => "La planche à vins.webp",
            'project' => "project_4",
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PICTURES as $pictures) {
            $picture = new Picture();
            $picture->setName($pictures['name']);
            $picture->setProject($this->getReference($pictures['project']));
            $manager->persist($picture);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ProjectFixtures::class,
        ];
    }
}
