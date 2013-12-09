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
<title>Reading Survey</title>
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

<p align="left"><font size="+1"><strong>READING SURVEY </strong></font></p>
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

  <p><strong>DIRECTIONS:</strong>Listed below are statements about what people 
    do when they read <u>school-related materials </u>such as textbooks, library 
    books, etc. Five numbers follow each statement (1, 2, 3, 4, 5) and each number 
    means the following:<br>
  </p>
  <p> 
  <ul>
    <li><strong>1</strong> means <strong>“I never or almost never do this.”</strong> 
    </li>
    <br>
    <li><strong>2</strong> means <strong>“I do this only occasionally.” </strong></li>
    <br>
    <li> <strong>3</strong> means <strong>“I sometimes do this.” </strong></li>
    <br>
    <li><strong>4 </strong>means <strong>“I usually do this.”</strong></li>
    <strong><br>
    </strong> 
    <li><strong>5</strong> means<strong> “I always or almost always do this.”</strong></li>
    <p>After reading each statement, choose the number (1, 2, 3, 4, or 5) that 
      applies to you. Please note that there are no right or wrong answers to 
      the statements in this inventory. </p>
    <p>&nbsp;</p>
  </ul>
  <table width="99%" border="2">
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
      <td width="8%">5 
        <input type="radio" name="Q1" value="5"></td>
    </tr>
    <tr> 
      <td>2. I take notes while reading to help me understand what I read.</td>
      <td>1 
        <input type="radio" name="Q2" value="1"></td>
      <td>2 
        <input type="radio" name="Q2" value="2"></td>
      <td>3 
        <input type="radio" name="Q2" value="3"></td>
      <td>4 
        <input type="radio" name="Q2" value="4"></td>
      <td>5 
        <input type="radio" name="Q2" value="5"></td>
    </tr>
    <tr> 
      <td>3. I think about what I know to help me understand what I read.</td>
      <td>1 
        <input type="radio" name="Q3" value="1"></td>
      <td>2 
        <input type="radio" name="Q3" value="2"></td>
      <td>3 
        <input type="radio" name="Q3" value="3"></td>
      <td>4 
        <input type="radio" name="Q3" value="4"></td>
      <td>5 
        <input type="radio" name="Q3" value="5"></td>
    </tr>
    <tr> 
      <td>4. I preview the text to see what it&#8217;s about before reading it.</td>
      <td>1 
        <input type="radio" name="Q4" value="1"></td>
      <td>2 
        <input type="radio" name="Q4" value="2"></td>
      <td>3 
        <input type="radio" name="Q4" value="3"></td>
      <td>4 
        <input type="radio" name="Q4" value="4"></td>
      <td>5 
        <input type="radio" name="Q4" value="5"></td>
    </tr>
    <tr> 
      <td>5. When text becomes difficult, I read aloud to help me understand what 
        I read.</td>
      <td>1 
        <input type="radio" name="Q5" value="1"></td>
      <td>2 
        <input type="radio" name="Q5" value="2"></td>
      <td>3 
        <input type="radio" name="Q5" value="3"></td>
      <td>4 
        <input type="radio" name="Q5" value="4"></td>
      <td>5 
        <input type="radio" name="Q5" value="5"></td>
    </tr>
    <tr> 
      <td>6. I summarize what I read to reflect on important information in the 
        text.</td>
      <td>1 
        <input type="radio" name="Q6" value="1"></td>
      <td>2 
        <input type="radio" name="Q6" value="2"></td>
      <td>3 
        <input type="radio" name="Q6" value="3"></td>
      <td>4 
        <input type="radio" name="Q6" value="4"></td>
      <td>5 
        <input type="radio" name="Q6" value="5"></td>
    </tr>
    <tr> 
      <td>7. I think about whether the content of the text fits my reading purpose.</td>
      <td>1 
        <input type="radio" name="Q7" value="1"></td>
      <td>2 
        <input type="radio" name="Q7" value="2"></td>
      <td>3 
        <input type="radio" name="Q7" value="3"></td>
      <td>4 
        <input type="radio" name="Q7" value="4"></td>
      <td>5 
        <input type="radio" name="Q7" value="5"></td>
    </tr>
    <tr> 
      <td>8. I read slowly and carefully to be sure I understand what I&#8217;m 
        reading.</td>
      <td>1 
        <input type="radio" name="Q8" value="1"></td>
      <td>2 
        <input type="radio" name="Q8" value="2"></td>
      <td>3 
        <input type="radio" name="Q8" value="3"></td>
      <td>4 
        <input type="radio" name="Q8" value="4"></td>
      <td>5 
        <input type="radio" name="Q8" value="5"></td>
    </tr>
    <tr> 
      <td>9. I discuss what I read with others to check my understanding.</td>
      <td>1 
        <input type="radio" name="Q9" value="1"></td>
      <td>2 
        <input type="radio" name="Q9" value="2"></td>
      <td>3 
        <input type="radio" name="Q9" value="3"></td>
      <td>4 
        <input type="radio" name="Q9" value="4"></td>
      <td>5 
        <input type="radio" name="Q9" value="5"></td>
    </tr>
    <tr> 
      <td>10. I skim the text first by noting characteristics like length and 
        organization.</td>
      <td>1 
        <input type="radio" name="Q10" value="1"></td>
      <td>2 
        <input type="radio" name="Q10" value="2"></td>
      <td>3 
        <input type="radio" name="Q10" value="3"></td>
      <td>4 
        <input type="radio" name="Q10" value="4"></td>
      <td>5 
        <input type="radio" name="Q10" value="5"></td>
    </tr>
    <tr> 
      <td>11. I try to get back on track when I lose concentration.</td>
      <td>1 
        <input type="radio" name="Q11" value="1"></td>
      <td>2 
        <input type="radio" name="Q11" value="2"></td>
      <td>3 
        <input type="radio" name="Q11" value="3"></td>
      <td>4 
        <input type="radio" name="Q11" value="4"></td>
      <td>5 
        <input type="radio" name="Q11" value="5"></td>
    </tr>
    <tr> 
      <td>12. I underline or circle information in the text to help me remember 
        it.</td>
      <td>1 
        <input type="radio" name="Q12" value="1"></td>
      <td>2 
        <input type="radio" name="Q12" value="2"></td>
      <td>3 
        <input type="radio" name="Q12" value="3"></td>
      <td>4 
        <input type="radio" name="Q12" value="4"></td>
      <td>5 
        <input type="radio" name="Q12" value="5"></td>
    </tr>
    <tr> 
      <td>13. I adjust my reading speed according to what I&#8217;m reading.</td>
      <td>1 
        <input type="radio" name="Q13" value="1"></td>
      <td>2 
        <input type="radio" name="Q13" value="2"></td>
      <td>3 
        <input type="radio" name="Q13" value="3"></td>
      <td>4 
        <input type="radio" name="Q13" value="4"></td>
      <td>5 
        <input type="radio" name="Q13" value="5"></td>
    </tr>
    <tr> 
      <td>14. I decide what to read closely and what to ignore.</td>
      <td>1 
        <input type="radio" name="Q14" value="1"></td>
      <td>2 
        <input type="radio" name="Q14" value="2"></td>
      <td>3 
        <input type="radio" name="Q14" value="3"></td>
      <td>4 
        <input type="radio" name="Q14" value="4"></td>
      <td>5 
        <input type="radio" name="Q14" value="5"></td>
    </tr>
    <tr> 
      <td>15. I use reference materials such as dictionaries to help me understand 
        what I read.</td>
      <td>1 
        <input type="radio" name="Q15" value="1"></td>
      <td>2 
        <input type="radio" name="Q15" value="2"></td>
      <td>3 
        <input type="radio" name="Q15" value="3"></td>
      <td>4 
        <input type="radio" name="Q15" value="4"></td>
      <td>5 
        <input type="radio" name="Q15" value="5"></td>
    </tr>
    <tr>
      <td>16. When text becomes difficult, I pay closer attention to what I&#8217;m 
        reading.</td>
      <td>1
        <input type="radio" name="Q16" value="1"></td>
      <td>2
        <input type="radio" name="Q16" value="2"></td>
      <td>3
        <input type="radio" name="Q16" value="3"></td>
      <td>4
        <input type="radio" name="Q16" value="4"></td>
      <td>5
        <input type="radio" name="Q16" value="5"></td>
    </tr>
    <tr>
      <td>17. I use tables, figures, and pictures in text to increase my understanding.</td>
      <td>1
        <input type="radio" name="Q17" value="1"></td>
      <td>2
        <input type="radio" name="Q17" value="2"></td>
      <td>3
        <input type="radio" name="Q17" value="3"></td>
      <td>4
        <input type="radio" name="Q17" value="4"></td>
      <td>5
        <input type="radio" name="Q17" value="5"></td>
    </tr>
    <tr>
      <td>18. I stop from time to time and think about what I&#8217;m reading.</td>
      <td>1
        <input type="radio" name="Q18" value="1"></td>
      <td>2
        <input type="radio" name="Q18" value="2"></td>
      <td>3
        <input type="radio" name="Q18" value="3"></td>
      <td>4
        <input type="radio" name="Q18" value="4"></td>
      <td>5
        <input type="radio" name="Q18" value="5"></td>
    </tr>
    <tr>
      <td>19. I use context clues to help me better understand what I&#8217;m 
        reading.</td>
      <td>1
        <input type="radio" name="Q19" value="1"></td>
      <td>2
        <input type="radio" name="Q19" value="2"></td>
      <td>3
        <input type="radio" name="Q19" value="3"></td>
      <td>4
        <input type="radio" name="Q19" value="4"></td>
      <td>5
        <input type="radio" name="Q19" value="5"></td>
    </tr>
    <tr>
      <td>20. I paraphrase (restate ideas in my own words) to better understand 
        what I read.</td>
      <td>1
        <input type="radio" name="Q20" value="1"></td>
      <td>2
        <input type="radio" name="Q20" value="2"></td>
      <td>3
        <input type="radio" name="Q20" value="3"></td>
      <td>4
        <input type="radio" name="Q20" value="4"></td>
      <td>5
        <input type="radio" name="Q20" value="5"></td>
    </tr>
    <tr>
      <td>21. I try to picture or visualize information to help remember what 
        I read.</td>
      <td>1
        <input type="radio" name="Q21" value="1"></td>
      <td>2
        <input type="radio" name="Q21" value="2"></td>
      <td>3
        <input type="radio" name="Q21" value="3"></td>
      <td>4
        <input type="radio" name="Q21" value="4"></td>
      <td>5
        <input type="radio" name="Q21" value="5"></td>
    </tr>
    <tr>
      <td>22. I use typographical aids like bold face and italics to identify 
        key information.</td>
      <td>1
        <input type="radio" name="Q22" value="1"></td>
      <td>2
        <input type="radio" name="Q22" value="2"></td>
      <td>3
        <input type="radio" name="Q22" value="3"></td>
      <td>4
        <input type="radio" name="Q22" value="4"></td>
      <td>5
        <input type="radio" name="Q22" value="5"></td>
    </tr>
    <tr>
      <td>23. I critically analyze and evaluate the information presented in the 
        text.</td>
      <td>1
        <input type="radio" name="Q23" value="1"></td>
      <td>2
        <input type="radio" name="Q23" value="2"></td>
      <td>3
        <input type="radio" name="Q23" value="3"></td>
      <td>4
        <input type="radio" name="Q23" value="4"></td>
      <td>5
        <input type="radio" name="Q23" value="5"></td>
    </tr>
    <tr>
      <td>24. I go back and forth in the text to find relationships among ideas 
        in it.</td>
      <td>1
        <input type="radio" name="Q24" value="1"></td>
      <td>2
        <input type="radio" name="Q24" value="2"></td>
      <td>3
        <input type="radio" name="Q24" value="3"></td>
      <td>4
        <input type="radio" name="Q24" value="4"></td>
      <td>5
        <input type="radio" name="Q24" value="5"></td>
    </tr>
    <tr>
      <td>25. I check my understanding when I come across conflicting information.</td>
      <td>1
        <input type="radio" name="Q25" value="1"></td>
      <td>2
        <input type="radio" name="Q25" value="2"></td>
      <td>3
        <input type="radio" name="Q25" value="3"></td>
      <td>4
        <input type="radio" name="Q25" value="4"></td>
      <td>5
        <input type="radio" name="Q25" value="5"></td>
    </tr>
    <tr>
      <td>26. I try to guess what the material is about when I read.</td>
      <td>1
        <input type="radio" name="Q26" value="1"></td>
      <td>2
        <input type="radio" name="Q26" value="2"></td>
      <td>3
        <input type="radio" name="Q26" value="3"></td>
      <td>4
        <input type="radio" name="Q26" value="4"></td>
      <td>5
        <input type="radio" name="Q26" value="5"></td>
    </tr>
    <tr>
      <td>27. When text becomes difficult, I re-read to increase my understanding.</td>
      <td>1
        <input type="radio" name="Q27" value="1"></td>
      <td>2
        <input type="radio" name="Q27" value="2"></td>
      <td>3
        <input type="radio" name="Q27" value="3"></td>
      <td>4
        <input type="radio" name="Q27" value="4"></td>
      <td>5
        <input type="radio" name="Q27" value="5"></td>
    </tr>
    <tr>
      <td>28. I ask myself questions I would like to have answered in the text.</td>
      <td>1
        <input type="radio" name="Q28" value="1"></td>
      <td>2
        <input type="radio" name="Q28" value="2"></td>
      <td>3
        <input type="radio" name="Q28" value="3"></td>
      <td>4
        <input type="radio" name="Q28" value="4"></td>
      <td>5
        <input type="radio" name="Q28" value="5"></td>
    </tr>
    <tr>
      <td>29. I check to see if my guesses about the text are right or wrong.</td>
      <td>1
        <input type="radio" name="Q29" value="1"></td>
      <td>2
        <input type="radio" name="Q29" value="2"></td>
      <td>3
        <input type="radio" name="Q29" value="3"></td>
      <td>4
        <input type="radio" name="Q29" value="4"></td>
      <td>5
        <input type="radio" name="Q29" value="5"></td>
    </tr>
    <tr>
      <td>30. I try to guess the meaning of unknown words or phrases.</td>
      <td>1
        <input type="radio" name="Q30" value="1"></td>
      <td>2
        <input type="radio" name="Q30" value="2"></td>
      <td>3
        <input type="radio" name="Q30" value="3"></td>
      <td>4
        <input type="radio" name="Q30" value="4"></td>
      <td>5
        <input type="radio" name="Q30" value="5"></td>
    </tr>
    <tr>
      <td>31. I use pictures to help me understand a text.</td>
      <td>1
        <input type="radio" name="Q31" value="1"></td>
      <td>2
        <input type="radio" name="Q31" value="2"></td>
      <td>3
        <input type="radio" name="Q31" value="3"></td>
      <td>4
        <input type="radio" name="Q31" value="4"></td>
      <td>5
        <input type="radio" name="Q31" value="5"></td>
    </tr>
    <tr>
      <td>32. I find the headings and subheadings in a text helpful.</td>
      <td>1
        <input type="radio" name="Q32" value="1"></td>
      <td>2
        <input type="radio" name="Q32" value="2"></td>
      <td>3
        <input type="radio" name="Q32" value="3"></td>
      <td>4
        <input type="radio" name="Q32" value="4"></td>
      <td>5
        <input type="radio" name="Q32" value="5"></td>
    </tr>
    <tr>
      <td>33. I go back and read the parts of a chapter several times if I do 
        not understand it.</td>
      <td>1
        <input type="radio" name="Q33" value="1"></td>
      <td>2
        <input type="radio" name="Q33" value="2"></td>
      <td>3
        <input type="radio" name="Q33" value="3"></td>
      <td>4
        <input type="radio" name="Q33" value="4"></td>
      <td>5
        <input type="radio" name="Q33" value="5"></td>
    </tr>
    <tr>
      <td>34. While reading a chapter I skip the parts I do not understand.</td>
      <td>1
        <input type="radio" name="Q34" value="1"></td>
      <td>2
        <input type="radio" name="Q34" value="2"></td>
      <td>3
        <input type="radio" name="Q34" value="3"></td>
      <td>4
        <input type="radio" name="Q34" value="4"></td>
      <td>5
        <input type="radio" name="Q34" value="5"></td>
    </tr>
    <tr>
      <td>35. I use the headings and subheadings in a chapter to get a summary 
        of what&#8217;s in the chapter.</td>
      <td>1
        <input type="radio" name="Q35" value="1"></td>
      <td>2
        <input type="radio" name="Q35" value="2"></td>
      <td>3
        <input type="radio" name="Q35" value="3"></td>
      <td>4
        <input type="radio" name="Q35" value="4"></td>
      <td>5
        <input name="Q35" type="radio" value="5"></td>
    </tr>
    <tr>
      <td>36. Before I start reading, I flip through the chapter to see what&#8217;s 
        in it.</td>
      <td>1
        <input type="radio" name="Q36" value="1"></td>
      <td>2
        <input type="radio" name="Q36" value="2"></td>
      <td>3
        <input type="radio" name="Q36" value="3"></td>
      <td>4
        <input type="radio" name="Q36" value="4"></td>
      <td>5
        <input type="radio" name="Q36" value="5"></td>
    </tr>
    <tr>
      <td>37. I like to start reading the chapter and not flip through it first 
        because I have to read it anyway.</td>
      <td>1
        <input type="radio" name="Q37" value="1"></td>
      <td>2
        <input type="radio" name="Q37" value="2"></td>
      <td>3
        <input type="radio" name="Q37" value="3"></td>
      <td>4
        <input type="radio" name="Q37" value="4"></td>
      <td>5
        <input type="radio" name="Q37" value="5"></td>
    </tr>
    <tr>
      <td>38. Before I start reading a chapter I think about what I know about 
        the subject.</td>
      <td>1
        <input type="radio" name="Q38" value="1"></td>
      <td>2
        <input type="radio" name="Q38" value="2"></td>
      <td>3
        <input type="radio" name="Q38" value="3"></td>
      <td>4
        <input type="radio" name="Q38" value="4"></td>
      <td>5
        <input type="radio" name="Q38" value="5"></td>
    </tr>
    <tr>
      <td>39. I go back and read a text over again to clarify a specific idea.</td>
      <td>1
        <input type="radio" name="Q39" value="1"></td>
      <td>2
        <input type="radio" name="Q39" value="2"></td>
      <td>3
        <input type="radio" name="Q39" value="3"></td>
      <td>4
        <input type="radio" name="Q39" value="4"></td>
      <td>5
        <input type="radio" name="Q39" value="5"></td>
    </tr>
    <tr>
      <td>40. If a chapter is difficult, I read it more slowly to understand it.</td>
      <td>1
        <input type="radio" name="Q40" value="1"></td>
      <td>2
        <input type="radio" name="Q40" value="2"></td>
      <td>3
        <input type="radio" name="Q40" value="3"></td>
      <td>4
        <input type="radio" name="Q40" value="4"></td>
      <td>5
        <input type="radio" name="Q40" value="5"></td>
    </tr>
    <tr>
      <td>41. When I come across a part of chapter that is confusing I read it 
        again and again or ask for help.</td>
      <td>1
        <input type="radio" name="Q41" value="1"></td>
      <td>2
        <input type="radio" name="Q41" value="2"></td>
      <td>3
        <input type="radio" name="Q41" value="3"></td>
      <td>4
        <input type="radio" name="Q41" value="4"></td>
      <td>5
        <input type="radio" name="Q41" value="5"></td>
    </tr>
    <tr>
      <td>42. I go back and read a text over again if it seems important for my 
        goal.</td>
      <td>1
        <input type="radio" name="Q42" value="1"></td>
      <td>2
        <input type="radio" name="Q42" value="2"></td>
      <td>3
        <input type="radio" name="Q42" value="3"></td>
      <td>4
        <input type="radio" name="Q42" value="4"></td>
      <td>5
        <input type="radio" name="Q42" value="5"></td>
    </tr>
    <tr>
      <td>43. I think about my goal before I start reading a text.</td>
      <td>1
        <input type="radio" name="Q43" value="1"></td>
      <td>2
        <input type="radio" name="Q43" value="2"></td>
      <td>3
        <input type="radio" name="Q43" value="3"></td>
      <td>4
        <input type="radio" name="Q43" value="4"></td>
      <td>5
        <input type="radio" name="Q43" value="5"></td>
    </tr>
    <tr>
      <td>44. I try to summarize main ideas in my head to help me understand the 
        text better.</td>
      <td>1
        <input type="radio" name="Q44" value="1"></td>
      <td>2
        <input type="radio" name="Q44" value="2"></td>
      <td>3
        <input type="radio" name="Q44" value="3"></td>
      <td>4
        <input type="radio" name="Q44" value="4"></td>
      <td>5
        <input type="radio" name="Q44" value="5"></td>
    </tr>
    <tr>
      <td>45. I look for main ideas in a chapter as I read.</td>
      <td>1
        <input type="radio" name="Q45" value="1"></td>
      <td>2
        <input type="radio" name="Q45" value="2"></td>
      <td>3
        <input type="radio" name="Q45" value="3"></td>
      <td>4
        <input type="radio" name="Q45" value="4"></td>
      <td>5
        <input type="radio" name="Q45" value="5"></td>
    </tr>
  </table>
  <p><strong>Please, choose the appropriate response that you think matches your 
    feeling about each statement according to the following categories:</strong></p>
  <p align="center"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SD = STRONGLY DISAGREE </p>
  <p align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;D = DISAGREE </p>
  <p align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N = NEUTRAL/ UNDECIDED </p>
  <p align="center"> A = AGREE</p>
  <p align="center"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
    &nbsp;&nbsp;SA= STRONGLY AGREE </p>
  <table width="99%" border="2">
    <tr>
      <td width="59%">46. I like creating concept maps when I study science at 
        home. </td>
      <td width="9%">SD
        <input type="radio" name="Q46" value="1"></td>
      <td width="9%">D
        <input type="radio" name="Q46" value="2"></td>
      <td width="9%">N
        <input type="radio" name="Q46" value="3"></td>
      <td width="9%">A
        <input type="radio" name="Q46" value="4"></td>
      <td width="9%">SA
        <input type="radio" name="Q46" value="5"></td>
    </tr>
    <tr>
      <td>47. I find concept maps a useful tool for learning science.</td>
      <td>SD
        <input type="radio" name="Q47" value="1">
      </td>
      <td>D
        <input type="radio" name="Q47" value="2"></td>
      <td>N
        <input type="radio" name="Q47" value="3"></td>
      <td>A
        <input type="radio" name="Q47" value="4"></td>
      <td>SA
        <input type="radio" name="Q47" value="5"></td>
    </tr>
    <tr>
      <td>48. I like using concept maps in the science class.</td>
      <td>SD
        <input type="radio" name="Q48" value="1"></td>
      <td>D
        <input type="radio" name="Q48" value="2"></td>
      <td>N
        <input type="radio" name="Q48" value="3"></td>
      <td>A
        <input type="radio" name="Q48" value="4"></td>
      <td>SA
        <input type="radio" name="Q48" value="5"></td>
    </tr>
    <tr>
      <td>49. I feel that concept maps help me to understand the relationships 
        among the science concepts.</td>
      <td>SD
        <input type="radio" name="Q49" value="1"></td>
      <td>D
        <input type="radio" name="Q49" value="2"></td>
      <td>N
        <input type="radio" name="Q49" value="3"></td>
      <td>A
        <input type="radio" name="Q49" value="4"></td>
      <td>SA
        <input type="radio" name="Q49" value="5"></td>
    </tr>
    <tr>
      <td height="23">50. Concept mapping is a good organization tool to be used 
        while learning science.</td>
      <td>SD
        <input type="radio" name="Q50" value="1"></td>
      <td>D
        <input type="radio" name="Q50" value="2"></td>
      <td>N
        <input type="radio" name="Q50" value="3"></td>
      <td>A
        <input type="radio" name="Q50" value="4"></td>
      <td>SA
        <input type="radio" name="Q50" value="5"></td>
    </tr>
  </table>
  <p align="left">&nbsp;</p>
  <p></p>
  </p>
  <div align="center">
    <input name="Submit2" type="submit" id="Submit2" value="Submit">
    <input name="reset2" type="reset" id="reset2" value="Reset">
  </div>
  <p>&nbsp; </p>
</form>
<p align="left">&nbsp; </p>
</body>
</html>
