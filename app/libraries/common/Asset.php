<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Asset library
|
| Author:       Nudasoft
| Copyright:    Copyright (C) Nudasoft, all rights reserved
| Author email: nudasoft@gmail.com
| Author url:   http://www.nudasoft.com
|
| Author twitter:   https://twitter.com/Nudasoft
| Author facebook:  https://www.facebook.com/Nudasoft
| Author instagram: https://www.instagram.com/nudasoft
| Author linkedin:  https://www.linkedin.com/company/nudasoft
|--------------------------------------------------------------------------
*/




class Asset
{
    /**
     * Inject asset files & codes into specified locations.
     *
     * @param $injectorName String.
     * @param $injections Array.
     */
    public function injector($injectorName, $injections)
    {
        // Inject CSS files.
        if (isset($injections[$injectorName]['files']['css'])) {
            foreach ($injections[$injectorName]['files']['css'] as $file) {
                echo '<link rel="stylesheet" href="' . $file . '">';
            }
        }

        // Inject JS files.
        if (isset($injections[$injectorName]['files']['js'])) {
            foreach ($injections[$injectorName]['files']['js'] as $file) {
                echo '<script src="' . $file . '"></script>';
            }
        }

        // Inject CSS codes.
        if (isset($injections[$injectorName]['codes']['css'])) {
            echo '<style>';
            foreach ($injections[$injectorName]['codes']['css'] as $code) {
                echo $code;
            }
            echo '</style>';
        }

        // Inject JS codes.
        if (isset($injections[$injectorName]['codes']['js'])) {
            echo '<script>';
            foreach ($injections[$injectorName]['codes']['js'] as $code) {
                echo $code;
            }
            echo '</script>';
        }
    }
} // Class end.
