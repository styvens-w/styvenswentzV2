<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ActivityFixtures extends Fixture implements DependentFixtureInterface
{
    public const array ACTIVITIES = [
        [
            'name' => "Développeur PHP Symfony",
            'compagny' => "Wild Code School",
            'start' => 2024,
            'end' => 2024,
            'degree' => "",
            'type' => "type_Formation",
        ],
        [
            'name' => "Développeur d'Application JavaScript React",
            'compagny' => "OpenClassRooms",
            'start' => 2022,
            'end' => 2023,
            'degree' => "Bac+ 3/4",
            'type' => "type_Formation",
        ],
        [
            'name' => "Développeur Web et Web Mobile ",
            'compagny' => "UP TO Fourmies",
            'start' => 2019,
            'end' => 2020,
            'degree' => "Bac+ 2",
            'type' => "type_Formation",
        ],
        [
            'name' => "Side Project",
            'compagny' => "",
            'start' => 2020,
            'end' => null,
            'degree' => "",
            'type' => "type_Indépendant",
        ],
        [
            'name' => "Développeur Web",
            'compagny' => "Deezer",
            'start' => 2024,
            'end' => null,
            'degree' => "",
            'type' => "type_Expérience",
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::ACTIVITIES as $key => $activities) {
            $activity = new Activity();
            $activity->setName($activities['name']);
            $activity->setCompagny($activities['compagny']);
            $activity->setStart($activities['start']);
            $activity->setEnd($activities['end']);
            $activity->setDegree($activities['degree']);
            $activity->setType($this->getReference($activities['type']));
            $manager->persist($activity);
            $this->addReference('activity_' . $key, $activity);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            TypeFixtures::class,
        ];
    }
}
