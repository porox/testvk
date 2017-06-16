<?php
require_once __DIR__ . '/vendor/autoload.php';

$email = "";
$pass  = '';

$page  = file_get_contents("https://oauth.vk.com/token?grant_type=password&client_id=2274003&client_secret=hHbZxrka2uZ6jB1inYsH&username=" . $email . "&password=" . $pass);
$page  = preg_split("/\"/", $page);
//var_dump($page);
$accessToken = $page[3];

$vk = getjump\Vk\Core::getInstance()->apiVersion('5.65')->setToken($accessToken);



$posts = $vk->request('wall.get', [
	'owner_id' =>'',
	'domain' => "flatfeeder",
	'offset' => 0,
	'count'  => 40
])->getResponse();
$parseAttach = function($attachments){
	$result ="";
	foreach ($attachments as $attachment)
	{
		$attachment = (array) $attachment;
		if ($attachment['type'] !='link')
		{
			$attachment[$attachment['type']] =(array) $attachment[$attachment['type']];
			$result .= $attachment['type'].$attachment[$attachment['type']]['owner_id']."_".$attachment[$attachment['type']]['id'].",";
			
		}
	}
	return $result;
};
$result = null;
$count = 1;

foreach($posts as $post)
{
	
	try
	{
		$tmp = $vk->request('wall.post', [
			'owner_id'             => '-34915724',
			'friends_only'         => 0,
			'from_group'           => 1,
			'message'              => $post->text,
			'attachments'          => isset($post->attachments) ? $parseAttach($post->attachments) : "",
			'services'             => "",
			'signed'               => 0,
			'publish_date'         => "",
			'lat'                  => '',
			'long'                 => '',
			'place_id'             => '',
			'post_id'              => '',
			'guid'                 => '',
			'mark_as_ads'          => '',
			'ads_promoted_stealth' => '',
		])->getResponse();
		echo "Пост".$post->id."экспортирован".PHP_EOL;
	}
	catch (Exception $e)
	{
		echo "Запрос не зашёл".PHP_EOL;
		var_dump($tmp);
		var_dump($e);
		if ($e->getCode() == 214)
		{
			throw new Exception('Привышен лимит публикаций 50 постов в день');
		}
	}
}
?>
