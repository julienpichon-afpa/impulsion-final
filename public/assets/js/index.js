
gsap.to('.impulsion-logo', 0, {css:{visibility: "visible"}});

//header
const header = document.querySelector('#header');

//content
const h2Line = document.querySelectorAll('.big-text .line');
const contentP = document.querySelector('.big-text p');

//edition
const editionContentTitle = document.querySelector('.edition-content h3');

const editionContentH = document.querySelector('.edition-content .l1 h4');
const editionContentP = document.querySelector('.edition-content .l1 p');
const editionContentA = document.querySelectorAll('.edition-content .l1 a');

const editionContentHTwo = document.querySelector('.edition-content .l2 h4');
const editionContentPTwo = document.querySelector('.edition-content .l2 p');
const editionContentATwo = document.querySelectorAll('.edition-content .l2 a');

const editionContentHThree = document.querySelector('.edition-content .l3 h4');
const editionContentPThree = document.querySelector('.edition-content .l3 p');
const editionContentAThree = document.querySelectorAll('.edition-content .l3 a');

const editionContentHFour = document.querySelector('.edition-content .l4 h4');
const editionContentPFour = document.querySelector('.edition-content .l4 p');
const editionContentAFour = document.querySelectorAll('.edition-content .l4 a');

const editionContentHFive = document.querySelector('.edition-content .l5 h4');
const editionContentPFive = document.querySelector('.edition-content .l5 p');
const editionContentAFive = document.querySelectorAll('.edition-content .l5 a');

const editionContentHSix = document.querySelector('.edition-content .l6 h4');
const editionContentPSix = document.querySelector('.edition-content .l6 p');
const editionContentASix = document.querySelectorAll('.edition-content .l6 a');

const editionContentHSept = document.querySelector('.edition-content .l7 h4');
const editionContentPSept = document.querySelector('.edition-content .l7 p');
const editionContentASept = document.querySelectorAll('.edition-content .l7 a');

const TitleHuit = document.querySelector('.edition-content .l8 h4');
const ParaHuit = document.querySelector('.edition-content .l8 p');
const LienHuit = document.querySelectorAll('.edition-content .l8 a');

const TitleNeuf = document.querySelector('.edition-content .l9 h4');
const ParaNeuf = document.querySelector('.edition-content .l9 p');
const LienNeuf = document.querySelectorAll('.edition-content .l9 a');

const TitleDix = document.querySelector('.edition-content .l10 h4');
const ParaDix = document.querySelector('.edition-content .l10 p');
const LienDix = document.querySelectorAll('.edition-content .l10 a');

const TitleOnze = document.querySelector('.edition-content .l11 h4');
const ParaOnze = document.querySelector('.edition-content .l11 p');
const LienOnze = document.querySelectorAll('.edition-content .l11 a');

//image
const unImg = document.querySelector('.edition-content .l1 img');
const ltwoContent = document.querySelector('.edition-content .l2 img');
const lthreeContent = document.querySelector('.edition-content .l3 img');
const fourContent = document.querySelector('.edition-content .l4 img');
const fiveContent = document.querySelector('.edition-content .l5 img');
const sixContent = document.querySelector('.edition-content .l6 img');
const sevenContent = document.querySelector('.edition-content .l7 img');
const huitImg = document.querySelector('.edition-content .l8 img');
const neufImg = document.querySelector('.edition-content .l9 img');
const dixImg = document.querySelector('.edition-content .l10 img');
const onzeImg = document.querySelector('.edition-content .l11 img');

//intro
const intro = document.querySelector('.intro');
const introImg = document.querySelector('.impulsion-logo');
const slider = document.querySelector('.slider');

const introTL = gsap.timeline();

introTL
    .from(introImg, {
        y:100,
        skewY: 7,
        height:0,
        duration:0.75,
        ease:'power3.easeIn',
        stagger: {
            amount : 0.25
        }
    }).to([introImg, intro, slider], {
        y:-550,
        delay:0.75,
        skewY: 4,
        height: 0,
        duration:0.75,
        ease: 'power3.inOut',
        stagger: {
            amount : 0.25
        }
    })
    .from(header, {
        delay:0.2,
        y:16,
        opacity:0,
        duration:0.8,
        ease:'power3.inOut'
    })
    .from(h2Line, {
        delay: -0.4,
        y:80,
        opacity:0,
        duration:0.8,
        ease: 'power3.out',
        stagger: {
            amount:0.2
        }
    })
    .from(contentP, {
        delay:-0.6,
        y:-40,
        duration:0.8,
        opacity: 0,
        ease:'power3.out',
        stagger: {
            amount:0.2
        }
    });

