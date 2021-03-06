<?php

function wpr_youtuberequest($keyword,$num,$start) {	
	$start++;
	$options = unserialize(get_option("wpr_options"));	
	$sort = $options['wpr_yt_sort'];
	$safesearch = $options['wpr_yt_safe'];
	$lang = $options['wpr_yt_lang'];
    if($lang == "zh-cn") {$lang = "zh-Hans";}
    if($lang == "zh-tw") {$lang = "zh-Hant";}	
	//$keyword = '"'.$keyword.'"';
	$keyword = urlencode($keyword);
    $request = "http://gdata.youtube.com/feeds/api/videos?q=$keyword&orderby=$sort&start-index=$start&max-results=$num&format=5&safeSearch=$safesearch&v=2";
	if($lang != "") {
	$request .= "&lr=$lang";
	}
	
	if ( function_exists('curl_init') ) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; Konqueror/4.0; Microsoft Windows) KHTML/4.0.80 (like Gecko)");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $request);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		$response = curl_exec($ch);
		if (!$response) {
			$return["error"]["module"] = "Youtube";
			$return["error"]["reason"] = "cURL Error";
			$return["error"]["message"] = __("cURL Error Number ","wprobot").curl_errno($ch).": ".curl_error($ch);	
			return $return;
		}		
		curl_close($ch);
	} else { 				
		$response = @file_get_contents($request);
		if (!$response) {
			$return["error"]["module"] = "Youtube";
			$return["error"]["reason"] = "cURL Error";
			$return["error"]["message"] = __("cURL is not installed on this server!","wprobot");	
			return $return;		
		}
	}
    
	$pxml = simplexml_load_string($response);
	if ($pxml === False) {
		$emessage = __("Failed loading XML, errors returned: ","wprobot");
		foreach(libxml_get_errors() as $error) {
			$emessage .= $error->message . ", ";
		}	
		$return["error"]["module"] = "Youtube";
		$return["error"]["reason"] = "XML Error";
		$return["error"]["message"] = $emessage;	
		return $return;			
	} else {
		return $pxml;
	}
}

function wpr_yt_getcomments($commenturl,$commentcount) {

	if ( function_exists('curl_init') ) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; Konqueror/4.0; Microsoft Windows) KHTML/4.0.80 (like Gecko)");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $commenturl);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		$response = curl_exec($ch);
		curl_close($ch);
	} else { 				
		$response = @file_get_contents($commenturl);
	}
    
    if ($response === False) {
    } else {
        $commentsFeed = simplexml_load_string($response);
    }  
	
	$i = 0;
	$comments = array();
	if($commentcount > 0) {
		foreach ($commentsFeed->entry as $comment) {
			$comments[$i]["author"] = $comment->author->name;
			$comments[$i]["content"] = $comment->content;	
			$i++;	
		}
	}
	
	return $comments;
}

