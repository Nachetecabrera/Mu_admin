<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| System settings nav bar view file
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
 * Complete system settings nav bar template.
 */

?>

<nav class="py-3">
    <span class="navbar-brand mb-0 h1">System settings</span>
</nav>

<?php if ($this->session->flashdata('editSystemSettingsSuccess') === true): ?>
<div class="alert alert-success alert-dismissible fade show animated faster fadeIn" role="alert" _auto_close="15000">
    <i class="fas fa-check-circle mr-1"></i> The settings were successfully saved.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <i class="fas fa-times"></i>
    </button>
</div>
<?php endif; ?>

<?php if ($this->session->flashdata('editSystemSettingsSuccess') === false): ?>
<div class="alert alert-danger alert-dismissible fade show animated faster shake" role="alert" _auto_close="15000">
    <i class="fas fa-times-circle mr-1"></i> The settings were not saved due to an internal error. please try again later.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <i class="fas fa-times"></i>
    </button>
</div>
<?php endif; ?>
