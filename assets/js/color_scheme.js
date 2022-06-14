let setup_scheme = () => {
    let btn = document.getElementsByClassName("scheme")[0];
    btn.addEventListener("click", () => {
        if (document.body.classList[0] == "dark") {
            document.body.classList.remove("dark");
            document.body.classList.add("light");
        }
        else {
            document.body.classList.remove("light");
            document.body.classList.add("dark");
        }
    });
}