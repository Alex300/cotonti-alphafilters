<?php
/**
 * English Language File for the Alpha Filters plugin
 *
 * @package alphafilters
 * @author esclkm http://www.littledev.ru, Cotonti Team
 * @copyright (c) 2008-2011 esclkm, 2011-2023 Cotonti Team
 */

defined('COT_CODE') or die('Wrong URL.');

/**
 * Plugin config
 */

$L['cfg_alpha1'] = 'Character group 1';
$L['cfg_alpha1_hint'] = "1st characters group for filter for tag <strong>'{ALPHAFILTER_1}'</strong>";
$L['cfg_alpha2'] = 'Character group 2';
$L['cfg_alpha2_hint'] = "2nd characters group for filter for tag <strong>'{ALPHAFILTER_2}'</strong>";
$L['cfg_alpha3'] = 'Character group 3';
$L['cfg_alpha3_hint'] = "3rd characters group for filter for tag <strong>'{ALPHAFILTER_3}'</strong>";

$L['cfg_turnOnPages'] = 'Turn on for pages';
$L['cfg_turnOnUsers'] = 'Turn on for users';

$L['cfg_field'] = 'Page field for filter';
$L['cfg_field_hint'] = "Filter pages by field: <strong>'page_XXXX'</strong>. If empty, <strong>'title'</strong> " .
    'will be used. You can specify multiple fields separated by commas.';

$L['cfg_fieldUsers'] = 'Users field for filter';
$L['cfg_fieldUsers_hint'] = "Filter users by field: <strong>'user_XXXX'</strong>. If empty, <strong>'name'</strong> " .
    'will be used. You can specify multiple fields separated by commas.';

$L['cfg_lettersFromDBPages'] = "Automatically load characters for the page filter";
$L['cfg_lettersFromDBPages_hint'] = "If enabled, the characters for the filter will be loaded from the <strong>" .
    "'cot_pages'</strong> automatically and filter character settings above will be ignored";

$L['cfg_lettersFromDBUsers'] = "Automatically load characters for the users filter";
$L['cfg_lettersFromDBUsers_hint'] = "If enabled, the characters for the filter will be loaded from the <strong>" .
    "'cot_users'</strong>  automatically and filter character settings above will be ignored";

$L['info_desc'] = 'Filter for pages and users lists by first character(s)';

$L['alphafilters_byFirstLetter'] = 'By first letter';
$L['alphafilters_reset'] = 'reset';