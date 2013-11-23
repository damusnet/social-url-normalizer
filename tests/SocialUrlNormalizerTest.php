<?php

use SocialUrlNormalizer\SocialUrlNormalizer;

require 'SocialUrlNormalizerFixture.php';

class SocialUrlNormalizerTest extends PHPUnit_Framework_TestCase
{
	public function testGetProperties()
	{
		$social_network_urls = SocialUrlNormalizerFixture::socialNetworksUrls();
		foreach ($social_network_urls as $url => $properties) {
			$this->assertEquals($properties, SocialUrlNormalizer::getProperties($url));
		}
	}

	public function testExtractFacebookUsername()
	{
		$facebook_urls = SocialUrlNormalizerFixture::facebookUrls();
		foreach ($facebook_urls as $url => $expected) {
			$this->assertEquals($expected, SocialUrlNormalizer::extractFacebookUsername($url));
		}
	}

	public function testExtractTwitterUsername()
	{
		$twitter_urls = SocialUrlNormalizerFixture::TwitterUrls();
		foreach ($twitter_urls as $url => $expected) {
			$this->assertEquals($expected, SocialUrlNormalizer::extractTwitterUsername($url));
		}
	}

	public function testExtractYoutubeUsername()
	{
		$youtube_urls = SocialUrlNormalizerFixture::YoutubeUrls();
		foreach ($youtube_urls as $url => $expected) {
			$this->assertEquals($expected, SocialUrlNormalizer::extractYoutubeUsername($url));
		}
	}

	public function testExtractLinkedinUsername()
	{
		$linkedin_urls = SocialUrlNormalizerFixture::LinkedinUrls();
		foreach ($linkedin_urls as $url => $expected) {
			$this->assertEquals($expected, SocialUrlNormalizer::extractLinkedinUsername($url));
		}
	}
}