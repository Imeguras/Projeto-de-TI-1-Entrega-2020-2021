
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [ 
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                
                beginAtZero: true
            }
        }
    }
});

var reader = new XMLHttpRequest() || new ActiveXObject('MSXML2.XMLHTTP');

function loadFile(path) {
    reader.open('get', path, true); 
    reader.onreadystatechange = returntxtContents;
    reader.send(null);
}

function returntxtContents() {
    if(reader.readyState==4) {
        let texto= reader.responseText;
        texto=texto.split(/\r\n|\r|\n/);
        let goal=texto.length;
        //boogaloo codigo
        let oldd="";
        for (let index = 0; index < goal; index++) {
            
            linha=texto[index].split(/ |;/);
            if(oldd!=linha[0]){
                oldd=linha[0]
                document.getElementById("paginaTabela1").innerHTML+='<div class="separadorTabela" id="separadorTabela1">\n\t<div class="decoracaoSeparador" id="decoracaoSeparador1">\n\t\t<div class="circuloDecoracaoSeparador">\n\t\t</div>\n\t\t<div class="barraDecoracaoSeparador">\n\t\t</div>\n\t</div>\n\t<div class="grupoData" id="Data1">\n\t\t<div class="decoracaoData" id="decoracaoData1"> </div>\n\t\t<div class="textoData" id="textoData1">'+linha[0]+'</div>\n\t</div>\n</div>'
            }
            /*
            Debug 
            console.log("dia:"+linha[0]);
            console.log("hora:"+linha[1]);
            console.log("valor:"+linha[2]);
            */

        }
    }
}
//console.log(texto[index])
loadFile("api/files/botao/log.txt")
