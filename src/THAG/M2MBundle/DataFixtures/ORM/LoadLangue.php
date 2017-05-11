<?php


namespace THAG\M2MBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use THAG\M2MBundle\Entity\Langue;
class LoadLangue implements FixtureInterface
{
  public function load(ObjectManager $manager)
  {
    // Liste des noms de langues
    $names = array('fr', 'en', 'de', 'es');

    foreach ($names as $name) {
      // On crée la compétence
      $langue = new Langue();
      $langue->setLangue($name);

      // On la persiste
      $manager->persist($langue);
    }

    // On déclenche l'enregistrement de toutes les langues
    $manager->flush();
  }
}
