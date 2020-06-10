
var tabvar = [];

function getData() {



    function reqListener() {
        console.log(this.responseText);
    }

    var oReq = new XMLHttpRequest(); // New request object
    oReq.onload = function () {
        // This is where you handle what to do with the response.
        // The actual data is found on this.responseText

        //alert(this.responseText); // Will alert: 42

        var varReturn = this.responseText;

        var concat = 0;   //Resoud bug undefined

        var i = 0;
        var y = 0;


        do {

            var char = varReturn.charAt(i);

            if (char != "/") {

                concat = concat + char;
                tabvar[y] = concat;
                tabvar[y] = parseInt(tabvar[y]);
            } else {

                y++;
                concat = 0;

            }

            i++

        } while (char != "&");

        traitement();

    };
    oReq.open("get", "getData.php", true);
    oReq.send();

    function traitement() {

        var tabdeg = ['deg1', 'deg2', 'deg3', 'deg4', 'deg5', 'deg6', 'deg7', 'deg8', 'deg9'];
        var ideg = 0;
        var degg;

        var section1 = document.getElementById('sec1');
        var section2 = document.getElementById('sec2');
        var section3 = document.getElementById('sec3');
        var section4 = document.getElementById('sec4');
        var section5 = document.getElementById('sec5');
        var section6 = document.getElementById('sec6');
        var section7 = document.getElementById('sec7');
        var section8 = document.getElementById('sec8');

        var fanRotation1 = document.getElementById('fan_propeller-1');
        var fanRotation2 = document.getElementById('fan_propeller-2');

        var vanne1 = document.getElementById('van1');
        var vanne2 = document.getElementById('van2');
        var vanne3 = document.getElementById('van3');
        var vanne4 = document.getElementById('van4');
        var vanne5 = document.getElementById('van5');
        var vanne6 = document.getElementById('van6');

        var flam1 = document.getElementById('flam1');
        var flam2 = document.getElementById('flam2');

        var oven1 = document.getElementById('ov1');
        var oven2 = document.getElementById('ov2');

        //Temerature

        document.getElementById('rcptT2').innerHTML = tabvar[5] + "°C";
        document.getElementById('rcptT3').innerHTML = tabvar[6] + "°C";
        document.getElementById('rcptT4').innerHTML = tabvar[7] + "°C";
        document.getElementById('rcptTS').innerHTML = tabvar[14] + "°C";                //Verifier quel capteur dans la réu skype
        document.getElementById('rcptTE').innerHTML = tabvar[12] + "°C";
        document.getElementById('oven1TE').innerHTML = tabvar[54] + "°C";
        document.getElementById('oven2TE').innerHTML = tabvar[60] + "°C";
        document.getElementById('oven1T').innerHTML = tabvar[53] + "°C";
        document.getElementById('oven2T').innerHTML = tabvar[59] + "°C";
        document.getElementById('fandeb1').innerHTML = tabvar[15] + "Kg/h";
        document.getElementById('fandeb2').innerHTML = tabvar[36] + "Kg/h";

        //Stockage color

        document.getElementById('stockT1').innerHTML = tabvar[24] + "°C";
        document.getElementById('stockT2').innerHTML = tabvar[25] + "°C";
        document.getElementById('stockT3').innerHTML = tabvar[26] + "°C";
        document.getElementById('stockT4').innerHTML = tabvar[27] + "°C";
        document.getElementById('stockT5').innerHTML = tabvar[28] + "°C";
        document.getElementById('stockT6').innerHTML = tabvar[29] + "°C";
        document.getElementById('stockT7').innerHTML = tabvar[30] + "°C";
        document.getElementById('stockT8').innerHTML = tabvar[31] + "°C";
        document.getElementById('stockT9').innerHTML = tabvar[32] + "°C";



        //Ventilateur Recepteur

        if (tabvar[16] == 0) {

            fanRotation1.classList.remove('fan-rotation');
            section1.style.fill = "#FFF";

        }
        else if (tabvar[16] > 0) {

            fanRotation1.classList.add('fan-rotation');
            section1.style.fill = "#F7B207";

        }
        else {
            section1.style.fill = "#787878";    //En cas d'un manque de données on met en gris.
        }

        //Ventilateur Stockage

        if (tabvar[37] == 0) {

            fanRotation2.classList.remove('fan-rotation');
            section8.style.fill = "#FFF";

        }
        else if (tabvar[37] > 0) {

            fanRotation2.classList.add('fan-rotation');
            section8.style.fill = "#F7B207";

        }
        else {
            section8.style.fill = "#787878";
        }



        //Vanne 1

        if (tabvar[41] == 1) {
            vanne1.style.fill = "#6CC600";
        }
        else if (tabvar[41] == 0) {


            vanne1.style.fill = "#c1272d";


        }
        else {
            vanne1.style.fill = "#787878";
        }

        //Vanne 2

        if (tabvar[42] == 1) {
            vanne2.style.fill = "#6CC600";
        }
        else if (tabvar[42] == 0) {
            vanne2.style.fill = "#c1272d";

        }
        else {
            vanne2.style.fill = "#787878";
        }

        //Vanne3

        if (tabvar[43] == 1) {
            vanne3.style.fill = "#6CC600";
        }
        else if (tabvar[43] == 0) {
            vanne3.style.fill = "#c1272d";

        }
        else {
            vanne3.style.fill = "#787878";
        }

        //Vanne4

        if (tabvar[44] == 1) {
            vanne4.style.fill = "#6CC600";
            section7.style.fill = "#F7B207";
        }
        else if (tabvar[44] == 0) {
            vanne4.style.fill = "#c1272d";
            section7.style.fill = "#FFF";

        }
        else {
            vanne4.style.fill = "#787878";
            section7.style.fill = "#787878";
        }

        //Vanne5

        if (tabvar[45] == 1) {
            vanne5.style.fill = "#6CC600";
            section4.style.fill = "#F7B207"
        }
        else if (tabvar[45] == 0) {
            vanne5.style.fill = "#c1272d";
            section4.style.fill = "#FFF";

        }
        else {
            vanne5.style.fill = "#787878";
            section4.style.fill = "#787878";

        }

        //Vanne6

        if (tabvar[46] == 1) {
            vanne6.style.fill = "#6CC600";
            section3.style.fill = "#F7B207";
        }
        else if (tabvar[46] == 0) {
            vanne6.style.fill = "#c1272d";
            section3.style.fill = "#FFF";

        }
        else {
            vanne6.style.fill = "#787878";
            section3.style.fill = "#787878";

        }

        //Section2
        //Voir comment on peut ajouter une conditon dans le cas ou le champ est vide afin de mettre en gris la section
        //pour indiquer qu'il manque des données. 

        if (tabvar[41] == 1 || tabvar[42] == 1 || tabvar[45] == 1 || tabvar[46] == 1) {
            section2.style.fill = "#F7B207";
        }
        else {

            section2.style.fill = "#fff";

        }

        //Section 6 et 5

        if (tabvar[44] == 1 || tabvar[43] == 1 || tabvar[42] == 1) {

            section6.style.fill = "#F7B207";
            section5.style.fill = "#F7B207";
        }
        else {

            section6.style.fill = "#fff";
            section5.style.fill = "#fff";

        }

        //Couleur stockage 

        for (let pas = 24; pas < 33; pas++) {

            degg = document.getElementById(tabdeg[ideg]);

            if (tabvar[pas] >= 235) {

                degg.setAttribute("stop-color", "#8D0005");
            }
            else if (tabvar[pas] < 235 && tabvar[pas] >= 205) {
                degg.setAttribute("stop-color", "#FF1811");
            }
            else if (tabvar[pas] < 205 && tabvar[pas] >= 177.5) {
                degg.setAttribute("stop-color", "#FF7F22");
            }
            else if (tabvar[pas] < 177.5 && tabvar[pas] >= 152.5) {
                degg.setAttribute("stop-color", "#FFF93E");
            }
            else if (tabvar[pas] < 152.5 && tabvar[pas] >= 125) {
                degg.setAttribute("stop-color", "#70FE7D");
            }
            else if (tabvar[pas] < 125 && tabvar[pas] >= 95) {
                degg.setAttribute("stop-color", "#01FFFA");
            }
            else if (tabvar[pas] < 95 && tabvar[pas] >= 65) {
                degg.setAttribute("stop-color", "#0079F8");
            }
            else if (tabvar[pas] < 65 && tabvar[pas] >= 35) {
                degg.setAttribute("stop-color", "#001CF7");
            }
            else if (tabvar[pas] < 35) {
                degg.setAttribute("stop-color", "#000A7C");
            }
            else {
                degg.setAttribute("stop-color", "#787878");
            }

            ideg++;

        }

        //Flamme couleur

        if (tabvar[52] == 1) {
            flam1.style.fill = "#008FC3";
        }
        else {
            flam1.style.fill = "#EAEAEA";

        }

        if (tabvar[58] == 1) {
            flam2.style.fill = "#008FC3";
        }
        else {
            flam2.style.fill = "#EAEAEA";

        }

        //Four couleur

        if (tabvar[50] == 1) {
            oven1.style.fill = "#F7B207";
        }
        else {
            oven1.style.fill = "#FFF";
        }

        if (tabvar[56] == 1) {
            oven2.style.fill = "#F7B207";
        }
        else {
            oven2.style.fill = "#FFF";

        }

    }

}
setInterval(getData, 30000);


