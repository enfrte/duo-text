<?php 

$file = !empty($_FILES['file']) ? $_FILES['file'] : false;

if (!$file) die("<p>Text will appear here...</p>");

$file_tmp = $_FILES['file']['tmp_name'];

if (file_exists($file_tmp)) {
	$file_txt = file_get_contents($file_tmp);
	$file_EOL_exp = preg_split('/\r\n|\r|\n/', $file_txt);

	foreach ($file_EOL_exp as $key => $line) {
		$file_tab_exp = explode("\t", $line);
		$result_arr[] = [$file_tab_exp[0], $file_tab_exp[1]];
	}

	// var_dump($result_arr);
	header("Content-type: application/json");
	header("Content-Disposition: attachment; filename=finished.json");

	print_r(json_encode($result_arr));
}
?>