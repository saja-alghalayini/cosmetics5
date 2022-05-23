<?php

$servername = "localhost";
$username = "root";
$password = "";
$db= 'project5';


$dsn = "mysql:host=$servername;dbname=$db;charset=UTF8";

try {
	$pdo = new PDO($dsn, $username, $password);

	if ($pdo) {
		// echo "Connected to the $db database successfully!";
	}
} catch (PDOException $e) {
	echo $e->getMessage();
}

/*
                        $sql = 'SELECT * FROM cart INNER JOIN products WHERE cart.product_id=products.id  AND user_id=' . $id . ';';

                        $statement = $pdo->query($sql);

                        $publishers = $statement->fetchAll(PDO::FETCH_ASSOC);

                        unset($row);

                        foreach ($publishers as $publisher) {
                            $row['id'] = $publisher['id'];
                            $row['name'] = $publisher['name'];
                            $row['image'] = $publisher['image'];
                            $row['price'] = $publisher['price'];
                            $row['quantity'] = $publisher['quantity'];
                            $row['product_id'] = $publisher['product_id'];
                        }

                        $resultcheck = $statement->fetchColumn();
*/

?>
   