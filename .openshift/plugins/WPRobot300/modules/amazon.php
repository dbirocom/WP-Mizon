<?php

function wpr_aws_request($region, $params, $public_key, $private_key) {
	$method = "GET";
	$host = "ecs.amazonaws.".$region;
	$uri = "/onca/xml";

	$params["Service"] = "AWSECommerceService";
	$params["AWSAccessKeyId"] = $public_key;
	
	$t = time() + 10000;
	$params["Timestamp"] = gmdate("Y-m-d\TH:i:s\Z",$t);	
	$params["Version"] = "2009-03-31";
	ksort($params);
	
	$canonicalized_query = array();
	foreach ($params as $param=>$value) {
		$param = str_replace("%7E", "~", rawurlencode($param));
		$value = str_replace("%7E", "~", rawurlencode($value));
		$canonicalized_query[] = $param."=".$value;
	}
	$canonicalized_query = implode("&", $canonicalized_query);
	$string_to_sign = $method."\n".$host."\n".$uri."\n".$canonicalized_query;   
	$signature = base64_encode(hash_hmac("sha256", $string_to_sign, $private_key, True));  
	$signature = str_replace("%7E", "~", rawurlencode($signature));  
	$request = "http://".$host.$uri."?".$canonicalized_query."&Signature=".$signature; 
		
	if ( function_exists('curl_init') ) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; Konqueror/4.0; Microsoft Windows) KHTML/4.0.80 (like Gecko)");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $request);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		$response = curl_exec($ch);
		if (!$response) {
			$return["error"]["module"] = "Amazon";
			$return["error"]["reason"] = "cURL Error";
			$return["error"]["message"] = __("cURL Error Number ","wprobot").curl_errno($ch).": ".curl_error($ch);	
			return $return;
		}		
		curl_close($ch);
	} else { 				
		$response = @file_get_contents($request);
		if (!$response) {
			$return["error"]["module"] = "Amazon";
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
		$return["error"]["module"] = "Amazon";
		$return["error"]["reason"] = "XML Error";
		$return["error"]["message"] = $emessage;	
		return $return;			
	} else {
		return $pxml;
	}
} 

function wpr_star_rating($rating) {
	$imagepath = get_option('siteurl').'/wp-content/plugins/WPRobot3/images/';	

	if($rating>=0 && $rating <= 0.7) {
		$image = '<img src="'.$imagepath.'0-5.png" >';
	}
	if($rating>=1.3 && $rating <= 1.7) {
		$image = '<img src="'.$imagepath.'1-5.png" >';
	}
	if($rating>=2.3 && $rating <= 2.7) {
		$image = '<img src="'.$imagepath.'2-5.png" >';
	}
	if($rating>=3.3 && $rating <= 3.7) {
		$image = '<img src="'.$imagepath.'3-5.png" >';
	}
	if($rating>=4.3 && $rating <= 4.7) {
		$image = '<img src="'.$imagepath.'4-5.png" >';
	}
	if($rating>=0.8 && $rating <= 1.2) {
		$image = '<img src="'.$imagepath.'1.png" >';
	}
	if($rating>=1.8 && $rating <= 2.2) {
		$image = '<img src="'.$imagepath.'2.png" >';
	}
	if($rating>=2.8 && $rating <= 3.2) {
		$image = '<img src="'.$imagepath.'3.png" >';
	}
	if($rating>=3.8 && $rating <= 4.2) {
		$image = '<img src="'.$imagepath.'4.png" >';
	}
	if($rating>=4.8 && $rating <= 5) {
		$image = '<img src="'.$imagepath.'5.png" >';
	}
		 
	return $image;
}

