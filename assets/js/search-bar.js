let searchBarSetup = () => {
    let sectionBtns = document.getElementsByClassName("section-row-btn");
    let categoryBtns = document.getElementsByClassName("category-row-btn");
    let subsectionBtns = document.getElementsByClassName("subsection-row-btn");
    let filters = document.getElementsByClassName("filter-container");
    let choosenSection = sectionBtns[0];
    let choosenCategory;
    let choosenSubsection;

    for (const subsection of subsectionBtns) {
        subsection.addEventListener("click", () => {
            choosenSubsection.classList.remove("choosen");
            subsection.classList.add("choosen");
            choosenSubsection = subsection;
            for (const filter of filters) {
                filter.classList.remove("show");
                if (subsection.id == filter.classList[0]) {
                    filter.classList.add("show");
                }
            }
        });
    }

    for (const category of categoryBtns) {
        category.addEventListener("click", () => {
            choosenCategory.classList.remove("choosen");
            category.classList.add("choosen");
            choosenCategory = category;
            for (const subsection of subsectionBtns) {
                subsection.classList.remove("show");
                if (subsection.classList[0] == category.id) {
                    subsection.classList.add("show");
                }
            }
            for (const subsection of subsectionBtns) {
                if (subsection.classList[0] == category.id) {
                    subsection.click();
                    break;
                }
            }
        });
    }
    for (const section of sectionBtns) {
        section.classList.add("show");
        section.addEventListener("click", () => {
            choosenSection.classList.remove("choosen");
            section.classList.add("choosen");
            choosenSection = section;
            for (const category of categoryBtns) {
                category.classList.remove("show");
                if (category.classList[0] == section.id) {
                    choosenCategory.classList.remove("choosen");
                    category.classList.add("choosen");
                    choosenCategory = category;
                    category.classList.add("show");
                }
            }
            for (const subsection of subsectionBtns) {
                subsection.classList.remove("show");
            }
            for (const category of categoryBtns) {
                if (category.classList[0] == section.id) {
                    category.click();
                    break;
                }
            }
        });
    }


    if (sectionBtns.length > 0) {
        for (const category of categoryBtns) {
            if (category.classList[0] == sectionBtns[0].id) {
                choosenCategory = category;
                for (const subsection of subsectionBtns) {
                    if (subsection.classList[0] == category.id) {
                        choosenSubsection = subsection;
                        break;
                    }
                }
                break;
            }
        }
        sectionBtns[0].click();
    }

    

    let allBtns = document.getElementsByClassName("check-all-btn");
    for (const btn of allBtns) {
        btn.addEventListener("click", () => {
            let i = 0;
            while (document.getElementById(btn.id + i) != null) {
                document.getElementById(btn.id + i).checked = "checked";
                i++;
            }
        });
    }
    let details = document.getElementById("details");
    let showMoreBtn = document.getElementById("show-more-btn");
    if (showMoreBtn != null) {
        showMoreBtn.addEventListener("click", () => {
            if (details.classList[details.classList.length - 1] == "hidden_details") {
                details.classList.remove("hidden_details");
            } else {
                details.classList.add("hidden_details");
            }
        });
    }
}