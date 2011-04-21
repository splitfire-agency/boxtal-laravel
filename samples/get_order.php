<?php
ob_start();
header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require_once $_SERVER['DOCUMENT_ROOT'].'/librairie/utils/autoload.php';

// création du destinataire et de l'expéditeur - classe séparée car dans l'avenir on voudra 
// peut-être gérer les carnets d'adresses ou gestion de compte à distance (via une smartphone par exemple)
$from = array("pays" => "FR", "code_postal" => "75008", "type" => "particulier",
"ville" => "Paris", "adresse" => "1, rue du Test | logement 320", "civilite" => "Mme",
"prenom" => "Juliane", "nom" => "Julios", "email" => "bartosz@boxtale.com",
"tel" => "0601010101", "infos" => "Faire attention au chien");
$to = array("pays" => "FR", "code_postal" => "13005", "type" => "particulier",
"ville" => "Marseille", "adresse" => "1, rue de l'Olympiade | logement 1120", "civilite" => "Mme", 
"prenom" => "Julios", "nom" => "Juliosa", "email" => "bartosz@boxtale.com",
"tel" => "0601010101", "infos" => "Faire attention au chat");
<<<<<<< .mine
$persoCl = new Env_Person(array("user" => "marwan", "pass" => "motdepasse", "key" => "toto"));
$persoCl->setPerson("shipper", $from);
$persoCl->setPerson("recipient", $to);

=======
 
>>>>>>> .r13879
// faire la cotation
$quotInfo = array("collecte_date" => "2011-04-26", "delay" => "aucun",  "content_code" => 30200,
"info_631.selected" => false, 
"info_349.info" => "rien de spécial", "info_121.HDE" => "09:00", "info_121.HLE" => "19:00",
"delivery_type" => "HOME");
$cotCl = new Env_Quotation(array("user" => "marwan", "pass" => "motdepasse", "key" => "toto"));
$cotCl->setPerson("shipper", $from);
$cotCl->>setPerson("recipient", $to);
$cotCl->setType("package", array("weight" => 17, "length" => 30, "width" => 44, "height" => 44));
$cotCl->makeOrder($quotInfo);
if(!$cotCl->curlError && !$cotCl->respError) {
  $cotCl->getOffers();
}
elseif($cotCl->respError) {
  echo "La requête n'est pas valide : ";
  foreach($cotCl->respErrorsList as $m => $message) { 
    echo "<br />".$message['message'];
  } die();
}
else {
  echo "<b>Une erreur pendant l'envoi de la requête </b> : ".$cotCl->curlErrorText;
  die();
}
?>
 
