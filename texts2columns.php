<?php 
//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

$combined_arr = [];

$native_file = !empty($_FILES['native_file']) ? $_FILES['native_file'] : false;
$learning_file = !empty($_FILES['learning_file']) ? $_FILES['learning_file'] : false;

if (!$native_file OR !$learning_file) die("Waiting for files");

$native_file_tmp = $_FILES['native_file']['tmp_name'];
$learning_file_tmp = $_FILES['learning_file']['tmp_name'];

if (file_exists($native_file_tmp) && file_exists($learning_file_tmp)) {
	$native_file_txt = file_get_contents($native_file_tmp);
	$learning_file_txt = file_get_contents($learning_file_tmp);

	$learning_file_txt = str_replace(array("\n", "\r"), ' ', $learning_file_txt);
	$learning_file_txt = preg_replace('!\s+!', ' ', $learning_file_txt); // replace multiple spaces with single space
	
	$native_file_txt = str_replace(array("\n", "\r"), ' ', $native_file_txt);
	$native_file_txt = str_replace(array(".", ",", ";", "(", ")", '"'), '', $native_file_txt);
	$native_file_txt = preg_replace('!\s+!', ' ', $native_file_txt);

	$native_file_exp = explode(' ', $native_file_txt);
	$learning_file_exp = explode(' ', $learning_file_txt);

	$length_of_native_file_exp = count($native_file_exp);
	$length_of_learning_file_exp = count($learning_file_exp);

	if ($length_of_native_file_exp > $length_of_learning_file_exp) {
		$learning_file_padded = array_pad($learning_file_exp, $length_of_native_file_exp, "");

		for ($i=0; $i < $length_of_native_file_exp; $i++) { 
			$combined_arr[] = [$learning_file_padded[$i], $native_file_exp[$i]];
		}
	}
	elseif ($length_of_learning_file_exp > $length_of_native_file_exp) {
		$native_file_padded = array_pad($native_file_exp, $length_of_learning_file_exp, "");

		for ($i=0; $i < $length_of_learning_file_exp; $i++) { 
			$combined_arr[] = [$learning_file_exp[$i], $native_file_padded[$i]];
		}	
	}
	else { // Equal length
		for ($i=0; $i < $length_of_learning_file_exp; $i++) { 
			$combined_arr[] = [$learning_file_exp[$i], $native_file_exp[$i]];
		}
	}

	//var_dump($combined_arr);
	$result = '';

	foreach($combined_arr as $word_arr) {
		foreach ($word_arr as $word_key => $word) {			
			if ($word_key == 0) {
				$result .= $word."\t";
				//fwrite($fp, $word."\t");
				continue;
			}
			$result .= $word.PHP_EOL;
			//fwrite($fp, $word.PHP_EOL);
		}
	}

	header("Content-type: text/plain");
	header("Content-Disposition: attachment; filename=merged-translations.txt");
	
	echo $result;
	
	/*
	$fp = fopen(__DIR__.'/result.txt',"w");

	if ($fp) {
		foreach($combined_arr as $word_arr) {
			foreach ($word_arr as $word_key => $word) {			
				if ($word_key == 0) {
					fwrite($fp, $word."\t");
					continue;
				}
				fwrite($fp, $word.PHP_EOL);
			}
		}

		fclose($fp);

		echo "<p>Saved as result.txt</p>";
	}
	*/

}
else {
	die('Something went wrong');
}
?>