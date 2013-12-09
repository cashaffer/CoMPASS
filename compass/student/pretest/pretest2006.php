<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
<meta http-equiv=Content-Type content="text/html; charset=UTF-8">
<title>PHYSICS FIESTA</title>
</head>
<script Language="Javascript" Type="text/Javascript" >
<!--
var onecount; 
onecount=0; 
     
subcat = new Array(); 
subcat[0] = new Array("Mary Wysocki","1","Mary Wysocki"); 
subcat[1] = new Array("Steven Kahl","2","Steven Kahl"); 
subcat[2] = new Array("Alan Kinnaman","3","Alan Kinnaman"); 
subcat[3] = new Array("Lynn Francour","4","Lynn Francour"); 
subcat[4] = new Array("Kelly Francour","4","Kelly Francour"); 
subcat[5] = new Array("Jill Ahles","5","Jill Ahles"); 

onecount=6; 

function schoolChanged()
{ 
	school=document.form1.school.value;
	var ta=document.getElementById('teacherarea');
	if(school !=0)
		ta.style.visibility='';
	else
		ta.style.visibility='hidden';
	
	document.form1.Teacher.length = 0;  

    var locationid=school; 
    var i; 
    for (i=0;i <  onecount; i++) 
        { 
            if (subcat[i][1] == locationid) 
            {  
            document.form1.Teacher.options[document.form1.Teacher.length] = new Option(subcat[i][0], subcat[i][2]); 
            }         
        } 
}

