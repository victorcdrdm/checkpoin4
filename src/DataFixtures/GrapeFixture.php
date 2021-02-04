<?php


namespace App\DataFixtures;


use App\Entity\Grape;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class GrapeFixture extends Fixture implements DependentFixtureInterface
{


     const REGIONS = [
            'Bordeaux'=> [
                'Cabernet Sauvignon',
                'Cabernet Franc',
                'Carmenère',
                'Merlot',
                'Petit Verdot',
                'Malbec',
                'Sémillon',
                'Sauvignon',
                'Muscadelle',
            ],
         'Bourgogne' => [
             'Pinot Noir',
             'Gamay',
             'Chardonnay',
             'L\'aligoté',
             'Sauvignon',
             'Pinot Blanc',
             'pinot Gris',
             'Gammay Blanc'
         ],
         'Côtes du Rhône' => [
             'Viognier',
             'Syrah',
             'Grenache',
             'Carignan',
             'Mourvèdre',
             'Cinsault',
             'Clairette',
             'Bourboulenc',
             'Ugni blanc',
         ],
    ];


    public function load(ObjectManager $manager)
    {
        foreach (self::REGIONS as $region => $grapes) {
            foreach ($grapes as $grape) {
                $newGrape = new Grape();
                $newGrape->setName($grape);
                $newGrape->addRegion($this->getReference($region));
                $manager->persist($newGrape);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [RegionFixture::class];
    }


}
