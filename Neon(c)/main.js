
n_onload = (theme = "") => {
    document.querySelector("footer").innerHTML += `
    <div id="N_Footer" class="${theme}">
        <p id="N_Footer_T">
            Powered By
        </p>
        <span id="N_Footer_IMG"></span>
    </div>
    `;
};