<?php

		include "db_mysql_mt.inc"; 
			
		$db = new DB_Sql;
		
		$db->connect();
		
		$name = $_REQUEST['Name'];
		$class = $_REQUEST['Class'];
		$teacher = $_REQUEST['Teacher'];
		$gender = $_REQUEST['Gender'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Navigation Survey</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>

<script Language="Javascript" Type="text/Javascript" >
<!--
function form2_validate(form2)
{
<?
if(		$name == null && 
		$class == null && 
		$teacher == null && 
		$gender == null){

?>
	if(form2.Name.value=="")                                             
	{
		alert("Please enter your name");
		form2.Name.focus();
		return (false);
	}
	var radioselected=false;                                      
	for(i=0;i<form2.Gender.length;i++)
	{
		if(form2.Gender[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your Gender");
		return (false);
	}			
<?
}
?>
	
	var radioselected=false;                           
	for(i=0;i<form2.Q1.length;i++)
	{
		if(form2.Q1[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("enter your choice for Question 1");
		return (false);
	}		
	
	var radioselected=false;                            
	for(i=0;i<form2.Q2.length;i++)
	{
		if(form2.Q2[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 2");
		return (false);
	}		
	
	var radioselected=false;                            
	for(i=0;i<form2.Q3.length;i++)
	{
		if(form2.Q3[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 3");
		return (false);
	}	
	var radioselected=false;                            
	for(i=0;i<form2.Q4.length;i++)
	{
		if(form2.Q4[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 4");
		return (false);
	}	
	var radioselected=false;                           
	for(i=0;i<form2.Q5.length;i++)
	{
		if(form2.Q5[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 5");
		return (false);
	}	
	var radioselected=false;                            
	for(i=0;i<form2.Q6.length;i++)
	{
		if(form2.Q6[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 6");
		return (false);
	}	
	var radioselected=false;                           
	for(i=0;i<form2.Q7.length;i++)
	{
		if(form2.Q7[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 7");
		return (false);
	}	
	var radioselected=false;                            
	for(i=0;i<form2.Q8.length;i++)
	{
		if(form2.Q8[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 8");
		return (false);
	}
	var radioselected=false;                            
	for(i=0;i<form2.Q9.length;i++)
	{
		if(form2.Q9[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 9");
		return (false);
	}	
	
	var radioselected=false;                           
	for(i=0;i<form2.Q10.length;i++)
	{
		if(form2.Q10[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 10");
		return (false);
	}	
	
	var radioselected=false;                            
	for(i=0;i<form2.Q11.length;i++)
	{
		if(form2.Q11[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 11");
		return (false);
	}	
	var radioselected=false;                            
	for(i=0;i<form2.Q12.length;i++)
	{
		if(form2.Q12[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 12");
		return (false);
	}	
	var radioselected=false;                            
	for(i=0;i<form2.Q13.length;i++)
	{
		if(form2.Q13[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 13");
		return (false);
	}	
	var radioselected=false;                            
	for(i=0;i<form2.Q14.length;i++)
	{
		if(form2.Q14[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 14");
		return (false);
	}	
	
	var radioselected=false;                            
	for(i=0;i<form2.Q15.length;i++)
	{
		if(form2.Q15[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 15");
		return (false);
	}
	
	var radioselected=false;                            
	for(i=0;i<form2.Q16.length;i++)
	{
		if(form2.Q16[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 16");
		return (false);
	}	
	
	var radioselected=false;                            
	for(i=0;i<form2.Q17.length;i++)
	{
		if(form2.Q17[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 17");
		return (false);
	}		
	
	var radioselected=false;                            
	for(i=0;i<form2.Q18.length;i++)
	{
		if(form2.Q18[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 18");
		return (false);
	}	
	
	var radioselected=false;                            
	for(i=0;i<form2.Q19.length;i++)
	{
		if(form2.Q19[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 19");
		return (false);
	}	
	
	var radioselected=false;                            
	for(i=0;i<form2.Q20.length;i++)
	{
		if(form2.Q20[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 20");
		return (false);
	}	
	var radioselected=false;                            
	for(i=0;i<form2.Q21.length;i++)
	{
		if(form2.Q21[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 21");
		return (false);
	}	
	var radioselected=false;                            
	for(i=0;i<form2.Q22.length;i++)
	{
		if(form2.Q22[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 22");
		return (false);
	}	
	var radioselected=false;                            
	for(i=0;i<form2.Q23.length;i++)
	{
		if(form2.Q23[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 23");
		return (false);
	}	
	var radioselected=false;                            
	for(i=0;i<form2.Q24.length;i++)
	{
		if(form2.Q24[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 24");
		return (false);
	}	
	var radioselected=false;                            
	for(i=0;i<form2.Q25.length;i++)
	{
		if(form2.Q25[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 25");
		return (false);
	}	
	var radioselected=false;                            
	for(i=0;i<form2.Q26.length;i++)
	{
		if(form2.Q26[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 26");
		return (false);
	}	
	var radioselected=false;                            
	for(i=0;i<form2.Q27.length;i++)
	{
		if(form2.Q27[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 27");
		return (false);
	}	
	var radioselected=false;                            
	for(i=0;i<form2.Q28.length;i++)
	{
		if(form2.Q28[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 28");
		return (false);
	}	
	var radioselected=false;                            
	for(i=0;i<form2.Q29.length;i++)
	{
		if(form2.Q29[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 29");
		return (false);
	}	
	var radioselected=false;                            
	for(i=0;i<form2.Q30.length;i++)
	{
		if(form2.Q30[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 30");
		return (false);
	}	
	var radioselected=false;                            
	for(i=0;i<form2.Q31.length;i++)
	{
		if(form2.Q31[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 31");
		return (false);
	}	
	var radioselected=false;                            
	for(i=0;i<form2.Q32.length;i++)
	{
		if(form2.Q32[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 32");
		return (false);
	}	
	var radioselected=false;                            
	for(i=0;i<form2.Q33.length;i++)
	{
		if(form2.Q33[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 33");
		return (false);
	}	
	var radioselected=false;                            
	for(i=0;i<form2.Q34.length;i++)
	{
		if(form2.Q34[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 34");
		return (false);
	}	
	var radioselected=false;                            
	for(i=0;i<form2.Q35.length;i++)
	{
		if(form2.Q35[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 35");
		return (false);
	}	
	var radioselected=false;                            
	for(i=0;i<form2.Q36.length;i++)
	{
		if(form2.Q36[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 36");
		return (false);
	}	
	var radioselected=false;                            
	for(i=0;i<form2.Q37.length;i++)
	{
		if(form2.Q37[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 37");
		return (false);
	}	
	var radioselected=false;                            
	for(i=0;i<form2.Q38.length;i++)
	{
		if(form2.Q38[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 38");
		return (false);
	}	
	var radioselected=false;                            
	for(i=0;i<form2.Q39.length;i++)
	{
		if(form2.Q39[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 39");
		return (false);
	}	
	var radioselected=false;                            
	for(i=0;i<form2.Q40.length;i++)
	{
		if(form2.Q40[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 40");
		return (false);
	}
	var radioselected=false;                            
	for(i=0;i<form2.Q41.length;i++)
	{
		if(form2.Q41[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 41");
		return (false);
	}	
	var radioselected=false;                            
	for(i=0;i<form2.Q42.length;i++)
	{
		if(form2.Q42[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 42");
		return (false);
	}	
	var radioselected=false;                            
	for(i=0;i<form2.Q43.length;i++)
	{
		if(form2.Q43[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 43");
		return (false);
	}	
	var radioselected=false;                            
	for(i=0;i<form2.Q44.length;i++)
	{
		if(form2.Q44[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 44");
		return (false);
	}	
	var radioselected=false;                            
	for(i=0;i<form2.Q45.length;i++)
	{
		if(form2.Q45[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 45");
		return (false);
	}	
	var radioselected=false;                            
	for(i=0;i<form2.Q46.length;i++)
	{
		if(form2.Q46[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 46");
		return (false);
	}	
	var radioselected=false;                            
	for(i=0;i<form2.Q47.length;i++)
	{
		if(form2.Q47[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 47");
		return (false);
	}	
	var radioselected=false;                            
	for(i=0;i<form2.Q48.length;i++)
	{
		if(form2.Q48[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 48");
		return (false);
	}	
	var radioselected=false;                            
	for(i=0;i<form2.Q49.length;i++)
	{
		if(form2.Q49[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 49");
		return (false);
	}	
	var radioselected=false;                            
	for(i=0;i<form2.Q50.length;i++)
	{
		if(form2.Q50[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 50");
		return (false);
	}		
	return(true);
}
//--></script>

<p align="left"><font size="+1"><strong>My navigation strategies while using CoMPASS </strong></font></p>
<form method="post" name="form2" id="form2" action="savesurveyanswer.php" onSubmit="return form2_validate(this);" >
<?
if(		$name == null && 
		$class == null && 
		$teacher == null && 
		$gender == null){

?>
  <p><strong>Name:</strong> 
    <input name="Name" type="text" id="Name">
    <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Class: 
    <select name="Class" id="Class">
      <option value="Class 2">Class 2</option>
      <option value="Class 3">Class 3</option>
      <option value="Class 4">Class 4</option>
      <option value="Class 5">Class 5</option>
    </select>
    </strong></p>
  <p><strong>Teacher: 
    <select name="Teacher" id="Teacher">
      <option value="Mrs. Gnesdilow">Mrs. Gnesdilow</option>
      <option value="Mrs. Mehalakes">Mrs. Mehalakes</option>
    </select>
    &nbsp;&nbsp;&nbsp;&nbsp; Gender: Female 
    <input name="Gender" type="radio" value="1" checked>
    &nbsp;&nbsp; Male 
    <input type="radio" name="Gender" value="2">
    </strong></p>
<?
}
else{
?>
<input name="Name" type="hidden" value="<?=$name?>">
<input name="Class" type="hidden" value="<?=$class?>">
<input name="Teacher" type="hidden" value="<?=$teacher?>">
<input name="Gender" type="hidden" value="<?=$gender?>">
  <?
}
?>
  <p><strong>DIRECTIONS:</strong>&nbsp;How did you use CoMPASS to find information 
    about the challenge? Rate the following options based on how often you used 
    them. </p>
  <ul>
    <p>&nbsp;</p>
  </ul>
  <table width="99%" border="2">
    <tr> 
      <td>&nbsp;</td>
      <td>seldom</td>
      <td>sometimes</td>
      <td>often</td>
      <td>almost always</td>
    </tr>
    <tr> 
      <td width="59%">1. I have a purpose in mind when I read.</td>
      <td width="9%">1 
        <input type="radio" name="Q1" value="1"></td>
      <td width="8%">2 
        <input type="radio" name="Q1" value="2"></td>
      <td width="8%">3 
        <input type="radio" name="Q1" value="3"></td>
      <td width="8%">4 
        <input type="radio" name="Q1" value="4"></td>
    </tr>
    <tr> 
      <td>2. I decided what concept I should choose from the wheel map based on 
        what I thought would help me solve the challenge.</td>
      <td>1 
        <input type="radio" name="Q2" value="1"></td>
      <td>2 
        <input type="radio" name="Q2" value="2"></td>
      <td>3 
        <input type="radio" name="Q2" value="3"></td>
      <td>4 
        <input type="radio" name="Q2" value="4"></td>
    </tr>
    <tr> 
      <td>3. When I got lost I went back to the wheel map to choose a concept 
        because I could see all the concepts that were available in each topic.</td>
      <td>1 
        <input type="radio" name="Q3" value="1"></td>
      <td>2 
        <input type="radio" name="Q3" value="2"></td>
      <td>3 
        <input type="radio" name="Q3" value="3"></td>
      <td>4 
        <input type="radio" name="Q3" value="4"></td>
    </tr>
    <tr> 
      <td>4. I used the wheel map to choose a concept because it was simpler to 
        read than a concept map.</td>
      <td>1 
        <input type="radio" name="Q4" value="1"></td>
      <td>2 
        <input type="radio" name="Q4" value="2"></td>
      <td>3 
        <input type="radio" name="Q4" value="3"></td>
      <td>4 
        <input type="radio" name="Q4" value="4"></td>
    </tr>
    <tr> 
      <td>5. I clicked randomly on the blue highlighted words that were in the 
        text.</td>
      <td>1 
        <input type="radio" name="Q5" value="1"></td>
      <td>2 
        <input type="radio" name="Q5" value="2"></td>
      <td>3 
        <input type="radio" name="Q5" value="3"></td>
      <td>4 
        <input type="radio" name="Q5" value="4"></td>
    </tr>
    <tr> 
      <td>6. I clicked on the blue highlighted words in the text if I found a 
        concept that I did not know about.</td>
      <td>1 
        <input type="radio" name="Q6" value="1"></td>
      <td>2 
        <input type="radio" name="Q6" value="2"></td>
      <td>3 
        <input type="radio" name="Q6" value="3"></td>
      <td>4 
        <input type="radio" name="Q6" value="4"></td>
    </tr>
    <tr> 
      <td>7. I clicked on the blue highlighted words in the text if I found a 
        concept that I thought would be helpful to solve the challenge.</td>
      <td>1 
        <input type="radio" name="Q7" value="1"></td>
      <td>2 
        <input type="radio" name="Q7" value="2"></td>
      <td>3 
        <input type="radio" name="Q7" value="3"></td>
      <td>4 
        <input type="radio" name="Q7" value="4"></td>
    </tr>
    <tr> 
      <td>8. After reading the text that was available for a concept, I clicked 
        on random concepts from the maps without reading the description of the 
        arrows to see how the concepts were related.</td>
      <td>1 
        <input type="radio" name="Q8" value="1"></td>
      <td>2 
        <input type="radio" name="Q8" value="2"></td>
      <td>3 
        <input type="radio" name="Q8" value="3"></td>
      <td>4 
        <input type="radio" name="Q8" value="4"></td>
    </tr>
    <tr> 
      <td>9. I focused on reading and understanding the information in the text 
        and did not pay any attention to the map.</td>
      <td>1 
        <input type="radio" name="Q9" value="1"></td>
      <td>2 
        <input type="radio" name="Q9" value="2"></td>
      <td>3 
        <input type="radio" name="Q9" value="3"></td>
      <td>4 
        <input type="radio" name="Q9" value="4"></td>
    </tr>
    <tr> 
      <td>10. I read the text that was available for a concept and then read the 
        map to decide where I should go next.</td>
      <td>1 
        <input type="radio" name="Q10" value="1"></td>
      <td>2 
        <input type="radio" name="Q10" value="2"></td>
      <td>3 
        <input type="radio" name="Q10" value="3"></td>
      <td>4 
        <input type="radio" name="Q10" value="4"></td>
    </tr>
    <tr> 
      <td>11. I found the the animation that showed changes in the concept maps 
        to be helpful.</td>
      <td>1 
        <input type="radio" name="Q11" value="1"></td>
      <td>2 
        <input type="radio" name="Q11" value="2"></td>
      <td>3 
        <input type="radio" name="Q11" value="3"></td>
      <td>4 
        <input type="radio" name="Q11" value="4"></td>
    </tr>
    <tr> 
      <td>12. I chose to read the text of the most closely related concepts (concepts 
        that appeared large and close to the concept I focused on) in order to 
        find information to solve the challenge.</td>
      <td>1 
        <input type="radio" name="Q12" value="1"></td>
      <td>2 
        <input type="radio" name="Q12" value="2"></td>
      <td>3 
        <input type="radio" name="Q12" value="3"></td>
      <td>4 
        <input type="radio" name="Q12" value="4"></td>
    </tr>
    <tr> 
      <td>13. The different sizes of the boxes in the concept map helped me understand 
        what concepts I should choose next.</td>
      <td>1 
        <input type="radio" name="Q13" value="1"></td>
      <td>2 
        <input type="radio" name="Q13" value="2"></td>
      <td>3 
        <input type="radio" name="Q13" value="3"></td>
      <td>4 
        <input type="radio" name="Q13" value="4"></td>
    </tr>
    <tr> 
      <td>14. I used the map to understand the connections between concepts.</td>
      <td>1 
        <input type="radio" name="Q14" value="1"></td>
      <td>2 
        <input type="radio" name="Q14" value="2"></td>
      <td>3 
        <input type="radio" name="Q14" value="3"></td>
      <td>4 
        <input type="radio" name="Q14" value="4"></td>
    </tr>
    <tr> 
      <td>15. The concept map helped me to choose concepts relevant to my goal.</td>
      <td>1 
        <input type="radio" name="Q15" value="1"></td>
      <td>2 
        <input type="radio" name="Q15" value="2"></td>
      <td>3 
        <input type="radio" name="Q15" value="3"></td>
      <td>4 
        <input type="radio" name="Q15" value="4"></td>
    </tr>
    <tr> 
      <td>16. I tried to visit all concepts on the concept map when I used CoMPASS.</td>
      <td>1 
        <input type="radio" name="Q16" value="1"></td>
      <td>2 
        <input type="radio" name="Q16" value="2"></td>
      <td>3 
        <input type="radio" name="Q16" value="3"></td>
      <td>4 
        <input type="radio" name="Q16" value="4"></td>
    </tr>
    <tr> 
      <td>17. The animation to show changes in maps was very confusing.</td>
      <td>1 
        <input type="radio" name="Q17" value="1"></td>
      <td>2 
        <input type="radio" name="Q17" value="2"></td>
      <td>3 
        <input type="radio" name="Q17" value="3"></td>
      <td>4 
        <input type="radio" name="Q17" value="4"></td>
    </tr>
    <tr> 
      <td>18. I found it very confusing that the position of ALL the concepts 
        changed when the concept maps changed.</td>
      <td>1 
        <input type="radio" name="Q18" value="1"></td>
      <td>2 
        <input type="radio" name="Q18" value="2"></td>
      <td>3 
        <input type="radio" name="Q18" value="3"></td>
      <td>4 
        <input type="radio" name="Q18" value="4"></td>
    </tr>
    <tr> 
      <td>19. Using the concept maps in CoMPASS helped me learn to draw my own 
        concept maps better. </td>
      <td>1 
        <input type="radio" name="Q19" value="1"></td>
      <td>2 
        <input type="radio" name="Q19" value="2"></td>
      <td>3 
        <input type="radio" name="Q19" value="3"></td>
      <td>4 
        <input type="radio" name="Q19" value="4"></td>
    </tr>
    <tr> 
      <td>20. I found it very confusing that the same concept is drawn at different 
        positions on different maps</td>
      <td>1 
        <input type="radio" name="Q20" value="1"></td>
      <td>2 
        <input type="radio" name="Q20" value="2"></td>
      <td>3 
        <input type="radio" name="Q20" value="3"></td>
      <td>4 
        <input type="radio" name="Q20" value="4"></td>
    </tr>
    <tr> 
      <td>21. I used the links at the top of the page to understand a concept 
        (e.g. force) from different perspectives such as linear motion, circular 
        motion, falling objects.</td>
      <td>1 
        <input type="radio" name="Q21" value="1"></td>
      <td>2 
        <input type="radio" name="Q21" value="2"></td>
      <td>3 
        <input type="radio" name="Q21" value="3"></td>
      <td>4 
        <input type="radio" name="Q21" value="4"></td>
    </tr>
    <tr> 
      <td>22. When I was reading about a concept such as acceleration, it helped 
        me to use the links at the top of the page to read about it in other topics 
        .</td>
      <td>1 
        <input type="radio" name="Q22" value="1"></td>
      <td>2 
        <input type="radio" name="Q22" value="2"></td>
      <td>3 
        <input type="radio" name="Q22" value="3"></td>
      <td>4 
        <input type="radio" name="Q22" value="4"></td>
    </tr>
    <tr> 
      <td>23. I used the search option to type a question when I did not know 
        what concept I should choose.</td>
      <td>1 
        <input type="radio" name="Q23" value="1"></td>
      <td>2 
        <input type="radio" name="Q23" value="2"></td>
      <td>3 
        <input type="radio" name="Q23" value="3"></td>
      <td>4 
        <input type="radio" name="Q23" value="4"></td>
    </tr>
    <tr> 
      <td>24. I used the search option to type keywords that I thought would help 
        me solve the challenge.</td>
      <td>1 
        <input type="radio" name="Q24" value="1"></td>
      <td>2 
        <input type="radio" name="Q24" value="2"></td>
      <td>3 
        <input type="radio" name="Q24" value="3"></td>
      <td>4 
        <input type="radio" name="Q24" value="4"></td>
    </tr>
    <tr> 
      <td>25. I skimmed the text for each concept to look for information that 
        would help me solve the challenge.</td>
      <td>1 
        <input type="radio" name="Q25" value="1"></td>
      <td>2 
        <input type="radio" name="Q25" value="2"></td>
      <td>3 
        <input type="radio" name="Q25" value="3"></td>
      <td>4 
        <input type="radio" name="Q25" value="4"></td>
    </tr>
    <tr> 
      <td>26. I read very carefully the text for each concept and tried to understand 
        the information before I moved on.</td>
      <td>1 
        <input type="radio" name="Q26" value="1"></td>
      <td>2 
        <input type="radio" name="Q26" value="2"></td>
      <td>3 
        <input type="radio" name="Q26" value="3"></td>
      <td>4 
        <input type="radio" name="Q26" value="4"></td>
    </tr>
  </table>
	
  <p>&nbsp;</p>
  <p>Use a scale from 1 to 4 to rate how useful the following navigation tools 
    in CoMPASS were for finding information to complete the challenge that you 
    were assigned. <br>
  </p>
  <table width="80%" border="2">
    <tr> 
      <td width="67%">&nbsp;</td>
      <td width="9%">seldom</td>
      <td width="8%">sometimes</td>
      <td width="8%">often</td>
      <td width="8%">almost always</td>
    </tr>
    <tr> 
      <td>A. Concept Maps</td>
      <td>1 
        <input type="radio" name="Q27" value="1"></td>
      <td>2 
        <input type="radio" name="Q27" value="2"></td>
      <td>3 
        <input type="radio" name="Q27" value="3"></td>
      <td>4 
        <input type="radio" name="Q27" value="4"></td>
    </tr>
    <tr> 
      <td>B. Wheel Map</td>
      <td>1 
        <input type="radio" name="Q28" value="1"></td>
      <td>2 
        <input type="radio" name="Q28" value="2"></td>
      <td>3 
        <input type="radio" name="Q28" value="3"></td>
      <td>4 
        <input type="radio" name="Q28" value="4"></td>
    </tr>
    <tr> 
      <td>C. Search</td>
      <td>1 
        <input type="radio" name="Q29" value="1"></td>
      <td>2 
        <input type="radio" name="Q29" value="2"></td>
      <td>3 
        <input type="radio" name="Q29" value="3"></td>
      <td>4 
        <input type="radio" name="Q29" value="4"></td>
    </tr>
    <tr> 
      <td>D. Hyperlinks (highlighted words) within the reading text</td>
      <td>1 
        <input type="radio" name="Q30" value="1"></td>
      <td>2 
        <input type="radio" name="Q30" value="2"></td>
      <td>3 
        <input type="radio" name="Q30" value="3"></td>
      <td>4 
        <input type="radio" name="Q30" value="4"></td>
    </tr>
    <tr> 
      <td>E. Reading a concept in other topics (Top Navigation Bar)</td>
      <td>1 
        <input type="radio" name="Q31" value="1"></td>
      <td>2 
        <input type="radio" name="Q31" value="2"></td>
      <td>3 
        <input type="radio" name="Q31" value="3"></td>
      <td>4 
        <input type="radio" name="Q31" value="4"></td>
    </tr>
  </table>
  <p>&nbsp;</p><p>You have used the CoMPASS system to find information that would help you 
    solve the challenge. Explain what difficulties you encountered while using 
    CoMPASS.</p>
  <textarea name="Q32" cols="60" rows="5"></textarea>
  <p align="left">What kind of help did you need while reading from CoMPASS?</p>
  <p></p>
  </p>
  <textarea name="Q33" cols="60" rows="5"></textarea>
  <div align="center">
    <input name="Submit2" type="submit" id="Submit2" value="Submit">
    <input name="reset2" type="reset" id="reset2" value="Reset">
  </div>
  <p>&nbsp; </p>
</form>
<p align="left">&nbsp; </p>
</body>
</html>
