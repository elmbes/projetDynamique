<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <header>
        <h1>Tablette store</h1>
    </header>
    <section>

        <h2>Cliquez sur un article pour l'ajouter dans le panier</h2>

        <ul>
            <?php
            $data = array();
            $data = [
                "image" => ["https://m.media-amazon.com/images/I/61q567sffOL._AC_UY218_ML3_.jpg", "https://m.media-amazon.com/images/I/51M8hGU3iOL._AC_UY218_ML3_.jpg
            "],
                "prix" => [12, 34],
                "tire" => ["Tablette 1", "Tablette 2", "Tablette 3", "Tablette 4", "Tablette 5", "Tablette 6", "Tablette 7", "Tablette 8", "Tablette 9", "Tablette 10"],
                "titre" => ["Tablette 1", "Tablette 2"],
                "id" => ["tab1", "tab2"]
            ];

            $prix = [12, 32];
            $id =  ["tab1", "tab2"];
            $image = ["https://m.media-amazon.com/images/I/61q567sffOL._AC_UY218_ML3_.jpg", "https://m.media-amazon.com/images/I/51M8hGU3iOL._AC_UY218_ML3_.jpg"];
            $titre = ["Tablette 1", "Tablette 2"];

            $i = 0;
            while ($i < sizeof($prix)) {
                echo '<li><a href="index.php?param=' . $i . '">' . $titre[$i] . '</a></li>';
                $i++;
            }

            ?>
        </ul>

    </section>
    <hr>
    <section>
        <h1>Voici votre panier</h1>
        <?php
        session_start();
        $_SESSION["panier"] = array();

        if (isset($_GET["param"])) {
            array_push($_SESSION["panier"],4);
            var_dump($_SESSION["panier"]);
            $id = $_GET["param"];
            $i = 0;
            while ($i <sizeof($_SESSION["panier"] )) {
                echo '<li>' . $titre[$id] . '</a></li>';
                $i++;
            }
        } else {
            echo "Le panier est vide";
        }
        ?>
    </section>
    <footer>
        <p>El Amrani Mounir</p>
    </footer>
</body>

</html>