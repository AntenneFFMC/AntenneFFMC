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
	if (count($erreurs)) $erreurs['message_erreur'] = "Une erreur est présente dans votre saisie";

	// Vérifie si la chaine ressemble à un email
	$email = $_POST['email'];
	$point = strpos($email,".");
	$aroba = strpos($email,"@");
	
	// if($point=='') echo "Votre email doit comporter un <b>point</b>";
	// elseif($aroba=='') echo "Votre email doit comporter un <b>'@'</b>";
	// else echo "Votre email est: '<a href=\"mailto:"."$email"."\"><b>$email</b></a>'";

	if(!empty($_POST['special'])) $erreurs['message_erreur'] = 'Spam !';

	return $erreurs;
}



//    if (preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $email)) {
//    echo 'Cet email est correct.';
//    } else {
//    echo 'Cet email a un format non adapté.';
//    }


function formulaires_infras_traiter() {
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
	$to = $GLOBALS['meta']['email_webmaster']; // obligatoire : email du destinataire - contact du site
	$copie_a_expediteur = 0; // mettre 1 si on veut envoyer une copie du message à l'expéditeur / visiteur du site
	$sujet = "Signalisation de point noir";
	$from = $GLOBALS['meta']['email_webmaster']; //$_POST['sender']);
	/* Fin de la config */

	// Création du header du message
	$headers = "From: ".$from."\n";
	$headers .= "Reply-To: ".$from."\n";
	$headers .= "X-Mailer: PHP/".phpversion()."\n";


	// Cc à l'expéditeur si choix activé
	if ( $copie_a_expediteur == 1 ) {
		$headers.= "Cc: ".$_POST['email'];
	}

	// Expédition du mail :
	if ( mail($to, $sujet, $txtmsg, $headers) ){
		// Si le mail a bien été envoyé, message de confirmation
		return array('message_ok'=>'Votre signalisation a bien été transmise à votre antenne. Merci !');
	} else {
		// sinon, message d'erreur.
		return array('message_erreur'=>'Votre signalisation n\'a pas pu être envoyée.');
	}

}//FIN function formulaires_infras_traiter
