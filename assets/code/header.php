<?php function header_part($root_dir)
{ ?>
    <menu id="menu">
        <a href="#search-bar">Որոնում</a>
    </menu>
    <header>
        <div class="l-s">
            <button class="menu-btn">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <a href="<?php $root_dir ?>" class="tun-realty-logo"><img src="<?php echo $root_dir ?>assets/icons/logo.png" alt="Tun Realty Logo"></a>
        </div>
        <div class="r-s">
            <a class="acc-btn" href="<?php echo $root_dir ?>login">Մուտք</a>
            <a class="acc-btn" href="<?php echo $root_dir ?>signin">Գրանցվել</a>
            <select id="language">
                <option value="am">Հայ</option>
                <option value="ru">Рус</option>
                <option value="en">Eng</option>
            </select>
            <button class="scheme">

            </button>
        </div>
    </header>
<?php }
function header_logged_part($root_dir, $favorites_count = 0)
{ ?>
    <menu id="menu">
        <div class="top">
            <a href="#search-bar">Որոնում</a>
            <a id="header_button_favorites" href="<?php echo $root_dir ?>workspace/favorites">Նախընտրած Հայտարարություններ <span class="note"><?php echo $favorites_count ?></span></a>
        </div>
        <div class="bottom">
        </div>
    </menu>
    <header>
        <div class="l-s">
            <button class="menu-btn">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <a href="<?php echo $root_dir ?>" class="tun-realty-logo"><img src="<?php echo $root_dir ?>assets/icons/logo.png" alt="Tun Realty Logo"></a>
        </div>
        <div class="r-s">
            <a class="acc-btn" href="<?php echo $root_dir ?>workspace">Իմ Էջը</a>
            <a class="acc-btn" href="<?php echo $root_dir ?>logout">Ելք</a>
            <select id="language">
                <option value="am">Հայ</option>
                <option value="ru">Рус</option>
                <option value="en">Eng</option>
            </select>
            <button class="scheme">

            </button>
        </div>
    </header>
<?php }
function checked_header_part($root_dir, $favorites_count = 0)
{
    if (isset($_SESSION["logged"]) && $_SESSION["logged"]) {
        header_logged_part($root_dir, $favorites_count);
    } else {
        header_part($root_dir);
    }
}
function light_header_part($root_dir)
{ ?>
    <menu id="menu">
        <div class="top">
            <a href="<?php echo $root_dir ?>">Գլխավոր եջ</a>
            <a href="<?php echo $root_dir ?>/workspace/posts">Իմ հայտարարություններ</a>
            <a href="#">Նախընտրած</a>
            <a href="#">հաղորդագրություններ</a>
            <a href="<?php echo $root_dir ?>Relatyhelp">Դիմում Ռիելթրի օգնության</a>
            <a href="#">Фաթեթներ</a>
            <a href="#">Նախնտրած օգտատերեր</a>
        </div>
        <div class="bottom">
            <a href="#">Կարգավորումներ</a>
        </div>
    </menu>
    <header>
        <div class="l-s">
            <button class="menu-btn">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <a href="<?php echo $root_dir ?>" class="tun-realty-logo"><img src="<?php echo $root_dir ?>assets/icons/logo.png" alt="Tun Realty Logo"></a>
        </div>
        <div class="r-s">
            <a class="acc-btn" href="<?php echo $root_dir ?>logout">Ելք</a>
            <select id="language">
                <option value="am">Հայ</option>
                <option value="ru">Рус</option>
                <option value="en">Eng</option>
            </select>
            <button class="scheme">

            </button>
        </div>
    </header>
<?php } ?>