function wpr_youtubepost($keyword,$num,$start,$optional="",$getcomments) {
	global $wpdb,$wpr_table_templates;
	
	if($keyword == "") {
		$return["error"]["module"] = "Youtube";
		$return["error"]["reason"] = "No keyword";
		$return["error"]["message"] = __("No keyword specified.","wprobot");
		return $return;	
	}		
	
	$template = $wpdb->get_var("SELECT content FROM " . $wpr_table_templates . " WHERE type = 'youtube'");
	if($template == false || empty($template)) {
		$return["error"]["module"] = "Youtube";
		$return["error"]["reason"] = "No template";
		$return["error"]["message"] = __("Module Template does not exist or could not be loaded.","wprobot");
		return $return;	
	}			
	$options = unserialize(get_option("wpr_options"));		
	$pxml = wpr_youtuberequest($keyword,$num,$start);
	if(!empty($pxml["error"])) {return $pxml;}
	$videos = array();
	$x = 0;
	
	if ($pxml === False) {
		$videos["error"]["module"] = "Youtube";
		$videos["error"]["reason"] = "API fail";
		$videos["error"]["message"] = __("Youtube API request did not work.","wprobot");	
		return $videos;	
	} else {
		if (isset($pxml->entry)) {
			foreach($pxml->entry as $entry) {
				
				$media = $entry->children('http://search.yahoo.com/mrss/');		
				$title = $media->group->title;
				$description = $media->group->description;	
			
				$attrs = $media->group->thumbnail[0]->attributes();
				$thumbnail = "<img src=".$attrs['url']." />"; 
				$thumbnailurl = $attrs['url'];
				
				//$yt = $entry->children('http://gdata.youtube.com/schemas/2007');
				//$attrs = $yt->statistics->attributes();
				//$viewCount = $attrs['viewCount']; 
				
				$yt = $media->children('http://gdata.youtube.com/schemas/2007');
				$videoid = $yt->videoid;
						
				$gd = $entry->children('http://schemas.google.com/g/2005'); 
				if ($gd->rating) {
					$attrs = $gd->rating->attributes();
					$rating = round($attrs['average'], 2); 
				} else {
					$rating = 0; 
				} 
				
				$attrs = $media->group->player->attributes();
				$playerUrl = $attrs['url'];

				$gd = $entry->children('http://schemas.google.com/g/2005');
				if ($gd->comments->feedLink) { 
					$attrs = $gd->comments->feedLink->attributes();
					$commentsUrl = $attrs['href']; 
					$commentsCount = $attrs['countHint']; 
				}
				 // 425 // 355
				$video ='
				<object width="'.$options['wpr_yt_width'].'" height="'.$options['wpr_yt_height'].'">
				<param name="movie" value="http://www.youtube.com/v/'.$videoid.'?fs=1"></param>
				<param name="allowFullScreen" value="true"></param>
				<embed src="http://www.youtube.com/v/'.$videoid.'?fs=1" type="application/x-shockwave-flash" width="'.$options['wpr_yt_width'].'" height="'.$options['wpr_yt_height'].'" allowfullscreen="true"></embed>
				</object>';
				
				if ($options['wpr_yt_striplinks_desc']=='yes') {$description = wpr_strip_selected_tags($description, array('a','iframe','script'));}
				
				$vid = $template;	
				$vid = wpr_random_tags($vid);
				
				// Comments
				$commentspost = "";
				preg_match('#\{comments(.*)\}#iU', $vid, $rmatches);
				if ($rmatches[0] != false || $getcomments == 1) {	
					$comments = wpr_yt_getcomments($commentsUrl,$commentsCount);				
				}
				if ($rmatches[0] != false && !empty($comments)) {
					$cnum = substr($rmatches[1], 1);
					for ($i = 0; $i < $commentsCount; $i++) {
						if($i == $cnum) {break;} else {	
							$commentspost .= "<p><b>Comment by ".$comments[$i]["author"]."</b><br/>".$comments[$i]["content"]."</p>";
						}
					}
					$vid = str_replace($rmatches[0], $commentspost, $vid);				
				}	
				
				$vid = str_replace("{description}", $description, $vid);
				$vid = str_replace("{thumbnail}", $thumbnail, $vid);
				//$vid = str_replace("{viewcount}", $viewCount, $vid);
				$vid = str_replace("{rating}", $rating, $vid);	
				$vid = str_replace("{keyword}", $keyword, $vid);
				$vid = str_replace("{video}", $video, $vid);	
				$vid = str_replace("{title}", $title, $vid);			
		
				$videos[$x]["unique"] = $videoid;
				$videos[$x]["title"] = $title;
				$videos[$x]["content"] = $vid;	
				$videos[$x]["comments"] = $comments;	
				$videos[$x]["customfield"] = $thumbnailurl;
	
				$x++;
			}			
			if(empty($videos)) {
				$videos["error"]["module"] = "Youtube";
				$videos["error"]["reason"] = "No content";
				$videos["error"]["message"] = __("No (more) Youtube videos found.","wprobot");	
				return $videos;		
			} else {
				return $videos;	
			}
		} else {
			$videos["error"]["module"] = "Youtube";
			$videos["error"]["reason"] = "No content";
			$videos["error"]["message"] = __("No (more) Youtube videos found.","wprobot");	
			return $videos;		
		}
	}	
}
	
