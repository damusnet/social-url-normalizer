<?php

use SocialUrlNormalizer\SocialUrlNormalizer;

require 'SocialUrlNormalizerFixture.php';

class SocialUrlNormalizerTest extends PHPUnit_Framework_TestCase
{
	public function testGetUrlProperties()
	{
		$this->assertEquals(SocialUrlNormalizer::getUrlProperties(
			'https://www.facebook.com/username'),
			array('social_network' => 'facebook', 'username' => 'username')
		);
	}

	public function testValidUrl()
	{
		$valid_url = 'https://www.facebook.com/username';
		$this->assertTrue(SocialUrlNormalizer::isValid($valid_url));
	}

	public function testNotValidUrl()
	{
		$not_valid_url = 'foobar';
		$this->assertFalse(SocialUrlNormalizer::isValid($not_valid_url));
	}

	public function testGuessSocialNetwork()
	{
		$social_network_urls = SocialUrlNormalizerFixture::socialNetworksUrls();
		foreach ($social_network_urls as $url => $social_network) {
			$this->assertEquals(SocialUrlNormalizer::guessSocialNetwork($url), $social_network);					
		}
	}

	public function testGetFacebookUsername()
	{
		$facebook_urls = SocialUrlNormalizerFixture::facebookUrls();
		foreach ($facebook_urls as $url => $expected) {
			$this->assertEquals(SocialUrlNormalizer::getFacebookUsername($url), $expected);
		}
	}

	public function testGetTwitterUsername()
	{
		$twitter_urls = SocialUrlNormalizerFixture::TwitterUrls();
		foreach ($twitter_urls as $url => $expected) {
			$this->assertEquals(SocialUrlNormalizer::getTwitterUsername($url), $expected);
		}
	}

	public function testGetYoutubeUsername()
	{
		$youtube_urls = SocialUrlNormalizerFixture::YoutubeUrls();
		foreach ($youtube_urls as $url => $expected) {
			$this->assertEquals(SocialUrlNormalizer::getYoutubeUsername($url), $expected);
		}
	}

	public function testGetLinkedinUsername()
	{
		$linkedin_urls = SocialUrlNormalizerFixture::LinkedinUrls();
		foreach ($linkedin_urls as $url => $expected) {
			$this->assertEquals(SocialUrlNormalizer::getLinkedinUsername($url), $expected);
		}
	}
}