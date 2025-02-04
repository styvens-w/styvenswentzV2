<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use DateTime;
use Symfony\Component\String\Slugger\SluggerInterface;

class ActivityFixtures extends Fixture implements DependentFixtureInterface
{
    public const ACTIVITIES = [
        [
            'name' => "Développeur PHP Symfony",
            'compagny' => "Wild Code School",
            'start' => '2024-05-21',
            'end' => '2024-08-07',
            'degree' => "",
            'type' => "type_Formation",
        ],
        [
            'name' => "Développeur d'Application JavaScript React",
            'compagny' => "OpenClassRooms",
            'start' => '2022-07-07',
            'end' => '2023-09-06',
            'degree' => "Bac+ 3/4",
            'type' => "type_Formation",
        ],
        [
            'name' => "Développeur Web et Web Mobile ",
            'compagny' => "UP TO Fourmies",
            'start' => '2019-10-01',
            'end' => '2020-06-15',
            'degree' => "Bac+ 2",
            'type' => "type_Formation",
        ],
        [
            'name' => "Side Project",
            'compagny' => "",
            'start' => '2020-06-16',
            'end' => null,
            'degree' => "",
            'type' => "type_Indépendant",
        ],
        [
            'name' => "Développeur Web",
            'compagny' => "Deezer",
            'start' => '2024-09-01',
            'end' => null,
            'degree' => "",
            'type' => "type_Expérience",
        ],
    ];

    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::ACTIVITIES as $key => $activityData) {
            $activity = new Activity();
            $activity->setName($activityData['name']);
            $activity->setCompagny($activityData['compagny']);
            $activity->setStart(new DateTime($activityData['start']));
            $activity->setEnd($activityData['end'] ? new DateTime($activityData['end']) : null);
            $activity->setDegree($activityData['degree']);
            $activity->setType($this->getReference($activityData['type'], Type::class));
            $activity->setSlug($this->slugger->slug($activityData['name']));
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