function wpr_youtube_options_default() {
	$options = array(
		"wpr_yt_lang" => "",
		"wpr_yt_width" => "425",
		"wpr_yt_height" => "355",
		"wpr_yt_safe" => "moderate",
		"wpr_yt_sort" => "relevance",
		"wpr_yt_striplinks_desc" => "no",
		"wpr_yt_striplinks_comm" => "yes"		
	);
	return $options;
}

function wpr_youtube_options($options) {
	?>
	<h3 style="text-transform:uppercase;border-bottom: 1px solid #ccc;"><?php _e("Youtube Options","wprobot") ?></h3>	
		<table class="addt" width="100%" cellspacing="2" cellpadding="5" class="editform"> 
			<tr valign="top"> 
				<td width="40%" scope="row"><?php _e("Language:","wprobot") ?></td> 
				<td>
				<select name="wpr_yt_lang" id="wpr_yt_lang">
							<option value="" <?php if($options['wpr_yt_lang']==""){_e('selected');}?>>Any Language</option>
							<option value="ar" <?php if($options['wpr_yt_lang']=="ar"){_e('selected');}?>>Arabic</option>
							<option value="bg" <?php if($options['wpr_yt_lang']=="bg"){_e('selected');}?>>Bulgarian</option>
							<option value="ca" <?php if($options['wpr_yt_lang']=="ca"){_e('selected');}?>>Catalan</option>
							<option value="zh-cn" <?php if($options['wpr_yt_lang']=="zh-cn"){_e('selected');}?>>Chinese (Simplified)</option>
							<option value="zh-tw" <?php if($options['wpr_yt_lang']=="zh-tw"){_e('selected');}?>>Chinese (Traditional)</option>
							<option value="hr" <?php if($options['wpr_yt_lang']=="hr"){_e('selected');}?>>Croatian</option>
							<option value="cs" <?php if($options['wpr_yt_lang']=="cs"){_e('selected');}?>>Czech</option>
							<option value="da" <?php if($options['wpr_yt_lang']=="da"){_e('selected');}?>>Danish</option>
							<option value="nl" <?php if($options['wpr_yt_lang']=="nl"){_e('selected');}?>>Dutch</option>
							<option value="en" <?php if($options['wpr_yt_lang']=="en"){_e('selected');}?>>English</option>
							<option value="et" <?php if($options['wpr_yt_lang']=="et"){_e('selected');}?>>Estonian</option>
							<option value="fi" <?php if($options['wpr_yt_lang']=="fi"){_e('selected');}?>>Finnish</option>
							<option value="fr" <?php if($options['wpr_yt_lang']=="fr"){_e('selected');}?>>French</option>
							<option value="de" <?php if($options['wpr_yt_lang']=="de"){_e('selected');}?>>German</option>
							<option value="er" <?php if($options['wpr_yt_lang']=="er"){_e('selected');}?>>Greek</option>
							<option value="iw" <?php if($options['wpr_yt_lang']=="iw"){_e('selected');}?>>Hebrew</option>
							<option value="hu" <?php if($options['wpr_yt_lang']=="hu"){_e('selected');}?>>Hungarian</option>
							<option value="is" <?php if($options['wpr_yt_lang']=="is"){_e('selected');}?>>Icelandic</option>
							<option value="it" <?php if($options['wpr_yt_lang']=="it"){_e('selected');}?>>Italian</option>
							<option value="ja" <?php if($options['wpr_yt_lang']=="ja"){_e('selected');}?>>Japanese</option>
							<option value="ko" <?php if($options['wpr_yt_lang']=="ko"){_e('selected');}?>>Korean</option>
							<option value="lv" <?php if($options['wpr_yt_lang']=="lv"){_e('selected');}?>>Latvian</option>
							<option value="lt" <?php if($options['wpr_yt_lang']=="lt"){_e('selected');}?>>Lithuanian</option>
							<option value="no" <?php if($options['wpr_yt_lang']=="no"){_e('selected');}?>>Norwegian</option>
							<option value="pl" <?php if($options['wpr_yt_lang']=="pl"){_e('selected');}?>>Polish</option>
							<option value="pt" <?php if($options['wpr_yt_lang']=="pt"){_e('selected');}?>>Portuguese</option>
							<option value="ro" <?php if($options['wpr_yt_lang']=="ro"){_e('selected');}?>>Romanian</option>
							<option value="ru" <?php if($options['wpr_yt_lang']=="ru"){_e('selected');}?>>Russian</option>
							<option value="sr" <?php if($options['wpr_yt_lang']=="sr"){_e('selected');}?>>Serbian</option>
							<option value="sk" <?php if($options['wpr_yt_lang']=="sk"){_e('selected');}?>>Slovak</option>
							<option value="sl" <?php if($options['wpr_yt_lang']=="sl"){_e('selected');}?>>Slovenian</option>
							<option value="es" <?php if($options['wpr_yt_lang']=="es"){_e('selected');}?>>Spanish</option>
							<option value="sv" <?php if($options['wpr_yt_lang']=="sv"){_e('selected');}?>>Swedish</option>
							<option value="tr" <?php if($options['wpr_yt_lang']=="tr"){_e('selected');}?>>Turkish</option>									
				</select>
			</td> 
			</tr>	
			<tr valign="top"> 
				<td width="40%" scope="row"><?php _e("Safe Search:","wprobot") ?></td> 
				<td>
				<select name="wpr_yt_safe" id="wpr_yt_safe">
							<option value="none" <?php if($options['wpr_yt_safe']=="none"){_e('selected');}?>><?php _e("None","wprobot") ?></option>
							<option value="moderate" <?php if($options['wpr_yt_safe']=="moderate"){_e('selected');}?>><?php _e("Moderate","wprobot") ?></option>
							<option value="strict" <?php if($options['wpr_yt_safe']=="strict"){_e('selected');}?>><?php _e("Strict","wprobot") ?></option>
				</select>
			</td> 
			</tr>				
			<tr valign="top"> 
				<td width="40%" scope="row"><?php _e("Sort Videos by:","wprobot") ?></td> 
				<td>
				<select name="wpr_yt_sort" id="wpr_yt_sort">
							<option value="relevance" <?php if($options['wpr_yt_sort']=="relevance"){_e('selected');}?>><?php _e("Relevance","wprobot") ?></option>
							<option value="viewCount" <?php if($options['wpr_yt_sort']=="viewCount"){_e('selected');}?>><?php _e("View Count","wprobot") ?></option>
							<option value="rating" <?php if($options['wpr_yt_sort']=="rating"){_e('selected');}?>><?php _e("Rating","wprobot") ?></option>
							<option value="published" <?php if($options['wpr_yt_sort']=="published"){_e('selected');}?>><?php _e("Date Published","wprobot") ?></option>
				</select>
			</td> 
			</tr>				
			<tr valign="top"> 
				<td width="40%" scope="row"><?php _e("Video Size:","wprobot") ?></td> 
				<td>
				<input id="wpr_yt_width" size="7" class="small-text" type="text" value="<?php echo $options['wpr_yt_width']; ?>" name="wpr_yt_width"/> x <input id="wpr_yt_height" size="7" class="small-text" type="text" value="<?php echo $options['wpr_yt_height']; ?>" name="wpr_yt_height"/>
				</td> 
			</tr>			
			<tr valign="top"> 
				<td width="40%" scope="row"><?php _e("Strip All Links from...","wprobot") ?></td> 
				<td><input name="wpr_yt_striplinks_desc" type="checkbox" id="wpr_yt_striplinks_desc" value="yes" <?php if ($options['wpr_yt_striplinks_desc']=='yes') {echo "checked";} ?>/> <?php _e("Video Description","wprobot") ?><br/>
				<input name="wpr_yt_striplinks_comm" type="checkbox" id="wpr_yt_striplinks_comm" value="yes" <?php if ($options['wpr_yt_striplinks_comm']=='yes') {echo "checked";} ?>/> <?php _e("Comments","wprobot") ?></td> 
			</tr>				
		</table>	
	<?php
}

?>