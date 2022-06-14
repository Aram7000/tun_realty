NEON = {
    LOADPAGE: true,
    LOADING: true,
    LOADOFF: () => {
        NEON.LOADPAGE = false;
        loadEnd();
    },
    LOADON: () => {
        NEON.LOADPAGE = true;
        loadEnd();
    },
    LOADCONTENT: `
    <div id="NEON_loading">
        <span class="NEON_loading-i" id="i1"></span>
        <span class="NEON_loading-i" id="i2"></span>
        <span class="NEON_loading-i" id="i3"></span>
        <span class="NEON_loading-i" id="i4"></span>
    </div>
    `,
}

div_img = (src, x = "", content = "") => {
    return `<div style="background-image: url('${src}')" ${x}>${content}</div>`
}

sleep = (ms) => {
    setTimeout(() => {
        return true;
    }, ms);
}


loadStart = () => {
    if (NEON.LOADPAGE) {
        document.body.innerHTML += NEON.LOADCONTENT;
        NEON.LOADING = true;
    }
}

loadEnd = (id = "NEON_loading") => {
    let interval = setInterval(() => {
        if (document.body != null) {
            if (NEON.LOADING) {
                document.querySelector("#" + id).classList.add("fadeout");
                NEON.LOADING = false;
            }
        }
        clearInterval(interval);
    }, 1);
}



NEON = {
    LOADPAGE: true,
    LOADING: true,
    LOADOFF: () => {
        NEON.LOADPAGE = false;
        loadEnd();
    },
    LOADON: () => {
        NEON.LOADPAGE = true;
        loadEnd();
    },
    LOADCONTENT: `
    <div id="NEON_loading">
        <span class="NEON_loading-i" id="i1"></span>
        <span class="NEON_loading-i" id="i2"></span>
        <span class="NEON_loading-i" id="i3"></span>
        <span class="NEON_loading-i" id="i4"></span>
    </div>
    `,
}

div_img = (src, x = "", content = "") => {
    return `<div style="background-image: url('${src}')" ${x}>${content}</div>`
}

sleep = (ms) => {
    setTimeout(() => {
        return true;
    }, ms);
}


loadStart = () => {
    if (NEON.LOADPAGE) {
        document.body.innerHTML += NEON.LOADCONTENT;
        NEON.LOADING = true;
    }
}

loadEnd = (id = "NEON_loading") => {
    let interval = setInterval(() => {
        if (document.body != null) {
            if (NEON.LOADING) {
                document.querySelector("#" + id).classList.add("fadeout");
                NEON.LOADING = false;
            }
        }
        clearInterval(interval);
    }, 1);
}



