let open_close_menu = () => {
    let menu_btn = document.getElementsByClassName("menu-btn")[0];
    let menu = document.getElementById("menu");
    menu_btn.addEventListener("click", () => {
        menu.classList.add("opened");
        menu_btn.classList.add("opened");
    });
    menu.addEventListener("click", () => {
        menu.classList.remove("opened");
        menu_btn.classList.remove("opened");
    });
}