<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2017                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

/**
 * Déclarations d'autorisations
 *
 * @package SPIP\Breves\Autorisations
 **/
if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

/**
 * Fonction du pipeline autoriser. N'a rien à faire
 *
 * @pipeline autoriser
 */
function revisions_autoriser() {
}

/**
 * Autorisation de voir le menu configurer_revisions
 *
 * Il faut avoir accès à la page configurer_revisions
 *
 * @param  string $faire Action demandée
 * @param  string $type Type d'objet sur lequel appliquer l'action
 * @param  int $id Identifiant de l'objet
 * @param  array $qui Description de l'auteur demandant l'autorisation
 * @param  array $opt Options de cette autorisation
 * @return bool          true s'il a le droit, false sinon
 **/
function autoriser_configurerrevisions_menu_dist($faire, $type, $id, $qui, $opt) {
    return autoriser('configurer', '_revisions', $id, $qui, $opt);
}