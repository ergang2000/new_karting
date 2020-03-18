<?php

namespace App\DataFixtures;

use App\Entity\Soortactiviteit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class SoortactiviteitFixtures extends Fixture
{
    /**
     * @var Generator
     */
    protected Generator $faker;

    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create('nl');

        $this->createSoort($manager, 'Vrije training');
        $this->createSoort($manager, 'Kinder race');
        $this->createSoort($manager, 'Grand Prix');

        $manager->flush();
    }

    private function createSoort(ObjectManager &$manager, string $name): void
    {
        $soort = new Soortactiviteit();
        $soort->setNaam($name)
            ->setMinLeeftijd($this->faker->numberBetween(16, 21))
            ->setPrijs($this->faker->randomFloat(2, 1, 100))
            ->setTijdsduur($this->faker->numberBetween(1, 6));

        $manager->persist($soort);
    }
}
