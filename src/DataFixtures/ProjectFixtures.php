<?php

namespace App\DataFixtures;

use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use DateTime;

class ProjectFixtures extends Fixture implements DependentFixtureInterface
{
    public const array PROJECTS = [
        [
            'name' => "Mon Portfolio",
            'start' => '2024-06-01',
            'end' => '2024-08-07',
            'site' => "https://styvens-wentz.fr/",
            'github' => "https://github.com/styvens-w/styvenswentzV2",
            'description' => "Mon portfolio - Le site que vous visitez actuellement ",
            'activity' => "activity_3",
        ],
        [
            'name' => "ETS Gaveriaux Raywan",
            'start' => '2023-06-01',
            'end' => '2023-08-07',
            'site' => "https://ets-raywangaveriaux.pro/",
            'github' => "",
            'description' => "Site réalisé pour un professionnel du bâtiment",
            'activity' => "activity_3",
        ],
        [
            'name' => "Faites passer une librairie jQuery vers React",
            'start' => '2023-01-01',
            'end' => '2023-03-01',
            'site' => "",
            'github' => "https://github.com/styvens-w/faites_passer_une_librairie_jquery_vers_react",
            'description' => "Dans ce projet, vous participerez à la conversion d’une application de jQuery vers React pour une grande société 
                financière.
                Votre mission principale sera de refondre les pages clés de l’application en remplaçant un plugin jQuery spécifique par un composant 
                React.
                Cela impliquera une compréhension approfondie des deux technologies et leur interaction.
                Vous serez chargé de mesurer les performances de l'application avant et après la conversion. Cette analyse de performance vous 
                permettra de quantifier les avantages de la migration vers React.
                La documentation du composant converti sera une étape importante de votre travail. Cela comprendra la rédaction de documents 
                techniques détaillant l'architecture du composant, son fonctionnement, et les raisons de sa conception.
                Vous livrerez les résultats de votre travail avec des rapports détaillés, y compris des analyses de performance et des explications 
                sur les choix techniques effectués pendant la conversion.",
            'activity' => "activity_1",
        ],
        [
            'name' => "Utilisez une API pour un compte utilisateur bancaire avec React",
            'start' => '2023-03-05',
            'end' => '2023-04-01',
            'site' => "",
            'github' => "https://github.com/styvens-w/utilisez_une_api_pour_un_compte_utilisateur_bancaire_avec_react",
            'description' => "Dans ce projet, vous travaillerez sur le développement front-end d’une application bancaire en utilisant React et Redux 
                pour créer une expérience utilisateur dynamique et réactive.
                Votre mission principale sera d'intégrer le front-end avec le back-end via des appels API.
                Vous écrirez des appels à l'API REST pour connecter les deux parties de l'application, assurant une communication fluide entre le 
                client et le serveur.
                Vous utiliserez React pour développer l'interface utilisateur de l'application bancaire, en vous concentrant sur la création d'un 
                tableau de bord complet et responsive pour les utilisateurs.
                Redux sera utilisé pour gérer les données de l'application. Cela vous permettra de maintenir un état global cohérent à travers 
                l'application.
                Pour définir les points d'accès de l'API et modéliser les interactions avec les données des transactions, vous utiliserez Swagger. 
                Cet outil vous aidera à décrire les différentes routes et actions nécessaires pour l'API.
                Vous utiliserez Node.js pour exécuter le code JavaScript côté serveur. Cela vous donnera une expérience pratique de la gestion d'une 
                application full-stack.",
            'activity' => "activity_1",
        ],
        [
            'name' => "La Planche à Vins",
            'start' => '2020-06-01',
            'end' => '2020-06-30',
            'site' => "https://laplancheavins.site/",
            'github' => "",
            'description' => "Site réalisé pour un restaurateur",
            'activity' => "activity_3",
        ],
        [
            'name' => "Deezer",
            'start' => '2024-08-01',
            'end' => '2024-08-30',
            'site' => "https://www.deezer.com/fr/",
            'github' => "",
            'description' => "Le celebre site deezer",
            'activity' => "activity_4",
        ],
        [
            'name' => "Midi A Tech",
            'start' => '2024-09-02',
            'end' => '2024-09-30',
            'site' => "",
            'github' => "https://github.com/WildCodeSchool-2024-02/PHP-REM-POEC-05-MidiATech",
            'description' => "Projet de formation. Ont devaient réaliser un site pour une médiatech",
            'activity' => "activity_0",
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PROJECTS as $key => $projects) {
            $project = new Project();
            $project->setName($projects['name']);
            $project->setStart(new DateTime($projects['start']));
            $project->setEnd(new DateTime($projects['end']));
            $project->setSite($projects['site']);
            $project->setGithub($projects['github']);
            $project->setDescription($projects['description']);
            $project->setActivity($this->getReference($projects['activity']));
            $manager->persist($project);
            $this->addReference('project_' . $key, $project);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ActivityFixtures::class,
        ];
    }
}
