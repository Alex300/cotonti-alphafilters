<?php
/* ====================
[BEGIN_COT_EXT]
Code=alphafilters
Name=Alphabetical filters
Description=The Alpha Filters plugin gives you a flexible capability to filter pages & users by letters, numbers and letter combinations (syllable-based). You can also assign your own styles to the filter span elements.
Version=5.0.0
Date=2023-04-26
Author=esclkm, Kalnov Alexey (kalnovalexey@yandex.ru), Cotonti Team
Copyright=&copy; 2008-2011 esclkm https://www.cotonti.com/en/users/esclkm, 2011-2023 Lily Software https://lily-software.com (ex. Portal30 Studio), Cotonti Team
Auth_guests=R
Lock_guests=W12345A
Auth_members=R
Lock_members=W12345A
[END_COT_EXT]

[BEGIN_COT_EXT_CONFIG]
alpha1=01:string::A B C D E F G H I J K L M N O P Q R S T U V W X Y Z:Alphabetical filter 1
alpha2=02:string::1 2 3 4 5 6 7 8 9 0 _:Alphabetical filter 2
alpha3=03:string::А Б В Г Д Е Ё Ж З И Й К Л М Н О П Р С Т У Ф Х Ц Ч Ш Щ Ъ Ы Ь Э Ю Я:Alphabetical filter 3
turnOnPages=10:radio::1:Turn on for pages
turnOnUsers=15:radio::1:Turn on for users
field=20:string::title:Filter pages by field page_XXXX
fieldUsers=25:string::name:Filter users by field user_XXXX
lettersFromDBPages=30:radio::1:Get letters from 'cot_pages' table
lettersFromDBUsers=35:radio::1:Get letters from 'cot_users' table
letterSeparator=40:radio::1:Letter separator
[END_COT_EXT_CONFIG]
==================== */

/**
 * Alpha Filters plugin for Cotonti CMF
 *
 * @package alphafilters
 * @author esclkm, Kalnov Alexey <kalnovalexey@yandex.ru>, Cotonti Team
 * @copyright (c) 2008-2011 esclkm https://www.cotonti.com/en/users/esclkm,
 *  2011-2023 Lily Software https://lily-software.com (ex. Portal30 Studio), Cotonti Team
 */

defined('COT_CODE') or die('Wrong URL');
