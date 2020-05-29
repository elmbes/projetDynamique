<?php 
    require_once("inc/haut.inc.php");
    require_once("inc/menu.inc.php");
?>

    <main>
        <hr>
        <section>
            <div>
                <h2>Mon panier</h2>
                <p></p>
            </div>
        </section>
        <hr>
        <section>
            <p>Bienvenue dans la boutique E-commerce. Rajouter les artciles qui vous interresse dans le panier</p>
        </section>
        <section class="allProduit">

            <div class="produit1">
                <h3>Titre</h3>
                <img src="">
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vel veniam, cum perferendis non obcaecati nemo
                    numquam neque repellendus! Delectus consequuntur quos provident at quia ullam nostrum dolores, in ipsum
                    odio.</p>
                <p><a href="">Acheter</a></p>
            </div>



            <div class="produit2">
                <h3>Titre</h3>
                <img src="">
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vel veniam, cum perferendis non obcaecati nemo
                    numquam neque repellendus! Delectus consequuntur quos provident at quia ullam nostrum dolores, in ipsum
                    odio.</p>
                <p><a href="">Acheter</a></p>
            </div>

            <div class="produit3">
                <h3>Titre</h3>
                <img src="">
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vel veniam, cum perferendis non obcaecati nemo
                    numquam neque repellendus! Delectus consequuntur quos provident at quia ullam nostrum dolores, in ipsum
                    odio.</p>
                <p><a href="">Acheter</a></p>
            </div>
        </section>


        <div class="produit">
            <h2>Ecran oled</h2>
            <img src="image/ecran.jpg">
            <p>370 €</p>
            <form method="post" action=""><input type="submit" name="ajout_panier" value="ajout au panier"></form>
        </div>

        <form action="" method="post">

        </form>
    </main>

    
<?php 
    require_once("inc/bas.inc.php");
?>