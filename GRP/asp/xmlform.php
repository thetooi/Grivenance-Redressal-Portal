<?php


        echo "Links Data Posted";

/* All Links data from the form is now being stored in variables in string format  */

        $urlDoc = $_POST['name'];

        $urlAdd = $_POST['description'];

       // $urlDes = $_POST['urlDes'];
       
       $xmlBeg = "<?xml version='1.0' encoding='ISO-8859-1'?>"; 

        $rootELementStart = "<$urlDoc>";

        $rootElementEnd = "</$urlDoc>";

        $xml_document=  $xmlBeg; 

        $xml_document .=  $rootELementStart;

        $xml_document .=  "<site>";

        $xml_document .=  $urlAdd;

        $xml_document .=  "</site>";

        $xml_document .=  "<description>";

        $xml_document .=  "</description>";

        $xml_document .=  $rootElementEnd;

        $path_dir = "xmlfile/";

        $path_dir .=   $urlDoc .".xml";

/* Data in Variables ready to be written to an XML file */

$fp = fopen($path_dir,'w');
$write = fwrite($fp,$xml_document);

/* Loading the created XML file to check contents */

$sites = simplexml_load_file("$path_dir");

echo "<br> Checking the loaded file <br>" .$path_dir. "<br>";
echo "<br><br>Whats inside loaded XML file?<br>"; 
print_r($sites);




?>

