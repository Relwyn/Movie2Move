<?php
/**
 * Created by PhpStorm.
 * User: relwyn
 * Date: 27/04/17
 * Time: 11:40
 */
use THAG\M2MBundle\Entity\Acteur;
use THAG\M2MBundle\Entity\Film;
use THAG\M2MBundle\Entity\Genre;
use THAG\M2MBundle\Entity\Realisateur;
use THAG\M2MBundle\Entity\Film_trad;
use THAG\M2MBundle\Allocine\AlloHelper;
require_once '../src/THAG/M2MBundle/Allocine/api-allocine-helper.php';

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
$errors = array();
$tableau_fichiers = array();

/* Récupération des noms de release dans la base de données */
//$tableau_bdd = $bdd->query('SELECT release1 FROM films')->fetchAll(); --------


/* Récupération des noms de release dans le répertoire des films */
$tableau_fichiers = removeAccents($_POST['film']);

/* Si aucune erreur n'a été trouvée, alors on execute le script de génération d'affiche */


    /* Si le fichiers n'est pas dans la base de données, alors on l'insère */

    /***** Définition des constantes ******/
    $date = array();
    $j = 0;
    for($i = 1945; $i <= 2016; $i++){
        $date[$j] = $i;
        $j++;
    }
    $extension = array('avi', 'mkv', 'mp4');
    $format = array('brrip', 'dvdrip', 'bdrip', 'rerip', 'webrip', '720p', '1080p', 'sdtv', 'hdrip', 'dvrip', 'bluray', 'dvd', 'rip', 'hdtv', 'h264', 'pal');
    $encodage = array('xvid', 'x264');
    $langage = array('french', 'truefrench', 'vf', 'multi', 'fr');
    $soustitre = array('subforced', 'subfrench');
    $son = 'ac3';
    $option = array('extended', 'limited', 'proper', 'rough', 'cd1', 'cd2', 'dts', 'theatrical', 'cd01', 'cd02', 'rogue', 'cut');
    $uploader = array('Beaucoup de team uploader');

    $nb_fichier = 0;
    $nb_fichier_clear = 0;
    $tab = array();
    /***** Fin de le définition des constantes */

    $values=$tableau_fichiers;


            /******************************************************/
            /*     DEBUT DU TRAITEMENT DE LA NOUVELLE RELEASE     */
            /******************************************************/

            $nb_fichier++;

            $tab[$nb_fichier] = array(  'release' => NULL,
                'extension' => NULL,
                'size' => NULL,
                'name1' => NULL,
                'name' => NULL,
                'option' => NULL,
                'son' => NULL,
                'soustitre' => NULL,
                'langue' => NULL,
                'encodage' => NULL,
                'format' => NULL,
                'date' => NULL,
                'lien' => NULL,
                'synopsis' => NULL,
                'jaquette' => NULL,
                'genre' => NULL,
                'ba' => NULL,
                'acteurs' => NULL,
                'presse' => NULL,
                'spectateur' => NULL);


            $tab[$nb_fichier]['release'] = $values;
            $tab[$nb_fichier]['extension'] = end(explode('.', $values));
            $tab[$nb_fichier]['name'] = preg_split('/[. -]/', strtolower($values));


            /* DEBUT DE RECHERCHE DANS L ARRAY FILMS + TRIE PAR RAPPORT AUX CONSTANTES PREDEFINIES */



            foreach($tab[$nb_fichier]['name'] as $key => $value){

                if(in_array($value, $uploader)){
                    unset($tab[$nb_fichier]['name'][$key]);
                }

                if(in_array($value, $option)){
                    $tab[$nb_fichier]['option'] = $value;
                    unset($tab[$nb_fichier]['name'][$key]);
                }

                if($value == $son){
                    $tab[$nb_fichier]['son'] = $value;
                    unset($tab[$nb_fichier]['name'][$key]);
                }


                if(in_array($value, $soustitre)){
                    $tab[$nb_fichier]['soustitre'] = $value;
                    unset($tab[$nb_fichier]['name'][$key]);
                }


                if(in_array($value, $langage)){
                    $tab[$nb_fichier]['langue'] = $value;
                    unset($tab[$nb_fichier]['name'][$key]);
                }


                if(in_array($value, $extension)){
                    unset($tab[$nb_fichier]['name'][$key]);
                }


                if(in_array($value, $encodage)){
                    $tab[$nb_fichier]['encodage'] = $value;
                    unset($tab[$nb_fichier]['name'][$key]);
                }


                if(in_array($value, $format)){
                    $tab[$nb_fichier]['format'] = $value;
                    unset($tab[$nb_fichier]['name'][$key]);
                }


                if(in_array($value, $date)){
                    $tab[$nb_fichier]['date'] = $value;
                    unset($tab[$nb_fichier]['name'][$key]);
                }


                if($value == NULL){
                    unset($tab[$nb_fichier]['name'][$key]);
                }

            }

            $tab[$nb_fichier]['name1'] = implode(' ', $tab[$nb_fichier]['name']);

            /******* DEBUT DE PARSE SUR ALLOCINE *********/

            // Création du lien de recherche du film dans Allociné
            $search = 'http://www.allocine.fr/recherche/?q='.implode('+', $tab[$nb_fichier]['name']);
            unset($tab[$nb_fichier]['name']);

            // Création du lien de téléchargement du fichier + Calcul taille fichier
            $tab[$nb_fichier]['lien'] = 'ftp://downmovie:zflkjefozij@site.fr/'.$values;
            $chemin = '/home/rutorrent/Downloads/Tous/'.$values;
            $tab[$nb_fichier]['size'] = filesize($chemin);

            // Recherche du film sur allociné
            $search_page = file_get_contents($search);
            $search_page = preg_replace('@<b>([0-9]+)</b>@si', '$1', $search_page);

            // Récupération des différentes affiches grace à la recherche + Comparaison avec les années
            preg_match_all('/\/film\/fichefilm_gen_cfilm=[0-9]+.html/', $search_page, $result);
            preg_match_all('/class="fs11">(.\|\n)*([^<]+)/', $search_page, $year);

            $test = array();
            $test[0]['annee'] = $year[2][0];
            $test[0]['lien'] = $result[0][3];
            $test[1]['annee'] = $year[2][1];
            $test[1]['lien'] = $result[0][5];
            $test[2]['annee'] = $year[2][2];
            $test[2]['lien'] = $result[0][7];

            $affiche_film = 'http://www.allocine.fr'.$result[0][3];
            $sortie = 0;

            foreach ($test as $key) {
                if($sortie != 1){
                    if ($key['annee'] == $tab[$nb_fichier]['date'] && $tab[$nb_fichier]['date'] != NULL){
                        $affiche_film = 'http://www.allocine.fr'.$key['lien'];
                        $sortie = 1;
                    }
                }
            }

            // Recherche du contenu de l'affiche précédemment selectionnées !
            $film =file_get_contents($affiche_film);

            //Recherche du titre_film
            preg_match_all('/<div class="titlebar-title titlebar-title-lg">(.|\n)*<\/div>/Ui', $film, $titre);
            $titre[0][0] = preg_replace('/<div (.){1,60}>/i', '', $titre[0][0]);
            $tab[$nb_fichier]['coucou'] = preg_replace('/<\/div>/i', '', $titre[0][0]);

            // Recherche du Synopsis
            preg_match_all('/(<div class="ovw-synopsis-txt" itemprop="description">)(.|\n)*(<\/div>)/Ui', $film, $result2);
            $result2[0][0] = preg_replace('/<div (.){1,60}>|[\'\^"]+/i', '', $result2[0][0]);
            $tab[$nb_fichier]['synopsis'] = preg_replace('/<\/div>|(.)+><span>|<\/span>/i', '', $result2[0][0]);



            // Recherche des genres du films
            preg_match_all('/itemprop="genre">([^<]+)/', $film, $result4);
            $tab[$nb_fichier]['genre'] = implode(', ', $result4[1]);

            // Recherche de la bande annonce
            preg_match_all('/(\/video\/(.)+)"/', $film, $result5);
            if(isset($result5[1][1]) && !empty($result5[1][1])){
                $tableaumedia = explode('a=', $result5[1][1]);
                $tab[$nb_fichier]['ba'] = 'http://www.allocine.fr/_video/iblogvision.aspx?cmedia=' .$tableaumedia[1]. '&autoplay=1';
            }else{
                $tableaumedia = explode('a=', $result5[1][0]);
                $tab[$nb_fichier]['ba'] = 'http://www.allocine.fr/_video/iblogvision.aspx?cmedia=' .$tableaumedia[1]. '&autoplay=1';
            }

            // Recherche des acteurs du film
            preg_match_all('/itemprop="name">([^<]+)/', $film, $result6);
            unset($result6[1][0]);
            $tab[$nb_fichier]['acteurs'] = implode(', ', $result6[1]);

            //Recherche des notes presse et spectateurs

            preg_match_all('/<span class="stareval-stars n([^<]+)">/Ui', $film, $note);
            if($note[1][0] == 'ull' || !isset($note[1][0])){
                $tab[$nb_fichier]['presse'] = 0;
            }
            else{
                $tab[$nb_fichier]['presse'] = $note[1][0];
            }

            if($note[1][1] == 'ull' || !isset($note[1][1])){
                $tab[$nb_fichier]['spectateurs'] = 0;
            }
            else{
                $tab[$nb_fichier]['spectateurs'] = $note[1][1];
            }


            // Les champs vide de l'array ont comme valeur NR / Non Renseigné
            foreach($tab[$nb_fichier] as $key => $value){
                if($tab[$nb_fichier][$key] == NULL){
                    $tab[$nb_fichier][$key] = 'NR';
                }
            }




