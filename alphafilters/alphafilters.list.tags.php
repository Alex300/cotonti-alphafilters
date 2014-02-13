<?php

/**
 * [BEGIN_COT_EXT]
 * Hooks=page.list.tags,users.tags
 * Tags=list.tpl:{ALPHAFILTER_1},{ALPHAFILTER_2},{ALPHAFILTER_3};users.tpl:{ALPHAFILTER_1},{ALPHAFILTER_2},{ALPHAFILTER_3}
 * [END_COT_EXT]
 */
/**
 * Alphafilters Plugin for Cotonti CMF
 *
 * @version 4.0.0
 * @author esclkm, http://www.littledev.ru
 * @copyright (c) 2008-2010 esclkm, http://www.littledev.ru
 */
defined('COT_CODE') or die('Wrong URL');

$sep = ($cfg['plugin']['alphafilters']['separator']) ? " " : "";
foreach ($cfg['plugin']['alphafilters'] as $key => $value)
{
	if ((int)$key > 0)
	{
		$str_arr[$key] = $value;
	}
}

foreach ($str_arr as $key => $str)
{
	$alphafilter = '';
	$str = explode(" ", $str);
	foreach ($str as $j)
	{
		if (!empty($alpha) && $j == $alpha)
		{
			$alphafilter .= '<span class="alpha_current">'.$j.'</span>'.$sep;
		}
		else
		{
			if (defined('COT_LIST'))
				$alphafilter .= '<span class="alpha_letter"><a href="'.cot_url('page', array('alpha' => urlencode($j)) + $list_url_path).'">'.$j.'</a></span>'.$sep;
			else
				$alphafilter .= '<span class="alpha_letter"><a href="'.cot_url('users', array('alpha' => urlencode($j)) + $users_url_path).'">'.$j.'</a></span>'.$sep;
		}
	}
	$t->assign("ALPHAFILTER_".$key, $alphafilter);
}
