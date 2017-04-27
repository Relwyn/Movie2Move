<?php

namespace THAG\M2MBundle\Controller;


use THAG\M2MBundle\Allocine\AlloHelper;
use ErrorException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
require_once '/var/www/dessinerLaMode/src/THAG/M2MBundle/Allocine/api-allocine-helper.php';

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('THAGM2MBundle:Default:index.html.twig');
    }

    public function playAction()
    {
        function removeAccents($title)
        {
            $accentued = array("à","á","â","ã","ä","ç","è","é","ê","ë","ì",
                "í","î","","ï","ñ","ò","ó","ô","õ","ö","ù","ú","û","ü","ý","ÿ",
                "À","Á","Â","Ã","Ä","Ç","È","É","Ê","Ë","Ì","Í","Î","Ï","Ñ","Ò",
                "Ó","Ô","Õ","Ö","Ù","Ú","Û","Ü","Ý");
            $nonaccentued = array("a","a","a","a","a","c","e","e","e","e","i","i",
                "i","i","n","o","o","o","o","o","u","u","u","u","y","y","A","A","A",
                "A","A","C","E","E","E","E","I","I","I","I","N","O","O","O","O","O",
                "U","U","U","U","Y");

            $title = str_replace($accentued, $nonaccentued, $title);

            return $title;
        }
        $title = 'fast & furious 8';
        //$ = 'le piège des profondeurs';
        $q = removeAccents($title);
        $page = '1';
        $count = '1';
//$film         = $_POST['film'];
        $helper  = new AlloHelper;
        $search = $helper->search($q, $page, $count);
        $code = $search['tvseries']['0']['code']; // modifier tv series vers movie
        $profile = 'small';
            try {
                // Envoi de la requête
                $film         = $q;
                $arrayMovie   = $helper->search($film)->getArray();
                //print_r($arrayMovie);

                foreach ($arrayMovie['movie'] as $key) { // modifier tv series vers movie
                    if (isset($key['title']))
                        echo $key['title'] . "<br>";
                    else

                        echo "Titre de la série: ", $key['title'], PHP_EOL;
                    echo "<br>";
                    echo "ID de la série: ", $key['code'], PHP_EOL;
                    echo "<br>";
                    echo "Titre original: ", $key['originalTitle'], PHP_EOL;
                    echo "<br>";
                    echo "Annee de production: ", $key['productionYear'], PHP_EOL;
                    echo "<br>";
                    echo "Réalisateur: ", $key['castingShort']['directors'], PHP_EOL;
                    echo "<br>";
                    echo "Acteurs: ", $key['castingShort']['actors'], PHP_EOL;
                    echo "<br>";
                    echo "Synopsis: AREA",$helper->movie($key['code'],2)['synopsis'],"AREA", PHP_EOL;
                    echo "<br>";
                    break;
                }


            }
            catch (ErrorException $error) {
                // En cas d'erreur
                echo "Erreur n°", $error->getCode(), ": ", $error->getMessage(), PHP_EOL;
            }


        return $this->render('THAGM2MBundle:Default:jeu.html.twig');
    }
}
