<template>
	<div class="container">
		<div class="row">
			<div class="col-xs-9 vis-column">
			<div class="row" id="toolbar">
				<div class="col-xs-6">
					<div class="row">
	            <span>NO2</span>
	            <label class="switch">
	                <input type="radio" v-model="pollutionType" v-on:change="refreshCharts" value="NO2">
	                <span class="checker round"></span>
	            </label>

							<span>O3</span>
							<label class="switch">
									<input type="radio" v-model="pollutionType" v-on:change="refreshCharts" value="O3">
									<span class="checker round"></span>
							</label>

							<span>SO2</span>
	            <label class="switch">
	                <input type="radio" v-model="pollutionType" v-on:change="refreshCharts" value="SO2">
	                <span class="checker round"></span>
	            </label>

	            <span>CO</span>
	            <label class="switch">
	                <input type="radio" v-model="pollutionType" v-on:change="refreshCharts" value="CO">
	                <span class="checker round"></span>
	            </label>
	        </div>
				</div>
				<div class="col-xs-6">
    			<div class="row">
        		<div class='col-xs-6'>
							<label for="firstDateFilter">First month</label>
            	<input type="date" v-model="firstDateFilterStr" v-on:input="updateFirstDateFilter" name="firstDateFilterInput" id="firstDateFilter">
        		</div>
        		<div class='col-xs-6'>
							<label for="lastDateFilter">Last month</label>
            	<input type="date" v-model="lastDateFilterStr" v-on:input="updateLastDateFilter" name="lastDateFilterInput" id="secondDateFilter">
        		</div>
    			</div>
				</div>

			</div>
			<div class="row">
				<svg width="800" height="480" class="svg-chart" id="area-svg"></svg>

				<!--
				<div class="trend-area-charts-container" id="trend-container" v-if="trendEnabled">
					<svg width="800" height="270" class="svg-chart" id="ttrend-svg"></svg>
					<svg width="800" height="270" class="svg-chart" id="tarea-svg"></svg>
				</div>
				<div class="area-chart-container" id="area-container" v-else>
					<svg width="800" height="540" class="svg-chart" id="area-svg"></svg>
				</div>
			-->

			</div>
			<div class="row">
				<div class="col-xs-6">
					<div class="row">
						<button type="button" class="btn btn-primary btn-arrow-left" v-on:click="decreaseRangeOfDates">Previous month</button>
					</div>
				</div>
				<div class="col-xs-6">
					<div class="row">
						<button type="button" class="btn btn-primary btn-arrow-right right-aligned" v-on:click="increaseRangeOfDates">Next month</button>
					</div>
				</div>
			</div>
		</div>
			<div class="col-xs-2 states-column">
				<div class="checkbox-container">
					<div class="dropdown-checkbox" id="us-states-container">
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Armed Forces America" id="checkArmedForcesAmerica">
					<label class="form-check-label" for="checkArmedForcesAmerica">Armed Forces America</label>
				</div>
					<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Armed Forces" id="checkArmedForces">
					<label class="form-check-label" for="checkArmedForces">Armed Forces</label>
					</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Armed Forces Pacific" id="checkArmedForcesPacific">
					<label class="form-check-label" for="checkArmedForcesPacific">Armed Forces Pacific</label>
					</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Alaska" id="checkAlaska">
					<label class="form-check-label" for="checkAlaska">Alaska</label>
					</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Alabama" id="checkAlabama">
					<label class="form-check-label" for="checkAlabama">Alabama</label>
					</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Arkansas" id="checkArkansas">
					<label class="form-check-label" for="checkArkansas">Arkansas</label>
					</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Arizona" id="checkArizona">
					<label class="form-check-label" for="checkArizona">Arizona</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="California" id="checkCalifornia">
					<label class="form-check-label" for="checkCalifornia">California</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Colorado" id="checkColorado">
					<label class="form-check-label" for="checkColorado">Colorado</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Connecticut" id="checkConnecticut">
					<label class="form-check-label" for="checkConnecticut">Connecticut</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Washington" id="checkWashington">
					<label class="form-check-label" for="checkWashington">Washington</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Delaware" id="checkDelaware">
					<label class="form-check-label" for="checkDelaware">Delaware</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Florida" id="checkFlorida">
					<label class="form-check-label" for="checkFlorida">Florida</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Georgia" id="checkGeorgia">
					<label class="form-check-label" for="checkGeorgia">Georgia</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Guam" id="checkGuam">
					<label class="form-check-label" for="checkGuam">Guam</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Hawaii" id="checkHawaii">
					<label class="form-check-label" for="checkHawaii">Hawaii</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Iowa" id="checkIowa">
					<label class="form-check-label" for="checkIowa">Iowa</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Idaho" id="checkIdaho">
					<label class="form-check-label" for="checkIdaho">Idaho</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Illinois" id="checkIllinois">
					<label class="form-check-label" for="checkIllinois">Illinois</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Indiana" id="checkIndiana">
					<label class="form-check-label" for="checkIndiana">Indiana</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Kansas" id="checkKansas">
					<label class="form-check-label" for="checkKansas">Kansas</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Kentucky" id="checkKentucky">
					<label class="form-check-label" for="checkKentucky">Kentucky</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Louisiana" id="checkLouisiana">
					<label class="form-check-label" for="checkLouisiana">Louisiana</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Massachusetts" id="checkMassachusetts">
					<label class="form-check-label" for="checkMassachusetts">Massachusetts</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Maryland" id="checkMaryland">
					<label class="form-check-label" for="checkMaryland">Maryland</label>
				</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Maine" id="checkMaine">
							<label class="form-check-label" for="checkMaine">Maine</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Michigan" id="checkMichigan">
							<label class="form-check-label" for="checkMichigan">Michigan</label>
						</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Minnesota" id="checkMinnesota">
					<label class="form-check-label" for="checkMinnesota">Minnesota</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Missouri" id="checkMissouri">
					<label class="form-check-label" for="checkMissouri">Missouri</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Mississippi" id="checkMississippi">
					<label class="form-check-label" for="checkMississippi">Mississippi</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Montana" id="checkMontana">
					<label class="form-check-label" for="checkMontana">Montana</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="North Carolina" id="checkNorthCarolina">
					<label class="form-check-label" for="checkNorthCarolina">North Carolina</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="North Dakota" id="checkNorthDakota">
					<label class="form-check-label" for="checkNorthDakota">North Dakota</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Nebraska" id="checkNebraska">
					<label class="form-check-label" for="checkNebraska">Nebraska</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="New Hampshire" id="checkNewHampshire">
					<label class="form-check-label" for="checkNewHampshire">New Hampshire</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="New Jersey" id="checkNewJersey">
					<label class="form-check-label" for="checkNewJersey">New Jersey</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="New Mexico" id="checkNewMexico">
					<label class="form-check-label" for="checkNewMexico">New Mexico</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Nevada" id="checkNevada">
					<label class="form-check-label" for="checkNevada">Nevada</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="New York" id="checkNewYork">
					<label class="form-check-label" for="checkNewYork">New York</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Ohio" id="checkOhio">
					<label class="form-check-label" for="checkOhio">Ohio</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Oklahoma" id="checkOklahoma">
					<label class="form-check-label" for="checkOklahoma">Oklahoma</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Oregon" id="checkOregon">
					<label class="form-check-label" for="checkOregon">Oregon</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Pennsylvania" id="checkPennsylvania">
					<label class="form-check-label" for="checkPennsylvania">Pennsylvania</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Puerto Rico" id="checkPuertoRico">
					<label class="form-check-label" for="checkPuertoRico">Puerto Rico</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Rhode Island" id="checkRhodeIsland">
					<label class="form-check-label" for="checkRhodeIsland">Rhode Island</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="South Carolina" id="checkSouthCarolina">
					<label class="form-check-label" for="checkSouthCarolina">South Carolina</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="South Dakota" id="checkSouthDakota">
					<label class="form-check-label" for="checkSouthDakota">South Dakota</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Tennessee" id="checkTennessee">
					<label class="form-check-label" for="checkTennessee">Tennessee</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Texas" id="checkTexas">
					<label class="form-check-label" for="checkTexas">Texas</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Utah" id="checkUtah">
					<label class="form-check-label" for="checkUtah">Utah</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Virginia" id="checkVirginia">
					<label class="form-check-label" for="checkVirginia">Virginia</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Virgin Islands" id="checkVirginIslands">
					<label class="form-check-label" for="checkVirginIslands">Virgin Islands</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Vermont" id="checkVermont">
					<label class="form-check-label" for="checkVermont">Vermont</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Washington" id="checkWashington">
					<label class="form-check-label" for="checkWashington">Washington</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Wisconsin" id="checkWisconsin">
					<label class="form-check-label" for="checkWisconsin">Wisconsin</label>
				</div>
						<div class="form-check">
					<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="West Virginia" id="checkWestVirginia">
					<label class="form-check-label" for="checkWestVirginia">West Virginia</label>
				</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" v-on:change="refreshCharts" value="Wyoming" id="checkWyoming">
							<label class="form-check-label" for="checkWyoming">Wyoming</label>
						</div>
					</div>
				</div>
				<div id="trendOptionDiv">
					<input type="checkbox" id="enableTrendOption" name="trend" value="show" v-on:change="enableTrendChart">
    			<label for="enableTrendOption">Show trend chart</label>
				</div>
			</div>
		</div>
	</div>
