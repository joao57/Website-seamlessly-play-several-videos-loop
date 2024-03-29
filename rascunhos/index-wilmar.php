<?php
    // PEGA PARÂMETRO COM NOME DA LOJA
    $loja = strtolower($_GET['loja']);
    // MONTA DIRETORIO ONDE DEVERÃO CONTER OS VÍDEOS
    $dir = ".//tv//".$loja."//";    
    // LÊ ARQUIVOS DENTRO DA PASTA E REMOVE OS PONTOS
    $listDiretorio = array_diff(
        scandir($dir),
        ['.', '..']
    );
?>

<!-- PARA O CÓDIGO FUNCINAR em qualquer TV com qualquer vídeo, apenas siga 3 passos, 
    contidos nas linhas: 32, 69, 93 -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>App TV Friopecas</title>

<body  >

<div id="videoContainer" style="display:inline-block"></div>
<br>
<!-- 
    bgcolor="write" align="center"
    CASO QUEIRA ADICIONAR ALGUM TEXTO abaixo do vídeo, é aqui:

    <b id="output" style="color: white; vertical-align:top"></b> 
-->

<script>
   
var videoContainer = document.getElementById('videoContainer'),
    output = document.getElementById('output'),
    nextVideo,
    videoObjects =
    [
        document.createElement('video'),
        document.createElement('video')
    ],
    vidSources = "<?php echo $listDiretorio; ?>";
    console.log(vidSources);
    //[
        // *****AQUI DECLARA OS VÍDEOS*****
        // "./assets/video4.mp4",
        // "./assets/video5.mp4"
        // "http://www.w3schools.com/html/movie.mp4",
        // "http://www.w3schools.com/html/mov_bbb.mp4",
        // "http://www.w3schools.com/html/movie.mp4",
        // "http://www.w3schools.com/html/mov_bbb.mp4",
        // "http://www.w3schools.com/html/movie.mp4"
        
        // essa lista você pode adicionar ou acrescentar vídeos SEM QUALQUER MUDANÇA NO CÓDIGO.
    //],
    nextActiveVideo = 0;

videoObjects[0].inx = 0; //setar o index
videoObjects[1].inx = 1;

initVideoElement(videoObjects[0]);
initVideoElement(videoObjects[1]);

videoObjects[0].autoplay = true;
videoObjects[0].src = vidSources[nextActiveVideo];

videoContainer.appendChild(videoObjects[0]);

videoObjects[1].style.display = 'none';
videoContainer.appendChild(videoObjects[1]);

function initVideoElement(video)
{
    video.playsinline = true;
    video.muted = false;
    video.controls = true;
    video.preload = 'auto'; // não ligar autoplay, pois ele deleta o preload
    // *****abaixo, LOCAL 1/2 ONDE DEVE SER ALTERA A RESOLUÇÃO PARA RESOLUÇÃO DA TV*****
    video.width = 1080;
    video.height = 600;
    
    //loadedmetadata não é correto pois se usar esse comando o resultado é um loop infinito

    video.onplaying = function(e)
    {
        nextActiveVideo = ++nextActiveVideo;

        // fiz o console log abaixo para conferir a sequência das URLs
        // console.log(video.src);

        if(nextActiveVideo >= vidSources.length)
            nextActiveVideo = 0;

        //subistitua os elementos do vídeo mais uma vez:
        if(this.inx == 0)
            nextVideo = videoObjects[1];
        else
            nextVideo = videoObjects[0];

        nextVideo.src = vidSources[nextActiveVideo];
        nextVideo.controls;
        // *****abaixo, LOCAL 2/2 ONDE DEVE SER ALTERA A RESOLUÇÃO PARA RESOLUÇÃO DA TV*****
        nextVideo.width = 1080;
        nextVideo.height = 600;
        nextVideo.pause();
    };

    video.onended = function(e)
    {
        this.style.display = 'none';
        nextVideo.style.display = 'block';
        nextVideo.play();
    };
}

</script>
</body>
</html>

<!-- Qualquer dúvida, procurar o João Paulo Veiga da Friopecas TI Sistemas -->
