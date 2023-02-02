


const skipped = (ctx, value) => ctx.p0.skip || ctx.p1.skip ? value : undefined;

const config = {
	type: 'line',
	data: {
		datasets: [{
				label: 'Radijator',
				data: radijatorData,
				borderColor: "#F00",
				backgroundColor: "#F00",
				pointStyle: false,
				segment: {
					borderColor: ctx => skipped(ctx, 'rgb(0,0,0,0.2)'),
					borderDash: ctx => skipped(ctx, [6, 6]),
				  },
				spanGaps: true,
				cubicInterpolationMode: 'monotone',
				tension: 0
			},
			{
				label: 'Sobna',
				data: sobnaData,
				borderColor: "#0F0",
				backgroundColor: "#0F0",
				pointStyle: false,
				segment: {
					borderColor: ctx => skipped(ctx, 'rgb(0,0,0,0.2)'),
					borderDash: ctx => skipped(ctx, [6, 6]),
				  },
				spanGaps: true,
				cubicInterpolationMode: 'monotone',
				tension: 0.4
			},
			{
				label: 'Klima',
				data: klimaData,
				borderColor: "#22F",
				backgroundColor: "#22F",
				pointStyle: false,
				segment: {
					borderColor: ctx => skipped(ctx, 'rgb(0,0,0,0.2)'),
					borderDash: ctx => skipped(ctx, [6, 6]),
				  },
				spanGaps: true,
				cubicInterpolationMode: 'monotone',
				tension: 0.4
			},
			{
				label: 'Prozor',
				data: prozorData,
				borderColor: "#00F",
				backgroundColor: "#00F",
				stepped: true,
				pointStyle: false,
				yAxisID: 'y2',
				segment: {
					borderColor: ctx => skipped(ctx, 'rgb(0,0,0,0.2)'),
					borderDash: ctx => skipped(ctx, [6, 6]),
				  },
				spanGaps: true,
				cubicInterpolationMode: 'monotone',
				tension: 0.4
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
			pan: {
				enabled: true,
				mode: "xy",
			  },
			  zoom: {
				wheel: {enabled: true,},
				mode: 'xy',
			  }
		},
		scales: {
			y: {
				type: 'linear',
				position: 'left',
				stack: 'main',
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
				stack: 'main',
				stackWeight: 1,
				border: {
					color: "blue"
				}
			},
			x: {
				type: "time",
				time: {
					unit: 'hour',
					displayFormats: {
						'hour':'HH:mm'
					 }
				},
			}
		},
		zoom: {
			zoom: {
			  wheel: {enabled: true,},
			  mode: 'x',   
			},
			pan: {
			  enabled: true,
			  mode: 'x',
			},
			limits: {
			  x: { min: radijatorData[0].x, max: radijatorData[radijatorData.length-1].x },
			},
		  },


	}
};


window.onload = function() {
	const ctx = document.getElementById('myChart');
	new Chart(ctx, config);
}