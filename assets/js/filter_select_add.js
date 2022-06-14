let filter_select_add = () => {
    let selectCont = document.getElementById("select_options");
    let selectBtn = document.getElementById("new_option");
    let checkboxCont = document.getElementById("checkbox_options");
    let checkboxBtn = document.getElementById("new_checkbox");
    let radioCont = document.getElementById("radio_options");
    let radioBtn = document.getElementById("new_radio");
    let doubleSelectCont = document.getElementById("double_select_options");
    let doubleSelectBtn = document.getElementById("new_double_select");
    let fType = document.getElementById("f-type");
    if (fType != null) {
        console.log(fType);
        fType.addEventListener("change", () => {
            if (fType.value == "select") {
                document.getElementById("select").classList.add("show");
                document.getElementById("checkbox").classList.remove("show");
                document.getElementById("radio").classList.remove("show");
                document.getElementById("double_select").classList.remove("show");
            } else if (fType.value == "radio") {
                document.getElementById("select").classList.remove("show");
                document.getElementById("checkbox").classList.remove("show");
                document.getElementById("radio").classList.add("show");
                document.getElementById("double_select").classList.remove("show");
            } else if (fType.value == "checkbox") {
                document.getElementById("select").classList.remove("show");
                document.getElementById("checkbox").classList.add("show");
                document.getElementById("radio").classList.remove("show");
                document.getElementById("double_select").classList.remove("show");
            } else if (fType.value == "double-select") {
                document.getElementById("select").classList.remove("show");
                document.getElementById("checkbox").classList.remove("show");
                document.getElementById("radio").classList.remove("show");
                document.getElementById("double_select").classList.add("show");
            } else {
                document.getElementById("select").classList.remove("show");
                document.getElementById("checkbox").classList.remove("show");
                document.getElementById("radio").classList.remove("show");
                document.getElementById("double_select").classList.remove("show");
            }
        });
    }

    selectBtn.addEventListener("click", () => {
        let options = selectCont.getElementsByTagName("input");
        if (options[options.length - 1].value != "") {
            let newInput = document.createElement("input");
            newInput.type = "text";
            newInput.placeholder = `Option ${options.length + 1}`;
            newInput.name = `select${options.length}`;
            selectCont.appendChild(newInput);
        }
    });
    checkboxBtn.addEventListener("click", () => {
        let options = checkboxCont.getElementsByTagName("input");
        if (options[options.length - 1].value != "") {
            let newInput = document.createElement("input");
            newInput.type = "text";
            newInput.placeholder = `Checkbox ${options.length + 1}`;
            newInput.name = `checkbox${options.length}`;
            checkboxCont.appendChild(newInput);
        }
    });
    radioBtn.addEventListener("click", () => {
        let options = radioCont.getElementsByTagName("input");
        if (options[options.length - 1].value != "") {
            let newInput = document.createElement("input");
            newInput.type = "text";
            newInput.placeholder = `Radio ${options.length + 1}`;
            newInput.name = `radio${options.length}`;
            radioCont.appendChild(newInput);
        }
    });
    doubleSelectBtn.addEventListener("click", () => {
        let options = doubleSelectCont.getElementsByTagName("input");
        if (options[options.length - 1].value != "") {
            let newInput = document.createElement("input");
            newInput.type = "text";
            newInput.placeholder = `Double Select ${options.length + 1}`;
            newInput.name = `double-select${options.length}`;
            doubleSelectCont.appendChild(newInput);
        }
    });
}