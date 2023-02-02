<!DOCTYPE html>
<?php
	// Parametros
	$v_titulo = $_GET["titulo"];
	$v_texto = $_GET["texto"];
	$v_width = $_GET["width"];
	$v_height = $_GET["height"];
	$v_videosDiretorio = scandir(getcwd(), SCANDIR_SORT_ASCENDING);
	$v_videos = Array();
	foreach($v_videosDiretorio as $obj)
	{
		if (strpos($obj, ".mp4") > 0)
		{
			array_push($v_videos, $obj);
		}
	}
?>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>
			<?php
				// Titulo da janela
				echo $v_titulo;
			?>
		</title>
	</head>
		<body bgcolor="black" align="center">
			<div id="videoContainer" style="display:inline-block"></div>
			<br>
				<?php
					// Texto dos videos
					echo $v_texto;
				?>
			<script>

				var videoContainer = document.getElementById("videoContainer");
				var output = document.getElementById("output");
				var nextVideo;
				var videoObjects =
				[
					<?php
						// Criar os elementos
						$v_objetos = Array();
						foreach($v_videos as $obj)
						{
							array_push($v_objetos, 'document.createElement("video")');
						}
						echo implode(',' . PHP_EOL . '					', $v_objetos) . PHP_EOL;
					?>
				];
				var vidSources =
				[
					<?php
						// Lista de videos
						$v_objetos = Array();
						foreach($v_videos as $obj)
						{
							array_push($v_objetos, '"./' . $obj . '"');
						}
						echo implode(',' . PHP_EOL . '					', $v_objetos) . PHP_EOL;
					?>
				];
				var nextActiveVideo = 0;
				<?php
					// Inicializacao
					$v_objetos = Array();
					$i = 0;
					foreach($v_videos as $obj)
					{
						array_push($v_objetos, 'videoObjects[' . $i . '].inx = ' . $i . ';');
						array_push($v_objetos, 'initVideoElement(videoObjects[' . $i . ']);');
						if ($i == 0)
						{
							array_push($v_objetos, 'videoObjects[' . $i . '].autoplay = true;');
							array_push($v_objetos, 'videoObjects[' . $i . '].src = vidSources[nextActiveVideo];');
							array_push($v_objetos, 'videoContainer.appendChild(videoObjects[' . $i . ']);');
						}
						else
						{
							array_push($v_objetos, 'videoObjects[' . $i . '].style.display = "none";');
							array_push($v_objetos, 'videoContainer.appendChild(videoObjects[' . $i . ']);');
						}
						$i++;						
					}
					echo implode(PHP_EOL . '				', $v_objetos) . PHP_EOL;
				?>

				function initVideoElement(video)
				{
					video.playsinline = true;
					video.muted = false;
					video.controls = true;
					video.preload = 'auto'; //nao ligar autoplay, pois ele deleta o preload
					video.width = <?php echo $v_width; ?>;
					video.height = <?php echo $v_height; ?>;			
					video.onplaying = function(e)
					{
						nextActiveVideo = ++nextActiveVideo;
						if(nextActiveVideo >= vidSources.length)
						{
							nextActiveVideo = 0;
						}
						if(this.inx == 0)
						{
							nextVideo = videoObjects[1];
						}
						else
						{
							nextVideo = videoObjects[0];
						}
						nextVideo.src = vidSources[nextActiveVideo];
						nextVideo.controls;
						nextVideo.width = <?php echo $v_width; ?>;
						nextVideo.height = <?php echo $v_height; ?>;
						nextVideo.pause();
					};

					video.onended = function(e)
					{
						this.style.display = "none";
						nextVideo.style.display = "block";
						nextVideo.play();
					};
				}

			</script>
		</body>
	</html>
	<!-- Qualquer duvida, procurar o Joao Paulo Veiga da Friopecas TI Sistemas -->
<?php

?>
