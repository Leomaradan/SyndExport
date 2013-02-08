<?php

// Force l'affichage en UTF-8
header('Content-Type: text/html; charset=utf-8');

include('syndexport.php');
$xml = file_get_contents("rss.xml");
$flux1 = new SyndExport($xml);
$type1 = $flux1->returnType();
$nbr1 = $flux1->countItems();
echo "Le flux1 d'actualités est de type : $type1, il possède $nbr1 entrée(s) dont voici la dernière :<br>";
$entree1 = $flux1->exportItems(1);
echo "Titre : ".$entree1[0]['title']." <br>";
echo "Description : ".$entree1[0]['description']."<br>";


$atom = file_get_contents("atom.xml");
$flux2 = new SyndExport($atom, "ATOM");
$type2 = $flux2->returnType();
$nbr2 = $flux2->countItems();
echo "Le flux2 d'actualités est de type : $type2, il possède $nbr2 entrée(s) :<br>";
$liste=$flux2->exportItems();
for($i=0;$i!=count($liste);$i++)
{
	$donnees=$liste[$i];
	echo "<h2>".$donnees['title']."</h2>";
	echo "<p>".$donnees['description']."</p>";
	echo "<p>Ecrit le : ".$donnees['date']."</p>";
	echo "<a href=\"".$donnees['link']."\">".$donnees['title']."</a>";
}
?>