<?php

if (!defined("_ECRIRE_INC_VERSION")) return;

function formulaires_administrer_mot_charger_dist($id_mot){
	$valeurs = array(
		'associer_objets_mot' => '',
		'dissocier_objets_mot' => '',
		'fusionner_mot' => '',
		'associer_objets_mot_id' => '',
		'dissocier_objets_mot_id' => '',
		'fusionner_mot_id' => '',
		'revert_action' => '',
	);

	return $valeurs;
}

function afficher_options_mots($id_selected) {
	static $options;
	if (is_null($options)){
		// d'abord les count en 1 coup
		$counts = sql_allfetsel('id_mot,count(id_objet) as n','spip_mots_liens','','id_mot','id_mot');
		$counts = array_combine(array_map('reset',$counts), array_map('end',$counts));

		// puis les groupes
		$groupes = sql_allfetsel('*', 'spip_groupes_mots', '', '', '0+ titre, titre');
		foreach($groupes as $groupe) {
			$options['groupeopen-'.$groupe['id_groupe']] = '<optgroup label="'.attribut_html(typo(supprimer_numero($groupe['titre']))).'">';
			$res = sql_select('id_mot, titre', 'spip_mots', 'id_groupe='.intval($groupe['id_groupe']), '', '0+ titre, titre');
			while($row = sql_fetch($res)) {
				$id_mot = $row['id_mot'];
				if (isset($counts[$id_mot]) and $n = $counts[$id_mot]) {
					$options[$id_mot] = '<option value="'.$id_mot.'">'.typo(supprimer_numero($row['titre']))." ($n)</option>";
				}
			}
			$options['groupeclose-'.$groupe['id_groupe']] = '</optgroup>';
		}

	}
	if ($id_selected and isset($options[$id_selected])) {
		$options[$id_selected] = inserer_attribut($options[$id_selected], 'selected', 'selected');
	}
	$s = implode("\n",$options);
	if ($id_selected and isset($options[$id_selected])) {
		$options[$id_selected] = vider_attribut($options[$id_selected], 'selected');
	}
	return $s;
}


function formulaires_administrer_mot_verifier_dist($id_mot){

	$erreurs = array();

	$check = "";
	if (_request('associer')){
		$check = 'associer_objets_mot';
	}
	elseif (_request('dissocier')){
		$check = 'dissocier_objets_mot';
	}
	elseif (_request('fusionner')){
		$check = 'fusionner_mot';
	}

	if (!$check AND (!_request('revert') OR !_request('revert_action'))){
		$erreurs['message_erreur'] = _T('adminmots:erreur_admin_mot_action_inconnue');
	}
	elseif($check) {
		$id = admot_recupere_id_mot($check);
		if (!$id){
			$erreurs[$check] = _T('adminmots:erreur_selection_id');
		}
		elseif($id == $id_mot){
			$erreurs[$check] = _T('adminmots:erreur_mot_cle_deja');
		}
		elseif($check=='fusionner_mot' AND !_request('confirm_fusionner_mot')){
			$counts = sql_allfetsel("objet,count(id_objet) as N","spip_mots_liens","id_mot=".intval($id_mot),"objet");
			$detail = array();
			foreach($counts as $count){
				$detail [] = objet_afficher_nb($count['N'],$count['objet']);
			}
			$detail = implode(", ",$detail);
			if (!isset($erreurs['message_erreur'])) {
				$erreurs['message_erreur'] = '';
			}
			$erreurs[$check] =
			  _T('adminmots:label_confirm_fusion',array('id_mot'=>$id_mot,'id_mot_new'=>$id))
			  . " <b>$detail</b>" . "<br />\n"
			  . "<input type='checkbox' name='confirm_fusionner_mot' value='1' id='confirm_fusionner_mot' /> "
			  . "<label for='confirm_fusionner_mot'>"
			  . _T('adminmots:label_confirm_fusion_check',array('id_mot'=>$id_mot,'id_mot_new'=>$id))
			  . "</label>";
		}
	}

	return $erreurs;
}

function admot_recupere_id_mot($name){
	if (!$id_mot = intval(_request($name . '_id')))
		$id_mot = intval(_request($name));

	return $id_mot;
}

function admot_associer_objets_mot($id_mot, $objet, $ids){
	if (count($ids)){
		$couples = array();
		foreach($ids as $id){
			$couples[] = array(
				'id_mot' => $id_mot,
				'id_objet' => $id,
				'objet' => $objet
			);
		}
		return sql_insertq_multi("spip_mots_liens",$couples);
	}
	return false;
}

function admot_dissocier_objets_mot($id_mot, $objet, $ids){
	if (count($ids)){
		return sql_delete("spip_mots_liens","id_mot=".intval($id_mot)." AND objet=".sql_quote($objet)." AND ".sql_in('id_objet',$ids));
	}
	return false;
}


