-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 02 Janvier 2016 à 12:28
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `event_you_all`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contenu` text COLLATE utf8_unicode_ci NOT NULL,
  `date_creation` datetime NOT NULL,
  `id_createur` int(11) NOT NULL,
  `id_evenement` int(11) NOT NULL,
  `banniere` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Contenu de la table `articles`
--

INSERT INTO `articles` (`id`, `nom`, `contenu`, `date_creation`, `id_createur`, `id_evenement`, `banniere`) VALUES
(1, 'qssqqs', 'Bla bla bla ', '0000-00-00 00:00:00', 0, 0, ''),
(2, 'APP du mardi', 'APP peut faire référence à :\r\n\r\nAgence pour la protection des programmes, une association française\r\nAlgerian Process & Piping, une entreprise algérienne\r\nAsia Pulp & Paper, une entreprise indonésienne\r\nProtéine précurseur de l''amyloïde (amyloid precursor protein)\r\nAnalyse des pratiques professionnelles\r\nApprentissage par problèmes\r\nAlan Parsons Project groupe anglais des années 1970/1980\r\nAsia-Pacific Partnership on Clean Development and Climate (Partenariat Asie-Pacifique sur le développement propre et le climat)\r\nAteliers de pédagogie personnalisée, selon la liste des sigles relatifs à la formation continue en France\r\nAtom Publishing Protocol, un protocole de gestion de ressources Web\r\nAfrica Panel Progress, un comité, né après la réunion des pays du G8 de Gleneagles, ayant pour vocation de surveiller les attributions d''allocations\r\nAPP, une appellation alternative du fusil d''assaut conçu par le Soviétique I. K. Postnikov en 1985\r\nAsapa en Papouasie-Nouvelle-Guinée, selon la liste des codes AITA des aéroports\r\nApplication_web, app désigne une application informatique qui fonctionne dans un navigateur Web sans qu''il soit nécessaire d''installer ladite application.\r\napp désigne une application informatique fonctionnant sur un terminal mobile tel que smartphone ou tablette avec des systèmes d''exploitation comme IOS_(Apple) ou Android.', '0000-00-00 00:00:00', 0, 0, ''),
(3, 'edfed', 'Bla bla bla ', '0000-00-00 00:00:00', 0, 0, ''),
(4, 'edfed2', 'Bla bla bla dz', '0000-00-00 00:00:00', 0, 0, ''),
(5, 'Senlis, la meilleur ville de Senlis... WHAT ?!', 'Petite ville, senlis est cool\r\netch_style\r\nContrôle le contenu du tableau retourné comme documenté dans la fonction PDOStatement::fetch(). Valeur par défaut : PDO::ATTR_DEFAULT_FETCH_MODE (qui prend sa valeur par défaut de PDO::FETCH_BOTH).\r\n\r\nPour retourner un tableau contenant toutes les valeurs d''une seule colonne depuis le jeu de résultats, spécifiez PDO::FETCH_COLUMN. Vous pouvez spécifier quelle colonne vous voulez avec le paramètre fetch_argument.\r\n\r\nPour récupérer uniquement les valeurs uniques d''une seule colonne depuis le jeu de résultats, utilisez PDO::FETCH_COLUMN avec PDO::FETCH_UNIQUE.\r\n\r\nPour retourner un tableau associatif groupé par les valeurs d''une colonne spécifique, utilisez PDO::FETCH_COLUMN avec PDO::FETCH_GROUP.\r\n\r\nfetch_argument\r\nCet argument prend une valeur différente en fonction de la valeur de l''argument fetch_style:\r\n\r\nPDO::FETCH_COLUMN: Retourne le numéro de la colonne demandée (indexée à partir de 0).\r\n\r\nPDO::FETCH_CLASS: Retourne une instance de la classe désirée. Les colonnes sélectionnées sont liées aux attributs de la classe.\r\n\r\nPDO::FETCH_FUNC: Retourne la valeur de retour de la fonction de rappel précisée.\r\n\r\nctor_args\r\nArguments du constructeur personnalisé de la classe lorsque l''argument fetch_style est à PDO::FETCH_CLASS.\r\n\r\nValeurs de retour ¶\r\n\r\nPDOStatement::fetchAll() retourne un tableau contenant toutes les lignes du jeu d''enregistrements. Le tableau représente chaque ligne comme soit un tableau de valeurs des colonnes, soit un objet avec des propriétés correspondant à chaque nom de colonne.\r\n\r\nL''utilisation de cette méthode pour récupérer de gros jeux de résultats peut augmenter les ressources du système, mais également ces ressources. Plutôt que de récupérer toutes les données et de les manipuler avec PHP, utilisez le serveur de base de données pour manipuler les jeux de résultats. Par exemple, utilisez les clauses WHERE et ORDER BY dans vos requêtes SQL pour restreindre les résultats avant de les récupérer et de les traiter avec PHP.\r\n\r\nExemples ¶\r\n\r\nExemple #1 Récupération de toutes les lignes d''un jeu de résultats\r\n\r\n<?php\r\n$sth = $dbh->prepare("SELECT nom, couleur FROM fruit");\r\n$sth->execute();\r\n\r\n/* Récupération de toutes les lignes d''un jeu de résultats */\r\nprint("Récupération de toutes les lignes d''un jeu de résultats :\\n");\r\n$result = $sth->fetchAll();\r\nprint_r($result);\r\n?>\r\nL''exemple ci-dessus va afficher quelque chose de similaire à :\r\n\r\nRécupération de toutes les lignes d''un jeu de résultats :\r\nArray\r\n(\r\n    [0] => Array\r\n        (\r\n            [nom] => pear\r\n            [0] => pear\r\n            [couleur] => green\r\n            [1] => green\r\n        )\r\n\r\n    [1] => Array\r\n        (\r\n            [nom] => watermelon\r\n            [0] => watermelon\r\n            [couleur] => pink\r\n            [1] => pink\r\n        )\r\n\r\n)\r\nExemple #2 Récupération de toutes les valeurs d''une seule colonne depuis un jeu de résultats\r\n\r\nL''exemple suivant montre comment retourner toutes les valeurs d''une seule colonne depuis un jeu de résultats, même si la requête SQL retourne plusieurs colonnes par lignes.\r\n\r\n<?php\r\n$sth = $dbh->prepare("SELECT name, colour FROM fruit");\r\n$sth->execute();\r\n\r\n/* Récupération de toutes les valeurs de la première colonne */\r\n$result = $sth->fetchAll(PDO::FETCH_COLUMN, 0);\r\nvar_dump($result);\r\n?>\r\nL''exemple ci-dessus va afficher quelque chose de similaire à :\r\n\r\nArray(3)\r\n(\r\n    [0] =>\r\n    string(5) => apple\r\n    [1] =>\r\n    string(4) => pear\r\n    [2] =>\r\n    string(10) => watermelon\r\n)\r\nExemple #3 Grouper toutes les valeurs d''une seule colonne\r\n\r\nL''exemple suivant montre comment retourner un tableau associatif groupé par les valeurs de la colonne spécifiée d''un jeu de résultats. Le tableau contient trois clés : les valeurs apple et pear sont retournées sous la forme de tableaux qui contiennent deux couleurs différentes, tandis que watermelon est retourné sous la forme d''un tableau qui contient uniquement une seule couleur.\r\n\r\n<?php\r\n$insert = $dbh->prepare("INSERT INTO fruit(name, colour) VALUES (?, ?)");\r\n$insert->execute(array(''apple'', ''green''));\r\n$insert->execute(array(''pear'', ''yellow''));\r\n\r\n$sth = $dbh->prepare("SELECT name, colour FROM fruit");\r\n$sth->execute();\r\n\r\n/* Grouper les valeurs de la première colonne */\r\nvar_dump($sth->fetchAll(PDO::FETCH_COLUMN|PDO::FETCH_GROUP));\r\n?>\r\nL''exemple ci-dessus va afficher quelque chose de similaire à :\r\n\r\narray(3) {\r\n  ["apple"]=>\r\n    array(2) {\r\n      [0]=>\r\n        string(5) "green"\r\n      [1]=>\r\n        string(3) "red"\r\n    }\r\n  ["pear"]=>\r\n    array(2) {\r\n      [0]=>\r\n        string(5) "green"\r\n      [1]=>\r\n        string(6) "yellow"\r\n    }\r\n  ["watermelon"]=>\r\n    array(1) {\r\n      [0]=>\r\n        string(5) "green"\r\n    }\r\n}\r\n\r\nExemple #4 Instancier une classe pour chaque résultat\r\n\r\nL''exemple suivant montre le comportement de PDO::FETCH_CLASS.\r\n\r\n<?php\r\nclass fruit {\r\n    public $name;\r\n    public $colour;\r\n}\r\n\r\n$sth = $dbh->prepare("SELECT name, colour FROM fruit");\r\n$sth->execute();\r\n\r\n$result = $sth->fetchAll(PDO::FETCH_CLASS, "fruit");\r\nvar_dump($result);\r\n?>\r\nL''exemple ci-dessus va afficher quelque chose de similaire à :\r\n\r\narray(3) {\r\n  [0]=>\r\n  object(fruit)#1 (2) {\r\n    ["name"]=>\r\n    string(5) "apple"\r\n    ["colour"]=>\r\n    string(5) "green"\r\n  }\r\n  [1]=>\r\n  object(fruit)#2 (2) {\r\n    ["name"]=>\r\n    string(4) "pear"\r\n    ["colour"]=>\r\n    string(6) "yellow"\r\n  }\r\n  [2]=>\r\n  object(fruit)#3 (2) {\r\n    ["name"]=>\r\n    string(10) "watermelon"\r\n    ["colour"]=>\r\n    string(4) "pink"\r\n  }\r\n}\r\nExemple #5 Appel d''une fonction pour chaque résultat\r\n\r\nL''exemple suivant montre le comportement de PDO::FETCH_FUNC.\r\n\r\n<?php\r\nfunction fruit($name, $colour) {\r\n    return "{$name}: {$colour}";\r\n}\r\n\r\n$sth = $dbh->prepare("SELECT name, colour FROM fruit");\r\n$sth->execute();\r\n\r\n$result = $sth->fetchAll(PDO::FETCH_FUNC, "fruit");\r\nvar_dump($result);\r\n?>\r\nL''exemple ci-dessus va afficher quelque chose de similaire à :\r\n\r\narray(3) {\r\n  [0]=>\r\n  string(12) "apple: green"\r\n  [1]=>\r\n  string(12) "pear: yellow"\r\n  [2]=>\r\n  string(16) "watermelon: pink"\r\n}\r\nVoir aussi ¶\r\n\r\nPDO::query() - Exécute une requête SQL, retourne un jeu de résultats en tant qu''objet PDOStatement\r\nPDOStatement::fetch() - Récupère la ligne suivante d''un jeu de résultats PDO\r\nPDOStatement::fetchColumn() - Retourne une colonne depuis la ligne suivante d''un jeu de résultats\r\nPDO::prepare() - Prépare une requête à l''exécution et retourne un objet\r\nPDOStatement::setFetchMode() - Définit le mode de récupération par défaut pour cette requête\r\nadd a note add a note\r\nUser Contributed Notes 21 notes\r\n\r\nup\r\ndown\r\n21 Ant P. ¶6 years ago\r\nYou might find yourself wanting to use FETCH_GROUP and FETCH_ASSOC at the same time, to get your table''s primary key as the array key:\r\n<?php\r\n// $stmt is some query like "SELECT rowid, username, comment"\r\n$results = $stmt->fetchAll(PDO::FETCH_GROUP|PDO::FETCH_ASSOC);\r\n\r\n// It does work, but not as you might expect:\r\n$results = array(\r\n    1234 => array(0 => array(''username'' => ''abc'', ''comment'' => ''[...]'')),\r\n    1235 => array(0 => array(''username'' => ''def'', ''comment'' => ''[...]'')),\r\n);\r\n\r\n// ...but you can at least strip the useless numbered array out easily:\r\n$results = array_map(''reset'', $results);\r\n?>\r\nup\r\ndown\r\n5 davey at php dot net ¶7 years ago\r\nWhen passing PDO::FETCH_CLASS as the first argument, this method will accept the class name as the second option:\r\n\r\n<?php\r\n$query = $pdo->prepare($sql);\r\n\r\n$result = $query->execute($values);\r\n\r\nif ($result && $query->rowCount() > 0) {\r\n    $records = $query->fetchAll(PDO::FETCH_CLASS, ''Some_Class'');\r\n    // $record is now an array of Some_Class objects\r\n}\r\n?>\r\n\r\n- Davey\r\nup\r\ndown\r\n9 Daniel Hofmann ¶6 years ago\r\nPLEASE BE AWARE: If you do an OUTER LEFT JOIN and set PDO FetchALL to PDO::FETCH_ASSOC, any primary key you used in the OUTER LEFT JOIN will be set to a blank if there are no records returned in the JOIN.\r\n\r\nFor example:\r\n<?php\r\n//query the product table and join to the image table and return any images, if we have any, for each product\r\n$sql = "SELECT * FROM product, image\r\nLEFT OUTER JOIN image ON (product.product_id = image.product_id)";\r\n\r\n$array = $stmt->fetchAll(PDO::FETCH_ASSOC);\r\n\r\nprint_r($array);\r\n?>\r\n\r\nThe resulting array will look something like this:\r\n\r\nArray\r\n(\r\n    [0] => Array\r\n        (\r\n            [product_id] => \r\n            [notes] => "this product..."\r\n            [brand] => "Best Yet"\r\n            ...\r\n\r\nThe fix is to simply specify your field names in the SELECT clause instead of using the * as a wild card, or, you can also specify the field in addition to the *. The following example returns the product_id field correctly:\r\n\r\n<?php\r\n$sql = "SELECT *, product.product_id FROM product, image\r\nLEFT OUTER JOIN image ON (product.product_id = image.product_id)";\r\n\r\n$array = $stmt->fetchAll(PDO::FETCH_ASSOC);\r\n\r\nprint_r($array);\r\n?>\r\n\r\nThe resulting array will look something like this:\r\n\r\nArray\r\n(\r\n    [0] => Array\r\n        (\r\n            [product_id] => 3\r\n            [notes] => "this product..."\r\n            [brand] => "Best Yet"\r\n            ...\r\nup\r\ndown\r\n8 dyukemedia at gmail dot com ¶1 year ago\r\nGetting foreach to play nicely with some data from PDO FetchAll()\r\nI was not understanding to use the $value part of the foreach properly, I hope this helps someone else.\r\nExample:\r\n<?php \r\n$stmt = $this->db->prepare(''SELECT title, FMarticle_id FROM articles WHERE domain_name =:domain_name'');\r\n            $stmt->bindValue('':domain_name'', $domain);\r\n            $stmt->execute();\r\n            $article_list = $stmt->fetchAll(PDO::FETCH_ASSOC);\r\n?>\r\nwhich gives:\r\n\r\narray (size=2)\r\n  0 => \r\n    array (size=2)\r\n      ''title'' => string ''About Cats Really Long title for the article'' (length=44)\r\n      ''FMarticle_id'' => string ''7CAEBB15-6784-3A41-909A-1B6D12667499'' (length=36)\r\n  1 => \r\n    array (size=2)\r\n      ''title'' => string ''another cat story'' (length=17)\r\n      ''FMarticle_id'' => string ''0BB86A06-2A79-3145-8A02-ECF6EA5C405C'' (length=36)\r\n\r\nThen use:\r\n<?php\r\nforeach ($article_list as $row => $link) {\r\n  echo  ''<a href="''.  $link[''FMarticle_id''].''">'' . $link[''title'']. ''</a></br>'';\r\n  }\r\n?>\r\nup\r\ndown\r\n9 esw at pixeloution dot removeme dot com ¶5 years ago\r\nInterestingly enough, when you use fetchAll, the constructor for your object is called AFTER the properties are assigned. For example:\r\n\r\n<?php\r\nclass person {\r\n    public $name;\r\n\r\n    function __construct() {\r\n       $this->name = $this->name . " is my name.";\r\n    }\r\n}\r\n\r\n# set up select from a database here with PDO\r\n$obj = $STH->fetchALL(PDO::FETCH_CLASS, ''person'');\r\n?>\r\n\r\nWill result in '' is my name'' being appended to all the name columns. However if you call it slightly differently:\r\n\r\n<?php\r\n$obj = $obj = $STH->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, ''person'');\r\n?>\r\n\r\nThen the constructor will be called before properties are assigned. I can''t find this documented anywhere, so I thought it would be nice to add a note here.\r\nup\r\ndown\r\n12 Anonymous ¶7 years ago\r\nIf no rows have been returned, fetchAll returns an empty array.\r\nup\r\ndown\r\n9 fractalesque at gmail dot com ¶1 year ago\r\nto fetch rows grouped by primary id or any other field you may use FETCH_GROUP with FETCH_UNIQUE:\r\n\r\n<?php\r\n\r\n//prepare and execute a statement returning multiple rows, on a single one\r\n$stmt = $db->prepare(''SELECT id,name,role FROM table'');\r\n$stmt->execute();\r\nvar_dump($stmt->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_UNIQUE));\r\n\r\n//returns an array with the first selected field as key containing associative arrays with the row. This mode takes care not to repeat the key in corresponding grouped array.\r\n\r\n$result = array\r\n(1 => array\r\n   (''name''=>''foo'',\r\n    ''role''=>''sage'',),\r\n  2 => array\r\n   (''name''=>''bar'',\r\n    ''role''=>''rage'',),);\r\n\r\n// ''SELECT name,id,role FROM table'' would result in that:\r\n\r\n$result = array\r\n(''foo'' => array\r\n   (''id''=>1,\r\n    ''role''=>''sage'',),\r\n  ''bar'' => array\r\n   (''id''=>2,\r\n    ''role''=>''rage'',),);\r\n\r\n?>\r\nup\r\ndown\r\n6 michael dot arnauts at gmail dot com ¶1 year ago\r\nIf you want to use PDO::FETCH_CLASS but don''t like that all the values are of the type string, you can always use the __construct function of the class specified to convert them to a different type.\r\n\r\nAnother way is using mysqlnd, but it seems I had to recompile PHP for that.\r\n\r\n<?php\r\n\r\nclass Cdr {\r\n    public $a; // int\r\n    public $b; // float\r\n    public $c; // string\r\n    \r\n    public function __construct() {\r\n        $this->a = intval($this->a);\r\n        $this->b = floatval($this->b);\r\n    }\r\n     \r\n}\r\n\r\n// ...\r\n$arrCdrs = $objSqlStatement->fetchAll(PDO::FETCH_CLASS, ''Cdr'');\r\n\r\n?>\r\nup\r\ndown\r\n3 Hayley Watson ¶4 years ago\r\nIf you use the PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE flags to map columns to object properties, fetchAll() will use any __set() method your object has when carrying out the mapping.\r\nup\r\ndown\r\n3 mrshelly at hotmail dot com ¶7 years ago\r\nPHP fetchAll Data From SQL Server 2005 \r\nif field''s data type is varchar(nvarchar), only fetch 255 chars. but the "text" data type is ok.\r\n\r\nso, notice! to change the ''varchar'' or ''nvarchar'' (length > 255) to ''text'' data type..\r\n\r\nhope to help u.\r\n\r\n<?php\r\n\r\n$user = ''sa'';\r\n$pass = ''pass'';\r\n\r\n$conn = new PDO(''mssql:host=127.0.0.1; dbname=tempdb;'', $user, $pass);\r\n\r\n$mainSQL = "SELECT field_varchar, field_text FROM table1";\r\n$sth = $conn->prepare($mainSQL);\r\n$sth->setFetchMode(PDO::FETCH_ASSOC);\r\n$sth->execute();\r\n$retRows = $sth->fetchAll();\r\n// the field_varchar field only to fetch 255 chars(max)\r\n// the field_text is ok.\r\n\r\nvar_dump($retRows);\r\n\r\nunset($sth); unset($conn);\r\n\r\n?>\r\nup\r\ndown\r\n4 janniet at kiekies dot net ¶1 year ago\r\nIf you want to fetch rows as an object for which you have not defined a class, you can do:\r\n<?php\r\n$result = $q->fetchAll(PDO::FETCH_OBJ);\r\n?>\r\nup\r\ndown\r\n8 harlequin2 at gmx dot de ¶7 years ago\r\nThere is also another fetch mode supported on Oracle and MSSQL: \r\nPDO::FETCH_ASSOC\r\n\r\n> fetches only column names and omits the numeric index.\r\n\r\nIf you would like to return all columns from an sql statement with column keys as table headers, it''s as simple as this:\r\n\r\n<?php\r\n$dbh = new PDO("DS", "USERNAME", "PASSWORD");\r\n$stmt = $dbh->prepare("SELECT * FROM tablename");\r\n$stmt->execute();\r\n$arrValues = $stmt->fetchAll(PDO::FETCH_ASSOC);\r\n// open the table\r\nprint "<table wdith=\\"100%\\">\\n";\r\nprint "<tr>\\n";\r\n// add the table headers\r\nforeach ($arrValues[0] as $key => $useless){\r\n    print "<th>$key</th>";\r\n}\r\nprint "</tr>";\r\n// display data\r\nforeach ($arrValues as $row){\r\n    print "<tr>";\r\n    foreach ($row as $key => $val){\r\n        print "<td>$val</td>";\r\n    }\r\n    print "</tr>\\n";\r\n}\r\n// close the table\r\nprint "</table>\\n";\r\n?>\r\nup\r\ndown\r\n7 Anonymous ¶4 years ago\r\nNote that fetchAll() can be extremely memory inefficient for large data sets. My memory limit was set to 160 MB this is what happened when I tried: \r\n\r\n<?php \r\n$arr = $stmt->fetchAll(); \r\n// Fatal error: Allowed memory size of 16777216 bytes exhausted \r\n?> \r\n\r\nIf you are going to loop through the output array of fetchAll(), instead use fetch() to minimize memory usage as follows: \r\n\r\n<?php \r\nwhile ($arr = $stmt->fetch()) { \r\n    echo round(memory_get_usage() / (1024*1024),3) .'' MB<br />''; \r\n    // do_other_stuff(); \r\n} \r\n// Last line for the same query shows only 28.973 MB usage \r\n?>\r\nup\r\ndown\r\n3 akira at etnforum dot com ¶9 months ago\r\nThere may be some user who needs to upgrade their MySQL class to PDO class. The way of fetching results were changed from while loop into a foreach loop. For the people who wish to fetch the results in a while loop, here is a simple trick.\r\n\r\n<?php\r\n\r\n$db = new DB();\r\n$query = $db->prepare("SELECT * FROM CPUCategory");\r\n$query = $db->execute();\r\n$result = $db->fetchAll();\r\nvar_dump($result);\r\n\r\n?>\r\n\r\nThe Output will be:\r\narray(2) {\r\n    [0]=> array(2) {\r\n        ["ccatid"]=> int(1)\r\n        ["ccatname"]=> string(5) "Intel"\r\n    }\r\n    [1]=> array(2) {\r\n        ["ccatid"]=> int(2) \r\n        ["ccatname"]=> string(3) "AMD"\r\n    }\r\n}\r\n\r\nNever look like the output of old function.\r\n[ORIGINAL STYLE] mysql_fetch_array($query)\r\n[   MYSQL CLASS] $db->fetch_array($query)\r\n\r\nAnd you may give up.\r\nBut there is a simple way to use while loop to fetch the results.\r\n\r\n<?php\r\n\r\n$db = new DB();\r\n$query = $db->prepare("SELECT * FROM CPUCategory");\r\n$query = $db->execute();\r\n$result = $db->fetchAll();\r\n$row = array_shift($result);\r\n// If you need to fetch them now, put it in a while loop just like below:\r\n// while($row = array_shift($result)) { ... }\r\n    \r\nvar_dump($row);\r\n\r\n?>\r\n\r\nThe Output will be in a single array with while loop returns TRUE:\r\narray(2) {\r\n    ["ccatid"]=> int(1)\r\n    ["ccatname"]=> string(5) "Intel"\r\n}\r\n\r\nSo after fetching this row, while loop runs again and fetch the next row until all row has fetched, then the while loop will return false. (Just like the old function did)\r\n\r\nWhen you need to upgrade to PDO class, not much code needs to be modified and remember.\r\nup\r\ndown\r\n2 mxrgus ¶6 years ago\r\nIn method body:\r\n\r\nreturn $pstmt->fetchAll() or die("bad");\r\n\r\nwill not return correct value, but "1" instead.\r\nup\r\ndown\r\n1 Dennis ¶5 years ago\r\nError:\r\nSQLSTATE[HY000]: General error: 2014 Cannot execute queries while other unbuffered queries are active. Consider using PDOStatement::fetchAll(). Alternatively, if your code is only ever going to run against mysql, you may enable query buffering by setting the PDO::MYSQL_ATTR_USE_BUFFERED_QUERY attribute.\r\n\r\nIf you''re using something like:\r\n\r\nwhile ($row = $query->fetchObject()) {\r\n    [...]\r\n}\r\n\r\ntry using this instead:\r\n\r\n$rows = $query->fetchAll(PDO::FETCH_CLASS, ''ArrayObject'');\r\n\r\nforeach ($rows as $row) {\r\n    [...]\r\n}\r\nup\r\ndown\r\n1 stas at metalinfo dot ru ¶9 years ago\r\nNote, that you can use PDO::FETCH_COLUMN|PDO::FETCH_GROUP pair only while selecting two columns, not like DB_common::getAssoc(), when grouping is set to true.\r\nup\r\ndown\r\n2 info at yuriblanc dot it ¶3 months ago\r\nSomething missing in the doc.\r\nIf for instance you try to fetchAll(PDO::CLASS, "Class") it sometimes return an array of objects with NULL values, but the count of objects fetched correspond to table rows.\r\n\r\nIn this way works fine:\r\nfetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Class");\r\n\r\nFor example\r\n\r\n$stm = $pdo->prepare("SELECT * FROM Fruit");\r\n$stm->execute();\r\n$stm->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Fruit");\r\nup\r\ndown\r\n0 Dean S. ¶1 month ago\r\nUsing fetchAll() with the fetch types PDO::FETCH_GROUP and PDO::FETCH_ASSOC, PDO::FETCH_CLASS will always use the first column in the selected table as the key for the row in the output...\r\nup\r\ndown\r\n-1 ramon at monztro dot com ¶3 years ago\r\nIf you are trying to call PDOStatement::fetchAll and is not getting the result set as expected (empty instead), check if you called PDOStatement::execute first.\r\n\r\nRemember PDOStatement::fetchAll does not execute the query, it just mounts the array. \r\n\r\n:)\r\nup\r\ndown\r\n-2 GyoreG ¶1 year ago\r\nIf you would like to get the result as "key-value-pairs", like:\r\n\r\nArray(\r\n    [key1] => "value1"\r\n    [key2] => "value2"\r\n)\r\n\r\nthen you can do it by calling fetchAll with PDO::FETCH_GROUP | PDO::FETCH_COLUMN parameters. \r\n\r\n<?php\r\n  $result = $query->fetchAll(PDO::FETCH_GROUP|PDO::FETCH_COLUMN);\r\n?>\r\nadd a note add a note\r\nPDOStatement\r\nbindColumn\r\nbindParam\r\nbindValue\r\ncloseCursor\r\ncolumnCount\r\ndebugDumpParams\r\nerrorCode\r\nerrorInfo\r\nexecute\r\nfetch\r\nfetchAll\r\nfetchColumn\r\nfetchObject\r\ngetAttribute\r\ngetColumnMeta\r\nnextRowset\r\nrowCount\r\nsetAttribute\r\n', '0000-00-00 00:00:00', 0, 0, ''),
(6, 'Hi oh hi', 'When people talk about the music streaming scene, they''re often comparing familiar brands when considering which service to use. Some go with the big boys of Google, Apple or Amazon, and others maybe opt for smaller companies like Spotify or the Jay Z-led Tidal. Napster though? It''s not normally in the debate. Napster was actually When people talk about the music streaming scene, they''re often comparing familiar brands when considering which service to use. Some go with the big boys of Google, Apple or Amazon, and others maybe opt for smaller companies like Spotify or the Jay Z-led Tidal. Napster though? It''s not normally in the debate. Napster was actually When people talk about the music streaming scene, they''re often comparing familiar brands when considering which service to use. Some go with the big boys of Google, Apple or Amazon, and others maybe opt for smaller companies like Spotify or the Jay Z-led Tidal. Napster though? It''s not normally in the debate. Napster was actually When people talk about the music streaming scene, they''re often comparing familiar brands when considering which service to use. Some go with the big boys of Google, Apple or Amazon, and others maybe opt for smaller companies like Spotify or the Jay Z-led Tidal. Napster though? It''s not normally in the debate. Napster was actually When people talk about the music streaming scene, they''re often comparing familiar brands when considering which service to use. Some go with the big boys of Google, Apple or Amazon, and others maybe opt for smaller companies like Spotify or the Jay Z-led Tidal. Napster though? It''s not normally in the debate. Napster was actually When people talk about the music streaming scene, they''re often comparing familiar brands when considering which service to use. Some go with the big boys of Google, Apple or Amazon, and others maybe opt for smaller companies like Spotify or the Jay Z-led Tidal. Napster though? It''s not normally in the debate. Napster was actually When people talk about the music streaming scene, they''re often comparing familiar brands when considering which service to use. Some go with the big boys of Google, Apple or Amazon, and others maybe opt for smaller companies like Spotify or the Jay Z-led Tidal. Napster though? It''s not normally in the debate. Napster was actually ', '0000-00-00 00:00:00', 0, 15, ''),
(7, 'Hello again', 'Bla bla bla ', '0000-00-00 00:00:00', 0, 15, ''),
(8, 'Meteorite et copinage ', 'Critique babnjzjzjna$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);$prep->bindParam('':event'', $data[''arti'']);', '0000-00-00 00:00:00', 0, 32, 'pouvoir.png'),
(9, 'Un article à date', 'date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")date("Y-m-d H:i:s")v', '2015-12-29 12:27:07', 0, 32, 'pouvoir.png'),
(10, 'Sans bug ?', 'date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));date("Y-m-d H:i:s"));', '2015-12-29 12:30:22', 0, 37, 'meteors.png'),
(11, 'Coucou', 'Bla bla bla ', '2015-12-29 12:33:30', 0, 33, 'meteorite.pdn'),
(12, 'errrr', 'Bla bla bla ', '2015-12-29 12:36:16', 0, 14, 'googledrivesync.exe'),
(13, 'errrr', 'Bla bla bla ', '2015-12-29 12:37:24', 0, 14, 'googledrivesync.exe'),
(14, 'Id createur', 'Bla bla bla ', '2015-12-29 12:43:55', 1, 14, 'nativeproxy.exe');

-- --------------------------------------------------------

--
-- Structure de la table `badges`
--

CREATE TABLE IF NOT EXISTS `badges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_evenement` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `condition_obtention` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `contact_admin`
--

CREATE TABLE IF NOT EXISTS `contact_admin` (
  `id` int(11) NOT NULL,
  `id_expediteur` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contenu` text COLLATE utf8_unicode_ci NOT NULL,
  `date_envoi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

CREATE TABLE IF NOT EXISTS `evenements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_createur` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `prix` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `capacite` int(11) NOT NULL,
  `prive` tinyint(1) NOT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code_postal` int(11) NOT NULL,
  `ville` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `banniere` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `poster` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mot_clef` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `site_web` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `region` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pays` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=57 ;

