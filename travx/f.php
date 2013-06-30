<?php
$path='templates/OpenGame/';
$handle=opendir($path);


while (($file = readdir($handle))!==false){
    if ($file!="." && $file!=".."){
echo $path;
echo $file."<br/><br/>";
$filee = explode(".",$file);
$file2=$filee[1];
$new_name=$filee[0].".tpl";
echo $new_name;
       rename($path . $file, $path.$new_name);
echo $path;
echo $file."<br/>";
    }
}