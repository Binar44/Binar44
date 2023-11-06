<?php

$host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "eche";
	
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Organizer</title>
</head>
<body>
    <header>
        <div id="b">MÓJ ORGANIZER</div>
        <div id="a">
            <p id="c">Wpis wydarzenia: </p>
            <form action="index.php" method="post">
                <input type="number" name="search" id="">
                <input type="submit" value="ZAPISZ">
            </form>
        </div>
        <div id="d">
            <img src="logo2.png" alt="logo2" width="100px">
        </div>
    </header>
    <main>
        <ul>

<?php

for($i = 1; $i <= 25; $i++){
    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
	
		if ($rezultat = @$polaczenie->query(
		sprintf("SELECT * FROM zadania WHERE id = '%s'",
        mysqli_real_escape_string($polaczenie,$i))))
		{
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow>0)
			{
				$wiersz = $rezultat->fetch_assoc();
                $id = $wiersz['id'];
                $data = $wiersz['dataZadania'];
                $miesiac = $wiersz['miesiac'];
                if($wiersz['wpis'] == null){
                    $wpis = "";
                } else {
                    $wpis = $wiersz['wpis'];
                }

				$rezultat->free_result();
				
			} else {
				
				$_SESSION['blad'] = '<span style="color:red">NieprawidĹ‚owy login lub hasĹ‚o!</span>';
				
			}
			
		}
		
		$polaczenie->close();
	}
    echo "<li><p id='e'>$data. $miesiac</p><p id='f'>$wpis</p></li>";
}

?>
        </ul>
    </main>
    <footer>
        <p id="g">miesiąc: sierpien, rok: 2020</p>
        <p id="h">Stronę wykonał: ooooooooooo</p>
    </footer>
</body>
</html>