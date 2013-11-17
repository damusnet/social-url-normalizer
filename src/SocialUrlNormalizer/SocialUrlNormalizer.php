<?php

namespace SocialUrlNormalizer;

class SocialUrlNormalizer
{
	public function getUrlProperties($url = '', $social_network = false)
	{
		if (!SocialUrlNormalizer::isValid($url)) {
			return false;
		}
		if (!$social_network) {
			$social_network = SocialUrlNormalizer::guessSocialNetwork($url);
		}
		if (!$social_network) {
			return false;
		}
		$function = 'get' . ucfirst($social_network) . 'Username';
		$username = SocialUrlNormalizer::$function($url);
		return array('social_network' => $social_network, 'username' => $username);
	}

	/**
	 * isValid
	 *
	 * @return bool
	 */
	public function isValid($url = '')
	{
		if (filter_var($url, FILTER_VALIDATE_URL)) {
			return true;
		} else {
			return false;
		}
	}

	public function guessSocialNetwork($url = '')
	{
		$socialNetworks = array('facebook', 'twitter', 'youtube', 'linkedin');
		foreach ($socialNetworks as $socialNetwork) {
			if (strpos($url, $socialNetwork)) {
				return $socialNetwork;
			}
		}
		return false;
	}

	public function getFacebookUsername($url = '')
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
			$url
		);
	}

	public function getTwitterUsername($url = '')
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
			$url
		);
	}

	public function getYoutubeUsername($url = '')
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
			$url
		);
	}

	public function getLinkedinUsername($url = '')
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
			$url
		);
	}
}