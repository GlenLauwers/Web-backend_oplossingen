<?php

    session_start();

    function __autoload( $classname )
    {
        require_once( $classname . '.php' );
    }

    $message    =   Message::getMessage();
    $email      =   '';
    $wachtwoord   =   '';

    if ( isset( $_SESSION[ 'registratie' ] ) )
    {
        $email      =   $_SESSION[ 'registratie' ][ 'email' ];
        $wachtwoord   =   $_SESSION[ 'registratie' ][ 'wachtwoord' ];
    }


?>

<!DOCTYPE html>
    <html>
    <head>
    
        <style>
            .modal
            {
                margin:5px 0px;
                padding:5px;
                border-radius:5px;
            }
            
            .succes
            {
                color:#468847;
                background-color:#dff0d8;
                border:1px solid #d6e9c6;
            }
            
            .fout
            {
                color:#b94a48;
                background-color:#f2dede;
                border:1px solid #eed3d7;
            }
            
            .fout p
            {
                font-style:italic;
            }
            
            .warning
            {
                color:#3a87ad;
                background-color:#d9edf7;
                border:1px solid #bce8f1;
            }

        </style>
    </head>
    <body>
    
        <h1>Registreer</h1>
        
        <?php if ( $message ): ?>
            <div class="modal <?= $message['type'] ?>">
                <?= $message['text'] ?>
            </div>
        <?php endif ?>
        
        <form action="registreren-proces.php" method="post">
            <ul>
                <li>
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?= $email ?>">
                </li>
                
                <li>
                    <label for="wachtwoord">Paswoord</label>
                    <input type="<?= ( $wachtwoord != '' ) ? 'text' : 'password' ?>" name="wachtwoord" id="wachtwoord" value="<?= $wachtwoord ?>">
                    
                    <input type="submit" name="generate-wachtwoord" value="genereer een paswoord">
                </li>
            
                <li>
                    <input type="submit" name="submit" value="registreer">
                </li>
            </ul>
        </form>
    </body>
</head>