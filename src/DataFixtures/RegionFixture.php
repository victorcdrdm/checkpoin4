<?php


namespace App\DataFixtures;


use App\Entity\Region;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RegionFixture extends Fixture
{
    public const REGION = [
        'Bordeaux',
        'Côtes du Rhône',
        'Alsace',
        'Lorraine',
        'Loire',
        'Cognac',
        'Bourgogne',
    ];
    public function load(ObjectManager $manager)
    {
        foreach ( self::REGION as $regionName) {
            $region = new Region();
            $region->setName($regionName);
            $manager->persist($region);
            $this->addReference($regionName, $region);
        }
        $manager->flush();
    }
}