--
-- Contenu de la table `evenements`
--

INSERT INTO `evenements` (`id`, `id_createur`, `nom`, `date_debut`, `date_fin`, `prix`, `description`, `capacite`, `prive`, `adresse`, `code_postal`, `ville`, `banniere`, `poster`, `mot_clef`, `site_web`, `region`, `pays`) VALUES
(1, 0, 'TESTING', '2015-12-02 23:59:00', '2015-12-16 23:00:00', 11, 'CEST COOLDEDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD', 111, 0, '14 RUE LERICHE', 75015, 'PARIS', 'index.php', NULL, 'ZDZDZ', 'SIT', 'r1', 'fr'),
(2, 0, 'APP du mardi', '2015-12-17 23:00:00', '2015-12-17 00:59:00', 0, 'Bla bla bla ', 6, 0, '3 rue Leriche', 75015, 'Paris', 'paths.php', NULL, 'app, thibault, informatique', 'www.event.com', 'r1', 'fr'),
(3, 0, 'Senlis party', '2015-12-10 01:01:00', '2015-12-10 22:01:00', 1000, 'Bla bla bla Senlis est une commune française, sous-préfecture du département de l''Oise, en région Picardie. Elle se situe sur la Nonette, entre les forêts de Chantilly et d''Ermenonville au sud, et d''Halatte au nord, à quarante kilomètres au nord de Paris. Ses habitants sont appelés les Senlisiens1.\r\n\r\nDe fondation antique, séjour royal durant le Moyen Âge, la cité conserve de sa longue histoire un riche patrimoine et possède plusieurs musées. La vieille ville est constituée d''un ensemble de maisons et ruelles anciennes ceintes de remparts gallo-romains et médiévaux, autour d''une cathédrale gothique. L''ensemble a été préservé par la création en 1962 d''un secteur sauvegardé de quarante-deux hectares. Depuis, la municipalité et les habitants mettent en valeur le patrimoine par la restauration des monuments et de l''habitat ancien et l''organisation de manifestations culturelles, tout en développant une activité économique tertiaire à proximité de l''autoroute du Nord (A1). Senlis fait partie du parc naturel régional Oise-Pays de France', 2, 0, '4 rue saint pierre', 60300, 'Senlis', 'PROJET MINIMAPS.png', NULL, 'world, informatique', 'www.senlis.com', 'r1', 'fr'),
(4, 0, 'Test and mor', '2015-12-24 23:59:00', '2015-12-09 00:59:00', 2112, 'Bla bla bla EZZEFEFEFZEFZEF', 2323, 0, '3 rue Leriche', 75015, 'PARIS', 'PROJET MINIMAPS.png', NULL, '122', 'WWW.ispe.com', 'r1', 'fr'),
(5, 0, 'Test and mor', '2015-12-24 23:59:00', '2015-12-09 00:59:00', 2112, 'Bla bla bla EZZEFEFEFZEFZEF', 2323, 0, '3 rue Leriche', 75015, 'PARIS', 'PROJET MINIMAPS.png', NULL, '122', 'WWW.ispe.com', 'r1', 'fr'),
(6, 0, 'Test and mor', '2015-12-24 23:59:00', '2015-12-09 00:59:00', 2112, 'Bla bla bla EZZEFEFEFZEFZEF', 2323, 0, '3 rue Leriche', 75015, 'PARIS', 'PROJET MINIMAPS.png', NULL, '122', 'WWW.ispe.com', 'r1', 'fr'),
(7, 0, 'Test and m2', '2015-12-24 23:59:00', '2015-12-09 00:59:00', 2112, 'Bla bla bla EZZEFEFEFZEFZEF', 2323, 0, '3 rue Leriche', 75015, 'PARIS', 'PROJET MINIMAPS.png', NULL, '122', 'WWW.ispe.com', 'r1', 'fr'),
(8, 0, 'KINGDOM H', '2015-12-02 00:59:00', '2015-12-10 00:59:00', 12, 'Bla bla bla ', 11, 0, '4 rue Leriche', 75015, 'Paris', '', NULL, '', '', 'r1', 'fr'),
(9, 0, 'Jojo', '2015-12-10 00:59:00', '2015-12-03 00:59:00', 33, 'HJBBBBBBBBBBBBBBBBBBBBBBBBBBBVHSHBJ', 33, 0, '4 rue Leriche', 75015, 'Paris', '', NULL, '', '', 'r1', 'fr'),
(10, 0, 'dfdfdf', '2015-12-09 00:00:00', '2015-12-03 23:59:00', 2, 'Bla bla bla ', 33, 0, '4 rue Leriche', 75015, 'Paris', '', NULL, '', '', 'r1', 'fr'),
(11, 0, 'Sora no game', '2015-12-03 01:59:00', '2015-12-16 23:00:00', 12, 'Bla bla bla ', 22, 0, '4 rue Leriche', 75015, 'Paris', '', NULL, 'kh', '', 'r1', 'fr'),
(12, 0, 'Oh my KH', '2015-12-16 22:22:00', '2015-12-26 23:59:00', 22, 'Bla bla bla ', 22, 0, '4 rue Leriche', 75015, 'Paris', '', NULL, '', '', 'r1', 'fr'),
(13, 0, 'Oh my KH2', '2015-12-16 22:22:00', '2015-12-26 23:59:00', 22, 'Bla bla bla ', 22, 0, '4 rue Leriche', 75015, 'Paris', '', NULL, '', '', 'r1', 'fr'),
(14, 1, 'bigE3', '2015-12-24 22:22:00', '2015-12-31 22:22:00', 122, 'Bla bla bla ', 112, 0, '4 rue Leriche', 75015, 'Paris', '', NULL, '', '', 'r1', 'fr'),
(15, 1, 'Mon chateau de Carte', '2015-12-02 22:22:00', '2015-12-20 22:22:00', 22, 'Bla bla bla ', 22, 0, '9 rue saint pierre', 60300, 'Senlis', '', NULL, '', '', 'r1', 'fr'),
(16, 1, 'Mon image', '2015-12-02 23:00:00', '2015-12-12 00:59:00', 32, 'Bla bla bla ', 33, 0, '13 rue Leriche', 75015, 'Paris', '', NULL, '', '', 'r1', 'fr'),
(17, 1, 'Mon image 2', '2015-12-16 22:22:00', '2015-12-23 22:02:00', 1221, 'Bla bla bla ', 212, 0, '22 rue Leriche', 75015, 'Paris', '', NULL, '', '', 'r1', 'fr'),
(18, 1, 'Mon image 2', '2015-12-16 22:22:00', '2015-12-23 22:02:00', 1221, 'Bla bla bla ', 212, 0, '22 rue Leriche', 75015, 'Paris', '', NULL, '', '', 'r1', 'fr'),
(19, 1, 'Mon image 2ZZ', '2015-12-16 22:22:00', '2015-12-23 22:02:00', 1221, 'Bla bla bla ', 212, 0, '22 rue Leriche', 75015, 'Paris', '', NULL, '', '', 'r1', 'fr'),
(20, 1, 'Mon image 2ZZ', '2015-12-16 22:22:00', '2015-12-23 22:02:00', 1221, 'Bla bla bla ', 212, 0, '22 rue Leriche', 75015, 'Paris', '', NULL, '', '', 'r1', 'fr'),
(21, 1, 'Mon image 2ZZ', '2015-12-16 22:22:00', '2015-12-23 22:02:00', 1221, 'Bla bla bla ', 212, 0, '22 rue Leriche', 75015, 'Paris', '', NULL, '', '', 'r1', 'fr'),
(22, 1, 'Mon image 3', '2015-12-02 22:22:00', '2016-01-01 22:22:00', 22, 'Bla bla bla ', 22, 0, '22 rue Leriche', 75015, 'Paris', 'C:\\wamp\\tmp\\php1BCB.tmp', NULL, '', '', 'r1', 'fr'),
(23, 1, 'Mon image 3', '2015-12-02 22:22:00', '2016-01-01 22:22:00', 22, 'Bla bla bla ', 22, 0, '22 rue Leriche', 75015, 'Paris', 'sorabig.jpg', NULL, '', '', 'r1', 'fr'),
(24, 1, 't''(tgtg', '2015-12-16 03:33:00', '2015-12-10 03:33:00', 323, 'Bla bla bla ', 322, 0, '3 rue Leriche', 75015, 'Paris', 'PROJET MINIMAPS.png', NULL, '', '', 'r1', 'fr'),
(27, 1, 't''(tgtg', '2015-12-16 03:33:00', '2015-12-10 03:33:00', 323, 'Bla bla bla ', 322, 0, '3 rue Leriche', 75015, 'Paris', 'PROJET MINIMAPS.png', NULL, '', '', 'r1', 'fr'),
(28, 1, 't''(tgtg', '2015-12-16 03:33:00', '2015-12-10 03:33:00', 323, 'Bla bla bla ', 322, 0, '3 rue Leriche', 75015, 'Paris', 'PROJET MINIMAPS.png', NULL, '', '', 'r1', 'fr'),
(29, 1, 't''(tgtg', '2015-12-16 03:33:00', '2015-12-10 03:33:00', 323, 'Bla bla bla ', 322, 0, '3 rue Leriche', 75015, 'Paris', 'PROJET MINIMAPS.png', NULL, '', '', 'r1', 'fr'),
(30, 1, 'll^l^l', '2015-12-24 04:44:00', '2015-12-31 03:33:00', 231, 'Bla bla bla ', 32, 0, '4 rue Leriche', 75015, 'Paris', 'lapinanimée.png', 'sorabig.jpg', '', '', 'r1', 'fr'),
(31, 1, 'ho', '2015-12-16 11:11:00', '2015-12-08 11:11:00', 21312, 'Bla bla bla ', 2112, 0, '4 rue saint pierre', 60300, 'Senlis', '', 'lapinanimée.png', '', '', 'r1', 'fr'),
(32, 1, 'Meterorites et co', '2015-01-01 00:00:00', '0222-02-22 01:00:00', 12, 'Bla bla bla ', 33, 0, '4 rue saint pierre', 60300, 'Senlis', 'http://localhost/Event-You-All/upload/events/banner/pouvoir.png', 'http://localhost/Event-You-All/upload/events/poster/pouvoir.png', '', '', 'r1', 'fr'),
(33, 1, 'Senlis party 3', '2015-12-17 03:33:00', '2015-12-10 03:33:00', 23, 'Bla bla bla ', 2, 0, '4 rue saint pierre', 60300, 'Senlis', '', NULL, '', '', 'r1', 'fr'),
(34, 1, 'Senlis party 4', '2015-12-17 03:33:00', '2015-12-10 03:33:00', 23, 'Bla bla bla ', 2, 0, '4 rue saint pierre', 60300, 'Senlis', '', NULL, '', '', 'r1', 'fr'),
(35, 1, 'Senlis party 5', '2015-12-17 03:33:00', '2015-12-10 03:33:00', 23, 'Bla bla bla ', 2, 0, '4 rue saint pierre', 60300, 'Senlis', '', NULL, '', '', 'r1', 'fr'),
(36, 1, 'Senlis party 5', '2015-12-17 03:33:00', '2015-12-10 03:33:00', 23, 'Bla bla bla ', 2, 0, '4 rue saint pierre', 60300, 'Senlis', '', NULL, '', '', 'r1', 'fr'),
(37, 1, 'Senlis party 5', '1995-12-17 03:00:00', '1995-12-10 03:00:00', 23, 'Bla bla bla ', 2, 0, '4 rue saint pierre', 60300, 'Senlis', 'http://localhost/Event-You-All/upload/events/banner/BUTTONFACTory.png', 'http://localhost/Event-You-All/upload/events/poster/BUTTONFACTory b2.png', '', '', 'r1', 'fr'),
(38, 1, 'sdsdsd', '2015-12-16 03:33:00', '2015-12-26 03:33:00', 32, 'Bla bla bla ', 33, 0, '4 rue saint pierre', 60300, 'Senlis', '', NULL, '', '', 'r1', 'fr'),
(39, 1, 'sdsdsd', '2015-12-16 03:33:00', '2015-12-26 03:33:00', 32, 'Bla bla bla ', 33, 0, '4 rue saint pierre', 60300, 'Senlis', '', NULL, '', '', 'r1', 'fr'),
(42, 1, 'sdsdsd', '2015-12-16 03:33:00', '2015-12-26 03:33:00', 32, 'Bla bla bla ', 33, 0, '4 rue saint pierre', 60300, 'Senlis', '', NULL, '', '', 'r1', 'fr'),
(47, 1, 'sdsdsd', '2015-12-16 03:33:00', '2015-12-26 03:33:00', 32, 'Bla bla bla ', 33, 0, '4 rue saint pierre', 60300, 'Senlis', '', NULL, '', '', 'r1', 'fr'),
(49, 1, 'Senlis party', '2015-12-03 11:11:00', '2015-12-31 11:11:00', 11, 'Bla bla bla ', 11, 0, '4 rue saint pierre', 60300, 'Senlis', 'http://localhost/Event-You-All/upload/events/banner/sorabig.jpg', NULL, '', '', 'r1', 'fr'),
(50, 1, 'Senlis party', '2015-12-03 11:11:00', '2015-12-31 11:11:00', 11, 'Bla bla bla ', 11, 0, '4 rue saint pierre', 60300, 'Senlis', 'http://localhost/Event-You-All/upload/events/banner/sorabig.jpg', 'http://localhost/Event-You-All/upload/events/poster/sorabig.jpg', '', '', 'r1', 'fr'),
(51, 1, 'Tournepoil TT', '2015-01-01 22:02:00', '2015-01-01 22:02:00', 21, 'Bla bla bla ', 221, 0, '4 rue Leriche', 75015, 'Paris', '', 'http://localhost/Event-You-All/upload/events/poster/idee A.jpg', '', '', 'r1', 'fr'),
(52, 1, 'Over christmas', '2015-04-01 22:02:00', '2016-07-01 22:02:00', 211, 'Bla bla bla ', 123, 0, '4 rue Leriche', 75015, 'Paris', '', 'http://localhost/Event-You-All/upload/events/poster/idee E.jpg', '', '', 'r1', 'fr'),
(53, 1, 'Ace of spade', '2016-05-23 11:00:00', '2016-05-23 11:12:00', 1, 'Commits on Dec 23, 2015\r\n@ThibaultVlacich\r\nFix a typo in commit 086eca8\r\nThibaultVlacich committed 14 hours ago\r\n5f993fd  \r\n@HugoMichard\r\n[#2] Fixed bindParam problem accidentaly deleted in previous commit\r\nHugoMichard committed 16 hours ago\r\ncd12c0c  \r\n@HugoMichard\r\n[#2] Fixed apostrophe problem\r\nHugoMichard committed 16 hours ago\r\ne3d481d  \r\n@HugoMichard\r\nMerge branch ''master'' of https://github.com/ThibaultVlacich/Event-You… …\r\nHugoMichard committed 18 hours ago\r\ne52223c  \r\n@larbaretier\r\n[#18] Date entered with selects in create event\r\nlarbaretier committed 20 hours ago\r\n 4  f3c66d6  \r\n@ThibaultVlacich\r\nUpdate Font Awesome\r\nThibaultVlacich committed 21 hours ago\r\ncb39686  \r\n@ThibaultVlacich\r\nUpdate normalize.css\r\nThibaultVlacich committed 21 hours ago\r\n1d400a6  \r\n@ThibaultVlacich\r\nRemove the test folder\r\nThibaultVlacich committed 21 hours ago\r\ncdc7949  \r\n@ThibaultVlacich\r\nController : Remove the first param if its the module name\r\nThibaultVlacich committed 23 hours ago\r\n086eca8  \r\n@ThibaultVlacich\r\n[#1][#14] Get slideshow elements from database\r\nThibaultVlacich committed a day ago\r\nd3e03c6  \r\n@HugoMichard\r\n[#2] Fixed optionnal var problem\r\nHugoMichard committed a day ago\r\nd33e5ea  \r\n@HugoMichard\r\n[#2] Put a single var found, deleted a typo prob\r\nHugoMichard committed a day ago\r\nb93d894  \r\nCommits on Dec 22, 2015', 20, 0, '6 rue des pricilas', 76002, 'Troufignol', 'http://localhost/Event-You-All/upload/events/banner/screenbatimaent.png', 'http://localhost/Event-You-All/upload/events/poster/proposlion.png', 'TH,kpk', 'www.thkpk.com', 'r1', 'fr'),
(54, 1, 'Faucheuses upda', '2015-01-01 23:00:00', '2015-06-12 12:00:00', 12, 'Coucou updaté', 2323, 0, '4 rue Leriche', 75015, 'Paris', 'http://localhost/Event-You-All/upload/events/banner/screenbatimaent.png', 'http://localhost/Event-You-All/upload/events/poster/random guy ohoh.png', '', '', 'r1', 'fr'),
(55, 1, 'Time after', '2015-01-01 15:00:00', '0000-00-00 00:00:00', 465, '<p>Bla bla bla&nbsp; &nbsp; &nbsp; $date_debut = $data[&#39;date_de_a&#39;].&#39;-&#39;.$data[&#39;date_de_m&#39;].&#39;-&#39;.$data[&#39;date_de_j&#39;].&#39; &#39;.$data[&#39;time_de_h&#39;].&#39;:&#39;.$data[&#39;time_de_m&#39;];<br />&nbsp; &nbsp; &nbsp; $date_fin = $data[&#39;date_fi_a&#39;].&#39;-&#39;.$data[&#39;date_fi_m&#39;].&#39;-&#39;.$data[&#39;date_fi_j&#39;].&#39; &#39;.$data[&#39;time_fi_h&#39;].&#39;:&#39;.$data[&#39;time_fi_m&#39;];&nbsp; &nbsp; &nbsp; $date_debut = $data[&#39;date_de_a&#39;].&#39;-&#39;.$data[&#39;date_de_m&#39;].&#39;-&#39;.$data[&#39;date_de_j&#39;].&#39; &#39;.$data[&#39;time_de_h&#39;].&#39;:&#39;.$data[&#39;time_de_m&#39;];<br />&nbsp; &nbsp; &nbsp; $date_fin = $data[&#39;date_fi_a&#39;].&#39;-&#39;.$data[&#39;date_fi_m&#39;].&#39;-&#39;.$data[&#39;date_fi_j&#39;].&#39; &#39;.$data[&#39;time_fi_h&#39;].&#39;:&#39;.$data[&#39;time_fi_m&#39;];&nbsp; &nbsp; &nbsp; $date_debut = $data[&#39;date_de_a&#39;].&#39;-&#39;.$data[&#39;date_de_m&#39;].&#39;-&#39;.$data[&#39;date_de_j&#39;].&#39; &#39;.$data[&#39;time_de_h&#39;].&#39;:&#39;.$data[&#39;time_de_m&#39;];<br />&nbsp; &nbsp; &nbsp; $date_fin = $data[&#39;date_fi_a&#39;].&#39;-&#39;.$data[&#39;date_fi_m&#39;].&#39;-&#39;.$data[&#39;date_fi_j&#39;].&#39; &#39;.$data[&#39;time_fi_h&#39;].&#39;:&#39;.$data[&#39;time_fi_m&#39;];&nbsp; &nbsp; &nbsp; $date_debut = $data[&#39;date_de_a&#39;].&#39;-&#39;.$data[&#39;date_de_m&#39;].&#39;-&#39;.$data[&#39;date_de_j&#39;].&#39; &#39;.$data[&#39;time_de_h&#39;].&#39;:&#39;.$data[&#39;time_de_m&#39;];<br />&nbsp; &nbsp; &nbsp; $date_fin = $data[&#39;date_fi_a&#39;].&#39;-&#39;.$data[&#39;date_fi_m&#39;].&#39;-&#39;.$data[&#39;date_fi_j&#39;].&#39; &#39;.$data[&#39;time_fi_h&#39;].&#39;:&#39;.$data[&#39;time_fi_m&#39;];&nbsp; &nbsp; &nbsp; $date_debut = $data[&#39;date_de_a&#39;].&#39;-&#39;.$data[&#39;date_de_m&#39;].&#39;-&#39;.$data[&#39;date_de_j&#39;].&#39; &#39;.$data[&#39;time_de_h&#39;].&#39;:&#39;.$data[&#39;time_de_m&#39;];<br />&nbsp; &nbsp; &nbsp; $date_fin = $data[&#39;date_fi_a&#39;].&#39;-&#39;.$data[&#39;date_fi_m&#39;].&#39;-&#39;.$data[&#39;date_fi_j&#39;].&#39; &#39;.$data[&#39;time_fi_h&#39;].&#39;:&#39;.$data[&#39;time_fi_m&#39;];</p>', 11, 0, '4 rue Leriche', 75015, 'Paris', '', NULL, '', '', 'r1', 'fr'),
(56, 1, 'Time after', '2015-01-01 15:00:00', '0000-00-00 00:00:00', 465, '<p>Bla bla bla&nbsp; &nbsp; &nbsp; $date_debut = $data[&#39;date_de_a&#39;].&#39;-&#39;.$data[&#39;date_de_m&#39;].&#39;-&#39;.$data[&#39;date_de_j&#39;].&#39; &#39;.$data[&#39;time_de_h&#39;].&#39;:&#39;.$data[&#39;time_de_m&#39;];<br />&nbsp; &nbsp; &nbsp; $date_fin = $data[&#39;date_fi_a&#39;].&#39;-&#39;.$data[&#39;date_fi_m&#39;].&#39;-&#39;.$data[&#39;date_fi_j&#39;].&#39; &#39;.$data[&#39;time_fi_h&#39;].&#39;:&#39;.$data[&#39;time_fi_m&#39;];&nbsp; &nbsp; &nbsp; $date_debut = $data[&#39;date_de_a&#39;].&#39;-&#39;.$data[&#39;date_de_m&#39;].&#39;-&#39;.$data[&#39;date_de_j&#39;].&#39; &#39;.$data[&#39;time_de_h&#39;].&#39;:&#39;.$data[&#39;time_de_m&#39;];<br />&nbsp; &nbsp; &nbsp; $date_fin = $data[&#39;date_fi_a&#39;].&#39;-&#39;.$data[&#39;date_fi_m&#39;].&#39;-&#39;.$data[&#39;date_fi_j&#39;].&#39; &#39;.$data[&#39;time_fi_h&#39;].&#39;:&#39;.$data[&#39;time_fi_m&#39;];&nbsp; &nbsp; &nbsp; $date_debut = $data[&#39;date_de_a&#39;].&#39;-&#39;.$data[&#39;date_de_m&#39;].&#39;-&#39;.$data[&#39;date_de_j&#39;].&#39; &#39;.$data[&#39;time_de_h&#39;].&#39;:&#39;.$data[&#39;time_de_m&#39;];<br />&nbsp; &nbsp; &nbsp; $date_fin = $data[&#39;date_fi_a&#39;].&#39;-&#39;.$data[&#39;date_fi_m&#39;].&#39;-&#39;.$data[&#39;date_fi_j&#39;].&#39; &#39;.$data[&#39;time_fi_h&#39;].&#39;:&#39;.$data[&#39;time_fi_m&#39;];&nbsp; &nbsp; &nbsp; $date_debut = $data[&#39;date_de_a&#39;].&#39;-&#39;.$data[&#39;date_de_m&#39;].&#39;-&#39;.$data[&#39;date_de_j&#39;].&#39; &#39;.$data[&#39;time_de_h&#39;].&#39;:&#39;.$data[&#39;time_de_m&#39;];<br />&nbsp; &nbsp; &nbsp; $date_fin = $data[&#39;date_fi_a&#39;].&#39;-&#39;.$data[&#39;date_fi_m&#39;].&#39;-&#39;.$data[&#39;date_fi_j&#39;].&#39; &#39;.$data[&#39;time_fi_h&#39;].&#39;:&#39;.$data[&#39;time_fi_m&#39;];&nbsp; &nbsp; &nbsp; $date_debut = $data[&#39;date_de_a&#39;].&#39;-&#39;.$data[&#39;date_de_m&#39;].&#39;-&#39;.$data[&#39;date_de_j&#39;].&#39; &#39;.$data[&#39;time_de_h&#39;].&#39;:&#39;.$data[&#39;time_de_m&#39;];<br />&nbsp; &nbsp; &nbsp; $date_fin = $data[&#39;date_fi_a&#39;].&#39;-&#39;.$data[&#39;date_fi_m&#39;].&#39;-&#39;.$data[&#39;date_fi_j&#39;].&#39; &#39;.$data[&#39;time_fi_h&#39;].&#39;:&#39;.$data[&#39;time_fi_m&#39;];</p>', 11, 0, '4 rue Leriche', 75015, 'Paris', 'http://localhost/Event-You-All/upload/events/banner/BUTTONFACTory.png', 'http://localhost/Event-You-All/upload/events/poster/BUTTONFACTory.png', '', '', 'r1', 'fr');

