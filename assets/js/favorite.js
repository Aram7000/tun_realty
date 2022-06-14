let favorite = () => {
    let buttons = document.getElementsByClassName("heart");
    let header_button = document.getElementById("header_button_favorites");
    for (const element of buttons) {
        element.addEventListener("click", () => {
            $.ajax({
                type: "POST",
                url: root_dir + 'assets/code/favorite.php',
                data: {
                    id: element.id
                },
                success: function (data) {
                    let action = data.split(", ")[0];
                    let favorites_count = data.split(", ")[1];
                    if (action == "added") {
                        element.getElementsByTagName("span")[0].classList.add("heart-active");
                    } else {
                        element.getElementsByTagName("span")[0].classList.remove("heart-active");
                    }
                    if (header_button != null) {
                        header_button.innerHTML = `Նախընտրած Հայտարարություններ <span class="note">${favorites_count}</span>`;
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr);
                }
            });
        });
    }
}