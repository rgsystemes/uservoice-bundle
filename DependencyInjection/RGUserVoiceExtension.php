<?php

namespace RG\UserVoiceBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;

class RGUserVoiceExtension extends Extension
{
    /**
     * Loads our service, accessible as "rg_uservoice"
     *
     * @param  array            $configs
     * @param  ContainerBuilder $container
     * @return void
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $this->loadConfiguration($configs, $container);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('uservoice.xml');
    }

    /**
     * Loads the configuration in, with any defaults
     *
     * @param array $configs
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    protected function loadConfiguration(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        if (isset($config["key"]))
            $container->setParameter("rg_uservoice.key", $config["key"]);

        if (isset($config["primary_color"]))
            $container->setParameter("rg_uservoice.primary_color", $config["primary_color"]);

        if (isset($config["link_color"]))
            $container->setParameter("rg_uservoice.link_color", $config["link_color"]);
    }
}