//--------------------------------------------------------------------------------------------------------------------------------------------
$title = $_POST['film'];
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
    $movie=null;
    $synopsis="";
    foreach ($arrayMovie['movie'] as $key) { // modifier tv series vers movie
        if (isset($key['title']))
            echo $key['title'] . "<br>";
        else
            echo "<div class=''>Titre de la série:". $key['title']."</div>";
            echo "<br>";
            echo "<div> Titre original: ". $key['originalTitle']."</div>";
            echo "<br>";
            echo "<div> Genre: ". $tab[$nb_fichier]['genre']."</div>";
            echo "<br>";
            echo "<div> Annee de production: ". $key['productionYear']."</div>";
            echo "<br>";
            echo "<div> Réalisateur: ". $key['castingShort']['directors']."</div>";
            echo "<br>";
            echo "<div> Acteurs: ". $key['castingShort']['actors']."</div>";
            echo "<br>";
            $synopsis=$helper->movie($key['code'],2)['synopsis'];
            echo "<div> Synopsis:".$synopsis."</div>";
            echo "<br>";
            $movie=$key;
        break;
    }

    /*// On récupère l'EntityManager
    $rea = $this->getDoctrine()->getManager()->getRepository('THAGM2MBundle:Realisateur');
    $act = $this->getDoctrine()->getManager()->getRepository('THAGM2MBundle:Acteur');
    $trad = $this->getDoctrine()->getManager()->getRepository('THAGM2MBundle:Film_trad');
    $em = $this->getDoctrine()->getManager();
    $film=new Film();
    $film->setDate($movie['productionYear']);



    // Étape 2 : On « flush » tout ce qui a été persisté avant

    $tab=split(", ",$movie['castingShort']['directors']);
    foreach ($tab as $director) {
        $prenomNom=split(" ",$director);
        $realisateur=new Realisateur();
        if($rea->findOneBy(array('prenom'=>$prenomNom[0],'nom'=>$prenomNom[1]))==null)
        {
            $realisateur->setPrenom($prenomNom[0]);
            $realisateur->setNom($prenomNom[1]);
            $em->persist($realisateur);
            $em->flush();

        }
        $film->addRealisateur($rea->findOneBy(array('prenom'=>$prenomNom[0],'nom'=>$prenomNom[1])));
    }


    $tab=split(", ",$movie['castingShort']['actors']);
    foreach ($tab as $actor) {
        $prenomNom=split(" ",$actor);
        $acteur=new Acteur();
        if($act->findOneBy(array('prenom'=>$prenomNom[0],'nom'=>$prenomNom[1]))==null)
        {
            $acteur->setPrenom($prenomNom[0]);
            $acteur->setNom($prenomNom[1]);
            $em->persist($acteur);
            $em->flush();
        }
        $film->addActeur($act->findOneBy(array('prenom'=>$prenomNom[0],'nom'=>$prenomNom[1])));
    }

    echo "film ID".$film->getId();*/

//-----------------------------------------------------------------------------------------------------------------------

    //$film->addGenre();

//-----------------------------------------------------------------------------------------------------------------------

}
catch (ErrorException $error) {
    // En cas d'erreur
    echo "Erreur n°", $error->getCode(), ": ", $error->getMessage(), PHP_EOL;
}

//--------------------------------------------------------------------------------------------------------------------------------------------