const editionTl = gsap.timeline();

editionTl.from(
    editionContentTitle,
    {
        opacity:0,
        y:40,
        duration:0.6,
        ease:'power4.out',
        stagger : {
            amount:0.2
        }
    });

const editionlOne = gsap.timeline();

editionlOne.from(
    unImg, {
        delay:-0.4,
        opacity: 0,
        x:5,
        duration: 0.7,
        ease: 'power3.easeOut',
        stagger: {
            amount: 0.4
        }
    }
).from(editionContentH, {
    delay: -0.4,
    y:-5,
    opacity:0,
    duration:0.8,
    ease: 'power3.easeOut',
    stagger: {
        amount:0.2
    }
})
    .from([editionContentP,editionContentA], {
    delay: -0.4,
    y:5,
    opacity:0,
    duration:0.8,
    ease: 'power3.easeOut',
    stagger: {
        amount:0.2
    }
})

const editionlTwo = gsap.timeline();

editionlTwo.from(
    ltwoContent, {
        delay:-0.4,
        opacity: 0,
        x:5,
        duration: 0.7,
        ease: 'power3.easeOut',
        stagger: {
            amount: 0.4
        }
    }
).from(editionContentHTwo, {
    delay: -0.4,
    y:-5,
    opacity:0,
    duration:0.8,
    ease: 'power3.easeOut',
    stagger: {
        amount:0.2
    }
})
    .from([editionContentPTwo, editionContentATwo], {
        delay: -0.4,
        y:5,
        opacity:0,
        duration:0.8,
        ease: 'power3.easeOut',
        stagger: {
            amount:0.2
        }
    })


const editionlThree = gsap.timeline();

editionlThree.from(
    lthreeContent, {
        delay:-0.4,
        opacity: 0,
        x:5,
        duration: 0.7,
        ease: 'power3.easeOut',
        stagger: {
            amount: 0.4
        }
    }
).from(editionContentHThree, {
    delay: -0.4,
    y:-5,
    opacity:0,
    duration:0.8,
    ease: 'power3.easeOut',
    stagger: {
        amount:0.2
    }
})
    .from([editionContentPThree, editionContentAThree], {
        delay: -0.4,
        y:5,
        opacity:0,
        duration:0.8,
        ease: 'power3.easeOut',
        stagger: {
            amount:0.2
        }
    })


const editionlFour = gsap.timeline();

editionlFour.from(
    fourContent, {
        delay:-0.4,
        opacity: 0,
        x:5,
        duration: 0.7,
        ease: 'power3.easeOut',
        stagger: {
            amount: 0.4
        }
    }
).from(editionContentHFour, {
    delay: -0.4,
    y:-5,
    opacity:0,
    duration:0.8,
    ease: 'power3.easeOut',
    stagger: {
        amount:0.2
    }
})
    .from([editionContentPFour, editionContentAFour], {
        delay: -0.4,
        y:5,
        opacity:0,
        duration:0.8,
        ease: 'power3.easeOut',
        stagger: {
            amount:0.2
        }
    })


const editionlFive = gsap.timeline();

editionlFive.from(
    fiveContent, {
        delay:-0.4,
        opacity: 0,
        x:5,
        duration: 0.7,
        ease: 'power3.easeOut',
        stagger: {
            amount: 0.4
        }
    }
).from(editionContentHFive, {
    delay: -0.4,
    y:-5,
    opacity:0,
    duration:0.8,
    ease: 'power3.easeOut',
    stagger: {
        amount:0.2
    }
})
    .from([editionContentPFive, editionContentAFive], {
        delay: -0.4,
        y:5,
        opacity:0,
        duration:0.8,
        ease: 'power3.easeOut',
        stagger: {
            amount:0.2
        }
    })

const editionlSix = gsap.timeline();

editionlSix.from(
    sixContent, {
        delay:-0.4,
        opacity: 0,
        x:5,
        duration: 0.7,
        ease: 'power3.easeOut',
        stagger: {
            amount: 0.4
        }
    }
).from(editionContentHSix, {
    delay: -0.4,
    y:-5,
    opacity:0,
    duration:0.8,
    ease: 'power3.easeOut',
    stagger: {
        amount:0.2
    }
})
    .from([editionContentPSix, editionContentASix], {
        delay: -0.4,
        y:5,
        opacity:0,
        duration:0.8,
        ease: 'power3.easeOut',
        stagger: {
            amount:0.2
        }
    })

