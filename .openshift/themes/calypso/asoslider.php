<?php
  if ( function_exists( 'ot_get_option'))	{
    $amazontrackid 	= ot_get_option( 'amazontrackid');
	$localetrackid 	= ot_get_option( 'localetrackid');
	$solocale 		= ot_get_option( 'solocale');
    echo $soposition 	= ot_get_option( 'soposition'); 
    $sotrigger 		= ot_get_option( 'sotrigger');
    $sotimer 		= ot_get_option( 'sotimer'); 
	$soopacity 		= ot_get_option( 'soopacity');
	
	if ($solocale=="amazon.com")	{$tabimage = "EN";}
	if ($solocale=="amazon.co.uk")	{$tabimage = "EN";}
	if ($solocale=="amazon.de")	{$tabimage = "DE";}
	if ($solocale=="amazon.it")	{$tabimage = "IT";}
	if ($solocale=="amazon.fr")	{$tabimage = "FR";}
	if ($solocale=="amazon.es")	{$tabimage = "ES";}
	
	if ($soposition=="top" || $soposition=="bottom")	{$tabimg = "TopBottom";}
	elseif ($soposition=="left" || $soposition=="right")	{$tabimg = "LeftRight";}
}
?>
<script type="text/javascript">
	jQuery(function(){
		jQuery('.asoslide-out-div').tabSlideOut({
			tabHandle: '.handle',                       //class of the element that will be your tab
			pathToTabImage: '<?php bloginfo('template_url'); ?>/img/BestDeals-<?php echo $tabimg; ?>-<?php echo $tabimage; ?>.png',
			imageHeight: '45px',
			imageWidth: '160px',
			tabLocation: '<?php echo $soposition; ?>',	//side of screen where tab lives, top, right, bottom, or left                           
			speed: 300,                                 //speed of animation
			slideTimer:<?php echo $sotimer;?>000,	
			action: '<?php echo $sotrigger; ?>',		//options: 'click' or 'hover', action to trigger animation
			topPos: '200px',                            //position from the top
			fixedPosition: true,                        //options: true makes it stick(fixed position) on scroll
			onLoadSlideOut: true
		});
	});
	function formSubmit() {
		document.getElementById("addtocart").submit();
	}
</script>

<div class="asoslide-out-div" style="opacity:<?php echo $soopacity; ?>">
	<span class="handle">Your Browser doesn't understand javascript.</span>
	<div class="asoImgHolder"> <!-- 145px x 145px -->
	<?php
$xml = simplexml_load_file('http://rssfeeds.s3.amazonaws.com/goldbox',"SimpleXMLElement",LIBXML_NOCDATA);
$goldtitle 	= str_replace('Deal of the Day: ','',$xml->channel->item->title);
$goldurl	= str_replace('rssfeeds-20','',$xml->channel->item->link);
$link = str_replace('rssfeeds-20', $amazontrackid, $xml->channel->item->link);
$pertama = explode('/dp/', $xml->channel->item->link);
$asin = explode('/ref', $pertama[1]);
$desc = str_replace('rssfeeds-20', $amazontrackid, str_replace('<table><tr><td>', '', $xml->channel->item->description));
$pieces = explode('</a>', $desc);
$imgurl = strrev(strstr(strrev(strstr(strstr($xml->channel->item->description,'<img src'),'http')),'gpj.'));
$expiredate = str_replace('Expires',' ',(str_replace('</td>','',strrev(strstr(strrev(strstr($xml->channel->item->description,'Expires')),'>dt/<')))));
?>
	<a href="<?php echo $link; ?>" target="_blank"><img title="<?php echo $goldtitle; ?>" src="<?php echo $imgurl; ?>" alt="" width="145px" /></a>
	</div>
	<div class="asoDealOfTheDay">
		<h3>Deal's Of The Day:</h3>
			<div class="asoProductTitle">
				<a href=<?php echo $link; ?>" target="_blank"><?php echo $goldtitle; ?></a><br/><br/>
			</div>
			
			<div class="asoProductDiscount"><label class="asoProductDiscount">(Expires <?php echo $expiredate; ?>)</label></div>
			
			<form method="GET" id="addtocart" action="http://www.amazon.com/gp/aws/cart/add.html" target="_blank">
				<input name="AssociateTag" value="<?php echo $amazontrackid; ?>" type="hidden">
				<input type="hidden" name="SubscriptionId" value="0EMJ6TWAXGX6JF1NP202"> 
				<input name="ASIN.1" value="<?php echo $asin; ?>" type="hidden">
				<input name="Quantity.1" value="1" type="hidden">
				
				
					<div class="asoDealBtn" name="add" onclick="formSubmit()">
						<div class="Left"><img src="<?php bloginfo('template_url'); ?>/img/Add-To-Cart-Button-Left.png" /></div>
						<div class="Center">Add to Cart</div>
						<div class="Right"><img src="<?php bloginfo('template_url'); ?>/img/Add-To-Cart-Button-Right.png" /></div>
					</div>

			</form>
				</div>
	
	<div class="asoSeparator">
		<img src="<?php bloginfo('template_url'); ?>/img/separator.gif" />
	</div>
	
	<div class="asoSearchDiscount">
		<h3>Discount Search:</h3>
		<form class="form" method="get" target="_blank" action="http://<?php echo $solocale; ?>/exec/obidos/external-search">
		
			<div class="asoInputDiv">
				<input class="asoinput" type="text" name="keyword" onblur="if (this.value == '') {this.value = 'Keyword';}" onfocus="if (this.value == 'Keyword') {this.value = '';}" />
			</div>
			
			<div class="asoDepartmentDiv">
				<select name="mode" class="asoselectDept">
					<option value="blended">All Products</option>
					<option value="baby">Baby Products</option>
					<option value="outlet">Bargain Outlet</option>
					<option value="books">Books & Audio Books</option>
					<option value="photo">Cameras & Photo</option>
					<option value="wireless-phones">Cell Phones</option>
					<option value="classical-music">Classical Music</option>
					<option value="pc-hardware">Computers & Add-On</option>
					<option value="electronics">Consumer Electronics</option>
					<option value="dvd">DVD</option>
					<option value="furniture">Furniture</option>
					<option value="kitchen">Kitchen Products</option>
					<option value="garden">Lawn - Garden - Patio</option>
					<option value="magazines">Magazines</option>
					<option value="office-products">Office Products</option>
					<option value="music">Popular Music</option>
					<option value="software">Software</option>
					<option value="universal">Tools & Hardware</option>
					<option value="toys">Toys & Games</option>
					<option value="travel">Travel Accessories</option>
					<option value="vhs">VHS Videos</option>
					<option value="videogames">Video Games</option>
				</select>
			</div>
			
			<input TYPE="hidden" NAME="tag" VALUE="<?php echo $localetrackid; ?>">
			
			<div class="asoDiscountDiv">
				<select name="field-pct-off" class="asoselectDisc">
					<option value="">- Discount -</option>
					<option value="1-49">1% - 49%</option>
					<option value="25-99">25% - 99%</option>
					<option value="50-99">50% - 99%</option>
					<option value="75-99">75% - 99%</option>
				</select>
			</div>
			<input type="submit" value="Search" class="asobutton" />
		</form>
	</div>