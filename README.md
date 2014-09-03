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

  3. Configure the `rg_uservoice` service in your config.yml:

        rg_uservoice:
            key: XXXX


That's it for basic configuration.

Usage
=====

In your template:

    {% include "UserVoiceBundle::uservoice.html.twig" %}

In your controllers:

    $userVoiceOptions = $this->container->get('rg_uservoice_options');
    $userVoiceOptions["userId"] = $this->getUser()->getUsername();

Available UserVoice options:

    - primary_color: #123456 (default: #2c3233)
    - link_color: #123456 (default: #007cbf)

TODO:

    - Add support for SSO

Overriding the template
=======================

You can override the template used by copying the
`Resources/views/uservoice.html.twig` file out of the bundle and placing it
into `app/Resources/RGUserVoiceBundle/views`, then customising
as you see fit.
