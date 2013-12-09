<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
<meta http-equiv=Content-Type content="text/html; charset=UTF-8">
<title>PHYSICS FIESTA</title>
<link href="../../css/compass.css" rel="stylesheet" type="text/css">
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
	for(i=0;i<form1.s1a.length;i++)
	{
		if(form1.s1a[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 1-a");
		form1.s1a[0].focus();
		return (false);
	}		
	
	radioselected=false;                            
	for(i=0;i<form1.s1b.length;i++)
	{
		if(form1.s1b[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 1-b");
		form1.s1b[0].focus();
		return (false);
	}		
	
	radioselected=false;                            
	for(i=0;i<form1.s1c.length;i++)
	{
		if(form1.s1c[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 1-c");
		form1.s1c[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s2a.length;i++)
	{
		if(form1.s2a[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 2-a");
		form1.s2a[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s2b.length;i++)
	{
		if(form1.s2b[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 2-b");
		form1.s2b[0].focus();
		return (false);
	}		

	radioselected=false;                            
	for(i=0;i<form1.s3a.length;i++)
	{
		if(form1.s3a[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 3-a");
		form1.s3a[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s3b.length;i++)
	{
		if(form1.s3b[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 3-b");
		form1.s3b[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s3c.length;i++)
	{
		if(form1.s3c[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 3-c");
		form1.s3c[0].focus();
		return (false);
	}		

	radioselected=false;                            
	for(i=0;i<form1.s3c.length;i++)
	{
		if(form1.s3c[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 3-c");
		form1.s3c[0].focus();
		return (false);
	}		

	radioselected=false;                            
	for(i=0;i<form1.s4a.length;i++)
	{
		if(form1.s4a[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 4-a");
		form1.s4a[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s4b.length;i++)
	{
		if(form1.s4b[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 4-b");
		form1.s4b[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s4c.length;i++)
	{
		if(form1.s4c[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 4-c");
		form1.s4c[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s4d.length;i++)
	{
		if(form1.s4d[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 4-d");
		form1.s4d[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s4e.length;i++)
	{
		if(form1.s4e[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 4-e");
		form1.s4e[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s5a.length;i++)
	{
		if(form1.s5a[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 5-a");
		form1.s5a[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s5b.length;i++)
	{
		if(form1.s5b[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 5-b");
		form1.s5b[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s5c.length;i++)
	{
		if(form1.s5c[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 5-c");
		form1.s5c[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s5d.length;i++)
	{
		if(form1.s5d[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 5-d");
		form1.s5d[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s6a.length;i++)
	{
		if(form1.s6a[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 6-a");
		form1.s6a[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s6b.length;i++)
	{
		if(form1.s6b[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 6-b");
		form1.s6b[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s6c.length;i++)
	{
		if(form1.s6c[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 6-c");
		form1.s6c[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s7a.length;i++)
	{
		if(form1.s7a[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 7-a");
		form1.s7a[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s7b.length;i++)
	{
		if(form1.s7b[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 7-b");
		form1.s7b[0].focus();
		return (false);
	}		

	radioselected=false;                            
	for(i=0;i<form1.s8a.length;i++)
	{
		if(form1.s8a[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 8-a");
		form1.s8a[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s8b.length;i++)
	{
		if(form1.s8b[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 8-b");
		form1.s8b[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s8c.length;i++)
	{
		if(form1.s8c[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 8-c");
		form1.s8c[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s9a.length;i++)
	{
		if(form1.s9a[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 9-a");
		form1.s9a[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s9b.length;i++)
	{
		if(form1.s9b[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 9-b");
		form1.s9b[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s9c.length;i++)
	{
		if(form1.s9c[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 9-c");
		form1.s9c[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s9d.length;i++)
	{
		if(form1.s9d[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 9-d");
		form1.s9d[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s9e.length;i++)
	{
		if(form1.s9e[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 9-e");
		form1.s9e[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s10a.length;i++)
	{
		if(form1.s10a[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 10-a");
		form1.s10a[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s10b.length;i++)
	{
		if(form1.s10b[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 10-b");
		form1.s10b[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s10c.length;i++)
	{
		if(form1.s10c[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 10-c");
		form1.s10c[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s11a.length;i++)
	{
		if(form1.s11a[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 11-a");
		form1.s11a[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s11b.length;i++)
	{
		if(form1.s11b[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 11-b");
		form1.s11b[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s12a.length;i++)
	{
		if(form1.s12a[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 12-a");
		form1.s12a[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s12b.length;i++)
	{
		if(form1.s12b[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 12-b");
		form1.s12b[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s12c.length;i++)
	{
		if(form1.s12c[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 12-c");
		form1.s12c[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s13a.length;i++)
	{
		if(form1.s13a[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 13-a");
		form1.s13a[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s13b.length;i++)
	{
		if(form1.s13b[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 13-b");
		form1.s13b[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s13c.length;i++)
	{
		if(form1.s13c[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 13-c");
		form1.s13c[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s13d.length;i++)
	{
		if(form1.s13d[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 13-d");
		form1.s13d[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s14a.length;i++)
	{
		if(form1.s14a[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 14-a");
		form1.s14a[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s14b.length;i++)
	{
		if(form1.s14b[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 14-b");
		form1.s14b[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s14c.length;i++)
	{
		if(form1.s14c[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 14-c");
		form1.s14c[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s14d.length;i++)
	{
		if(form1.s14d[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 14-d");
		form1.s14d[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s15a.length;i++)
	{
		if(form1.s15a[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 15-a");
		form1.s15a[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s15b.length;i++)
	{
		if(form1.s15b[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 15-b");
		form1.s15b[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s15c.length;i++)
	{
		if(form1.s15c[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 15-c");
		form1.s15c[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s16a.length;i++)
	{
		if(form1.s16a[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 16-a");
		form1.s16a[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s16b.length;i++)
	{
		if(form1.s16b[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 16-b");
		form1.s16b[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s16c.length;i++)
	{
		if(form1.s16c[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 16-c");
		form1.s16c[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s16d.length;i++)
	{
		if(form1.s16d[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 16-d");
		form1.s16d[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s16e.length;i++)
	{
		if(form1.s16e[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 16-e");
		form1.s16e[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s17a.length;i++)
	{
		if(form1.s17a[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 17-a");
		form1.s17a[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s17b.length;i++)
	{
		if(form1.s17b[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 17-b");
		form1.s17b[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s17c.length;i++)
	{
		if(form1.s17c[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 17-c");
		form1.s17c[0].focus();
		return (false);
	}		
	radioselected=false;                            
	for(i=0;i<form1.s17d.length;i++)
	{
		if(form1.s17d[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please enter your choice for Survey Question 17-d");
		form1.s17d[0].focus();
		return (false);
	}		
	
	radioselected=false;                            
	for(i=0;i<form1.so3.length;i++)
	{
		if(form1.so3[i].checked)
		radioselected=true;
	}
	if(!radioselected)                                               
	{
		alert("Please give your Overall Evaluation of the test measurement");
		form1.so3[0].focus();
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
   <form action="savevaliditysurveyanswer.php" method="post"  onSubmit="return form1_validate(this);">
  <font face="Arial, Helvetica, sans-serif"> 
  <p style='text-align:justify'>&nbsp;</p>
 <p style='text-align:justify'><strong>Name: 
    <INPUT TYPE="TEXT" NAME="Name">
    </strong></p>
  <p style='text-align:justify'>The following questions are to help us determine 
    to what extent the physics fiesta test gives an accurate representation of 
    the students’ knowledge. Thank you for participating.</p>
  <p> <strong>Instructions<br>
    </strong>&nbsp;&nbsp;For each question, please answer the science question, 
    followed by the survey question to indicate your opinions of the science question. 
    Please answer <strong>ALL</strong> science questions and <strong>ALL</strong> 
    survey questions. </p>
  </font> 
  <hr size="5">
  <font face="Arial, Helvetica, sans-serif">
  <p>&nbsp;</p>
  </font>
<div align="center">
  </div>
    <p style='text-align:justify'>1. When you bend your arm at the elbow, the 
      bone and muscles in your arm are acting as a system. What simple machine 
      does this system represent?</p>
    <p> 
      <INPUT TYPE="radio" NAME="Q1" VALUE="1">
      Inclined plane <br>
      <INPUT TYPE="radio" NAME="Q1" VALUE="2">
      Pulley <br>
      <INPUT TYPE="radio" NAME="Q1" VALUE="3">
      Wedge <br>
      <INPUT TYPE="radio" NAME="Q1" VALUE="4">
      Lever </p>
        
    <table width="80%" border="1" cellspacing="2" cellpadding="0">
      <tr bgcolor="#FFFFDD" class="tabletitle"> 
        <td width="58%"> 
          <div align="center">Survey question</div></td>
        <td width="9%"> 
          <div align="center">Strongly disagree</div></td>
        <td width="8%"> 
          <div align="center">Disagree</div></td>
        <td width="9%"> 
          <div align="center">Undecided</div></td>
        <td width="8%"> 
          <div align="center">Agree</div></td>
        <td width="8%"> 
          <div align="center">Strongly agree</div></td>
      </tr>
      <tr> 
        <td>a. Question 1 is appropriate for grade 6.</td>
        <td><div align="center"> 
            <input type="radio" name="s1a" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s1a" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s1a" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s1a" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s1a" value="5">
          </div></td>
      </tr>
      <tr> 
        <td>b. A student has a good idea of the science behind question 1 if he 
          or she answers the question correctly<br></td>
        <td><div align="center"> 
            <input type="radio" name="s1b" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s1b" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s1b" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s1b" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s1b" value="5">
          </div></td>
      </tr>
      <tr> 
        <td>c. The wording of question 1 is confusing.</td>
        <td><div align="center"> 
            <input type="radio" name="s1c" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s1c" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s1c" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s1c" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s1c" value="5">
          </div></td>
      </tr>
    </table>
    <p>&nbsp;</p><hr>
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

<p style='text-align:justify'><TEXTAREA ROWS="10" COLS="111" NAME="Q2b"></TEXTAREA></p>

    <table width="80%" border="1" cellspacing="2" cellpadding="0">
      <tr bgcolor="#FFFFDD" class="tabletitle"> 
        <td width="58%"> 
          <div align="center">Survey question</div></td>
        <td width="9%"> 
          <div align="center">Strongly disagree</div></td>
        <td width="8%"> 
          <div align="center">Disagree</div></td>
        <td width="9%"> 
          <div align="center">Undecided</div></td>
        <td width="8%"> 
          <div align="center">Agree</div></td>
        <td width="8%"> 
          <div align="center">Strongly agree</div></td>
      </tr>
      <tr> 
        <td>a. Question 2 is appropriate for grade 6.</td>
        <td><div align="center"> 
            <input type="radio" name="s2a" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s2a" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s2a" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s2a" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s2a" value="5">
          </div></td>
      </tr>
      <tr> 
        <td>b. A student has a good idea of the science behind question 2 if he 
          or she answers the question correctly<br></td>
        <td><div align="center"> 
            <input type="radio" name="s2b" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s2b" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s2b" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s2b" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s2b" value="5">
          </div></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <hr>
    <span style='font-size:12.0pt;font-family:"Times New Roman";mso-fareast-font-family:
"Times New Roman";mso-ansi-language:EN-US;mso-fareast-language:EN-US;
mso-bidi-language:AR-SA'> </span> 
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

<p style='text-align:justify'><TEXTAREA ROWS="10" COLS="111" NAME="Q3b"></TEXTAREA></p>

    <table width="80%" border="1" cellspacing="2" cellpadding="0">
      <tr bgcolor="#FFFFDD" class="tabletitle"> 
        <td width="58%"> 
          <div align="center">Survey question</div></td>
        <td width="9%"> 
          <div align="center">Strongly disagree</div></td>
        <td width="8%"> 
          <div align="center">Disagree</div></td>
        <td width="9%"> 
          <div align="center">Undecided</div></td>
        <td width="8%" bgcolor="#FFFFDD"> 
          <div align="center">Agree</div></td>
        <td width="8%"> 
          <div align="center">Strongly agree</div></td>
      </tr>
      <tr> 
        <td>a. Question 1 is appropriate for grade 6.</td>
        <td><div align="center"> 
            <input type="radio" name="s3a" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s3a" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s3a" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s3a" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s3a" value="5">
          </div></td>
      </tr>
      <tr> 
        <td>b. The table is unclear.<br></td>
        <td><div align="center"> 
            <input type="radio" name="s3b" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s3b" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s3b" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s3b" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s3b" value="5">
          </div></td>
      </tr>
      <tr> 
        <td>c. A student grasps the science behind question 3 if he or she answers 
          it correctly.<br></td>
        <td><div align="center"> 
            <input type="radio" name="s3c" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s3c" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s3c" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s3c" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s3c" value="5">
          </div></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <hr>
    <span style='font-size:12.0pt;font-family:"Times New Roman";mso-fareast-font-family:
"Times New Roman";mso-ansi-language:EN-US;mso-fareast-language:EN-US;
mso-bidi-language:AR-SA'><br clear=all style='mso-special-character:line-break;
page-break-before:always'>
    </span> <o:p></o:p>
<p style='text-align:justify'>4a. A girl wants to play on a seesaw with her
little brother. Which picture shows the best way for the heavier girl to
balance her lighter brother? Choose the letter of the picture.</p>

    <p style='text-align:justify'> <img src="images/image004.gif"></p>

<p style='text-align:justify'><INPUT TYPE="radio" NAME="Q4a" VALUE="1">A <br>
<INPUT TYPE="radio" NAME="Q4a" VALUE="2">B <br>
<INPUT TYPE="radio" NAME="Q4a" VALUE="3">C <br>
<INPUT TYPE="radio" NAME="Q4a" VALUE="4">D </p>

<p style='text-align:justify'>4b. Explain your reasoning.</p>

<p style='text-align:justify'><TEXTAREA ROWS="10" COLS="108" NAME="Q4b"></TEXTAREA></p>

    <p style='text-align:justify'><o:p>&nbsp;</o:p></p>
    <table width="80%" border="1" cellspacing="2" cellpadding="0">
      <tr bgcolor="#FFFFDD" class="tabletitle"> 
        <td width="58%"> 
          <div align="center">Survey question</div></td>
        <td width="9%"> 
          <div align="center">Strongly disagree</div></td>
        <td width="8%"> 
          <div align="center">Disagree</div></td>
        <td width="9%"> 
          <div align="center">Undecided</div></td>
        <td width="8%"> 
          <div align="center">Agree</div></td>
        <td width="8%"> 
          <div align="center">Strongly agree</div></td>
      </tr>
      <tr> 
        <td>a. Question 4 is appropriate for grade 6.</td>
        <td><div align="center"> 
            <input type="radio" name="s4a" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s4a" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s4a" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s4a" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s4a" value="5">
          </div></td>
      </tr>
      <tr> 
        <td>b. The pictures are clear answer choices.<br></td>
        <td><div align="center"> 
            <input type="radio" name="s4b" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s4b" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s4b" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s4b" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s4b" value="5">
          </div></td>
      </tr>
      <tr> 
        <td>c. The wording of question 4 is clear.<br></td>
        <td><div align="center"> 
            <input type="radio" name="s4c" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s4c" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s4c" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s4c" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s4c" value="5">
          </div></td>
      </tr>
      <tr> 
        <td><br>
          d. Question 4 should be included even though it is similar to question 
          2. <br>
          <br></td>
        <td><div align="center"> 
            <input type="radio" name="s4d" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s4d" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s4d" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s4d" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s4d" value="5">
          </div></td>
      </tr>
      <tr> 
        <td>e. A student has a good idea of the science <br></td>
        <td><div align="center"> 
            <input type="radio" name="s4e" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s4e" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s4e" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s4e" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s4e" value="5">
          </div></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <hr>
    <p><span style='font-size:12.0pt;font-family:"Times New Roman";mso-fareast-font-family:
"Times New Roman";mso-ansi-language:EN-US;mso-fareast-language:EN-US;
mso-bidi-language:AR-SA'></span> </p>
    <p>5. A student pulls three different objects horizontally across a table 
      using a spring scale that measures force. The data are shown below. On which 
      one of them must she do the most work? </p>
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
    </span> <o:p></o:p>
    <table width="80%" border="1" cellspacing="2" cellpadding="0">
      <tr bgcolor="#FFFFDD" class="tabletitle"> 
        <td width="58%"> <div align="center">Survey question</div></td>
        <td width="9%"> <div align="center">Strongly disagree</div></td>
        <td width="8%"> <div align="center">Disagree</div></td>
        <td width="9%"> <div align="center">Undecided</div></td>
        <td width="8%"> <div align="center">Agree</div></td>
        <td width="8%"> <div align="center">Strongly agree</div></td>
      </tr>
      <tr> 
        <td>a. Question 5 is appropriate for grade 6.</td>
        <td><div align="center"> 
            <input type="radio" name="s5a" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s5a" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s5a" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s5a" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s5a" value="5">
          </div></td>
      </tr>
      <tr> 
        <td>b. The table is clear.<br></td>
        <td><div align="center"> 
            <input type="radio" name="s5b" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s5b" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s5b" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s5b" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s5b" value="5">
          </div></td>
      </tr>
      <tr> 
        <td>c. The wording of the question is clear.<br></td>
        <td><div align="center"> 
            <input type="radio" name="s5c" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s5c" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s5c" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s5c" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s5c" value="5">
          </div></td>
      </tr>
      <tr> 
        <td> d. A student has a good idea of the science behind question 5 if 
          he or she gets the right answer.</td>
        <td><div align="center"> 
            <input type="radio" name="s5d" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s5d" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s5d" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s5d" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s5d" value="5">
          </div></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <hr>
    <p><span style='font-size:12.0pt;font-family:"Times New Roman";mso-fareast-font-family:
"Times New Roman";mso-ansi-language:EN-US;mso-fareast-language:EN-US;
mso-bidi-language:AR-SA'></span></p>
    <p style='margin-left:.25in;text-align:justify;text-indent:-.25in'>6. Which of
the following machines changes neither the force nor the distance?</p>

<p><INPUT TYPE="radio" NAME="Q6" VALUE="1">Inclined Plane <br>
<INPUT TYPE="radio" NAME="Q6" VALUE="2">Wheel and axle <br>
<INPUT TYPE="radio" NAME="Q6" VALUE="3">Movable Pulley <br>
<INPUT TYPE="radio" NAME="Q6" VALUE="4">Fixed Pulley </p>

    <p style='text-align:justify'><o:p>&nbsp;</o:p></p>
    <table width="80%" border="1" cellspacing="2" cellpadding="0">
      <tr bgcolor="#FFFFDD" class="tabletitle"> 
        <td width="58%"> <div align="center">Survey question</div></td>
        <td width="9%"> <div align="center">Strongly disagree</div></td>
        <td width="8%"> <div align="center">Disagree</div></td>
        <td width="9%"> <div align="center">Undecided</div></td>
        <td width="8%"> <div align="center">Agree</div></td>
        <td width="8%"> <div align="center">Strongly agree</div></td>
      </tr>
      <tr> 
        <td>a. Question 6 is appropriate for grade 6.</td>
        <td><div align="center"> 
            <input type="radio" name="s6a" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s6a" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s6a" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s6a" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s6a" value="5">
          </div></td>
      </tr>
      <tr> 
        <td>b. The wording is confusing. <br></td>
        <td><div align="center"> 
            <input type="radio" name="s6b" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s6b" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s6b" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s6b" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s6b" value="5">
          </div></td>
      </tr>
      <tr> 
        <td>c. A student grasps the science behind question 6 if he or she answers 
          it correctly.</td>
        <td><div align="center"> 
            <input type="radio" name="s6c" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s6c" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s6c" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s6c" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s6c" value="5">
          </div></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <hr>
    <p><span style='font-size:12.0pt;font-family:"Times New Roman";mso-fareast-font-family:
"Times New Roman";mso-ansi-language:EN-US;mso-fareast-language:EN-US;
mso-bidi-language:AR-SA'></span></p>
    <p style='text-align:justify'>7. What type of a simple machine is the blade of
a knife? Explain how it works.</p>

<p style='text-align:justify'><TEXTAREA ROWS="10" COLS="116" NAME="Q7"></TEXTAREA></p>

<span style='font-size:12.0pt;font-family:"Times New Roman";mso-fareast-font-family:
"Times New Roman";mso-ansi-language:EN-US;mso-fareast-language:EN-US;
mso-bidi-language:AR-SA'><br clear=all style='mso-special-character:line-break;
page-break-before:always'>
    </span> 
    <p style='text-align:justify'><o:p>&nbsp;</o:p></p>
    <table width="80%" border="1" cellspacing="2" cellpadding="0">
      <tr bgcolor="#FFFFDD" class="tabletitle"> 
        <td width="58%"> <div align="center">Survey question</div></td>
        <td width="9%"> <div align="center">Strongly disagree</div></td>
        <td width="8%"> <div align="center">Disagree</div></td>
        <td width="9%"> <div align="center">Undecided</div></td>
        <td width="8%"> <div align="center">Agree</div></td>
        <td width="8%"> <div align="center">Strongly agree</div></td>
      </tr>
      <tr> 
        <td>a. Question 7 is appropriate for grade 6.</td>
        <td><div align="center"> 
            <input type="radio" name="s7a" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s7a" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s7a" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s7a" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s7a" value="5">
          </div></td>
      </tr>
      <tr> 
        <td>b. A student gets the underlying science of question 7 if he or she 
          answers it correctly.</td>
        <td><div align="center"> 
            <input type="radio" name="s7b" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s7b" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s7b" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s7b" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s7b" value="5">
          </div></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <hr>
    <p><span style='font-size:12.0pt;font-family:"Times New Roman";mso-fareast-font-family:
"Times New Roman";mso-ansi-language:EN-US;mso-fareast-language:EN-US;
mso-bidi-language:AR-SA'></span></p>
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
    <table width="80%" border="1" cellspacing="2" cellpadding="0">
      <tr bgcolor="#FFFFDD" class="tabletitle"> 
        <td width="58%"> <div align="center">Survey question</div></td>
        <td width="9%"> <div align="center">Strongly disagree</div></td>
        <td width="8%"> <div align="center">Disagree</div></td>
        <td width="9%"> <div align="center">Undecided</div></td>
        <td width="8%"> <div align="center">Agree</div></td>
        <td width="8%"> <div align="center">Strongly agree</div></td>
      </tr>
      <tr> 
        <td>a. The answer choices for question 8 are clear.</td>
        <td><div align="center"> 
            <input type="radio" name="s8a" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s8a" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s8a" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s8a" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s8a" value="5">
          </div></td>
      </tr>
      <tr> 
        <td>b. Question 8 is appropriate for grade 6.<br></td>
        <td><div align="center"> 
            <input type="radio" name="s8b" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s8b" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s8b" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s8b" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s8b" value="5">
          </div></td>
      </tr>
      <tr> 
        <td>c. A student has a good idea of the science behind question 8 if he 
          or she answers <br>
          the question correctly.</td>
        <td><div align="center"> 
            <input type="radio" name="s8c" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s8c" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s8c" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s8c" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s8c" value="5">
          </div></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <hr>
    <p><span style='font-size:12.0pt;font-family:"Times New Roman";mso-fareast-font-family:
"Times New Roman";mso-ansi-language:EN-US;mso-fareast-language:EN-US;
mso-bidi-language:AR-SA'></span></p>
    <p style='text-align:justify'>9. The amount of work done on an object is found 
      by ...</p>

    <p>
      <INPUT TYPE="radio" NAME="Q9" VALUE="1">
      multiplying the load and the effort acting on the object <br>
      <INPUT TYPE="radio" NAME="Q9" VALUE="2">
      dividing the load by the effort acting on the object <br>
      <INPUT TYPE="radio" NAME="Q9" VALUE="3">
      multiplying the effort acting on the object and the distance traveled by 
      the object<br>
      <INPUT TYPE="radio" NAME="Q9" VALUE="4">
      dividing the effort acting on the object by the distance traveled by the 
      object </p>
    <table width="80%" border="1" cellspacing="2" cellpadding="0">
      <tr bgcolor="#FFFFDD" class="tabletitle"> 
        <td width="58%"> <div align="center">Survey question</div></td>
        <td width="9%"> <div align="center">Strongly disagree</div></td>
        <td width="8%"> <div align="center">Disagree</div></td>
        <td width="9%"> <div align="center">Undecided</div></td>
        <td width="8%"> <div align="center">Agree</div></td>
        <td width="8%"> <div align="center">Strongly agree</div></td>
      </tr>
      <tr> 
        <td>a. Question 9 is appropriate for grade 6.</td>
        <td><div align="center"> 
            <input type="radio" name="s9a" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s9a" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s9a" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s9a" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s9a" value="5">
          </div></td>
      </tr>
      <tr> 
        <td>b. The wording of question 9 is clear.<br></td>
        <td><div align="center"> 
            <input type="radio" name="s9b" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s9b" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s9b" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s9b" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s9b" value="5">
          </div></td>
      </tr>
      <tr> 
        <td>c. The answer choices for question 9 are appropriate (the choices 
          fit the question).<br></td>
        <td><div align="center"> 
            <input type="radio" name="s9c" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s9c" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s9c" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s9c" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s9c" value="5">
          </div></td>
      </tr>
      <tr> 
        <td> d. The answer choices for question 9 are clear.</td>
        <td><div align="center"> 
            <input type="radio" name="s9d" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s9d" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s9d" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s9d" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s9d" value="5">
          </div></td>
      </tr>
      <tr> 
        <td>e. A student has a good idea of the science behind question 9 if he 
          or she answers the question correctly.</td>
        <td><div align="center"> 
            <input type="radio" name="s9e" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s9e" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s9e" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s9e" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s9e" value="5">
          </div></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <hr>
    <p>&nbsp; </p>

<p>10. An example of a lever in
which the load is between the effort and the fulcrum (second class lever) is a ...</p>

<p><INPUT TYPE="radio" NAME="Q10" VALUE="1">seesaw <br>
<INPUT TYPE="radio" NAME="Q10" VALUE="2">bottle opener <br>
<INPUT TYPE="radio" NAME="Q10" VALUE="3">shovel <br>
<INPUT TYPE="radio" NAME="Q10" VALUE="4">fishing pole </p>

    <p style='text-align:justify'><o:p>&nbsp;</o:p></p>
    <table width="80%" border="1" cellspacing="2" cellpadding="0">
      <tr bgcolor="#FFFFDD" class="tabletitle"> 
        <td width="58%"> <div align="center">Survey question</div></td>
        <td width="9%"> <div align="center">Strongly disagree</div></td>
        <td width="8%"> <div align="center">Disagree</div></td>
        <td width="9%"> <div align="center">Undecided</div></td>
        <td width="8%"> <div align="center">Agree</div></td>
        <td width="8%"> <div align="center">Strongly agree</div></td>
      </tr>
      <tr> 
        <td>a. Question 10 is appropriate for grade 6.</td>
        <td><div align="center"> 
            <input type="radio" name="s10a" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s10a" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s10a" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s10a" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s10a" value="5">
          </div></td>
      </tr>
      <tr> 
        <td>b. A student has a good idea of the science behind question 10 if 
          he or she answers the question correctly.</td>
        <td><div align="center"> 
            <input type="radio" name="s10b" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s10b" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s10b" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s10b" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s10b" value="5">
          </div></td>
      </tr>
      <tr> 
        <td>c. The wording of the question is confusing</td>
        <td><div align="center"> 
            <input type="radio" name="s10c" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s10c" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s10c" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s10c" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s10c" value="5">
          </div></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <hr>
    <p style='text-align:justify'>&nbsp; </p>

<p style='text-align:justify'>11. Which ramp would require the least effort to 
      ride up?</p>

    <p style='text-align:justify'><img src="images/image005.gif" width="587" height="104"></p>

<p style='text-align:justify'><INPUT TYPE="radio" NAME="Q11" VALUE="1">X <br>
<INPUT TYPE="radio" NAME="Q11" VALUE="2">Y <br>
<INPUT TYPE="radio" NAME="Q11" VALUE="3">Z <br>
<INPUT TYPE="radio" NAME="Q11" VALUE="4">All are the same </p>

    <p style='text-align:justify'><o:p>&nbsp;</o:p></p>
    <table width="80%" border="1" cellspacing="2" cellpadding="0">
      <tr bgcolor="#FFFFDD" class="tabletitle"> 
        <td width="58%"> <div align="center">Survey question</div></td>
        <td width="9%"> <div align="center">Strongly disagree</div></td>
        <td width="8%"> <div align="center">Disagree</div></td>
        <td width="9%"> <div align="center">Undecided</div></td>
        <td width="8%"> <div align="center">Agree</div></td>
        <td width="8%"> <div align="center">Strongly agree</div></td>
      </tr>
      <tr> 
        <td>a. Question 11 is appropriate for grade 6.</td>
        <td><div align="center"> 
            <input type="radio" name="s11a" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s11a" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s11a" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s11a" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s11a" value="5">
          </div></td>
      </tr>
      <tr> 
        <td>b. A student has a good idea of the science behind question 2 if he 
          or she gets it right.</td>
        <td><div align="center"> 
            <input type="radio" name="s11b" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s11b" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s11b" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s11b" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s11b" value="5">
          </div></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <hr>
    <p style='text-align:justify'><o:p>&nbsp;</o:p></p>

    <p style='text-align:justify'>12. When you turn a screw into a piece of wood, 
      the wood provides the ...</p>

<p><INPUT TYPE="radio" NAME="Q12" VALUE="1">effort <br>
<INPUT TYPE="radio" NAME="Q12" VALUE="2">work <br>
<INPUT TYPE="radio" NAME="Q12" VALUE="3">power <br>
<INPUT TYPE="radio" NAME="Q12" VALUE="4">load</p>

    <p style='text-align:justify'><o:p>&nbsp;</o:p></p>
    <table width="80%" border="1" cellspacing="2" cellpadding="0">
      <tr bgcolor="#FFFFDD" class="tabletitle"> 
        <td width="58%"> <div align="center">Survey question</div></td>
        <td width="9%"> <div align="center">Strongly disagree</div></td>
        <td width="8%"> <div align="center">Disagree</div></td>
        <td width="9%"> <div align="center">Undecided</div></td>
        <td width="8%"> <div align="center">Agree</div></td>
        <td width="8%"> <div align="center">Strongly agree</div></td>
      </tr>
      <tr> 
        <td>a. Question 12 is appropriate for grade 6.</td>
        <td><div align="center"> 
            <input type="radio" name="s12a" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s12a" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s12a" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s12a" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s12a" value="5">
          </div></td>
      </tr>
      <tr> 
        <td>b. The student has a good idea of the science underlying question 
          12 if he or she answers the question correctly.</td>
        <td><div align="center"> 
            <input type="radio" name="s12b" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s12b" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s12b" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s12b" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s12b" value="5">
          </div></td>
      </tr>
      <tr> 
        <td>c. The wording of question 12 is confusing.</td>
        <td><div align="center"> 
            <input type="radio" name="s12c" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s12c" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s12c" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s12c" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s12c" value="5">
          </div></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <hr>
    <span style='font-size:12.0pt;font-family:"Times New Roman";mso-fareast-font-family:
"Times New Roman";mso-ansi-language:EN-US;mso-fareast-language:EN-US;
mso-bidi-language:AR-SA'><br clear=all style='page-break-before:always'>
</span>

    <p style='text-align:justify'>13a. Which of the following pulley setups requires 
      the least effort to lift a load?</p>

    <p style='text-align:justify'><img src="images/image011.jpg" width="289" height="205"><img src="images/image007.jpg"></p>

<p><INPUT TYPE="radio" NAME="Q13a" VALUE="1">A <br>
<INPUT TYPE="radio" NAME="Q13a" VALUE="2">B <br>
<INPUT TYPE="radio" NAME="Q13a" VALUE="3">A and B require equal force. <br>
<INPUT TYPE="radio" NAME="Q13a" VALUE="4">Not enough information</p>

<p style='text-align:justify'><o:p>&nbsp;</o:p></p>

    <p style='text-align:justify'>13b. Explain your reasoning.</p>

<p style='text-align:justify'><TEXTAREA ROWS="10" COLS="108" NAME="Q13b"></TEXTAREA></p>

<p style='text-align:justify'><o:p>&nbsp;</o:p></p>

    <table width="80%" border="1" cellspacing="2" cellpadding="0">
      <tr bgcolor="#FFFFDD" class="tabletitle"> 
        <td width="58%"> <div align="center">Survey question</div></td>
        <td width="9%"> <div align="center">Strongly disagree</div></td>
        <td width="8%"> <div align="center">Disagree</div></td>
        <td width="9%"> <div align="center">Undecided</div></td>
        <td width="8%"> <div align="center">Agree</div></td>
        <td width="8%"> <div align="center">Strongly agree</div></td>
      </tr>
      <tr> 
        <td>a. Question 13 is appropriate for grade 6.</td>
        <td><div align="center"> 
            <input type="radio" name="s13a" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s13a" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s13a" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s13a" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s13a" value="5">
          </div></td>
      </tr>
      <tr> 
        <td>b. A student has a good idea of the science behind question 13 if 
          he or she answers the question correctly.</td>
        <td><div align="center"> 
            <input type="radio" name="s13b" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s13b" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s13b" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s13b" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s13b" value="5">
          </div></td>
      </tr>
      <tr> 
        <td>c. The wording of question 13 is confusing. <br></td>
        <td><div align="center"> 
            <input type="radio" name="s13c" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s13c" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s13c" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s13c" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s13c" value="5">
          </div></td>
      </tr>
      <tr> 
        <td> d. The pictures are clear.</td>
        <td><div align="center"> 
            <input type="radio" name="s13d" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s13d" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s13d" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s13d" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s13d" value="5">
          </div></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <hr>
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
    <table width="80%" border="1" cellspacing="2" cellpadding="0">
      <tr bgcolor="#FFFFDD" class="tabletitle"> 
        <td width="58%"> <div align="center">Survey question</div></td>
        <td width="9%"> <div align="center">Strongly disagree</div></td>
        <td width="8%"> <div align="center">Disagree</div></td>
        <td width="9%"> <div align="center">Undecided</div></td>
        <td width="8%"> <div align="center">Agree</div></td>
        <td width="8%"> <div align="center">Strongly agree</div></td>
      </tr>
      <tr> 
        <td>a. Question 14 is appropriate for grade 6.</td>
        <td><div align="center"> 
            <input type="radio" name="s14a" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s14a" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s14a" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s14a" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s14a" value="5">
          </div></td>
      </tr>
      <tr> 
        <td>b. A student has a good idea of the science behind question 14 if 
          he or she answers the question correctly.</td>
        <td><div align="center"> 
            <input type="radio" name="s14b" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s14b" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s14b" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s14b" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s14b" value="5">
          </div></td>
      </tr>
      <tr> 
        <td>c. The answer choices are appropriate. <br></td>
        <td><div align="center"> 
            <input type="radio" name="s14c" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s14c" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s14c" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s14c" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s14c" value="5">
          </div></td>
      </tr>
      <tr> 
        <td> d. The wording of question 14 is clear.</td>
        <td><div align="center"> 
            <input type="radio" name="s14d" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s14d" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s14d" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s14d" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s14d" value="5">
          </div></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <hr>
    <span style='font-size:12.0pt;font-family:"Times New Roman";mso-fareast-font-family:
"Times New Roman";mso-ansi-language:EN-US;mso-fareast-language:EN-US;
mso-bidi-language:AR-SA'></span>
    <p style='text-align:justify'>&nbsp;</p>
    <p style='text-align:justify'>15. In which situation would it take less effort 
      to lift the same ball up to the top of the ramp?</p>

    <p style='text-align:justify'><img src="images/image008.gif" width="556" height="125"></p>

<p><INPUT TYPE="radio" NAME="Q15" VALUE="1">A <br>
<INPUT TYPE="radio" NAME="Q15" VALUE="2">B <br>
<INPUT TYPE="radio" NAME="Q15" VALUE="3">A and B require equal effort<br>
<INPUT TYPE="radio" NAME="Q15" VALUE="4">Not enough information</p>

    <table width="80%" border="1" cellspacing="2" cellpadding="0">
      <tr bgcolor="#FFFFDD" class="tabletitle"> 
        <td width="58%"> <div align="center">Survey question</div></td>
        <td width="9%"> <div align="center">Strongly disagree</div></td>
        <td width="8%"> <div align="center">Disagree</div></td>
        <td width="9%"> <div align="center">Undecided</div></td>
        <td width="8%"> <div align="center">Agree</div></td>
        <td width="8%"> <div align="center">Strongly agree</div></td>
      </tr>
      <tr> 
        <td>a. Question 15 is appropriate for grade 6.</td>
        <td><div align="center"> 
            <input type="radio" name="s15a" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s15a" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s15a" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s15a" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s15a" value="5">
          </div></td>
      </tr>
      <tr> 
        <td>b. A student has a good idea of the science behind question 15 if 
          he or she answers the question correctly.</td>
        <td><div align="center"> 
            <input type="radio" name="s15b" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s15b" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s15b" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s15b" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s15b" value="5">
          </div></td>
      </tr>
      <tr> 
        <td>c. The wording of question 15 is confusing. <br></td>
        <td><div align="center"> 
            <input type="radio" name="s15c" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s15c" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s15c" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s15c" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s15c" value="5">
          </div></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <hr>
    <span style='font-size:12.0pt;font-family:"Times New Roman";mso-fareast-font-family:
"Times New Roman";mso-ansi-language:EN-US;mso-fareast-language:EN-US;
mso-bidi-language:AR-SA'></span> <span style='font-size:12.0pt;font-family:"Times New Roman";mso-fareast-font-family:
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
    <table width="80%" border="1" cellspacing="2" cellpadding="0">
      <tr bgcolor="#FFFFDD" class="tabletitle"> 
        <td width="58%"> <div align="center">Survey question</div></td>
        <td width="9%"> <div align="center">Strongly disagree</div></td>
        <td width="8%"> <div align="center">Disagree</div></td>
        <td width="9%"> <div align="center">Undecided</div></td>
        <td width="8%"> <div align="center">Agree</div></td>
        <td width="8%"> <div align="center">Strongly agree</div></td>
      </tr>
      <tr> 
        <td>a. Question 16 is appropriate for grade 6.</td>
        <td><div align="center"> 
            <input type="radio" name="s16a" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s16a" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s16a" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s16a" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s16a" value="5">
          </div></td>
      </tr>
      <tr> 
        <td>b. A student has a good idea of the science behind question 16 if 
          he or she answers the question correctly. </td>
        <td><div align="center"> 
            <input type="radio" name="s16b" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s16b" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s16b" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s16b" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s16b" value="5">
          </div></td>
      </tr>
      <tr> 
        <td>c. The wording of question 16 is confusing.<br></td>
        <td><div align="center"> 
            <input type="radio" name="s16c" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s16c" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s16c" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s16c" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s16c" value="5">
          </div></td>
      </tr>
      <tr> 
        <td> d. The answer categories are clear. </td>
        <td><div align="center"> 
            <input type="radio" name="s16d" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s16d" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s16d" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s16d" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s16d" value="5">
          </div></td>
      </tr>
      <tr> 
        <td>e. The answer categories are appropriate.</td>
        <td><div align="center"> 
            <input type="radio" name="s16e" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s16e" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s16e" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s16e" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s16e" value="5">
          </div></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <hr>
    <p></p>

<p>17. In which situation would it take less effort to lift the same block 
      using a wheel and axle?</p>

    <p><img src="images/image010.gif"></p>

<p><INPUT TYPE="radio" NAME="Q17" VALUE="1">A <br>
<INPUT TYPE="radio" NAME="Q17" VALUE="2">B <br>
<INPUT TYPE="radio" NAME="Q17" VALUE="3">A and B require equal effort<br>
<INPUT TYPE="radio" NAME="Q17" VALUE="4">Not enough information</p>

    <p><o:p>&nbsp;</o:p></p>
    <table width="80%" border="1" cellspacing="2" cellpadding="0">
      <tr bgcolor="#FFFFDD" class="tabletitle"> 
        <td width="58%"> <div align="center">Survey question</div></td>
        <td width="9%"> <div align="center">Strongly disagree</div></td>
        <td width="8%"> <div align="center">Disagree</div></td>
        <td width="9%"> <div align="center">Undecided</div></td>
        <td width="8%"> <div align="center">Agree</div></td>
        <td width="8%"> <div align="center">Strongly agree</div></td>
      </tr>
      <tr> 
        <td>a. Question 17 is appropriate for grade 6.</td>
        <td><div align="center"> 
            <input type="radio" name="s17a" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s17a" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s17a" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s17a" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s17a" value="5">
          </div></td>
      </tr>
      <tr> 
        <td>b. A student has a good idea of the science behind question 17 if 
          he or she answers the question correctly. </td>
        <td><div align="center"> 
            <input type="radio" name="s17b" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s17b" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s17b" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s17b" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s17b" value="5">
          </div></td>
      </tr>
      <tr> 
        <td>c. The wording of question 17 is confusing.<br></td>
        <td><div align="center"> 
            <input type="radio" name="s17c" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s17c" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s17c" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s17c" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s17c" value="5">
          </div></td>
      </tr>
      <tr> 
        <td> d. The diagrams are clear.</td>
        <td><div align="center"> 
            <input type="radio" name="s17d" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s17d" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s17d" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s17d" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="s17d" value="5">
          </div></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <hr size="5">
    <span style='font-size:12.0pt;font-family:"Times New Roman";mso-fareast-font-family:
"Times New Roman";mso-ansi-language:EN-US;mso-fareast-language:EN-US;
mso-bidi-language:AR-SA'></span> 
    <p style='text-align:justify'><strong> Overall test</strong><br>
      <br>
      Here we would like some feedback on what you think of the test as a whole. 
    </p>
    <p>1. Do you have any suggestions for the improvement for any individual questions 
      or answers in the test? If you do, what are they?</p>
    <p> 
      <textarea name="so1" cols="60" rows="4"></textarea>
    </p>
    <hr>
    <p><br>
      2. Would you like to suggest any additional questions that you think are 
      important? If yes, what are they?</p>
    <p> 
      <textarea name="so2" cols="60" rows="4"></textarea>
    </p>
    <hr>
    <p><br>
      3. Overall, how well do you think this test measures what the students were 
      learning in the course?</p>
    <table width="331" border="1" cellspacing="2" cellpadding="0">
      <tr bgcolor="#FFFFDD"> 
        <td width="26%">Not very well</td>
        <td width="17%">&nbsp;</td>
        <td width="17%">&nbsp;</td>
        <td width="16%">&nbsp;</td>
        <td width="24%">Very well</td>
      </tr>
      <tr> 
        <td><div align="center"> 
            <input type="radio" name="so3" value="1">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="so3" value="2">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="so3" value="3">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="so3" value="4">
          </div></td>
        <td><div align="center"> 
            <input type="radio" name="so3" value="5">
          </div></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <p>Thank you for completing the survey. Your answers will help us to continue 
      to improve the content.<br>
    </p>
    <p align="center"><o:p>&nbsp; 
      <input type="submit" name="Submit" value="Submit">
      &nbsp; </o:p></p>

    </form>

</div>

</body>

</html>
