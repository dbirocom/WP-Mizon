<?php
$tags["amazon"] = "{title}, {keyword}, {url}, {link}, {description}, {features}, {thumbnail}, {rating}, {avgrating}, {reviewsnum}, {buynow-big}, {buynow}, {listprice}, {price}, {reviews}, {smallimage}, {mediumimage}, {largeimage}";
$tags["article"] = "{title}, {keyword}, {url}, {article}, {authortext}";
$tags["clickbank"] = "{title}, {keyword}, {url}, {link}, {description}";
$tags["ebay"] = "{title}, {keyword}, {url}, {thumbnail}, {price}, {descriptiontable}, {description}";
$tags["flickr"] = "{title}, {keyword}, {url}, {image}, {date}, {owner}, {description}";
$tags["rss"] = "{title}, {keyword}, {url}, {content}, {source}, {author}, {mediacontent}, {mediathumbnail}, {enclosure}";
$tags["yahooanswers"] = "{title}, {keyword}, {url}, {question}, {user}, {answers}";
$tags["youtube"] = "{title}, {keyword}, {url}, {thumbnail}, {video}, {rating}, {description}";
$tags["yahoonews"] = "{title}, {keyword}, {url}, {thumbnail}, {summary}, {source}}";
?>


<div class="wrap">
<style type="text/css">
table.addt {padding:5px;margin-bottom:10px;background:#F5F5F5;border:1px dotted #F0F0F0;}
table.addt:hover {background:#F2F2F2;border:1px dotted #d9d9d9;}
div.expld {padding:5px;margin-bottom:10px;background:#fffff0;border:1px dotted #e5dd83;}
div.expld:hover {background:#ffffe5;border:1px dotted #e5db6c;} 
a.expll {display:block;padding:10px;}
a.aactive {background:#fff;}
a.expll:hover {display:block;padding:10px;background:#fff;}
h3 a,h2 a {font-size:80%;text-decoration:none;margin-left:10px;}
</style>
<h2><?php if($_GET["which"] == "post") {_e("WP Robot Post Templates","wprobot");?> <a href="?page=wpr-templates&which=post&add=post"><?php _e("&rarr; Add New","wprobot") ?></a><?php } else {_e("WP Robot Module Templates","wprobot");} ?></h2>

	<?php 
	if($_GET["which"] == "post") {$where = "WHERE type = 'post'";$order = "id DESC";} else {$where = "WHERE type != 'post'";$order = "type ASC";}
	$records = $wpdb->get_results("SELECT * FROM " . $wpr_table_templates . " $where ORDER BY $order"); 
	if ($records) {
	
		// POST TEMPLATES
		if($_GET["which"] == "post") {
		$type = "";
		$i = 1;
		?>
	<div style="width:25%;float:right;";>
	
		<div class="expld">		
			<strong><?php _e("Select Page:","wprobot") ?></strong><br/>			
			<a class="expll" href="?page=wpr-templates"><strong><?php _e("Module Templates","wprobot") ?></strong></a>
			<a class="expll aactive" href="?page=wpr-templates&which=post"><strong><?php _e("Post Template Presets","wprobot") ?></strong></a>
		</div>	
		
		<div class="expld">	
			<?php _e('WP Robot knows <b>two types of templates</b>:<br/><b>Post Templates</b> are the main templates used for posts. They can contain several module template tags which in turn trigger a <b>Module Template</b>. In other words Module templates are used for single module items, for example a single Amazon product, while Post templates are used for the complete post and can contain several modules.',"wprobot") ?>
		</div>			
		
		<div class="expld">	
			<?php _e('The <strong>Post Template Presets</strong> you set up on this page will be available on the "Add Campaign" screen as presets to use in your campaign.',"wprobot") ?>
		</div>			
	
		<div class="expld">	
			<strong><?php _e("Content Template Tags","wprobot") ?></strong><br/>	
			<?php foreach($loadedmodules as $loadedmodule) {if($loadedmodule != "translation"){echo "{".$loadedmodule."}<br/>";}} ?>
			<br/>{keyword}<br/>{catlink}<br/><a href="http://wprobot.net/documentation/#631"><?php _e("Random Tags","wprobot") ?></a><br/><a href="http://wprobot.net/documentation/#63"><b>See Documentation</b></a>
		</div>		

		<div class="expld">	
			<strong><?php _e("Title Template Tags","wprobot") ?></strong><br/>		
			<?php foreach($loadedmodules as $loadedmodule) {if($loadedmodule != "translation"){echo "{".$loadedmodule."title}<br/>";}} ?>
			<br/>{keyword}<br/><a href="http://wprobot.net/documentation/#631"><?php _e("Random Tags","wprobot") ?></a><br/><a href="http://wprobot.net/documentation/#63"><b>See Documentation</b></a>
		</div>	
		
	</div>
	<div style="width:70%;">	
		<?php
        foreach ($records as $record) { 
		?>
			
			<form method="post" id="wpr_template_<?php echo $record->id;?>">	
			<input size="5" name="tnum" type="hidden" value="<?php echo $record->id; ?>"/>
			<a name="<?php echo $i;?>"></a><table class="addt" width="100%">	
				<tr>
					<td valign="top" width="50%">
						<strong style="font-size:120%;border-bottom:1px dotted #ccc;"><?php echo ucwords($record->type);?> <?php _e("Template Preset","wprobot") ?> <?php echo $i;?></strong><br/>
						<?php _e("Name:","wprobot") ?> <input class="input" name="tname" type="text" value="<?php echo $record->name; ?>"/>						
					</td>
					<td>
						<strong><?php _e("Post Title","wprobot") ?></strong><br/>
						<textarea name="ttitle" rows="2" cols="30"><?php echo $record->title;?></textarea>
					</td>
				</tr>				
				<tr>
					<td width="50%">
					</td>
					<td rowspan="3">
						<strong><?php _e("Post Content","wprobot") ?></strong><br/>
						<textarea name="tcontent" rows="5" cols="30"><?php echo $record->content;?></textarea>
					</td>
				</tr>
				<tr>
					<td>
						<input class="button" type="submit" name="tsave" value="<?php _e("Save Changes","wprobot") ?>" /> 
						<input class="button" type="submit" name="tcopy" value="<?php _e("Copy","wprobot") ?>" />						
						<input class="button" type="submit" name="tdelete" value="<?php _e("Delete","wprobot") ?>" />
					</td>
				</tr>
				<tr>
					<td>
					</td>
				</tr>
		<tr>	
			<td>
	
			</td>
			<td>
			<strong><?php _e("Post Comments","wprobot") ?></strong><br/>
			<input type="checkbox" name="comments_amazon" value="1" <?php if($record->comments_amazon == 1) {echo "checked";} ?>/> <?php _e("Amazon reviews","wprobot") ?><br/>
			<input type="checkbox" name="comments_yahoo" value="1" <?php if($record->comments_yahoo == 1) {echo "checked";} ?>/> <?php _e("Yahoo Answers answers","wprobot") ?><br/>
			<input type="checkbox" name="comments_flickr" value="1" <?php if($record->comments_flickr == 1) {echo "checked";} ?>/> <?php _e("Flickr comments","wprobot") ?><br/>
			<input type="checkbox" name="comments_youtube" value="1" <?php if($record->comments_youtube == 1) {echo "checked";} ?>/> <?php _e("Youtube comments","wprobot") ?>
			</td>			
		</tr>				
			</table>
			</form>	

			<?php if($type != $record->type) { $type = $record->type; } $i++; ?>			
			
		<?php } ?>

	<?php } else { // MODULE TEMPLATES ?>
	<div style="width:25%;float:right;";>
	
		<div class="expld">		
			<strong><?php _e("Select Page:","wprobot") ?></strong><br/>			
			<a class="expll aactive" href="?page=wpr-templates"><strong><?php _e("Module Templates","wprobot") ?></strong></a>
			<a class="expll" href="?page=wpr-templates&which=post"><strong><?php _e("Post Template Presets","wprobot") ?></strong></a>
		</div>	
		
		<div class="expld">	
			<?php _e('WP Robot knows <b>two types of templates</b>.<br/><b>Post Templates</b> are the main templates used for posts. They can contain several module template tags which in turn trigger a <b>Module Template</b>. In other words Module templates are used for single module items, for example a single Amazon product, while Post templates are used for the complete post and can contain several modules.',"wprobot") ?>
		</div>			
		
		<div class="expld">	
			<?php _e('The <strong>Module Templates</strong> you set up on this page will be used to populate module template tags in your post templates with content.<br/><br/>For <b>example</b> the "Amazon Module Template" will be used for all {amazon} tags in your post templates, the "Article Module Template" for all {article} tags and so on.',"wprobot") ?>
		</div>	

		<div class="expld">	
			<?php _e('Each module you own has one Module Template that belongs to it.<br/><br/>The exception to that is the Flickr Module, which has a separate template for thumbnails.',"wprobot") ?>
		</div>		
		
		<div class="expld">	
			<?php _e('<b>See the documentation for a list of <a href="http://wprobot.net/documentation/#633">all available template tags</a>.</b>',"wprobot") ?>
		</div>			
		
	</div>
	<div style="width:70%;">	
	<form method="post" id="wpr_template">	
    <?php $i = 0;   foreach ($records as $record) { 
		
			if($type != $record->type) { ?>
			<h3 style="text-transform:uppercase;border-bottom: 1px solid #ccc;"><?php echo $record->type;?> <?php _e("Module Template","wprobot"); if($record->name == "thumbnail") {_e(" (Thumbnail)","wprobot");} ?></h3>	
			<?php if($type == "post") { ?><p><a href="?page=wpr-templates&add=<?php echo $record->type;?>"><?php _e("Add new template","wprobot") ?></a></p><?php } ?>	
			<?php } ?>	
			
			
			<input size="5" name="tnum" type="hidden" value="<?php echo $record->id; ?>"/>
			<table class="addt" width="100%">		
				<tr>
					<td valign="top" rowspan="3">
						<input size="5" name="<?php echo $i."id";?>" type="hidden" value="<?php echo $record->id; ?>"/>
						<strong><?php _e("Content","wprobot") ?></strong><br/>
						<textarea name="<?php echo $i."c";?>" rows="5" cols="42"><?php echo $record->content;?></textarea>
					</td>	
					<td valign="top" style="padding-left:10px;">	
						<strong><?php _e("Tags Available","wprobot") ?></strong><br/>
						<?php echo $tags[$record->type];?>
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
			</table>

	
		<?php $i++; } ?>	
		<input size="5" name="modnum" type="hidden" value="<?php echo $i; ?>"/>
		<p><input class="button-primary" type="submit" name="tmodsave" value="<?php _e("Save Changes","wprobot") ?>" /> </p>
		</form>		
	<?php }	?>	<?php }	?>	
		</div>		
</div>