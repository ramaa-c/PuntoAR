<!doctype html>
<html lang="en">


<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AdminLTE 4 | Fixed Sidebar</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    
    <meta name="color-scheme" content="light dark" />
    
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    
    <meta name="title" content="AdminLTE 4 | Fixed Sidebar" />
    
    <meta name="author" content="ColorlibHQ" />
    
    <meta       name="description"      
        content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS. Fully accessible with WCAG 2.1 AA compliance."
        />
    
    <meta       name="keywords"      
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel, WCAG compliant"
        />
    
    <meta name="supported-color-schemes" content="light dark" />
    
    <link rel="preload" href="<?= base_url('AdminLTE/dist/css/adminlte.css') ?>" as="style" />
    
    <link       rel="stylesheet"       href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"  
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="       crossorigin="anonymous"      
        media="print"       onload="this.media='all'"     />
    
    <link       rel="stylesheet"      
        href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"      
        crossorigin="anonymous"     />
    
    <link       rel="stylesheet"      
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"      
        crossorigin="anonymous"     />
    
    <link rel="stylesheet" href="<?= base_url('AdminLTE/dist/css/adminlte.css') ?>" />
    
</head>


<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <div class="app-wrapper">
        <nav class="app-header navbar navbar-expand bg-body">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i>
                            </a>
                        </li>
                    <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Home</a></li>
                    <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Contact</a></li>
                    </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                            <i class="bi bi-search"></i>
                            </a>
                        </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-bs-toggle="dropdown" href="#">
                            <i class="bi bi-chat-text"></i>
                            <span class="navbar-badge badge text-bg-danger">3</span>
                            </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <img                        
                                            src="<?= base_url('AdminLTE/assets/img/user1-128x128.jpg') ?>"              
                                            alt="User Avatar"                        
                                            class="img-size-50 rounded-circle me-3"                       />
                                        </div>
                                    <div class="flex-grow-1">
                                        <h3 class="dropdown-item-title">
                                            Brad Diesel
                                            <span class="float-end fs-7 text-danger"            
                                                ><i class="bi bi-star-fill"></i                      
                                                    ></span>
                                            </div>
                                    <p class="fs-7">Call me whenever you can...</p>
                                    <p class="fs-7 text-secondary">
                                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                                        </p>
                                    </div>
                                </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <img                        
                                        src="<?= base_url('AdminLTE/assets/img/user8-128x128.jpg') ?>"                  
                                        alt="User Avatar"                        
                                        class="img-size-50 rounded-circle me-3"                       />
                                    </div>
                                <div class="flex-grow-1">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-end fs-7 text-secondary">
                                            <i class="bi bi-star-fill"></i>
                                            </span>
                                        </h3>
                                    <p class="fs-7">I got your message bro</p>
                                    <p class="fs-7 text-secondary">
                                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                                        </p>
                                    </div>
                                </div>
                            </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <img                        
                                        src="<?= base_url('AdminLTE/assets/img/user3-128x128.jpg') ?>"                  
                                        alt="User Avatar"                        
                                        class="img-size-50 rounded-circle me-3"                       />
                                    </div>
                                <div class="flex-grow-1">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-end fs-7 text-warning">
                                            <i class="bi bi-star-fill"></i>
                                            </span>
                                        </h3>
                                    <p class="fs-7">The subject goes here</p>
                                    <p class="fs-7 text-secondary">
                                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                                        </p>
                                    </div>
                                </div>
                            </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                        </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" data-bs-toggle="dropdown" href="#">
                    <i class="bi bi-bell-fill"></i>
                    <span class="navbar-badge badge text-bg-warning">15</span>
                    </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="bi bi-envelope me-2"></i> 4 new messages
                        <span class="float-end text-secondary fs-7">3 mins</span>
                        </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="bi bi-people-fill me-2"></i> 8 friend requests
                        <span class="float-end text-secondary fs-7">12 hours</span>
                        </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="bi bi-file-earmark-fill me-2"></i> 3 new reports
                        <span class="float-end text-secondary fs-7">2 days</span>
                        </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer"> See All Notifications </a>
                    </div>
                </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                    </a>
                </li>
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img                  
                        src="<?= base_url('AdminLTE/assets/img/user2-160x160.jpg') ?>"                  
                        class="user-image rounded-circle shadow"                   alt="User Image"                 />
                    <span class="d-none d-md-inline">Alexander Pierce</span>
                    </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <li class="user-header text-bg-primary">
                        <img                    
                            src="<?= base_url('AdminLTE/assets/img/user2-160x160.jpg') ?>"                    
                            class="rounded-circle shadow"                     alt="User Image"                   />
                        <p>
                            Alexander Pierce - Web Developer
                            <small>Member since Nov. 2023</small>
                            </p>
                        </li>
                    <li class="user-body">
                        <div class="row">
                            <div class="col-4 text-center"><a href="#">Followers</a></div>
                            <div class="col-4 text-center"><a href="#">Sales</a></div>
                            <div class="col-4 text-center"><a href="#">Friends</a></div>
                            </div>
                        </li>
                    <li class="user-footer">
                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                        <a href="#" class="btn btn-default btn-flat float-end">Sign out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            </div>
    </nav>
    <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <div class="sidebar-brand">
            <a href="<?= base_url('index') ?>" class="brand-link">
                <img               src="<?= base_url('AdminLTE/assets/img/AdminLTELogo.png') ?>"
                    alt="AdminLTE Logo"               class="brand-image opacity-75 shadow"             />
                <span class="brand-text fw-light">AdminLTE 4</span>
                </a>
            </div>
        <div class="sidebar-wrapper">
            <nav class="mt-2">
                <ul               class="nav sidebar-menu flex-column"              
                    data-lte-toggle="treeview"               role="navigation"              
                    aria-label="Main navigation"               data-accordion="false"               id="navigation"    
                    >
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-speedometer"></i>
                            <p>
                                Dashboard
                                <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('index') ?>" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Dashboard v1</p>
                                    </a>
                                </li>
                            <li class="nav-item">
                                <a href="<?= base_url('index2') ?>" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Dashboard v2</p>
                                    </a>
                                </li>
                            <li class="nav-item">
                                <a href="<?= base_url('index3') ?>" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Dashboard v3</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <li class="nav-item">
                        <a href="<?= base_url('generate/theme') ?>" class="nav-link">
                            <i class="nav-icon bi bi-palette"></i>
                            <p>Theme Generate</p>
                            </a>
                        </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-box-seam-fill"></i>
                            <p>
                                Widgets
                                <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('widgets/small-box') ?>" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Small Box</p>
                                    </a>
                                </li>
                            <li class="nav-item">
                                <a href="<?= base_url('widgets/info-box') ?>" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>info Box</p>
                                    </a>
                                </li>
                            <li class="nav-item">
                                <a href="<?= base_url('widgets/cards') ?>" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Cards</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon bi bi-clipboard-fill"></i>
                            <p>
                                Layout Options
                                <span class="nav-badge badge text-bg-secondary me-3">6</span>
                                <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('layout/unfixed-sidebar') ?>"
                                    class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Default Sidebar</p>
                                    </a>
                                </li>
                            <li class="nav-item">
                                <a href="<?= base_url('layout/fixed-sidebar') ?>"
                                    class="nav-link active">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Fixed Sidebar</p>
                                    </a>
                                </li>
                            <li class="nav-item">
                                <a href="<?= base_url('layout/fixed-header') ?>" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Fixed Header</p>
                                    </a>
                                </li>
                            <li class="nav-item">
                                <a href="<?= base_url('layout/fixed-footer') ?>" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Fixed Footer</p>
                                    </a>
                                </li>
                            <li class="nav-item">
                                <a href="<?= base_url('layout/fixed-complete') ?>" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Fixed Complete</p>
                                    </a>
                                </li>
                            <li class="nav-item">
                                <a href="<?= base_url('layout/layout-custom-area') ?>"
                                    class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Layout <small>+ Custom Area </small></p>
                                    </a>
                                </li>
                            <li class="nav-item">
                                <a href="<?= base_url('layout/sidebar-mini') ?>" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Sidebar Mini</p>
                                    </a>
                                </li>
                            <li class="nav-item">
                                <a href="<?= base_url('layout/collapsed-sidebar') ?>"
                                    class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Sidebar Mini <small>+ Collapsed</small></p>
                                    </a>
                                </li>
                            <li class="nav-item">
                                <a href="<?= base_url('layout/logo-switch') ?>" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Sidebar Mini <small>+ Logo Switch</small></p>
                                    </a>
                                </li>
                            <li class="nav-item">
                                <a href="<?= base_url('layout/layout-rtl') ?>" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Layout RTL</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-tree-fill"></i>
                            <p>
                                UI Elements
                                <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('UI/general') ?>" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>General</p>
                                    </a>
                                </li>
                            <li class="nav-item">
                                <a href="<?= base_url('UI/icons') ?>" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Icons</p>
                                    </a>
                                </li>
                            <li class="nav-item">
                                <a href="<?= base_url('UI/timeline') ?>" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Timeline</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-pencil-square"></i>
                            <p>
                                Forms
                                <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('forms/general') ?>" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>General Elements</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-table"></i>
                            <p>
                                Tables
                                <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('tables/simple') ?>" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Simple Tables</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <li class="nav-header">EXAMPLES</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-box-arrow-in-right"></i>
                            <p>
                                Auth
                                <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                    <p>
                                        Version 1
                                        <i class="nav-arrow bi bi-chevron-right"></i>
                                        </p>
                                    </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('examples/login') ?>"
                                            class="nav-link">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>Login</p>
                                            </a>
                                        </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('examples/register') ?>"
                                            class="nav-link">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>Register</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                    <p>
                                        Version 2
                                        <i class="nav-arrow bi bi-chevron-right"></i>
                                        </p>
                                    </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('examples/login-v2') ?>"
                                            class="nav-link">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>Login</p>
                                            </a>
                                        </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('examples/register-v2') ?>"
                                            class="nav-link">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>Register</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            <li class="nav-item">
                                <a href="<?= base_url('examples/lockscreen') ?>" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Lockscreen</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <li class="nav-header">DOCUMENTATIONS</li>
                    <li class="nav-item">
                        <a href="<?= base_url('docs/introduction') ?>" class="nav-link">
                            <i class="nav-icon bi bi-download"></i>
                            <p>Installation</p>
                            </a>
                        </li>
                    <li class="nav-item">
                        <a href="<?= base_url('docs/layout') ?>" class="nav-link">
                            <i class="nav-icon bi bi-grip-horizontal"></i>
                            <p>Layout</p>
                            </a>
                        </li>
                    <li class="nav-item">
                        <a href="<?= base_url('docs/color-mode') ?>" class="nav-link">
                            <i class="nav-icon bi bi-star-half"></i>
                            <p>Color Mode</p>
                            </a>
                        </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-ui-checks-grid"></i>
                            <p>
                                Components
                                <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('docs/components/main-header') ?>"
                                    class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Main Header</p>
                                    </a>
                                </li>
                            <li class="nav-item">
                                <a href="<?= base_url('docs/components/main-sidebar') ?>"
                                    class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Main Sidebar</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-filetype-js"></i>
                            <p>
                                Javascript
                                <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('docs/javascript/treeview') ?>"
                                    class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Treeview</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <li class="nav-item">
                        <a href="<?= base_url('docs/browser-support') ?>" class="nav-link">
                            <i class="nav-icon bi bi-browser-edge"></i>
                            <p>Browser Support</p>
                            </a>
                        </li>
                    <li class="nav-item">
                        <a href="<?= base_url('docs/how-to-contribute') ?>" class="nav-link">
                            <i class="nav-icon bi bi-hand-thumbs-up-fill"></i>
                            <p>How To Contribute</p>
                            </a>
                        </li>
                    <li class="nav-item">
                        <a href="<?= base_url('docs/faq') ?>" class="nav-link">
                            <i class="nav-icon bi bi-question-circle-fill"></i>
                            <p>FAQ</p>
                            </a>
                        </li>
                    <li class="nav-item">
                        <a href="<?= base_url('docs/license') ?>" class="nav-link">
                            <i class="nav-icon bi bi-patch-check-fill"></i>
                            <p>License</p>
                            </a>
                        </li>
                    <li class="nav-header">MULTI LEVEL EXAMPLE</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-circle-fill"></i>
                            <p>Level 1</p>
                            </a>
                        </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-circle-fill"></i>
                            <p>
                                Level 1
                                <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Level 2</p>
                                    </a>
                                </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>
                                        Level 2
                                        <i class="nav-arrow bi bi-chevron-right"></i>
                                        </p>
                                    </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon bi bi-record-circle-fill"></i>
                                            <p>Level 3</p>
                                            </a>
                                        </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon bi bi-record-circle-fill"></i>
                                            <p>Level 3</p>
                                            </a>
                                        </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon bi bi-record-circle-fill"></i>
                                            <p>Level 3</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Level 2</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-circle-fill"></i>
                            <p>Level 1</p>
                            </a>
                        </li>
                    <li class="nav-header">LABELS</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-circle text-danger"></i>
                            <p class="text">Important</p>
                            </a>
                        </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-circle text-warning"></i>
                            <p>Warning</p>
                            </a>
                        </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-circle text-info"></i>
                            <p>Informational</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Fixed Layout</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Fixed Layout</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Title</h3>
                                <div class="card-tools">
                                    <button                         type="button"                
                                        class="btn btn-tool"                        
                                        data-lte-toggle="card-collapse"                         title="Collapse"        
                                        >
                                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                        </button>
                                    <button                         type="button"                
                                        class="btn btn-tool"                        
                                        data-lte-toggle="card-remove"                         title="Remove"            
                                        >
                                        <i class="bi bi-x-lg"></i>
                                        </button>
                                    </div>
                                </div>
                            <div class="card-body">Start creating your amazing application!</div>
                            <div class="card-footer">Footer</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    <footer class="app-footer">
        <div class="float-end d-none d-sm-inline">Anything you want</div>
        <strong>
            Copyright &copy; 2014-2025&nbsp;
            <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.
            </strong>
        All rights reserved.
        </footer>
    </div>
    
    <script      
        src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"      
        crossorigin="anonymous"    ></script>
    
    <script       src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"      
        crossorigin="anonymous"    ></script>
    
    <script       src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"      
        crossorigin="anonymous"    ></script>
    
    <script src="<?= base_url('AdminLTE/dist/js/adminlte.js') ?>"></script>
    
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true,
        };
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script>
    
</body>


</html>