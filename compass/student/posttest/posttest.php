<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
<meta http-equiv=Content-Type content="text/html; charset=UTF-8">
<title>PHYSICS FIESTA</title>
</head>
<script Language="Javascript" Type="text/Javascript" >
<!--
function form1_validate(form1)
{
	if (form1.Name.value=="")                                     
	{
       alert("Enter  your name please");
	form1.Name.focus();
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
	for(i=0;i<form1.Q4a.length;i++)
	{
		if(form1.Q4a[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 4a");
		form1.Q4a[0].focus();
		return (false);
	}		
	
	if (form1.Q4b.value=="")                                     
	{
       alert("enter  a value for Question 4b");
		form1.Q4b.focus();
		return(false);
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

	radioselected=false;                            
	for(i=0;i<form1.Q6.length;i++)
	{
		if(form1.Q6[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 6");
		form1.Q6[0].focus();
		return (false);
	}	
	
	if (form1.Q7.value=="")                                     
	{
       alert("enter a value for Question 7");
		form1.Q7.focus();
		return(false);
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
	for(i=0;i<form1.Q9.length;i++)
	{
		if(form1.Q9[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 9");
		form1.Q9[0].focus();
		return (false);
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
	for(i=0;i<form1.Q11.length;i++)
	{
		if(form1.Q11[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 11");
		form1.Q11[0].focus();
		return (false);
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
	
	radioselected=false;                            
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
	
	var radioselected=false;                            
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

	radioselected=false;                            
	for(i=0;i<form1.Q16.length;i++)
	{
		if(form1.Q16[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 16");
		form1.Q16[0].focus();
		return (false);
	}	

	radioselected=false;                            
	for(i=0;i<form1.Q17.length;i++)
	{
		if(form1.Q17[i].checked)
		radioselected=true;
	}
	if(!radioselected)
	{
		alert("enter your choice for Question 17");
		form1.Q17[0].focus();
		return (false);
	}	

	return(true);
}
//--></script>

<body lang=EN-US style='tab-interval:.5in'>

<div class=Section1> 
  <h2 align="center">PHYSICS FIESTA (Revised 08-05-2005) </h2>
  <p style='text-align:justify'><font face="Arial, Helvetica, sans-serif">1. Type 
    your name in the box below. Click in the textbox to start writing. Select 
    gender by clicking in the circle next to the option.</font></p>
  <p><font face="Arial, Helvetica, sans-serif">2. Answer the questions by selecting 
    the option that you think is the most appropriate. Some questions require 
    you to type your answer in the textbox. Click in the textbox to start writing.</font></p>
  <p><font face="Arial, Helvetica, sans-serif">3. When you finish with all questions 
    click the Submit button. If you want to clear all the answers that you provided 
    and start again click on the Reset button.</font></p>
  <p><font face="Arial, Helvetica, sans-serif">Note: You MUST answer all the questions 
    before you click the submit button.</font></p>
  <div align="center"><strong>GOOD LUCK!!! </strong></div>
  <p align=center style='text-align:center'>&nbsp;</p>
  <p align=center style='text-align:center'>&nbsp;</p>

<form action="saveanswer.php" method="post"  onSubmit="return form1_validate(this);">
    <p style='text-align:justify'><strong>Name: 
      <INPUT TYPE="TEXT" NAME="Name">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;Class: 
      <SELECT NAME="Class">
        <option value="Class 1">Class 1 </option>
        <option value="Class 2">Class 2 </option>
        <option value="Class 3">Class 3 </option>
        <option value="Class 4">Class 4 </option>
        <option value="Class 5">Class 5 </option>
      </SELECT>
      </strong></p>
    <p style='text-align:justify'><strong>Teacher: </strong><strong><span
style='font-weight:normal'> 
      <SELECT NAME="Teacher">
        <OPTION SELECTED VALUE="Mrs. Gnesdilow">Mrs. Gnesdilow 
        <OPTION VALUE="Mrs. Mehalakes">Mrs. Mehalakes 
      </SELECT>
      </span>&nbsp; &nbsp; Gender: Female 
      <INPUT TYPE="radio" NAME="Gender" VALUE="1">
      &nbsp;&nbsp;Male </strong><strong><span style='font-weight:normal'> 
      <INPUT TYPE="radio" NAME="Gender" VALUE="2">
      </span></strong></p>
    <p style='text-align:justify'>&nbsp;</p>
    <p style='text-align:justify'>&nbsp;</p>

<p style='text-align:justify'>1. When you bend your arm at the elbow, the 
      bone and muscles in your arm are acting as a system. What simple machine 
      does this system represent?</p>

<p><INPUT TYPE="radio" NAME="Q1" VALUE="1">Inclined plane <br>
<INPUT TYPE="radio" NAME="Q1" VALUE="2">Pulley <br>
<INPUT TYPE="radio" NAME="Q1" VALUE="3">Wedge <br>
<INPUT TYPE="radio" NAME="Q1" VALUE="4">Lever </p>

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

<p style='text-align:justify'><TEXTAREA ROWS="10" COLS="111"  NAME="Q2b"></TEXTAREA></p>

<span style='font-size:12.0pt;font-family:"Times New Roman";mso-fareast-font-family:
"Times New Roman";mso-ansi-language:EN-US;mso-fareast-language:EN-US;
mso-bidi-language:AR-SA'><br clear=all style='mso-special-character:line-break;
page-break-before:always'>
</span>

<p style='text-align:justify'><o:p>&nbsp;</o:p></p>

<p style='text-align:justify'>3a. Machine A and Machine B are each designed to
clear a field. The table shows us how large an area each is cleared 1 hour and
how much gasoline each used. </p>

<table class=MsoNormalTable border=1 cellpadding=0 width="95%"
 style='width:95.54%;mso-cellspacing:1.5pt;border:outset 1.5pt'>
 <tr style='mso-yfti-irow:0;height:23.85pt'>
  <td style='padding:.75pt .75pt .75pt .75pt;height:23.85pt'>
  <p class=MsoNormal style='text-align:justify'><o:p>&nbsp;</o:p></p>
  </td>
  <td style='padding:.75pt .75pt .75pt .75pt;height:23.85pt'>
  <p class=MsoNormal style='text-align:justify'><b>Area of field cleared in 1
  hour<o:p></o:p></b></p>
  </td>
  <td style='padding:.75pt .75pt .75pt .75pt;height:23.85pt'>
  <p class=MsoNormal style='text-align:justify'><b>Gasoline used in 1 hour<o:p></o:p></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1;height:27.25pt'>
  <td style='padding:.75pt .75pt .75pt .75pt;height:27.25pt'>
  <p class=MsoNormal style='text-align:justify'><b>Machine A<o:p></o:p></b></p>
  </td>
  <td style='padding:.75pt .75pt .75pt .75pt;height:27.25pt'>
  <p class=MsoNormal style='text-align:justify'>2 acres</p>
  </td>
  <td style='padding:.75pt .75pt .75pt .75pt;height:27.25pt'>
  <p class=MsoNormal style='text-align:justify'>3 gallons</p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2;mso-yfti-lastrow:yes;height:13.25pt'>
  <td style='padding:.75pt .75pt .75pt .75pt;height:13.25pt'>
  <p class=MsoNormal style='text-align:justify'><b>Machine B<o:p></o:p></b></p>
  </td>
  <td style='padding:.75pt .75pt .75pt .75pt;height:13.25pt'>
  <p class=MsoNormal style='text-align:justify'>3 acres</p>
  </td>
  <td style='padding:.75pt .75pt .75pt .75pt;height:13.25pt'>
  <p class=MsoNormal style='text-align:justify'>2 gallons</p>
  </td>
 </tr>
</table>

<p style='text-align:justify'>Which machine is more efficient in converting the
energy in gasoline to work? </p>

<p><INPUT TYPE="radio" NAME="Q3a" VALUE="1">Machine A <br>
<INPUT TYPE="radio" NAME="Q3a" VALUE="2">Machine B <br>
<INPUT TYPE="radio" NAME="Q3a" VALUE="3">Machine A and B are equally efficient<br>
<INPUT TYPE="radio" NAME="Q3a" VALUE="4">Not enough information</p>

<p style='text-align:justify'>3b. Explain your reasoning.</p>

<p style='text-align:justify'><TEXTAREA ROWS="10" COLS="111"  NAME="Q3b"></TEXTAREA></p>

<span style='font-size:12.0pt;font-family:"Times New Roman";mso-fareast-font-family:
"Times New Roman";mso-ansi-language:EN-US;mso-fareast-language:EN-US;
mso-bidi-language:AR-SA'><br clear=all style='mso-special-character:line-break;
page-break-before:always'>
</span>

<p style='text-align:justify'><o:p>&nbsp;</o:p></p>

<p style='text-align:justify'>4a. A girl wants to play on a seesaw with her
little brother. Which picture shows the best way for the heavier girl to
balance her lighter brother? Choose the letter of the picture.</p>

    <p style='text-align:justify'> <img src="images/image004.gif"></p>

<p style='text-align:justify'><INPUT TYPE="radio" NAME="Q4a" VALUE="1">A <br>
<INPUT TYPE="radio" NAME="Q4a" VALUE="2">B <br>
<INPUT TYPE="radio" NAME="Q4a" VALUE="3">C <br>
<INPUT TYPE="radio" NAME="Q4a" VALUE="4">D </p>

<p style='text-align:justify'>4b. Explain your reasoning.</p>

<p style='text-align:justify'><TEXTAREA ROWS="10" COLS="108"  NAME="Q4b"></TEXTAREA></p>

<p style='text-align:justify'><o:p>&nbsp;</o:p></p>

    <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-align:justify;text-indent:-.25in'>5. A student pulls 
      three different objects horizontally across a table using a spring scale 
      that measures force. The data are shown below. On which one of them must 
      she do the most work?</p>

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

<p style='margin-left:.25in'><INPUT TYPE="radio" NAME="Q5" VALUE="1">A <br>
<INPUT TYPE="radio" NAME="Q5" VALUE="2">B <br>
<INPUT TYPE="radio" NAME="Q5" VALUE="3">C <br>
<INPUT TYPE="radio" NAME="Q5" VALUE="4">All the same<br>
<INPUT TYPE="radio" NAME="Q5" VALUE="5">Not enough information </p>

<span style='font-size:12.0pt;font-family:"Times New Roman";mso-fareast-font-family:
"Times New Roman";mso-ansi-language:EN-US;mso-fareast-language:EN-US;
mso-bidi-language:AR-SA'><br clear=all style='mso-special-character:line-break;
page-break-before:always'>
</span>

<p style='margin-left:.25in;text-align:justify;text-indent:-.25in'><o:p>&nbsp;</o:p></p>

<p style='margin-left:.25in;text-align:justify;text-indent:-.25in'>6. Which of
the following machines changes neither the force nor the distance?</p>

<p><INPUT TYPE="radio" NAME="Q6" VALUE="1">Inclined Plane <br>
<INPUT TYPE="radio" NAME="Q6" VALUE="2">Wheel and axle <br>
<INPUT TYPE="radio" NAME="Q6" VALUE="3">Movable Pulley <br>
<INPUT TYPE="radio" NAME="Q6" VALUE="4">Fixed Pulley </p>

<p style='text-align:justify'><o:p>&nbsp;</o:p></p>

<p style='text-align:justify'>7. What type of a simple machine is the blade of
a knife? Explain how it works.</p>

<p style='text-align:justify'><TEXTAREA ROWS="10" COLS="116"  NAME="Q7"></TEXTAREA></p>

<span style='font-size:12.0pt;font-family:"Times New Roman";mso-fareast-font-family:
"Times New Roman";mso-ansi-language:EN-US;mso-fareast-language:EN-US;
mso-bidi-language:AR-SA'><br clear=all style='mso-special-character:line-break;
page-break-before:always'>
</span>

<p style='text-align:justify'><o:p>&nbsp;</o:p></p>

<p style='text-align:justify'>8. Which screw requires the least effort to turn?</p>

<p><INPUT TYPE="radio" NAME="Q8" VALUE="1">A wide screw whose threads are
close together<br>
<INPUT TYPE="radio" NAME="Q8" VALUE="2">A narrow screw whose threads are close
together<br>
<INPUT TYPE="radio" NAME="Q8" VALUE="3">A wide screw whose threads are far
apart<br>
<INPUT TYPE="radio" NAME="Q8" VALUE="4">A narrow screw whose threads are far
apart</p>

<p style='text-align:justify'><o:p>&nbsp;</o:p></p>

    <p style='text-align:justify'>9. The amount of work done on an object is found 
      by ...</p>

<p><INPUT TYPE="radio" NAME="Q9" VALUE="1">multiplying the load and the effort
acting on the object <br>
<INPUT TYPE="radio" NAME="Q9" VALUE="2">dividing the load by the effort acting
on the object <br>
<INPUT TYPE="radio" NAME="Q9" VALUE="3">multiplying the effort acting on the
object and the distance traveled by the object<br>
<INPUT TYPE="radio" NAME="Q9" VALUE="4">dividing the effort acting on the
object by the distance traveled by the object<br style='mso-special-character:
line-break'>
<![if !supportLineBreakNewLine]><br style='mso-special-character:line-break'>
<![endif]></p>

<p style='margin-left:.25in;text-indent:-.25in'>10. An example of a lever in
which the load is between the effort and the fulcrum (second class lever) is a ...</p>

<p><INPUT TYPE="radio" NAME="Q10" VALUE="1">seesaw <br>
<INPUT TYPE="radio" NAME="Q10" VALUE="2">bottle opener <br>
<INPUT TYPE="radio" NAME="Q10" VALUE="3">shovel <br>
<INPUT TYPE="radio" NAME="Q10" VALUE="4">fishing pole </p>

    <p style='text-align:justify'><o:p>&nbsp;</o:p><span style='font-size:12.0pt;font-family:"Times New Roman";mso-fareast-font-family:
"Times New Roman";mso-ansi-language:EN-US;mso-fareast-language:EN-US;
mso-bidi-language:AR-SA'><br clear=all style='page-break-before:always'>
      </span> </p>

<p style='text-align:justify'>11. Which ramp would require the least effort to 
      ride up?</p>

    <p style='text-align:justify'><img src="images/image005.gif" width="587" height="104"></p>

<p style='text-align:justify'><INPUT TYPE="radio" NAME="Q11" VALUE="1">X <br>
<INPUT TYPE="radio" NAME="Q11" VALUE="2">Y <br>
<INPUT TYPE="radio" NAME="Q11" VALUE="3">Z <br>
<INPUT TYPE="radio" NAME="Q11" VALUE="4">All are the same </p>

<p style='text-align:justify'><o:p>&nbsp;</o:p></p>

<p style='text-align:justify'><o:p>&nbsp;</o:p></p>

    <p style='text-align:justify'>12. When you turn a screw into a piece of wood, 
      the wood provides the ...</p>

<p><INPUT TYPE="radio" NAME="Q12" VALUE="1">effort <br>
<INPUT TYPE="radio" NAME="Q12" VALUE="2">work <br>
<INPUT TYPE="radio" NAME="Q12" VALUE="3">power <br>
<INPUT TYPE="radio" NAME="Q12" VALUE="4">load</p>

<p style='text-align:justify'><o:p>&nbsp;</o:p></p>

<span style='font-size:12.0pt;font-family:"Times New Roman";mso-fareast-font-family:
"Times New Roman";mso-ansi-language:EN-US;mso-fareast-language:EN-US;
mso-bidi-language:AR-SA'><br clear=all style='page-break-before:always'>
</span>

    <p style='text-align:justify'>13a. Which of the following pulley setups requires 
      the least effort to lift a load?</p>

    <p style='text-align:justify'>&nbsp;</p>
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
    <p><INPUT TYPE="radio" NAME="Q13a" VALUE="1">A <br>
<INPUT TYPE="radio" NAME="Q13a" VALUE="2">B <br>
<INPUT TYPE="radio" NAME="Q13a" VALUE="3">A and B require equal force. <br>
<INPUT TYPE="radio" NAME="Q13a" VALUE="4">Not enough information</p>

<p style='text-align:justify'><o:p>&nbsp;</o:p></p>

    <p style='text-align:justify'>13b. Explain your reasoning.</p>

<p style='text-align:justify'><TEXTAREA ROWS="10" COLS="108"  NAME="Q13b"></TEXTAREA></p>

<p style='text-align:justify'><o:p>&nbsp;</o:p></p>

<span style='font-size:12.0pt;font-family:"Times New Roman";mso-fareast-font-family:
"Times New Roman";mso-ansi-language:EN-US;mso-fareast-language:EN-US;
mso-bidi-language:AR-SA'><br clear=all style='page-break-before:always'>
</span>

    <p style='text-align:justify'>14. You can increase the mechanical advantage of 
      a wheel and axle by ...</p>

<p><INPUT TYPE="radio" NAME="Q14" VALUE="1">increasing the size of the wheel <br>
<INPUT TYPE="radio" NAME="Q14" VALUE="2">increasing the size of the axle <br>
<INPUT TYPE="radio" NAME="Q14" VALUE="3">increasing both the size of the wheel
and the axle <br>
<INPUT TYPE="radio" NAME="Q14" VALUE="4">decreasing the size of the wheel</p>

<p><o:p>&nbsp;</o:p></p>

    <p style='text-align:justify'>15. In which situation would it take less effort to lift the same ball 
      up to the top of the ramp?</p>

    <p style='text-align:justify'>&nbsp;</p>
    <table border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td colspan="2"><img src="images/image008.gif"></td>
      </tr>
      <tr> 
        <td width="365" ><div align="center"><strong>(A)</strong></div></td>
        <td width="191" ><div align="center"><strong>(B)</strong></div></td>
      </tr>
    </table>
    <p><INPUT TYPE="radio" NAME="Q15" VALUE="1">A <br>
<INPUT TYPE="radio" NAME="Q15" VALUE="2">B <br>
<INPUT TYPE="radio" NAME="Q15" VALUE="3">A and B require equal effort<br>
<INPUT TYPE="radio" NAME="Q15" VALUE="4">Not enough information</p>

<span style='font-size:12.0pt;font-family:"Times New Roman";mso-fareast-font-family:
"Times New Roman";mso-ansi-language:EN-US;mso-fareast-language:EN-US;
mso-bidi-language:AR-SA'><br clear=all style='page-break-before:always'>
</span>

    <p>16. The mechanical advantage of a pulley system can be increased by ...</p>

<p><INPUT TYPE="radio" NAME="Q16" VALUE="1">exerting an effort force over a
shorter distance<br>
<INPUT TYPE="radio" NAME="Q16" VALUE="2">increasing the effort <br>
<INPUT TYPE="radio" NAME="Q16" VALUE="3">increasing the number of pulleys<br>
<INPUT TYPE="radio" NAME="Q16" VALUE="4">increasing the amount of rope</p>

<p><o:p>&nbsp;</o:p></p>

    <p>17. In which situation would it take less effort to lift the same block 
      using a wheel and axle?</p>

    <p><img src="images/image010.gif"></p>

<p><INPUT TYPE="radio" NAME="Q17" VALUE="1">A <br>
<INPUT TYPE="radio" NAME="Q17" VALUE="2">B <br>
<INPUT TYPE="radio" NAME="Q17" VALUE="3">A and B require equal effort<br>
<INPUT TYPE="radio" NAME="Q17" VALUE="4">Not enough information</p>

<p><o:p>&nbsp;</o:p></p>

    <p align="center"><o:p>&nbsp; 
      <input type="submit" name="Submit" value="Submit">
      &nbsp;&nbsp;&nbsp; 
      <input type="reset" name="Submit2" value="Reset">
      </o:p></p>

    </form>

</div>

</body>

</html>
