<?php

/** 
 * [BEGIN_COT_EXT]
 * Hooks=page.list.query
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
	$list_url_path['alpha'] = urlencode($alpha);
	$field = empty($cfg['plugin']['alphafilters']['field']) ? "title" : $cfg['plugin']['alphafilters']['field'];
	$where['alpha'] = "page_".$field." LIKE " . $db->quote($alpha."%");

}