function form1_validate(form1)
{
	if (form1.Name.value=="")                                     
	{
       alert("Enter  your name please");
	form1.Name.focus();
	return(false);
        }
	if (form1.Teacher.value=="")                                     
	{
       alert("Choose the school and the teacher");
	form1.school.focus();
	return(false);
        }
	
	if (form1.Class.value=="")                                     
	{
       alert("Enter your class name please");
	form1.Class.focus();
	return(false);
        }

	var radioselected=false;                           
	for(i=0;i<form1.Gender.length;i++)
	{
		if(form1.Gender[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("Gender needed");
		form1.Gender[0].focus();
		return (false);
	}		

	radioselected=false;                            
	for(i=0;i<form1.Q1.length;i++)
	{
		if(form1.Q1[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("enter your choice for Question 1");
		form1.Q1[0].focus();
		return (false);
	}		
	
	radioselected=false;                            
	for(i=0;i<form1.Q2a.length;i++)
	{
		if(form1.Q2a[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 2a");
		form1.Q2a[0].focus();
		return (false);
	}		
	
	if (form1.Q2b.value=="")                                     
	{
       alert("enter  a value for Question 2b");
	form1.Q2b.focus();
	return(false);
        }
	
	radioselected=false;                            
	for(i=0;i<form1.Q3a.length;i++)
	{
		if(form1.Q3a[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 3a");
		form1.Q3a[0].focus();
		return (false);
	}	
	if (form1.Q3b.value=="")                                     
	{
       alert("enter a value for Question 3b");
	form1.Q3b.focus();
	return(false);
        }	

	
	radioselected=false;                           
	for(i=0;i<form1.Q4.length;i++)
	{
		if(form1.Q4[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 4");
		form1.Q4[0].focus();
		return (false);
	}

	radioselected=false;                            
	for(i=0;i<form1.Q5.length;i++)
	{
		if(form1.Q5[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 5");
		form1.Q5[0].focus();
		return (false);
	}	
	
	if (form1.Q6.value=="")                                     
	{
       alert("enter a value for Question 6");
		form1.Q6.focus();
		return(false);
    }

	radioselected=false;                            
	for(i=0;i<form1.Q7.length;i++)
	{
		if(form1.Q7[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 7");
		form1.Q7[0].focus();
		return (false);
	}
	
	radioselected=false;                            
	for(i=0;i<form1.Q8.length;i++)
	{
		if(form1.Q8[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 8");
		form1.Q8[0].focus();
		return (false);
	}
	
	radioselected=false;                           
	for(i=0;i<form1.Q9a.length;i++)
	{
		if(form1.Q9a[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 9");
		form1.Q9a[0].focus();
		return (false);
	}	

	if (form1.Q9b.value=="")                                     
	{
       alert("enter a value for Question 3b");
	form1.Q9b.focus();
	return(false);
        }	

	radioselected=false;                            
	for(i=0;i<form1.Q10.length;i++)
	{
		if(form1.Q10[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 10");
		form1.Q10[0].focus();
		return (false);
	}	
	
	radioselected=false;                            
	for(i=0;i<form1.Q11a.length;i++)
	{
		if(form1.Q11a[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 11a");
		form1.Q11a[0].focus();
		return (false);
	}	
	if (form1.Q11b.value=="")                                     
	{
       alert("enter a value for Question 11b");
		form1.Q11b.focus();
		return(false);
    }

	radioselected=false;                            
	for(i=0;i<form1.Q12.length;i++)
	{
		if(form1.Q12[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 12");
		form1.Q12[0].focus();
		return (false);
	}	
	
	var radioselected=false;                            
	for(i=0;i<form1.Q13a.length;i++)
	{
		if(form1.Q13a[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 13a");
		form1.Q13a[0].focus();
		return (false);
	}	
	if (form1.Q13b.value=="")                                     
	{
       alert("enter a value for Question 13b");
		form1.Q13b.focus();
		return(false);
    }

	radioselected=false;                            
	for(i=0;i<form1.Q14.length;i++)
	{
		if(form1.Q14[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 14");
		form1.Q14[0].focus();
		return (false);
	}	

	radioselected=false;                            
	for(i=0;i<form1.Q15.length;i++)
	{
		if(form1.Q15[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 15");
		form1.Q15[0].focus();
		return (false);
	}	

	return(true);
}
//--></script>

<body lang=EN-US style='tab-interval:.5in'>

<div class=Section1> 
  <h2 align="center">PHYSICS FIESTA</h2>
  <p style='text-align:justify'>&nbsp;</p>
  <form name="form1" action="saveanswer2006.php" method="post"  onSubmit="return form1_validate(this);">
    <p style='text-align:justify'>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td width="257" height="37"><strong>Name:</strong> <input type="TEXT" name="Name"> 
        </td>
        <td colspan="2"><strong>Gender: Female 
          <INPUT TYPE="radio" NAME="Gender" VALUE="1">
          &nbsp;&nbsp;Male </strong><strong> 
          <INPUT TYPE="radio" NAME="Gender" VALUE="2">
          </strong></td>
      </tr>
      <tr> 
        <td><strong>School: <span
style='font-weight:normal'> 
          <SELECT NAME="school" onChange="schoolChanged();">
            <option value="0" selected>Please Choose One...</option>
            <option value="1">Colby Middle</option>
            <option value="2">Deforest Area Middle</option>
            <option value="3">Indian Mound Middle</option>
            <option value="4">Marinette Middle</option>
            <option value="5">Seton Catholic Middle</option>
          </SELECT>
          </span></strong></td>
        <td width="250"><strong><span id="teacherarea" style="visibility: hidden">Teacher: 
          <SELECT NAME="Teacher">
          </SELECT>
          </span></strong></td>
        <td width="381"><strong>Class: 
          <input name="Class" type="text" size="10">
          </strong> </td>
      </tr>
    </table>
    <strong>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<span
style='font-weight:normal'>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span> 
    <div></div>
    </strong> 
    <p style='text-align:justify'><font face="Arial, Helvetica, sans-serif">1. 
      Answer the questions by selecting the option that you think is the most 
      appropriate. </font></p>
    <p><font face="Arial, Helvetica, sans-serif">2. Some questions require you 
      to type your answer in the space provided. Click in the text box to start 
      writing.</font></p>
    <p><font face="Arial, Helvetica, sans-serif">3. When you finish with all questions 
      click the Submit button. </font></p>
    <p><font face="Arial, Helvetica, sans-serif">4. If you want to clear <i>all</i> the 
      answers that you provided and start again click on the Reset button. </font></p>
    <p><font face="Arial, Helvetica, sans-serif">5. You must answer <i>all</i> 
      the questions before you click the SUBMIT button. </font></p>
    <p>&nbsp;</p>
    <p style='text-align:justify'>1. When you bend your arm at the elbow, the bone 
      and muscles in your arm are acting as a system. What simple machine does 
      this system represent?</p>

    <p> 
      <INPUT TYPE="radio" NAME="Q1" VALUE="1">
      Inclined plane <br>
      <INPUT TYPE="radio" NAME="Q1" VALUE="2">
      Lever<br>
      <INPUT TYPE="radio" NAME="Q1" VALUE="3">
      Wedge <br>
      <INPUT TYPE="radio" NAME="Q1" VALUE="4">
      Pulley </p>

<span style='font-size:12.0pt;font-family:"Times New Roman";mso-fareast-font-family:
"Times New Roman";mso-ansi-language:EN-US;mso-fareast-language:EN-US;
mso-bidi-language:AR-SA'><br clear=all style='page-break-before:always'>
</span>

<p style='text-align:justify'>2a. Blocks A and B are shown below.</p>

    <p style='text-align:justify'><img src="images/image003.gif" width="322" height="94"></p>

<p style='text-align:justify'>Which of the blocks is heavier?</p>

<p><INPUT TYPE="radio" NAME="Q2a" VALUE="1">A <br>
<INPUT TYPE="radio" NAME="Q2a" VALUE="2">B <br>
<INPUT TYPE="radio" NAME="Q2a" VALUE="3">A and B are equally heavy<br>
<INPUT TYPE="radio" NAME="Q2a" VALUE="4">Not enough information</p>

<p style='text-align:justify'>2b. Explain your reasoning.</p>

<p style='text-align:justify'><TEXTAREA ROWS="10" COLS="60"  NAME="Q2b"></TEXTAREA></p>

<span style='font-size:12.0pt;font-family:"Times New Roman";mso-fareast-font-family:
"Times New Roman";mso-ansi-language:EN-US;mso-fareast-language:EN-US;
mso-bidi-language:AR-SA'><br clear=all style='mso-special-character:line-break;
page-break-before:always'>
    </span> 
    <p style='text-align:justify'><o:p>&nbsp;</o:p>3a. A girl wants to play on 
      a seesaw with her little brother. Which picture shows the best way for the 
      heavier girl to balance her lighter brother? Choose the letter of the picture.</p>

<p style='text-align:justify'> <img src="images/image004.gif"></p>

<p style='text-align:justify'><INPUT TYPE="radio" NAME="Q3a" VALUE="1">A <br>
<INPUT TYPE="radio" NAME="Q3a" VALUE="2">B <br>
<INPUT TYPE="radio" NAME="Q3a" VALUE="3">C <br>
<INPUT TYPE="radio" NAME="Q3a" VALUE="4">D </p>

    <p style='text-align:justify'>3b. Explain your reasoning.</p>

<p style='text-align:justify'><TEXTAREA ROWS="10" COLS="60"  NAME="Q3b"></TEXTAREA></p>

    <p style='text-align:justify; margin-bottom: 0in;'><o:p>&nbsp;</o:p></p>
    <p style='text-align:justify; margin-bottom: 0in;'>4. A student pulls three 
      different objects horizontally across a table using a spring scale that 
      measures force. The data are shown below. On which one of them must she 
      do the most work?</p>

    <table class=MsoNormalTable border=1 cellpadding=0 width="92%"
 style='width:92.9%;mso-cellspacing:1.5pt;margin-left:21.0pt;border:outset 1.5pt'>
 <tr style='mso-yfti-irow:0'>
  <td width="18%" style='width:18.48%;padding:.75pt .75pt .75pt .75pt'>
  <p class=MsoNormal style='text-align:justify'><b>Object<o:p></o:p></b></p>
  </td>
  <td width="34%" style='width:34.8%;padding:.75pt .75pt .75pt .75pt'>
  <p class=MsoNormal style='text-align:justify'><b>Spring Scale </b><st1:City><st1:place><b>Reading</b></st1:place></st1:City><b>
  (N)<o:p></o:p></b></p>
  </td>
  <td width="45%" style='width:45.32%;padding:.75pt .75pt .75pt .75pt'>
  <p class=MsoNormal style='text-align:justify'><b>Distance the object was
  pulled(m)<o:p></o:p></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width="18%" style='width:18.48%;padding:.75pt .75pt .75pt .75pt'>
  <p class=MsoNormal style='text-align:justify'><b>A<o:p></o:p></b></p>
  </td>
  <td width="34%" style='width:34.8%;padding:.75pt .75pt .75pt .75pt'>
  <p class=MsoNormal style='text-align:justify'>6.0</p>
  </td>
  <td width="45%" style='width:45.32%;padding:.75pt .75pt .75pt .75pt'>
  <p class=MsoNormal style='text-align:justify'>10</p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2'>
  <td width="18%" style='width:18.48%;padding:.75pt .75pt .75pt .75pt'>
  <p class=MsoNormal style='text-align:justify'><b>B<o:p></o:p></b></p>
  </td>
  <td width="34%" style='width:34.8%;padding:.75pt .75pt .75pt .75pt'>
  <p class=MsoNormal style='text-align:justify'>3.0</p>
  </td>
  <td width="45%" style='width:45.32%;padding:.75pt .75pt .75pt .75pt'>
  <p class=MsoNormal style='text-align:justify'>20</p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3;mso-yfti-lastrow:yes'>
  <td width="18%" style='width:18.48%;padding:.75pt .75pt .75pt .75pt'>
  <p class=MsoNormal style='text-align:justify'><b>C<o:p></o:p></b></p>
  </td>
  <td width="34%" style='width:34.8%;padding:.75pt .75pt .75pt .75pt'>
  <p class=MsoNormal style='text-align:justify'>12.0</p>
  </td>
  <td width="45%" style='width:45.32%;padding:.75pt .75pt .75pt .75pt'>
  <p class=MsoNormal style='text-align:justify'>5</p>
  </td>
 </tr>
</table>

<p style='margin-left:.25in'><INPUT TYPE="radio" NAME="Q4" VALUE="1">A <br>
<INPUT TYPE="radio" NAME="Q4" VALUE="2">B <br>
<INPUT TYPE="radio" NAME="Q4" VALUE="3">C <br>
<INPUT TYPE="radio" NAME="Q4" VALUE="4">All the same<br>
<INPUT TYPE="radio" NAME="Q4" VALUE="5">Not enough information </p>

<span style='font-size:12.0pt;font-family:"Times New Roman";mso-fareast-font-family:
"Times New Roman";mso-ansi-language:EN-US;mso-fareast-language:EN-US;
mso-bidi-language:AR-SA'><br clear=all style='mso-special-character:line-break;
page-break-before:always'>
</span>

<p style='margin-left:.25in;text-align:justify;text-indent:-.25in'><o:p>&nbsp;</o:p></p>

    <p style='margin-left:.25in;text-align:justify;text-indent:-.25in'>5. Which 
      of the following machines changes neither force nor distance?</p>

    <p> 
      <INPUT TYPE="radio" NAME="Q5" VALUE="1">
      Inclined plane <br>
      <INPUT TYPE="radio" NAME="Q5" VALUE="2">
      Fixed pulley<br>
      <INPUT TYPE="radio" NAME="Q5" VALUE="3">
      Movable pulley <br>
      <INPUT TYPE="radio" NAME="Q5" VALUE="4">
      Wheel and axle</p>

<p style='text-align:justify'><o:p>&nbsp;</o:p></p>

    <p style='text-align:justify'>6. What type of a simple machine is the blade of 
      a knife? Explain how it works.</p>

<p style='text-align:justify'><TEXTAREA ROWS="10" COLS="60"  NAME="Q6"></TEXTAREA></p>

<span style='font-size:12.0pt;font-family:"Times New Roman";mso-fareast-font-family:
"Times New Roman";mso-ansi-language:EN-US;mso-fareast-language:EN-US;
mso-bidi-language:AR-SA'><br clear=all style='mso-special-character:line-break;
page-break-before:always'>
</span>

    <p style='text-align:justify'><o:p>&nbsp;7</o:p>. Which screw requires the 
      least effort to turn?</p>

<p><INPUT TYPE="radio" NAME="Q7" VALUE="1">A wide screw whose threads are
close together<br>
<INPUT TYPE="radio" NAME="Q7" VALUE="2">A narrow screw whose threads are close
together<br>
<INPUT TYPE="radio" NAME="Q7" VALUE="3">A wide screw whose threads are far
apart<br>
<INPUT TYPE="radio" NAME="Q7" VALUE="4">A narrow screw whose threads are far
apart</p>

<p style='text-align:justify'><o:p>&nbsp;</o:p></p>

    <p style='text-align:justify'>8. The amount of work done on an object is found 
      by ...</p>

    <p> 
      <INPUT TYPE="radio" NAME="Q8" VALUE="1">
      multiplying the load and the effort force<br>
      <INPUT TYPE="radio" NAME="Q8" VALUE="2">
      dividing the load by the effort force<br>
      <INPUT TYPE="radio" NAME="Q8" VALUE="3">
      multiplying the effort force and the distance<br>
      <INPUT TYPE="radio" NAME="Q8" VALUE="4">
      dividing the effort force by the distance</p>

    <p style='margin-left:.25in;text-indent:-.25in'>&nbsp;</p>
    <p style='margin-left:.25in;text-indent:-.25in'>9a. If my parents were moving 
      to a new house, I would tell them to get a _________ ramp to get our furniture 
      into the moving truck</p>
    <p> 
      <INPUT TYPE="radio" NAME="Q9a" VALUE="1">
      Short and bumpy<br>
      <INPUT TYPE="radio" NAME="Q9a" VALUE="2">
      Short and smooth<br>
      <INPUT TYPE="radio" NAME="Q9a" VALUE="3">
      Long and bumpy<br>
      <INPUT TYPE="radio" NAME="Q9a" VALUE="4">
      Long and smooth</p>

    <p style='margin-left:.25in;text-indent:-.25in'>9b. Explain your reasoning.</p>
    <p style='text-align:justify'>
      <TEXTAREA ROWS="10" COLS="60"  NAME="Q9b"></TEXTAREA>
    </p>

    <p style='margin-left:.25in;text-indent:-.25in'>&nbsp;</p>
    <p style='margin-left:.25in;text-indent:-.25in'>10. When you turn a screw 
      into a piece of wood, the wood provides the ...</p>

<p><INPUT TYPE="radio" NAME="Q10" VALUE="1">effort <br>
<INPUT TYPE="radio" NAME="Q10" VALUE="2">work <br>
<INPUT TYPE="radio" NAME="Q10" VALUE="3">power <br>
<INPUT TYPE="radio" NAME="Q10" VALUE="4">load</p>

    <p style='text-align:justify'><o:p>&nbsp;</o:p><span style='font-size:12.0pt;font-family:"Times New Roman";mso-fareast-font-family:
"Times New Roman";mso-ansi-language:EN-US;mso-fareast-language:EN-US;
mso-bidi-language:AR-SA'> </span> </p>

    <p style='text-align:justify'>11a. Which of the following pulley setups requires 
      the least effort to lift a load?<br>
    </p>

    <table border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td><img src="images/Q13A-Fig2.jpg" width="289" height="205"></td>
        <td><img src="images/Q13A-Fig1.jpg" width="289" height="205"></td>
      </tr>
      <tr> 
        <td><div align="center"><strong>(A)</strong></div></td>
        <td><div align="center"><strong>(B)</strong></div></td>
      </tr>
    </table>
    <p><INPUT TYPE="radio" NAME="Q11a" VALUE="1">A <br>
<INPUT TYPE="radio" NAME="Q11a" VALUE="2">B <br>
<INPUT TYPE="radio" NAME="Q11a" VALUE="3">A and B require equal force. <br>
<INPUT TYPE="radio" NAME="Q11a" VALUE="4">Not enough information</p>

<p style='text-align:justify'><o:p>&nbsp;</o:p></p>

    <p style='text-align:justify'>11b. Explain your reasoning.</p>

<p style='text-align:justify'><TEXTAREA ROWS="10" COLS="60"  NAME="Q11b"></TEXTAREA></p>

    <p style='text-align:justify'><o:p>&nbsp;</o:p><span style='font-size:12.0pt;font-family:"Times New Roman";mso-fareast-font-family:
"Times New Roman";mso-ansi-language:EN-US;mso-fareast-language:EN-US;
mso-bidi-language:AR-SA'><br clear=all style='page-break-before:always'>
      </span> </p>

<p style='text-align:justify'>12. You can increase the mechanical advantage 
      of a wheel and axle by ...</p>

    <p> 
      <INPUT TYPE="radio" NAME="Q12" VALUE="1">
      decreasing the size of the wheel<br>
      <INPUT TYPE="radio" NAME="Q12" VALUE="2">
      increasing the size of the axle <br>
      <INPUT TYPE="radio" NAME="Q12" VALUE="3">
      increasing the size of the wheel<br>
      <INPUT TYPE="radio" NAME="Q12" VALUE="4">
      increasing both the size of the wheel and the axle </p>

<p><o:p>&nbsp;</o:p></p>

    <p style='text-align:justify'>13a. In which situation would it take less effort 
      to roll the same ball up to the top of the ramp?</p>

    <p style='text-align:justify'>&nbsp;</p>
    <table border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td width="556"><img src="images/image008.gif"></td>
      </tr>
    </table>
    <p><INPUT TYPE="radio" NAME="Q13a" VALUE="1">A <br>
<INPUT TYPE="radio" NAME="Q13a" VALUE="2">B <br>
<INPUT TYPE="radio" NAME="Q13a" VALUE="3">A and B require equal effort<br>
<INPUT TYPE="radio" NAME="Q13a" VALUE="4">Not enough information</p>

    <p>&nbsp;</p>
    <p style='text-align:justify'><o:p>&nbsp;</o:p></p>
    <p style='text-align:justify'>13b. Explain your reasoning.</p>
    <p style='text-align:justify'>
      <TEXTAREA ROWS="10" COLS="60"  NAME="Q13b"></TEXTAREA>
    </p>
    <p><span style='font-size:12.0pt;font-family:"Times New Roman";mso-fareast-font-family:
"Times New Roman";mso-ansi-language:EN-US;mso-fareast-language:EN-US;
mso-bidi-language:AR-SA'><br clear=all style='page-break-before:always'>
      </span> </p>
    <p>14. The mechanical advantage of a pulley system can be increased by ...</p>

<p><INPUT TYPE="radio" NAME="Q14" VALUE="1">applying an effort force over a
shorter distance<br>
<INPUT TYPE="radio" NAME="Q14" VALUE="2">increasing the effort force<br>
<INPUT TYPE="radio" NAME="Q14" VALUE="3">increasing the number of pulleys<br>
<INPUT TYPE="radio" NAME="Q14" VALUE="4">increasing the amount of rope</p>

<p><o:p>&nbsp;</o:p></p>

    <p>15. In which situation would it take less effort to lift the same block 
      using a wheel and axle?</p>

    <p><img src="images/image010.gif"></p>

<p><INPUT TYPE="radio" NAME="Q15" VALUE="1">A <br>
<INPUT TYPE="radio" NAME="Q15" VALUE="2">B <br>
<INPUT TYPE="radio" NAME="Q15" VALUE="3">A and B require equal effort<br>
<INPUT TYPE="radio" NAME="Q15" VALUE="4">Not enough information</p>

<p><o:p>&nbsp;</o:p></p>

    <p align="center"><o:p>&nbsp; 
      <input type="submit" name="Submit" value="Submit">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
      <input type="reset" name="Submit2" value="Reset">
      </o:p></p>

    </form>

</div>

</body>

</html>
