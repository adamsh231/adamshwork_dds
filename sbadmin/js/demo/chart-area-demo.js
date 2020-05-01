// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

var getJSON = function(url, callback) {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', url, true);
  xhr.responseType = 'json';
  xhr.onload = function() {
    var status = xhr.status;
    if (status === 200) {
      callback(null, xhr.response);
    } else {
      callback(status, xhr.response);
    }
  };
  xhr.send();
}; 

getJSON('https://ddspkmbareng.id/index.php/DDS_Json',function(err, data){
    if (err !== null) {
      alert('Something went wrong: ' + err);
    } else {
      var sd3 = [];
      var msd3 = [];
      var no = [];
      var zbb = [];
      var ztb = [];
      var datax = [];
      for (i = 0; i < data.length; i++) {
        // arr[i] = data[i].umur;
        // msd3[i] = data[i]['-3sd'];
        sd3[i] = 2;
        msd3[i] = -2;
        no[i] = data[i].usia;
        zbb[i] = data[i].zbb;
        ztb[i] = data[i].ztb;
      }
      sd3[data.length] = 2;
      msd3[data.length] = -2;
      no[data.length] = parseInt(no[data.length-1])+1;
      
      datax['sd3'] = sd3;
      datax['msd3'] = msd3;
      datax['no'] = no;
      datax['zbb'] = zbb;
      datax['ztb'] = ztb;
      drawChart(datax);
      // alert(data[2].zbb)
    }
  });

function drawChart(data){
  // Area Chart Example
  // data['no'][data.length] = data.length + 1;
  var ctx = document.getElementById("myAreaChart");
  var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: data['no'],
      datasets: [
        //BATAS
        {
          label: "Batas Atas",
          lineTension: 0.3,
          backgroundColor: "rgba(10, 255, 10, 0.2)",
          borderColor: "rgba(255, 0, 0, 0.6)",
          pointRadius: 0,
          pointBackgroundColor: "rgba(78, 115, 223, 1)",
          pointBorderColor: "rgba(78, 115, 223, 1)",
          pointHoverRadius: 0,
          pointHoverBackgroundColor: "grey",
          pointHoverBorderColor: "grey",
          pointHitRadius: 0,
          pointBorderWidth: 2,
          data: data['sd3'],
          fill: true
        },
        {
          label: "Batas Bawah",
          lineTension: 0.3,
          backgroundColor: "rgba(10, 255, 10, 0.2)",
          borderColor: "rgba(255, 0, 0, 0.6)",
          pointRadius: 0,
          pointBackgroundColor: "rgba(102, 255, 102, 1)",
          pointBorderColor: "rgba(102, 255, 102, 1)",
          pointHoverRadius: 0,
          pointHoverBackgroundColor: "grey",
          pointHoverBorderColor: "grey",
          pointHitRadius: 0,
          pointBorderWidth: 2,
          data: data['msd3'],
          fill: true
        },
      //BATAS
        {
          label: "TB/U",
          lineTension: 0.3,
          backgroundColor: "rgba(0, 0, 0, 0)",
          borderColor: "rgb(95, 110, 226)",
          pointRadius: 3,
          pointBackgroundColor: "rgb(95, 110, 226)",
          pointBorderColor: "rgb(95, 110, 226)",
          pointHoverRadius: 3,
          pointHoverBackgroundColor: "grey",
          pointHoverBorderColor: "grey",
          pointHitRadius: 10,
          pointBorderWidth: 2,
          data: data['ztb'],
          fill: false
        },
        {
          label: "BB/U",
          lineTension: 0.3,
          backgroundColor: "rgba(0, 0, 0, 0)",
          borderColor: "rgb(81, 29, 29)",
          pointRadius: 3,
          pointBackgroundColor: "rgb(81, 29, 29)",
          pointBorderColor: "rgb(81, 29, 29)",
          pointHoverRadius: 3,
          pointHoverBackgroundColor: "grey",
          pointHoverBorderColor: "grey",
          pointHitRadius: 10,
          pointBorderWidth: 2,
          data: data['zbb'],
          fill: false
        }
      
      ],
    },
    options: {
      maintainAspectRatio: false,
      spanGaps: true,
      layout: {
        padding: {
          left: 10,
          right: 25,
          top: 25,
          bottom: 0
        }
      },
      scales: {
        xAxes: [{
          scaleLabel: {
            display: true,
            labelString: 'Umur (Bulan)'
          },
          gridLines: {
            display: true,
            drawBorder: true,
            borderDash: [2],
            zeroLineBorderDash: [2]
          },
          ticks: {
            maxTicksLimit: 7,
          }
        }],
        yAxes: [{
          ticks: {
            maxTicksLimit: 5,
            padding: 10,
            // Include a dollar sign in the ticks
            callback: function(value, index, values) {
              if(value == 0){
                return 'Normal';
              }else{
                return number_format(value);
              }
            },
          },
          gridLines: {
            display: true,
            color: "rgb(234, 236, 244)",
            zeroLineColor: "black",
            drawBorder: true,
            borderDash: [2],
            zeroLineBorderDash: [2]
          },
          scaleLabel: {
            display: true,
            labelString: 'Z score (SD)'
          }
        }],
      },
      legend: {
        display: false
      },
      tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        intersect: true,
        mode: 'nearest',
        caretPadding: 10,
        callbacks: {
          label: function(tooltipItem, chart) {
            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel +' '+ number_format(tooltipItem.yLabel) + ' SD';
          }
        }
      }
    }
  });
}