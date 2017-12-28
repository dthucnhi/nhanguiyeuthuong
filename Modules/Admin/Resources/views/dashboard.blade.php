<!DOCTYPE html>
<html>
<head>

    <!-- Title -->
    <title>Gửi ngàn lời yêu | DashBoard</title>

    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta charset="UTF-8">
    <meta name="description" content="Admin Dashboard Template" />
    <meta name="keywords" content="admin,dashboard" />
    <meta name="author" content="Steelcoders" />

    <!-- Styles -->
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href="/admintemplate/assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
    <link href="/admintemplate/assets/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/>
    <link href="/admintemplate/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/admintemplate/assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
    <link href="/admintemplate/assets/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/>
    <link href="/admintemplate/assets/plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>
    <link href="/admintemplate/assets/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css"/>
    <link href="/admintemplate/assets/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="/admintemplate/assets/plugins/slidepushmenus/css/component.css" rel="stylesheet" type="text/css"/>
    <link href="/admintemplate/assets/plugins/datatables/css/jquery.datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="/admintemplate/assets/plugins/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet" type="text/css"/>
    <link href="/admintemplate/assets/plugins/x-editable/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" type="text/css">
    <link href="/admintemplate/assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css"/>
    <link href="/admintemplate/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css">
    <link href="/admintemplate/kendoUI/styles/kendo.material.min.css" rel="stylesheet" type="text/css">
    <link href="/admintemplate/kendoUI/styles/kendo.fiori.mobile.min.css" rel="stylesheet" type="text/css">
    <link href="/admintemplate/kendoUI/styles/kendo.common-bootstrap.min.css" rel="stylesheet" type="text/css">

    <!-- Theme Styles -->
    <link href="/admintemplate/assets/css/modern.min.css" rel="stylesheet" type="text/css"/>
    <link href="/admintemplate/assets/css/custom.css" rel="stylesheet" type="text/css"/>

    <script src="/admintemplate/assets/plugins/3d-bold-navigation/js/modernizr.js"></script>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        #loading {
            width: 100%;
            height: 100%;
            background: #193c54 url(/theme/Loading/Loading-bg.jpg) no-repeat center;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 9999;
        }
        .load{
            position: relative;
            /*width: 194px;*/
            height: 112px;
            top: 60%;
            margin: -56px auto;
        }
        #loading .spinner {
            position: relative;
            width: 94px;
            height: 112px;
            top: 50%;
            margin: -56px auto;
            background: url(/theme/Loading/loading.png) no-repeat center;
            -webkit-animation: mask 1s infinite alternate;
            -moz-animation: mask 1s infinite alternate;
            -ms-animation: mask 1s infinite alternate;
            -o-animation: mask 1s infinite alternate;
            animation: mask 1s infinite alternate;
        }
        @-webkit-keyframes mask {
            0% {
                -webkit-transform: rotate(90deg);
            }

            100% {
                -webkit-transform: rotate(-90deg);
            }
        }

        @-moz-keyframes mask {
            0% {
                -moz-transform: rotate(90deg);
            }

            100% {
                -moz-transform: rotate(-90deg);
            }
        }

        @-ms-keyframes mask {
        0% {
            -ms-transform: rotate(90deg);
        }

        100% {
            -ms-transform: rotate(-90deg);
        }
        }

        @-o-keyframes mask {
            0% {
                -o-transform: rotate(90deg);
            }

            100% {
                -o-transform: rotate(-90deg);
            }
        }

        @keyframes mask {
            0% {
                transform: rotate(90deg);
            }

            100% {
                transform: rotate(-90deg);
            }
        }
    </style>
