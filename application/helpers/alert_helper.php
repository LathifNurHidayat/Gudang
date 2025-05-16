<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function alert_success($message)
{
    return '
    <div class="alert alert-success alert-dismissible" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon mr-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
        ' . $message . '
          <a href="#" class="btn-close" data-dismiss="alert" aria-label="close"></a>
    </div>';
}

function alert_info($message)
{
    return '
    <div class="alert alert-info alert-dismissible" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon mr-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="9"></circle><line x1="12" y1="8" x2="12.01" y2="8"></line><polyline points="11 12 12 12 12 16 13 16"></polyline></svg>
        ' . $message . '
          <a href="#" class="btn-close" data-dismiss="alert" aria-label="close"></a>
    </div>';
}

function alert_warning($message)
{
    return '
    <div class="alert alert-warning alert-dismissible" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon mr-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 9v2m0 4v.01"></path><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75"></path></svg>
        ' . $message . '
          <a href="#" class="btn-close" data-dismiss="alert" aria-label="close"></a>
    </div>';
}

function alert_error($message)
{
    return '
    <div class="alert alert-danger alert-dismissible" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon mr-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="9"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
        ' . $message . '
          <a href="#" class="btn-close" data-dismiss="alert" aria-label="close"></a>
    </div>';
}