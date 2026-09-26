<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Loader extends CI_Loader
{
    // Only switch these view roots
    protected $switchableRoots = [
        'front',
        // 'panel',
    ];

    public function view($view, $vars = array(), $return = FALSE)
    {
        $CI = get_instance();

        // ✅ ONLY this request decides theme
        // https://webhavenmedia.com/contact?status=new
        if ($this->shouldUseNewTheme($CI)) {
            $view = $this->mapToNewThemeIfApplicable($view);
        }

        return parent::view($view, $vars, $return);
    }

    protected function shouldUseNewTheme($CI): bool
    {
        return ($CI->input->get('status', true) === 'new');
    }

    protected function mapToNewThemeIfApplicable(string $view): string
    {
        // Normalize
        $view = trim($view, '/');

        foreach ($this->switchableRoots as $root) {
            if (strpos($view, $root . '/') === 0) {

                $mapped = $root . '/new/' . substr($view, strlen($root) + 1);

                // Use new view if exists, else fallback to old
                if (file_exists(APPPATH . 'views/' . $mapped . '.php')) {
                    return $mapped;
                }

                return $view;
            }
        }

        return $view;
    }
}
