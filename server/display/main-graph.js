const ctx = document.getElementById('myChart');

let chart = new Chart(ctx, {
	type: 'line',
	data: {
		datasets: [{
				label: 'Radijator',
				data: [10, 30, 50, 20, 25, 44, -10],
				borderColor: "#F00",
				backgroundColor: "#F00",
				pointStyle: false,
			},
			{
				label: 'Zrak',
				data: [20, 60, 70, 80, 95, 14, -10],
				borderColor: "#0F0",
				backgroundColor: "#0F0",
				pointStyle: false,
			},
			{
				label: 'Klima',
				data: [20, 60, 70, 80, 95, 14, -10],
				borderColor: "#00F",
				backgroundColor: "#00F",
				pointStyle: false,
			},
			{
				label: 'Prozor',
				fill: true,
				data: prozorData,
				borderColor: "#00F",
				backgroundColor: "#009",
				stepped: true,
				pointStyle: false,
				yAxisID: 'y2',
			}
		],
	},
	options: {
		responsive: true,
		plugins: {
			title: {
				display: true,
				text: 'Temperatura - otvoreni prozor',
			},
		},
		scales: {
			y: {
				type: 'linear',
				position: 'left',
				stack: 'demo',
				stackWeight: 4,
				border: {
					color: "red"
				}
			},
			y2: {
				type: 'category',
				labels: ['OTVOREN', 'ZATVOREN'],
				offset: true,
				position: 'left',
				stack: 'demo',
				stackWeight: 1,
				border: {
					color: "blue"
				}
			},
			x: {
				type: "time",
				time: {
					unit: 'hour'

				}
			}
		}
	}
});