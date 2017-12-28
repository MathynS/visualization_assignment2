<template>
    <div class="container">
        <div class="row">

            <span>NO2</span>
            <label class="switch">
                <input type="radio" v-model="pollutionType" value="NO2">
                <span class="checker round"></span>
            </label>

            <span>O3</span>
            <label class="switch">
                <input type="radio" v-model="pollutionType" value="O3">
                <span class="checker round"></span>
            </label>

            <span>SO2</span>
            <label class="switch">
                <input type="radio" v-model="pollutionType" value="SO2">
                <span class="checker round"></span>
            </label>

            <span>CO</span>
            <label class="switch">
                <input type="radio" v-model="pollutionType" value="CO">
                <span class="checker round"></span>
            </label>
        </div>

        <div class="row">
            <div id="tooltip"></div><!-- div to hold tooltip. -->
            <svg width="960" height="600" id="statesvg"></svg> <!-- svg to hold the map. -->
        </div>

        <div class="row">
            <div class="slidecontainer">
                <input type="range" min="0" max="364" value="0" class="slider" v-model="dateSlider" v-bind:onchange="updateDate()">
            </div>
            <span>{{date}}</span>
        </div>
    </div>
</template>

<script>


    function doubleDigit(digit) {
        if (digit.toString().length == 1) {
            return "0" + digit;
        }
        return digit;
    }

    function formatDate(date) {
        var day = doubleDigit(date.getDate());
        var month = doubleDigit(date.getMonth()+1);
        var year = date.getFullYear();
        return year + '-' + month + '-' + day + " 00:00:00";
    }

    function tooltipHtml(n, d){	/* function to create html content string in tooltip div. */
        return "<h4>"+n+"</h4><table>"+
            "<tr><td>Max</td><td>"+(d.max)+"</td></tr>"+
            "<tr><td>Average</td><td>"+(d.mean)+"</td></tr>"+
            "</table>";
    }

    export default {
        data: function(){
            return{
                date: new Date('2000-01-01'),
                totalData: {},
                dateSlider: 0,
                lastSlider: 0,
                pollutionType: 'NO2'
            }
        },
        mounted() {
            axios.get('/data/cache/states')
                .then(response => this.setData(response.data))
                .catch(error => console.log(error))
        },
        methods: {
            setData(data) {
                this.totalData = data;
                this.getMapData('2000-01-01 00:00:00');
            },
            getMapData(date) {
                console.log(date);
                console.log(this.pollutionType);
                var data = {};
                for (var state in this.totalData) {
                    if (this.totalData[state][this.pollutionType][date] !== undefined) {
                        data[state] = this.totalData[state][this.pollutionType][date];
                    }
                }
                console.log(data);
                this.drawMap(data);
            },
            updateDate() {
                console.log(this.dateSlider);
                this.date.setDate(this.date.getDate() + (this.dateSlider - this.lastSlider));
                this.lastSlider = this.dateSlider;
                this.getMapData(formatDate(this.date));
            },
            drawMap(data) {
                ["HI", "AK", "FL", "SC", "GA", "AL", "NC", "TN", "RI", "CT", "MA",
                    "ME", "NH", "VT", "NY", "NJ", "PA", "DE", "MD", "WV", "KY", "OH",
                    "MI", "WY", "MT", "ID", "WA", "DC", "TX", "CA", "AZ", "NV", "UT",
                    "CO", "NM", "OR", "ND", "SD", "NE", "IA", "MS", "IN", "IL", "MN",
                    "WI", "MO", "AR", "OK", "KS", "LS", "VA"]
                    .forEach(function(d){
                        if (data[d] == null) {
                            data[d] = {};
                            data[d]['mean'] = 0;
                            data[d]['max'] = 0;
                        }
                    });
                for (var state in data) {
                    data[state]['color'] = d3.interpolate("#ffffcc", "#800026")(data[state]['max']/100);
                }
                console.log(data)
                d3.select('svg').text('');
                uStates.draw("#statesvg", data, tooltipHtml);
                d3.select(self.frameElement).style("height", "600px");
            }
        }
    }
</script>
