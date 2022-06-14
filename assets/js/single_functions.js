let single_functions = () => {
    let smallImgs = document.getElementsByClassName("small-imgs");
    let largeImg = document.getElementById("large-img");
    let choosenID = 0;
    smallImgs[choosenID].classList.add("choosen");
    for (let i = 0; i < smallImgs.length; i++) {
        const element = smallImgs[i];
        element.addEventListener("click", () => {
            for (const el of smallImgs) {
                el.classList.remove("choosen");
            }
            element.classList.add("choosen");
            choosenID = i;
            largeImg.src = element.src;
        });
    }


    let arrow = {
        left: document.getElementById("arrowLeft"),
        right: document.getElementById("arrowRight"),
    }

    arrow.left.addEventListener("click", () => {
        for (const el of smallImgs) {
            el.classList.remove("choosen");
        }
        choosenID--;
        if (choosenID < 0) {
            choosenID = smallImgs.length - 1;
        }
        smallImgs[choosenID].classList.add("choosen");
        largeImg.src = smallImgs[choosenID].src;
    });
    arrow.right.addEventListener("click", () => {
        for (const el of smallImgs) {
            el.classList.remove("choosen");
        }
        choosenID++;
        if (choosenID >= smallImgs.length) {
            choosenID = 0;
        }
        smallImgs[choosenID].classList.add("choosen");
        largeImg.src = smallImgs[choosenID].src;
    });



    if (typeof post_id != "undefined") {
        let button = document.getElementById("favorite_btn");
        let span = document.getElementById("favorite_icon");
        let header_button = document.getElementById("header_button_favorites");
        if (button != null) {
            button.addEventListener("click", () => {
                $.ajax({
                    type: "POST",
                    url: root_dir + 'assets/code/favorite.php',
                    data: {
                        id: post_id,
                    },
                    success: function (data) {
                        let action = data.split(", ")[0];
                        if (action == "added") {
                            span.classList.add("heart-active");
                        } else {
                            span.classList.remove("heart-active");
                        }
                        let favorites_count = data.split(", ")[1];
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
}