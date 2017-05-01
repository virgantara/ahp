<?php 

require('simple_html_dom.php');
 
// Create DOM from URL or file
$html = file_get_html('https://aws.amazon.com/ec2/pricing/on-demand/');
 
// creating an array of elements
$videos = array();
 
// Find top ten videos
$i = 1;
foreach ($html->find('-od.min.js') as $video) {
        if ($i > 10) {
                break;
        }
 
        // Find item link element 
        $videoDetails = $video->find('a.yt-uix-tile-link', 0);
 
        // get title attribute
        $videoTitle = $videoDetails->title;
 
        // get href attribute
        $videoUrl = 'https://youtube.com' . $videoDetails->href;
 
        // push to a list of videos
        $videos[] = array(
                'title' => $videoTitle,
                'url' => $videoUrl
        );
 
        $i++;
}
 echo '<pre>';
print_r($videos);
echo '</pre>';
?>