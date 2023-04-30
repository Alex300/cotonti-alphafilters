<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=users.query
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
 * @var array $users_url_path
 */

defined('COT_CODE') or die('Wrong URL');

if (Cot::$cfg['plugin']['alphafilters']['turnOnUsers']) {
    $alpha = cot_import('alpha', 'G', 'TXT');
    if (!empty($alpha)) {
        $alpha = urldecode($alpha);
    }
    if (!empty($alpha)) {
        $users_url_path['alpha'] = $alpha;
        $alphaFields = !empty(Cot::$cfg['plugin']['alphafilters']['fieldUsers']) ?
            Cot::$cfg['plugin']['alphafilters']['fieldUsers'] : 'name';

        $alphaFields = explode(',', $alphaFields);
        $alphaSqlParts = [];
        foreach ($alphaFields as $key => $field) {
            $field = trim($field);
            if (empty($field)) {
                unset($alphaFields[$key]);
                continue;
            }
            $alphaFields[$key] = 'user_' . $field;
            if (!Cot::$cfg['plugin']['alphafilters']['lettersFromDBUsers'] && $alpha == '_') {
                $alphaSqlParts[] = Cot::$db->quoteC($alphaFields[$key]) . ' NOT REGEXP("^[a-zA-Z0-9А-Яа-я]")';
            } else {
                $alphaSqlParts[] = Cot::$db->quoteC($alphaFields[$key]) . ' LIKE ' .
                    Cot::$db->quote($alpha . '%');
            }
        }

        $title[] = $alpha;
        if (!empty($alphaSqlParts)) {
            $where['alpha'] = '(' . implode(' OR ', $alphaSqlParts) . ')';
        }
    }
}
