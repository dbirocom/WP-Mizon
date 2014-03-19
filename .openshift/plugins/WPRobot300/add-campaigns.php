<div class="wrap">
<h2><?php if( $_GET['edit'] ) {_e("Edit Campaign","wprobot");} else { _e("Add New Campaign","wprobot");} ?></h2>
<style type="text/css">
.addt {padding:5px;margin-bottom:10px;background:#F5F5F5;border:1px dotted #F0F0F0;}
.addt:hover {background:#F2F2F2;border:1px dotted #d9d9d9;}
div.expld {padding:5px;margin-bottom:10px;background:#fffff0;border:1px dotted #e5dd83;}
div.expld:hover {background:#ffffe5;border:1px dotted #e5db6c;} 
<?php if($options['wpr_help'] == "Yes") {?>
a.tooltip {background:#ffffff;font-weight:bold;text-decoration:none;padding:2px 6px;}
a.tooltip:hover {background:#ffffff; text-decoration:none;} /*BG color is a must for IE6*/
a.tooltip span {display:none;font-weight:normal; padding:2px 3px; margin-left:8px; width:230px;}
a.tooltip:hover span{display:inline; position:absolute; background:#ffffff; border:1px solid #cccccc; color:#6c6c6c;}
<?php } else {?>
a.tooltip {display:none;}
<?php } ?>
</style>

<form method="post" id="wpr_new">

	<?php if( $_GET['edit'] ) { ?>
		<input name="edit" type="hidden" value="<?php echo $_GET['edit']; ?>"/>
	<?php } ?>

	<div style="width:25%;float:right;";>
		<div class="expld">
			<strong><?php _e("Quick Template Setup","wprobot") ?></strong><br/>
			<?php _e("Add all Post template presets as templates:","wprobot") ?><br/>
			<input class="button" type="submit" name="quick" value="<?php _e("Quick Template Setup","wprobot") ?>" /><br/>
			<?php _e("Add 3-6 random Post template presets:","wprobot") ?><br/>
			<input class="button" type="submit" name="quickrand" value="<?php _e("Random Template Setup","wprobot") ?>" /><br/>
		</div>

		<div class="expld">
			<strong><?php _e("Exact Match","wprobot") ?></strong><br/>
			<?php _e('Use "keyword" in the Keyword field to enable exact match for a keyword.',"wprobot") ?>
			<input class="button" type="submit" name="exact" value="<?php _e("Convert all keywords to exact","wprobot") ?>" />
		</div>		
		
		<div class="expld">	
			<strong><?php _e("Content Template Tags","wprobot") ?></strong><br/>	
			<?php foreach($loadedmodules as $loadedmodule) {if($loadedmodule != "translation"){echo "{".$loadedmodule."}<br/>";}} ?>
			<br/>{keyword}<br/>{catlink}<br/><a href="http://wprobot.net/documentation/#631"><?php _e("Random Tags","wprobot") ?></a><br/><a href="http://wprobot.net/documentation/#63"><b>See Documentation</b></a>
		</div>		

		<div class="expld">	
			<strong><?php _e("Title Template Tags","wprobot") ?></strong><br/>{title}<br/>	
			<?php foreach($loadedmodules as $loadedmodule) {if($loadedmodule != "translation"){echo "{".$loadedmodule."title}<br/>";}} ?>
			<br/>{keyword}<br/><a href="http://wprobot.net/documentation/#631"><?php _e("Random Tags","wprobot") ?></a><br/><a href="http://wprobot.net/documentation/#63"><b>See Documentation</b></a>
		</div>		
		
	</div>
	<div style="width:70%;">
	
	<input type="hidden" name="type" value="<?php echo $_POST['type']; ?>" />
	<?php if(function_exists("wpr_rsspost") || function_exists("wpr_amazonpost")) { ?>
	Campaign Type: 	
	<input class="<?php if($_POST['type'] == "keyword") {echo "button-primary";} else {echo "button";} ?>" type="submit" name="type1" value="<?php _e("Keyword Campaign","wprobot") ?>" />
	<?php if(function_exists("wpr_rsspost")) { ?><input class="<?php if($_POST['type'] == "rss") {echo "button-primary";} else {echo "button";} ?>" type="submit" name="type2" value="<?php _e("RSS Campaign","wprobot") ?>" /><?php } ?>
	<?php if(function_exists("wpr_amazonpost")) { ?><input class="<?php if($_POST['type'] == "nodes") {echo "button-primary";} else {echo "button";} ?>" type="submit" name="type3" value="<?php _e("BrowseNode Campaign","wprobot") ?>" /><?php } ?>
	<!--Tooltip--><a class="tooltip" href="#">?<span><?php _e('A <b>Keyword Campaign</b> searches for and posts content related to the keywords you enter.<br/><br/>A <b>RSS Campaign</b> posts content from RSS feeds. Keywords can be used optionally to use other modules and filter the RSS feeds.<br/><br/>A <b>BrowseNode Campaign</b> posts content found in the Amazon BrowseNodes you specify. Keywords can be used optionally for other modules.<br/><br/>The blue button marks the campaign type currently selected.',"wprobot") ?></span></a>
	<?php } ?>	
	
	<p><?php _e("Name your campaign:","wprobot") ?> <input name="name" type="text" value="<?php echo $_POST['name'];?>"/><!--Tooltip--><a class="tooltip" href="#">?<span><?php _e('The name is only used to organize your campaigns. It does not affect posting.',"wprobot") ?></span></a></p>
		
	<h3 style="text-transform:uppercase;border-bottom: 1px solid #ccc;"><?php _e("Main Settings","wprobot") ?></h3>

	<table class="addt" width="100%">
		<?php if($_POST['type'] == "rss") { ?>
		<tr>
			<td colspan="2">
				<b><?php _e("RSS Feeds","wprobot") ?></b> <?php _e("(one per line)","wprobot") ?>
				<!--Tooltip--><a class="tooltip" href="#">?<span><?php _e('Enter one RSS Feed URL per line. The feeds correspond to the keyword and category on the same line, i.e. the RSS Feed on line 2 belongs to the keyword and category on line 2 in the respective fields.<br/><br/><b>Keywords are optional!</b> They can be used to also post content from other modules in this RSS Campaign and/or filter the content of the RSS feeds.',"wprobot") ?></span></a><br/>
				<textarea name="feeds" rows="5" cols="75"><?php echo $_POST['feeds'];?></textarea>				
			</td>
		</tr>
		<?php } elseif($_POST['type'] == "nodes") { ?>
		<tr>
			<td width="50%">
				<b><?php _e("Amazon BrowseNodes","wprobot") ?></b> <?php _e("(one per line)","wprobot") ?>
				<!--Tooltip--><a class="tooltip" href="#">?<span><?php _e('Enter one Amazon BrowseNode per line. The BrowseNode corresponds to the keyword and category on the same line, i.e. the BrowseNode on line 2 belongs to the keyword and category on line 2 in the respective fields.<br/><br/><b>Keywords are optional!</b> They can be used to also post content from other modules in this BrowseNode Campaign.',"wprobot") ?></span></a><br/>
				<textarea name="nodes" rows="5" cols="33"><?php echo $_POST['nodes'];?></textarea>				
			</td>
			<td>
			<?php _e('- BrowseNodes are used by Amazon to categorize all their products.<br/>
			- <strong>Important:</strong> You have to specify the correct Amazon Department the BrowseNodes belong to!<br/>
			- Find BrowseNodes on <a target="_blank" href="http://browsenodes.com">browsenodes.com</a>.',"wprobot") ?>
			</td>
		</tr>		
		<?php } ?>		
		<tr>
			<td width="50%">
				<b><?php _e("Keywords","wprobot") ?></b> <?php _e("(one per line)","wprobot") ?>
				<!--Tooltip--><a class="tooltip" href="#">?<span><?php _e('Enter one keyword or phrase per line. For each post one of the keywords will be randomly selected.<br/><br/>You can enclose keywords in double quotes to enable exact search for them.<br/><br/><b>Example</b><br/>Banana<br/>"Wordpress Plugins"<br/>Free Apple Ipods',"wprobot") ?></span></a>
				<br/>
				<textarea name="keywords" rows="5" cols="33"><?php echo stripslashes($_POST['keywords']);?></textarea>
			</td>
			<td>
				<input size="5" name="multisingle" type="hidden" value="<?php echo $_POST['multisingle']; ?>"/>
				<?php if($_POST['multisingle'] == "multi") {$txt = "Single";} else {$txt = "Multi";} ?>
				<b><?php _e("Categories","wprobot") ?></b> <?php _e("(one per line)","wprobot") ?> <input class="button" type="submit" name="catbut" value="<?php echo $txt; ?>" />
				<!--Tooltip--><a class="tooltip" href="#">?<span><?php _e('Enter one category per line. Each category will corespond to the keyword on the same line, i.e. the keyword on line 2 will be posted to the category on line 2.<br/><br/>You can also enter a single category instead. Then all posts will be made in this category.<br/><br/><b>Example</b><br/>Banana Category<br/>Wordpress Plugins<br/>Free Apple Ipods',"wprobot") ?></span></a>
				<br/>
				<?php if($_POST['multisingle'] == "multi") {?>
				<textarea name="categories" rows="5" cols="33"><?php echo stripslashes($_POST['categories']);?></textarea>
				<?php } else {
					echo '<select name="categories">';		
				   	$categories = get_categories('type=post&hide_empty=0');
				   	foreach($categories as $category) {
				   		echo '<option value="'.$category->cat_ID.'">'.$category->cat_name.'</option>';
				   	}
					echo '</select>';		
					}	
				?>
			</td>
		</tr>
		<tr>
			<td>
				<input name="autopost" type="checkbox" value="yes" <?php if ($_POST['autopost'] =='yes') {echo "checked";} ?>/> <?php _e("Post every","wprobot") ?> <input size="5" name="interval" type="text" value="<?php echo $_POST['interval'];?>"/>
					<select name="period">
						<option value="hours"><?php _e("Hours","wprobot") ?></option>
						<option value="days"><?php _e("Days","wprobot") ?></option>
					</select>	
				<!--Tooltip--><a class="tooltip" href="#">?<span><?php _e('If enabled Wordpress internal cron functions will be used to run this campaign in the interval you specify.<br/><br/>Alternatively you can disable the option and then set up a unix cron-job to autopost this campaign after creating it.',"wprobot") ?></span></a>		
			</td>
			<td>
				<input name="createcats" type="checkbox" value="yes" <?php if ($_POST['createcats'] =='yes') {echo "checked";} ?>/> <?php _e("Create categories if not existing","wprobot") ?>
			</td>
		</tr>		
	</table>
	
	<h3 style="text-transform:uppercase;border-bottom: 1px solid #ccc;"><?php _e("Templates","wprobot") ?></h3>	


		<?php if(!$_POST['tnum']) {$_POST['tnum'] = 1;} ?>
		<input size="5" name="tnum" type="hidden" value="<?php echo $_POST['tnum']; ?>"/>
		
		<?php for ($i = 1; $i <= $_POST['tnum']; $i++) { ?>
	<table class="addt" width="100%">		
		<tr valign="top">
			<td width="50%">
				<strong style="font-size:120%;border-bottom:1px dotted #ccc;"><?php _e("Post Template","wprobot") ?> <?php echo $i; ?></strong><br/>
				<?php _e("Chance of being used:","wprobot") ?> <input size="5" name="chance<?php echo $i; ?>" type="text" value="<?php echo $_POST["chance$i"];?>"/> %	<!--Tooltip--><a class="tooltip" href="#">?<span><?php _e('For each post one of the templates you have added to this campaign will be selected and used randomly. This setting decides how likely it is that this particular template gets selected. <b>The chance fields for all templates have to sum up to 100% in total!</b>',"wprobot") ?></span></a>				
			</td>
			<td>
				<strong><?php _e("Post Title","wprobot") ?></strong>
				<!--Tooltip--><a class="tooltip" href="#">?<span><?php _e('This is the template field for the title of posts.<br/><br/>- Template tags in curly braces, i.e. {amazontitle}, will be replaced with the title returned by the respective module. See the list to the right for all available template tags.<br/><br/>- You can use template tags several times but beware that Wordpress has a length limit of 255 characters on titles. Longer titles will get cut.<br/><br/>- You can also enter any other text you want to display in your titles.',"wprobot") ?></span></a><br/>
				<textarea name="title<?php echo $i; ?>" rows="2" cols="33"><?php echo stripslashes($_POST["title$i"]);?></textarea>
			</td>
		</tr>	
		<tr>
			<td>
			</td>
			<td rowspan="3">
				<strong><?php _e("Post Content","wprobot") ?></strong>
				<!--Tooltip--><a class="tooltip" href="#">?<span><?php _e('This is the template field for the body of posts.<br/><br/>- Template tags in curly braces, i.e. {amazon}, will be replaced with the content returned by the respective module. See the list to the right for all available template tags.<br/><br/>- You can use template tags several times to add more items to the posts, i.e. 2 Amazon products.<br/><br/>- You can also enter any other text or HTML code you want to display in your posts.',"wprobot") ?></span></a><br/>
				<textarea name="content<?php echo $i; ?>" rows="5" cols="33"><?php echo stripslashes($_POST["content$i"]);?></textarea>
			</td>
		</tr>
		<tr>
			<td>
	
			</td>
		</tr>
		<tr>
			<td>
			</td>
		</tr>	
		<tr>	
			<td valign="top">
				<div style="padding:5px;margin-right: 10px;border:1px dotted #ccc;">
					<!--<?php _e("Current Preset:","wprobot") ?> <?php echo $_POST["p$i"]; ?><br/>-->
					<?php _e("Load Preset:","wprobot") ?>
					<!--Tooltip--><a class="tooltip" href="#">?<span><?php _e('Loads a different Page Template Preset for this template. You can set up and change your presets on the "Templates" page of WP Robot.<br/><br/>Use the "Remove Template" button to remove this template from this campaign.',"wprobot") ?></span></a><br/>
					<select name="p<?php echo $i; ?>">
						<?php 
							foreach($presets as $num => $preset) {
								if($num == $_POST["p$i"]) {$selected = " selected";} else {$selected = "";}
								echo '<option'.$selected.'>'.$num.'</option>';
							}						
						?>
					</select>
					<input class="button" type="submit" name="load<?php echo $i; ?>" value="<?php _e("Load","wprobot") ?>" />
					<input class="button" type="submit" name="delete<?php echo $i; ?>" value="<?php _e("Remove Template","wprobot") ?>" />
				</div>	
			</td>
			<td>
			<strong><?php _e("Post Comments","wprobot") ?></strong>
			<!--Tooltip--><a class="tooltip" href="#">?<span><?php _e('Choose the content you want to add to posts made with this template as comments.<br/><br/><b>Important:</b>You can only add comments for modules that are also present in your templates content, i.e. Amazon reviews can only be added if at least one {amazon} tag exists in the "Post Content" field of this template.',"wprobot") ?></span></a><br/>
			<input type="checkbox" name="comments_amazon<?php echo $i; ?>" value="1" <?php if($_POST["comments_amazon$i"]) {echo "checked";} ?>/> <?php _e("Amazon reviews","wprobot") ?><br/>
			<input type="checkbox" name="comments_flickr<?php echo $i; ?>" value="1" <?php if($_POST["comments_flickr$i"]) {echo "checked";} ?>/> <?php _e("Flickr comments","wprobot") ?><br/>
			<input type="checkbox" name="comments_yahoo<?php echo $i; ?>" value="1" <?php if($_POST["comments_yahoo$i"]) {echo "checked";} ?>/> <?php _e("Yahoo Answers answers","wprobot") ?><br/>
			<input type="checkbox" name="comments_youtube<?php echo $i; ?>" value="1" <?php if($_POST["comments_youtube$i"]) {echo "checked";} ?>/> <?php _e("Youtube comments","wprobot") ?>
			</td>			
		</tr>
	</table>			
		<?php } ?>
		
	<div class="addt">
	<p class="submit" style="margin:0;padding: 10px 0;">
	<input class="button" type="submit" name="wpr_add_template" value="<?php _e("Add another Template","wprobot") ?>" />
	with Preset:
				<select name="wpr_add_template_preset">
					<option>Random</option>
					<?php 
						foreach($presets as $num => $preset) {
							echo '<option>'.$num.'</option>';
						}						
					?>
				</select>	
	<!--Tooltip--><a class="tooltip" href="#">?<span><?php _e('Adds an additional template that can be used for this campaign. For each post one of the templates will be randomly selected.<br/><br/>You can also use the quick setup buttons on the right to add a large amount of random templates fast.',"wprobot") ?></span></a>
	</p></div>
	
	<h3 style="text-transform:uppercase;border-bottom: 1px solid #ccc;"><?php _e("Optional Settings","wprobot") ?></h3>	
	
	<table class="addt" width="100%">
		<tr>
			<td width="50%">
				<strong><?php _e("Replace Keywords","wprobot") ?></strong> <?php _e("(one per line)","wprobot") ?>
				<!--Tooltip--><a class="tooltip" href="#">?<span><?php _e('Use this option to replace certain keywords in this campaigns posts with other keywords or links.<br/><br/><b>Syntax</b><br/>Keyword|Replace With|Chance<br/><br/><b>Example</b><br/>Wordpress|Joomla|50<br/>Free Apple Ipods|Expensive Apple Ipods|100<br/>Wordpress Plugins|< a href=link>Link text< /a>|25',"wprobot") ?></span></a><br/>
				<textarea name="replace" rows="3" cols="33"><?php echo stripslashes($_POST['replace']);?></textarea>
			</td>	
			<td>
				<strong><?php _e("Exclude Keywords","wprobot") ?></strong> <?php _e("(one per line)","wprobot") ?>
				<!--Tooltip--><a class="tooltip" href="#">?<span><?php _e('If any one of the keywords you enter here is found in a post it will be skipped and not created. Because of that make sure not to enter common words or phrases here.<br/><br/><b>Example</b><br/>exclude keyword 1<br/>keyword 2',"wprobot") ?></span></a><br/>
				<textarea name="exclude" rows="3" cols="33"><?php echo stripslashes($_POST['exclude']);?></textarea>
			</td>			
		</tr>
		<?php if(function_exists("wpr_amazonpost") || function_exists("wpr_ebaypost")) { ?>
		<tr>
			<td width="50%">
				<?php if(function_exists("wpr_amazonpost")) { ?>
				<strong><?php _e("Amazon Department","wprobot") ?></strong><br/>
				<?php $ll = $options["wpr_aa_site"];?>
				<select name="amazon_department">
					<option <?php if($_POST['amazon_department'] == "All") {echo "selected";}?>>All</option>
					<?php if($ll!="fr" || $ll!="ca") {?><option <?php if($_POST['amazon_department'] == "Apparel") {echo "selected";}?>>Apparel</option><?php } ?>
					<?php if($ll=="com" || $ll=="de") {?><option <?php if($_POST['amazon_department'] == "Automotive") {echo "selected";}?>>Automotive</option><?php } ?>
					<?php if($ll!="ca") {?><option <?php if($_POST['amazon_department'] == "Baby") {echo "selected";}?>>Baby</option><?php } ?>
					<?php if($ll!="uk" || $ll!="de") {?><option <?php if($_POST['amazon_department'] == "Beauty") {echo "selected";}?>>Beauty</option><?php } ?>
					<option <?php if($_POST['amazon_department'] == "Books") {echo "selected";}?>>Books</option>
					<option <?php if($_POST['amazon_department'] == "Classical") {echo "selected";}?>>Classical</option>
					<?php if($ll=="com") {?><option value="DigitalMusic" <?php if($_POST['amazon_department'] == "DigitalMusic") {echo "selected";}?>>Digital Music</option><?php } ?>
					<?php if($ll!="jp" || $ll!="ca") {?><option value="MP3Downloads" <?php if($_POST['amazon_department'] == "MP3Downloads") {echo "selected";}?>>MP3 Downloads</option><?php } ?>
					<option <?php if($_POST['amazon_department'] == "DVD") {echo "selected";}?>>DVD</option>
					<option <?php if($_POST['amazon_department'] == "Electronics") {echo "selected";}?>>Electronics</option>
					<?php if($ll!="com" || $ll!="uk") {?><option value="ForeignBooks" <?php if($_POST['amazon_department'] == "ForeignBooks") {echo "selected";}?>>Foreign Books</option><?php } ?>
					<?php if($ll=="com") {?><option value="GourmetFood" <?php if($_POST['amazon_department'] == "GourmetFood") {echo "selected";}?>>Gourmet Food</option><?php } ?>
					<?php if($ll=="com") {?><option value="Grocery" <?php if($_POST['amazon_department'] == "Grocery") {echo "selected";}?>>Grocery</option><?php } ?>
					<?php if($ll!="ca") {?><option value="HealthPersonalCare" <?php if($_POST['amazon_department'] == "HealthPersonalCare") {echo "selected";}?>>Health &amp; Personal Care</option><?php } ?>
					<?php if($ll!="fr" || $ll!="ca") {?><option value="HomeGarden" <?php if($_POST['amazon_department'] == "HomeGarden") {echo "selected";}?>>Home &amp; Garden</option><?php } ?>
					<?php if($ll=="com") {?><option <?php if($_POST['amazon_department'] == "Industrial") {echo "selected";}?>>Industrial</option><?php } ?>
					<?php if($ll!="ca") {?><option <?php if($_POST['amazon_department'] == "Jewelry") {echo "selected";}?>>Jewelry</option><?php } ?>
					<?php if($ll=="com") {?><option value="KindleStore" <?php if($_POST['amazon_department'] == "KindleStore") {echo "selected";}?>>Kindle Store</option><?php } ?>
					<?php if($ll!="ca") {?><option <?php if($_POST['amazon_department'] == "Kitchen") {echo "selected";}?>>Kitchen</option><?php } ?>
					<?php if($ll=="com" || $ll=="de") {?><option <?php if($_POST['amazon_department'] == "Magazines") {echo "selected";}?>>Magazines</option><?php } ?>
					<?php if($ll=="com") {?><option <?php if($_POST['amazon_department'] == "Merchants") {echo "selected";}?>>Merchants</option><?php } ?>
					<?php if($ll=="com") {?><option <?php if($_POST['amazon_department'] == "Miscellaneous") {echo "selected";}?>>Miscellaneous</option><?php } ?>
					<option <?php if($_POST['amazon_department'] == "Music") {echo "selected";}?>>Music</option>
					<?php if($ll=="com") {?><option value="MusicalInstruments" <?php if($_POST['amazon_department'] == "MusicalInstruments") {echo "selected";}?>>Musical Instruments</option><?php } ?>
					<?php if($ll!="ca") {?><option value="MusicTracks" <?php if($_POST['amazon_department'] == "MusicTracks") {echo "selected";}?>>Music Tracks</option><?php } ?>
					<?php if($ll!="jp" || $ll!="ca") {?><option value="OfficeProducts" <?php if($_POST['amazon_department'] == "OfficeProducts") {echo "selected";}?>>Office Products</option><?php } ?>
					<?php if($ll!="fr" || $ll!="ca") {?><option value="OutdoorLiving" <?php if($_POST['amazon_department'] == "OutdoorLiving") {echo "selected";}?>>Outdoor &amp; Living</option><?php } ?>
					<?php if($ll=="com" || $ll=="de") {?><option value="PCHardware" <?php if($_POST['amazon_department'] == "PCHardware") {echo "selected";}?>>PC Hardware</option><?php } ?>
					<?php if($ll=="com") {?><option value="PetSupplies" <?php if($_POST['amazon_department'] == "PetSupplies") {echo "selected";}?>>Pet Supplies</option><?php } ?>
					<?php if($ll=="com" || $ll=="de") {?><option <?php if($_POST['amazon_department'] == "Photo") {echo "selected";}?>>Photo</option><?php } ?>
					<?php if($ll=="com" || $ll=="de") {?><option <?php if($_POST['amazon_department'] == "Shoes") {echo "selected";}?>>Shoes</option><?php } ?>
					<option <?php if($_POST['amazon_department'] == "Software") {echo "selected";}?>>Software</option>
					<?php if($ll!="fr" || $ll!="ca") {?><option value="SportingGoods" <?php if($_POST['amazon_department'] == "SportingGoods") {echo "selected";}?>>Sporting Goods</option><?php } ?>
					<?php if($ll!="fr" || $ll!="ca") {?><option <?php if($_POST['amazon_department'] == "Tools") {echo "selected";}?>>Tools</option><?php } ?>
					<?php if($ll!="ca") {?><option <?php if($_POST['amazon_department'] == "Toys") {echo "selected";}?>>Toys</option><?php } ?>
					<option value="UnboxVideo" <?php if($_POST['amazon_department'] == "UnboxVideo") {echo "selected";}?>>Unbox Video</option>
					<option <?php if($_POST['amazon_department'] == "VHS") {echo "selected";}?>>VHS</option>
					<option <?php if($_POST['amazon_department'] == "Video") {echo "selected";}?>>Video</option>
					<option value="VideoGames" <?php if($_POST['amazon_department'] == "VideoGames") {echo "selected";}?>>Video Games</option>
					<?php if($ll!="jp" || $ll!="ca") {?><option <?php if($_POST['amazon_department'] == "Watches") {echo "selected";}?>>Watches</option><?php } ?>
					<?php if($ll=="com") {?><option <?php if($_POST['amazon_department'] == "Wireless") {echo "selected";}?>>Wireless</option><?php } ?>
					<?php if($ll=="com") {?><option value="WirelessAccessories" <?php if($_POST['amazon_department'] == "WirelessAccessories") {echo "selected";}?>>Wireless Accessories</option><?php } ?>         			
				</select>
				<?php } ?>
			</td>		
			<td>
				<?php if(function_exists("wpr_ebaypost")) { ?>
				<strong><?php _e("eBay Category","wprobot") ?></strong><br/>
				<select name="ebay_category">
					<option <?php if($_POST['ebay_category'] == "all") {echo "selected";}?> value="all">All Categories</option>
					<option <?php if($_POST['ebay_category'] == "20081") {echo "selected";}?> value="20081">Antiques</option>
					<option <?php if($_POST['ebay_category'] == "550") {echo "selected";}?> value="550" >Art</option>
					<option <?php if($_POST['ebay_category'] == "2984") {echo "selected";}?> value="2984">Baby</option>
					<option <?php if($_POST['ebay_category'] == "267") {echo "selected";}?> value="267" >Books</option>
					<option <?php if($_POST['ebay_category'] == "12576") {echo "selected";}?> value="12576">Business &amp; Industrial</option>
					<option <?php if($_POST['ebay_category'] == "625") {echo "selected";}?> value="625" >Cameras &amp; Photo</option>
					<option <?php if($_POST['ebay_category'] == "15032") {echo "selected";}?> value="15032">Cell Phones &amp; PDAs</option>
					<option <?php if($_POST['ebay_category'] == "11450") {echo "selected";}?> value="11450">Clothing, Shoes &amp; Accessories</option>
					<option <?php if($_POST['ebay_category'] == "11116") {echo "selected";}?> value="11116" >Coins &amp; Paper Money</option>
					<option <?php if($_POST['ebay_category'] == "1") {echo "selected";}?> value="1" >Collectibles</option>
					<option <?php if($_POST['ebay_category'] == "58058") {echo "selected";}?> value="58058">Computers &amp; Networking</option>
					<option <?php if($_POST['ebay_category'] == "14339") {echo "selected";}?> value="14339">Crafts</option>
					<option <?php if($_POST['ebay_category'] == "237") {echo "selected";}?> value="237" >Dolls &amp; Bears</option>
					<option <?php if($_POST['ebay_category'] == "11232") {echo "selected";}?> value="11232" >DVDs &amp; Movies</option>
					<option <?php if($_POST['ebay_category'] == "6000") {echo "selected";}?> value="6000" >eBay Motors</option>
					<option <?php if($_POST['ebay_category'] == "293") {echo "selected";}?> value="293" >Electronics</option>
					<option <?php if($_POST['ebay_category'] == "45100") {echo "selected";}?> value="45100" >Entertainment Memorabilia</option>
					<option <?php if($_POST['ebay_category'] == "31411") {echo "selected";}?> value="31411" >Gift Certificates</option>
					<option <?php if($_POST['ebay_category'] == "26395") {echo "selected";}?> value="26395" >Health &amp; Beauty</option>
					<option <?php if($_POST['ebay_category'] == "11700") {echo "selected";}?> value="11700">Home &amp; Garden</option>
					<option <?php if($_POST['ebay_category'] == "281") {echo "selected";}?> value="281" >Jewelry &amp; Watches</option>
					<option <?php if($_POST['ebay_category'] == "11233") {echo "selected";}?> value="11233">Music</option>
					<option <?php if($_POST['ebay_category'] == "619") {echo "selected";}?> value="619" >Musical Instruments</option>
					<option <?php if($_POST['ebay_category'] == "870") {echo "selected";}?> value="870" >Pottery &amp; Glass</option>
					<option <?php if($_POST['ebay_category'] == "10542") {echo "selected";}?> value="10542">Real Estate</option>
					<option <?php if($_POST['ebay_category'] == "316") {echo "selected";}?> value="316" >Specialty Services</option>
					<option <?php if($_POST['ebay_category'] == "382") {echo "selected";}?> value="382" >Sporting Goods</option>
					<option <?php if($_POST['ebay_category'] == "64482") {echo "selected";}?> value="64482">Sports Mem, Cards &amp; Fan Shop</option>
					<option <?php if($_POST['ebay_category'] == "260") {echo "selected";}?> value="260" >Stamps</option>
					<option <?php if($_POST['ebay_category'] == "1305") {echo "selected";}?> value="1305">Tickets</option>
					<option <?php if($_POST['ebay_category'] == "220") {echo "selected";}?> value="220">Toys &amp; Hobbies</option>
					<option <?php if($_POST['ebay_category'] == "3252") {echo "selected";}?> value="3252" >Travel</option>
					<option <?php if($_POST['ebay_category'] == "1249") {echo "selected";}?> value="1249" >Video Games</option>
					<option <?php if($_POST['ebay_category'] == "99") {echo "selected";}?> value="99">Everything Else</option>
				</select>
				<?php } ?>
			</td>
		</tr>
		<?php } ?>
		<!--<tr>
			<td>
				Yahoo Answers Category<br/>
				<select name="yahoo_category">				
					<option value=""> All </option>
					<option value="396545012">Arts &amp; Humanities</option>
					<option value="396545144">Beauty &amp; Style</option>
					<option value="396545013">Business &amp; Finance</option>
					<option value="396545311">Cars &amp; Transportation</option>
					<option value="396545660">Computers &amp; Internet</option>
					<option value="396545014">Consumer Electronics</option>
					<option value="396545327">Dining Out</option>
					<option value="396545015">Education &amp; Reference</option>
					<option value="396545016">Entertainment &amp; Music</option>
					<option value="396545451">Environment</option>
					<option value="396545433">Family &amp; Relationships</option>
					<option value="396545367">Food &amp; Drink</option>
					<option value="396545019">Games &amp; Recreation</option>
					<option value="396545018">Health</option>
					<option value="396545394">Home &amp; Garden</option>
					<option value="396545401">Local Businesses</option>
					<option value="396545439">News &amp; Events</option>
					<option value="396545443">Pets</option>
					<option value="396545444">Politics &amp; Government</option>
					<option value="396546046">Pregnancy &amp; Parenting</option>
					<option value="396545122">Science &amp; Mathematics</option>
					<option value="396545301">Social Science</option>
					<option value="396545454">Society &amp; Culture</option>
					<option value="396545213">Sports</option>
					<option value="396545469">Travel</option>
					<option value="396546089">Yahoo! Products</option>				
				</select>
			</td>
		</tr>-->	
		<tr>
			<td width="100%" colspan="2">
			<b><?php _e("Custom Field","wprobot") ?></b>
			<!--Tooltip--><a class="tooltip" href="#">?<span><?php _e('This custom field will be added to every post. Premium templates often use custom fields to populate thumbnails but there are many other possible uses as well.<br/><br/><b>Available Value Tags</b><br/>{image}<br/>{thumbnail}<br/>{amazonthumbnail}<br/>{youtubethumbnail}<br/>{flickrimage}<br/>(only if the module is used in the template!)',"wprobot") ?></span></a><br/>
			<?php _e("Name:","wprobot") ?> <input name="cf_name" type="text" value="<?php echo $_POST['cf_name'];?>"/> 
			<?php _e("Value:","wprobot") ?> <input name="cf_value" type="text" value="<?php echo $_POST['cf_value'];?>"/>
			</td>
		</tr>
		<?php if(function_exists("wpr_translate")) { ?>
		<tr>
			<td width="100%" colspan="2">
			<b><?php _e("Translation","wprobot") ?></b>
			<!--Tooltip--><a class="tooltip" href="#">?<span><?php _e('Translates a certain percentage of this campaigns posts using Google Translate and the Translation Module.<br/><br/><b>Warning:</b> Google Translate is not perfect and using this feature might produce content containing bad grammar or formatting!',"wprobot") ?></span></a><br/>
			<?php _e("Translate","wprobot") ?> <input size="3" name="transchance" type="text" value="<?php echo $_POST['transchance'];?>"/>% <?php _e("of this campaigns posts from","wprobot") ?> 
				<select name="trans1" >
					<option value="no" <?php if ($_POST['trans1']=='no') {echo 'selected';} ?>>---</option>
					<option value="de" <?php if ($_POST['trans1']=='de') {echo 'selected';} ?>>German</option>
					<option value="en" <?php if ($_POST['trans1']=='en') {echo 'selected';} ?>>English</option>
					<option value="fr" <?php if ($_POST['trans1']=='fr') {echo 'selected';} ?>>French</option>
					<option value="separator" disabled="">&mdash;</option>
					<option value="af" <?php if ($_POST['trans1']=='af') {echo 'selected';} ?>>Afrikaans</option>
					<option value="sq" <?php if ($_POST['trans1']=='sq') {echo 'selected';} ?>>Albanian</option>
					<option value="ar" <?php if ($_POST['trans1']=='ar') {echo 'selected';} ?>>Arabic</option>
					<option value="be" <?php if ($_POST['trans1']=='be') {echo 'selected';} ?>>Belarusian</option>
					<option value="bg" <?php if ($_POST['trans1']=='bg') {echo 'selected';} ?>>Bulgarian</option>
					<option value="ca" <?php if ($_POST['trans1']=='ca') {echo 'selected';} ?>>Catalan</option>
					<option value="zh-CN" <?php if ($_POST['trans1']=='zh-CN') {echo 'selected';} ?>>Chinese</option>
					<option value="hr" <?php if ($_POST['trans1']=='hr') {echo 'selected';} ?>>Croatian</option>
					<option value="cs" <?php if ($_POST['trans1']=='cs') {echo 'selected';} ?>>Czech</option>
					<option value="da" <?php if ($_POST['trans1']=='da') {echo 'selected';} ?>>Danish</option>
					<option value="nl" <?php if ($_POST['trans1']=='nl') {echo 'selected';} ?>>Dutch</option>
					<option value="en" <?php if ($_POST['trans1']=='en') {echo 'selected';} ?>>English</option>
					<option value="et" <?php if ($_POST['trans1']=='et') {echo 'selected';} ?>>Estonian</option>
					<option value="tl" <?php if ($_POST['trans1']=='tl') {echo 'selected';} ?>>Filipino</option>
					<option value="fi" <?php if ($_POST['trans1']=='fi') {echo 'selected';} ?>>Finnish</option>
					<option value="fr" <?php if ($_POST['trans1']=='fr') {echo 'selected';} ?>>French</option>
					<option value="gl" <?php if ($_POST['trans1']=='gl') {echo 'selected';} ?>>Galician</option>
					<option value="de" <?php if ($_POST['trans1']=='de') {echo 'selected';} ?>>German</option>
					<option value="el" <?php if ($_POST['trans1']=='el') {echo 'selected';} ?>>Greek</option>
					<option value="iw" <?php if ($_POST['trans1']=='iw') {echo 'selected';} ?>>Hebrew</option>
					<option value="hi" <?php if ($_POST['trans1']=='hi') {echo 'selected';} ?>>Hindi</option>
					<option value="hu" <?php if ($_POST['trans1']=='hu') {echo 'selected';} ?>>Hungarian</option>
					<option value="is" <?php if ($_POST['trans1']=='is') {echo 'selected';} ?>>Icelandic</option>
					<option value="id" <?php if ($_POST['trans1']=='id') {echo 'selected';} ?>>Indonesian</option>
					<option value="ga" <?php if ($_POST['trans1']=='ga') {echo 'selected';} ?>>Irish</option>
					<option value="it" <?php if ($_POST['trans1']=='it') {echo 'selected';} ?>>Italian</option>
					<option value="ja" <?php if ($_POST['trans1']=='ja') {echo 'selected';} ?>>Japanese</option>
					<option value="ko" <?php if ($_POST['trans1']=='ko') {echo 'selected';} ?>>Korean</option>
					<option value="lv" <?php if ($_POST['trans1']=='lv') {echo 'selected';} ?>>Latvian</option>
					<option value="lt" <?php if ($_POST['trans1']=='lt') {echo 'selected';} ?>>Lithuanian</option>
					<option value="mk" <?php if ($_POST['trans1']=='mk') {echo 'selected';} ?>>Macedonian</option>
					<option value="ms" <?php if ($_POST['trans1']=='ms') {echo 'selected';} ?>>Malay</option>
					<option value="mt" <?php if ($_POST['trans1']=='mt') {echo 'selected';} ?>>Maltese</option>
					<option value="nor" <?php if ($_POST['trans1']=='nor') {echo 'selected';} ?>>Norwegian</option>
					<option value="fa" <?php if ($_POST['trans1']=='fa') {echo 'selected';} ?>>Persian</option>
					<option value="pl" <?php if ($_POST['trans1']=='pl') {echo 'selected';} ?>>Polish</option>
					<option value="pt" <?php if ($_POST['trans1']=='pt') {echo 'selected';} ?>>Portuguese</option>
					<option value="ro" <?php if ($_POST['trans1']=='ro') {echo 'selected';} ?>>Romanian</option>
					<option value="ru" <?php if ($_POST['trans1']=='ru') {echo 'selected';} ?>>Russian</option>
					<option value="sr" <?php if ($_POST['trans1']=='sr') {echo 'selected';} ?>>Serbian</option>
					<option value="sk" <?php if ($_POST['trans1']=='sk') {echo 'selected';} ?>>Slovak</option>
					<option value="sl" <?php if ($_POST['trans1']=='sl') {echo 'selected';} ?>>Slovenian</option>
					<option value="es" <?php if ($_POST['trans1']=='es') {echo 'selected';} ?>>Spanish</option>
					<option value="sw" <?php if ($_POST['trans1']=='sw') {echo 'selected';} ?>>Swahili</option>
					<option value="sv" <?php if ($_POST['trans1']=='sv') {echo 'selected';} ?>>Swedish</option>
					<option value="th" <?php if ($_POST['trans1']=='th') {echo 'selected';} ?>>Thai</option>
					<option value="tr" <?php if ($_POST['trans1']=='tr') {echo 'selected';} ?>>Turkish</option>
					<option value="uk" <?php if ($_POST['trans1']=='uk') {echo 'selected';} ?>>Ukrainian</option>
					<option value="vi" <?php if ($_POST['trans1']=='vi') {echo 'selected';} ?>>Vietnamese</option>
					<option value="cy" <?php if ($_POST['trans1']=='cy') {echo 'selected';} ?>>Welsh</option>
					<option value="yi" <?php if ($_POST['trans1']=='yi') {echo 'selected';} ?>>Yiddish</option>
				</select>			
			<?php _e("to","wprobot") ?> 
				<select name="trans2">
					<option value="no" <?php if ($_POST['trans2']=='no') {echo 'selected';} ?>>---</option>
					<option value="de" <?php if ($_POST['trans2']=='de') {echo 'selected';} ?>>German</option>
					<option value="en" <?php if ($_POST['trans2']=='en') {echo 'selected';} ?>>English</option>
					<option value="fr" <?php if ($_POST['trans2']=='fr') {echo 'selected';} ?>>French</option>
					<option value="separator" disabled="">&mdash;</option>
					<option value="af" <?php if ($_POST['trans2']=='af') {echo 'selected';} ?>>Afrikaans</option>
					<option value="sq" <?php if ($_POST['trans2']=='sq') {echo 'selected';} ?>>Albanian</option>
					<option value="ar" <?php if ($_POST['trans2']=='ar') {echo 'selected';} ?>>Arabic</option>
					<option value="be" <?php if ($_POST['trans2']=='be') {echo 'selected';} ?>>Belarusian</option>
					<option value="bg" <?php if ($_POST['trans2']=='bg') {echo 'selected';} ?>>Bulgarian</option>
					<option value="ca" <?php if ($_POST['trans2']=='ca') {echo 'selected';} ?>>Catalan</option>
					<option value="zh-CN" <?php if ($_POST['trans2']=='zh-CN') {echo 'selected';} ?>>Chinese</option>
					<option value="hr" <?php if ($_POST['trans2']=='hr') {echo 'selected';} ?>>Croatian</option>
					<option value="cs" <?php if ($_POST['trans2']=='cs') {echo 'selected';} ?>>Czech</option>
					<option value="da" <?php if ($_POST['trans2']=='da') {echo 'selected';} ?>>Danish</option>
					<option value="nl" <?php if ($_POST['trans2']=='nl') {echo 'selected';} ?>>Dutch</option>
					<option value="en" <?php if ($_POST['trans2']=='en') {echo 'selected';} ?>>English</option>
					<option value="et" <?php if ($_POST['trans2']=='et') {echo 'selected';} ?>>Estonian</option>
					<option value="tl" <?php if ($_POST['trans2']=='tl') {echo 'selected';} ?>>Filipino</option>
					<option value="fi" <?php if ($_POST['trans2']=='fi') {echo 'selected';} ?>>Finnish</option>
					<option value="fr" <?php if ($_POST['trans2']=='fr') {echo 'selected';} ?>>French</option>
					<option value="gl" <?php if ($_POST['trans2']=='gl') {echo 'selected';} ?>>Galician</option>
					<option value="de" <?php if ($_POST['trans2']=='de') {echo 'selected';} ?>>German</option>
					<option value="el" <?php if ($_POST['trans2']=='el') {echo 'selected';} ?>>Greek</option>
					<option value="iw" <?php if ($_POST['trans2']=='iw') {echo 'selected';} ?>>Hebrew</option>
					<option value="hi" <?php if ($_POST['trans2']=='hi') {echo 'selected';} ?>>Hindi</option>
					<option value="hu" <?php if ($_POST['trans2']=='hu') {echo 'selected';} ?>>Hungarian</option>
					<option value="is" <?php if ($_POST['trans2']=='is') {echo 'selected';} ?>>Icelandic</option>
					<option value="id" <?php if ($_POST['trans2']=='id') {echo 'selected';} ?>>Indonesian</option>
					<option value="ga" <?php if ($_POST['trans2']=='ga') {echo 'selected';} ?>>Irish</option>
					<option value="it" <?php if ($_POST['trans2']=='it') {echo 'selected';} ?>>Italian</option>
					<option value="ja" <?php if ($_POST['trans2']=='ja') {echo 'selected';} ?>>Japanese</option>
					<option value="ko" <?php if ($_POST['trans2']=='ko') {echo 'selected';} ?>>Korean</option>
					<option value="lv" <?php if ($_POST['trans2']=='lv') {echo 'selected';} ?>>Latvian</option>
					<option value="lt" <?php if ($_POST['trans2']=='lt') {echo 'selected';} ?>>Lithuanian</option>
					<option value="mk" <?php if ($_POST['trans2']=='mk') {echo 'selected';} ?>>Macedonian</option>
					<option value="ms" <?php if ($_POST['trans2']=='ms') {echo 'selected';} ?>>Malay</option>
					<option value="mt" <?php if ($_POST['trans2']=='mt') {echo 'selected';} ?>>Maltese</option>
					<option value="nor" <?php if ($_POST['trans2']=='nor') {echo 'selected';} ?>>Norwegian</option>
					<option value="fa" <?php if ($_POST['trans2']=='fa') {echo 'selected';} ?>>Persian</option>
					<option value="pl" <?php if ($_POST['trans2']=='pl') {echo 'selected';} ?>>Polish</option>
					<option value="pt" <?php if ($_POST['trans2']=='pt') {echo 'selected';} ?>>Portuguese</option>
					<option value="ro" <?php if ($_POST['trans2']=='ro') {echo 'selected';} ?>>Romanian</option>
					<option value="ru" <?php if ($_POST['trans2']=='ru') {echo 'selected';} ?>>Russian</option>
					<option value="sr" <?php if ($_POST['trans2']=='sr') {echo 'selected';} ?>>Serbian</option>
					<option value="sk" <?php if ($_POST['trans2']=='sk') {echo 'selected';} ?>>Slovak</option>
					<option value="sl" <?php if ($_POST['trans2']=='sl') {echo 'selected';} ?>>Slovenian</option>
					<option value="es" <?php if ($_POST['trans2']=='es') {echo 'selected';} ?>>Spanish</option>
					<option value="sw" <?php if ($_POST['trans2']=='sw') {echo 'selected';} ?>>Swahili</option>
					<option value="sv" <?php if ($_POST['trans2']=='sv') {echo 'selected';} ?>>Swedish</option>
					<option value="th" <?php if ($_POST['trans2']=='th') {echo 'selected';} ?>>Thai</option>
					<option value="tr" <?php if ($_POST['trans2']=='tr') {echo 'selected';} ?>>Turkish</option>
					<option value="uk" <?php if ($_POST['trans2']=='uk') {echo 'selected';} ?>>Ukrainian</option>
					<option value="vi" <?php if ($_POST['trans2']=='vi') {echo 'selected';} ?>>Vietnamese</option>
					<option value="cy" <?php if ($_POST['trans2']=='cy') {echo 'selected';} ?>>Welsh</option>
					<option value="yi" <?php if ($_POST['trans2']=='yi') {echo 'selected';} ?>>Yiddish</option>
				</select>			
			<?php _e("to","wprobot") ?> 
				<select name="trans3">
					<option value="no" <?php if ($_POST['trans3']=='no') {echo 'selected';} ?>>---</option>
					<option value="de" <?php if ($_POST['trans3']=='de') {echo 'selected';} ?>>German</option>
					<option value="en" <?php if ($_POST['trans3']=='en') {echo 'selected';} ?>>English</option>
					<option value="fr" <?php if ($_POST['trans3']=='fr') {echo 'selected';} ?>>French</option>
					<option value="separator" disabled="">&mdash;</option>
					<option value="af" <?php if ($_POST['trans3']=='af') {echo 'selected';} ?>>Afrikaans</option>
					<option value="sq" <?php if ($_POST['trans3']=='sq') {echo 'selected';} ?>>Albanian</option>
					<option value="ar" <?php if ($_POST['trans3']=='ar') {echo 'selected';} ?>>Arabic</option>
					<option value="be" <?php if ($_POST['trans3']=='be') {echo 'selected';} ?>>Belarusian</option>
					<option value="bg" <?php if ($_POST['trans3']=='bg') {echo 'selected';} ?>>Bulgarian</option>
					<option value="ca" <?php if ($_POST['trans3']=='ca') {echo 'selected';} ?>>Catalan</option>
					<option value="zh-CN" <?php if ($_POST['trans3']=='zh-CN') {echo 'selected';} ?>>Chinese</option>
					<option value="hr" <?php if ($_POST['trans3']=='hr') {echo 'selected';} ?>>Croatian</option>
					<option value="cs" <?php if ($_POST['trans3']=='cs') {echo 'selected';} ?>>Czech</option>
					<option value="da" <?php if ($_POST['trans3']=='da') {echo 'selected';} ?>>Danish</option>
					<option value="nl" <?php if ($_POST['trans3']=='nl') {echo 'selected';} ?>>Dutch</option>
					<option value="en" <?php if ($_POST['trans3']=='en') {echo 'selected';} ?>>English</option>
					<option value="et" <?php if ($_POST['trans3']=='et') {echo 'selected';} ?>>Estonian</option>
					<option value="tl" <?php if ($_POST['trans3']=='tl') {echo 'selected';} ?>>Filipino</option>
					<option value="fi" <?php if ($_POST['trans3']=='fi') {echo 'selected';} ?>>Finnish</option>
					<option value="fr" <?php if ($_POST['trans3']=='fr') {echo 'selected';} ?>>French</option>
					<option value="gl" <?php if ($_POST['trans3']=='gl') {echo 'selected';} ?>>Galician</option>
					<option value="de" <?php if ($_POST['trans3']=='de') {echo 'selected';} ?>>German</option>
					<option value="el" <?php if ($_POST['trans3']=='el') {echo 'selected';} ?>>Greek</option>
					<option value="iw" <?php if ($_POST['trans3']=='iw') {echo 'selected';} ?>>Hebrew</option>
					<option value="hi" <?php if ($_POST['trans3']=='hi') {echo 'selected';} ?>>Hindi</option>
					<option value="hu" <?php if ($_POST['trans3']=='hu') {echo 'selected';} ?>>Hungarian</option>
					<option value="is" <?php if ($_POST['trans3']=='is') {echo 'selected';} ?>>Icelandic</option>
					<option value="id" <?php if ($_POST['trans3']=='id') {echo 'selected';} ?>>Indonesian</option>
					<option value="ga" <?php if ($_POST['trans3']=='ga') {echo 'selected';} ?>>Irish</option>
					<option value="it" <?php if ($_POST['trans3']=='it') {echo 'selected';} ?>>Italian</option>
					<option value="ja" <?php if ($_POST['trans3']=='ja') {echo 'selected';} ?>>Japanese</option>
					<option value="ko" <?php if ($_POST['trans3']=='ko') {echo 'selected';} ?>>Korean</option>
					<option value="lv" <?php if ($_POST['trans3']=='lv') {echo 'selected';} ?>>Latvian</option>
					<option value="lt" <?php if ($_POST['trans3']=='lt') {echo 'selected';} ?>>Lithuanian</option>
					<option value="mk" <?php if ($_POST['trans3']=='mk') {echo 'selected';} ?>>Macedonian</option>
					<option value="ms" <?php if ($_POST['trans3']=='ms') {echo 'selected';} ?>>Malay</option>
					<option value="mt" <?php if ($_POST['trans3']=='mt') {echo 'selected';} ?>>Maltese</option>
					<option value="nor" <?php if ($_POST['trans3']=='nor') {echo 'selected';} ?>>Norwegian</option>
					<option value="fa" <?php if ($_POST['trans3']=='fa') {echo 'selected';} ?>>Persian</option>
					<option value="pl" <?php if ($_POST['trans3']=='pl') {echo 'selected';} ?>>Polish</option>
					<option value="pt" <?php if ($_POST['trans3']=='pt') {echo 'selected';} ?>>Portuguese</option>
					<option value="ro" <?php if ($_POST['trans3']=='ro') {echo 'selected';} ?>>Romanian</option>
					<option value="ru" <?php if ($_POST['trans3']=='ru') {echo 'selected';} ?>>Russian</option>
					<option value="sr" <?php if ($_POST['trans3']=='sr') {echo 'selected';} ?>>Serbian</option>
					<option value="sk" <?php if ($_POST['trans3']=='sk') {echo 'selected';} ?>>Slovak</option>
					<option value="sl" <?php if ($_POST['trans3']=='sl') {echo 'selected';} ?>>Slovenian</option>
					<option value="es" <?php if ($_POST['trans3']=='es') {echo 'selected';} ?>>Spanish</option>
					<option value="sw" <?php if ($_POST['trans3']=='sw') {echo 'selected';} ?>>Swahili</option>
					<option value="sv" <?php if ($_POST['trans3']=='sv') {echo 'selected';} ?>>Swedish</option>
					<option value="th" <?php if ($_POST['trans3']=='th') {echo 'selected';} ?>>Thai</option>
					<option value="tr" <?php if ($_POST['trans3']=='tr') {echo 'selected';} ?>>Turkish</option>
					<option value="uk" <?php if ($_POST['trans3']=='uk') {echo 'selected';} ?>>Ukrainian</option>
					<option value="vi" <?php if ($_POST['trans3']=='vi') {echo 'selected';} ?>>Vietnamese</option>
					<option value="cy" <?php if ($_POST['trans3']=='cy') {echo 'selected';} ?>>Welsh</option>
					<option value="yi" <?php if ($_POST['trans3']=='yi') {echo 'selected';} ?>>Yiddish</option>
				</select>
			<?php _e("to","wprobot") ?> 
				<select name="trans4">
					<option value="no" <?php if ($_POST['trans4']=='no') {echo 'selected';} ?>>---</option>
					<option value="de" <?php if ($_POST['trans4']=='de') {echo 'selected';} ?>>German</option>
					<option value="en" <?php if ($_POST['trans4']=='en') {echo 'selected';} ?>>English</option>
					<option value="fr" <?php if ($_POST['trans4']=='fr') {echo 'selected';} ?>>French</option>
					<option value="separator" disabled="">&mdash;</option>
					<option value="af" <?php if ($_POST['trans4']=='af') {echo 'selected';} ?>>Afrikaans</option>
					<option value="sq" <?php if ($_POST['trans4']=='sq') {echo 'selected';} ?>>Albanian</option>
					<option value="ar" <?php if ($_POST['trans4']=='ar') {echo 'selected';} ?>>Arabic</option>
					<option value="be" <?php if ($_POST['trans4']=='be') {echo 'selected';} ?>>Belarusian</option>
					<option value="bg" <?php if ($_POST['trans4']=='bg') {echo 'selected';} ?>>Bulgarian</option>
					<option value="ca" <?php if ($_POST['trans4']=='ca') {echo 'selected';} ?>>Catalan</option>
					<option value="zh-CN" <?php if ($_POST['trans4']=='zh-CN') {echo 'selected';} ?>>Chinese</option>
					<option value="hr" <?php if ($_POST['trans4']=='hr') {echo 'selected';} ?>>Croatian</option>
					<option value="cs" <?php if ($_POST['trans4']=='cs') {echo 'selected';} ?>>Czech</option>
					<option value="da" <?php if ($_POST['trans4']=='da') {echo 'selected';} ?>>Danish</option>
					<option value="nl" <?php if ($_POST['trans4']=='nl') {echo 'selected';} ?>>Dutch</option>
					<option value="en" <?php if ($_POST['trans4']=='en') {echo 'selected';} ?>>English</option>
					<option value="et" <?php if ($_POST['trans4']=='et') {echo 'selected';} ?>>Estonian</option>
					<option value="tl" <?php if ($_POST['trans4']=='tl') {echo 'selected';} ?>>Filipino</option>
					<option value="fi" <?php if ($_POST['trans4']=='fi') {echo 'selected';} ?>>Finnish</option>
					<option value="fr" <?php if ($_POST['trans4']=='fr') {echo 'selected';} ?>>French</option>
					<option value="gl" <?php if ($_POST['trans4']=='gl') {echo 'selected';} ?>>Galician</option>
					<option value="de" <?php if ($_POST['trans4']=='de') {echo 'selected';} ?>>German</option>
					<option value="el" <?php if ($_POST['trans4']=='el') {echo 'selected';} ?>>Greek</option>
					<option value="iw" <?php if ($_POST['trans4']=='iw') {echo 'selected';} ?>>Hebrew</option>
					<option value="hi" <?php if ($_POST['trans4']=='hi') {echo 'selected';} ?>>Hindi</option>
					<option value="hu" <?php if ($_POST['trans4']=='hu') {echo 'selected';} ?>>Hungarian</option>
					<option value="is" <?php if ($_POST['trans4']=='is') {echo 'selected';} ?>>Icelandic</option>
					<option value="id" <?php if ($_POST['trans4']=='id') {echo 'selected';} ?>>Indonesian</option>
					<option value="ga" <?php if ($_POST['trans4']=='ga') {echo 'selected';} ?>>Irish</option>
					<option value="it" <?php if ($_POST['trans4']=='it') {echo 'selected';} ?>>Italian</option>
					<option value="ja" <?php if ($_POST['trans4']=='ja') {echo 'selected';} ?>>Japanese</option>
					<option value="ko" <?php if ($_POST['trans4']=='ko') {echo 'selected';} ?>>Korean</option>
					<option value="lv" <?php if ($_POST['trans4']=='lv') {echo 'selected';} ?>>Latvian</option>
					<option value="lt" <?php if ($_POST['trans4']=='lt') {echo 'selected';} ?>>Lithuanian</option>
					<option value="mk" <?php if ($_POST['trans4']=='mk') {echo 'selected';} ?>>Macedonian</option>
					<option value="ms" <?php if ($_POST['trans4']=='ms') {echo 'selected';} ?>>Malay</option>
					<option value="mt" <?php if ($_POST['trans4']=='mt') {echo 'selected';} ?>>Maltese</option>
					<option value="nor" <?php if ($_POST['trans4']=='nor') {echo 'selected';} ?>>Norwegian</option>
					<option value="fa" <?php if ($_POST['trans4']=='fa') {echo 'selected';} ?>>Persian</option>
					<option value="pl" <?php if ($_POST['trans4']=='pl') {echo 'selected';} ?>>Polish</option>
					<option value="pt" <?php if ($_POST['trans4']=='pt') {echo 'selected';} ?>>Portuguese</option>
					<option value="ro" <?php if ($_POST['trans4']=='ro') {echo 'selected';} ?>>Romanian</option>
					<option value="ru" <?php if ($_POST['trans4']=='ru') {echo 'selected';} ?>>Russian</option>
					<option value="sr" <?php if ($_POST['trans4']=='sr') {echo 'selected';} ?>>Serbian</option>
					<option value="sk" <?php if ($_POST['trans4']=='sk') {echo 'selected';} ?>>Slovak</option>
					<option value="sl" <?php if ($_POST['trans4']=='sl') {echo 'selected';} ?>>Slovenian</option>
					<option value="es" <?php if ($_POST['trans4']=='es') {echo 'selected';} ?>>Spanish</option>
					<option value="sw" <?php if ($_POST['trans4']=='sw') {echo 'selected';} ?>>Swahili</option>
					<option value="sv" <?php if ($_POST['trans4']=='sv') {echo 'selected';} ?>>Swedish</option>
					<option value="th" <?php if ($_POST['trans4']=='th') {echo 'selected';} ?>>Thai</option>
					<option value="tr" <?php if ($_POST['trans4']=='tr') {echo 'selected';} ?>>Turkish</option>
					<option value="uk" <?php if ($_POST['trans4']=='uk') {echo 'selected';} ?>>Ukrainian</option>
					<option value="vi" <?php if ($_POST['trans4']=='vi') {echo 'selected';} ?>>Vietnamese</option>
					<option value="cy" <?php if ($_POST['trans4']=='cy') {echo 'selected';} ?>>Welsh</option>
					<option value="yi" <?php if ($_POST['trans4']=='yi') {echo 'selected';} ?>>Yiddish</option>
				</select>							
			<?php _e(" (translate comments?","wprobot") ?> <input type="checkbox" name="trans_comments" value="1" <?php if($_POST["trans_comments"] == 1) {echo "checked";} ?>/> Yes <!--Tooltip--><a class="tooltip" href="#">?<span><?php _e('If selected all comments added to a post that is translated will be translated as well.<br/><br/><b>Warning:</b> Only use this if you have entered proxys for translation or else you might get banned from Google Translate for sending too many requests.',"wprobot") ?></span></a> )
			</td>
		</tr>	
		<?php } ?>
		<tr>
			<td width="100%" colspan="2">
			<b><?php _e("Start","wprobot") ?></b>
			<!--Tooltip--><a class="tooltip" href="#">?<span><?php _e('Delays the first post of this campaign by the amount you enter. Zero means the first post will be created immediatelly after adding the campaign.',"wprobot") ?></span></a><br/>
			<?php _e("Create first post in","wprobot") ?> <input size="3" name="delaystart" type="text" value="<?php echo $_POST['delaystart'];?>"/> <?php _e("hours.","wprobot") ?>
			</td>
		</tr>		
	</table>	
			
	<p class="submit" style="margin:0;padding: 10px 0;"><input class="button-primary" type="submit" name="wpr_add" value="<?php if(!$_GET["edit"]) {_e("Create Campaign","wprobot");} else {_e("Update Campaign","wprobot");} ?>" /></p>
	<br/><br/><br/><br/>
	</div>
	
</form>