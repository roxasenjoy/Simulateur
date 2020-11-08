let step = 0;

const list = ['patrimoine_proprio', 'patrimoine_famille', 'patrimoine_locataire', 'investissement_add', 'credit_add', 'patrimoine_proprioCredit'];
const patrimoines = ['patrimoines_bail_', 'patrimoines_credit_proprio_', 'patrimoines_proprio_loc_', 'patrimoines_has_credits_'];
const number = ["0", "1", "2"];

function showAnswer(){
    /***********
     *  Propriétaire
     **********/
    document.querySelector('.form > #' + patrimoines[0] + number[0]).addEventListener('click', function () {
        if (this.getAttribute("id") === patrimoines[0] + number[0]) {
            /* Show the form */
            document.getElementById(list[0]).removeAttribute("style");
            document.getElementById(list[2]).setAttribute("style", "display:none;");
            console.log("Proprio");
        }
    });


// Which button is clicked?
    document.querySelector('.form > #' + patrimoines[1] + number[0]).addEventListener('click', function () {
        if (this.getAttribute("id") === patrimoines[1] + number[0]) {
            /* Show the form */
            document.getElementById(list[5]).removeAttribute("style");
            console.log("Proprio2");
        }
    });

// Which button is clicked?
    document.querySelector('.form > #' + patrimoines[1] + number[1]).addEventListener('click', function () {
        if (this.getAttribute("id") === patrimoines[1] + number[1]) {
            /* Show the form */
            document.getElementById(list[5]).setAttribute("style", "display:none;");
            console.log("Proprio3");
        }
    });

    /***********
     *  Locataire
     **********/
    document.querySelector('.form >#' + patrimoines[0] + number[1]).addEventListener('click', function () {
        if (this.getAttribute("id") === patrimoines[0] + number[1]) {
            /* Hide the form */
            document.getElementById(list[0]).setAttribute("style", "display:none;");
            document.getElementById(list[2]).removeAttribute("style");
            console.log("Locataire");
        }
    });

    /***********
     *  Hébergé gratuitement
     **********/
    document.querySelector('.form >#' + patrimoines[0] + number[2]).addEventListener('click', function () {
        if (this.getAttribute("id") === patrimoines[0] + number[2]) {
            /* Hide the form */
            document.getElementById(list[0]).setAttribute("style", "display:none;");
            document.getElementById(list[2]).setAttribute("style", "display:none;");
            console.log("Hébergé gratuitement");
        }
    });


    /***********
     *  Investissement
     **********/
    document.querySelector('.form >#'+ patrimoines[2] + number[0]  ).addEventListener('click', function(){
        if(this.getAttribute("id") === patrimoines[2] + number[0]){
            /* Hide the form */
            document.getElementById(list[3]).removeAttribute("style");
            console.log("Investissement");
        }
    });

    document.querySelector('.form >#'+ patrimoines[2] + number[1]  ).addEventListener('click', function(){
        if(this.getAttribute("id") === patrimoines[2] + number[1]){
            /* Hide the form */
            document.getElementById(list[3]).setAttribute("style", "display:none;");
            console.log("Investissement");
        }
    });

    /***********
     *  Crédits
     **********/
    document.querySelector('.form >#'+ patrimoines[3] + number[0]  ).addEventListener('click', function(){
        if(this.getAttribute("id") === patrimoines[3] + number[0]){
            /* Hide the form */
            document.getElementById(list[4]).removeAttribute("style");
            console.log("Credit");
        }
    });

    document.querySelector('.form >#'+ patrimoines[3] + number[1]  ).addEventListener('click', function(){
        if(this.getAttribute("id") === patrimoines[3] + number[1]){
            /* Hide the form */
            document.getElementById(list[4]).setAttribute("style", "display:none;");
            console.log("Crédits");
        }
    });

}


function steps() {
    switch (step) {
        case 0:
            document.getElementById("patrimoine_famille").style.display = "none";
            document.getElementById("patrimoine_investissement").style.display = "inherit";
            document.getElementById("previous").style.display = "initial";
            document.getElementById("previousSituation").style.display = "none";
            document.getElementById("progress").style.width = "33.32%";
            step += 1;
            break;

        case 1:
            document.getElementById("patrimoine_investissement").style.display = "none";
            document.getElementById("patrimoine_credit").style.display = "inherit";
            document.getElementById("progress").style.width = "41.65%";
            step += 1;
            break;


        case 2:
            document.getElementById("patrimoine_credit").style.display = "none";
            document.getElementById("patrimoine_revenu_mensuel").style.display = "inherit";
            document.getElementById("progress").style.width = "49.98%";
            step += 1;
            break;

        case 3:
            /* Vérifiation */
            document.getElementById("patrimoine_famille").style.display = "inherit";
            document.getElementById("patrimoine_investissement").style.display = "inherit";
            document.getElementById("patrimoine_credit").style.display = "inherit";
            document.getElementById("patrimoine_revenu_mensuel").style.display = "inherit";

            document.getElementById("button").style.display = "inherit";
            document.getElementById("step").style.display = "none";

            document.getElementById("progress").style.width = "58.31%";
        default:
            break;
    }

}


function back() {
    switch (step) {
        case 1:
            document.getElementById("patrimoine_famille").style.display = "inherit";
            document.getElementById("patrimoine_investissement").style.display = "none";
            document.getElementById("previousSituation").style.display = "initial";
            document.getElementById("previous").style.display = "none";
            document.getElementById("progress").style.width = "24.99%";
            step -= 1;

            break;
        case 2:
            document.getElementById("patrimoine_investissement").style.display = "inherit";
            document.getElementById("patrimoine_credit").style.display = "none";
            document.getElementById("progress").style.width = "33.32%";
            step -= 1;
            break;

        case 3:
            document.getElementById("patrimoine_credit").style.display = "inherit";
            document.getElementById("patrimoine_revenu_mensuel").style.display = "none";
            document.getElementById("progress").style.width = "41.65%";
            step -= 1;
            break;

        case 4:
            /* Vérifiation */
            document.getElementById("patrimoine_famille").style.display = "inherit";
            document.getElementById("patrimoine_investissement").style.display = "inherit";
            document.getElementById("patrimoine_credit").style.display = "inherit";
            document.getElementById("patrimoine_revenu_mensuel").style.display = "inherit";
            document.getElementById("button").style.display = "inherit";
            document.getElementById("step").style.display = "none";
            document.getElementById("progress").style.width = "49.98%";
            step -= 2;
            break;
        default:

            break;
    }
}
