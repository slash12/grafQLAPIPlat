<?php

namespace App\DataFixtures;
 
use App\Entity\Account;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
 
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //     $firstAccount = new Account();
        //     $firstAccount->setUsername('jonsnow');
        //     $manager->persist($firstAccount);

        // for ($i=1; $i < 20; $i++) { 
        //     $manager->persist((new Account())->setUsername('jonsnow_'.$i));
        // }

        for ($i = 1; $i <= 20; ++$i) {
            $account = new Account();
            $account->setUsername('jonsnow_'.$i);
            $account->setIsActive(0 == $i % 2 ? false : true);
            $manager->persist($account);
        }
        
        $manager->flush();
    }
}