</head>
<body class="page-header-fixed compact-menu page-horizontal-bar">
<div class="overlay"></div>
<main class="page-content content-wrap">
    <div id="loading" style="visibility: hidden">
        <div class="spinner">
        </div>
        <div class="load">
            Hệ thống đang xử lý yêu cầu. Vui lòng đợi...
        </div>
    </div>
    <div class="navbar">
        <div class="navbar-inner container">
            <div class="sidebar-pusher">
                <a href="javascript:void(0);" class="waves-effect waves-button waves-classic push-sidebar">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
            <div class="logo-box">
                <a href="" class="logo-text"><span>Admin</span></a>
            </div><!-- Logo Box -->
            <div class="search-button">
                <a href="javascript:void(0);" class="waves-effect waves-button waves-classic show-search"><i class="fa fa-search"></i></a>
            </div>
            <div class="topmenu-outer">
                <div class="top-menu">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="javascript:void(0);" class="waves-effect waves-button waves-classic sidebar-toggle"><i class="fa fa-bars"></i></a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown">
                                <span class="user-name">{{Auth::user()->name}}<i class="fa fa-angle-down"></i></span>
                                <img class="img-circle avatar" src="/admintemplate/assets/images/avatar1.png" width="40" height="40" alt="">
                            </a>
                            <ul class="dropdown-menu dropdown-list" role="menu">
                                <li role="presentation"><a href="/admin/logout"><i class="fa fa-sign-out m-r-xs"></i>Log out</a></li>
                            </ul>
                        </li>
                    </ul><!-- Nav -->
                </div><!-- Top Menu -->
            </div>
        </div>
    </div><!-- Navbar -->
    <div class="page-sidebar sidebar horizontal-bar">
        <div class="page-sidebar-inner">
            <ul class="menu accordion-menu">
                <li class="nav-heading"><span>Navigation</span></li>
                {{--<li><a href="/admin/dashboard"><span class="menu-icon icon-speedometer"></span><p>Dashboard</p></a></li>--}}
            </ul>
        </div><!-- Page Sidebar Inner -->
    </div><!-- Page Sidebar -->
    <div class="page-inner">
        <div class="page-breadcrumb">
            <ol class="breadcrumb container">
                <li><a href="">Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </div>
        <div class="page-title">
            <div class="container">
                <h3>Duyệt nội dung</h3>
            </div>
        </div>
        <div id="main-wrapper" class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-white">
                        <div class="panel-heading clearfix">
                            <h4 class="panel-title">Danh sách cuộc gọi đang chờ duyệt</h4>
                        </div>
                        <div class="panel-body">
                            <form class="form-inline" style="margin-bottom: 15px">
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputEmail2">Nhập để tìm</label>
                                    <input type="text" id="txtSearchKey" class="form-control input-rounded" placeholder="Nhập để tìm"/>
                                </div>
                                <button type="button" class="btn btn-primary" id="search">Tìm Kiếm<i class="icon-arrow-right14 position-right"></i></button>

                                <select class="form-control selectclass" style="display: none; width: 110px" name="option" id="option">
                                    <option value="0">Chưa duyệt</option>
                                    <option value="1">Đã duyệt</option>
                                    <option value="2">Tất cả</option>
                                </select>
                            </form>

                            <div id="List_grid" class="cus-kendo"></div>
                        </div>

                    </div>
                </div>
            </div><!-- Row -->
        </div><!-- Main Wrapper -->
        <div class="page-footer">
            <div class="container">
                <p class="no-s">2017 &copy; CloudFone.vn.</p>
            </div>
        </div>
    </div><!-- Page Inner -->
</main><!-- Page Content -->
<nav class="cd-nav-container" id="cd-nav">
    <header>
        <h3>Navigation</h3>
        <a href="#0" class="cd-close-nav">Close</a>
    </header>
    <ul class="cd-nav list-unstyled">
        <li class="cd-selected" data-menu="index">
            <a href="javsacript:void(0);">
                        <span>
                            <i class="glyphicon glyphicon-home"></i>
                        </span>
                <p>Dashboard</p>
            </a>
        </li>
        <li data-menu="profile">
            <a href="javsacript:void(0);">
                        <span>
                            <i class="glyphicon glyphicon-user"></i>
                        </span>
                <p>Profile</p>
            </a>
        </li>
        <li data-menu="inbox">
            <a href="javsacript:void(0);">
                        <span>
                            <i class="glyphicon glyphicon-envelope"></i>
                        </span>
                <p>Mailbox</p>
            </a>
        </li>
        <li data-menu="#">
            <a href="javsacript:void(0);">
                        <span>
                            <i class="glyphicon glyphicon-tasks"></i>
                        </span>
                <p>Tasks</p>
            </a>
        </li>
        <li data-menu="#">
            <a href="javsacript:void(0);">
                        <span>
                            <i class="glyphicon glyphicon-cog"></i>
                        </span>
                <p>Settings</p>
            </a>
        </li>
        <li data-menu="calendar">
            <a href="javsacript:void(0);">
                        <span>
                            <i class="glyphicon glyphicon-calendar"></i>
                        </span>
                <p>Calendar</p>
            </a>
        </li>
    </ul>
</nav>
<div class="cd-overlay"></div>


<!-- Javascripts -->
<script src="/admintemplate/assets/plugins/jquery/jquery-2.1.4.min.js"></script>
<script src="/admintemplate/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="/admintemplate/assets/plugins/pace-master/pace.min.js"></script>
<script src="/admintemplate/assets/plugins/jquery-blockui/jquery.blockui.js"></script>
<script src="/admintemplate/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="/admintemplate/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="/admintemplate/assets/plugins/switchery/switchery.min.js"></script>
<script src="/admintemplate/assets/plugins/uniform/jquery.uniform.min.js"></script>
<script src="/admintemplate/assets/plugins/classie/classie.js"></script>
<script src="/admintemplate/assets/plugins/waves/waves.min.js"></script>
<script src="/admintemplate/assets/plugins/3d-bold-navigation/js/main.js"></script>
<script src="/admintemplate/assets/plugins/jquery-mockjax-master/jquery.mockjax.js"></script>
<script src="/admintemplate/assets/plugins/moment/moment.js"></script>
<script src="/admintemplate/assets/plugins/datatables/js/jquery.datatables.min.js"></script>
<script src="/admintemplate/assets/plugins/x-editable/bootstrap3-editable/js/bootstrap-editable.js"></script>
<script src="/admintemplate/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="/admintemplate/assets/js/modern.min.js"></script>
<script src="/admintemplate/assets/js/pages/table-data.js"></script>

<script src="/admintemplate/assets/plugins/select2/js/select2.min.js"></script>
<script type="text/javascript" src="/admintemplate/kendoUI/kendo.all.min.js"></script>


<script type="text/javascript" src="{{ Module::asset('admin:dashboard.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html>