let step = 0;

const list = ['apport', 'reduction'];
const epargnes = ['epargnes_has_apport_', 'epargnes_has_reductionImpot_'];
const number = ["0", "1"];

function steps() {

    switch (step) {
        case 0:
            document.getElementById("epargne_montant").style.display = "none";
            document.getElementById("epargne_apport").style.display = "inherit";
            document.getElementById("previous").style.display = "initial";

            document.getElementById("previousPatrimoine").style.display = "none";

            document.getElementById("progress").style.width = "66.64%";


            /**********
             *  Apport
             *********/
            // Which button is clicked?
            document.querySelector('.form > #' + epargnes[0] + number[0]  ).addEventListener('click', function(){
                if(this.getAttribute("id") === epargnes[0] + number[0]){
                    /* Show the form */
                    document.getElementById(list[0]).removeAttribute("style");
                }
            });

            document.querySelector('.form >#'+ epargnes[0] + number[1]  ).addEventListener('click', function(){
                if(this.getAttribute("id") === epargnes[0] + number[1]){
                    /* Hide the form */
                    document.getElementById(list[0]).setAttribute("style", "display:none;");
                }
            });

            step += 1;
            break;
        case 1:
            document.getElementById("epargne_apport").style.display = "none";
            document.getElementById("epargne_has_reductionImpot").style.display = "inherit";
            document.getElementById("progress").style.width = "74.97%";



            /**********
             *  Reduction d'impots
             *********/

            // Which button is clicked?
            document.querySelector('.form > #' + epargnes[1] + number[0]  ).addEventListener('click', function(){
                if(this.getAttribute("id") === epargnes[1] + number[0]){
                    /* Show the form */
                    document.getElementById(list[1]).removeAttribute("style");
                }
            });

            document.querySelector('.form >#'+ epargnes[1] + number[1]  ).addEventListener('click', function(){
                if(this.getAttribute("id") === epargnes[1] + number[1]){
                    /* Hide the form */
                    document.getElementById(list[1]).setAttribute("style", "display:none;");
                }
            });

            step += 1;
            break;
        case 2:
            /* Vérification */
            document.getElementById("epargne_montant").style.display = "inherit";
            document.getElementById("epargne_apport").style.display = "inherit";
            document.getElementById("epargne_has_reductionImpot").style.display = "inherit";

            document.getElementById("button").style.display = "inherit";
            document.getElementById("step").style.display = "none";

            document.getElementById("progress").style.width = "83.3%";
            step += 1;
            break;

        default:
            break;
    }

}


function back() {
    switch (step) {
        case 1:
            document.getElementById("epargne_montant").style.display = "inherit";
            document.getElementById("epargne_apport").style.display = "none";

            document.getElementById("previous").style.display = "none";
            document.getElementById("previousPatrimoine").style.display = "initial";

            document.getElementById("progress").style.width = "58.31%";
            step -= 1;

            break;
        case 2:
            document.getElementById("epargne_apport").style.display = "inherit";
            document.getElementById("epargne_has_reductionImpot").style.display = "none";
            document.getElementById("progress").style.width = "66.64%";
            step -= 1;
            break;

        case 3:
            /* Vérifiation */
            document.getElementById("epargne_montant").style.display = "inherit";
            document.getElementById("epargne_apport").style.display = "inherit";
            document.getElementById("epargne_has_reductionImpot").style.display = "inherit";

            document.getElementById("button").style.display = "inherit";
            document.getElementById("step").style.display = "none";

            document.getElementById("progress").style.width = "74.97%";
            step -= 2;
            break;
        default:
            break;
    }
}
