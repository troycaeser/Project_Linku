<?php

	//get manifest
	$manifest = json_decode(file_get_contents("../bin/chisholm_gamon/manifest.json"), true);
	$logo_margin_x = $manifest['main']['logo']['margin_x'];
	$logo_margin_y = $manifest['main']['logo']['margin_y'];
	
?>