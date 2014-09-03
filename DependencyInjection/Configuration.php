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
        $rootNode = $treeBuilder->root("rg_user_voice");

        $rootNode->
            children()->
                scalarNode("widget_key")->end()->
                scalarNode("primary_color")->end()->
                scalarNode("link_color")->end()->
                scalarNode("domain")->end()->
                scalarNode("sso_key")->end()->
            end()
        ;

        return $treeBuilder;
    }
}
