<?php

function login_part($root_dir) {?>
    <?php
    global $messages;
    if (isset($_GET["msg"])) {
        echo $messages[$_GET["msg"]];
    }
    ?>
    <div class="form_block">
        <form class="log_form" action="<?php echo $root_dir ?>/login/action.php" method="post">
            <input type="email" name="email" placeholder="Էլ․հասցե" />
            <input type="password" name="password" placeholder="Գաղտնաբառ" />
            <input type="submit" value="Մուտք" />
            <a class="reg_button" href="<?php echo $root_dir ?>signin">Գրանցվել</a>
        </form>
    </div>
<?php } function signin_part($root_dir) {?>
    <div class="form_block">
        <?php
        global $messages;
        if (isset($_GET["msg"])) {
            echo $messages[$_GET["msg"]];
        }
        ?>
        <form class="reg_form" action="<?php echo $root_dir ?>/signin/action.php" method="post">
            <input type="email" name="email" pattern="/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2, 4}$/" placeholder="Էլ.Հասցե" />
            <input type="tel" name="phone" placeholder="հեռախոսահամար" />
            <input type="text" name="name" placeholder="Անուն" />
            <input type="text" name="surname" placeholder="Ազգանուն" />
            <input type="password" name="pass" placeholder="Գաղտնաբառ" />
            <input type="password" name="re-pass" placeholder="կրկնել գաղտնաբառը" />
            <input type="submit" value="Հաստատել" />
        </form>
    </div>
<?php } ?>

