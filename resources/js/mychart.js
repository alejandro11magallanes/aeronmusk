import Chart from 'chart.js/auto';

const labels = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
];

const data = {
    labels: labels,
    datasets: [{
        label: 'My First dataset',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: [0, 10, 5, 2, 20, 30, 45],
    }]
};

const config = {
    type: 'line',
    data: data,
    options: {}
};

new Chart(
    document.getElementById('myChart'),
    config
);

const canvas2 = document.getElementById('myChart2');

// Crea los datos de la gráfica
const data2 = {
  labels: ['Red', 'Blue', 'Yellow'],
  datasets: [{
    data: [10, 20, 30],
    backgroundColor: ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 205, 86)'],
  }]
};

// Configuración de la gráfica
const config2 = {
  type: 'doughnut',
  data: data2,
};



new Chart(
    document.getElementById('myChart2'),
    config2
);