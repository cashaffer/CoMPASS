Top level folder for storing all pages and code related to the Compass navigation system (compassproject.net).

conceptmap/ stores the Java code for applets.
student/ stores the php pages displayed when a student logs in.
teacher/ stores php pages for teacher accounts, similarly for researcher/.
prompts/ contains pages for automated navigation suggestions.
admin/ contains pages for administrative controls like creating new users etc.

see "parts_of_compass_page.PNG" for an idea of what php pages generate a compass navigation webpage.

This is the sequence of pages accessed when a student logins and nagivates compass:
1) compass_mt/default.htm for showing login screen.
2) compass_mt/compass/checklogin.php for authenticating the user this redirects to the following page on successful authentication.
3) compass/purpose.php -- for goal topic

// note: all pages from this point will be in compass_mt/compass/student directory, if the user is a student, otherwise, compass_mt/compass/(teacher or researcher)

4) selectunit.php
5) explore.php -- this contains elements from nav.php, applet and content.php.