const editionSept = gsap.timeline();

editionSept.from(
    sevenContent, {
        delay:-0.4,
        opacity: 0,
        x:5,
        duration: 0.7,
        ease: 'power3.easeOut',
        stagger: {
            amount: 0.4
        }
    }
).from(editionContentHSept, {
    delay: -0.4,
    y:-5,
    opacity:0,
    duration:0.8,
    ease: 'power3.easeOut',
    stagger: {
        amount:0.2
    }
})
    .from([editionContentPSept, editionContentASept], {
        delay: -0.4,
        y:5,
        opacity:0,
        duration:0.8,
        ease: 'power3.easeOut',
        stagger: {
            amount:0.2
        }
    })

const editionHuit = gsap.timeline();

editionHuit.from(
    huitImg, {
        delay:-0.4,
        opacity: 0,
        x:5,
        duration: 0.7,
        ease: 'power3.easeOut',
        stagger: {
            amount: 0.4
        }
    }
).from(TitleHuit, {
    delay: -0.4,
    y:-5,
    opacity:0,
    duration:0.8,
    ease: 'power3.easeOut',
    stagger: {
        amount:0.2
    }
})
    .from([ParaHuit, LienHuit], {
        delay: -0.4,
        y:5,
        opacity:0,
        duration:0.8,
        ease: 'power3.easeOut',
        stagger: {
            amount:0.2
        }
    })

const editionNeuf = gsap.timeline();

editionNeuf.from(
    neufImg, {
        delay:-0.4,
        opacity: 0,
        x:5,
        duration: 0.7,
        ease: 'power3.easeOut',
        stagger: {
            amount: 0.4
        }
    }
).from(TitleNeuf, {
    delay: -0.4,
    y:-5,
    opacity:0,
    duration:0.8,
    ease: 'power3.easeOut',
    stagger: {
        amount:0.2
    }
})
    .from([ParaNeuf, LienNeuf], {
        delay: -0.4,
        y:5,
        opacity:0,
        duration:0.8,
        ease: 'power3.easeOut',
        stagger: {
            amount:0.2
        }
    })

const editionDix = gsap.timeline();

editionDix.from(
    dixImg, {
        delay:-0.4,
        opacity: 0,
        x:5,
        duration: 0.7,
        ease: 'power3.easeOut',
        stagger: {
            amount: 0.4
        }
    }
).from(TitleDix, {
    delay: -0.4,
    y:-5,
    opacity:0,
    duration:0.8,
    ease: 'power3.easeOut',
    stagger: {
        amount:0.2
    }
})
    .from([ParaDix, LienDix], {
        delay: -0.4,
        y:5,
        opacity:0,
        duration:0.8,
        ease: 'power3.easeOut',
        stagger: {
            amount:0.2
        }
    })

const editionOnze = gsap.timeline();

editionOnze.from(
    onzeImg, {
        delay:-0.4,
        opacity: 0,
        x:5,
        duration: 0.7,
        ease: 'power3.easeOut',
        stagger: {
            amount: 0.4
        }
    }
).from(TitleOnze, {
    delay: -0.4,
    y:-5,
    opacity:0,
    duration:0.8,
    ease: 'power3.easeOut',
    stagger: {
        amount:0.2
    }
})
    .from([ParaOnze, LienOnze], {
        delay: -0.4,
        y:5,
        opacity:0,
        duration:0.8,
        ease: 'power3.easeOut',
        stagger: {
            amount:0.2
        }
    })

const controller = new ScrollMagic.Controller();

const scene = new ScrollMagic.Scene({
    triggerElement: "#lineId",
    triggerHook:0,
    reverse: false
})
    //.addIndicators()
    .setTween(editionTl)
    .addTo(controller);

const sceneThree = new ScrollMagic.Scene({
 triggerElement: "#editionList",
 reverse: false,
})
 .setTween(editionlOne)
 .addTo(controller);

const sceneFour = new ScrollMagic.Scene({
    triggerElement: ".l2",
    reverse: false,
    offset: -200
})
    .setTween(editionlTwo)
    .addTo(controller);

const sceneFive = new ScrollMagic.Scene({
    triggerElement: ".l3",
    reverse: false,
    offset: -200
})
    .setTween(editionlThree)
    .addTo(controller);

