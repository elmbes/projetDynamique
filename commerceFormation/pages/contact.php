<?php 
    require_once("../inc/haut.inc.php");
    require_once("../inc/menu.inc.php");
?>

<section>
    <h1>Contact</h1>
    <hr>
    <p>
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ea vel debitis libero, rem, iusto veniam hic incidunt tempore sapiente nostrum et! Repudiandae possimus itaque consequuntur cum atque consequatur laborum earum.
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Delectus accusantium, voluptate ipsam velit a nesciunt dolores nulla esse cum fugit aspernatur debitis odit eveniet recusandae omnis dolore veritatis non blanditiis!
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur, maiores illo sed nobis ut libero soluta cupiditate praesentium accusantium magni ipsam! Distinctio rerum eum, voluptas est amet nam sed illum.
    </p>

    <form action="" method="post">
    <div>
        <label for="name">Nom :</label>
        <input type="text" id="name" name="user_name">
    </div>
    <div>
        <label for="mail">e-mail :</label>
        <input type="email" id="mail" name="user_mail">
    </div>
    <div>
        <label for="msg">Message :</label>
        <textarea id="msg" name="user_message"></textarea>
    </div>
    <div class="button">
        <button type="submit">Envoyer le message</button>
    </div>
</form>
</section>


<?php 
    require_once("../inc/bas.inc.php");
?>