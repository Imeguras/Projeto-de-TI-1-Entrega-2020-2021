
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
        let dataC=0;
        let horaC=0;
        let valorsC=0;
        let oldd="";
        let olddd=""; 
        for (let index = 0; index < goal-1; index++) {
            
            linha=texto[index].split(/ |;/);
            if(oldd!=linha[0]){
                oldd=linha[0]
                dataC++;
                document.getElementById("paginaTabela1").innerHTML+='<div class="separadorTabela" id="separadorTabela'+dataC+'">\n\t<div class="decoracaoSeparador" id="decoracaoSeparador'+dataC+'">\n\t\t<div class="circuloDecoracaoSeparador">\n\t\t</div>\n\t\t<div class="barraDecoracaoSeparador">\n\t\t</div>\n\t</div>\n\t<div class="grupoData" id="Data'+dataC+'">\n\t\t<div class="decoracaoData" id="decoracaoData'+dataC+'"> </div>\n\t\t<div class="textoData" id="textoData'+dataC+'">'+linha[0]+'</div>\n\t</div>\n</div>\n<div class="SubTabela" id="SubTabela'+Math.floor(horaC/6)+1+'"></div>'
            }
            let disp=linha[1].split(":");
            //todo if pair class is dif
            document.getElementById("SubTabela"+Math.floor(horaC/6)+1).innerHTML+='<div class="Entrada" id="Entrada'+horaC+'">\n<div class="Tempo" id="Tempo'+horaC+'">\n\t<div class="decoracaoTempo1" id="decoracaoData'+horaC+'"> </div>\n\t<div class="textoTempo" id="textoTempo'+horaC+'">'+disp[0]+':'+disp[1]+'</div>\n</div>\n<div class="Info" id="Info'+horaC+'">\n\t<div class="decoracaoInfo1" id="decoracaoInfo'+horaC+'"> </div>\n\t<div class="textoInfo" id="textoInfo1">'+disp[2]+'s:'+linha[2]+'</div>\n</div>\n</div>';
            horaC++;
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
