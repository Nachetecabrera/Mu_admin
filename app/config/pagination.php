<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Custom pagination configuration file
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
 * The number of items you intend to show per page.
 */
$config['per_page'] = 5;



/**
 * The number of "digit" links you would like before and after the selected page number.
 * For example, the number 2 will place two digits on either side.
 */
$config['num_links'] = 2;



/**
 * When set to TRUE, it will override the $config['suffix'] value and instead set it to the
 * one that you have in $config['url_suffix'] in your application/config/config.php file.
 */
$config['use_global_url_suffix'] = false;



/**
 * By default, the URI segment will use the starting index for the items you are paginating.
 * If you prefer to show the the actual page number, set this to TRUE.
 */
$config['use_page_numbers'] = true;



/**
 * By default your query string arguments (nothing to do with other query string options) will be ignored.
 * Setting this config to TRUE will add existing query string arguments back into the URL after
 * the URI segment and before the suffix.
 */
$config['reuse_query_string'] = true;




#--------------------------------------------------------------------------
# Styling pagination elements
#--------------------------------------------------------------------------

/**
 * Add extra attributes to every link that rendered by the pagination class.
 */
$config['attributes'] = array('class' => 'page-link');



/**
 * Main pagination container.
 */
$config['full_tag_open'] = '';
$config['full_tag_close'] = '';



/**
 * Current active iink container.
 */
$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link" aria-label="(current)">';
$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';



/**
 * Normal link container.
 */
$config['num_tag_open'] = '<li class="page-item">';
$config['num_tag_close'] = '</li>';



/**
 * Next link container.
 */
$config['next_tag_open'] = '<li class="page-item">';
$config['next_tag_close'] = '</li>';



/**
 * Prev link container.
 */
$config['prev_tag_open'] = '<li class="page-item">';
$config['prev_tag_close'] = '</li>';



/**
 * Next link content.
 */
$config['next_link'] = '<span aria-hidden="true">&rsaquo;</span><span class="sr-only">Next</span>';



/**
 * Prev link content.
 */
$config['prev_link'] = '<span aria-hidden="true">&lsaquo;</span><span class="sr-only">Previous</span>';



/**
 * First link container.
 */
$config['first_tag_open'] = '<li class="page-item">';
$config['first_tag_close'] = '</li>';



/**
 * Last link container.
 */
$config['last_tag_open'] = '<li class="page-item">';
$config['last_tag_close'] = '</li>';



/**
 * First link content.
 */
$config['first_link'] = '<span aria-hidden="true">&laquo;</span><span class="sr-only">First</span>';



/**
 * Last link content.
 */
$config['last_link'] = '<span aria-hidden="true">&raquo;</span><span class="sr-only">Last</span>';
