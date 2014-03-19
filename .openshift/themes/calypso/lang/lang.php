<?php ?>
<?php
	if ( function_exists( 'ot_get_option') ) {
		$language = ot_get_option( 'language'); 
	}
?>
<!-- English -->
<?php if(($language == '') || ($language == 'english(us)')) { ?>
<?php include("us.php"); ?>

<!-- English (UK) -->
<?php } else if($language == 'english(uk)'){ ?>
<?php include("uk.php"); ?>

<!-- German -->
<?php } else if($language == 'german(de)'){ ?>
<?php include("de.php"); ?>

<!-- French -->
<?php } else if($language == 'french(fr)'){ ?>
<?php include("fr.php"); ?>

<!-- Italian -->
<?php } else if($language == 'italian(it)'){ ?>
<?php include("it.php"); ?>

<!-- Spanish -->
<?php } else if($language == 'spanish(sp)'){ ?>
<?php include("sp.php"); ?>
<?php } else { ?>
<?php } ?>