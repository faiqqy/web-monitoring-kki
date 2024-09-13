<?php
ini_set("display_errors", 0); //mematikan display error

require "./src/database.php";
require "./src/passwd.php";

function default_exception_handler(Exception $e){
	// show something to the user letting them know we fell down
	echo "<h2>Something Bad Happened</h2>";
	echo $e.'\n';
	echo "<p>We fill find the person responsible and have them shot</p>";
	// do some logging for the exception and call the kill_programmer function.
}

set_exception_handler("default_exception_handler");

// parsing metode request dan alamat request
$verb = $_SERVER['REQUEST_METHOD'];
$url_pcs = explode('/', $_SERVER['REQUEST_URI']);



	//cek apakah uri sesuai
switch ($url_pcs[2]){
case 'insert-geotag':		//api untuk memasukan data di sql

	// cek apakah metede request sesuai
	switch($verb){
	case 'POST':
		
		// ambil data dan parsing json yang dikirim user
		$json_data = file_get_contents('php://input');
		$data = json_decode($json_data);
		
		//check json ber isi
		if(!($data)){echo "wrong json"; break;}
		
		//check bila api salah maka keluar
		if(!(apiKey_check($data->apiKey))){echo "api salah"; break;}
		
		// connect ke database
		$db = new database("localhost", "root", "","test");
		
		//memuat querry sql
		$sql = 'INSERT INTO geotag(DATE, TIME, DAY, COORDINATE, SOG, SOG2, COG) 
			VALUE ("'.$data->DATE.'","'.$data->TIME.'","'.$data->DAY.'","'.$data->COORDINATE.'","'.$data->SOG.'","'.$data->SOG2.'","'.$data->COG.'")';

		// menyambungkan database
		$conn = $db->get_connect();
		
		//menjalankan query
		$result = $conn->query($sql);
		
		
		// cek menjalankan querry
		if ($result == true){
			echo "data terupdate";
		}

		// menutup sambungan database
		$conn->close();
		
		break;
		
	default:
		throw new Exception('Method Not Supported', 405);
	}
	
	break;
	
	
case 'insert-underwater-pict':
	
	// cek apakah metede request sesuai
	switch($verb){
	case 'POST':
		
		$path= $_SERVER["DOCUMENT_ROOT"].'/'.'img/under-water';
		$apiKey= $_POST["apiKey"];

		//cek apiKEY
		if(!(apiKey_check($apiKey))){echo "api salah"; return 0;}

		//cek file berisi
		if($_FIlES["file1"]["error"]){echo "file tidak ada"; return 0;}

		//parsing data file
		$file1name= basename($_FILES["file1"]["name"]);
		$file1tmp= $_FILES["file1"]["tmp_name"];
		$filename= $path.'/'.$file1name;


		//cek apakah file sudah ada
		if(file_exists($filename)){echo "file sudah ada"; return 0;}

		//upload file
		$up = move_uploaded_file($file1tmp, $filename);

		//cek upload berhasil
		if($up){echo "berhasil upload";}else{echo "gagal upload";}

		
	break;
		
	default:
		throw new Exception('Method Not Supported', 405);
	}
		
	
	break;
	
case 'insert-surfacewater-pict':

	// cek apakah metode request sesuai
	switch($verb){
	case 'POST':
	
		$path= $_SERVER["DOCUMENT_ROOT"].'/'.'img/surface-water';
		$apiKey= $_POST["apiKey"];

		//cek apiKEY
		if(!(apiKey_check($apiKey))){echo "api salah"; return 0;}

		//cek file berisi
		if($_FIlES["file1"]["error"]){echo "file tidak ada"; return 0;}

		//parsing data file
		$file1name= basename($_FILES["file1"]["name"]);
		$file1tmp= $_FILES["file1"]["tmp_name"];
		$filename= $path.'/'.$file1name;


		//cek apakah file sudah ada
		if(file_exists($filename)){echo "file sudah ada"; return 0;}

		//upload file
		$up = move_uploaded_file($file1tmp, $filename);

		//cek upload berhasil
		if($up){echo "berhasil upload";}else{echo "gagal upload";}

		
		
		break;
	
	default:
		throw new Exception('Method Not Supported', 405);
	}
	
	
	break;
	
default :
		throw new Exception('URI WRONG', 403);
}

clearstatcache();

?>
