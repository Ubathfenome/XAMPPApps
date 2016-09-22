<html>
	<head>
		<title>XAMPP Server's webpages</title>
		<style>
			body{
				background-color: white;
				margin: auto;
				font-size: 200%;
				text-align: center;
				position: relative;
				padding: 1%;
				padding-top: 5%;
			}
			div#content {
				font-size: 50%;
				font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
			}
			li {
				list-style-type: none;
				border: 1px solid #ddd;
				padding: 1%;
				background-color: darkgrey;
			}
			li:hover {
				background-color: lightgrey;
				box-shadow: inset 5px 5px 10px grey;
			}
		</style>
	</head>
	<body>
		<div id="content">
			<h1>XAMPP Server's Webpages</h1>
			
			<?php
				$hostname = "PT5119";
				$dir = "../";
				$file = fopen("./blacklist.txt", "r");
				$list = scandir($dir);
				
				if($file){
					while(($buffer = fgets($file, 1024)) !== false) {
						$needle = explode("\r\n", $buffer);
						$value = array_search($needle[0], $list, TRUE);
						
						if($value >= 0){
							unset($list[$value]);
						}
					}				
					if(!feof($file)){
						echo "Error: Unexpected failure on fgets()\n";
					}
					fclose($file);
				} else {
					echo "Error: File not found\n";
				}
				
				echo "<h2>".count($list)." webpages found!</h2>\n";
				
				echo "<ul>\n";
				foreach($list as $key => $value){
					echo "<a href=\"http://$hostname/$value\"><li style=\"\">$value</li></a>";
				}
				echo "</ul>\n";
			?>
		</div>
	</body>
</html>