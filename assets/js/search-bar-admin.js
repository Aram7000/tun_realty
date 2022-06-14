let searchBarAdmin = () => {
    let buttons = document.getElementsByClassName("drop-down-parent");
    let filterBtns = document.getElementsByClassName("filter-container");
    let closeBtns = document.getElementsByClassName("close-btn");
    for (const btn of closeBtns) {
        btn.addEventListener("click", () => {
            for (const btn of buttons) {
                btn.classList.remove("active");
            }
            for (const filter of filterBtns) {
                filter.classList.remove("active");
            }
        });
    }
    for (let i = 0; i < buttons.length; i++) {
        const element = buttons[i];
        element.addEventListener("dblclick", () => {
            for (const btn of buttons) {
                btn.classList.remove("active");
            }
            for (const filter of filterBtns) {
                filter.classList.remove("active");
            }
            element.classList.add("active");
        });
        const objects = {
            bgCol: element.getElementsByClassName("background-color")[0],
            color: element.getElementsByClassName("color")[0],
            fontS: element.getElementsByClassName("font-size")[0],
            order: element.getElementsByClassName("order")[0],
        }
        const input = element.getElementsByTagName("input")[0];
        objects.bgCol.addEventListener("change", () => {
            input.style.backgroundColor = objects.bgCol.value;
        });
        objects.color.addEventListener("change", () => {
            input.style.color = objects.color.value;
        });
        objects.fontS.addEventListener("change", () => {
            input.style.fontSize = objects.fontS.value + "%";
        });
        objects.order.addEventListener("change", () => {
            element.style.order = objects.order.value;
            console.log(objects.order.value);
        });
    }
    for (const element of filterBtns) {
        element.addEventListener("dblclick", () => {
            for (const btn of buttons) {
                btn.classList.remove("active");
            }
            for (const filter of filterBtns) {
                filter.classList.remove("active");
            }
            element.classList.add("active");
        });
        const objects = {
            order: element.getElementsByClassName("order")[0],
        }
        objects.order.addEventListener("change", () => {
            element.style.order = objects.order.value;
            console.log(objects.order.value);
        });
    }
    let sections = document.getElementsByClassName("section");
    let categories = document.getElementsByClassName("category");
    let subsections = document.getElementsByClassName("subsection");
    let choosenSection = sections[0];
    let choosenCategory;
    let choosenSubsection;

    for (const subsection of subsections) {
        subsection.addEventListener("click", () => {
            choosenSubsection.classList.remove("choosen");
            subsection.classList.add("choosen");
            choosenSubsection = subsection;
            for (const filter of filterBtns) {
                filter.classList.remove("show");
                if (subsection.id == filter.classList[0]) {
                    filter.classList.add("show");
                }
            }
        });
    }

    for (const category of categories) {
        category.addEventListener("click", () => {
            choosenCategory.classList.remove("choosen");
            category.classList.add("choosen");
            choosenCategory = category;
            for (const subsection of subsections) {
                subsection.classList.remove("show");
                if (subsection.classList[0] == category.id) {
                    subsection.classList.add("show");
                }
            }
            for (const subsection of subsections) {
                if (subsection.classList[0] == category.id) {
                    subsection.click();
                    break;
                }
            }
        });
    }
    for (const section of sections) {
        section.classList.add("show");
        section.addEventListener("click", () => {
            choosenSection.classList.remove("choosen");
            section.classList.add("choosen");
            choosenSection = section;
            for (const category of categories) {
                category.classList.remove("show");
                if (category.classList[0] == section.id) {
                    choosenCategory.classList.remove("choosen");
                    category.classList.add("choosen");
                    choosenCategory = category;
                    category.classList.add("show");
                }
            }
            for (const subsection of subsections) {
                subsection.classList.remove("show");
            }
            for (const category of categories) {
                if (category.classList[0] == section.id) {
                    category.click();
                    break;
                }
            }
        });
    }


    if (sections.length > 0) {
        for (const category of categories) {
            if (category.classList[0] == sections[0].id) {
                choosenCategory = category;
                for (const subsection of subsections) {
                    if (subsection.classList[0] == category.id) {
                        choosenSubsection = subsection;
                        break;
                    }
                }
                break;
            }
        }
        sections[0].click();
    }
    
    
    let hiddens = document.getElementsByClassName("hidden");
    let hide = false;
    let hideBtn = document.getElementById("show-hide-btn");
    hideBtn.addEventListener("click", () => {
        hide = !hide;
        if (hide) {
            hideBtn.classList.add("hide");
        } else {
            hideBtn.classList.remove("hide"); 
        }
        for (const element of hiddens) {
            element.style.display = (hide) ? "none" : "flex";
        }
    });
    let details = document.getElementById("details");
    let showMoreBtn = document.getElementById("show-more-btn");
    showMoreBtn.addEventListener("click", () => {
        if (details.classList[details.classList.length - 1] == "hidden_details") {
            details.classList.remove("hidden_details");
        } else {
            details.classList.add("hidden_details");
        }
    });
};