<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| User overview view file
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
 * Complete user overview template.
 */

// Calling common adminend header view file.
$this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/adminend/header'); ?>

<div class="container p-0">

    <nav class="py-3">
        <span class="navbar-brand mb-0 h1">User overview</span>
    </nav>

    <div class="row">
        <div class="col-md-6 col-xl-3 d-flex align-items-stretch">
            <div class="card mb-3 flex-grow-1">
                <div class="card-body p-3">
                    <h6 class="mb-3 text-muted">Online users <i class="fas fa-circle text-success small"></i></h6>
                    <span class="display-4 d-block mw-100 text-truncate"><?php echo number_format($numOnlineUsers); ?></span>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 d-flex align-items-stretch">
            <div class="card mb-3 flex-grow-1">
                <div class="card-body p-3">
                    <h6 class="mb-3 text-muted">Today active users</h6>
                    <span class="display-4 d-block mw-100 text-truncate"><?php echo number_format($numTodayActiveUsers); ?></span>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 d-flex align-items-stretch">
            <div class="card mb-3 flex-grow-1">
                <div class="card-body p-3">
                    <h6 class="mb-3 text-muted">User breakdown</h6>
                    <div class="d-flex">
                        <span class="badge badge-pill badge-dark font-weight-normal align-self-center mr-3">All</span>
                        <span class="ml-auto"><?php echo number_format($numUsersByState->allUserCount); ?> <i class="text-muted">(100%)</i></span>
                    </div>
                    <div class="d-flex">
                        <span class="badge badge-pill badge-success font-weight-normal align-self-center mr-3">Active</span>
                        <span class="ml-auto"><?php echo number_format($numUsersByState->activeUserCount); ?> <i class="text-muted">(<?php echo round(($numUsersByState->activeUserCount / $numUsersByState->allUserCount) * 100, 0, PHP_ROUND_HALF_UP); ?>%)</i></span>
                    </div>
                    <div class="d-flex">
                        <span class="badge badge-pill badge-danger font-weight-normal align-self-center mr-3">Inactive</span>
                        <span class="ml-auto"><?php echo number_format($numUsersByState->inactiveUserCount); ?> <i class="text-muted">(<?php echo round(($numUsersByState->inactiveUserCount / $numUsersByState->allUserCount) * 100, 0, PHP_ROUND_HALF_UP); ?>%)</i></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 d-flex align-items-stretch">
            <div class="card mb-3 flex-grow-1">
                <div class="card-body p-3">
                    <h6 class="mb-3 text-muted">Email verification</h6>
                    <div class="d-flex">
                        <span class="badge badge-pill badge-dark font-weight-normal align-self-center mr-3">All</span>
                        <span class="ml-auto"><?php echo number_format($numUsersByEmailVerification->allUserEmailCount); ?> <i class="text-muted">(100%)</i></span>
                    </div>
                    <div class="d-flex">
                        <span class="badge badge-pill badge-primary font-weight-normal align-self-center mr-3">Verified</span>
                        <span class="ml-auto"><?php echo number_format($numUsersByEmailVerification->verifiedUserEmailCount); ?> <i class="text-muted">(<?php echo round(($numUsersByEmailVerification->verifiedUserEmailCount / $numUsersByEmailVerification->allUserEmailCount) * 100, 0, PHP_ROUND_HALF_UP); ?>%)</i></span>
                    </div>
                    <div class="d-flex">
                        <span class="badge badge-pill badge-secondary font-weight-normal align-self-center mr-3">Unverified</span>
                        <span class="ml-auto"><?php echo number_format($numUsersByEmailVerification->unverifiedUserEmailCount); ?> <i class="text-muted">(<?php echo round(($numUsersByEmailVerification->unverifiedUserEmailCount / $numUsersByEmailVerification->allUserEmailCount) * 100, 0, PHP_ROUND_HALF_UP); ?>%)</i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-xl-6 d-flex align-items-stretch">
            <div class="card mb-3 flex-grow-1">
                <div class="card-body p-3">
                    <h6 class="mb-3 text-muted">Monthly user registrations</h6>
                    <canvas id="chartMonthlyUserRegistrations" width="auto" height="140"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 d-flex align-items-stretch">
            <div class="card mb-3 flex-grow-1">
                <div class="card-header text-muted p-3 border-0 bg-transparent">
                    <h6 class="m-0 d-flex">
                        <span class="mr-3">Latest user registrations</span>
                        <a class="ml-auto" href="<?php echo site_url(['admin', 'users']); ?>?orderby=ID&order=DESC">All</a>
                    </h6>
                </div>
                <ul class="list-group list-group-flush mb-2">
                    <?php foreach ($lastRegisteredUsers as $user): ?>
                    <li class="list-group-item border-0 py-0 px-3 mb-2">
                        <span class="d-block mw-100 text-truncate"><?php echo $user->firstName; ?> <?php echo $user->surname; ?></span>
                        <span class="d-block mw-100 small text-muted font-italic text-truncate" title="<?php echo date('Y-m-d h:i:s A', strtotime($user->datetimeCreated)); ?>"><?php echo timespan(strtotime($user->datetimeCreated), time(), 2); ?> ago</span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 d-flex align-items-stretch">
            <div class="card mb-3 flex-grow-1">
                <div class="card-header text-muted p-3 border-0 bg-transparent">
                    <h6 class="m-0 d-flex">
                        <span class="mr-3">Recently active users</span>
                        <a class="ml-auto" href="<?php echo site_url(['admin', 'users']); ?>?orderby=datetimeLastActivity&order=DESC">All</a>
                    </h6>
                </div>
                <ul class="list-group list-group-flush mb-2">
                    <?php foreach ($lastActiveUsers as $user): ?>
                    <li class="list-group-item border-0 py-0 px-3 mb-2">
                        <span class="d-block mw-100 text-truncate"><?php echo $user->firstName; ?> <?php echo $user->surname; ?></span>
                        <span class="d-block mw-100 small text-muted font-italic text-truncate" title="<?php echo date('Y-m-d h:i:s A', strtotime($user->datetimeLastActivity)); ?>"><?php echo timespan(strtotime($user->datetimeLastActivity), time(), 2); ?> ago</span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

