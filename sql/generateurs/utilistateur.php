<?

$prenom = array('Adam', 'Alex', 'Alexandre', 'Alexis', 'Anthony', 'Antoine', 'Benjamin', 'Cédric', 'Charles', 'Christopher', 'David', 'Dylan', 'Édouard', 'Elliot', 'Émile', 'Étienne', 'Félix', 'Gabriel', 'Guillaume', 'Hugo', 'Isaac', 'Jacob', 'Jérémy', 'Jonathan', 'Julien', 'Justin', 'Léo', 'Logan', 'Loïc', 'Louis', 'Lucas', 'Ludovic', 'Malik', 'Mathieu', 'Mathis', 'Maxime', 'Michaël', 'Nathan', 'Nicolas', 'Noah', 'Olivier', 'Philippe', 'Raphaël', 'Samuel', 'Simon', 'Thomas', 'Tommy', 'Tristan', 'Victor', 'Vincent', 'Alexia', 'Alice', 'Alicia', 'Amélie', 'Anaïs', 'Annabelle', 'Arianne', 'Audrey', 'Aurélie', 'Camille', 'Catherine', 'Charlotte', 'Chloé', 'Clara', 'Coralie', 'Daphnée', 'Delphine', 'Elizabeth', 'Élodie', 'Émilie', 'Emma', 'Emy', 'Ève', 'Florence', 'Gabrielle', 'Jade', 'Juliette', 'Justine', 'Laurence', 'Laurie', 'Léa', 'Léanne', 'Maélie', 'Maéva', 'Maika', 'Marianne', 'Marilou', 'Maude', 'Maya', 'Mégan', 'Mélodie', 'Mia', 'Noémie', 'Océane', 'Olivia', 'Rosalie', 'Rose', 'Sarah', 'Sofia', 'Victoria');
$nom = array('Tremblay', 'Gagnon', 'Roy', 'Côté', 'Bouchard', 'Gauthier', 'Morin', 'Lavoie', 'Fortin', 'Gagné', 'Ouellet', 'Pelletier', 'Bélanger', 'Lévesque', 'Bergeron', 'Leblanc', 'Paquette', 'Girard', 'Simard', 'Boucher', 'Caron', 'Beaulieu', 'Cloutier', 'Dubé', 'Poirier', 'Fournier', 'Lapointe', 'Leclerc', 'Lefebvre', 'Poulin', 'Thibault', 'St-Pierre', 'Nadeau', 'Martin', 'Landry', 'Martel', 'Bédard', 'Grenier', 'Lessard', 'Bernier', 'Richard', 'Michaud', 'Hébert', 'Desjardins', 'Couture', 'Turcotte', 'Lachance', 'Parent', 'Blais', 'Gosselin', 'Savard', 'Proulx', 'Beaudoin', 'Demers', 'Perreault', 'Boudreau', 'Lemieux', 'Cyr', 'Perron', 'Dufour', 'Dion', 'Mercier', 'Bolduc', 'Bérubé', 'Boisvert', 'Langlois', 'Ménard', 'Therrien', 'Plante', 'Bilodeau', 'Blanchette', 'Dubois', 'Champagne', 'Paradis', 'Fortier', 'Arsenault', 'Dupuis', 'Gaudreault', 'Hamel', 'Houle', 'Villeneuve', 'Rousseau', 'Gravel', 'Thériault', 'Lemay', 'Robert', 'Allard', 'Deschênes', 'Giroux', 'Guay', 'Leduc', 'Boivin', 'Charbonneau', 'Lambert', 'Raymond', 'Vachon', 'Gilbert', 'Audet', 'Jean', 'Larouche');
$courriel = array('gmail.com', 'hotmail.com', 'outlook.com', 'live.com', 'yahoo.com');

$myfile = fopen("../insert utilisateur.sql", "w") or die("Unable to open file!");
fwrite($myfile, "INSERT INTO utilisateurs VALUES\n");
$used = array();
$count = 100;

for ($i = 0; $i < $count; $i++) {
    $n = $nom[rand(0, count($nom)-1)];
    $p = $prenom[rand(0, count($prenom)-1)];
    $c = $courriel[rand(0, count($courriel)-1)];

    $c = mb_strtolower(substr($n, 0, 1).$p)."@".$c;
    $pw = mb_strtolower(substr($n, 0, 1).$p);

    if (!isset($used[$c])){
        $sql = "\t('$c', '$n', '$p', '$pw', 0),\n";
        $used[$c] = true;
    }
    else{
        $i--;
        continue;
    }

    if ($i == $count-1)
        $sql = substr($sql, 0, - 2) . ";";

    fwrite($myfile, $sql);
}

fclose($myfile);
