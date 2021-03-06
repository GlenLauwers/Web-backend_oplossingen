<?php
	$beginwaarde	=	100000;
	$rentevoet		=	8;
	$aantal_jaar	=	10;

	function bereken_rente	($beginwaarde, $rentevoet, $aantal_jaar)
	{
		static $jaar_bijtellen	=	1; //begin van de berekening (na 1 jaar)
		static $lijst			=	array();

		$winst		=	$beginwaarde * ($rentevoet/100);
		$totaal		=	$beginwaarde + $winst;

		$lijst[]	=	'Na ' .$jaar_bijtellen.' jaar sparen heeft Hans €' .floor ($totaal). ' op z\'n rekening staan, en heeft hij een winst van €' .floor ($winst).'.';

		if ($jaar_bijtellen<$aantal_jaar)
		{
			++ $jaar_bijtellen;
			bereken_rente ($totaal, $rentevoet, $aantal_jaar);
		}

		return $lijst;
	}

	$winst_Hans	=	bereken_rente ($beginwaarde, $rentevoet, $aantal_jaar);
	//var_dump($winst_Hans);
?>


<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Oplossing recursive</title>

    </head>
    <body>
        <h1>Oplossing recursive</h1>

        <h2>De rekening van Hans</h2>
     	<ul>
			<?php foreach($winst_Hans as $waarde): ?>
				<li><?php echo $waarde ?></li>
			<?php endforeach ?>
		</ul>
    </body>
</html>
