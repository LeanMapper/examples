
# Dynamický mapper

Pokud máme naší aplikaci rozdělenou do jednotlivých modulů, pravděpodobně se naše entity nachází i v různých jmenných prostorech. Výchozí mapper v Lean Mapperu ale umožňuje použít pouze jeden jmenný prostor. Řešením je použít "dynamický mapper".

Jeden takový naleznete v souboru `DynamicMapper.php`, jeho použití je pak snadné:

``` php
$mapper = new DynamicMapper;
$mapper->registerModule('news', array('item', 'comment', 'rating'));
$mapper->registerModule('content', array('page', 'text'));
```

Takové nastavení způsobí, že entita `Addon\News\Entity\Comment` bude mapována na tabulku `news_comment`, entita `Addon\Content\Entity\Page` na tabulku `content_page` apod.


--------

Pokud si nechcete psát vlastní mapper, můžete vyzkoušet předpřipravené balíčky vytvořené komunitou:

* [inlm/mappers](https://github.com/inlm/mappers)