function hovertxt(x) {

    switch (x) {
        case "rcptT2":
            document.getElementById('rcptT2').innerHTML = "T2Récept";
            break;
        case "rcptT3":
            document.getElementById('rcptT3').innerHTML = "T3Récept";
            break;
        case "rcptT4":
            document.getElementById('rcptT4').innerHTML = "T4Récept";
            break;
        case "rcptTS":
            document.getElementById('rcptTS').innerHTML = "TSRécept";
            break;
        case "rcptTE":
            document.getElementById('rcptTE').innerHTML = "TERécept";
            break;
        case "oven1TE":
            document.getElementById('oven1TE').innerHTML = "TEFour 1";
            break;
        case "oven2TE":
            document.getElementById('oven2TE').innerHTML = "TEFour 2";
            break;
        case "fandeb1":
            document.getElementById('fandeb1').innerHTML = "DébitRécepteur";
            break;
        case "fandeb2":
            document.getElementById('fandeb2').innerHTML = "DébitStockage";
            break;
        case "oven1T":
            document.getElementById('oven1T').innerHTML = "TFour1";
            break;
        case "oven2T":
            document.getElementById('oven2T').innerHTML = "TFour2";
            break;
        case "stockT1":
            document.getElementById('stockT1').innerHTML = "T1Stock";
            break;
        case "stockT2":
            document.getElementById('stockT2').innerHTML = "T2Stock";
            break;
        case "stockT3":
            document.getElementById('stockT3').innerHTML = "T3Stock";
            break;
        case "stockT4":
            document.getElementById('stockT4').innerHTML = "T4Stock";
            break;
        case "stockT5":
            document.getElementById('stockT5').innerHTML = "T5Stock";
            break;
        case "stockT6":
            document.getElementById('stockT6').innerHTML = "T6Stock";
            break;
        case "stockT7":
            document.getElementById('stockT7').innerHTML = "T7Stock";
            break;
        case "stockT8":
            document.getElementById('stockT8').innerHTML = "T8Stock";
            break;
        case "stockT9":
            document.getElementById('stockT9').innerHTML = "T9Stock";
            break;


        default:
    }
}

