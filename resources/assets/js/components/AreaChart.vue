<template>

	<div>
		<svg width="960" height="600" id="areasvg"></svg>
	</div>

</template>

<script>

	export default {
        data: function(){
            return{
                data: {},
                pollutionType: 'NO2'
            }
        },
        mounted() {
        	axios.get('/data/cache/states')
                .then(response => this.drawChart(response.data))
                .catch(error => console.log(error))
        },
        methods: {
        	drawChart(response) {
        		console.log(response);
        		var data = []
        		for (var date in response.dates){
        			console.log(response.dates[date]);
        			if (Date(response.dates[date]) > Date("2001-01-01 00:00:00")) {
        				break;
        			}
        			var point = {"quarter": response.dates[date]};
        			for (var state in response.data) {
        				var state_name = response.data[state]['name'];
        				if (response.data[state][this.pollutionType] == undefined) {
        					point[state_name] = 0;
        				}
        				else if (response.data[state][this.pollutionType][response.dates[date]] == undefined) {
        					point[state_name] = 0;
        				}
        				else {
        					point[state_name] = response.data[state][this.pollutionType][response.dates[date]]['max'];
        				}
	        		}
	        		data.push(point);
        		}
        		console.log(data);
        		

        		// var data = [
        		// {
        		// 	"quarter": "2008-Q1",
        		// 	"ANGEL": 339,
        		// 	"SERIES-A": 345,
        		// 	"SERIES-B": 186,
        		// 	"SERIES-C+": 130,
        		// 	"VENTURE": 233
        		// },
        		// {
        		// 	"quarter": "2008-Q2",
        		// 	"ANGEL": 197,
        		// 	"SERIES-A": 272,
        		// 	"SERIES-B": 169,
        		// 	"SERIES-C+": 145,
        		// 	"VENTURE": 197
        		// }
	        	// ];
	        	areaChart.draw(data);
        	}	
        }
    }
</script>