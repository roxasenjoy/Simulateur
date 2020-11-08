let step = 0;

const list = ['enfant', 'pension'];
const situations = ['situations_has_enfant_', 'situations_has_pension_'];
const number = ["0", "1"];

function steps() {

    switch (step) {
        case 0:
            document.getElementById("situations_famille").style.display = "none";
            document.getElementById("situations_naissance").style.display = "inherit";
            document.getElementById("previous").style.display = "initial";
            document.getElementById("progress").style.width = "5%";
            step += 1;
            break;
        case 1:
            document.getElementById("situations_naissance").style.display = "none";
            document.getElementById("situations_has_enfant").style.display = "inherit";

            /**********
             *  ENFANT
             *********/
            // Which button is clicked?
            document
                .querySelector('.form > #' + situations[0] + number[0])
                .addEventListener('click', function () {
                    if (this.getAttribute("id") === situations[0] + number[0]) {
                        /* Show the form */
                        document.getElementById(list[0]).removeAttribute("style");
                    }
                });

            document
                .querySelector('.form > #' + situations[0] + number[1])
                .addEventListener('click', function () {
                    if (this.getAttribute("id") === situations[0] + number[1]) {
                        /* Hide the form */
                        document.getElementById(list[0]).setAttribute("style", "display:none;");
                    }
                });

            document.getElementById("progress").style.width = "8.33%";
            step += 1;
            break;
        case 2:
            document.getElementById("situations_has_enfant").style.display = "none";
            document.getElementById("situations_enfantFiscal").style.display = "inherit";
            document.getElementById("progress").style.width = "16.66%";
            step += 1;
            break;

        case 3:
            document.getElementById("situations_enfantFiscal").style.display = "none";
            document.getElementById("situations_has_pension").style.display = "inherit";
            document.getElementById("progress").style.width = "20%";

            /***
             * Pension
             */
            document
                .querySelector('.form > #' + situations[1] + number[0])
                .addEventListener('click', function () {
                    if (this.getAttribute("id") === situations[1] + number[0]) {
                        /* Show the form*/
                        document.getElementById(list[1]).removeAttribute("style");
                    }
                });

            document
                .querySelector('.form >#' + situations[1] + number[1])
                .addEventListener('click', function () {
                    if (this.getAttribute("id") === situations[1] + number[1]) {
                        /* Hide the form*/
                        document.getElementById(list[1]).setAttribute("style", "display:none;");
                    }
                });


            step += 1;
            break;

        case 4:
            /* Vérifiation */
            document.getElementById("situations_famille").style.display = "inherit";
            document.getElementById("situations_naissance").style.display = "inherit";
            document.getElementById("situations_has_enfant").style.display = "inherit";
            document.getElementById("situations_enfantFiscal").style.display = "inherit";
            document.getElementById("situations_has_pension").style.display = "inherit";


            document.getElementById("button").style.display = "inherit";
            document.getElementById("step").style.display = "none";

            document.getElementById("progress").style.width = "24.99%";
        default:
            break;
    }

}


function back() {
    switch (step) {
        case 1:
            document.getElementById("situations_famille").style.display = "inherit";
            document.getElementById("situations_naissance").style.display = "none";

            document.getElementById("previous").style.display = "none";

            document.getElementById("progress").style.width = "0%";
            step -= 1;

            break;
        case 2:
            document.getElementById("situations_naissance").style.display = "inherit";
            document.getElementById("situations_has_enfant").style.display = "none";
            document.getElementById("progress").style.width = "8.33%";
            step -= 1;
            break;

        case 3:
            document.getElementById("situations_has_enfant").style.display = "inherit";
            document.getElementById("situations_enfantFiscal").style.display = "none";
            document.getElementById("progress").style.width = "16.66%";
            step -= 1;
            break;

        case 4:
            document.getElementById("situations_enfantFiscal").style.display = "inherit";
            document.getElementById("situations_has_pension").style.display = "none";
            document.getElementById("progress").style.width = "16.66%";
            step -= 1;
            break;

        case 5:
            /* Vérifiation */
            document.getElementById("situations_famille").style.display = "inherit";
            document.getElementById("situations_naissance").style.display = "inherit";
            document.getElementById("situations_has_enfant").style.display = "inherit";
            document.getElementById("situations_enfantFiscal").style.display = "inherit";
            document.getElementById("situations_has_pension").style.display = "inherit";

            document.getElementById("button").style.display = "inherit";
            document.getElementById("step").style.display = "none";

            document.getElementById("progress").style.width = "24.99%";
            step -= 2;
            break;

        default:
            break;
    }
}
