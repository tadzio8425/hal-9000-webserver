<!DOCTYPE html>

<html lang="es">

    <head>
        <title>Hal-9000</title>

          <!-- add icon link -->
          <link rel = "icon" href = "./sources/hal9000_logo.png" type = "image/x-icon">

          <!-- add stylesheet link -->
          <link href="./style/stylee.css" rel="stylesheet" type="text/css">
          <!--JavaScript File link-A-->
          <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"></script>

        <!--Metadata--> 
          <meta property="og:site_name" content="Hal-9000">
          <meta property="og:title" content="Hal-9000 Server HomePage" />
          <meta property="og:description" content="Service management and monitoring" />
          <meta property="og:image" itemprop="image" content="https://images-ext-1.discordapp.net/external/WEI4P17riS_R98taKAYOE3QmKU_ZVAcNKlOYn7nooGg/https/img.pngio.com/hal-icon-65700-free-icons-library-hal-png-1600_1600.jpg?width=256&height=256">
          <meta property="og:type" content="website" />
          <meta property="og:updated_time" content="1440432930" />

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
                });





} </script>
          

    </head>

    <body>

        <header>


            <div class="background-header"></div>

            

            <nav>
                <!--HAL IMAGE-->
                <div class="top-header">
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
                    <li><a>Extras</a></li>
                </ul></div>



            </nav>

        </header>

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
                
                </section>

            <section id="centered-section">
                <h2>Media Board</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin accumsan orci at quam laoreet tincidunt. In nunc purus, tempor eget gravida vel, sagittis in felis. Vestibulum vel euismod est, eget eleifend nisi. Donec posuere malesuada risus a facilisis. Sed faucibus sapien quis orci maximus, a tincidunt sem pharetra. Pellentesque lobortis nisi nec elit posuere, eget eleifend lectus sagittis. Nullam sed lorem turpis. Sed vulputate aliquam purus, id euismod lorem porta et. Nunc in feugiat metus, quis bibendum leo. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam non lacus vel magna consectetur condimentum.

                    In ut massa ut enim gravida accumsan vel in ex. Morbi consequat ultricies scelerisque. Integer lobortis pretium elit, id pretium lectus hendrerit nec. Curabitur dolor dolor, porttitor sit amet nunc quis, bibendum ornare justo. Curabitur lobortis diam sit amet felis sagittis vulputate. Suspendisse cursus, nunc sed fermentum placerat, lacus metus consequat purus, sed faucibus nisl lacus sed justo. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas rutrum, urna eget pharetra facilisis, dolor dui congue est, eu consectetur magna ex in urna.
                    
                    Morbi eros sapien, bibendum sit amet tellus vel, viverra ullamcorper diam. Donec non tellus a ex sagittis laoreet. Nam suscipit finibus ex quis molestie. Vivamus convallis id leo sed lobortis. Donec arcu libero, fermentum id tempor et, finibus pretium nisi. Curabitur tincidunt, magna id consequat tristique, ante mauris scelerisque odio, quis euismod leo arcu id ligula. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Phasellus a nisl sagittis, sollicitudin ante eu, consequat massa. Nulla eleifend viverra arcu et commodo. Sed varius nibh leo, non dictum enim aliquam non. Vestibulum a consequat ante, sed tristique risus. Vivamus imperdiet enim eros. Aenean maximus diam vehicula euismod pretium. Etiam varius elit et ex porta, pretium malesuada erat venenatis. Sed quis erat auctor, eleifend nulla sit amet, faucibus turpis. Etiam luctus rhoncus erat, tempus cursus dui.
                    
                    Aenean euismod dapibus tellus ut pulvinar. Donec faucibus tincidunt rutrum. Cras pellentesque justo at elit ultricies, in bibendum felis pulvinar. Cras lectus felis, tincidunt at tortor a, consectetur semper metus. Curabitur fringilla bibendum orci, a varius arcu sagittis quis. Integer nec leo ac nunc feugiat accumsan. Nunc non facilisis nulla. Duis at nibh ac felis rutrum vestibulum. Curabitur et euismod velit. Ut auctor turpis eu nisi congue, a accumsan erat egestas. Donec at consequat nisl. Vivamus nec metus dictum, pretium turpis non, faucibus mi. Quisque tempus justo vitae viverra feugiat. Praesent interdum erat purus, ac placerat neque faucibus id. Donec in neque a mauris aliquam pulvinar id ac massa. In ac fringilla nibh.
                    
                    Curabitur faucibus, erat sit amet maximus cursus, tellus risus dignissim est, a accumsan velit enim ut augue. Vivamus a est a est ullamcorper feugiat. Nullam ultrices justo massa, efficitur accumsan nisi dapibus eget. Curabitur ullamcorper in eros ut tempor. Nulla non purus vel quam sodales ultrices. Fusce non ipsum arcu. Morbi volutpat est tortor, eu ultricies tortor commodo vitae. Integer a tristique nulla. Praesent sollicitudin enim vulputate, suscipit purus quis, laoreet est. Aliquam eu nulla vitae est feugiat imperdiet. Vestibulum nisl urna, pellentesque ac felis finibus, maximus placerat magna. Ut eleifend turpis at ante tincidunt, sed tincidunt nibh ornare. Nunc sit amet est vel dui laoreet pulvinar non ut arcu. In sodales semper sapien, in vulputate elit tempor et.</p>
            


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