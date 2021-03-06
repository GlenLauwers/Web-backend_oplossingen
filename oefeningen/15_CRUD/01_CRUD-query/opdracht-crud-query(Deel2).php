<?php

  $bericht      = '';
  $brouwers     = array();
  $bieren       = array();
  $brouwer_ges  = 1;
  $kolom_naam   = array();
  $kolom_naam[] = 'naam';

	try
  {
    $db = new PDO('mysql:host=localhost;dbname=bieren', 'root', '');
    $bericht  = 'Connectie met de database is gelukt.';

//Alle brouwers binnenhalen
    $brouwer_string = ' SELECT brouwernr, brnaam
                          FROM brouwers';

    $statement = $db->prepare($brouwer_string);
    $statement->execute();

//While voor het formulier
    while ($row = $statement->fetch(PDO::FETCH_ASSOC))
    {
      $brouwers[]   = $row;
    }
    
//var_dump($brouwers);
    
    if (isset($_GET['brouwernr']))
    {
      $brouwer_ges = $_GET['brouwernr'];
  }
      $bieren_string  = ' SELECT naam
                            FROM bieren 
                            WHERE brouwernr = :brouwernr';

      $statement = $db->prepare($bieren_string);

      $statement->bindValue(':brouwernr', $brouwer_ges);

      $statement->execute();
    

//While voor de kolommen
    while($row = $statement->fetch(PDO::FETCH_ASSOC))
    {
      $bieren[]  = $row['naam'];
    }
  }

  catch (PDOException $e)
  {
    $bericht  = 'Er ging iets mis bij het inladen van de database: ' . $e->getMessage();
  }
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Oplossing: CRUD query</title>

        <style>
            .even{
              background-color:lightgrey;
            }
       
            table
            {
                font-size:12px;
                overflow:auto;
            }

            table th,
            table td
            {
                padding:4px;
            }

            table th
            {
                background: #DFDFDF;
                text-align:center;
            }

            table tr
            {
                transition: all 1s ease-out;
            }

            table tr:hover
            {
                background-color:lightgreen;
            }

            a
            {
              text-decoration: none;
              color: black;
            }

            tr:nth-child(odd){
              background: #F1F1F1;
            }

        </style>
    </head>

    <body class="web-backend-opdracht">
      <section class="body">
        <h1>Oplossing: CRUD query: Deel 2</h1>
          <p><?php echo $bericht ?></p>

          <form action="<?= $_SERVER['PHP_SELF'] ?>" method="GET">
            <label for="brouwers">Selecteer brouwers</label>

            <select name="brouwernr" id="brouwers">
              <?php foreach ($brouwers as $key => $brouwer): ?>
                <option value="<?= $brouwer['brouwernr'] ?>" <?= ( $brouwer_ges === $brouwer['brouwernr'] ) ? 'selected' : '' ?>><?= $brouwer['brnaam'] ?></option>
              <?php endforeach ?>
            </select>

            <input type="submit" value="Geef mij alle bieren van deze brouwerij">

          <button><a href="<?= $_SERVER['PHP_SELF'] ?>">Reset</a></button>

          </form>

          <table>
              <thead>
                <tr>
                  <th>Aantal</th>
                  <th>Naam</th>
                </tr>
              </thead>

              <tbody> 
                <?php foreach ($bieren as $key => $biernaam): ?>
                  <tr>
                    <td><?= ( $key +1) ?></td>
                    <td><?= $biernaam ?></td>
                  </tr>
                <?php endforeach ?>   
              </tbody>
            </table>
      </section>
    </body>
</html>
