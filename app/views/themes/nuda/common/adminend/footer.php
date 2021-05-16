<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Footer view file
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




?>                  	    </div>
                        </div>
                    </div>

                    <div class="container-fluid mt-auto">
                        <div class="row small font-italic text-black-50">
                            <div class="col py-3">
                                Powered by <a class="text-secondary" href="<?php echo $this->config->item('appskull_portfolioUrl'); ?>">Appskull <?php echo $this->config->item('appskull_version'); ?></a>
                            </div>

                            <div class="col py-3 text-right">Version <?php echo $this->config->item('app_version'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- JavaScript -->
        <script src="<?php echo base_url([$this->preferences->type('system')->item('app_assetsDir'), $this->preferences->type('system')->item('app_themesDir'), $this->preferences->type('system')->item('app_themeDir'), 'common', 'adminend', 'js', 'adminend.min.js?v=' . $this->config->item('appskull_version')]); ?>"></script>
        <script src="<?php echo base_url([$this->preferences->type('system')->item('app_assetsDir'), $this->preferences->type('system')->item('app_themesDir'), $this->preferences->type('system')->item('app_themeDir'), 'common', 'common', 'js', 'app.js?v=' . $this->config->item('app_version')]); ?>"></script>
        <script src="<?php echo base_url([$this->preferences->type('system')->item('app_assetsDir'), $this->preferences->type('system')->item('app_themesDir'), $this->preferences->type('system')->item('app_themeDir'), 'common', 'adminend', 'js', 'app.js?v=' . $this->config->item('app_version')]); ?>"></script>

        <?php

        // Footer injector.
        if (isset($injections)) {
            $this->asset->injector('footer', $injections);
        }

        ?>
    </body>
</html>
