<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| System settings nav column view file
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




/**
 * Complete system settings nav column template.
 */

?>

<div class="list-group mb-3">
    <a href="<?php echo site_url([$this->uri->segment(1), $this->uri->segment(2), $this->uri->segment(3), 'app']); ?>" class="list-group-item list-group-item-action py-2 px-3 <?php echo ($this->uri->segment(4) == 'app' ? 'active' : ''); ?>">
        App module
    </a>
    <a href="<?php echo site_url([$this->uri->segment(1), $this->uri->segment(2), $this->uri->segment(3), 'auth']); ?>" class="list-group-item list-group-item-action py-2 px-3 <?php echo ($this->uri->segment(4) == 'auth' ? 'active' : ''); ?>">
        Auth module
    </a>
    <a href="<?php echo site_url([$this->uri->segment(1), $this->uri->segment(2), $this->uri->segment(3), 'users']); ?>" class="list-group-item list-group-item-action py-2 px-3 <?php echo ($this->uri->segment(4) == 'users' ? 'active' : ''); ?>">
        Users module
    </a>
</div>
