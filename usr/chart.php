<?php  
	include("../admin/class.db.php");
	include("../admin/class.aikidoka.php");
	setlocale(LC_TIME, 'ita');
	date_default_timezone_set('Europe/Rome');
	$aid = $_GET["aid"];
?>
<!DOCTYPE html>
<meta charset="utf-8">
<head>
	<link rel="stylesheet" href="../assets/css/presenze.css" />   
	<link rel="stylesheet" href="../assets/css/font-awesome/css/font-awesome.min.css" />
</head>
<style>
#aid {display: none;}
.axis path,
.axis line {
  fill: none;
  stroke: #000;
  shape-rendering: crispEdges;
}

.x.axis path {
  display: none;
}

.area {
  fill: lightsteelblue;
}

.line {
  fill: none;
  stroke: steelblue;
  stroke-width: 1.5px;
}

.avgline {
  fill: none;
  stroke: green;
  stroke-width: 1px;
}
.barlabel{
  font-size: 8px;

}
.grid .tick {
    stroke: lightgrey;
    stroke-opacity: 0.7;
    shape-rendering: crispEdges;
}
.grid path {
          stroke-width: 0;
}
</style>
<body>
<div id="aid"><?php echo $aid; ?></div>
<div id="header"><?php 
	$db = new dbaccess();
	$p = new aikidoka();
 	$info = $p->fullname($db,$aid);
 	echo $info[0]['fullname'];
 	?></div>
<div id="detailed"></div>
<hr/>
<script src="http://d3js.org/d3.v3.js"></script>
<script>

var margin = {top: 20, right: 20, bottom: 70, left: 50},
    width = 1200 - margin.left - margin.right,
    height = 500 - margin.top - margin.bottom;

var parseDate = d3.time.format("%Y-%m-%d").parse;

var x = d3.scale.ordinal().rangeRoundBands([0, width - margin.left - margin.right]);

var y = d3.scale.linear()
    .range([height, 0]);

var color = d3.scale.category10();

var xAxis = d3.svg.axis()
    .scale(x)
    .orient("bottom");

var yAxis = d3.svg.axis()
    .scale(y)
    .orient("left");  

var line = d3.svg.line()
    .interpolate("step-after")
    .defined(function(d) { return d.MH != null; })
    .x(function(d) { return x(d.label); })
    .y(function(d) { return y(d.MH); });

    
//var chart = d3.select("#detailed")
var svg = d3.select("#detailed").append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
  .append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

var div = document.getElementById("aid");
var myData = div.textContent;
    
d3.json("./datasrc.php?aid=" + myData, function(error, data) {
  var m = 0;
  var tophours = d3.max(data, function(d) { return +d.MH; });
  var shodan = "2012.07";
  var nidan = "2016.07";
  data.forEach(function(d) {
    d.yearmonth = parseDate(d.yearmonth);
    d.MH = +d.MH;
    d.label = d.YY + "." + d.MM;
    if (d.MH != 0) m++;
    if(d.MH == tophours) topmonth = d.label;
    if(d.label == shodan) shodanhrs = d.MH;
    else if (d.label == nidan) nidanhrs = d.MH;
  });

  data.sort(function(a, b){ return d3.ascending(a.label, b.label); });

  var tot = d3.nest()
     .rollup(
         function(totals) { return d3.sum(totals, function(d) {return +d.MH;}) }
     )
    .entries(data);
  var daes = d3.nest()
     .rollup(
         function(totals) { return d3.sum(totals, function(d) {if (d.YY + "." + d.MM >= nidan) return +d.MH;}) }
     )
    .entries(data);

  var daesame = daes;//tot - 668;

  var avg = tot / m;
  var firstmonth = d3.min(data, function(d) { return d.label; });
  var lastmonth = d3.max(data, function(d) { return d.label; });

  x.domain(data.map(function(d) { return d.label; }));
  y.domain([0, 40]);

  svg.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(0," + height + ")")
	   .call(xAxis)
        .selectAll("text")  
            .style("text-anchor", "end")
            .attr("dx", "-.7em")
            .attr("dy", "-.35em")
            .attr("font-size","12px")
            .attr("transform", function(d) {
                return "rotate(-90)" 
                });
        
  svg.append("g")
      .attr("class", "y axis")
      .call(yAxis)
    .append("text")
      .attr("transform", "rotate(-90)")
      .attr("y", 6)
      .attr("dy", ".71em")
      .style("text-anchor", "end")
      .text("from last exam: " + daesame);


//	console.log(topmonth);
//	console.log(tophours);
	//top attendance
	svg.append("rect")
   	.attr("class", "bartop")
   	.attr("x", x(topmonth)+2)
    .attr("y", y(tophours)+2)
    .attr('fill', 'gold')
    .attr("width", x.rangeBand()-4)
    .attr("height", height - y(tophours)-2);


  svg.append("text")
    .attr("x", x(topmonth)+7)
    .attr("y", y(tophours)-14)
    .attr('fill', 'steelblue')
    .attr("dy", ".71em")
    .attr("font-size","10px")
    .style("text-anchor", "middle")
    .text("" + tophours)

  //exams
  svg.append("rect")
    .attr("class", "bartop")
    .attr("x", x(shodan)+2)
    .attr("y", y(shodanhrs)+2)
    .attr('fill', 'green')
    .attr("width", x.rangeBand()-4)
    .attr("height", height - y(shodanhrs)-2);

  svg.append("rect")
    .attr("class", "bartop")
    .attr("x", x(nidan)+2)
    .attr("y", y(nidanhrs)+2)
    .attr('fill', 'green')
    .attr("width", x.rangeBand()-4)
    .attr("height", height - y(nidanhrs)-2);


	// average line
	svg.append("line")
   	.attr("class", "avgline")
  	.attr({ x1: x(firstmonth), y1: y(avg), 
            x2: x(lastmonth), y2: y(avg) 
       });

    svg.append("path")
      .datum(data)
      .attr("class", "line")
      .attr("d", line);

});


</script>
