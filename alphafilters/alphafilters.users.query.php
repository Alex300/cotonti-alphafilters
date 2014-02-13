<?php

/** 
 * [BEGIN_COT_EXT]
 * Hooks=users.query
 * [END_COT_EXT]
 */

/**
 * Alphafilters Plugin for Cotonti CMF
 *
 * @version 4.0.0
 * @author esclkm, http://www.littledev.ru
 * @copyright (c) 2008-2011 esclkm, http://www.littledev.ru
 */

defined('COT_CODE') or die('Wrong URL');

$alpha = cot_import('alpha','G','TXT');
$alpha = urldecode($alpha);

if (!empty($alpha))
{
	$users_url_path['alpha'] = urlencode($alpha);
    if(empty($cfg['plugin']['alphafilters']['fieldusers'])){
        $al_fields = array('name');

        // Some extra fields
        if (isset($cot_extrafields[$db_users]['firstname']))
            $al_fields[] = 'firstname';
        if (isset($cot_extrafields[$db_users]['first_name']))
            $al_fields[] = 'first_name';

        if (isset($cot_extrafields[$db_users]['lastname']))
            $al_fields[] = 'lastname';
        if (isset($cot_extrafields[$db_users]['last_name']))
            $al_fields[] = 'last_name';

    }else{
        $cfg['plugin']['alphafilters']['fieldusers'] = str_replace(' ', '', $cfg['plugin']['alphafilters']['fieldusers']);
        $al_fields = explode(',', $cfg['plugin']['alphafilters']['fieldusers']);
        foreach($al_fields as $a_key => $a_val){
            if(!isset($cot_extrafields[$db_users][$a_val]) && !array_key_exists($a_val, $users_sort_tags)){
                unset($al_fields[$a_key]);
            }
        }
    }

	$title[] = $alpha;
    if(!empty($al_fields)){
        $where['alpha'] = '';
        foreach($al_fields as $a_key => $a_field){
            if($where['alpha'] != '') $where['alpha'] .= ' OR ';
            $where['alpha'] .= "user_".$a_field." LIKE " . $db->quote($alpha."%");
        }
        if($where['alpha'] != '') $where['alpha'] = "({$where['alpha']})";
    }
}
