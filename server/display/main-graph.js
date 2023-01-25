document.querySelector('body').style.margin = "0px 2.5vw";

const ctx = document.getElementById('myChart');

let chart = new Chart(ctx, {
	type: 'line',
	data: {
		datasets: [{
				label: 'Radijator',
				data: radijatorData,
				borderColor: "#F00",
				backgroundColor: "#F00",
				pointStyle: false,
			},
			{
				label: 'Sobna',
				data: sobnaData,
				borderColor: "#0F0",
				backgroundColor: "#0F0",
				pointStyle: false,
			},
			{
				label: 'Klima',
				data: klimaData,
				borderColor: "#22F",
				backgroundColor: "#22F",
				pointStyle: false,
			},
			{
				label: 'Prozor',
				data: prozorData,
				borderColor: "#00F",
				backgroundColor: "#00F",
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