<?php
/*
[BEGIN_COT_EXT]
Code=alphafilters
Name=Alphabetical filters
Description=The Alpha Filters 4 is a free plugin that gives you a flexible capability to filter pages & users by letters, numbers an letter combinations (syllable-based). You can also assign your own styles to the filter span elements.
Version=4.0.1
Date=2014-feb-13
Author=esclkm, http://www.littledev.ru; Alex http://portal30.ru
Copyright=&copy; esclkm, http://www.littledev.ru 2010; Studio Portal30 2014, http://portal30.ru
Auth_guests=R
Lock_guests=W12345A
Auth_members=R
Lock_members=W12345A
[END_COT_EXT]

[BEGIN_COT_EXT_CONFIG]
1=01:string::A B C D E F G H I J K L M N O P Q R S T U V W X Y Z:Alphabetical filter 1
2=02:string::1 2 3 4 5 6 7 8 9 0:Alphabetical filter 2
3=03:string::А Б В Г Д Е Ё Ж З И Й К Л М Н О П Р С Т У Ф Х Ц Ч Ш Щ Ъ Ы Ь Э Ю Я:Alphabetical filter 3
field=04:string::title:Filter pages by field page_XXXX
fieldusers=05:string::name:Filter users by field user_XXXX
separator=06:radio::1:Space separator
[END_COT_EXT_CONFIG]
 */

/**
 * Alphafilters Plugin for Cotonti CMF
 *
 * @version 4.0.0
 * @author esclkm, http://www.littledev.ru
 * @copyright (c) 2008-2011 esclkm, http://www.littledev.ru
 */

defined('COT_CODE') or die('Wrong URL');