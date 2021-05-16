<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| User settings nav column view file
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
 * Complete user settings nav column template.
 */

?>

<div class="list-group mb-3">
    <a href="<?php echo site_url([$this->uri->segment(1), $this->uri->segment(2), $this->uri->segment(3), 'profile']); ?>" class="list-group-item list-group-item-action py-2 px-3 <?php echo ($this->uri->segment(4) == 'profile' ? 'active' : ''); ?>">
        Profile
    </a>
    <a href="<?php echo site_url([$this->uri->segment(1), $this->uri->segment(2), $this->uri->segment(3), 'account']); ?>" class="list-group-item list-group-item-action py-2 px-3 <?php echo ($this->uri->segment(4) == 'account' ? 'active' : ''); ?>">
        Account
    </a>
    <a href="<?php echo site_url([$this->uri->segment(1), $this->uri->segment(2), $this->uri->segment(3), 'security']); ?>" class="list-group-item list-group-item-action py-2 px-3 <?php echo ($this->uri->segment(4) == 'security' ? 'active' : ''); ?>">
        Security
    </a>
    <a href="<?php echo site_url([$this->uri->segment(1), $this->uri->segment(2), $this->uri->segment(3), 'email']); ?>" class="list-group-item list-group-item-action py-2 px-3 <?php echo ($this->uri->segment(4) == 'email' ? 'active' : ''); ?>">
        Email
    </a>
</div>
