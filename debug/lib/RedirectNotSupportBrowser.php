<?php
declare(strict_types=1);

require_once 'lib/functions.php';

class RedirectNotSupportBrowser
{
    private $browser = null;
    private $userAgent = null;

    public function __construct()
    {
        $this->beginEvent();
    }

    private function redirect(string $page)
    {
        header('Location: ./' . $page . '.php');
    }

    private function detectBrowser(string $pageRedirect)
    {
        if (strpos($this->userAgent, 'Firefox') !== false)
            $this->browser = 'Firefox';
        else if (strpos($this->userAgent, 'Opera') !== false)
            $this->browser = 'Opera';
        else if (strpos($this->userAgent, 'Chrome') !== false)
            $this->browser = 'Chrome';
        else if (strpos($this->userAgent, 'MSIE') !== false)
            $this->browser = 'InternetExplorer';
        else if (strpos($this->userAgent, 'Safari') !== false)
            $this->browser = 'Safari';
        else $this->browser = 'Undefined';

        if ($this->browser === 'Safari' || $this->browser === 'Undefined') {
            $this->redirect($pageRedirect);
        }
    }

    private function beginEvent()
    {
        $this->browser = 'Undefined';
        $this->userAgent = $_SERVER["HTTP_USER_AGENT"];

        $this->detectBrowser('not-support');
    }
}
