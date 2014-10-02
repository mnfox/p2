<!DOCTYPE HTML>
<html>
	<head>
		<title>CSCI E-15 P2</title>
		<meta "charset=utf-8" />
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
		</noscript>

		<?php
			// fn to generate password
			function generate_pw($num_words, $num_special)
			{
				// set up special chars (can be expanded upon later)
				$spec_chars = array("!", "@", "#", "*", "+");
				$char_count = count($spec_chars);
				
				// set up words; from file of 10000 most common words
				$line_max = 0;
				$myfile = fopen("wordlist.txt", "r");
				if ($myfile) 
				{
					while (!feof($myfile)) 
					{
						// put all words in array
	   					$lines[] = trim(fgets($myfile));
	   					$line_max++;
					}
				}
				// close file
				fclose($myfile);
				
				// build pw
				for ($i = 0; $i < $num_words; $i++)
				{
					// pick a random word from file
					$rand_words = rand(0, $line_max);
					$password = $password . $lines[$rand_words];
					
					// if not last word of pw...
					if ($i != ($num_words - 1))
					{
						// add a hyphen
						$password = $password . "-";
					}
					// if it's the last word
					else
					{	
						// add in any request special chars
						for ($j = 0; $j < $num_special; $j++)
						{
							$rand_char = rand(0, ($char_count - 1));
							$password = $password . $spec_chars[$rand_char];
						}
						// and add numbers if requested
						if (array_key_exists('num_opt', $_GET))
						{
							$password = $password . rand(0, 99);
						}				
					}
				}

				return $password;
			}

			// if empty, generate random pw
			if (empty($_GET))
			{
				$password = generate_pw(rand(1,9), rand(0,3));
			}
			// if a non-int is entered
			else if(!(ctype_digit($_GET["num_words"])) or !(ctype_digit($_GET["num_special"])))
			{
				$password = "please enter integers to continue";
			}
			// if more than 9 words requested, show error
			else if($_GET["num_words"] > 9)
			{
				$password = "sorry, this exceeds maximum number of words";
			}
			// if more than 3 special chars requested, show error
			else if($_GET["num_special"] > 3)
			{
				$password = "sorry, this exceeds maximum number of special characters";
			}
			// otherwise... run normally!
			else
			{
				$password = generate_pw($_GET["num_words"], $_GET["num_special"]);
			}	
		?>

	</head>
	<body class="index">		
		<article id="main">
			<header class="special container">
				<h2>XKCD Password Generator</h2>
				<hr/>
				<img src="images/xkcd.png" alt="XKCD Password Comic">
				<p>To generate your very own xkcd password, check out the form below!</p>
			</header>
		<section class="wrapper style2 container special-alt">
			<header>
				<h2>Your password is...</h2>
				<p><?php echo $password; ?></p>
			</header>
			<div class="content">
				<form method="GET" action="index.php">
					<div class="row half collapse-at-2">
						<div class="6u">
							<input type="text" name="num_words" placeholder="Number of Words (max 9)" value="<?php echo $_GET['num_words'] ?>" />
						</div>
						<div class="6u">
							<input type="text" name="num_special" placeholder="Number of Special Characters (max 3)" value="<?php echo $_GET['num_special'] ?>"/>
						</div>
					</div>
					<div class="row">
						<div class="12u">
							<div class="checkbox-font">
								<input type="checkbox" name="num_opt" <?php if(array_key_exists('num_opt', $_GET)) echo "checked"; ?> />Include numbers?
							</div>
						</div>
					</div>
					<div class="row">
						<div class="12u">
							<ul class="buttons">
								<li><input type="submit" class="special" value="Generate Another Password" /></li>
							</ul>
						</div>
					</div>
				</div>
			</form>
		</section>
	</body>
</html>