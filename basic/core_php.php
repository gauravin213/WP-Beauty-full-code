<?php
programs

1. sorting ans searching
2. pattern
4. recursion 
5. Time complexcity
6. algo
7. mistone
8. mobile


mysqli_connect(
        'localhost', //localhost
        'root', //username
        'root', //password
        'gaurav_test1' //db_name
        );

mysqli_connect_error()

mysqli_query($conn, $sql)

mysql_num_rows();

mysql_fetch_row() //return result as a numeric array
mysql_fetch_assoc() 
mysql_fetch_array()


implode(" ",$arr);
//The implode() function returns a string from the elements of an array.

explode(" ",$str);
//The explode() function breaks a string into an array.

array() 
// define array.

is_array()--
//  Finds whether a variable is an array or not. is_array($a)

in_array() --
// check spacific value is in array or not.in_array("Volvo",$a)

array_merge() --
// merges one or more arrays into one array. array_merge($a1,$a2)

array_keys()--
//returns all the keys of an array.array_keys($a)

array_values() --
//returns all the values of an array.array_values($a)

array_push()--
// insert new ele end of array. array_push($a,"blue","yellow");

array_pop() --
//remove last element of array. array_pop($a)

array_shift() 
//remove fisrt element of array. array_shift($a)

array_unshift() 
//insert new ele benning of array. array_unshift($a,"blue");


array_unique() --
//removes duplicate values from an array array_unique($a) 

array_slice() --
// returns selected parts of an array. array_slice($a,2)

array_diff() 
// compares the values of two (or more) arrays, and returns the differences array_diff($a1,$a2)

array_search() --
//search an array for a value and returns the key. array_search("red",$a);

array_reverse() 
//returns an array in the reverse order. array_reverse($a)



array_key_exists() 
//return true or false , check array key exist or not.  array_key_exists("Volvo",$a)


array_map() 

function myfunction($v)
{
  return($v*$v);
}
//sends each value of an array to a user-made function array_map("myfunction",$a)




What is HTTP?
The Hypertext Transfer Protocol (HTTP) is designed to enable communications between clients and servers.

HTTP Methods
GET
POST
PUT
HEAD
DELETE
PATCH
OPTIONS


$_GET[]  //GET is used to request data from a specified resource.
//query string (name/value pairs) is sent in the URL of a GET request:
//GET requests have length restrictions 2048 charector

$_POST[] // POST is used to send data to a server to create/update a resource.
//not send data in url.
//POST requests have no restrictions on data length.

$_SERVER[] // is a PHP super global variable which holds information about headers, paths, and script locations.
$_SERVER['PHP_SELF']; //paht
$_SERVER['SERVER_NAME']; //donamin or server name.
$_SERVER['HTTP_HOST']; //donamin or server name.
$_SERVER['HTTP_REFERER'];
$_SERVER['HTTP_USER_AGENT']; //header
$_SERVER['SCRIPT_NAME']; //paht

 
require ''; //will produce a fatal error (E_COMPILE_ERROR) and stop the script
require_once();  //// if file already included then it will not be included again

include '';  // will only produce a warning (E_WARNING) and the script will continue
include_once(); // if file already included then it will not be included again 

//output data to the screen
echo ''; //has no return value ,very fast
print ''; //while print has a return value of 1 so it can be used in expressions. 
print_r(''); //Display the internal str of array.

printf('');

//The sprintf() function writes a formatted string to a variable. 
Syntax
sprintf(format,arg1,arg2,arg++);
%% - Returns a percent sign
%b - Binary number
%c - The character according to the ASCII value
%d - Signed decimal number (negative, zero or positive)
%e - Scientific notation using a lowercase (e.g. 1.2e+2)
%E - Scientific notation using a uppercase (e.g. 1.2E+2)
%u - Unsigned decimal number (equal to or greather than zero)
%f - Floating-point number (local settings aware)
%F - Floating-point number (not local settings aware)
%g - shorter of %e and %f
%G - shorter of %E and %f
%o - Octal number
%s - String
%x - Hexadecimal number (lowercase letters)
%X - Hexadecimal number (uppercase letters)

Example :
sprintf("With 2 decimals: %1\$.2f <br>With no decimals: %1\$u",$number);

Note: sprintf() returns a string, printf() displays it.


php error
fetal error
warning.
Note.


control state ment 

while(){}
The do...while statement will execute a block of code - it then will repeat the loop as long as a condition is true.

do while(){}
The do...while statement will execute a block of code at least once - it then will repeat the loop as long as a condition is true.


for ($i=0; $i < ; $i++) { 
	# code...
}

foreach ($variable as $key => $value) {
	# code...
}

if (condition) {
	# code...
}

// conditional operator
(con) ? 'trure' : 'false'; 



PHP Arithmetic Operators

$x + $y 

$x - $y

$x * $y

$x / $y

$x % $y //Remainder of $x divided by $y 10/6 =4, 15=3

$x ** $y //Exponentiation
$x = 5;  
$y = 3;
echo $x ** $y; // x^y or 5^3 = 125.


PHP Comparison Operators OR logocal Operators

==  //Equal , Returns true if $x is equal to $y

$x = 100;  
$y = "100";
var_dump($x == $y); // returns true because values are equal

=== //Identical , Returns true if $x is equal to $y, and they are of the same type

$x = 100;  
$y = "100";
var_dump($x === $y); // returns false because types are not equal

!= //Not equal

<>  //Not equal

!== //Not identical, Returns true if $x is not equal to $y, or they are not of the same type

> //Greater than

< //Less than

>= //Greater than or equal to

<= //Less than or equal to



#PHP Data Types

String
Integer
Float (floating point numbers - also called double)
Boolean
Array
Object
NULL
Resource
//gettype(); var_dump();


#php string
-The PHP strlen() function returns the length of a string.
-The PHP str_word_count() function counts the number of words in a string.
-The PHP str_replace() function replaces some characters with some other characters in a string.
str_replace("world", "Dolly", "Hello world!"); // outputs Hello Dolly!
-The substr() function returns a part of a string.
substr("Hello world",0,10).






========================================================================

SQL SERVER

DML, DDL, DCL and TCL

DDL //Data Definition Language.
It is used to create and modify the structure of database 
Examples: CREATE, ALTER, DROP statements

DML //Data Manipulation Language
It is used to retrieve, store, modify, delete, insert and update data in database.
Examples: INSERT, UPDATE, DELETE, SELECT statements

DCL //Data Control Language
 It is used to create roles, permissions, and referential integrity as well it is used to control access to database by securing it.
Examples: GRANT, REVOKE statements

TCL //Transactional Control Language
It is used to manage different transactions occurring within a database.