function wpr_amazonpost($keywords,$count,$start,$optional,$comments="") {
	global $wpdb,$wpr_table_templates;

	$searchindex = $optional[0];
	$browsenode = $optional[1];	
	if($searchindex == "") {$searchindex = "All";}
	
	if($keywords == "" && $browsenode  == "") {
		$return["error"]["module"] = "Amazon";
		$return["error"]["reason"] = "No keyword";
		$return["error"]["message"] = __("No keyword or BrowseNode specified.","wprobot");	
		return $return;	
	}

	$start2 = $start / 10;
	$start2 = (string) $start2; 
	$start2 = explode(".", $start2);
	$page=(int)$start2[0];	
	$page++;				
	$cnum=(int)$start2[1]; 
	
	$template = $wpdb->get_var("SELECT content FROM " . $wpr_table_templates . " WHERE type = 'amazon'");
	if($template == false || empty($template)) {
		$return["error"]["module"] = "Amazon";
		$return["error"]["reason"] = "No template";
		$return["error"]["message"] = __("Module Template does not exist or could not be loaded.","wprobot");
		return $return;	
	}		
	$imagepath = get_option('siteurl').'/wp-content/plugins/WPRobot3/images/';	
	$options = unserialize(get_option("wpr_options"));	
	$public_key = $options['wpr_aa_apikey'];
	$private_key = $options['wpr_aa_secretkey'];
	$affid = $options['wpr_aa_affkey'];
	$added_post = 0;

	$return = array();
	$site = $options['wpr_aa_site'];		
	//if($options['wpr_aa_searchmode'] == "exact") {
	//	$keywords = '"' .$keywords. '"';
	//}		
	if($browsenode == "") {$browsenode = 0;}	

	while($added_post < $count) {
		
		if($searchindex == "All") {
		$pxml = wpr_aws_request($site, array(
		"Operation"=>"ItemSearch",
		"AssociateTag"=>$affid,
		"Keywords"=>$keywords,
		"SearchIndex"=>$searchindex,
		"MerchantId"=>"All",
		"ItemPage"=>$page,
		"ReviewSort"=>"-HelpfulVotes",
		"ResponseGroup"=>"Large"
		), $public_key, $private_key);	
		} elseif($browsenode != 0) {
		$pxml = wpr_aws_request($site, array(
		"Operation"=>"ItemSearch",
		"AssociateTag"=>$affid,
		"SearchIndex"=>$searchindex,
		"BrowseNode"=>$browsenode,
		"MerchantId"=>"All",
		"ItemPage"=>$page,
		"ReviewSort"=>"-HelpfulVotes",
		"ResponseGroup"=>"Large"
		), $public_key, $private_key);					
		} else {
		$pxml = wpr_aws_request($site, array(
		"Operation"=>"ItemSearch",
		"AssociateTag"=>$affid,
		"Keywords"=>$keywords,
		"SearchIndex"=>$searchindex,
		"MerchantId"=>"All",
		"ItemPage"=>$page,
		"ReviewSort"=>"-HelpfulVotes",
		"ResponseGroup"=>"Large"
		), $public_key, $private_key);					
		}
		if(!empty($pxml["error"])) {return $pxml;}
		//echo "<pre>";print_r($pxml);echo "</pre>";

		if($count<=10){
			$count_this = $count;
		} else{
			$count_this = 10;
		}
		$i=0;
		$yy=0;
		
		if (!$pxml) {
			$return["error"]["module"] = "Amazon";
			$return["error"]["reason"] = "Request fail";
			$return["error"]["message"] = __("API request could not be sent.","wprobot");	
			return $return;						
		}
		
		if (isset($pxml->Error)) {
			$message = '<p>'.__("There was a problem with your Amazon API request. This is the error Amazon returned:","wprobot").'</p>
			<p><i><b>'.$pxml->Error->Code.':</b> '.$pxml->Error->Message.'</i></p>';	
			$return["error"]["module"] = "Amazon";
			$return["error"]["reason"] = "API fail";
			$return["error"]["message"] = $message;	
			return $return;
		}	

		if (isset($pxml->Items->Request->Errors->Error->Code)) {
			$message = '<p>'.__("There was a problem with your Amazon API request. This is the error Amazon returned:","wprobot").'</p>
			<p><i><b>'.$pxml->Items->Request->Errors->Error->Code.':</b> '.$pxml->Items->Request->Errors->Error->Message.'</i></p>';
			$return["error"]["module"] = "Amazon";
			$return["error"]["reason"] = "API fail";
			$return["error"]["message"] = $message;	
			return $return;
		}			
		
		if (!$pxml->Items->Item) {
			$return["error"]["module"] = "Amazon";
			$return["error"]["reason"] = "No content";
			$return["error"]["message"] = __("No (more) products found for this keyword.","wprobot");	
			return $return;			
		}			

		foreach($pxml->Items->Item as $item) {
			if($yy >= $cnum) {
			
				$skipit = 0;
				$skip = $options["wpr_aa_skip"];
				if($skip == "noimg" || $skip == "nox") {if($item->MediumImage->URL == "" && $item->SmallImage->URL) {$skipit = 1;}}	
				if($skip == "nodesc" || $skip == "nox") {if($item->EditorialReviews->EditorialReview->Content == "") {$skipit = 1;}}			
			
				if ($i<$count_this && $skipit == 0) {
					$desc = "";					
					if (isset($item->EditorialReviews->EditorialReview)) {
						foreach($item->EditorialReviews->EditorialReview as $descs) {
							$desc .= $descs->Content;
						}		
					}	
					
					$elength = ($options['wpr_aa_excerptlength']);
					if ($elength != 'full') {
						$desc = strip_tags($desc,'<br>');
						$desc = substr($desc, 0, $elength);
					}				
					
					$features = "";
					if (isset($item->ItemAttributes->Feature)) {	
						$features = "<ul>";
						foreach($item->ItemAttributes->Feature as $feature) {
							$posx = strpos($feature, "href=");
							if ($posx === false) {
								$features .= "<li>".$feature."</li>";		
							}
						}	
						$features .= "</ul>";				
					}
					
					$timg = $item->MediumImage->URL;
					if($timg == "") {$timg = $item->SmallImage->URL;}				
					$thumbnail = '<a href="'.$item->DetailPageURL.'" rel="nofollow"><img style="float:left;margin: 0 20px 10px 0;" src="'.$timg.'" /></a>';					
					$link = '<a href="'.$item->DetailPageURL.'" rel="nofollow">'.$item->ItemAttributes->Title.'</a>';	
							
					$reviews = "";$reviews = array();					
					if (isset($item->CustomerReviews->Review)) {
						$r = 0;
						foreach($item->CustomerReviews->Review as $review) {
							$reviews[$r]["author"] = $review->Reviewer->Name;		
							$reviews[$r]["rating"] = $review->Rating;
							$image = wpr_star_rating($review->Rating);
							$rtemplate = $options['wpr_aa_revtemplate'];
							$rtemplate = str_replace("{content}", strip_tags($review->Content,'<br><strong>'), $rtemplate);	
							$rtemplate = str_replace("{rating}", $image, $rtemplate);			
							$rtemplate = str_replace("{ratingnum}", $review->Rating, $rtemplate);			
							$rtemplate = str_replace("{author}", $review->Reviewer->Name, $rtemplate);
							$rtemplate = str_replace("{keyword}", $keywords, $rtemplate);	
							$rtemplate = str_replace("{link}", $link, $rtemplate);
							$rtemplate = str_replace("{url}", $item->DetailPageURL, $rtemplate);					
							$reviews[$r]["content"] = $rtemplate;
							$r++;
						}	
					}

					$price = str_replace("$", "$ ", $item->OfferSummary->LowestNewPrice->FormattedPrice);
					$listprice = str_replace("$", "$ ", $item->ItemAttributes->ListPrice->FormattedPrice);
		
					$content = $template;
					preg_match('#\[has_reviews](.*)[\/has_reviews]\]#iU', $template, $check);
					if ($check[0] != false) {
						if($item->CustomerReviews->TotalReviews == "" || $item->CustomerReviews->TotalReviews == 0 || !$item->CustomerReviews->TotalReviews) {
							$content = str_replace($check[0], "", $content);
						}
					}	
					$content = str_replace(array("[has_reviews]","[/has_reviews]"), "", $content);		
					preg_match('#\[has_listprice](.*)[\/has_listprice]\]#iU', $template, $matches);//print_r($matches);
					if ($matches[0] != false) {
						if($listprice == "" || !$listprice) {
							$content = str_replace($matches[0], "", $content);
						}
					}
					$content = str_replace(array("[has_listprice]","[/has_listprice]"), "", $content);
					
					$content = wpr_random_tags($content);				
					$content = str_replace("{title}", $item->ItemAttributes->Title, $content);
					$content = str_replace("{description}", $desc, $content);
					$content = str_replace("{features}", $features, $content);
					$content = str_replace("{thumbnail}", $thumbnail, $content);
					$content = str_replace("{smallimage}", $item->SmallImage->URL, $content);	
					$content = str_replace("{mediumimage}", $item->MediumImage->URL, $content);	
					$content = str_replace("{largeimage}", $item->LargeImage->URL, $content);
					$content = str_replace("{buynow}", '<a href="'.$item->DetailPageURL.'" rel="nofollow"><img src="'.$imagepath.'buynow-small.gif" /></a>', $content);		
					$content = str_replace("{buynow-big}", '<a href="'.$item->DetailPageURL.'" rel="nofollow"><img src="'.$imagepath.'buynow-big.gif" /></a>', $content);					
					$content = str_replace("{price}", $price, $content);
					$content = str_replace("{listprice}", $listprice, $content);
					$content = str_replace("{url}", $item->DetailPageURL, $content);	
					$content = str_replace("{avgrating}", $item->CustomerReviews->AverageRating, $content);	
					$content = str_replace("{reviewsnum}", $item->CustomerReviews->TotalReviews, $content);	
					$content = str_replace("{keyword}", $keywords, $content);	
					$content = str_replace("{link}", $link, $content);
					
					// rating
					if (strpos($content, "{rating}") != false) {			 
						$image = wpr_star_rating($item->CustomerReviews->AverageRating);
						$content = str_replace("{rating}",$image,$content);
					}	
					
					// reviews
					$reviewspost = "";				
					$reviewsnum = $item->CustomerReviews->TotalReviews;
					preg_match('#\{reviews(.*)\}#iU', $content, $rmatches);
					if ($rmatches[0] == false) {			
					} elseif($item->CustomerReviews->TotalReviews == 0) {
						$content = str_replace($rmatches[0],$reviewspost , $content);				
					} else {
						$reviewnum = substr($rmatches[1], 1);
						for ($i = 0; $i < $reviewnum; $i++) {
							if($i == $reviewsnum || $i == 4) {break;} else {	
								/*$image = wpr_star_rating($reviews[$i]["rating"]);
								$rtemplate = $options['wpr_aa_revtemplate'];
								//$rtemplate = str_replace("\n", "", $rtemplate);
								//$rtemplate = str_replace("\r", "", $rtemplate);
								$rtemplate = str_replace("{content}", $reviews[$i]["content"], $rtemplate);	
								$rtemplate = str_replace("{rating}", $image, $rtemplate);			
								$rtemplate = str_replace("{ratingcount}", $reviews[$i]["rating"], $rtemplate);			
								$rtemplate = str_replace("{author}", $reviews[$i]["author"], $rtemplate);*/
								$reviewspost .= $reviews[$i]["content"];
							}
						}
						$content = str_replace($rmatches[0], $reviewspost, $content);				
					}	

					if(!empty($item->LargeImage->URL)) {$largestimage = $item->LargeImage->URL;}
					elseif(!empty($item->MediumImage->URL)) {$largestimage = $item->MediumImage->URL;}
					elseif(!empty($item->SmallImage->URL)) {$largestimage = $item->SmallImage->URL;}
					
					$single = array();
					$single["unique"] = $item->ASIN;
					$single["title"] = $item->ItemAttributes->Title;
					$single["content"] = $content;	
					$single["comments"] = $reviews;	
					$single["customfield"] = $largestimage;	
					$added_post++;
					array_push($return, $single);			
					$i++;
				}
			}
			$yy++;
		}
		$page++;$cnum=0;
	}
	return $return;
}

