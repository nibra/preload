<?php
/**
 * Part of the Joomla Framework Preload Package
 *
 * @copyright  Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Joomla\Preload\Service;

use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Joomla\Preload\EventListener\PreloadSubscriber;
use Joomla\Preload\PreloadManager;

/**
 * Service provider for preload package services
 *
 * @since  __DEPLOY_VERSION__
 */
class PreloadProvider implements ServiceProviderInterface
{
	/**
	 * Registers the service provider with a DI container.
	 *
	 * @param   Container  $container  The DI container.
	 *
	 * @return  void
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function register(Container $container)
	{
		$container->share(
			PreloadManager::class,
			function ()
			{
				return new PreloadManager;
			}
		);

		$container->share(
			PreloadSubscriber::class,
			function (Container $container)
			{
				return new PreloadSubscriber(
					$container->get(PreloadManager::class)
				);
			}
		);

		$container->tag('event.subscriber', [PreloadSubscriber::class]);
	}
}