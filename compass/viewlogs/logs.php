<?php
include "config.inc"; 

session_start();

if ($_SESSION['loginname'] == null)
	header("location:/compass/viewlogs"); 

include "db_mysql_mt.inc"; 

$db = new DB_Sql;
$db->connect();

$tempdb = new DB_Sql;
$tempdb->connect();

?>

<html>
<title> Logs for teacher <?=$_SESSION['loginname'] ?> </title>

<head>
<script src= "http://compassproject.net/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src= "http://compassproject.net/jgcharts.pack.js" type="text/javascript"></script>
<script type="text/javascript">

topics = {};
topics[27]="Circular motion";
topics[28]="Falling objects";
topics[29]="Linear motion";
topics[30]="Projectile motion";
topics[31]="Rotational motion";
topics[32]="Inclined plane";
topics[33]="Lever";
topics[34]="Pulley";
topics[35]="Screw";
topics[36]="Wedge";
topics[37]="Wheel and Axle";
topics[41]="Inclined Plane";
topics[42]="Inclined Plane";
topics[43]="Inclined Plane";
topics[44]="Lever";
topics[45]="Lever";
topics[46]="Lever";
topics[47]="Pulley";
topics[48]="Pulley";
topics[49]="Pulley";
topics[50]="Screw";
topics[51]="Screw";
topics[52]="Screw";
topics[53]="Wedge";
topics[54]="Wedge";
topics[55]="Wedge";
topics[56]="Wheel and Axle";
topics[57]="Wheel and Axle";
topics[58]="Wheel and Axle";
topics[60]="Inclined Plane";
topics[61]="Wedge";
topics[62]="Wheel and Axle";
topics[63]="Screw";
topics[64]="Lever";
topics[65]="Pulley";

concepts = {};
concepts[95]="acceleration";
concepts[96]="angle";
concepts[97]="distance";
concepts[98]="drag";
concepts[99]="efficiency";
concepts[100]="energy";
concepts[101]="first class lever";
concepts[102]="force";
concepts[103]="friction";
concepts[104]="fulcrum";
concepts[105]="G forces";
concepts[106]="gravity";
concepts[107]="height";
concepts[108]="horizontal component";
concepts[109]="impulse";
concepts[110]="kinetic energy";
concepts[111]="lift";
concepts[112]="ma";
concepts[113]="mass";
concepts[114]="mechanical advantage";
concepts[115]="moment of inertia";
concepts[116]="momentum";
concepts[117]="Newtons 1st law";
concepts[118]="Newtons 2nd law";
concepts[119]="Newtons 3rd law";
concepts[120]="Newtons laws";
concepts[121]="normal force";
concepts[122]="potential energy";
concepts[123]="power";
concepts[124]="radius";
concepts[125]="range";
concepts[126]="screw";
concepts[127]="second class lever";
concepts[128]="shape";
concepts[129]="Speed";
concepts[130]="surface area";
concepts[131]="third class lever";
concepts[132]="torque";
concepts[133]="Velocity";
concepts[134]="vertical component";
concepts[135]="wedge";
concepts[136]="work";


units = {};
units[10] = "Light";
units[11] = "Forces and Motion";
units[12] = "Simple Machines";
units[15] = "Simple Machines";
units[16] = "Simple Machines";
units[17] = "Simple Machines";
units[18] = "Simple Machines";

function doajax() {
	$("#graphdiv").html('');	
	$("#please_wait").show();

	var sel = document.getElementById('dateselector');
	var i = sel.selectedIndex;

	$.post(
		'http://compassproject.net/compass/viewlogs/time_spent.php', 
		{'d': sel.options[i].value}, 
		displaygraph
	);
}

