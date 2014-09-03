<?php

namespace RG\UserVoiceBundle\Twig\Extension;

use RG\UserVoiceBundle\UserVoiceHelper;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides an extension for Twig to get the UserVoice information
 */
class UserVoiceExtension extends \Twig_Extension
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array An array of functions
     */
    public function getFunctions()
    {
        return array(
            "rg_uservoice_widget_key" => new \Twig_Function_Method($this, "getUserVoiceWidgetKey", array("is_safe" => array("html"))),
            "rg_uservoice_option" => new \Twig_Function_Method($this, "getUserVoiceOption", array("is_safe" => array("html"))),
            "rg_uservoice_sso" => new \Twig_Function_Method($this, "getUserVoiceSso", array("is_safe" => array("html"))),
        );
    }

    /**
     * Returns the UserVoice key
     *
     * @return string
     */
    public function getUserVoiceWidgetKey()
    {
        if (UserVoiceHelper::getOption($this->container, 'disabled', false))
            return null;

        return UserVoiceHelper::getParameter($this->container, 'key');
    }

    /**
     * Returns an UserVoice option
     *
     * @return string
     */
    public function getUserVoiceOption($key, $default = null)
    {
        return UserVoiceHelper::getOption($this->container, $key, $default);
    }

    /**
     * Decorate the given URL with an UserVoice SSO token
     *
     * @param string $url
     */
    public function getUserVoiceSso($userName)
    {
        return UserVoiceHelper::generateSso($this->container, $userName, $this->getUserVoiceOption('lang', 'en'));
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return "uservoice";
    }
}
