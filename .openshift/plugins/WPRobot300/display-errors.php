<div class="wrap">
<h2><?php _e("WP Robot Log","wprobot") ?></h2>

<?php if($_GET["id"]) {?>
<p><a href="?page=wpr-log"><?php _e("View log for all campaigns","wprobot") ?></a></p>
<?php } ?>

<?php if ($errors) { ?>
<table width="60%" class="widefat post fixed" cellspacing="0">	
	<thead>
		<tr>
			<?php if(!$_GET["id"]) {?><th width="5%"><?php _e("Camp.","wprobot") ?></th><?php } ?>		
			<th width="15%"><?php _e("Time","wprobot") ?></th>		
			<th width="20%"><?php _e("Keyword","wprobot") ?></th>
			<th width="10%"><?php _e("Module","wprobot") ?></th>
			<th width="50%"><?php _e("Message","wprobot") ?></th>
		</tr>
	</thead>
	<tbody>	
	<?php foreach($errors as $error) {?>
		<tr <?php if($error->module == "") {if($error->reason == "Post created") {echo 'style="background:#CEF6CE;"';} elseif($error->reason == "Exclude" || $error->reason == "Duplicate Content") {echo 'style="background:#F2F5A9;"';} else {echo 'style="background:#F6CECE;"';}} ?>>
			<?php if(!$_GET["id"]) {?><td><a title="<?php _e("View full log for this campaign","wprobot") ?>" href="?page=wpr-log&id=<?php echo $error->campaign; ?>"><?php echo $error->campaign; ?></a></td><?php } ?>		
			<td><?php if($error->module == "") {echo "<strong>".$error->time."</strong>";} ?></td>		
			<td><a title="<?php _e("View full log for this keyword","wprobot") ?>" href="?page=wpr-log&id=<?php echo $error->campaign; ?>&keyword=<?php echo $error->keyword; ?>"><?php echo $error->keyword; ?></a></td>
			<td><?php echo $error->module; ?></td>
			<td><?php echo $error->message; ?></td>
		</tr>
	<?php }?>
	</tbody>	
</table>
<form method="post" id="wpr_err">
<p class="submit"><input class="button" type="submit" name="wpr_clear_log" value="<?php _e("Clear Log","wprobot") ?>" /></p>
</form>
<?php } else { ?>
<p><?php _e("Post log is empty.","wprobot") ?></p>
<?php } ?>	 
</div>