const sceneSix = new ScrollMagic.Scene({
    triggerElement: ".l4",
    reverse: false,
    offset: -200
})
    .setTween(editionlFour)
    .addTo(controller);

const sceneSept = new ScrollMagic.Scene({
    triggerElement: ".l5",
    reverse: false,
    offset: -200
})
    .setTween(editionlFive)
    .addTo(controller);

const sceneHuit = new ScrollMagic.Scene({
    triggerElement: ".l6",
    reverse: false,
    offset: -200
})
    .setTween(editionlSix)
    .addTo(controller);

const sceneNeuf = new ScrollMagic.Scene({
    triggerElement: ".l7",
    reverse: false,
    offset: -200
})
    .setTween(editionSept)
    .addTo(controller);

const sceneDix = new ScrollMagic.Scene({
    triggerElement: ".l8",
    reverse: false,
    offset: -200
})
    .setTween(editionHuit)
    .addTo(controller);

const sceneOnze = new ScrollMagic.Scene({
    triggerElement: ".l9",
    reverse: false,
    offset: -200
})
    .setTween(editionNeuf)
    .addTo(controller);

const sceneDouze = new ScrollMagic.Scene({
    triggerElement: ".l10",
    reverse: false,
    offset: -200
})
    .setTween(editionDix)
    .addTo(controller);

const sceneTreize = new ScrollMagic.Scene({
    triggerElement: ".l11",
    reverse: false,
    offset: -200
})
    .setTween(editionOnze)
    .addTo(controller);


//effet souris opacité sur l'accueil

//on vient chercher l'id de canvas que l'on place dans une variable const
const canvas = document.querySelector('#canvas');
// Lorsque nous avons l'élément canvas, nous pouvons accéder au contexte de rendu en utilisant sa méthode getContext()
const ctx = canvas.getContext('2d');

//création d'une constante qui obtient la largeur et la hauteur de la fenêtre du navigateur
// Elle resize le canvas quand la fenêtre du navigateur change de dimension
const width = canvas.width = window.innerWidth;
const height = canvas.height = window.innerHeight;

//Affiche le canvas sur l'image de destination
ctx.globalCompositeOperation = "source-over"
//spécifie la couleur ou style à utiliser, noir dans ce cas
ctx.fillStyle = "#000"
//La méthode .fillRect() dessine un rectangle plein aux coordonnées (x, y) donc à 100% pour les deux,
// aux dimensions déterminées par largeur et hauteur et au style déterminé par l'attribut fillStyle.
ctx.fillRect(0, 0, width, height)

ctx.strokeStyle = '#fff';
ctx.lineWidth = 150;
ctx.lineJoin = 'round';
ctx.lineCap = 'round';

// Un booléen qui, lorsqu'il est vrai, indique le déplacement de
// la souris et entraîne un dessin sur le canvas
let isDrawing  = false;

//coordonnées x et y = 0
let lastX = 0;
let lastY = 0;

// fonction pour dessiner selon l'évènement de la souris
function draw (e) {
    //stop la fonction si il n'y a pas de mouvement
    if(!isDrawing) return ;
    // Le contenu existant du canvas est conservé là où il ne chevauche pas la nouvelle forme.
    ctx.globalCompositeOperation = "destination-out";
    // La méthode beginPath() commence un chemin ou réinitialise le chemin actuel.
    ctx.beginPath();
    // La méthode moveTo() déplace le chemin vers le point spécifié dans le canevas, sans créer de ligne.
    ctx.moveTo(lastX, lastY);
    // La méthode lineTo() ajoute un nouveau point et crée une ligne de ce point à partir du dernier point spécifié dans le canvas
    // la propriété offsetX/offsetY qui renvoie la coordonnée x/y du curseur de la souris
    ctx.lineTo(e.offsetX, e.offsetY);
    // La méthode stroke() dessine le chemin que l'on a défini avec les méthodes moveTo() et lineTo() et en utilisant le strokeStyle défini précédemment
    ctx.stroke();
    // met a jour le dernier mouvement de la souris sur l'axe x et y
    [lastX, lastY] = [e.offsetX, e.offsetY];
}

// On utilise la méthode addEventListener qui appelle une fonction à chaque fois que l'on survole le canvas avec la souris
canvas.addEventListener('mousemove', draw);
canvas.addEventListener('mousemove', (e) => {
    isDrawing = true;
    //fait démarrer le mouvement de la souris au dernier point connu et non sur x = 0 et y = 0
    [lastX, lastY] = [e.offsetX, e.offsetY];
});