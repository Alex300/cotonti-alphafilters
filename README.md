Alpha Filters
============

Plugin for CMF [Cotonti](https://www.cotonti.com). Pages and users list filter by first 
letter.

The **Alpha Filters** plugin gives you a flexible capability to filter pages & users by letters, 
numbers and letter combinations (syllable-based). You can also assign your own styles to the 
filter span elements.

Authors: [esclkm](https://www.cotonti.com/users/esclkm), Kalnov Alexey <kalnovalexey@yandex.ru>,
Cotonti Team

Plugin page:  
https://lily-software.com/free-scripts/cotonti-alpha-filters

## Installation

- Unpack to your plugins folder
- Install the plugin in AdminCP
- Add tags to `page.list.tpl` and/or `users.tpl`
- Customize plugin configuration if necessary

Example for users.tpl:
```
<!-- IF {PHP|cot_plugin_active('alphafilters')} AND {PHP.cfg.plugin.alphafilters.turnOnUsers} == 1 -->
<div class="margin10 small text-center">
    {PHP.L.alphafilters_byFirstLetter}:
    {ALPHAFILTER_1} {ALPHAFILTER_2}<!-- IF {ALPHAFILTER_3} --><br />{ALPHAFILTER_3}<!-- ENDIF -->
    {ALPHAFILTER_RESET}
</div>
<!-- ENDIF -->
```