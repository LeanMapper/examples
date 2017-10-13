
# CamelCase to under_score mapper

Existuje mnoho důvodů proč v databázi pojmenovávat *sloupce/tabulky* pouze malými písmeny a jednotlivá slova oddělovat podtržítkem `_` *(tzv. under score konvence)*. Pokud bychom ale na straně PHP chtěli k těmto datům přistupovat pomocí *camel case konvence*, tedy vizuálně oddělovat velkým písmenem na začátku jednotlivých slov, **Lean Mapper** k tomu nabízí všechny potřebné prostředky.

K zprovoznění této funkcionality postačí upravit [**mapper**](http://leanmapper.com/cs/docs/mapper/), tedy třídu, která dědí po `LeanMapper\DefaultMapper` nebo jen implementuje rozhraní `LeanMapper\IMapper`.

V souboru `Mapper.php` si připravíme statické metody `toUnderScore` a `toCamelCase`. Ty se nám budou převádět `fooBar` na `foo_bar` a obráceně. Tyto 2 metody pak už jen stačí použít v odpovídajících metodách mapperu, konkrétně se jedná o:

* `getTable()` - převádí název entity na název tabulky
* `getEntityClass()` - převádí název tabulky na název entity
* `getColumn()` - převádí název property v entitě na název sloupečku v DB
* `getEntityField()` - převádí název sloupečku v DB na název property v entitě
* `getTableByRepositoryClass()` - převádí název repositáře na název tabulky


--------

Pokud si nechcete psát vlastní mapper, můžete vyzkoušet předpřipravené balíčky vytvořené komunitou:

* [inlm/mappers](https://github.com/inlm/mappers)
