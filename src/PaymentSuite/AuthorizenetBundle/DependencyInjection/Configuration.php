<?php

/**
 * This file is part of the PaymentSuite package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 * @author Marc Morera <yuhu@mmoreram.com>
 */

namespace PaymentSuite\AuthorizenetBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('authorizenet');

        $rootNode->children()
            ->scalarNode('login_id')
                ->isRequired()
                ->cannotBeEmpty()
            ->end()
            ->scalarNode('tran_key')
                ->isRequired()
                ->cannotBeEmpty()
            ->end()
                ->scalarNode('test_mode')
                ->defaultValue('true')
            ->end()
            ->scalarNode('controller_route')
                ->defaultValue('/payment/authorizenet/execute')
            ->end()
            ->arrayNode('payment_success')
                ->children()
                    ->scalarNode('route')
                        ->isRequired()
                        ->cannotBeEmpty()
                    ->end()
                    ->booleanNode('order_append')
                        ->defaultTrue()
                    ->end()
                    ->scalarNode('order_append_field')
                        ->defaultValue('order_id')
                    ->end()
                ->end()
            ->end()
            ->arrayNode('payment_fail')
                ->children()
                    ->scalarNode('route')
                        ->isRequired()
                        ->cannotBeEmpty()
                    ->end()
                    ->booleanNode('order_append')
                        ->defaultTrue()
                    ->end()
                    ->scalarNode('order_append_field')
                        ->defaultValue('order_id')
                    ->end()
                ->end()
            ->end()
        ->end();

        return $treeBuilder;
    }
}
