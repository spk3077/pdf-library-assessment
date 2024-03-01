<!-- File: dos.php -->
<!-- Assignment: MS Capstone -->
<!-- Lanuguage: PHP -->
<!-- Author: Sean Kells <spk3077@rit.edu> -->
<!-- Description: Denial of Service Endpoint -->
<?php
$str_array = array('abc', 'fed', '123', 'dog', 'cat', 'knee', 'colder', 'heat');
shuffle($str_array);
sort($str_array);
shuffle($str_array);
sort($str_array);

echo '<h1 style="text-align:center;">Still working?</h1>';
?>