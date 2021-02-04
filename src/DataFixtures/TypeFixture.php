<?php


namespace App\DataFixtures;

use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class TypeFixture extends Fixture
{
    public const TYPE = [
         'Rouge',
         'Blanc',
         'Rosé'
    ];

    public function load(ObjectManager $manager)
    {
        foreach (Self::TYPE as $typeGrape) {
            $type = new Type();
            $type->setColor($typeGrape);
            $manager->persist($type);
            $this->addReference($typeGrape, $type);
        }
        $manager->flush();
    }
}
