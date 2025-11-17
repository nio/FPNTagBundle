<?php

/*
 * This file is part of the FPNTagBundle package.
 * (c) 2011 Fabien Pennequin <fabien@pennequin.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FPN\TagBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * @see Symfony\Component\Config\Definition\ConfigurationInterface
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $builder = new TreeBuilder('fpn_tag');
        $rootNode = method_exists('Symfony\Component\Config\Definition\Builder\TreeBuilder', 'getRootNode') ? $builder->getRootNode() : $builder->root('fpn_tag');

        $rootNode
            ->children()
                ->arrayNode('model')
                    ->isRequired()
                    /*throws error with sf4 */
                    /*->cannotBeEmpty()*/
                    ->children()
                        ->scalarNode('tag_class')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('tagging_class')->isRequired()->cannotBeEmpty()->end()
                    ->end()
                ->end()
                ->arrayNode('service')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('slugifier')->defaultValue('fpn_tag.slugifier.default')->cannotBeEmpty()->end()
                    ->end()
                ->end()
            ->end();

        return $builder;
    }
}
