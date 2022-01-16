<?php

if ($_POST['passwd'] == "otis"){
    echo "Ingreso Exitoso!";
 

    if ($_POST['dockerService'] == "true"){

        $command =  "docker". " " .$_POST['futureCommand']. " " .$_POST['serviceId'];
    }

    else{
        $command = "sudo"." "."/bin/systemctl". " " .$_POST['futureCommand']. " " .$_POST['serviceId'];
    }

    echo $command;
    shell_exec($command);

}


else{
    echo "Ingreso Fallido!";
}



?>