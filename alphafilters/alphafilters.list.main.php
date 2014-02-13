<?php

/** 
 * [BEGIN_COT_EXT]
 * Hooks=page.list.main
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
global $alpha;
if (!empty($alpha))
{
	echo(123);
	$catpath = cot_structure_buildpath('page', $c);
	$catpath[] = array(cot_url('page', 'c='.$c.'&alpha='.urlencode($alpha)), $alpha);
	$catpath = cot_breadcrumbs($catpath, $cfg['homebreadcrumb'], true);
}

?>
