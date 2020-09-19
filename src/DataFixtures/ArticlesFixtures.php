<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Articles;
class ArticlesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // for($i = 1; $i <= 5; $i++){
        //     $article = new Articles();
        //     $article->setTitre("Titre de l'article numéro $i")
        //             ->setImages("http://placehold.it/350x150")
        //             ->setContenu("Contenu de l'article numéro $i")
        //             ->setCreatedAt(new \DateTime());

        //     $manager->persist($article);
        // }

        $manager->flush();
    }
}
