<?php

namespace App\DataFixtures;

use App\Entity\Job;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class JobFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $job = new Job();
        $job->setTitle('Test');
        $job->setDescription('Je test si ça marche');
        $job->setCreatedAt(new \DateTime());
        $manager->persist($job);
        $manager->flush();
    }
}
