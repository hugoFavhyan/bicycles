<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class LanguageFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $locale = $request->getGet('lang');

        if ($locale && in_array($locale, service('request')->config->supportedLocales)) {
            $session->set('lang', $locale);
            $uri = clone $request->uri;
            $uri->stripQuery('lang');
            return redirect()->to((string) $uri);
        }

        if ($session->has('lang')) {
            service('request')->setLocale($session->get('lang'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
