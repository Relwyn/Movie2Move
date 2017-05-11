<?php
/**
 * Created by PhpStorm.
 * User: relwyn
 * Date: 09/05/17
 * Time: 15:13
 */


use Symfony\Component\HttpFoundation\Response;



$listfilm = $this->getDoctrine()->getManager()->getRepository('THAGM2MBundle:Film_trad');
$em = $this->getDoctrine()->getManager();
$fail = false;
$liste = $listfilm->findBy(array('langue' => 1));
$listeTitre = array();
$test = null;
foreach ($liste as $title) {
    $listeTitre[] = removeAccents($title->getTitreTrad());
}
$json = json_encode($listeTitre);
echo json_encode($listeTitre);
