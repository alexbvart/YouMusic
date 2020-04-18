<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,800&display=swap" rel="stylesheet">
    <link rel="icon" type="" sizes="32x32" href="img/fondos/olas/olas.jpg">
    <link rel="stylesheet" href="css/estilos.css">
    <!--load all styles -->

    <title>YouMusic</title>
</head>

<body>
    <div class="page">

            <?php
            
            include 'php/logica/conexion.php';
            

            
            
            $generos=mysqli_query($conexion,"Select * from generos");
            
            $anno=mysqli_query($conexion,"Select * from anno");
        //  $regiones=mysqli_query($conexion,"Select * from regiones");
            include 'php/frames/header.php';

            ?>

            <section class="top-list">
                <div class="top display-center">
                <div class="top">
                   
                        <div class="bandera">
                            <img src="img/top.jpg" alt="">
                        </div>
                        <div class="letras">
                            <h4 class="titulo"> Top Perú</h4> <br>
                            <p>100 numbers <span> <br>& 17920 fans</span></p>
                        </div>
                   </div>
                </div>
                <div class="list display-center">
                    <div class="list">
                        <h4>Lo mas escuchado</h4>
                        <ul class="tracklist">
                            <?php
                            $top=mysqli_query($conexion,'
                            select 
                                c.nombrecancion as cancion,
                                a.nombreartista as artista,
                                a.artistaId,
                                c.reproduccionesCancion as reproduccion
                            from cancion as c
                                JOIN artista as a
                                    on a.artistaId = c.artistaId
                            order by reproduccionesCancion  DESC LIMIT 5
                            ');
                            $contadorTop=1;
                            while($iTop=mysqli_fetch_array($top)){
                            echo'
                                <li class="track ellipsis">
                                    <div class="track-number">0'.$contadorTop.'</div>
                                    <div class="heading-5"><a role="button">'.$iTop['cancion'].'</a>
                                        <a href="php/pages/artista.php?idartista='.$iTop['artistaId'].'"
                                        class="artista">
                                            '.$iTop['artista'].'</a>
                                    </div>
                                </li>
                            ';
                                $contadorTop++;}
                            ?>
                        </ul>
                    </div>
                </div>
            </section>

            
            <section class="generos ">
                <div class="titulog titulo" >Escucha un poco de:</div>

                <ul class="contenedor">

                    <?php

                $bgg=1;
                    while ($iGeneros=mysqli_fetch_array($generos)) {
                        
                        echo'
                            <a href="php/pages/generos.php?generosID='.$iGeneros['generosId'].'" class="contenedor-hijo">
                                <figure class="img-flex">
                                    <div class="picture display-center bgg'.$bgg.'">
                                        <p class=" titulo">
                                        '.$iGeneros['nombregeneros'].'
                                        </p>
                                    </div>
                                </figure>
                            </a>                  
                        ';
                        $bgg++;
                    }

                ?>

                </ul>

            </section>


            <!-- <audio controls src="music/Un-Peso-(feat.-Bad-Bunny-Marciano-Cantero).mp3"></audio> -->

            <section class="album ">
                <div class="titulo">Escucha tus albumes favoritos:</div>
                <ul class="contenidoCcuadro">

                    <?php
                    $album=mysqli_query($conexion,"
                              
                        Select 
                        a.albumid,
                        a.nombrealbum ,
                        a.nombreImagenAlbum ,
                        ar.nombreartista,
                        ar.artistaId,
                        ar.nombreImagenArtista
                               from album as a
                        join cancion as c
                            on c.albumId=a.albumId
                        join artista as ar
                            on ar.artistaId=c.artistaId
                            
                            group by a.albumId,ar.nombreartista,ar.nombreImagenArtista,ar.artistaId"
                    );

                    while ($iAlbum=mysqli_fetch_array($album)) {
                         // <img src="img/canciones/'.$iAlbum['nombreImagenArtista'].'/'.$iAlbum['nombreImagenCancion'].'.jpg" alt="" crossorigin="anonymous" width="264" height="264">
                         //<img src="img/albumes/'.$iAlbum['nombreImagenAlbum'].'.jpg" alt="" crossorigin="anonymous" width="264" height="264">
                         
                    echo'
                        <li class="cuadrito">
                                <figure>
                                    <a href="php/pages/album.php?idalbum='.$iAlbum['albumid'].'">
                                    <img src="img/albumes/'.$iAlbum['nombreImagenAlbum'].'.jpg" alt="" crossorigin="anonymous" width="264" height="264">
                                    </a>
                                    
                                </figure>
                                <div class="caption">
                                    <div>
                                        <a href="php/pages/album.php?idalbum='.$iAlbum['albumid'].'">
                                        '.$iAlbum['nombrealbum'].'</a>
                                    </div>
                                    <div>
                                        <a href="php/pages/artista.php?idartista='.$iAlbum['artistaId'].'">
                                        '.$iAlbum['nombreartista'].'</a>
                                    </div>
                                </div>
                            </li> 
                    
                    ';
                     
                }
            ?>

                </ul>
            </section>

<script src="js/reproductor.js"></script>

</body>

</html>