<!DOCTYPE html>
<html>
	<head>
		<title>MENGACAK SANDI </title>
		
	</head>
	<body>
    <form action ="<?php $_PHP_SELF ?>" method="post">
			<input type="text" name="ketik" value=<?=
                isset($_POST["ketik"])?$_POST["ketik"] : ''
                ?>><br>
            <select name="type">
            <option value="encrypt">encrypt</option>
            <option value="decrypt">decrypt</option>        
</select>
            <button type="submit" >
                submit
    </button>



		<?php 

        function ipanAlgorithm($kata, $type= 'encrypt') {
            $sandi = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';//tabel 1
            $posisiHuruf = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            if($type === 'decrypt') {//sama kata dan type
                $sandi = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';// tabel 2
                $posisiHuruf = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            }
            
            $sandiArray = str_split($sandi); // string $sandi menjadi array
            $posisiHurufArray = str_split($posisiHuruf);// string $posisiHuruf menjadi array

            $kataArray = str_split($kata);
            $newKataArray = [];
            for ($i=0; $i < count($kataArray); $i++) { 
               $key=  ipanjoleArraySearch($kataArray[$i], $posisiHurufArray);
               if($key > -1) {
                   array_push($newKataArray, $sandiArray[$key]);
               }
            }

            return implode('', $newKataArray);
        }

        function ipanjoleArraySearch($stringnya, $arraynya) {
            $keyIndex = -1;
            for ($i=0; $i < count($arraynya); $i++) { 
                if($stringnya === $arraynya[$i]) {
                    $keyIndex = $i;
                }
            }

            return $keyIndex;
        }

       

        // print_r(ipanAlgorithm('ABAH'));
        // echo '<br>';
        // print_r(ipanAlgorithm('0107', 'decrypt'));

        if (isset($_POST['ketik'])) {
            $ketik = $_POST['ketik'];
            echo ipanAlgorithm($ketik,$_POST['type']);
        }
        
		?>
	
		</form>
	</body>
</html>