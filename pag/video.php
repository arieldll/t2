<?php 
	lb();
?>
<div class="infoclass">
	<div style='margin-top: 5px'>Hello guy or girl! You can start finding by yourself! Find to like <i>"music, by artist"</i></div>
</div>
<form action="?p=video" method="post">
	<div class='title'>Find by</div>
	<div class='text-content'>
		<input type="text" name="find" value="<?php echo isset($_POST["find"])?$_POST["find"]:""?>" class='field' id='searchField' />
		<br />
		<center>
			<input type="submit" value="FIND NOW!" class="button" />
			<input type="reset" value="CLEAR" class="button" />
		</center>
	</div>
</form>
<?php
	if(isset($_POST["find"]) && $_POST["find"]){
		$string = $_POST["find"];
		$string = explode(',', $string);
		$artist = ' '.$string[1];
		$music = $string[0];
		$words_artist = explode(' ', $artist);
		$yesby=false;
		$real_words = "";
		foreach($words_artist as $wx){
			if($yesby){
				$real_words.= $wx.' ';
			}
			if(trim($wx)=='by'){
				$yesby=true;
			}
		}
		$artist = substr($real_words, 0, -1);
		echo "
		<div class='title'>Artist </div>
		<div class='text-content'>$artist</div>
		<div class='title'>Music</div>
		<div class='text-content'>$music</div>";
		
		
		//$artist = str_replace(' ', '%20', $artist);
		//$music = str_replace(' ', '%20', $music);
		/*$artist = str_replace('&', 'e', $artist);
		$music = str_replace('&', 'e', $music);*/
		$artist = urlencode($artist);
		$music = urlencode($music);
		//get music from letras.mus.br
		/*$artist = str_replace(' ', '%20', $artist);
		$music = str_replace(' ', '%20', $music); */
		$url_datamusic = "http://www.vagalume.com.br/api/search.php?art=$artist&extra=ytid&mus=$music";		
		$datamusic = curl_init();
		curl_setopt($datamusic, CURLOPT_URL, $url_datamusic);
		//curl_setopt($datamusic, CURLOPT_HTTPHEADER,array ("Content-Type: text/xml; charset=utf-8"));
		curl_setopt($datamusic, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($datamusic, CURLOPT_FOLLOWLOCATION, true);
		$response_code = curl_getinfo($datamusic, CURLINFO_HTTP_CODE);
		$result_music = curl_exec($datamusic);
		curl_close($datamusic);
		$result_music = str_replace('\n', '<br />', $result_music);
		$rsm = json_decode($result_music);
		//print_r($rsm);
		
		/*if($rsm->{'captcha'}){
			echo $rsm->{'serial'};
		} */
		//echo '<br /><br />';
		//print_r($rsm->{'mus'});
		if($rsm->{'type'}!='notfound'){
			$content_field = "<div class='title'>Lyrics</div><div class='text-content'>".str_replace('\n', '<br />', $rsm->{'mus'}[0]->{'text'})."</div>";
			$content_field.= "<div class='title'>URL</div>
			<div class='text-content'><a href='".$rsm->{'mus'}[0]->{'url'}."'>Music ".$rsm->{'mus'}[0]->{'url'}."</a></div>";
			if(isset($rsm->{'mus'}[0]->{'translate'})){
				$content_field.="<div class='title'>Translate</div><div class='text-content'>".$rsm->{'mus'}[0]->{'translate'}[0]->{'text'}."</div>";
			}
			if(isset($rsm->{'mus'}[0]->{'ytid'})) $linkyt = ($rsm->{'mus'}[0]->{'ytid'});
		}else $content_field = "<div class='title'>This Lyrics not found</div>";
		
		if(!isset($linkyt) && !strlen($linkyt)){
			
			$url = "https://gdata.youtube.com/feeds/api/videos?q=$music-+$artist&orderby=relevance&start-index=5&max-results=3&v=1&strict=true";
			//echo $url;
			$data = simplexml_load_file($url);
			if(isset($data)) foreach($data as $dat){
				$url_video = explode('&', $dat->link['href']);
				$url_video[0] = str_replace('&', '', $url_video[0]);
			}
			$linkyt = str_replace('watch?v=', 'embed/', $url_video[0]);
			$linkyt = str_replace('https://', 'http://', $linkyt);
			if($linkyt=="") unset($linkyt);
		
		}else $linkyt="http://www.youtube.com/embed/$linkyt";
		?>
		<div style="margin-top: 20px;">
			<div style="width: 955px; margin-left: auto; margin-right: auto; ">
				<?php 
					if(!isset($linkyt) && !strlen($linkyt)){
						echo "<div class='title'>This video not found</div>"; 
					}else{
				?>
						<iframe style="opacity: none; " width="950" height="375" src="<?php echo $linkyt; ?>" frameborder="0" allowfullscreen></iframe>
				<?php 
					}
				?>
			</div>
		</div>
		<div>
			<?php
				echo $content_field;
				if($linkyt)	echo "<div class='text-content'><a href='$linkyt'>YouTube $linkyt</a></div>";
				
				//get info by last.fm
				@$xml_artist = simplexml_load_file("http://ws.audioscrobbler.com/2.0/?method=artist.getinfo&artist=$artist&api_key=fab950d5c6bbffc60827cffbef32de94");
				if($xml_artist->{'artist'}->{'name'}){
					echo "<div class='title'>ARTISTIC NAME: ".$xml_artist->{'artist'}->{'name'}."</div>";
					$images = $xml_artist->{'artist'}->{'image'};
					echo "<div class='text-content'><img src='$images[1]' title='artist' alt='artist' /></div>";
					echo "<div class='text-content'><a href='".$xml_artist->{'artist'}->{'url'}."'>Page on Last.fm</a></div>";
				}
		?>
		</div>
	<?php
	}
		?>
	<script type="text/javascript">
		document.getElementById('searchField').focus();
	</script>
