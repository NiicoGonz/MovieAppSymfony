<?php

namespace App\DataFixtures;

use App\Entity\Cliente;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $cliente = new Cliente();
            $cliente
                ->setNombre('Jose ' . $i)
                ->setApellidos('Gonzalez' . $i)
                ->setEmail('jose@gmail.com' . $i)
                ->setPassword('!#"DSAD!d1dk1j1j');


            $manager->persist($cliente);
            $manager->flush();
        }
    }
}
