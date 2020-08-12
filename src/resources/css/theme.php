<?php
	$default_theme_id = \Settings::findByKey('default_theme');
	$theme = Theme::find($default_theme_id);
	if($theme) {
?>

.topbar {
background: linear-gradient(to right, <?= $theme->theme_color ?> 0%, <?= $theme->active_color ?> 100%);
} .card-outline-info .card-header, .dropdown-item.active, .dropdown-item:active {
background-color: <?= $theme->theme_color ?>;
} .text-themecolor {
color: <?= $theme->primary_color ?> !important;
} html body .bg-info {
background-color: <?= $theme->primary_color ?> !important;
} a {
color: <?= $theme->primary_color ?>;
} .btn-outline-info {
color: <?= $theme->primary_color ?>;
border-color: <?= $theme->primary_color ?>;
}.sidebar-nav>ul>li.active>a i, .sidebar-nav>ul>li>a:hover i, .sidebar-nav ul li a.active, .sidebar-nav ul li a:hover, .topbar ul.dropdown-user li a:hover {
color: <?= $theme->theme_color ?>;
} .page-item.active .page-link, .btn-info, .btn-info.disabled, .btn-outline-info.active, .btn-outline-info:active, .show>.btn-outline-info.dropdown-toggle {
background-color: <?= $theme->primary_color ?>;
border-color: <?= $theme->primary_color ?>;
} .sidebar-nav>ul>li.active>a, .sidebar-nav>ul>li>a:hover {
color: <?= $theme->primary_color ?>;
border-left-color: <?= $theme->primary_color ?>;
} .profile-tab li a.nav-link.active, .customtab li a.nav-link.active {
border-bottom: 2px solid <?= $theme->primary_color ?>;
color: <?= $theme->primary_color ?>;
} .profile-tab li a.nav-link:hover, .customtab li a.nav-link:hover {
color: <?= $theme->hover_color ?>;
} .pagination>.active>a, .pagination>.active>span, .pagination>.active>a:hover, .pagination>.active>span:hover, .pagination>.active>a:focus, .pagination>.active>span:focus, .btn-outline-info:hover, .btn-outline-info:focus, .btn-outline-info.focus,
.btn-info.active, .btn-info:active, .show>.btn-info.dropdown-toggle, .btn-info.active.focus, .btn-info.active:focus, .btn-info.active:hover, .btn-info.focus:active, .btn-info:active:focus, .btn-info:active:hover, .open>.dropdown-toggle.btn-info.focus, .open>.dropdown-toggle.btn-info:focus, .open>.dropdown-toggle.btn-info:hover, .btn-info.focus, .btn-info:focus {
background-color: <?= $theme->hover_color ?>;
border-color: <?= $theme->hover_color ?>;
} @media (min-width: 768px){
.mini-sidebar .sidebar-nav #sidebarnav>li:hover>a {
background-color: <?= $theme->primary_color ?>;
border-color: <?= $theme->primary_color ?>;
}
} .btn-info:hover, .btn-info.disabled:hover {
background: <?= $theme->primary_color ?>;
opacity: 0.7;
border-color: <?= $theme->primary_color ?>;
}

<?php } ?>