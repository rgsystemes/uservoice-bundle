<?php

namespace RG\UserVoiceBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root("rg_uservoice");

        $rootNode->
            children()->
                scalarNode("key")->end()->
                scalarNode("primary_color")->end()->
                scalarNode("link_color")->end()->
            end()
        ;

        return $treeBuilder;
    }
}
