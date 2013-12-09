<?

$topics = array();
$topics["27"]="Circular motion";
$topics["28"]="Falling objects";
$topics["29"]="Linear motion";
$topics["30"]="Projectile motion";
$topics["31"]="Rotational motion";
$topics["32"]="Inclined plane";
$topics["33"]="Lever";
$topics["34"]="Pulley";
$topics["35"]="Screw";
$topics["36"]="Wedge";
$topics["37"]="Wheel and Axle";
$topics["41"]="Inclined Plane";
$topics["42"]="Inclined Plane";
$topics["43"]="Inclined Plane";
$topics["44"]="Lever";
$topics["45"]="Lever";
$topics["46"]="Lever";
$topics["47"]="Pulley";
$topics["48"]="Pulley";
$topics["49"]="Pulley";
$topics["50"]="Screw";
$topics["51"]="Screw";
$topics["52"]="Screw";
$topics["53"]="Wedge";
$topics["54"]="Wedge";
$topics["55"]="Wedge";
$topics["56"]="Wheel and Axle";
$topics["57"]="Wheel and Axle";
$topics["58"]="Wheel and Axle";
$topics["60"]="Inclined Plane";
$topics["61"]="Wedge";
$topics["62"]="Wheel and Axle";
$topics["63"]="Screw";
$topics["64"]="Lever";
$topics["65"]="Pulley";

$concepts = array();
$concepts["95"]="Acceleration";
$concepts["96"]="Angle";
$concepts["97"]="Distance";
$concepts["98"]="Drag";
$concepts["99"]="Efficiency";
$concepts["100"]="Energy";
$concepts["101"]="First class lever";
$concepts["102"]="Force";
$concepts["103"]="Friction";
$concepts["104"]="Fulcrum";
$concepts["105"]="G forces";
$concepts["106"]="Gravity";
$concepts["107"]="Height";
$concepts["108"]="Horizontal component";
$concepts["109"]="Impulse";
$concepts["110"]="Kinetic energy";
$concepts["111"]="Lift";
$concepts["112"]="Ma";
$concepts["113"]="Mass";
$concepts["114"]="Mechanical advantage";
$concepts["115"]="Moment of inertia";
$concepts["116"]="Momentum";
$concepts["117"]="Newtons 1st law";
$concepts["118"]="Newtons 2nd law";
$concepts["119"]="Newtons 3rd law";
$concepts["120"]="Newtons laws";
$concepts["121"]="Normal force";
$concepts["122"]="Potential energy";
$concepts["123"]="Power";
$concepts["124"]="Radius";
$concepts["125"]="Range";
$concepts["126"]="Screw";
$concepts["127"]="Second class lever";
$concepts["128"]="Shape";
$concepts["129"]="Speed";
$concepts["130"]="Surface area";
$concepts["131"]="Third class lever";
$concepts["132"]="Torque";
$concepts["133"]="Velocity";
$concepts["134"]="Vertical component";
$concepts["135"]="Wedge";
$concepts["136"]="Work";

$units = array();
$units["10"] = "Light";
$units["11"] = "Forces and Motion";
$units["12"] = "Simple Machines";
$units["15"] = "Simple Machines";
$units["16"] = "Simple Machines";
$units["17"] = "Simple Machines";
$units["18"] = "Simple Machines";

function get_concept_name($cnum) {
	global $concepts, $topics, $units;
	$int_cnum = intval($cnum);
	if ($int_cnum < 95 || $int_cnum > 136) {
		return "";
	}
	return $concepts["".$cnum];
}
function get_topic_name($tnum) {
	global $concepts, $topics, $units;
	$int_tnum = intval($tnum);
	if ($int_tnum < 27 || $int_tnum > 65) {
		return "";
	}
	return $topics["".$tnum];
}
function get_unit_name($unum) {
	global $concepts, $topics, $units;
	$int_unum = intval($unum);
	if ($int_unum < 10 || $int_unum > 18) {
		return "";
	}
	return $units["".$unum];
}
?>

