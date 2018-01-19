<template>
	<div class="row">
		<div class="col-xs-9">
			<div class="row">
				<div class="col-xs-4">
						Toggle 1, Toggle 2, Toggle 3, Toggle 4
				</div>
				<div>
    			<div class="row">
        		<div class='col-sm-3'>
            	<input type="date" v-model="firstDateFilterStr" v-on:input="updateFirstDateFilter" name="firstDateFilterInput">
        		</div>
        		<div class='col-sm-3'>
            	<input type="date" v-model="lastDateFilterStr" v-on:input="updateLastDateFilter" name="lastDateFilterInput">
        		</div>
    			</div>
				</div>

			</div>
			<div class="row">
				<div class="chart-container">
					<svg width="960" height="600" id="areasvg"></svg>
				</div>
			</div>
		</div>
		<div class="col-xs-3">

			<div class="row">
				<div class="checkbox-container">
				<div class="dropdown-checkbox" id="us-states-container">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Armed Forces America" id="checkArmedForcesAmerica">
					<label class="form-check-label" for="checkArmedForcesAmerica">Armed Forces America</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Armed Forces" id="checkArmedForces">
					<label class="form-check-label" for="checkArmedForces">Armed Forces</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Armed Forces Pacific" id="checkArmedForcesPacific">
					<label class="form-check-label" for="checkArmedForcesPacific">Armed Forces Pacific</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Alaska" id="checkAlaska">
					<label class="form-check-label" for="checkAlaska">Alaska</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Alabama" id="checkAlabama">
					<label class="form-check-label" for="checkAlabama">Alabama</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Arkansas" id="checkArkansas">
					<label class="form-check-label" for="checkArkansas">Arkansas</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Arizona" id="checkArizona">
					<label class="form-check-label" for="checkArizona">Arizona</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="California" id="checkCalifornia">
					<label class="form-check-label" for="checkCalifornia">California</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Colorado" id="checkColorado">
					<label class="form-check-label" for="checkColorado">Colorado</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Connecticut" id="checkConnecticut">
					<label class="form-check-label" for="checkConnecticut">Connecticut</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Washington" id="checkWashington">
					<label class="form-check-label" for="checkWashington">Washington</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Delaware" id="checkDelaware">
					<label class="form-check-label" for="checkDelaware">Delaware</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Florida" id="checkFlorida">
					<label class="form-check-label" for="checkFlorida">Florida</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Georgia" id="checkGeorgia">
					<label class="form-check-label" for="checkGeorgia">Georgia</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Guam" id="checkGuam">
					<label class="form-check-label" for="checkGuam">Guam</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Hawaii" id="checkHawaii">
					<label class="form-check-label" for="checkHawaii">Hawaii</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Iowa" id="checkIowa">
					<label class="form-check-label" for="checkIowa">Iowa</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Idaho" id="checkIdaho">
					<label class="form-check-label" for="checkIdaho">Idaho</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Illinois" id="checkIllinois">
					<label class="form-check-label" for="checkIllinois">Illinois</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Indiana" id="checkIndiana">
					<label class="form-check-label" for="checkIndiana">Indiana</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Kansas" id="checkKansas">
					<label class="form-check-label" for="checkKansas">Kansas</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Kentucky" id="checkKentucky">
					<label class="form-check-label" for="checkKentucky">Kentucky</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Louisiana" id="checkLouisiana">
					<label class="form-check-label" for="checkLouisiana">Louisiana</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Massachusetts" id="checkMassachusetts">
					<label class="form-check-label" for="checkMassachusetts">Massachusetts</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Maryland" id="checkMaryland">
					<label class="form-check-label" for="checkMaryland">Maryland</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Maine" id="checkMaine">
					<label class="form-check-label" for="checkMaine">Maine</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Michigan" id="checkMichigan">
					<label class="form-check-label" for="checkMichigan">Michigan</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Minnesota" id="checkMinnesota">
					<label class="form-check-label" for="checkMinnesota">Minnesota</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Missouri" id="checkMissouri">
					<label class="form-check-label" for="checkMissouri">Missouri</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Mississippi" id="checkMississippi">
					<label class="form-check-label" for="checkMississippi">Mississippi</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Montana" id="checkMontana">
					<label class="form-check-label" for="checkMontana">Montana</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="North Carolina" id="checkNorthCarolina">
					<label class="form-check-label" for="checkNorthCarolina">North Carolina</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="North Dakota" id="checkNorthDakota">
					<label class="form-check-label" for="checkNorthDakota">North Dakota</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Nebraska" id="checkNebraska">
					<label class="form-check-label" for="checkNebraska">Nebraska</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="New Hampshire" id="checkNewHampshire">
					<label class="form-check-label" for="checkNewHampshire">New Hampshire</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="New Jersey" id="checkNewJersey">
					<label class="form-check-label" for="checkNewJersey">New Jersey</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="New Mexico" id="checkNewMexico">
					<label class="form-check-label" for="checkNewMexico">New Mexico</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Nevada" id="checkNevada">
					<label class="form-check-label" for="checkNevada">Nevada</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="New York" id="checkNewYork">
					<label class="form-check-label" for="checkNewYork">New York</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Ohio" id="checkOhio">
					<label class="form-check-label" for="checkOhio">Ohio</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Oklahoma" id="checkOklahoma">
					<label class="form-check-label" for="checkOklahoma">Oklahoma</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Oregon" id="checkOregon">
					<label class="form-check-label" for="checkOregon">Oregon</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Pennsylvania" id="checkPennsylvania">
					<label class="form-check-label" for="checkPennsylvania">Pennsylvania</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Puerto Rico" id="checkPuertoRico">
					<label class="form-check-label" for="checkPuertoRico">Puerto Rico</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Rhode Island" id="checkRhodeIsland">
					<label class="form-check-label" for="checkRhodeIsland">Rhode Island</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="South Carolina" id="checkSouthCarolina">
					<label class="form-check-label" for="checkSouthCarolina">South Carolina</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="South Dakota" id="checkSouthDakota">
					<label class="form-check-label" for="checkSouthDakota">South Dakota</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Tennessee" id="checkTennessee">
					<label class="form-check-label" for="checkTennessee">Tennessee</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Texas" id="checkTexas">
					<label class="form-check-label" for="checkTexas">Texas</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Utah" id="checkUtah">
					<label class="form-check-label" for="checkUtah">Utah</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Virginia" id="checkVirginia">
					<label class="form-check-label" for="checkVirginia">Virginia</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Virgin Islands" id="checkVirginIslands">
					<label class="form-check-label" for="checkVirginIslands">Virgin Islands</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Vermont" id="checkVermont">
					<label class="form-check-label" for="checkVermont">Vermont</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Washington" id="checkWashington">
					<label class="form-check-label" for="checkWashington">Washington</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Wisconsin" id="checkWisconsin">
					<label class="form-check-label" for="checkWisconsin">Wisconsin</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="West Virginia" id="checkWestVirginia">
					<label class="form-check-label" for="checkWestVirginia">West Virginia</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Wyoming" id="checkWyoming">
					<label class="form-check-label" for="checkWyoming">Wyoming</label>
				</div>
				</div>
				<button class="right-aligned" v-on:click="refreshChart">Update chart</button>
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
								firstDateFilter:null,
								lastDateFilter:null,
								firstDateFilterStr: '',
								lastDateFilterStr: '',
                pollutionType: 'NO2',
								selectedStates: [],
								selectedState: ''
            }
        },
        mounted() {
        	axios.get('/data/cache/states')
								.then(response => this.loadData(response.data))
                .then(response => this.drawChart())
                .catch(error => console.log(error));
        },
        methods: {


					addState(){
						this.selectedStates.push(this.selectedState);
						//console.log("adding state " + this.selectedState);
						this.selectedState = '';
						this.refreshChart();
					},

					refreshChart(){
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
						this.drawChart();
					},

					updateFirstDateFilter(){
							console.log("updating first date filter");
							this.firstDateFilter = this.createDate(this.firstDateFilterStr);
							this.refreshChart();
					},

					updateLastDateFilter(){
							console.log("updating last date filter");
							this.secondDateFilter = this.createDate(this.secondDateFilterStr);
							this.refreshChart();
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
							var date = dates[entrie];
							var year = Number(date.split("-")[0]);
							var month = Number(date.split("-")[1]);
							if (lastYear < year){
								lastYear = year;
								firstMonth = 1;
								lastMonth = 1;
								if (firstMonth >= month){
									firstMonth = month;
									this.firstDateFilter = this.createDate(date);
								}
								if (lastMonth <= month){
									lastMonth = month;
									this.lastDateFilter = this.createDate(date);
								}
							} else if (lastYear == year){
								if (firstMonth >= month){
									firstMonth = month;
									this.firstDateFiler = this.createDate(date);
								}
								if (lastMonth <= month){
									lastMonth = month;
									this.lastDateFilter = this.createDate(date);
								}
							}
						}
						this.firstDateFilterStr = this.createDateStr(this.firstDateFilter);
						this.lastDateFilterStr = this.createDateStr(this.lastDateFilter);
					},

					loadData(response){
						//console.log(response);
						this.selectDefaultDates(response.dates);
						this.backendData = response;
						this.updateViewData();
					},

					createDate(strDate){
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

					createDateStr(date){
						var dateStr = date.getFullYear().toString();
						dateStr = dateStr + "-" + ('0' + (date.getMonth() + 1).toString()).slice(-2);
						dateStr = dateStr + "-" + ('0' + date.getDate().toString()).slice(-2);
						console.log(dateStr);
						return dateStr;
					},

					updateViewData(){
        		this.viewData = [];
        		for (var dateId in this.backendData.dates){
							//console.log("updateViewData: Date()");
							//console.log(this.createDate(this.backendData.dates[dateId]));

							var date = this.createDate(this.backendData.dates[dateId]);
        			if (date >= this.firstDateFilter && date <= this.lastDateFilter) {

								console.log("firstDate: " + this.firstDateFilter);
								console.log("date: " + date);
								console.log("lastDateFilter: " + this.lastDateFilter);
								//c("**** responses dates");
        				//console.log(this.backendData.dates[dateId]);

        				var point = {"quarter": this.backendData.dates[dateId]};
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
        		console.log(this.viewData);
					},

        	drawChart() {
						//console.log("this.firstDateFilter: " + this.firstDateFilter);
						//console.log("this.lastDateFilter: " + this.lastDateFilter);
						//console.log(typeof this.viewData);
						console.log(this.viewData);
	        	areaChart.draw(this.viewData);
        	}
        }
    }
</script>
