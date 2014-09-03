<?php

namespace RG\UserVoiceBundle;

use Symfony\Component\DependencyInjection\ContainerInterface;

use Locale;
use UserVoice\SSO;

class UserVoiceHelper
{
    private static function getUser(ContainerInterface $container)
    {
        if (!$container->has('security.context'))
            throw new \LogicException('The SecurityBundle is not registered in your application.');

        if (null === $token = $container->get('security.context')->getToken())
            return null;

        if (!is_object($user = $token->getUser()))
            return null;

        return $user;
    }

    public static function generateSso(ContainerInterface $container, $displayName)
    {
        // https://developer.uservoice.com/docs/single-sign-on/single-sign-on/
        $supportedLocales = array(
            'ar', 'bg', 'cn', 'cz', 'da',
            'de', 'en', 'es', 'et', 'fi',
            'fr', 'fr-CA', 'he', 'hr', 'it',
            'ja', 'lv', 'nl', 'no_NB', 'pl',
            'pt', 'pt_BR', 'ro', 'ru', 'sk',
            'sl', 'sr', 'sr-Latn', 'sv-SE',
            'tr', 'zh-TW'
        );

        // Deduce the best locale according to UserVoice constraints
        $currentLocale = $container->get('request')->getLocale();
        $locale = Locale::lookup($supportedLocales, $currentLocale, true, 'en');

        // Read configuration
        $domain = UserVoiceHelper::getParameter($container, 'domain');
        $ssoKey = UserVoiceHelper::getParameter($container, 'sso_key');
        if (!$ssoKey || !$domain)
            return null;

        // Assume the user_id is email based
        $user = UserVoiceHelper::getUser($container);
        if (!$user)
            return null;

        $userId = $user->getUsername();
        $ssoToken = SSO::generate_token($domain, $ssoKey, array(
            'guid' => $userId,
            'display_name' => $displayName,
            'email' => $userId,
            'locale' => $locale
        ));

        return $ssoToken;
    }

    public static function getParameter(ContainerInterface $container, $key, $default = null)
    {
        if (!$container->hasParameter('rg_user_voice.' . $key))
            return $default;

        return $container->getParameter('rg_user_voice.' . $key);
    }

    public static function getOption(ContainerInterface $container, $key, $default = null)
    {
        $userVoiceOptions = $container->get('rg_user_voice_options');
        if (!isset($userVoiceOptions[$key]))
            return $default;

        return $userVoiceOptions[$key];
    }
}
