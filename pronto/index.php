<!DOCTYPE html> 
<html> 
    <body> 
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <video id="myVideo" width="320" height="176" controls autoplay mute>
            <source src="bh/1.mp4" type="video/mp4">
            <source src="bh/1.mp4" type="video/ogg">
            Your browser does not support HTML5 video.
        </video>

        <script>
            
            function play(arr, i, tam){                
                setTimeout(
                    function () {
                        var vid = document.getElementById("myVideo");
                        var duracao = vid.duration;                    
                        vid.addEventListener('timeupdate', function (event) {
                            if(vid.currentTime === duracao){
                                $('#myVideo').attr('src', arr[i]);
                            }
                        });                    

                    }
                , 1000);
               
                if(i === (tam-1)){
                    window.location.reload();
                }else{
                   play(arr, i++, tam);
                }
            
            }
            

            // CRIA ARRAY COM NOME DE VIDEOS DA PASTA LOCAL
            var arr = [];
            arr.push('bh/2.mp4');
            arr.push('bh/1.mp4');
            arr.push('bh/3.mp4');
            
            // DECLARA INCREMENTO
            var i = 0;
            
            // PEGA TAMANHO DO ARRAY
            var tam = arr.length;
            
            //INICIA REPRODUCAO DE PRIMEIRO VIDEO
            play(arr, i, tam);
                
            
            
            
            
            

        </script> 



    </body> 
</html>
