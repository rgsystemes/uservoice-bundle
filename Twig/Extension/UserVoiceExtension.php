<?php

namespace RG\UserVoiceBundle\Twig\Extension;

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
            "rg_uservoice_key" => new \Twig_Function_Method($this, "getUserVoiceKey", array("is_safe" => array("html"))),
            "rg_uservoice_option" => new \Twig_Function_Method($this, "getUserVoiceOption", array("is_safe" => array("html"))),
        );
    }

    /**
     * Returns the UserVoice key
     *
     * @return string
     */
    public function getUserVoiceKey()
    {
        // If a branded key is defined
        $brandedKey = $this->getUserVoiceOption('branded_key');
        if (!is_null($brandedKey)) {
            // If the defined branded key is an empty string, it means
            // we don't wanna use the one given in the configuration file
            if (strlen($brandedKey) == 0)
                return null;

            // But if it's not an empty string, it means we want to overload the
            // given one in the configuration file
            return $brandedKey;
        }

        // If there's no support for branded uservoice key, we simply use the configuration file
        if ($this->container->hasParameter('rg_uservoice.key'))
            return $this->container->getParameter('rg_uservoice.key');

        // There's no support for uservoice detected !
        return null;
    }

    /**
     * Returns an UserVoice option
     *
     * @return string
     */
    public function getUserVoiceOption($key, $default = null)
    {
        $userVoiceOptions = $this->container->get('rg_uservoice_options');
        if (!isset($userVoiceOptions[$key]))
            return $default;

        return $userVoiceOptions[$key];
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