function displaygraph(ret_data) {

	var ret=0, num_students=0;
	eval (ret_data);

	if (!ret) {
		$('<b>Sorry, no activity on this day</b><br/>').appendTo("#graphdiv");
		$("#please_wait").hide();
		return;		
	}


	$('<b>Number of students who logged in: '+num_students+'</b><br/><br/>').appendTo("#graphdiv");

var num_units = ret[0];

for (var nu = 1; nu<= num_units; nu++) {

	var first_unit = ret[nu];
	var unit_num = first_unit[0];
	/*
	 * Note: keep synced with time_spent.php
	 * [ 2,
	 *   [ 11,
	 *     { c1: { t1: time1 , t2: time2, t3: time3},
	 *       c2: { .... }
	 *     }
	 *   ],
	 *   [ 15,
	 *     { c3: {....}
	 *     }
	 *   ]
	 * ]
	 */
	// first pass: find the topics and concepts in the result
	var topics_present = {};
	var concepts_present = {};
	var cmap = first_unit[1];
	for (c in cmap) {
		concepts_present[c] = 1;
		for (t in cmap[c]) {
			topics_present[t] = 1;
		}
	}

	//second pass, form the [concepts X topics] matrix
	data = [];
	for (c in concepts_present) {
		var concepts_row = [];
		for (t in topics_present) {
			var val = 0;
			if (t in first_unit[1][c]) {
				val = first_unit[1][c][t];
			}
			//concepts_row[concepts_row.length] = Math.round((val/60)*10)/10;
			concepts_row[concepts_row.length] = Math.round((val/1)*10)/10;
		}
		data[data.length] = concepts_row; 
	}

	// assign names to concepts and topics
	concept_names = [];
	for (c in concepts_present) {
		concept_names[concept_names.length] = concepts[c];
	}
	topic_names = [];
	for (t in topics_present) {
		topic_names[topic_names.length] = topics[t];
	}

	var api = new jGCharts.Api();
	var options = {
/*		data: [
					[100, 200, 300],
					[10, 20, 30]
					],*/
		'data': data,
			//axis_labels: ['Energy', 'Work', 'Force'],
		axis_labels: concept_names,
		//		legend: ['Inclined Place', 'Wedge', 'Screw'],
		legend: topic_names,
		grid: true,
		grid_y: 5,
//		grid_x: 100/7,
		bar_spacing: 5,
//		bg: 'ffffff',
		bg_angle: 0,
		bg_type: 'stripes',
		bg_offset: 'eeeeee',
		bg_width: (3 * topic_names.length),
		size: '1000x300',
		colors : ['31496b', '4b9b41','81419b','41599b', '4b4b41','9161ab','1149bb',
							'11599b', '1b2bb1','a1811b','b1993b', '8b2ba1','91a16b','51591b'] 
	};

	$('<br/><br/><b>Graph for '+units[unit_num]+' </b><br/>').appendTo("#graphdiv");

	var num_bars = concept_names.length * topic_names.length; 
	// rule of thumb is that one graph (1000px wide) can hold 21 bars
	var max_concepts = 10; // maximum concepts to be put in one graph. 
	if (num_bars > 20) {
		max_concepts = Math.round( num_bars / 10 );
	}


	var data2 = [];
	var concept_names2 = [];
	var parts =0;
	for (var i=0; i<concept_names.length; i++) {
		data2[data2.length] = data[i];
		concept_names2[concept_names2.length] = concept_names[i];
		if (i%max_concepts == (max_concepts-1)) {
			options.grid_x = 100/concept_names2.length;
			options.axis_labels = concept_names2;
			options.data = data2;
			options.title = units[unit_num] + ' (Graph ' + (++parts) + ')';
			var url = api.make(options);
			/*
					chbh= <bar width>, <space between bars>, <space between groups>				
			 */
			url += '&chbh=20,5,36';
			url += '&chm=';

			for (var y=0; y<data2.length; y++) {
				for (var z=0; z<data2[y].length; z++) {
					if (y == 0 && z == 0) {
						// add nothing
					} else {
						url+= '|';
					}
					url+= 't' + getMinsStr(data2[y][z]) +',aaaaaa,'+z+','+y+',10';
				}
			}
			jQuery('<img>').attr('src', 'seconds.png').appendTo("#graphdiv");
			jQuery('<img>').attr('src', url).appendTo("#graphdiv");
			jQuery('<br/>').appendTo("#graphdiv");
			data2 = [];
			concept_names2 = [];
		}
	}
	if (concept_names2.length > 0) {
		// put the remaining 
		options.grid_x = 100/concept_names2.length;
		options.axis_labels = concept_names2;
		options.data = data2;
		options.title = units[unit_num] + ' (Graph ' + (++parts) + ')';
		var url = api.make(options);
		url += '&chbh=20,5,36';
		url += '&chm=';

		for (var y=0; y<data2.length; y++) {
			for (var z=0; z<data2[y].length; z++) {
				if (y == 0 && z == 0) {
					// add nothing
				} else {
					url+= '|';
				}
				url+= 't' +  getMinsStr(data2[y][z]) +',aaaaaa,'+z+','+y+',10';
			}
		}

		jQuery('<img>').attr('src', 'seconds.png').appendTo("#graphdiv");
		jQuery('<img>').attr('src', url).appendTo("#graphdiv");
		jQuery('<br/>').appendTo("#graphdiv");
		data2 = [];
		concept_names2 = [];
	}

} // end for nu

$("#please_wait").hide();

}

function getMinsStr(val) {
	if (!val) return '0';
	return (Math.round((val/60)*10)/10) + ' mins';
}

</script>
</head>

<body>
<center>

Welcome <?=$_SESSION['loginname'] ?>! <br/>

<?
// 1) select the dates for the teacher:
$idteacher = 	$_SESSION['iduser'];
$sql = "SELECT distinct(date(time)) d FROM compass_mt.exploration e where idclass in (SELECT idclass FROM compass_mt.class c where idteacher=".$idteacher.") order by d";
$query = $db->query($sql);
?>

Select the dates for viewing activity graphs :<br/>
<br/>
<select id="dateselector">
<?
while($db->next_record()) {
	$d = $db->Record['d'];
?>

	<option value="<?=$d?>"><?=$d?></option>

<? 
} // end while db next record
?>

</select>
<br/>
<br/>
<input type="button" value = "Show graph" id="show_graph_button" onclick="doajax()"></input>
<br/><br/>
<div id="graphdiv"></div>
<img src="please_wait.png" id="please_wait" style="display:none"/>
</center>
</body>
</html>


