let _GLOBAL_ = {
    createdObjects: 0,
    particleGroupCount: 0,
}

let cube = (x, y, z, w, h, d, parent, texture) => {
    if (typeof parent != "undefined") {
        let N_cube = document.createElement("div");
        parent.appendChild(N_cube);
        N_cube.classList.add("N_cube");
        N_cube.style.left = `${x}px`;
        N_cube.style.top = `${y}px`;
        N_cube.style.width = `${w}px`;
        N_cube.style.height = `${h}px`;
        N_cube.style.transform = `translateZ(${z}px)`;
        let cubeCont = document.createElement("div");
        N_cube.appendChild(cubeCont);
        cubeCont.classList.add("N_cont");
        let s1 = document.createElement("span");
        cubeCont.appendChild(s1);
        s1.style.background = texture;
        s1.classList.add("N_side")
        s1.classList.add("N_Left")
        s1.style.width = `${d}px`;
        s1.style.height = `${h}px`;
        let s2 = document.createElement("span");
        cubeCont.appendChild(s2);
        s2.style.background = texture;
        s2.classList.add("N_side")
        s2.classList.add("N_Front")
        s2.style.width = `${w}px`;
        s2.style.height = `${h}px`;
        let s3 = document.createElement("span");
        cubeCont.appendChild(s3);
        s3.style.background = texture;
        s3.classList.add("N_side")
        s3.classList.add("N_Right")
        s3.style.width = `${d}px`;
        s3.style.height = `${h}px`;
        let s4 = document.createElement("span");
        cubeCont.appendChild(s4);
        s4.style.background = texture;
        s4.classList.add("N_side")
        s4.classList.add("N_Back")
        s4.style.width = `${w}px`;
        s4.style.height = `${h}px`;
        s4.style.transform = `translateZ(-${d}px)`;
        let s5 = document.createElement("span");
        cubeCont.appendChild(s5);
        s5.style.background = texture;
        s5.classList.add("N_side")
        s5.classList.add("N_Top")
        s5.style.width = `${w}px`;
        s5.style.height = `${d}px`;
        let s6 = document.createElement("span");
        cubeCont.appendChild(s6);
        s6.style.background = texture;
        s6.classList.add("N_side")
        s6.classList.add("N_Bottom")
        s6.style.width = `${w}px`;
        s6.style.height = `${d}px`;

        let returningObject = {
            elasticy: 0.1,
            mass: 0,
            x: x,
            y: y,
            w: w,
            h: h,
            cube: N_cube,
            object: cubeCont,
            side: {
                left: s1,
                front: s2,
                right: s3,
                back: s4,
                top: s5,
                bottom: s6,
            },
            forces: {
                x: 0,
                y: 0,
                z: 0,
            },
            speeds: {
                x: 0,
                y: 0,
                z: 0,
            },
            othersList: [],
        }
        return returningObject;
    }
}

let container = (x, y, parent = document.body, w = false, h = false) => {
    let element = document.createElement("div");
    parent.appendChild(element);
    element.classList.add("N_container");
    element.style.left = `${x}px`;
    element.style.top = `${y}px`;
    if (w != false) {
        element.style.width = `${w}px`;
    }
    if (h != false) {
        element.style.height = `${h}px`;
    }
    return element;
}

WriteCss = (css) => {
    let style = document.createElement("style");

    if (style.styleSheet) {
        style.styleSheet.cssText = css;
    } else {
        style.appendChild(document.createTextNode(css));
    }
    document.head.appendChild(style);
    return style;
}

let scene = (x, y, w, h, parent = document.body) => {
    let scene = document.createElement("div");
    parent.appendChild(scene);
    scene.classList.add("N_scene");
    scene.style.left = `${x}px`;
    scene.style.top = `${y}px`;
    scene.style.width = `${w}px`;
    scene.style.height = `${h}px`;
    return scene;
}

let FindUpdateFunction = setInterval(() => {
    if (typeof update == "function") {
        setInterval(() => {
            update();
        }, 1);
        clearInterval(FindUpdateFunction);
    }
}, 1);

let noUpdates = () => {
    clearInterval(FindUpdateFunction);
}


let circle = (x, y, z = 0, w, h, parent = document.body, background = "#ffffff", backgroundType = "unset") => {
    let c = document.createElement("span");
    c.classList.add("N_Circle");
    c.style.transform = `translateZ(${z}px)`;
    if (backgroundType != "image") {
        c.style.background = background;
    } else {
        c.style.backgroundImage = background;
    }
    c.style.height = `${h}px`;
    c.style.width = `${w}px`;
    c.style.left = `${x}px`;
    c.style.top = `${y}px`;
    parent.appendChild(c);
    return c;
}