function formulaires_administrer_mot_traiter_dist($id_mot){

	refuser_traiter_formulaire_ajax();
	if (_request('revert')){
		$action = _request('revert_action');
		$action = explode("/",$action);
		$quoi = array_shift($action);
		foreach($action as $a) {
			list($objet, $ids) = explode(':', $a);
			$ids = explode(',',$ids);
			if ($objet and $ids) {
				if ($quoi=="add"){
					admot_associer_objets_mot($id_mot, $objet, $ids);
				}
				if ($quoi=="del"){
					admot_dissocier_objets_mot($id_mot, $objet, $ids);
				}
			}
		}
		$res['message_ok'] = _T('adminmots:result_cancel_ok');
		set_request('revert_action','');
	}
	else {
		$check = '';
		if (_request('associer')){
			$check = 'associer_objets_mot';
		}
		elseif (_request('dissocier')){
			$check = 'dissocier_objets_mot';
		}
		elseif (_request('fusionner')){
			$check = 'fusionner_mot';
		}
		$id = admot_recupere_id_mot($check);

		$revert = "";
		$res = array();
		// associer
		if ($check=="associer_objets_mot"){
			$revert = array();
			$message = array();
			$objets = sql_allfetsel("distinct objet","spip_mots_liens","id_mot=".intval($id),'','objet');
			$objets = array_map('reset',$objets);
			foreach($objets as $objet) {
				$all = sql_allfetsel("id_objet","spip_mots_liens","id_mot=".intval($id)." AND objet=".sql_quote($objet));
				$all = array_map('reset',$all);
				$deja = sql_allfetsel("id_objet","spip_mots_liens","id_mot=".intval($id_mot)." AND objet=".sql_quote($objet)." AND ".sql_in('id_objet',$all));
				$deja = array_map('reset',$deja);
				$add = array_diff($all,$deja);
				if (count($add)){
					$revert[] = "$objet:".implode(",",$add);
					admot_associer_objets_mot($id_mot, $objet, $add);
					$message[] = objet_afficher_nb(count($add), $objet);
				}
			}
			if (count($message)){
				$revert = "del/".implode("/",$revert);
				$message = implode(', ', $message);
				$res['message_ok'] = $message . _T('adminmots:result_associer_nb');
			}
			else {
				$res['message_ok'] = _T('adminmots:result_associer_ras');
			}
		}
		// dissocier
		if ($check=="dissocier_objets_mot"){
			$revert = array();
			$message = array();
			$objets = sql_allfetsel("distinct objet","spip_mots_liens","id_mot=".intval($id),'','objet');
			$objets = array_map('reset',$objets);
			foreach($objets as $objet){
				$all = sql_allfetsel("id_objet", "spip_mots_liens", "id_mot=" . intval($id) . " AND objet=" . sql_quote($objet));
				$all = array_map('reset', $all);
				$has = sql_allfetsel("id_objet", "spip_mots_liens", "id_mot=" . intval($id_mot) . " AND objet=" . sql_quote($objet) . " AND " . sql_in('id_objet', $all));
				$has = array_map('reset', $has);
				if (count($has)){
					$revert[] = "$objet:".implode(",",$has);
					admot_dissocier_objets_mot($id_mot, $objet, $has);
					$message[] = objet_afficher_nb(count($has), $objet);
				}
			}
			if (count($message)){
				$revert = "add/".implode("/",$revert);
				$message = implode(', ', $message);
				$res['message_ok'] = $message . _T('adminmots:result_dissocier_nb');
			}
			else {
				$res['message_ok'] = _T('adminmots:result_dissocier_ras');
			}
		}

		// fusionner
		if ($check=="fusionner_mot"){
			$all = sql_allfetsel("id_objet,objet,id_mot","spip_mots_liens","id_mot=".intval($id_mot));
			$mot = sql_fetsel("*","spip_mots","id_mot=".intval($id_mot));
			$dump = var_export($mot,true) . "\n\n". var_export($all,true);
			ecrire_fichier(_DIR_LOG."fusion_mot_{$id_mot}_vers_{$id}_".date('Y-m-d-His').".dump",$dump);
			foreach($all as $a){
				$a['id_mot'] = $id;
				sql_insertq('spip_mots_liens',$a);
			}
			sql_delete("spip_mots_liens","id_mot=".$id_mot);
			$link = "<a href='".generer_url_entite($id,'mot')."'>".objet_info('mot','texte_objet')." #$id</a>";
			$res['message_ok'] = _T('adminmots:result_fusionner_ok',array('mot'=>$link));
		}

		if ($revert)
			set_request('revert_action',$revert);
	}
	set_request('administrer','oui');

	return $res;
}
