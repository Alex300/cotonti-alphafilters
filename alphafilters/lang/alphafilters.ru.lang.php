<?php
/**
 * Russian Language File for the Alpha Filters plugin
 *
 * @package alphafilters
 * @author esclkm, Kalnov Alexey <kalnovalexey@yandex.ru>, Cotonti Team
 * @copyright (c) 2008-2011 esclkm https://www.cotonti.com/en/users/esclkm,
 *  2011-2023 Lily Software https://lily-software.com (ex. Portal30 Studio), Cotonti Team
 */

defined('COT_CODE') or die('Wrong URL.');

/**
 * Plugin config
 */

$L['cfg_alpha1'] = 'Группа символов 1';
$L['cfg_alpha1_hint'] = "1-я группа символов фильтра. Для тега <strong>'{ALPHAFILTER_1}'</strong>";
$L['cfg_alpha2'] = 'Группа символов 2';
$L['cfg_alpha2_hint'] = "2-я группа символов фильтра. Для тега <strong>'{ALPHAFILTER_2}'</strong>";
$L['cfg_alpha3'] = 'Группа символов 3';
$L['cfg_alpha3_hint'] = "3-я группа символов фильтра. Для тега <strong>'{ALPHAFILTER_3}'</strong>";

$L['cfg_turnOnPages'] = 'Включить для страниц';
$L['cfg_turnOnUsers'] = 'Включить для пользователей';

$L['cfg_field'] = 'Поле для фильтра страниц';
$L['cfg_field_hint'] = "Фильтровать страницы по полю: <strong>'page_XXXX'</strong>. Если пусто, будет использовано " .
    "<strong>'title'</strong>. Можно указать несколько полей через запятую.";

$L['cfg_fieldUsers'] = 'Поле для фильтра пользователей';
$L['cfg_fieldUsers_hint'] = "Фильтровать пользователей по полю: <strong>'user_XXXX'</strong>. Если пусто, будет использовано " .
    "<strong>'name'</strong>. Можно указать несколько полей через запятую.";

$L['cfg_lettersFromDBPages'] = "Автоматически загрузить символы для фильтра страниц";
$L['cfg_lettersFromDBPages_hint'] = "Если включено, символы для фильтра будут загружены из таблицы <strong>" .
    "'cot_pages'</strong> автоматически и настройки символов для фильтра выше будут проигнорированы";

$L['cfg_lettersFromDBUsers'] = "Автоматически загрузить символы для фильтра пользователей";
$L['cfg_lettersFromDBUsers_hint'] = "Если включено, символы для фильтра будут загружены из таблицы <strong>" .
    "'cot_users'</strong> автоматически и настройки символов для фильтра выше будут проигнорированы";

$L['info_desc'] = 'Фильтр страниц и пользователей по первому символу';

$L['alphafilters_byFirstLetter'] = 'По первой букве';
$L['alphafilters_reset'] = 'сброс';