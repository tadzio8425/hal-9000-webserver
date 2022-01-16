<!DOCTYPE html>

<html lang="es">

    <head>
        <title>Hal-9000</title>

          <!-- add icon link -->
          <link rel = "icon" href = "./sources/hal9000_logo.png" type = "image/x-icon">
          <link rel="apple-touch-icon" href="./sources/hal9000_logo_red.png">

          <!-- add stylesheet link -->
          <link href="./style/style2.css" rel="stylesheet" type="text/css">
          <!--JavaScript File link-A-->
          <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"></script>
          <script type="text/javascript" src="./scripts/interaction2.js" defer></script>
          <script type="text/javascript" src="./scripts/smoothscroll-polyfill.js" defer></script>


          <!--Fonts!-->
          <link rel="preconnect" href="https://fonts.googleapis.com">
          <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
          <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@600&display=swap" rel="stylesheet">

        <!--Metadata--> 
          <meta property="og:site_name" content="Hal-9000">
          <meta property="og:title" content="Hal-9000 Server HomePage" />
          <meta property="og:description" content="Service management and monitoring" />
          <meta property="og:image" itemprop="image" content="https://images-ext-1.discordapp.net/external/WEI4P17riS_R98taKAYOE3QmKU_ZVAcNKlOYn7nooGg/https/img.pngio.com/hal-icon-65700-free-icons-library-hal-png-1600_1600.jpg?width=256&height=256">
          <meta property="og:type" content="website" />
          <meta property="og:updated_time" content="1440432930" />

          <meta content="width=device-width, initial-scale=1" name="viewport" />

          <script>

            function promptPassword(actualStatus,serviceName){

            var serviceId;
            var dockerService = "false";

            var passwd = prompt("Are you sudo?");

            var futureCommand;
            
            //Defines the next state of the service
            if (actualStatus=="active"){
                futureCommand="stop";
            }
            else if (actualStatus=="inactive"){
                futureCommand="start";
            }


            //Affects a specific service
            if (serviceName=="discord"){
                  serviceId = "hal9000.service";
                  dockerService="false";

            }

            else if(serviceName=="voice"){
                   serviceId = "HalJar.service";
                   dockerService="false";
            }

            else if(serviceName=="portainer"){
                    serviceId = "portainer";
                    dockerService="true";
            }
            
            else if(serviceName=="radarr"){
                    serviceId = "radarr";
                    dockerService="true";

            }

            else if(serviceName=="plex"){
                    serviceId = "plex";
                     dockerService="true";

            }

            else if(serviceName=="deluge"){
                     serviceId = "deluge";
                     dockerService="true";

            }

            else if(serviceName=="jackett"){
                     serviceId = "jackett";
                     dockerService="true";

            }

            if(passwd !== null){
            $.ajax(
                {
                    type: "POST",
                    url: "./scripts/passwd.php",
                    data: {'passwd': passwd, "serviceId":serviceId, "futureCommand": futureCommand, "dockerService":dockerService},
                    success: function(data)
                    {
                        console.log(data);
                        location.reload();
                    }
                });};





} </script>
          

    </head>

    <body>

        <header>


            <div class="background-header"></div>

            

            <nav>

                

                <!--HAL IMAGE-->
                <div class="top-header">

                    <img class = "three-line-button" id="hamburguer" src="./sources/three-horizontal-lines.svg" alt="Three line mobile menu">

                    <img src = "./sources/hal9000_logo.png" alt="Hal-9000">
                    <!--SECRET BLUE HAL IMAGE-->
                    <img class = "secret" src = "./sources/hal9000_bluelogo.png" alt="Hal-9000">

                    <h1>Hal-9000</h1>


                </div>


                <div id="left-nav">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="https://hal9000-server-portainer.loca.lt/" target="_blank">Portainer</a></li> 
                </ul></div>

                <div id="right-nav">
                <ul>
                    <li><a href = "https://hal9000-server-radarr.loca.lt/" target="_blank">Radarr</a></li>
                    <li><a href = "./extras.php">Extras</a></li>
                </ul></div>



            </nav>

        </header>


        <!--Hidden Mobile Menu-->
        <div class = "fade-menu" id = "mobile-menu">
            <nav>
                <h2 id="service-status-button">Service Status</h2>
                <h2 id="media-board-button">Media Board</h2>
                <h2 id="feed-button">Feed</h2>
            </nav>
        </div>



        <main>

            <section id="left-section">

                <h2>Service Status</h2>
                
               <!--Discord Button---->
                <?php
                    $discordBot_status = shell_exec('systemctl show -p ActiveState hal9000 --value');
                    $discordBot_status = preg_replace('/[\x00-\x1F\x7F]/', '', $discordBot_status);
                    if (strcmp($discordBot_status, "active") == 0):
                        { ?>
                            <img onclick="promptPassword('active','discord')" class = "service-button" id="discord-button-activo" src="./sources/Discord bot activo.svg" alt="Discord bot logo and service activation">
                            <?php }
                    else:
                        { ?>
                         <img onclick="promptPassword('inactive','discord')"  class = "service-button" id="discord-button-inactivo" src="./sources/Discord bot inactivo.svg" alt="Discord bot logo and service activation">
                        <?php }
                    putenv('PATH=/usr/bin');
                    endif;
                ?> 

                <!--Voice Button---->
                <?php
                    $voice_status = shell_exec('systemctl show -p ActiveState HalJar --value');
                    $voice_status = preg_replace('/[\x00-\x1F\x7F]/', '', $voice_status);
                    if (strcmp($voice_status, "active") == 0):
                        { ?>
                            <img onclick="promptPassword('active','voice')" class = "service-button" id="voice-button-activo" src="./sources/Voice activo.svg" alt="Voice logo and service activation">
                            <?php }
                    else:
                        { ?>
                         <img onclick="promptPassword('inactive','voice')" class = "service-button" id="voice-button-inactivo" src="./sources/Voice inactivo.svg" alt="Voice logo and service activation">
                        <?php }
                    putenv('PATH=/usr/bin');
                    endif;
                ?>

                <!--Portainer Button-->
                <?php
                    $portainer_status = shell_exec('docker inspect portainer --format "{{.State.Running}}"');
                    $portainer_status = preg_replace('/[\x00-\x1F\x7F]/', '', $portainer_status);
                    if (strcmp($portainer_status, "true") == 0):
                        { ?>
                            <img onclick="promptPassword('active','portainer')" class = "service-button" id="portainer-button-activo" src="./sources/Portainer activo.svg" alt="Portainer logo and service activation">
                            <?php }
                    else:
                        { ?>
                         <img onclick="promptPassword('inactive','portainer')" class = "service-button" id="portainer-button-inactivo" src="./sources/Portainer inactivo.svg" alt="Portainer logo and service activation">
                        <?php }
                    putenv('PATH=/usr/bin');
                    endif;
                ?>

                <!--Radarr Button-->
                <?php
                    $radarr_status = shell_exec('docker inspect radarr --format "{{.State.Running}}"');
                    $radarr_status = preg_replace('/[\x00-\x1F\x7F]/', '', $radarr_status);
                    if (strcmp($radarr_status, "true") == 0):
                        { ?>
                            <img onclick="promptPassword('active','radarr')" class = "service-button" id="radarr-button-activo" src="./sources/Radarr activo.svg" alt="Radarr logo and service activation">
                            <?php }
                    else:
                        { ?>
                         <img onclick="promptPassword('inactive','radarr')" class = "service-button" id="radarr-button-inactivo" src="./sources/Radarr inactivo.svg" alt="Radarr logo and service activation">
                        <?php }
                    putenv('PATH=/usr/bin');
                    endif;
                ?>

                <!--Plex Button-->
                <?php
                    $plex_status = shell_exec('docker inspect plex --format "{{.State.Running}}"');
                    $plex_status = preg_replace('/[\x00-\x1F\x7F]/', '', $plex_status);
                    if (strcmp($plex_status, "true") == 0):
                        { ?>
                            <img onclick="promptPassword('active','plex')" class = "service-button" id="plex-button-activo" src="./sources/Plex activo.svg" alt="Plex logo and service activation">
                            <?php }
                    else:
                        { ?>
                         <img onclick="promptPassword('inactive','plex')" class = "service-button" id="plex-button-inactivo" src="./sources/Plex inactivo.svg" alt="Plex logo and service activation">
                        <?php }
                    putenv('PATH=/usr/bin');
                    endif;
                ?>
                
                <!--Deluge-->
                <?php
                    $deluge_status = shell_exec('docker inspect deluge --format "{{.State.Running}}"');
                    $deluge_status = preg_replace('/[\x00-\x1F\x7F]/', '', $deluge_status);
                    if (strcmp($deluge_status, "true") == 0):
                        { ?>
                            <img onclick="promptPassword('active','deluge')" class = "service-button" id="deluge-button-activo" src="./sources/Deluge activo.svg" alt="Deluge logo and service activation">
                            <?php }
                    else:
                        { ?>
                         <img onclick="promptPassword('inactive','deluge')" class = "service-button" id="deluge-button-inactivo" src="./sources/Deluge inactivo.svg" alt="Deluge logo and service activation">
                        <?php }
                    putenv('PATH=/usr/bin');
                    endif;
                ?>

                <!--Jackett-->
                <?php
                    $jackett_status = shell_exec('docker inspect jackett --format "{{.State.Running}}"');
                    $jackett_status = preg_replace('/[\x00-\x1F\x7F]/', '', $jackett_status);
                    if (strcmp($jackett_status, "true") == 0):
                        { ?>
                            <img onclick="promptPassword('active','jackett')" class = "service-button" id="jackett-button-activo" src="./sources/Jackett activo.svg" alt="Jackett logo and service activation">
                            <?php }
                    else:
                        { ?>
                         <img onclick="promptPassword('inactive','jackett')" class = "service-button" id="jackett-button-inactivo" src="./sources/Jackett inactivo.svg" alt="Jackett logo and service activation">
                        <?php }
                    putenv('PATH=/usr/bin');
                    endif;

                ?>

                
                </section>

            <section id="centered-section">
                <h2>Media Board</h2>

                <!--Song of the day!-->
                <div class = "sub-section" id="song-spotlight">

                <?php
                    $command = escapeshellcmd("python3 scripts/SpotlightSong/SpotlightSong.py");
                    $song_code = shell_exec($command);

                    {?>
                    <iframe src="https://open.spotify.com/embed/track/<?php echo $song_code ?>" width="100%" height="80" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
                    <?php }
                    
                ?>

                </div>

                
                <!--Frame of the day!-->
                <div class = "sub-section" id="frame">
                    <img src="./sources/frameOfTheDay/frameOfTheDay.jpg"/>
                </div>

                <div class = "sub-title">
                <?php

                $handle = fopen("./sources/frameOfTheDay/frameInfo.csv", "r");
                $csv = fgetcsv($handle);
                $csv = fgetcsv($handle);
                $film_title = $csv[0];

                {?>
                    <p> <?php echo $film_title ?> </p>
                    <?php }

                ?>
                </div>


            </section>
            <section id="right-section">
                <h2>Feed</h2>

                <a class="twitter-timeline" href="https://twitter.com/tadzio8425?ref_src=twsrc%5Etfw" data-chrome="noheader transparent">Tweets by tadzio8425</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

            </section>

            
        </main>


        <footer>
            <ul>
                <li>Coded and designed by <em>t4dzi0</em></li>
                <li>juanse8425@gmail.com</li>
                <li>@tadzio8425</li>
                <li>Bogota D.C</li>

            </ul>


            
        </footer>


    </body>

</html>