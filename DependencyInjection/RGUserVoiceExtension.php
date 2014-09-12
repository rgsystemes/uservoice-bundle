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

        if (isset($config["widget_key"]))
            $container->setParameter("rg_user_voice.key", $config["widget_key"]);

        if (isset($config["primary_color"]))
            $container->setParameter("rg_user_voice.primary_color", $config["primary_color"]);

        if (isset($config["link_color"]))
            $container->setParameter("rg_user_voice.link_color", $config["link_color"]);

        if (isset($config["sso_key"]))
            $container->setParameter("rg_user_voice.sso_key", $config["sso_key"]);

        if (isset($config["domain"]))
            $container->setParameter("rg_user_voice.domain", $config["domain"]);

        if (isset($config["forum_id"]))
            $container->setParameter("rg_user_voice.forum_id", $config["forum_id"]);
    }
}
