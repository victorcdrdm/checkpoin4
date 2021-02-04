<?php


namespace App\DataFixtures;


use App\Entity\Vignoble;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class VignobleFixture extends Fixture implements DependentFixtureInterface
{
    const VIGNOBLES = [
            'Bourgogne' => [
                'Côte de beaune',
                'Chalonais',
                'Beaujolais',
                'Mâconnais',
                'Côtes de nuits'
            ],
            'Bordeaux' => [
                'Médoc',
                'Graves',
                'Entre-Deux-Mers',
                'Côtes de Blaye',
            ],
            'Côtes du Rhône' => [
                'Gigondas',
                'Chateauneuf du pape',
                'Beaume de venise',
            ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::VIGNOBLES as $region => $vignobles) {
            foreach ($vignobles as $vignoble) {
                $newVignoble = new Vignoble();
                $newVignoble->setName($vignoble);
                $newVignoble->setRegion($this->getReference($region));
                $manager->persist($newVignoble);
                $this->addReference($vignoble, $newVignoble);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [RegionFixture::class];
    }
}
