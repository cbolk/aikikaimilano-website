<?php  
	include("../admin/class.db.php");
	include("../admin/class.aikidoka.php");
	setlocale(LC_TIME, 'ita');
	date_default_timezone_set('Europe/Rome');
	$ay = $_GET["ay"];
  $db = new dbaccess();
?>
<html>
<head>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script> 
<script src="./scripts.js"></script>
<style type="text/css">
body{font-family: Arial, sans-serif;font-size:10px;}
.axis path,.axis line {fill: none;stroke:#b6b6b6;shape-rendering: crispEdges;}
/*.tick line{fill:none;stroke:none;}*/
.tick text{fill:#999;}
g.aikidoka.active{cursor:pointer;}
text.label{font-size:12px;font-weight:bold;cursor:pointer;}
text.value{font-size:12px;font-weight:bold;}
</style>
</head>
<body>
<div id="header"></div>
<div id="ay"><?php echo $ay; ?></div>

<script type="text/javascript">
function truncate(str, maxLength, suffix) {
	if(str.length > maxLength) {
		str = str.substring(0, maxLength + 1); 
		str = str.substring(0, Math.min(str.length, str.lastIndexOf(" ")));
		str = str + suffix;
	}
	return str;
}

var margin = {top: 20, right: 200, bottom: 0, left: 20},
	width = 500,
	height = 650;

var c = d3.scale.category20c();

var x = d3.time.scale()
	.range([0, width]);

var xAxis = d3.svg.axis()
	.scale(x)
	.orient("top");

var formatYearsMonths = d3.format("0000-00");
xAxis.tickFormat(formatYearsMonths);

var svg = d3.select("body").append("svg")
	.attr("width", width + margin.left + margin.right)
	.attr("height", height + margin.top + margin.bottom)
	.style("margin-left", margin.left + "px")
	.append("g")
	.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

// var dataset = [[ [2002, 8], [2003, 1], [2004, 1], [2005, 1], [2006, 3], [2007, 3], [2009, 3], [2013, 3]], [ [2004, 5], [2005, 1], [2006, 2], [2010, 20], [2011, 3] ] ,[ [2001, 5], [2005, 15], [2006, 2], [2010, 20], [2012, 25] ]];
// var dataset = [ [2001, 5], [2005, 15], [2006, 2], [2010, 20], [2012, 25] ];

var div = document.getElementById("ay");
var myData = div.textContent;
    
d3.json("./allattendancesrc.php?ay=" + myData, function(error, data) {
	//x.domain([start_year, end_year]);
	var xScale = d3.time.scale()
//		.domain([start_year, end_year])
		.range([0, width]);

	svg.append("g")
		.attr("class", "x axis")
		.attr("transform", "translate(0," + 0 + ")")
		.call(xAxis);

	for (var j = 0; j < data.length; j++) {
		var g = svg.append("g").attr("class","aikidoka");

		var circles = g.selectAll("circle")
			.data(data[j]['attendance'])
			.enter()
			.append("circle");

		var text = g.selectAll("text")
			.data(data[j]['attendance'])
			.enter()
			.append("text");

		var rScale = d3.scale.linear()
			.domain([0, d3.max(data[j]['attendance'], function(d) { return d[1]; })])
			.range([0, 30]);

		circles
			.attr("cx", function(d, i) { return d[0]; })
			.attr("cy", j*20+20)
			.attr("r", function(d) { return rScale(d[1]); })
			.style("fill", function(d) { return c(j); });

		text
			.attr("y", j*20+25)
			.attr("x",function(d, i) { return xScale(d[0])-5; })
			.attr("class","value")
			.text(function(d){ return d[1]; })
			.style("fill", function(d) { return c(j); })
			.style("display","none");

		g.append("text")
			.attr("y", j*20+25)
			.attr("x",width+20)
			.attr("class","label")
			.text(truncate(data[j]['fullname'],40,"..."))
			.style("fill", function(d) { return c(j); })
			.on("mouseover", mouseover)
			.on("mouseout", mouseout);
	};

	function mouseover(p) {
		var g = d3.select(this).node().parentNode;
		d3.select(g).selectAll("circle").style("display","none");
		d3.select(g).selectAll("text.value").style("display","block");
	}

	function mouseout(p) {
		var g = d3.select(this).node().parentNode;
		d3.select(g).selectAll("circle").style("display","block");
		d3.select(g).selectAll("text.value").style("display","none");
	}
});

</script>

</body>
</html>