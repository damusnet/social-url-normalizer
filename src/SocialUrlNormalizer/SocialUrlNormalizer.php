<?php

namespace SocialUrlNormalizer;

class SocialUrlNormalizer
{
	static $suportedSocialNetworks = array(
		'facebook',
		'twitter',
		'youtube',
		'linkedin'
	);

	/**
	 * getUrlProperties
	 *
	 * @return array
	 */
	public function getProperties($url)
	{
		$social_network = SocialUrlNormalizer::guessSocialNetwork($url);
		$username = SocialUrlNormalizer::extractUsername($url, $social_network);
		return array('social_network' => $social_network, 'username' => $username);
	}

	/**
	 * guessSocialNetwork
	 *
	 * @return string
	 */
	public function guessSocialNetwork($url)
	{
		foreach (SocialUrlNormalizer::$suportedSocialNetworks as $social_network) {
			if (strpos($url, $social_network)) {
				return $social_network;
			}
		}
		// TODO: throw Exception, could not guess Social Network
		return false;
	}

	/**
	 * extractUsername
	 *
	 * @return string
	 */
	public function extractUsername($uri, $social_network)
	{
		if (!in_array($social_network, SocialUrlNormalizer::$suportedSocialNetworks)) {
			// TODO: throw Exception, unsuported Social Network
			return false;
		}
		$extractSocialNetworkUsername = 'extract' . ucfirst($social_network) . 'Username';
		return SocialUrlNormalizer::$extractSocialNetworkUsername($uri);
	}

	/**
	 * extractFacebookUsername
	 *
	 * @return string
	 */
	public function extractFacebookUsername($uri)
	{
		return preg_replace(
			'#'
			. '(?:(?:http|https)://)?'
			. '(?:www.)?'
			. '(?:facebook.com/)?'
			. '(?:(?:\w)*\#!/)?'
			. '(?:pages/)?'
			. '(?:[?\p{L}\-_]*/)?'
			. '(?:[?\w\-_]*/)?'
			. '(?:profile.php\?id=(?=\d.*))?'
			. '([\d\-]*)?'
			. '(?:\?.*)?'
			. '#u',
			'$1',
			$uri
		);
	}

	/**
	 * extractTwitterUsername
	 *
	 * @return string
	 */
	public function extractTwitterUsername($uri)
	{
		return preg_replace(
			'#'
			. '(?:(?:http|https)://)?'
			. '(?:www.)?'
			. '(?:twitter\.com\/)?'
			. '(?:\#!\/)?'
			. '(?:@)?'
			. '([\w]+)'
			. '(?:.*)?'
			. '#',
			'$1',
			$uri
		);
	}

	/**
	 * extractYoutubeUsername
	 *
	 * @return string
	 */
	public function extractYoutubeUsername($uri)
	{
		return preg_replace(
			'#'
			. '(?:(?:http|https)://)?'
			. '(?:www.)?'
			. '(?:youtube.com/)?'
			. '(?:user/)?'
			. '(?:[?\w\-_]*/)?'
			. '(?:\?.*)?'
			. '#u',
			'$1',
			$uri
		);
	}

	/**
	 * extractLinkedinUsername
	 *
	 * @return string
	 */
	public function extractLinkedinUsername($uri)
	{
		return preg_replace(
			'#'
			. '(?:(?:http|https)://)?'
			. '(?:www.)?'
			. '(?:linkedin.com/)?'
			. '(?:company/)?'
			. '(?:[?\&p{L}\-_]*/)?'
			. '(?:\?.*)?'
			. '#u',
			'$1',
			$uri
		);
	}
}