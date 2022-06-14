window.addEventListener("load", () => {
    if (typeof setup_scheme != "undefined") {
        setup_scheme();
    } if (typeof open_close_menu != "undefined") {
        open_close_menu();
    } if (typeof searchBarSetup != "undefined") {
        searchBarSetup();
    } if (typeof add_photo != "undefined") {
        add_photo();
    } if (typeof filter_select_add != "undefined") {
        filter_select_add();
    } if (typeof searchBarAdmin != "undefined") {
        searchBarAdmin();
    } if (typeof favorite != "undefined") {
        favorite();
    } if (typeof favorite_page != "undefined") {
        favorite_page();
    } if (typeof single_functions != "undefined") {
        single_functions();
    }





    if (typeof loading != "undefined") {
        loading();
    }
});