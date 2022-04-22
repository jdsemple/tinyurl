<?php include("includes/form.inc.php"); ?>
<?php include("includes/database.inc.php"); ?>
<?php
  $subdir = form('subdir');
  writestats($subdir); // save stats to db
  if ($subdir != null || $subdir != '') {
    $url = $subdir.'.com';
    header('Location: https://www.' . $url);
    exit();
  }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Contextual Tiny URLs</title>
</head>
<body>

<h1>Vanity URL shortener</h1>

<p>
<a href="https://linktr.ee/" target="_blank">Linktree</a> has become insanely popular for social links. By using something like this as an "ad server" to track user engagement, clicks and expand on it with nice styling and a user profile database linked to the ads "sub-domain" could be neat, or simply a URL redirect (soft in JavaScript) or hard (301) redirect could also be a nice feature to store engagement stats (or web analytics) while playing "traffic cop" as a typical URL shortener would do.<br />
<br />
For this example (using subdomains), we're going to just display the "debugging" information (if you did not include a sub-directory), plus.. you can expand on it further as a built-to-suit for your own project needs.<br />

<p>
Try this: <a href="http://hello.ads.sempleventures.com">hello.ads.sempleventures.com</a>
</p>

<?php
$subdomain = grabsubdomain();

echo 'Full Hostname: '.$_SERVER["HTTP_HOST"].'<br />';
echo 'Root Hostname: '.$_SERVER["SERVER_NAME"].'<br />';
echo 'Sub-Domain ("Ad-ID" Clicked): '.$subdomain.'<br />';
?>

<h3>(with .com domain context)</h3>
Also, for context.. you can add a sub-directory like /car -> redirect (302 temporary) to car.com, also try /tesla too! I decided against using certbot (Let's Encrypt) for SSL to keep it uncomplicated for someone to implement this on their own server.<br />

</p>

<br />

<br /><br /><br />

</body>
</html>
<?php
function grabsubdomain() {
  list($subdomain,$ads) = explode('.', $_SERVER["HTTP_HOST"]);
  return $subdomain;
}
function writestats($subdir = '') {
  $subdomain = grabsubdomain();
  $hostip = $_SERVER['REMOTE_ADDR'];
	$con = opendb();
	$result1 = query($con, "INSERT INTO `clicks` (Account, Counter, LastMod, LastIP, TinyURL) VALUES ('".$subdomain."', 1, CURRENT_TIMESTAMP, '".$hostip."', '".$subdir."') ON DUPLICATE KEY UPDATE Counter = Counter + 1, LastMod = CURRENT_TIMESTAMP, LastIP = '".$hostip."', TinyURL = '".$subdir."';");
	closedb($con);
}
?>