</template>

<script>

	export default {
        data: function(){
            return{
                data: {},
								backendData: null,
								viewData: [],
								firstDateDataset: null,
								lastDateDataset: null,
								firstDateFilter:null,
								lastDateFilter:null,
								firstDateFilterStr: '',
								lastDateFilterStr: '',
                pollutionType: 'NO2',
								selectedStates: [],
								selectedState: '',
								statType: 'max',
								trendEnabled: false,
								averagedData: []
            }
        },
        mounted() {
        	axios.get('/data/cache/states')
								.then(response => this.loadData(response.data))
                .then(response => this.drawCharts())
                .catch(error => console.log(error));
        },
        methods: {

					addState(){
						this.selectedStates.push(this.selectedState);
						//console.log("adding state " + this.selectedState);
						this.selectedState = '';
						this.refreshCharts();
					},

					enableTrendChart(){
						console.log("**** enabling trend option ");
						var enableTrendElement = document.getElementById("enableTrendOption");
						this.trendEnabled = enableTrendElement.checked;
						this.refreshCharts();
						this.refres
					},

					drawCharts(){
						if(this.trendEnabled){
							this.drawBothCharts();
						} else {
							this.drawAreaChart();
						}
					},

					refreshCharts(){
						if (this.trendEnabled){
							console.log("******************** trend enabled ********************");
							this.refreshBothCharts();
						} else {
							this.refreshAreaChart();
						}
					},

					refreshBothCharts(){
						console.log(" ************************ Refreshing both charts...");
						this.selectedStates = [];
						var checkboxContainer = document.getElementById("us-states-container");
						var checkboxes = checkboxContainer.getElementsByClassName("form-check-input");
						for (var i = 0; i < checkboxes.length; i++){
							var state = checkboxes[i].value;
							var isSelected = checkboxes[i].checked;
							if (isSelected){
								this.selectedStates.push(state);
							}
						}
						this.updateViewData();
						this.computeMovingAverage();
						this.drawBothCharts();
					},

					refreshAreaChart(){
						// update the list of states to show
						this.selectedStates = [];
						var checkboxContainer = document.getElementById("us-states-container");
						var checkboxes = checkboxContainer.getElementsByClassName("form-check-input");
						for (var i = 0; i < checkboxes.length; i++){
							var state = checkboxes[i].value;
							var isSelected = checkboxes[i].checked;
							if (isSelected){
								this.selectedStates.push(state);
							}
						}
						this.updateViewData();
						// we shouldn't need to compute the moving average, just in case
						this.computeMovingAverage();
						this.drawAreaChart();
					},

					updateFirstDateFilter(){
							console.log("updating first date filter");
							this.firstDateFilter = this.createDate(this.firstDateFilterStr);
							this.refreshCharts();
					},

					updateLastDateFilter(){
							console.log("updating last date filter");
							this.lastDateFilter = this.createDate(this.lastDateFilterStr);
							this.refreshCharts();
					},

					createCheckBoxMenu(state){
						var checkboxId = "check" + state.split(" ").join("");
						var checkboxMenu = "<div class=\"form-check\">\n";
						checkboxMenu = checkboxMenu + "\t<input class=\"form-check-input\" type=\"checkbox\" value=\"";
						checkboxMenu = checkboxMenu + state;
						checkboxMenu = checkboxMenu + "\" id=\"" + checkboxId + "\">\n";
						checkboxMenu = checkboxMenu + "\t<label class=\"form-check-label\" for=\"" + checkboxId + "\">" + state + "</label>\n";
						checkboxMenu = checkboxMenu + "</div>";
						return checkboxMenu;
					},

					selectDefaultDates(dates){
						var lastYear = 0;
						var firstMonth = 0;
						var lastMonth = 0;

						for (var entrie in dates){
							var dateStr = dates[entrie];
							var year = Number(dateStr.split("-")[0]);
							var month = Number(dateStr.split("-")[1]);
							var date = this.createDate(dateStr);

							if (this.firstDateDataset == null){
								this.firstDateDataset = date;
							} else if (date < this.firstDateDataset){
								this.firstDateDataset = date;
							}

							if (this.lastDateDataset == null){
								this.lastDateDataset = date;
							} else if (date > this.lastDateDataset){
								this.lastDateDataset = date;
							}

							if (lastYear < year){
								lastYear = year;
								firstMonth = 1;
								lastMonth = 1;
								if (firstMonth >= month){
									firstMonth = month;
									this.firstDateFilter = date;
								}
								if (lastMonth <= month){
									lastMonth = month;
									this.lastDateFilter = date;
								}
							} else if (lastYear == year){
								if (firstMonth >= month){
									firstMonth = month;
									this.firstDateFiler = date;
								}
								if (lastMonth <= month){
									lastMonth = month;
									this.lastDateFilter = date;
								}
							}
						}
						this.firstDateFilterStr = this.createDateStr(this.firstDateFilter);
						this.lastDateFilterStr = this.createDateStr(this.lastDateFilter);
					},

					decreaseRangeOfDates(){
						if (this.firstDateFilter > this.firstDateDataset){
							// decrease firstDateFilter
							var year = this.firstDateFilter.getFullYear();
							var month = this.firstDateFilter.getMonth();
							var day = 1;
							if (month <= 0){
								month = 11;
								year = year - 1;
							} else {
								month = month - 1;
							}
							var date = new Date();
							date.setFullYear(year, month, day);
							date.setHours(0);
							date.setMinutes(0);
							date.setSeconds(0);
							date.setMilliseconds(0);
							// update date filters
							this.firstDateFilter = date;
							this.firstDateFilterStr = this.createDateStr(date);

							// decrease lastDateFilter
							var year = this.lastDateFilter.getFullYear();
							var month = this.lastDateFilter.getMonth();
							var day = 1;
							if (month <= 0){
								month = 11;
								year = year - 1;
							} else {
								month = month - 1;
							}
							var date = new Date();
							date.setFullYear(year, month, day);
							date.setHours(0);
							date.setMinutes(0);
							date.setSeconds(0);
							date.setMilliseconds(0);
							// update date filters
							this.lastDateFilter = date;
							this.lastDateFilterStr = this.createDateStr(date);

							// refresh chart
							this.refreshCharts();
						}
					},

					increaseRangeOfDates(){
						//console.log(this.lastDateDataset);
						if (this.lastDateFilter < this.lastDateDataset){
							// increase firstDateFilter
							var year = this.firstDateFilter.getFullYear();
							var month = this.firstDateFilter.getMonth();
							var day = 1;
							if (month >= 11){
								month = 0;
								year = year + 1;
							} else {
								month = month + 1;
							}
							var date = new Date();
							date.setFullYear(year, month, day);
							date.setHours(0);
							date.setMinutes(0);
							date.setSeconds(0);
							date.setMilliseconds(0);
							// update date filters
							this.firstDateFilter = date;
							this.firstDateFilterStr = this.createDateStr(date);

							// increase lastDateFilter
							var year = this.lastDateFilter.getFullYear();
							var month = this.lastDateFilter.getMonth();
							var day = 1;
							if (month >= 11){
								month = 0;
								year = year + 1;
							} else {
								month = month + 1;
							}
							var date = new Date();
							date.setFullYear(year, month, day);
							date.setHours(0);
							date.setMinutes(0);
							date.setSeconds(0);
							date.setMilliseconds(0);
							// update date filters
							this.lastDateFilter = date;
							this.lastDateFilterStr = this.createDateStr(date);

							// refresh chart
							this.refreshCharts();
						}
					},

					loadData(response){
						//console.log(response);
						this.selectDefaultDates(response.dates);
						this.backendData = response;
						this.updateViewData();
						this.computeMovingAverage();
					},

					createDate(strDate){
						//console.log(strDate);
						var dateParts = strDate.split("-");
						var year = Number(dateParts[0]);
						var month = Number(dateParts[1]);
						var day = Number(dateParts[2].split(" ")[0]);
						var date = new Date();
						//console.log("createDate->month: " + (month-1));
						date.setFullYear(year, month-1, day);
						date.setHours(0);
						date.setMinutes(0);
						date.setSeconds(0);
						date.setMilliseconds(0);
						return date;
					},

					selectCleanedDate(strDate){
						var dateParts = strDate.split("-");
						return ('0' + dateParts[1]).slice(-2) + "-" + dateParts[0];
					},

					createDateStr(date){
						var dateStr = date.getFullYear().toString();
						dateStr = dateStr + "-" + ('0' + (date.getMonth() + 1).toString()).slice(-2);
						dateStr = dateStr + "-" + ('0' + date.getDate().toString()).slice(-2);
						//console.log(dateStr);
						return dateStr;
					},

					// compute a 5 month moving average
					computeMovingAverage(){
						// lets work over the view data
						this.averagedData = [];
						var tempAveragedData = [];

						//console.log("*** compute moving average ***");
						for (var stateId in this.selectedStates){
							var state = this.selectedStates[stateId];
							console.log("*** computing moving average for " + state);
							var dataToAverage = [];
							var dates = [];
							var firstElement = true;
							var pollutionValue;
							// iterate over the dates for an element of the viewData
							var entrieCounter = 0;
							for (var entrie in this.viewData){
								var date = this.viewData[entrie]["quarter"];
								pollutionValue = this.viewData[entrie][state];
								//console.log(pollutionValue);

								// add first two elements to perform the moving average
								if (firstElement == true){
									dataToAverage.push(pollutionValue);
									dataToAverage.push(pollutionValue);
									firstElement = false;
								}
								dataToAverage.push(pollutionValue);
								dates.push(date);
								entrieCounter += 1;
								//console.log("dataToAverage.length " + dataToAverage.length);
								//console.log("entrieCounter.length " + entrieCounter);
							}

							// add last two elements to perform the moving average
							dataToAverage.push(pollutionValue);
							dataToAverage.push(pollutionValue);

							//var dateCounter = 0;
							for (var i = 2; i < dataToAverage.length - 2; i++){
									var averagedValue = (0.125*dataToAverage[i-2]) + (0.25**dataToAverage[i-1]) + (0.25*dataToAverage[i]);
									averagedValue = averagedValue + (0.25*dataToAverage[i+1]) + (0.125*dataToAverage[i+2]);
									var point = {"quarter": dates[i-2]};

									var indexOfEntry = -1;
									for (var entryId in this.averagedData){
										var entry = this.averagedData[entryId];
										if (entry["quarter"] == dates[i-2]){
												point = entry;
												indexOfEntry = this.averagedData.indexOf(entry);
												break;
										}
									}
									point[state]= averagedValue;
									if (indexOfEntry >= 0){
										this.averagedData[indexOfEntry] = point;
									} else {
										this.averagedData.push(point);
									}
							}
						}

					},

					updateViewData(){
        		this.viewData = [];
        		for (var dateId in this.backendData.dates){
							//console.log("updateViewData: Date()");
							//console.log(this.createDate(this.backendData.dates[dateId]));

							var date = this.createDate(this.backendData.dates[dateId]);
        			if (date >= this.firstDateFilter && date <= this.lastDateFilter) {

								//console.log("firstDate: " + this.firstDateFilter);
								//console.log("date: " + date);
								//console.log("lastDateFilter: " + this.lastDateFilter);
								//c("**** responses dates");
        				//console.log(this.backendData.dates[dateId]);

        				var point = {"quarter": this.selectCleanedDate(this.backendData.dates[dateId])};
								//var stateNames = "";
        				for (var state in this.backendData.data) {
        					var state_name = this.backendData.data[state]['name'];
									//stateNames = stateNames +"\n" + this.createCheckBoxMenu(state_name);
									//console.log(state_name);
									var isStateSelected = this.selectedStates.indexOf(state_name) >= 0;
									if (isStateSelected){
										if (this.backendData.data[state][this.pollutionType] == undefined) {
        							point[state_name] = 0;
        						}
        						else if (this.backendData.data[state][this.pollutionType][this.backendData.dates[dateId]] == undefined) {
        							point[state_name] = 0;
        						}
        						else {
        							point[state_name] = this.backendData.data[state][this.pollutionType][this.backendData.dates[dateId]]['max'];
											//console.log("**** Setting date ****");
											//console.log(this.backendData.data[state][this.pollutionType][this.backendData.dates[dateId]]);
        						}
									}
	        			}
	        			this.viewData.push(point);
        			}
						}
        		//console.log(this.viewData);
					},

					drawBothCharts(){
						console.log("************** DrawBothCharts **************");
						trendChart.draw(this.averagedData);
						//trendAreaFirstChart.draw(this.averagedData);
						//trendAreaSecondChart.draw(this.viewData);
					},

        	drawAreaChart() {
						//console.log("this.firstDateFilter: " + this.firstDateFilter);
						//console.log("this.lastDateFilter: " + this.lastDateFilter);
						//console.log(typeof this.viewData);
						//this.computeMovingAverage('LA');
						//console.log(this.viewData);
						console.log("************** DrawAreaChart **************");
	        	areaChart.draw(this.viewData);
        	}
        }
    }
</script>
