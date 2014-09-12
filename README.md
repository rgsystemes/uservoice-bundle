Introduction
============

Easily integrate [UserVoice](https://www.uservoice.com) into your Symfony2 projects.

Installation
============

  1. Add this bundle to your vendor/ dir using the vendors script:

    Add the following to your `composer.json`:

        "rgsystemes/uservoice-bundle": "dev-master"

    and run:

        php composer.phar install

    The bundle is compatible with Symfony 2.0 upwards.


  2. Add this bundle to your application's kernel:

        // app/AppKernel.php
        public function registerBundles()
        {
            return array(
                // ...
                new RG\UserVoiceBundle\RGUserVoiceBundle(),
                // ...
            );
        }

  3. Configure the `rg_user_voice` service in your config.yml:

        rg_user_voice:
            domain: %uservoice_domain%
            sso_key: %uservoice_sso_key%
            widget_key: %uservoice_widget_key%
            primary_color: %uservoice_primary_color%
            link_color: %uservoice_link_color%
            forum_id: %uservoice_forum_id%


That's it for basic configuration.

Usage
=====

In your template, you can include the widget:

    {% include "UserVoiceBundle::widget.html.twig" %}

In your controllers:

    $userVoiceOptions = $this->container->get('rg_uservoice_options');
    $userVoiceOptions["disabled"] = !$this->getUser()->getAccount()->isUserVoiceEnabled();

Available UserVoice options:

    - disabled: true (default: false)

It is also possible to generate your SSO token from a Twig template:

    <a href="http://domain.uservoice.com/knowledgebase?sso={{ rg_uservoice_sso(app.user.name) }}">

Overriding the template
=======================

You can override the template used by copying the
`Resources/views/widget.html.twig` file out of the bundle and placing it
into `app/Resources/RGUserVoiceBundle/views`, then customising
as you see fit.
