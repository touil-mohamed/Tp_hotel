<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\Admin;
use Faker;

use App\Entity\Etablissement;

use App\Entity\Suite;

class AppFixtures extends Fixture
{
    private $userPasswordHasherInterface; 

    public function __construct (UserPasswordHasherInterface $userPasswordHasherInterface)
    {
    $this->userPasswordHasherInterface = $userPasswordHasherInterface;
    }

    public function loadAdmin(ObjectManager $manager) {
        $admin = new Admin();
        $admin->setEmail('momo@gmail.com');
        $admin->setRoles(['ROLE_ADMIN']);

        $admin->setPassword(
          $this->userPasswordHasherInterface->hashPassword(
            $admin, 'urgence93'
          )
        );

        $manager->persist($admin);
        $manager->flush();
    }
    public function loadEtablissement(ObjectManager $manager, $faker) {
        for($i=1; $i<=5;$i++) {
            // 1. Générer une nouvelle instance de l'entité
            $etablissement = new Etablissement();

            // 1bis. Préciser des valeurs pour les propriétés de votre
            // futur enregistrement
            $etablissement->setNom($faker->company());
            $etablissement->setAdresse($faker->streetAddress());
            $etablissement->setVille($faker->city());
            $etablissement->setDescription($faker->paragraph());

            // 2. Prendre en compte votre futur enregistrement
            // Pour un potentiel ajout dans la BDD (PAS DE SQL FAIT)

            $manager->persist($etablissement);
            $this->addReference('etablissement_'.$i, $etablissement);
        }
        $manager->flush();
    }
    public function loadSuite(ObjectManager $manager, $faker) {
        for($i=1; $i<=20;$i++) {
            // 1. Générer une nouvelle instance de l'entité
            $suite = new Suite();
            $currentEtablissement = $this->getReference('etablissement_'.mt_rand(1,5));
            // 1bis. Préciser des valeurs pour les propriétés de votre
            // futur enregistrement
            $suite->setTitre($faker->lastName());
            $suite->setPrix($faker->numberBetween(0, 100));
            $suite->setDescription($faker->paragraph());
            $suite->setImage($faker->image('public/images/', 640, 480, '', false,));

                $suite->setGaleryImage($faker->image('public/images/', 640, 480, '', false));

            $suite->setEtablissementId($currentEtablissement);
            // 2. Prendre en compte votre futur enregistrement
            // Pour un potentiel ajout dans la BDD (PAS DE SQL FAIT)

            $manager->persist($suite);
        }
        $manager->flush();
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Faker\Factory::create("fr_FR");

        $this->loadAdmin($manager,$faker);
        $this->loadEtablissement($manager,$faker);
        $this->loadSuite($manager,$faker);
        //$manager->flush();
    }
}
