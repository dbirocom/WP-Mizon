<?php
  if ( function_exists( 'ot_get_option') ) {
    $amazoncom = ot_get_option( 'amazoncom');
    $amazoncouk = ot_get_option( 'amazoncouk'); 
    $amazonde = ot_get_option( 'amazonde'); 
    $amazonit = ot_get_option( 'amazonit'); 
    $amazonfr = ot_get_option( 'amazonfr'); 
    $amazonsp = ot_get_option( 'amazonsp');
    $language = ot_get_option( 'language'); 
  }
?>
<?php if (ot_get_option('language')=="english(us)")  { ?>
  <form method="get" target="_blank" action="http://www.amazon.com/s/">
    <input type="text" class="field" name="field-keywords" id="searchforms" placeholder="" />
    <select name="node" class="optionform">
      <option value="2625369011">All Department</option>
      <option value="2858778011">Amazon Instant Video</option>
      <option value="2619525011">Appliances</option>
      <option value="2350149011">Appstore for Android</option>
      <option value="2617941011">Arts and Crafts</option>
      <option value="15684181">Automotive</option>
      <option value="165796011">Baby</option>
      <option value="3760911">Beauty</option>
      <option value="283155">Books</option>
      <option value="2335752011">Cell phones &amp; accessories</option>
      <option value="1036592">Clothing &amp; Accessories</option>
      <option value="4991425011">Collectibles</option>
      <option value="541966">Computers</option>
      <option value="163856011">Digital music</option>
      <option value="172282">Electronics</option>
      <option value="2238192011">Gift Cards</option>
      <option value="16310101">Grocery &amp; Gourmet food</option>
      <option value="3760901">Health &amp; personal care</option>
      <option value="1055398">Home &amp; kitchen</option>
      <option value="16310091">Industrial &amp; Scientific</option>
      <option value="3367581">Jewelry</option>
      <option value="133141011">Kindle store</option>
      <option value="599858">Magazine Subscriptions</option>
      <option value="2625373011">Movies &amp; TV</option>
      <option value="163856011">MP3 downloads</option>
      <option value="5174">Music</option>
      <option value="11091801">Musical Instruments</option>
      <option value="1064954">Office &amp; School Supplies</option>
      <option value="2972638011">Patio, lawn &amp; garden</option>
      <option value="2619533011">Pet Supplies</option>
      <option value="672123011">Shoes</option>
      <option value="229534">Software</option>
      <option value="3375251">Sports &amp; Outdoors</option>
      <option value="228013">Tools &amp; home improvement</option>
      <option value="165793011">Toys and games</option>
      <option value="468642">Video Games</option>
      <option value="377110011">Watches</option>
    </select>
    <select name="pct-off" class="optionform">
      <option value="0-99">Any Discount</option>
      <option value="10-99">10% Off or More</option>
      <option value="25-49">25% Off or More</option>
      <option value="50-99">50% Off or More</option>
      <option value="75-99">75% Off or More</option>
      <option value="90-99">90% Off or More</option>
    </select>
    <input name="tag" value="<?php echo $amazoncom ?>" type="hidden">
    <input id="submit" type="submit" class="submit" value="<?php echo $lang[34];?>">
  </form>
<?php } ?>
<?php if (ot_get_option('language')=="english(uk)")  { ?>
  <form method="get" target="_blank" action="http://http://www.amazon.co.uk/s/">
    <input type="text" class="field" name="field-keywords" id="searchforms" placeholder="" />
    <select name="node" class="optionform">
      <option value="2625369011">All Department</option>
      <option value="2858778011">Amazon Instant Video</option>
      <option value="2619525011">Appliances</option>
      <option value="2350149011">Appstore for Android</option>
      <option value="2617941011">Arts and Crafts</option>
      <option value="15684181">Automotive</option>
      <option value="165796011">Baby</option>
      <option value="3760911">Beauty</option>
      <option value="283155">Books</option>
      <option value="2335752011">Cell phones &amp; accessories</option>
      <option value="1036592">Clothing &amp; Accessories</option>
      <option value="4991425011">Collectibles</option>
      <option value="541966">Computers</option>
      <option value="163856011">Digital music</option>
      <option value="172282">Electronics</option>
      <option value="2238192011">Gift Cards</option>
      <option value="16310101">Grocery &amp; Gourmet food</option>
      <option value="3760901">Health &amp; personal care</option>
      <option value="1055398">Home &amp; kitchen</option>
      <option value="16310091">Industrial &amp; Scientific</option>
      <option value="3367581">Jewelry</option>
      <option value="133141011">Kindle store</option>
      <option value="599858">Magazine Subscriptions</option>
      <option value="2625373011">Movies &amp; TV</option>
      <option value="163856011">MP3 downloads</option>
      <option value="5174">Music</option>
      <option value="11091801">Musical Instruments</option>
      <option value="1064954">Office &amp; School Supplies</option>
      <option value="2972638011">Patio, lawn &amp; garden</option>
      <option value="2619533011">Pet Supplies</option>
      <option value="672123011">Shoes</option>
      <option value="229534">Software</option>
      <option value="3375251">Sports &amp; Outdoors</option>
      <option value="228013">Tools &amp; home improvement</option>
      <option value="165793011">Toys and games</option>
      <option value="468642">Video Games</option>
      <option value="377110011">Watches</option>
    </select>
    <select name="pct-off" class="optionform">
      <option value="0-99">Any Discount</option>
      <option value="10-99">10% Off or More</option>
      <option value="25-49">25% Off or More</option>
      <option value="50-99">50% Off or More</option>
      <option value="75-99">75% Off or More</option>
      <option value="90-99">90% Off or More</option>
    </select>
    <input name="tag" value="<?php echo $amazoncouk ?>" type="hidden">
    <input id="submit" type="submit" class="submit" value="<?php echo $lang[34];?>">
  </form>
<?php } ?>
<?php if (ot_get_option('language')=="german(de)")  { ?>
  <form method="get" target="_blank" action="http://www.amazon.de/s/">
    <input type="text" class="field" name="field-keywords" id="searchforms" placeholder="" />
    <select name="node" class="optionform">
      <option value="1342716897">Alle Kategorien</option>
<option value="78191031">Auto</option>
<option value="355007011">Baby</option>
<option value="80084031">Baumarkt</option>
<option value="77028031">Bekleidung</option>
<option value="213083031">Beleuchtung</option>
<option value="299956">Bücher</option>
<option value="192416031">Bürobedarf &amp; Schreibwaren</option>
<option value="340843031">Computer &amp; Zubehör</option>
<option value="64187031">Drogerie &amp; Körperpflege</option>
<option value="908823031">Elektro-Großgeräte</option>
<option value="562066">Elektronik &amp; Foto</option>
<option value="52044011">Fremdsprachige Bücher</option>
<option value="284266">Filme &amp; TV</option>
<option value="301052">Games</option>
<option value="10925031">Garten</option>
<option value="340852031">Haustier</option>
<option value="562066">Kamera &amp; Foto</option>
<option value="530484031">Kindle-Shop</option>
<option value="290380">Klassik</option>
<option value="3167641">Küche &amp; Haushalt</option>
<option value="340846031">Lebensmittel &amp; Getränke</option>
<option value="908829031">Motorrad</option>
<option value="77195031">MP3-Downloads</option>
<option value="290380">Musik</option>
<option value="340849031">Musikinstrumente &amp; DJ-Equipment</option>
<option value="84230031">Parfümerie &amp; Kosmetik</option>
<option value="327472011">Schmuck</option>
<option value="355006011">Schuhe &amp; Handtaschen</option>
<option value="301928">Software</option>
<option value="12950651">Spielzeug</option>
<option value="16435051">Sport &amp; Freizeit</option>
<option value="193707031">Uhren</option>
<option value="1161658">Zeitschriften</option>
    </select>
    <select name="pct-off" class="optionform">
<option value="0-99">ein etwaiger Abschlag</option>
<option value="10-99">10% Rabatt oder mehr</option>
<option value="25-49">25% Rabatt oder mehr</option>
<option value="50-99">50% Rabatt oder mehr</option>
<option value="75-99">75% Rabatt oder mehr</option>
<option value="90-99">90% Rabatt oder mehr</option>
    </select>
    <input name="tag" value="<?php echo $amazonde ?>" type="hidden">
    <input id="submit" type="submit" class="submit" value="<?php echo $lang[34];?>">
  </form>
<?php } ?>
<?php if (ot_get_option('language')=="italian(it)")  { ?>
  <form method="get" target="_blank" action="http://www.amazon.it/s/">
    <input type="text" class="field" name="field-keywords" id="searchforms" placeholder="" />
    <select name="node" class="optionform">
      <option value="2018207">Tutte le categorie</option>
<option value="524015031">Casa e cucina</option>
<option value="412609031">Elettronica</option>
<option value="412606031">Film e TV</option>
<option value="635016031">Giardino e giardinaggio</option>
<option value="523997031">Giochi e giocattoli</option>
<option value="1571292031">Illuminazione</option>
<option value="818937031">Kindle Store</option>
<option value="411663031">Libri</option>
<option value="433842031">Libri in altre lingue</option>
<option value="412600031">Musica</option>
<option value="524009031">Orologi</option>
<option value="524006031">Scarpe e borse</option>
<option value="412612031">Software</option>
<option value="524012031">Sport e tempo libero</option>
<option value="412603031">Videogiochi</option>
    </select>
    <select name="pct-off" class="optionform">
<option value="0-99">Ogni Eventuale Sconto</option>
<option value="10-99">10% off o più</option>
<option value="25-49">25% off o più</option>
<option value="50-99">50% off o più</option>
<option value="75-99">75% off o più</option>
<option value="90-99">90% off o più</option>
    </select>
    <input name="tag" value="<?php echo $amazonit ?>" type="hidden">
    <input id="submit" type="submit" class="submit" value="<?php echo $lang[34];?>">
  </form>
<?php } ?>
<?php if (ot_get_option('language')=="french(fr)")  { ?>
  <form method="get" target="_blank" action="http://www.amazon.fr/s/">
    <input type="text" class="field" name="field-keywords" id="searchforms" placeholder="" />
    <select name="node" class="optionform">
      <option value="2018207">Tutte le categorie</option>
<option value="524015031">Casa e cucina</option>
<option value="412609031">Elettronica</option>
<option value="412606031">Film e TV</option>
<option value="635016031">Giardino e giardinaggio</option>
<option value="523997031">Giochi e giocattoli</option>
<option value="1571292031">Illuminazione</option>
<option value="818937031">Kindle Store</option>
<option value="411663031">Libri</option>
<option value="433842031">Libri in altre lingue</option>
<option value="412600031">Musica</option>
<option value="524009031">Orologi</option>
<option value="524006031">Scarpe e borse</option>
<option value="412612031">Software</option>
<option value="524012031">Sport e tempo libero</option>
<option value="412603031">Videogiochi</option>
    </select>
    <select name="pct-off" class="optionform">
<option value="0-99">Ogni Eventuale Sconto</option>
<option value="10-99">10% off o più</option>
<option value="25-49">25% off o più</option>
<option value="50-99">50% off o più</option>
<option value="75-99">75% off o più</option>
<option value="90-99">90% off o più</option>
    </select>
    <input name="tag" value="<?php echo $amazonfr ?>" type="hidden">
    <input id="submit" type="submit" class="submit" value="<?php echo $lang[34];?>">
  </form>
<?php } ?>
<?php if (ot_get_option('language')=="spanish(sp)")  { ?>
  <form method="get" target="_blank" action="http://www.amazon.es/s/">
    <input type="text" class="field" name="field-keywords" id="searchforms" placeholder="" />
    <select name="node" class="optionform">
      <option value="599364031">Todos los departamentos</option>
<option value="599370031">Electrónica</option>
<option value="599385031">Juguetes</option>
<option value="599364031">Libros</option>
<option value="599367031">Libros en idiomas extranjeros</option>
<option value="599373031">Música</option>
<option value="599379031">Películas y TV</option>
<option value="599391031">Pequeño Electrodoméstico</option>
<option value="599388031">Relojes</option>
<option value="599376031">Software</option>
<option value="818936031">Tienda Kindle</option>
<option value="599382031">Videojuegos</option>
    </select>
    <select name="pct-off" class="optionform">
<option value="0-99">ningún tipo de descuento</option>
<option value="10-99">10% de descuento o más</option>
<option value="25-49">25% de descuento o más</option>
<option value="50-99">50% de descuento o más</option>
<option value="75-99">75% de descuento o más</option>
<option value="90-99">90% de descuento o más</option>
    </select>
    <input name="tag" value="<?php echo $amazonsp ?>" type="hidden">
    <input id="submit" type="submit" class="submit" value="<?php echo $lang[34];?>">
  </form>
<?php } ?>