<?php
require_once(__DIR__."/vendor/autoload.php");

function usageError($msg) {
    print "Usage: {$argv[0]} <unsplashid>\n\n";
    print "{$msg}\n\n"; 
    exit(0);
}

function getSizedUrl($photoresult, $width, $sizename) {
    $url =  $photoresult->urls['regular'];
    $id =  $photoresult->id;

    $pu = parse_url($url);
    parse_str($pu['query'], $qs);
    $qs['w'] = $width;
    $ext = $qs['fm'];

    $ret = "{$pu['scheme']}://{$pu['host']}{$pu['path']}?".http_build_query($qs);
    $newname = "{$id}-x-{$sizename}.{$ext}";
    return [$ret, $newname];
}

function writeImage($url, $filename) {
    // create directory
    $date = new \DateTime("now");
    $year = $date->format("Y");
    $dir = __DIR__."/../wp-content/uploads/{$year}";
    $urlpath= "/wp-content/uploads/{$year}";
    $newurl = "{$urlpath}/{$filename}";
    if (! file_exists($dir)) {
        mkdir($dir, 0755, true);
    }

    chdir($dir);
    $contents = file_get_contents($url);
    file_put_contents($filename, $contents);
    return $newurl;
}


$conf = __DIR__. "/toolsconf.json";
if (! file_exists($conf)) {
	die("no conf at $conf");
}

$confvals = json_decode(file_get_contents($conf), true);
Unsplash\HttpClient::init([
	'applicationId'	=> $confvals['unsplash']['access'],
	'secret'	=> $confvals['unsplash']['secret'],
	'callbackUrl'	=> $confvals['unsplash']['callback'],
	'utmSource' => $confvals['unsplash']['appname'],
]);


if (! isset($confvals['unsplash']['access']) ||
	! isset($confvals['unsplash']['secret']) ||
	! isset($confvals['unsplash']['callback']) ||
	! isset( $confvals['unsplash']['appname']) 
) {
    usageError("expecting config values for unsplash: access, secret, callback, appneam");
}

if (count($argv) < 2) {
    usageError("too few arguments");
}

$id = $argv[1];
//$id = "HsTnjCVQ798";
$photo = Unsplash\Photo::find($id);
//print_r($photo);

/*
Photo by <a href="https://unsplash.com/@sigmund?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Sigmund</a> on <a href="https://unsplash.com/s/photos/testing?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a>
*/  

$username =  $photo->user['username'];
$name =  $photo->user['name'];
#print "Photo by ";
$attrib = <<<ATTRIB
*Photo by <a href="https://unsplash.com/@{$username}?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">{$name}</a> on <a href="https://unsplash.com/?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a>*
ATTRIB;

[$newurlsmall, $filenamesmall] = getSizedUrl($photo, 400, "small");
$finishedurlsmall = writeImage($newurlsmall, $filenamesmall);  
[$newurlmedium, $filenamemedium] = getSizedUrl($photo, 800, "med");
$finishedurlmedium = writeImage($newurlmedium, $filenamemedium);  
[$newurllarge, $filenamelarge] = getSizedUrl($photo, 1023, "large");
$finishedurllarge = writeImage($newurllarge, $filenamelarge);  

print $finishedurlsmall;
print "\n";

print $finishedurlmedium;
print "\n";

print $finishedurllarge;
print "\n";

print "![$photo->description]($finishedurllarge)";
print "\n";
print "image: {$finishedurlmedium}";
print "\n";
print "teaser: {$finishedurlsmall}";
print "\n";
print $attrib;
print "\n\n";