</div>

<?php

// JS file injections.
$data['injections']['footer']['files']['js'] = [
    base_url([$this->preferences->type('system')->item('app_assetsDir'), $this->preferences->type('system')->item('app_themesDir'), $this->preferences->type('system')->item('app_themeDir'), 'common', 'adminend', 'libs', 'chartjs-2.8.0', 'js', 'Chart.min.js'])
];

// Generate data for monthly user registrations chart.
foreach ($numUsersByRegisteredMonth as $registeredMonth => $userCount) {
    $registeredMonths[] = '"' . $registeredMonth . '"';
    $userCounts[] = $userCount;
}

$registeredMonths = implode(', ', $registeredMonths);
$userCounts = implode(', ', $userCounts);

// JS Code injections.
$data['injections']['footer']['codes']['js'] = [
    '
    // Data.
    var labels = [' . $registeredMonths . '];
    var data = [' . $userCounts . '];

    // Chart.
    var chartMonthlyUserRegistrations = document.getElementById("chartMonthlyUserRegistrations");
    new Chart(chartMonthlyUserRegistrations, {
        type: "line",
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: "rgba(23, 162, 184, 0.25)",
                borderColor: "#17a2b8"
            }]
        },
        options: {
            responsive: true,
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        color: "rgba(0, 0, 0, 0.075)",
                    }
                }],
                yAxes: [{
                    gridLines: {
                        color: "rgba(0, 0, 0, 0.075)",
                    }
                }]
            },
            tooltips: {
                displayColors: false
            }
        }
    });
    '
];

// Calling common adminend footer view file.
$this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/adminend/footer', $data); ?>
