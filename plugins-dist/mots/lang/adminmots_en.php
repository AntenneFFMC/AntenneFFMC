<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// Fichier source, a modifier dans svn://zone.spip.org/spip-zone/_plugins_/_stable_/acces_restreint/lang/
if (!defined("_ECRIRE_INC_VERSION")) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(
	
	'titre_formulaire_administrer_mot' => 'Manage this keyword',

	'bouton_associer' => 'Link',
	'bouton_dissocier' => 'Unlink',
	'bouton_fusionner' => 'Merge',
	'label_associer_objets_mot' => '<b>Link</b> this keyword to objects with the keyword',
	'label_dissocier_objets_mot' => '<b>Unlink</b> this keyword from objects with the keyword',
	'label_fusionner_mot' => '<b>Merge</b> with the keyword',
	
	'erreur_admin_mot_action_inconnue' => 'What do you want to do?',
	'erreur_selection_id' => 'Select a keyword or enter it\'s ID in input field',
	'erreur_mot_cle_deja' => 'Impossible: this is the same keyword.',

	'label_confirm_fusion' => 'This operation can\'t be canceled.<br />
<strong>This keyword #@id_mot@ will be deleted</strong> and following links will be moved on keyword #@id_mot_new@: ',
	'label_confirm_fusion_check' => 'Check to confirm merging keyword #@id_mot@ with keyword #@id_mot_new@',

	'result_associer_ras' => 'Nothing to do: all objects are already linked to this keyword',
	'result_associer_nb' => ' have been linked to this keyword',
	'result_dissocier_ras' => 'Nothing to do: no targeted object is linked to this keyword',
	'result_dissocier_nb' => ' have been unlinked from this keyword',
	
	'result_fusionner_ok' => 'You can now delete this keyword: all links have been moved to other keyword @mot@.',
	
	'result_cancel_ok' => 'Last operation has been canceled.',

	'icone_administrer_mot' => 'Advanced operations',

	'label_mot_parent' => 'Parent:',
	'label_mot_1_enfant' => 'Child:',
	'label_mot_nb_enfants' => 'Children:',
	'placeholder_id_mot' => 'or #ID_MOT',
	'placeholder_select' => 'Select…',

);

?>
