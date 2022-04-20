<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use Faker\Factory;
use Cocur\Slugify\Slugify;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('FR-fr');
        $slugify = new Slugify();
        for ($i=1; $i<=30; $i++)
        {
            $ad = new Ad();
            $title = $faker->sentence();
            $slug = $slugify->slugify($title);
            $coverImage = $faker->imageUrl(1000,350);
            $introduction = $faker->paragraph(2);
            $content = '<p>'.join('</p><p>', $faker->paragraphs(8) ).'</p>';
            $lieu = $faker->paragraph(1);
            $ad->setTitle($title)
                ->setSlug($slug)
                ->setIntroduction($introduction)
                ->setContent($content)
                ->setCoverImage($coverImage)
                ->setLieu($lieu);
            $manager->persist($ad);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
