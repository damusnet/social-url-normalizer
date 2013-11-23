<?php

class SocialUrlNormalizerFixture
{

	public function socialNetworksUrls()
	{
		return array(
			'https://www.facebook.com/username' => array(
				'social_network' => 'facebook',
				'username' => 'username'
			),
			'https://twitter.com/username' => array(
				'social_network' => 'twitter',
				'username' => 'username'
			),
			'https://www.youtube.com/user/username' => array(
				'social_network' => 'youtube',
				'username' => 'username'
			),
			'https://www.linkedin.com/company/12345' => array(
				'social_network' => 'linkedin',
				'username' => '12345'
			),
		);
	}
	public function facebookUrls()
	{
		return 	array(
			'https://www.facebook.com/username' => 'username',
			'http://www.facebook.com/username' => 'username',
			'www.facebook.com/username' => 'username',
			'facebook.com/username' => 'username',
			'username' => 'username',
			'http://www.facebook.com/#!/username' => 'username',
			'http://www.facebook.com/pages/Paris-France/Vanity-Url/123456?v=app_555' => '123456',
			'http://www.facebook.com/pages/Vanity-Url/45678' => '45678',
			'http://www.facebook.com/#!/page_with_1_number' => 'page_with_1_number',
			'http://www.facebook.com/bounce_page#!/pages/Vanity-Url/45678' => '45678',
			'http://www.facebook.com/bounce_page#!/username?v=app_166292090072334' => 'username',
			'http://www.facebook.com/my.page.is.great' => 'my.page.is.great',
		);
	}

	public function twitterUrls()
	{
		return 	array(
			'https://www.twitter.com/username' => 'username',
			'https://twitter.com/username' => 'username',
			'https://twitter.com/user_name' => 'user_name',
			'https://twitter.com/username42' => 'username42',
			'https://twitter.com/user_name_42' => 'user_name_42',
			'http://twitter.com/username' => 'username',
			'http://twitter.com/#!/username' => 'username',
			'twitter.com/username' => 'username',
			'@username' => 'username',
			'username' => 'username',
		);
	}

	public function youtubeUrls()
	{
		return 	array(
			'https://www.youtube.com/user/username' => 'username',
			'http://www.youtube.com/user/username' => 'username',
			'http://youtube.com/user/username' => 'username',
			'http://youtube.com/username' => 'username',
			'youtube.com/user/username' => 'username',
			'/user/username' => 'username',
			'user/username' => 'username',
			'username' => 'username',
		);
	}

	public function linkedinUrls()
	{
		return 	array(
			'https://www.linkedin.com/company/12345' => '12345',
			'http://linkedin.com/company/12345' => '12345',
			'company/12345' => '12345',
			'12345' => '12345',
		);
	}
}