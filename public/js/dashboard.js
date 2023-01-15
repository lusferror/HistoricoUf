
/* globals Chart:false, feather:false */
let arrayFechas=[]
let arrayValores=[]
function aplicarFiltroFecha(event){
  const desde= document.getElementById("fechaDesde").value
  const hasta=document.getElementById("fechaHasta").value
  
  console.log("Fecha desde: ",desde)
  console.log("Fecha hasta: ", hasta )
  mes="Marzo"
  console.log(mes)
  fetchFechas(desde,hasta,arrayFechas,arrayValores)
  console.log("Array fuera de fetch: ", arrayFechas)
  
  

}

function fetchFechas(desde,hasta,array,valores){
  fetch('http://homestead.test/api/filtroFecha',{
    method:'POST',
    headers:{
      'Content-Type':'application/json'
    },
    body:JSON.stringify({
      'desde':desde,
      'hasta':hasta
    })
  })
  .then(response=>response.json())
  .then(data=>{console.log(data)
    console.log("este es el array: ",array)
    data.map(item=>{
      array.push(item.fechaIndicador)
      valores.push(item.valorIndicador)
    })
    console.log(array)
    chart(array,valores)
  })
  .catch(error=>console.log(error))

}

const chart=(mes,valores) => {
  'use strict'
  console.log(mes)
  // Graphs
  const ctx = document.getElementById('myChart')
  // eslint-disable-next-line no-unused-vars
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels:mes,
      datasets: [{
        data: valores,
        lineTension: 0,
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        borderWidth: 4,
        pointBackgroundColor: '#007bff'
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: false
          }
        }]
      },
      legend: {
        display: false
      }
    }
  })
}

fetchFechas('2021-01-01','2021-01-10',arrayFechas,arrayValores)