-- --------------------------------------------------------

--
-- Structure de la table `evenements_genres`
--

CREATE TABLE IF NOT EXISTS `evenements_genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_evenement` int(11) NOT NULL,
  `id_genre` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=45 ;

--
-- Contenu de la table `evenements_genres`
--

INSERT INTO `evenements_genres` (`id`, `id_evenement`, `id_genre`) VALUES
(1, 13, 2),
(2, 14, 6),
(3, 15, 2),
(4, 16, 2),
(5, 17, 2),
(6, 18, 2),
(7, 19, 2),
(8, 20, 2),
(9, 21, 2),
(10, 22, 1),
(11, 23, 1),
(12, 24, 1),
(13, 25, 1),
(14, 26, 1),
(15, 27, 1),
(16, 28, 1),
(17, 29, 1),
(18, 30, 1),
(19, 31, 1),
(20, 32, 1),
(21, 33, 1),
(22, 34, 1),
(23, 35, 1),
(24, 36, 1),
(25, 37, 1),
(26, 38, 1),
(27, 39, 1),
(28, 40, 1),
(29, 41, 1),
(30, 42, 1),
(31, 43, 1),
(32, 44, 1),
(33, 45, 1),
(34, 46, 1),
(35, 47, 1),
(36, 48, 1),
(37, 49, 1),
(38, 50, 1),
(39, 51, 1),
(40, 52, 3),
(41, 53, 6),
(42, 54, 1),
(43, 55, 1),
(44, 56, 1);

