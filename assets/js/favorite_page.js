let favorite_page = () => {
    let posts = document.getElementsByClassName("post");
    let posts_container = document.getElementsByClassName("posts")[0];
    for (const post of posts) {
        const element = post.getElementsByClassName("heart")[0];
        element.addEventListener("click", () => {
            $.ajax({
                type: "POST",
                url: root_dir + 'assets/code/favorite.php',
                data: {
                    id: element.id
                },
                success: function (data) {
                    let action = data.split(", ")[0];
                    // let favorites_count = data.split(", ")[1];
                    if (action == "added") {
                        element.getElementsByTagName("span")[0].classList.add("heart-active");
                    } else {
                        post.remove();
                        let h2 = document.getElementById("title");
                        if (posts.length == 0) {
                            h2.innerText = "Դուք Չունեք Նախընտրած Հայտարարություններ";
                        } else {
                            h2.innerText = `Նախընտրած Հայտարարություններ ( ${posts.length} / 100 )`;
                        }
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr);
                }
            });
        });
    }
}