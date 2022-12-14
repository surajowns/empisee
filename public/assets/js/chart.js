$(function(){
     
	// Pie Chart
	// var APP_URL =url('/');

	// var url={{url("chart_data")}};
	// console.log(APP_URL);
	var department_list;
	var departmemt_count;
          $.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
	$.ajax({
        Type:"get",
        url :'https://www.empisee.com/chart_data',
        dataType:'json',
        cache: false,
        data: {},
        success: function(response){
			department_list=response.department_list;
		    departmemt_count=response.departmemt_count;
			
        }
     });

	 setTimeout(() => {
        var ctx = document.getElementById('pieChart').getContext('2d');
	var pieChart = new Chart(ctx, {
		type: 'pie',
		data: {
			labels:department_list,
			datasets: [{
				label: '# of Votes',
				data: departmemt_count,
				backgroundColor: [
					'rgba(255, 99, 132, 1)',
					'#3E007C',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)',
					'#2E4053',
					'#E74C3C',
					'#76D7C4'
				],
				borderWidth: 1
			}]
		},
		options: {
			responsive: true,
			legend: {
				display: false
			}
		}
	});
    }, 2000);
	
	

	// Line Chart
	
	var ctx = document.getElementById("lineChart").getContext('2d');
	var lineChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: ["Jan",	"Feb",	"Mar",	"Apr",	"May"],
			datasets: [{
				label: 'Developer',
				data: [20,	10,	5,	5,	20],
				fill: false,
				borderColor: '#373651',
				backgroundColor: '#373651',
				borderWidth: 1
			},
					  {
				label: 'Marketing',
				data: [2,	2,	3,	4,	1],
				fill: false,
				borderColor: '#E65A26',
				backgroundColor: '#E65A26',
				borderWidth: 1
			},
					  {
				label: 'Marketing',
				data: [1,	3,	6,	8,	10],
				fill: false,
				borderColor: '#a1a1a1',
				backgroundColor: '#a1a1a1',
				borderWidth: 1
			}]
		},
		options: {
		  responsive: true,
			legend: {
				display: false
			}
		}
	});

});