let inCollider = (object_1, object_2) => {
    let ax = object_1.offsetLeft;
    let ay = object_1.offsetTop;
    let aw = object_1.offsetWidth;
    let ah = object_1.offsetHeight;

    let bx = object_2.offsetLeft;
    let by = object_2.offsetTop;
    let bw = object_2.offsetWidth;
    let bh = object_2.offsetHeight;

    return (ax > (bx - aw) && ay > (by - ah) && ax < (bx + bw) && ay < (by + bh)) ? true : false;
}

let particles = (x, y, count, direction, size, speed, z = 0, parent = document.body) => {
    let cont = container(x, y, parent);
    cont.classList.add(`particles-group-${_GLOBAL_.particleGroupCount}`);
    cont.classList.add(`N_Particles-group`);
    let p = {
        AllParticles: [],
        cont: cont,
        off: () => {
            p.cont.classList.add("off");
            p.cont.classList.remove("on")
        },
        on: () => {
            p.cont.classList.add("on");
            p.cont.classList.remove("off");
        }
    };
    let ct = ``;
    for (let i = 0; i < count; i++) {
        let left =
            (direction == "center") ? `${Math.random() * (size * 2) - size}px` :
                (direction == "left") ? `-${Math.random() * size + size}px` :
                    (direction == "top") ? `${Math.random() * size - (size / 2)}px` :
                        (direction == "right") ? `${Math.random() * size + size}px` :
                            (direction == "bottom") ? `${Math.random() * size - (size / 2)}px` :
                                `-${Math.random() * size + size}px`;
        let top =
            (direction == "center") ? `${Math.random() * (size * 2) - size}px` :
                (direction == "left") ? `${Math.random() * size - (size / 2)}px` :
                    (direction == "top") ? `-${Math.random() * size + size}px` :
                        (direction == "right") ? `${Math.random() * size - (size / 2)}px` :
                            (direction == "bottom") ? `${Math.random() * size + size}px` :
                                `${Math.random() * size - (size / 2)}px`;
        let x = document.createElement("span");
        x.classList.add(`particle-group-${_GLOBAL_.particleGroupCount}`);
        x.classList.add(`particle-${i}`);
        x.classList.add(`N_Particle`);
        cont.appendChild(x);
        p.AllParticles.push(x);
        ct += `
        .particle-group-${_GLOBAL_.particleGroupCount}.particle-${i} {
            animation: particle-${i}${_GLOBAL_.particleGroupCount}-animation ${speed + (Math.random() * ((speed / 4) * 2) - (speed / 4))}s infinite;
            animation-delay: ${Math.random()}s;
            transition-duration: ${Math.random() + 0.2}s;
            height: ${Math.random() * 5 + 5}px;
            width: ${Math.random() * 5 + 5}px;
            transform: translateZ(${z}px);
            background-color: #ffffffff;
            opacity: 0;
        }
        
        @keyframes particle-${i}${_GLOBAL_.particleGroupCount}-animation {
            0% {
                opacity: 0;
                left: 0;
                top: 0;
            }
            50% {
                opacity: 0.6;
            }
            80% {
                opacity: 0.6;
            }
            90% {
                opacity: 0;
            }
            100% {
                opacity: 0;
                left: ${left};
                top: ${top};
            }
        }
        `;
    }
    _GLOBAL_.particleGroupCount++;
    WriteCss(ct);
    return p;
}

let correct = (object) => {
    object.cube.style.left = `${Math.floor(object.x)}px`;
    object.cube.style.top = `${Math.floor(object.y)}px`;
}

let phisycs = (object) => {
    if (object.mass != 0) {

        object.speeds.x += object.forces.x / (object.mass);
        object.forces.x = 0;
        
        object.speeds.y += object.forces.y / (object.mass);
        object.forces.y = 0;

        object.x += object.speeds.x;
        object.y += object.speeds.y;
    
        correct(object);
        for(let i in object.othersList) {
            const element = object.othersList[i];
            if (inCollider(object.cube, element.cube)) {
                impuls(object, element);
            }
        }
    }
}

let impuls = (object1, object2) => {
    object2.forces.x += (object1.speeds.x * object1.mass);
    object2.speeds.x += object2.speeds.x * (object1.elasticy + object2.elasticy);
    object1.speeds.x = -(object1.speeds.x * (object1.elasticy + object2.elasticy));
    
    object2.forces.y += (object1.speeds.y * object1.mass);
    object2.speeds.y += object2.speeds.y * (object1.elasticy + object2.elasticy); 
    object1.speeds.y = -(object1.speeds.y * (object1.elasticy + object2.elasticy));
}


let gravity = (object, power) => {
    object.forces.y = power;
}


window.addEventListener("load", () => {
    if (typeof setup == "function") {
        setup();
    }
});





