<?php
namespace YBoard\Controller;

use YBoard\Abstracts\ExtendedController;

class Preferences extends ExtendedController
{
    public function index()
    {
        $view = $this->loadTemplateEngine();

        $view->display('Preferences');
    }

    public function save()
    {
        $this->validateAjaxCsrfToken();

        if (empty($_POST['set']) || !is_array($_POST['set'])) {
            $this->throwJsonError(400);
        }

        foreach ($_POST['set'] as $key => $val) {
            $this->user->preferences->set($key, $val);
        }
    }

    public function toggleDarkTheme()
    {
        $this->validateAjaxCsrfToken();
        $this->user->preferences->set('darkTheme', !$this->user->preferences->darkTheme);
    }
}