function nonehovertxt() {

    document.getElementById('rcptT2').innerHTML = tabvar[5] + "°C";
    document.getElementById('rcptT3').innerHTML = tabvar[6] + "°C";
    document.getElementById('rcptT4').innerHTML = tabvar[7] + "°C";
    document.getElementById('rcptTS').innerHTML = tabvar[14] + "°C";                //Verifier quel capteur dans la réu skype
    document.getElementById('rcptTE').innerHTML = tabvar[12] + "°C";
    document.getElementById('oven1TE').innerHTML = tabvar[54] + "°C";
    document.getElementById('oven2TE').innerHTML = tabvar[60] + "°C";
    document.getElementById('oven1T').innerHTML = tabvar[53] + "°C";
    document.getElementById('oven2T').innerHTML = tabvar[59] + "°C";
    document.getElementById('fandeb1').innerHTML = tabvar[15] + "Kg/h";
    document.getElementById('fandeb2').innerHTML = tabvar[36] + "Kg/h";


}

function nonehoverstorage() {

    document.getElementById('stockT1').innerHTML = tabvar[24] + "°C";
    document.getElementById('stockT2').innerHTML = tabvar[25] + "°C";
    document.getElementById('stockT3').innerHTML = tabvar[26] + "°C";
    document.getElementById('stockT4').innerHTML = tabvar[27] + "°C";
    document.getElementById('stockT5').innerHTML = tabvar[28] + "°C";
    document.getElementById('stockT6').innerHTML = tabvar[29] + "°C";
    document.getElementById('stockT7').innerHTML = tabvar[30] + "°C";
    document.getElementById('stockT8').innerHTML = tabvar[31] + "°C";
    document.getElementById('stockT9').innerHTML = tabvar[32] + "°C";


}