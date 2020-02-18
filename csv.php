<?php


function writeCSV($file,$data){
	$h=fopen($file,'w+');
    if (is_array($data)){
        foreach ($data as $fields) {
            fputcsv($h, $fields);
        }   
    }
    else
        fwrite($h,$data. "\n" /* PHP_EOL */);
	fclose($h);
}

function readCSV($file, $index=null){
	$h=fopen($file,'r');
	$output='';
	while(!feof($h)) $output.=fgets($h);
	fclose($h);
	$output=explode("\n",$output);
	unset($output[count($output)-1]);
	for($i=0;$i<count($output);$i++) $output[$i]=explode(',',$output[$i]);
	if (!isset($index) || !(array_key_exists($index,$output)))    return $output;	
    else return $output[index];
}

//Takes the filename, a single item of data, the line index, and the index of the individual data item.
function modifyCSV($file,$data,$lineIndex,$itemIndex){
	$input=readCSV($file);
	$input[0][$lineIndex][$itemIndex]=$data;
	writeCSV($file,$input);
}

//Takes the filename, the line index, and the index of the individual data item.
function deleteCSV($file,$lineIndex,$itemIndex){
	$input=readCSV($file);
	$input[0][$lineIndex][$itemIndex]="null";
	return $input;
}

//$array=["a","b","c"];

//$bar="x";

//writeCSV("foo.csv", $array);

//modifyCSV("foo.csv", $bar, 0, 0);