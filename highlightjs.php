<?php
namespace Grav\Plugin;

use \Grav\Common\Plugin;
use \Grav\Common\Grav;
use \Grav\Common\Page\Page;

class HighlightjsPlugin extends Plugin
{
    protected $active = false;

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    /**
     * Initialize configuration
     */
    public function onPluginsInitialized()
    {
        if ($this->isAdmin()) {
            $this->active = false;
            return;
        }

        $this->enable([
            'onPageInitialized' => ['onPageInitialized', 0]
        ]);
    }

    /**
     * Initialize configuration
     */
    public function onPageInitialized()
    {
        $defaults = (array) $this->config->get('plugins.highlightjs');

        /** @var Page $page */
        $page = $this->grav['page'];
        if (isset($page->header()->highlightjs)) {
            $this->config->set('plugins.highlightjs', array_merge($defaults, $page->header()->highlightjs));
        }

        $this->active = $this->config->get('plugins.highlightjs.active');

        if ($this->active) {
            $this->enable([
                'onTwigSiteVariables' => ['onTwigSiteVariables', 0]
            ]);
        }
    }

    /**
     * if enabled on this page, load the JS + CSS theme.
     */
    public function onTwigSiteVariables()
    {
        $config = $this->config->get('plugins.highlightjs');

        $customCss = "
            .hljs {
                background: transparent;
            }
            pre code {
                color: #444;
            }
        ";

        $this->grav['assets']
             ->addCss('https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.0.0/styles/default.min.css')
             ->addInlineCss($customCss)
             ->add('jquery', 101)
             ->addJs('https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.0.0/highlight.min.js')
             ->addJs('plugin://highlightjs/js/activate.js');

        if (isset($config["languages"])) {
            foreach ($config["languages"] as $lang) {
                $this->grav['assets']->addJs("https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.0.0/languages/{$lang}.min.js");
            }
        }
    }
}
