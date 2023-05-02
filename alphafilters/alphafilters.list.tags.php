<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=page.list.tags,users.tags
Tags=list.tpl:{ALPHAFILTER_1},{ALPHAFILTER_2},{ALPHAFILTER_3}{ALPHAFILTER_RESET}{ALPHAFILTER_RESET_URL};users.tpl:{ALPHAFILTER_1},{ALPHAFILTER_2},{ALPHAFILTER_3}{ALPHAFILTER_RESET}{ALPHAFILTER_RESET_URL}
[END_COT_EXT]
==================== */

/**
 * Alpha Filters plugin for Cotonti CMF
 *
 * @package alphafilters
 * @author esclkm, Kalnov Alexey <kalnovalexey@yandex.ru>, Cotonti Team
 * @copyright (c) 2008-2011 esclkm https://www.cotonti.com/en/users/esclkm,
 *  2011-2023 Lily Software https://lily-software.com (ex. Portal30 Studio), Cotonti Team
 *
 * @var XTemplate $t
 * @var array $list_url_path
 * @var array $users_url_path
 */

defined('COT_CODE') or die('Wrong URL');

if (
    !$t->hasTag('ALPHAFILTER_1')
    || (Cot::$env['ext'] == 'page' && !Cot::$cfg['plugin']['alphafilters']['turnOnPages'])
    || (Cot::$env['ext'] == 'users' && !Cot::$cfg['plugin']['alphafilters']['turnOnUsers'])
) {
    return;
}

// Requirements
require_once cot_langfile('alphafilters', 'plug');

$separator = (Cot::$cfg['plugin']['alphafilters']['letterSeparator']) ? " " : "";

$filterSymbols = [];
$alphaFields = null;
$alphaPrefix = null;
$alphaTable = null;
$alphaDontCheck = [];
if (
    Cot::$env['ext'] == 'users'
    && Cot::$cfg['plugin']['alphafilters']['lettersFromDBUsers']
) {
    $alphaFields = !empty(Cot::$cfg['plugin']['alphafilters']['fieldUsers']) ?
        Cot::$cfg['plugin']['alphafilters']['fieldUsers'] : 'name';
    $alphaPrefix = 'user_';
    $alphaTable = Cot::$db->users;
    $alphaDontCheck = ['user_name', 'user_country', 'user_text', 'user_birthdate', 'user_gender', 'user_email',];

} elseif (
    Cot::$env['ext'] == 'page'
    && Cot::$cfg['plugin']['alphafilters']['lettersFromDBPages']
) {
    $alphaFields = !empty(Cot::$cfg['plugin']['alphafilters']['field']) ?
        Cot::$cfg['plugin']['alphafilters']['field'] : 'title';
    $alphaPrefix = 'page_';
    $alphaTable = Cot::$db->pages;
    $alphaDontCheck = [
        'page_alias',
        'page_cat',
        'page_title',
        'page_desc',
        'page_keywords',
        'page_metatitle',
        'page_metadesc',
        'page_text',
        'page_author',
        'page_url',
    ];
}
if (!empty($alphaFields)) {
    $alphaFields = explode(',', $alphaFields);
    $alphaSqlParts = [];
    $alphaExistingFields = [];
    foreach ($alphaFields as $key => $field) {
        $field = trim($field);
        if (empty($field)) {
            unset($alphaFields[$key]);
            continue;
        }
        $alphaFields[$key] = $alphaPrefix . $field;

        if (!in_array($alphaFields[$key], $alphaDontCheck)) {
            if (empty($alphaExistingFields)) {
                $alphaCols = Cot::$db->query("SHOW COLUMNS FROM " . $alphaTable)->fetchAll();
                foreach ($alphaCols as $column) {
                    $alphaExistingFields[] = $column['Field'];
                }
            }
            if (!in_array($alphaFields[$key], $alphaExistingFields)) {
                unset($alphaFields[$key]);
                continue;
            }
        }

        //$distinct = ($key == 0) ? 'DISTINCT' : '';
        $alphaSqlParts[] = 'SELECT UPPER(LEFT(' . Cot::$db->quoteC($alphaFields[$key]) . ', 1)) as letter FROM '
            . Cot::$db->quoteT($alphaTable);
    }

    if (!empty($alphaSqlParts)) {
        $alphaSql = implode(' UNION ', $alphaSqlParts) . ' ORDER BY letter';
        $letters = Cot::$db->query($alphaSql)->fetchAll(PDO::FETCH_COLUMN);
    }
    if (!empty($letters)) {
        foreach ($letters as $key => $letter) {
            if ($letter === null || in_array($letter, ['', ' '])) {
                continue;
            }
            $filterSymbols[1][] = $letter;
        }
    }
}

// Take filter characters from config
if (empty($alphaTable)) {
    foreach (Cot::$cfg['plugin']['alphafilters'] as $configKey => $value) {
        $cfgKey = 0;
        if (mb_strpos($configKey,'alpha') === 0) {
            $cfgKey = (int) str_replace('alpha', '', $configKey);
        }
        if ($cfgKey > 0) {
            $letters = explode(" ", $value);
            foreach ($letters as $key => $letter) {
                $letter = trim($letter);
                if ($letter !== '') {
                    $filterSymbols[$cfgKey][] = $letter;
                }
            }
        }
    }
}

foreach ($filterSymbols as $key => $letters) {
    $alphaFilter = '';
    $alphaFilterReset = '';
    $alphaFilterResetUrl = '';
	foreach ($letters as $letter) {
		if (!empty($alpha) && $letter == $alpha) {
            $alphaFilter .= '<span class="alpha-current">' . $letter . '</span>' . $separator;
		} else {
			if (Cot::$env['ext'] == 'page' && Cot::$env['location'] == 'list') {
                $alphaFilter .= '<span class="alpha-letter"><a href="' .
                    cot_url('page', ['alpha' => $letter] + $list_url_path) . '">' .
                    $letter . '</a></span>' . $separator;
            } else {
                $alphaFilter .= '<span class="alpha-letter"><a href="' .
                    cot_url('users', ['alpha' => $letter] + $users_url_path) . '">' .
                    $letter . '</a></span>' . $separator;
            }
		}
	}

    if (!empty($alpha)) {
        if (Cot::$env['ext'] == 'page') {
            $urlPath = $list_url_path;
            unset($urlPath['alpha']);
            $alphaFilterResetUrl = cot_url('page', $urlPath);
        } else {
            $urlPath = $users_url_path;
            unset($urlPath['alpha']);
            $alphaFilterResetUrl = cot_url('users', $urlPath);
        }

        $alphaFilterReset = '<span class="alpha-reset">(<a href="' . $alphaFilterResetUrl . '">' .
            Cot::$L['alphafilters_reset'] . '</a>)</span>';
    }

	$t->assign([
        'ALPHAFILTER_' . $key => $alphaFilter,
        'ALPHAFILTER_RESET' => $alphaFilterReset,
        'ALPHAFILTER_RESET_URL' => $alphaFilterResetUrl,
    ]);
}
