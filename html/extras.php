<!DOCTYPE html>

<html lang="es">

    <head>
        <title>Hal-9000</title>

          <!-- add icon link -->
          <link rel = "icon" href = "./sources/hal9000_logo.png" type = "image/x-icon">

          <!-- add stylesheet link -->
          <link href="./style/style2.css" rel="stylesheet" type="text/css">
          <link href="./style/extras.css" rel="stylesheet" type="text/css">
          <!--JavaScript File link-A-->
          <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"></script>

        <!--Metadata--> 
          <meta property="og:site_name" content="Hal-9000">
          <meta property="og:title" content="Hal-9000 Server HomePage" />
          <meta property="og:description" content="Service management and monitoring" />
          <meta property="og:image" itemprop="image" content="https://images-ext-1.discordapp.net/external/WEI4P17riS_R98taKAYOE3QmKU_ZVAcNKlOYn7nooGg/https/img.pngio.com/hal-icon-65700-free-icons-library-hal-png-1600_1600.jpg?width=256&height=256">
          <meta property="og:type" content="website" />
          <meta property="og:updated_time" content="1440432930" />
          

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
                    <li><a href = "./extras.php">Extras</a></li>
                </ul></div>



            </nav>

        </header>

        <main>

        <section id="ssh-section">

            <h2>Remote SSH</h2>

            <p>
            <?php
                    function clean($string) {
                        $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
                        $string = str_replace('"', '', $string);
                        return $string; // Removes special chars.
                     }

                    $ssh_public_url = clean(shell_exec("curl --silent http://127.0.0.1:4040/api/tunnels | jq '.tunnels[0].public_url'"));
                    echo $ssh_public_url;
                ?>
            </p>

            
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