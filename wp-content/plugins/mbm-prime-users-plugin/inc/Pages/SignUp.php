<?php

namespace Inc\Pages;

class SignUp
{
    public $pageName = 'Sign Up';

    public function register()
    {
        add_filter('page_template', [$this, 'definePageTemplate']);
    }

    // Asigna el template que se quiere usar a la pagina
    public function definePageTemplate($page_template)
    {
        if (is_page('sign-up')) {
            $page_template = PLUGIN_PATH . '/templates/signup.php';
        }
        return $page_template;
    }

    // Crea la pagina al activar el plugin
    public function createPage()
    {
        if (get_page_by_title($this->pageName) === NULL) {
            $content = "<h1>Hola</h1>";
            $pageData = [
                'post_title' => $this->pageName,
                'post_name' => $this->pageName,
                'post_content' => "Hola como va?",
                'post_status' => 'publish',
                'post_type' => 'page',
                'page_template' => 'Custom Sign Up'
            ];

            $insertPage = wp_insert_post($pageData);
        }
    }
}
