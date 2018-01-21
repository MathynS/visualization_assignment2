(function(){
  //{top: 20, right: 55, bottom: 30, left: 40}
  var margin = {top: 20, right: 55, bottom: 30, left: 40},
      width  = 940 - margin.left - margin.right,
      height = 500  - margin.top  - margin.bottom;

  var x = d3.scale.ordinal()
      .rangeRoundBands([0, width], .1);

  var y = d3.scale.linear()
      .rangeRound([height, 0]);

  var xAxis = d3.svg.axis()
      .scale(x)
      .orient("bottom");

  var yAxis = d3.svg.axis()
      .scale(y)
      .orient("left");

  var stack = d3.layout.stack()
      .offset("zero")
      .values(function (d) { return d.values; })
      .x(function (d) { return x(d.label) + x.rangeBand() / 2; })
      .y(function (d) { return d.value; });

  var area = d3.svg.area()
      .interpolate("cardinal")
      .x(function (d) { return x(d.label) + x.rangeBand() / 2; })
      .y0(function (d) { return y(d.y0); })
      .y1(function (d) { return y(d.y0 + d.y); });

  // var color =   d3.scale.linear()
  //   .interpolate(d3.interpolateHcl)
  //   .range(["#9AF768", "#F27A4D"]);

  var color = d3.scale.ordinal()
      .range(["#c57852", "#f22cdf", "#35a01f", "#568cdd", "#1b9b96", "#c56bbb", "#f54c77", "#fd4931", "#928897", "#889150", "#ae8527", "#4394b9", "#e352bb", "#da6776", "#e4652d", "#4d9a73", "#b47b98", "#6b9922", "#fa4a55", "#699397", "#8b7fdd", "#12a04e", "#a08774", "#61994f", "#a98651", "#7c9174", "#ed4f99", "#8f9024", "#b26ede", "#be7975", "#a47dba", "#ff22bc", "#ca772a", "#e06654", "#7c8aba", "#d26998", "#d457de"]);

  // var svg = d3.select("body").append("svg")
  //     .attr("width",  width  + margin.left + margin.right)
  //     .attr("height", height + margin.top  + margin.bottom)
  //   .append("g")
  //     .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

  var areaChart={};

  areaChart.draw = function(data) {
    console.log("data: ");
    console.log(data);

    // remove previous svg image
    d3.selectAll("svg > *").remove();

    var svg = d3.select("svg");
    //d3.csv("data/crunchbase-quarters.csv", function (error, data) {
    var labelVar = 'quarter';
    var varNames = d3.keys(data[0])
        .filter(function (key) { return key !== labelVar;});
    color.domain(varNames);
    console.log(varNames);


    var seriesArr = [], series = {};
    varNames.forEach(function (name) {
      series[name] = {name: name, values:[]};
      seriesArr.push(series[name]);
    });
    console.log(seriesArr);


    data.forEach(function (d) {
      varNames.map(function (name) {
        series[name].values.push({name: name, label: d[labelVar], value: +d[name]});
      });
    });

    x.domain(data.map(function (d) { return d.quarter; }));

    stack(seriesArr);

    // set height of the graph
    y.domain([0, d3.max(seriesArr, function (c) {
        return d3.max(c.values, function (d) { return d.y0 + d.y; });
      })]);


    // append x axis into svg figure
    svg.append("g")
        .attr("class", "xaxis")
        .attr("transform", "translate(0," + height + ")")
        .call(xAxis)
        .selectAll("text")
            .style("text-anchor", "end")
            .attr("dx", "-.8em")
            .attr("dy", ".15em")
            .attr("transform", function(d) {
                return "rotate(-65)"
                });

/*
    svg.selectAll(".xaxis text")  // select all the text elements for the xaxis
       .attr("transform", function(d) {
          return "translate(" + this.getBBox().height*-2 + "," + this.getBBox().height + ")rotate(-45)";
    });
*/
    // append y axis into svg figure
    svg.append("g")
        .attr("class", "yaxis")
        .call(yAxis)
      .append("text")
        .attr("transform", "rotate(-90)")
        .attr("y", 6)
        .attr("dy", ".71em")
        .attr("x",0 - (height / 2))
        .style("text-anchor", "middle")
        .text("Number of Rounds");

    //draw the lines for the series of measurements
    var selection = svg.selectAll(".series")
      .data(seriesArr)
      .enter().append("g")
        .attr("class", "series");


      // fill the areas under the series of measurements
    selection.append("path")
      .attr("class", "streamPath")
      .attr("d", function (d) { return area(d.values); })
      .style("fill", function (d) { return color(d.name); })
      .style("stroke", "grey");

      // assign all the data in seriesArray to elements called series points
    var points = svg.selectAll(".seriesPoints")
      .data(seriesArr)
      .enter().append("g")
        .attr("class", "seriesPoints");

      // for each point in series points give its shape
    points.selectAll(".point")
      .data(function (d) { return d.values; })
      .enter().append("circle")
       .attr("class", "point")
       .attr("cx", function (d) { return x(d.label) + x.rangeBand() / 2; })
       .attr("cy", function (d) { return y(d.y0 + d.y); })
       .attr("r", "2px")
       .style("fill",function (d) { return color(d.name); })
       .on("mouseover", function (d) { showPopover.call(this, d); })
       .on("mouseout",  function (d) { removePopovers(); })

    // add legend ??
    var legend = svg.selectAll(".legend")
        .data(varNames.slice().reverse())
      .enter().append("g")
        .attr("class", "legend")
        .attr("transform", function (d, i) { return "translate(0," + i * 20 + ")"; });

    legend.append("rect")
        .attr("x", width - 10)
        .attr("width", 10)
        .attr("height", 10)
        .style("fill", color)
        .style("stroke", "grey");

    legend.append("text")
        .attr("x", width - 12)
        .attr("y", 6)
        .attr("dy", ".35em")
        .style("text-anchor", "end")
        .text(function (d) { return d; });

    function removePopovers () {
      $('.popover').each(function() {
        $(this).remove();
      });
    }

    function showPopover (d) {
      $(this).popover({
        title: d.name,
        placement: 'auto top',
        container: 'body',
        trigger: 'manual',
        html : true,
        content: function() {
          return "Quarter: " + d.label +
                 "<br/>Rounds: " + d3.format(",")(d.value ? d.value: d.y1 - d.y0); }
      });
      $(this).popover('show')
      }

  }
  this.areaChart=areaChart;
  console.log(this.areaChart);
})();
