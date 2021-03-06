<?php
	// require 'download.php';
	// include 'json.php';

	$reqUrl = $_POST['input_url'];

	if(isset($reqUrl)){
		// $reqUrl = $_POST['url'];
		// $reqUrl = $_POST['input_url'];
		
		//create a new folder based on the url
		$folder_name = substr(strstr($reqUrl,'au/'),3);
		if(file_exists ($folder_name)):
			else:
			mkdir ("../temp/".$folder_name, 0777);
		endif;
		
		//need to call some awesome url search function here
		$links = getPageLink($reqUrl);
		$img_links = getImgLinks($links);
		$modified_links;

		$i = 0;
		//filter & download
		foreach ($img_links as $cacheLink){
			$i++;

			$front = substr($cacheLink,0,26);
			$end = substr($cacheLink,33);
			$final = $front."/800x600/".$end;
			$modified_links[$i] = $final;

			// echo "<br />";
			// download_img($final, $name, $i);
		}
		echo json_encode($modified_links);
	}

	//Provides an Array of Links
	function getPageLink($url){
		set_time_limit(0);
		$html=file_get_contents($url);
		preg_match_all("/<a(s*[^>]+s*)href=([\"|']?)([^\"'>\s]+)([\"|']?)/ies",$html,$out);
		$arrLink=$out[3];
		$arrUrl=parse_url($url);
		$dir='';
		if(isset($arrUrl['path'])&&!empty($arrUrl['path'])){
			$dir=str_replace("\\","/",$dir=dirname($arrUrl['path']));
			if($dir=="/"){
				$dir="";
			}
		}
		if(is_array($arrLink)&&count($arrLink)>0){
			$arrLink=array_unique($arrLink);
			foreach($arrLink as $key=>$val){
				$val=strtolower($val);
				if(preg_match('/^#*$/isU',$val)){
					unset($arrLink[$key]);
				}elseif(preg_match('/^\//isU',$val)){
					$arrLink[$key]='http://'.$arrUrl['host'].$val;
				}elseif(preg_match('/^javascript/isU',$val)){
					unset($arrLink[$key]);
				}elseif(preg_match('/^mailto:/isU',$val)){
					unset($arrLink[$key]);
				}elseif(!preg_match('/^\//isU',$val)&&strpos($val,'http://')===FALSE){
					$arrLink[$key]='http://'.$arrUrl['host'].$dir.'/'.$val;
				}
			}
		}

		$matched = preg_grep('~(photogal)~i', $arrLink);
		$matched_key = key($matched);

		$photogal_link = $matched[$matched_key];

		// sort($arrLink);
		return $photogal_link;
	}

	//Provides an Array of Image Src
	function getImgLinks($url){
		set_time_limit(0);
		$html=file_get_contents($url);
		preg_match_all("/<img(s*[^>]+s*)src=([\"|']?)([^\"'>\s]+)([\"|']?)/ies",$html,$out);
		$arrLink=$out[3];
		$arrUrl=parse_url($url);
		$dir='';
		if(isset($arrUrl['path'])&&!empty($arrUrl['path'])){
			$dir=str_replace("\\","/",$dir=dirname($arrUrl['path']));
			if($dir=="/"){
				$dir="";
			}
		}
		if(is_array($arrLink)&&count($arrLink)>0){
			$arrLink=array_unique($arrLink);
			foreach($arrLink as $key=>$val){
				$val=strtolower($val);
				if(preg_match('/^#*$/isU',$val)){
					unset($arrLink[$key]);
				}elseif(preg_match('/^\//isU',$val)){
					$arrLink[$key]='http://'.$arrUrl['host'].$val;
				}elseif(preg_match('/^javascript/isU',$val)){
					unset($arrLink[$key]);
				}elseif(preg_match('/^mailto:/isU',$val)){
					unset($arrLink[$key]);
				}elseif(!preg_match('/^\//isU',$val)&&strpos($val,'http://')===FALSE){
					$arrLink[$key]='http://'.$arrUrl['host'].$dir.'/'.$val;
				}
			}
		}
		
		$matched[] = preg_grep('~(65x48)~i', $arrLink);
		$matched_key = key($matched);

		$photogal_link = $matched[$matched_key];

		// sort($arrLink);
		return $photogal_link;
	}

?>