-- --------------------------------------------------------

--
-- Structure de la table `evenements_notes`
--

CREATE TABLE IF NOT EXISTS `evenements_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_evenement` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `evenements_participants`
--

CREATE TABLE IF NOT EXISTS `evenements_participants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_evenement` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `nb_participant` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `evenements_photos`
--

CREATE TABLE IF NOT EXISTS `evenements_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_evenement` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `evenements_sponsors`
--

CREATE TABLE IF NOT EXISTS `evenements_sponsors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_evenement` int(11) NOT NULL,
  `id_sponsor` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `evenements_types`
--

CREATE TABLE IF NOT EXISTS `evenements_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_evenement` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=47 ;

--
-- Contenu de la table `evenements_types`
--

INSERT INTO `evenements_types` (`id`, `id_evenement`, `id_type`) VALUES
(1, 11, 2),
(2, 12, 1),
(3, 13, 1),
(4, 14, 3),
(5, 15, 1),
(6, 16, 2),
(7, 17, 1),
(8, 18, 1),
(9, 19, 1),
(10, 20, 1),
(11, 21, 1),
(12, 22, 1),
(13, 23, 1),
(14, 24, 1),
(15, 25, 1),
(16, 26, 1),
(17, 27, 1),
(18, 28, 1),
(19, 29, 1),
(20, 30, 1),
(21, 31, 1),
(22, 32, 1),
(23, 33, 1),
(24, 34, 1),
(25, 35, 1),
(26, 36, 1),
(27, 37, 1),
(28, 38, 1),
(29, 39, 1),
(30, 40, 1),
(31, 41, 1),
(32, 42, 1),
(33, 43, 1),
(34, 44, 1),
(35, 45, 1),
(36, 46, 1),
(37, 47, 1),
(38, 48, 1),
(39, 49, 1),
(40, 50, 1),
(41, 51, 1),
(42, 52, 2),
(43, 53, 5),
(44, 54, 1),
(45, 55, 1),
(46, 56, 1);

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reponse` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `forum_categories`
--

CREATE TABLE IF NOT EXISTS `forum_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `forum_messages`
--

