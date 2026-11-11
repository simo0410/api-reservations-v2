<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArtistFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $artists = [
            ['firstname'=>'Bob', 'lastname'=>'Sull'],
            ['firstname'=>'Lydia', 'lastname'=>'Smith'],
            ['firstname'=>'Fred', 'lastname'=>'Dumont'],
        ];

        foreach ($artists as $record) { 
             $artist = new Artist();
             $artist->setFirstname($record['firstname']);
             $artist->setLastname($record['lastname']);
             $manager->persist($artist);
        }    

        $manager->flush();
    }
}
