<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=page.list.query
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
 * @var array $list_url_path
 * @var array $cat
 * @var string $c
 * @var array $catpatharray
 * @var string $catpath
 */

defined('COT_CODE') or die('Wrong URL');

if (Cot::$cfg['plugin']['alphafilters']['turnOnPages']) {
    $alpha = cot_import('alpha', 'G', 'TXT');
    if (!empty($alpha)) {
        $alpha = urldecode($alpha);
    }
    if (!empty($alpha)) {
        $list_url_path['alpha'] = $alpha;

        $catpatharray[] = [cot_url('page', $list_url_path), $alpha];
        $catpath = in_array($c, ['all', 'system', 'unvalidated', 'saved_drafts']) ?
            $cat['title'] : cot_breadcrumbs($catpatharray, Cot::$cfg['homebreadcrumb'], true);

        $alphaFields = !empty(Cot::$cfg['plugin']['alphafilters']['field']) ?
            Cot::$cfg['plugin']['alphafilters']['field'] : 'title';

        $alphaFields = explode(',', $alphaFields);
        $alphaSqlParts = [];
        $alphaExistingFields = [];
        foreach ($alphaFields as $key => $field) {
            $field = trim($field);
            if (empty($field)) {
                unset($alphaFields[$key]);
                continue;
            }
            $alphaFields[$key] = 'page_' . $field;

            if (
                !in_array(
                    $alphaFields[$key],
                    [
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
                    ]
                )
            ) {
                if (empty($alphaExistingFields)) {
                    $alphaCols = Cot::$db->query("SHOW COLUMNS FROM " . Cot::$db->pages)->fetchAll();
                    foreach ($alphaCols as $column) {
                        $alphaExistingFields[] = $column['Field'];
                    }
                }
                if (!in_array($alphaFields[$key], $alphaExistingFields)) {
                    $alphaErrorMsg = "Field '{$alphaFields[$key]}' in pages table not found";
                    cot_error($alphaErrorMsg);
                    cot_log($alphaErrorMsg, 'alphafilters', 'filter', 'error');
                    unset($alphaFields[$key]);
                    continue;
                }
            }

            if (!Cot::$cfg['plugin']['alphafilters']['lettersFromDBPages'] && $alpha == '_') {
                $alphaSqlParts[] = Cot::$db->quoteC($alphaFields[$key]) . ' NOT REGEXP("^[a-zA-Z0-9А-Яа-я]")';
            } else {
                $alphaSqlParts[] = Cot::$db->quoteC($alphaFields[$key]) . ' LIKE ' .
                    Cot::$db->quote($alpha . '%');
            }
        }

        if (!empty($alphaSqlParts)) {
            $where['alpha'] = '(' . implode(' OR ', $alphaSqlParts) . ')';
        }
    }
}