CREATE TABLE IF NOT EXISTS `forum_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_createur` int(11) NOT NULL,
  `id_topic` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `forum_topics`
--

CREATE TABLE IF NOT EXISTS `forum_topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_createur` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_creation` datetime NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `genres`
--

CREATE TABLE IF NOT EXISTS `genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `groupes`
--

CREATE TABLE IF NOT EXISTS `groupes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_createur` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `newsletters`
--

CREATE TABLE IF NOT EXISTS `newsletters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contenu` text COLLATE utf8_unicode_ci NOT NULL,
  `date_envoi` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `newsletters_abonnes`
--

CREATE TABLE IF NOT EXISTS `newsletters_abonnes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_newsletter` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `sponsors`
--

CREATE TABLE IF NOT EXISTS `sponsors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `types`
--

CREATE TABLE IF NOT EXISTS `types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `sex` enum('m','f','ns') COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adress` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `access` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `nickname`, `email`, `password`, `firstname`, `lastname`, `birthdate`, `sex`, `phone`, `adress`, `zip_code`, `city`, `country`, `register_date`, `access`) VALUES
(1, 'louis', 'l@gmail.com', 'd82ece8d514aca7e24d3fc11fbb8dada57f2966c', 'louis', 'louis', NULL, NULL, '', '', NULL, NULL, NULL, '2015-12-13 23:23:52', 1),
(2, 'test', 'test@gmail.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'test', 'test', NULL, NULL, '', '', '', '', 'FR', '2015-12-17 00:02:01', 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs_badges`
--

CREATE TABLE IF NOT EXISTS `utilisateurs_badges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `id_badge` int(11) NOT NULL,
  `date_obtention` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs_groupes`
--

CREATE TABLE IF NOT EXISTS `utilisateurs_groupes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `id_groupe` int(11) NOT NULL,
  `gere` tinyint(1) NOT NULL,
  `date_adhesion` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
