
<?php

/*  date" content="2014-08-02 Norbert(FFMC73)" */

//    function formulaires_infras_charger_dist() {
//    $valeurs = array(
//    $valeurs['date'] => "jj-mm-aaaa",
//    );
//    return $valeurs;
//    }

    function formulaires_infras_verifier_dist() {
    $erreurs = array();
    foreach(array('sender','email') as $champ) {
    if (!_request($champ)) {
    $erreurs[$champ] = "Cette information est obligatoire !";
    }
    }
    if (count($erreurs)) {
    $erreurs['message_erreur'] = "Une erreur est présente dans votre saisie";
    }

// Vérifie si la chaine ressemble à un email
    $email = $_POST['email'];
    $point = strpos($email,".");
    $aroba = strpos($email,"@");
    
    if($point=='')
    {
    echo "Votre email doit comporter un <b>point</b>";
    }
    elseif($aroba=='')
    {
    echo "Votre email doit comporter un <b>'@'</b>";
    }
    else
    {
    echo "Votre email est: '<a href=\"mailto:"."$email"."\"><b>$email</b></a>'";
    }

    return $erreurs;
    }



//    if (preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $email)) {
//    echo 'Cet email est correct.';
//    } else {
//    echo 'Cet email a un format non adapté.';
//    }



    function formulaires_infras_traiter(){
    // Effectuer des traitements
    $txtmsg = '';
    $txtmsg .= 'emetteur: ' . $_POST['sender'] . "\n";
    $txtmsg .= 'email: ' .  $_POST['email'] . "\n\n\n";

    $txtmsg .= '----------------------'."\n";
    $txtmsg .= 'Date: ' . $_POST['Date'] . "\n";
    $txtmsg .= '----------------------'."\n\n\n";   

    $txtmsg .= 'Localisation :'."\n";
    $txtmsg .= '----------------------'."\n";
    $txtmsg .= 'Rue: ' . $_POST['Rue'] . "\n";
    $txtmsg .= 'De: ' . $_POST['De'] . "\n";

    $txtmsg .= 'A: ' . $_POST['A'] . "\n";
    $txtmsg .= 'Hauteur: ' . $_POST['Hauteur'] . "\n";
    $txtmsg .= 'Repere: ' . $_POST['Repere'] . "\n";
    $txtmsg .= 'Ville: ' . $_POST['Ville'] . "\n";
    $txtmsg .= 'Code postal: ' . $_POST['Code_postal'] . "\n\n\n";

    $txtmsg .= 'Description :'."\n";
    $txtmsg .= '----------------------'."\n";

    if (isset($_POST['Etat_route'])) {
      $txtmsg .= 'Etat de la route: ' . implode(" ", $_POST['Etat_route']) . "\n";
    }
    else { $txtmsg .= '' . ""; }
    if (isset($_POST['Ralentisseurs'])) {
      $txtmsg .= 'Ralentisseurs: ' . implode(" ", $_POST['Ralentisseurs']) . "\n";
    }
    else { $txtmsg .= '' . ""; }
    if (isset($_POST['Peinture'])) {
      $txtmsg .= 'Peinture: ' . implode(" ", $_POST['Peinture']) . "\n";
    }
    else { $txtmsg .= '' . ""; }
    if (isset($_POST['Glissiere_securite'])) {
      $txtmsg .= 'Glissiere de securite: ' . implode(" ", $_POST['Glissiere_securite']) . "\n";
    }
    else { $txtmsg .= '' . ""; }
    if (isset($_POST['Virage'])) {
      $txtmsg .= 'Virage: ' . implode(" ", $_POST['Virage']) . "\n";
    }
    else { $txtmsg .= '' . ""; }
    if (isset($_POST['Carrefour'])) {
      $txtmsg .= 'Carrefour: ' . implode(" ", $_POST['Carrefour']) . "\n";
    }
    else { $txtmsg .= '' . ""; }
    if (isset($_POST['Plaque_egout'])) {
      $txtmsg .= "Plaque d'egout: " . implode(" ", $_POST['Plaque_egout']) . "\n";
    }
    else { $txtmsg .= '' . ""; }
    if (isset($_POST['Autre'])) {
      $txtmsg .= 'Autre: ' . implode(" ", $_POST['Autre']) . "\n";
    }
    else { $txtmsg .= '' . ""; }
    if (isset($_POST['Separateur_bus'])) {
      $txtmsg .= 'Separateur_bus: ' . implode(" ", $_POST['Separateur_bus']) . "\n";
    }
    else { $txtmsg .= '' . ""; }


    $txtmsg .="\n" . 'Autres observations: '  . "\n". '----------------------'."\n" . $_POST['Autres_observations'] . "\n";


    /* Configuration du script d'envoi */
    $nom_du_site = "FFMC de Savoie" ; // utilisé lors de l'envoi de la copie du message
    $to = "ffmc73@ffmc.fr" ; // obligatoire : email du destinataire - contact du site
    $copie_a_expediteur = 0 ; // mettre 1 si on veut envoyer une copie du message à l'expéditeur / visiteur du site
    $copie_au_webmaster = 0 ; // mettre 1 si on veut faire un Cc au webmaster du site - souvent utile pour débugger au départ ou si on veut être au courant des messages qui transitent via le site
    $mail_webmaster = ".fr" ; // mettre adresse du webmaster pour envoi du Cc
    $sujet = "Signalisation de point noir";
    $from = "ffmc73@ffmc.fr" ; //$_POST['sender']);
    /* Fin de la config */

    // Création du header du message
    $headers = "From: ".$from."\n" ;
    $headers .= "Reply-To: ".$from."\n" ;
    $headers .= "X-Mailer: PHP/".phpversion()."\n" ;


    // Cc au webmaster si choix activé
	    if ( $copie_au_webmaster == 1 ) {
	      $headers.= "Cc: $mail_webmaster\n" ;
	    }

    // Expédition du mail :
	    if ( mail($to, $sujet, $txtmsg, $headers) ){
	    // Si le mail a bien été envoyé, message de confirmation
	      echo "Votre mail a bien été envoyé à $nom_du_site.<br />";
	    }
	    else{
	    // sinon, message d'erreur.
	    echo "Votre mail n\'a pas pu être envoyé.<br />";
	    }

    }//FIN function formulaires_infras_traiter

?>