function wpr_amazon_options_default() {
	$options = array(
		"wpr_aa_affkey" => "",
		"wpr_aa_apikey" => "",
		"wpr_aa_secretkey" => "",
		"wpr_aa_skip" => "",
		"wpr_aa_revtemplate" => "<i>Review by {author} for {link}</i>&#13;<b>Rating: {rating}</b>&#13;{content}&#13;&#13;",
		"wpr_aa_excerptlength" => "500",
		"wpr_aa_site" => "us"
	);
	return $options;
}

function wpr_amazon_options($options) {
	?>
	<h3 style="text-transform:uppercase;border-bottom: 1px solid #ccc;"><?php _e("Amazon Options","wprobot") ?></h3>
		<table class="addt" width="100%" cellspacing="2" cellpadding="5" class="editform"> 
			<tr <?php if($options['wpr_aa_affkey'] == "") {echo 'style="background:#F8E0E0;"';} ?> valign="top"> 
				<td width="40%" scope="row"><?php _e("Amazon Affiliate ID:","wprobot") ?></td> 
				<td><input size="40" name="wpr_aa_affkey" type="text" id="wpr_aa_affkey" value="<?php echo $options['wpr_aa_affkey'] ;?>"/>
				<!--Tooltip--><a class="tooltip" href="#">?<span><?php _e('This option is not required but you will only earn affiliate commission if you enter your Amazon affiliate ID.',"wprobot") ?></span></a>
			</td> 
			</tr>	
			<tr <?php if($options['wpr_aa_apikey'] == "") {echo 'style="background:#F8E0E0;"';} ?> valign="top"> 
				<td width="40%" scope="row"><?php _e("API Key (Access Key ID):","wprobot") ?></td> 
				<td><input size="40" name="wpr_aa_apikey" type="text" id="wpr_aa_apikey" value="<?php echo $options['wpr_aa_apikey'] ;?>"/>
				<!--Tooltip--><a target="_blank" class="tooltip" href="https://affiliate-program.amazon.com/gp/advertising/api/detail/main.html">?<span><?php _e('This setting is required for the Amazon module to work!<br/><br/><b>Click to get to the Amazon API sign up page!</b>',"wprobot") ?></span></a>
			</td> 
			</tr>	
			<tr <?php if($options['wpr_aa_secretkey'] == "") {echo 'style="background:#F8E0E0;"';} ?> valign="top"> 
				<td width="40%" scope="row"><?php _e("Secret Access Key:","wprobot") ?></td> 
				<td><input size="40" type="text" name="wpr_aa_secretkey" value="<?php echo $options['wpr_aa_secretkey'] ;?>"/>
				<!--Tooltip--><a target="_blank" class="tooltip" href="https://affiliate-program.amazon.com/gp/advertising/api/detail/main.html">?<span><?php _e('This setting is required for the Amazon module to work!<br/><br/><b>Click to get to the Amazon API sign up page!</b>',"wprobot") ?></span></a>
			</td> 
			</tr>				
			<tr valign="top"> 
				<td width="40%" scope="row"><?php _e("Skip Products If:","wprobot") ?></td> 
				<td>
				<select name="wpr_aa_skip" id="wpr_aa_skip">
					<option value="" <?php if ($options['wpr_aa_skip']==""){echo "selected";}?>><?php _e("Don't skip","wprobot") ?></option>
					<option value="nodesc" <?php if ($options['wpr_aa_skip']=="nodesc"){echo "selected";}?>><?php _e("No description found","wprobot") ?></option>
					<option value="noimg" <?php if ($options['wpr_aa_skip']=="noimg"){echo "selected";}?>><?php _e("No thumbnail image found","wprobot") ?></option>
					<option value="nox" <?php if ($options['wpr_aa_skip']=="nox"){echo "selected";}?>><?php _e("No description OR no thumbnail","wprobot") ?></option>
				</select>
				</td> 
			</tr>			
			<tr valign="top"> 
				<td width="40%" scope="row"><?php _e("Amazon Description Length:","wprobot") ?></td> 
				<td>
				<select name="wpr_aa_excerptlength" id="wpr_aa_excerptlength">
					<option value="250" <?php if ($options['wpr_aa_excerptlength']==250){echo "selected";}?>><?php _e("250 Characters","wprobot") ?></option>
					<option value="500" <?php if ($options['wpr_aa_excerptlength']==500){echo "selected";}?>><?php _e("500 Characters","wprobot") ?></option>
					<option value="750" <?php if ($options['wpr_aa_excerptlength']==750){echo "selected";}?>><?php _e("750 Characters","wprobot") ?></option>
					<option value="1000" <?php if ($options['wpr_aa_excerptlength']==1000){echo "selected";}?>><?php _e("1000 Characters","wprobot") ?></option>
					<option value="full" <?php if ($options['wpr_aa_excerptlength']=='full'){echo "selected";}?>><?php _e("Full Description","wprobot") ?></option>
				</select>				
				</td> 
			</tr>
			<tr valign="top"> 
				<td width="40%" scope="row"><?php _e("Amazon Website:","wprobot") ?></td> 
				<td>
				<select name="wpr_aa_site" id="wpr_aa_site">
					<option value="com" <?php if ($options['wpr_aa_site']=='com'){echo "selected";}?>>Amazon.com</option>
					<option value="uk" <?php if ($options['wpr_aa_site']=='uk'){echo "selected";}?>>Amazon.co.uk</option>
					<option value="de" <?php if ($options['wpr_aa_site']=='de'){echo "selected";}?>>Amazon.de</option>
					<option value="ca" <?php if ($options['wpr_aa_site']=='ca'){echo "selected";}?>>Amazon.ca</option>
					<option value="jp" <?php if ($options['wpr_aa_site']=='jp'){echo "selected";}?>>Amazon.jp</option>
					<option value="fr" <?php if ($options['wpr_aa_site']=='fr'){echo "selected";}?>>Amazon.fr</option>					
				</select>				
				</td> 
			</tr>		
			<tr valign="top"> 
				<td width="40%" scope="row"><?php _e("Review Template:","wprobot") ?></td> 
				<td>			
				<textarea name="wpr_aa_revtemplate" rows="2" cols="32"><?php echo $options['wpr_aa_revtemplate'];?></textarea>	
				<!--Tooltip--><a target="_blank" class="tooltip" href="http://wprobot.net/test/documentation/#33">?<span><?php _e('How the product reviews will look in posts and comments. <b>Click to see all available template tags in the documentation.</b>',"wprobot") ?></span></a>				
				</td> 
			</tr>				
		</table>	
	<?php
}

function wpr_aws_getnodename($nodeid) {

	$options = unserialize(get_option("wpr_options"));	
	$public_key = $options['wpr_aa_apikey'];
	$private_key = $options['wpr_aa_secretkey'];
	$locale = $options['wpr_aa_site'];		
	if($locale == "us") {$locale = "com";}
	if($locale == "uk") {$locale = "co.uk";}	
	$pxml = wpr_aws_request($locale, array(
	"Operation"=>"BrowseNodeLookup",
	"BrowseNodeId"=>$nodeid,
	"ResponseGroup"=>"BrowseNodeInfo"
	), $public_key, $private_key);

	if ($pxml === False) {
		return false;
	} else {
		if($pxml->BrowseNodes->BrowseNode->Name) {
			return $pxml->BrowseNodes->BrowseNode->Name;
		} else {
			return false;		
		}
	}
}

?>