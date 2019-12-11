var num = process.argv[2];
var numBinario = [];

if (esCalculable(num)) {
    if (esFloat(num)) {
        numBinario = floatToBinary(num);
    } else {
        // es decimal

    }
    console.log(numBinario)
   /* var esNegativo = esNegativo(num);
    var numString = "";
    if (esNegativo) num = positivar(num);
    var i = 0;
    var resto;
    do {
        resto = Math.floor(num % 2);
        console.log(resto);
        num = Math.floor(num / 2);
        numBinario[i++] = resto;
        if (num == 1) numBinario[i] = 1;
    } while (num != resto);

    if (esNegativo) numString = "-";
    numString += numBinario.reverse().toString().replace(/,/g, "");
    console.log(numString);*/
}

function esCalculable(num) {
    return !isNaN(num)
}

function positivar(num) {
    return num <= 0 ? num * -1 : num;
}

function esNegativo(num) {
    return num < 0;
}
function esFloat(num) {
    return num.toString().includes(".");
}

function floatToBinary(num) {
    var numBinario = []
    var resto;
    var num = getParteDecimal(num);
    var contador = 0;
   do {
        resto = num * 2;
        numBinario[contador] = Math.floor(resto);
        num = resto;
        contador++;
        if(num == 1) break;
    } while (true);
    return numBinario.toString().replace(/,/g, "");
}

function getParteDecimal(num) {
    var size = num.toString().length;
    var posicionComa = num.toString().indexOf(".");
    var float = "0";
    float += num.toString().substring(posicionComa, size);
    return Number(float);
}