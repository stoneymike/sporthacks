<?php
header("Content-Type:text/css");
$color = "#f0f"; // Change your Color Here
$secondColor = "#ff8"; // Change your Color Here

function checkhexcolor($color){
    return preg_match('/^#[a-f0-9]{6}$/i', $color);
}

if (isset($_GET['color']) AND $_GET['color'] != '') {
    $color = "#" . $_GET['color'];
}

if (!$color OR !checkhexcolor($color)) {
    $color = "#336699";
}


function checkhexcolor2($secondColor){
    return preg_match('/^#[a-f0-9]{6}$/i', $secondColor);
}

if (isset($_GET['secondColor']) AND $_GET['secondColor'] != '') {
    $secondColor = "#" . $_GET['secondColor'];
}

if (!$secondColor OR !checkhexcolor2($secondColor)) {
    $secondColor = "#336699";
}
?>

.bg--base {
background-color: <?php echo $color ?> !important;
}

.news-date {
color: <?php echo $color ?>;
}

.header-bottom-area .navbar-collapse .main-menu li a:hover, .header-bottom-area .navbar-collapse .main-menu li a.active {
background-color: <?php echo $color ?>;
}

.language-select {
background-color: <?php echo $color ?>;
}

.top-news-ticker .title {
background-color: <?php echo $color ?>;
}

.pause-btn {
background-color: <?php echo $color ?>;
}

.nav-tabs .nav-link.active {
background-color: <?php echo $color ?>;
border: 1px solid <?php echo $color ?>;
}

.nav-tabs .nav-link:hover {
color: <?php echo $color ?>;
border-bottom: 1px solid <?php echo $color ?>;
}
.nav-tabs {
border-bottom: 1px solid <?php echo $color ?>;
}

.small-single-news .content .title a:hover {
color: <?php echo $color ?>;
}

.news-banner-content .title a:hover {
color: <?php echo $color ?>;
}

.widget-title::after {
background-color: <?php echo $color ?>;
}

.ui-widget-content {
border: 1px solid <?php echo $color ?>;
}
.ui-widget-header {
background: <?php echo $color ?>;
}

.ui-datepicker th {
color: <?php echo $color ?>;
}
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
background: <?php echo $color ?>;
border: 1px solid <?php echo $color ?>;
}

.news-blog-header span:hover {
color: <?php echo $color ?>;
}

*::-webkit-scrollbar-button {
background-color: <?php echo $color ?>;
}
*::-webkit-scrollbar-thumb {
background-color: <?php echo $color ?>;
}
.scrollToTop {
background: <?php echo $color ?>;
}
.news-blog-content .title a:hover {
color: <?php echo $color ?>;
}

.section-header .section-title i {
color: <?php echo $color ?>;
}

.footer-toggle .right-icon {
background-color: <?php echo $color ?>;
}
.footer-links li:hover {
color: <?php echo $color ?>;
}
.footer-social li a:hover, .footer-social li a.active {
background-color: <?php echo $color ?>;
}

.footer-links li:hover::before {
color: <?php echo $color ?>;
}

.btn--base {
background-color: <?php echo $color ?>;
}

.btn--base:focus, .btn--base:hover{
box-shadow: 0 10px 20px <?php echo $color ?>;
}

.pagination .page-item.active .page-link, .pagination .page-item:hover .page-link{
    background: <?php echo $color ?>;
    border-color: <?php echo $color ?>;
}

.pagination .page-item.disabled span{
    background: <?php echo $color ?>;
    border: 1px solid <?php echo $color ?>;
}

.page-link:focus{
    box-shadow: 0 0 0 0.25rem <?php echo $color ?>25;
}