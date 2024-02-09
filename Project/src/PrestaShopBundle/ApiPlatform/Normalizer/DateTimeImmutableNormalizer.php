<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

declare(strict_types=1);

namespace PrestaShopBundle\ApiPlatform\Normalizer;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Normalize DateTimeImmutable properties.
 */
#[AutoconfigureTag('prestashop.api.normalizers')]
class DateTimeImmutableNormalizer implements DenormalizerInterface, CacheableSupportsMethodInterface
{
    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        return new \DateTimeImmutable($data);
    }

    public function supportsDenormalization($data, string $type, string $format = null)
    {
        return \DateTimeImmutable::class === $type;
    }

    /**
     * This denormalizer supports method only depends on the type, so it is cacheable.
     * Careful if it is one day turned into a normalizer as well the supports methods must depend on the format
     * only, or it won't be cacheable anymore and this value should be changed.
     *
     * {@inheritDoc}
     */
    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }

    /**
     * Set higher priority than ObjectDenormalizer.
     *
     * @return int
     */
    public static function getNormalizerPriority(): int
    {
        return 10;
    }
}
