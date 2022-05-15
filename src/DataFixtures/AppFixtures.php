<?php

namespace App\DataFixtures;

use App\Entity\Book;
use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Faker;

class AppFixtures extends Fixture
{
  public function load(ObjectManager $manager): void
  {
    // $product = new Product();
    // $manager->persist($product);

    $titles = [
      'La petite écuyère a cafté',
      'RN86',
      'Noyade',
      "Avant d'aller dormir",
      "La fée carabine",
    ];

    $faker = Faker\Factory::create('fr_FR');
    // we can now access Factory methods through $faker


    for ($i = 1; $i <= 20; $i++) {
      $author = new Author();
      $author->setLsName($faker->lastName());
      $author->setFsName($faker->firstName());

      $day = $faker->numberBetween($min = 1, $max = 31);
      $month = $faker->numberBetween($min = 1, $max = 12);
      $year = $faker->numberBetween($min = 1940, $max = 1990);

      $author->setDateBirth(new \DateTime("{$year}-{$month}-{$day}"));
      $manager->persist($author);
    }

    // for ($i = 0; $i < 20; $i++) {
    foreach ($titles as $title) {

      $book = new Book();


      // $lsName = $faker->lastName;
      // $fsName = $faker->firstName;

      $book->setTitle($title);

      // $book->setSummary($faker->sentence($nbWords = 20, $variableNbWords = true));
      $book->setSummary($faker->realText($maxNbChars = 500, $indexSize = 2));

      $day = $faker->numberBetween($min = 1, $max = 31);
      $month = $faker->numberBetween($min = 1, $max = 12);
      $year = $faker->numberBetween($min = 1900, $max = 2022);

      $book->setDatePublished(new \DateTime("{$year}-{$month}-{$day}"));

      $manager->persist($book);
    }


    $manager->flush();
  }
}