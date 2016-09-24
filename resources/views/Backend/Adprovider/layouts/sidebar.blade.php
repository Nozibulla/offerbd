<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="{{ url('/adprovider/dashboard') }}">
                    <i class="fa fa-dashboard fa-fw"></i> 
                    Dashboard
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-sitemap fa-fw"></i> 
                    Advertisements
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('/adprovider/advertisements/post-ad') }}">Post</a>
                    </li>
                    <li>
                        <a href="{{ url('/adprovider/advertisements/pending-ad') }}">Pending</a>
                    </li>
                    <li>
                        <a href="{{ url('/adprovider/advertisements/approved-ad') }}">Approved</a>
                    </li>
                    <li>
                        <a href="{{ url('/adprovider/advertisements/archived-ad') }}">Archived</a>
                    </li>
                </ul>
                <!-- < /.nav-second-level > -->
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-sitemap fa-fw"></i> 
                    Products
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('/adprovider/products/add-product') }}">Add</a>
                    </li>
                    <li>
                        <a href="{{ url('/adprovider/products/pending-product') }}">Pending</a>
                    </li>
                    <li>
                        <a href="{{ url('/adprovider/products/approved-product') }}">Approved</a>
                    </li>
                </ul>
                <!-- < /.nav-second-level > -->
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-sitemap fa-fw"></i> 
                    Category
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('/adprovider/category/add-category') }}">Add</a>
                    </li>
                    <li>
                        <a href="{{ url('/adprovider/category/pending-category') }}">Pending</a>
                    </li>
                    <li>
                        <a href="{{ url('/adprovider/category/approved-category') }}">Approved</a>
                    </li>
                </ul>
                <!-- < /.nav-second-level > -->
            </li>
            <li>
                <a href="{{ url('#') }}">
                    <i class="fa fa-sitemap fa-fw"></i> 
                    Branches
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('/adprovider/branch/add-branch') }}">Add</a>
                    </li>
                    <li>
                        <a href="{{ url('/adprovider/branch/pending-branch') }}">Pending</a>
                    </li>
                    <li>
                        <a href="{{ url('/adprovider/branch/approved-branch') }}">Approved</a>
                    </li>
                </ul>
                <!-- < /.nav-second-level > -->
            </li>
            <li>
                <a href="{{ url('#') }}">
                    <i class="fa fa-sitemap fa-fw"></i> 
                    Brands
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('/adprovider/brands/add-brand') }}">Add</a>
                    </li>
                    <li>
                        <a href="{{ url('/adprovider/brands/pending-brand') }}">Pending</a>
                    </li>
                    <li>
                        <a href="{{ url('/adprovider/brands/approved-brand') }}">Approved</a>
                    </li>
                </ul>
                <!-- < /.nav-second-level > -->
            </li>
            <!-- <li>
                <a href="{{ url('/adprovider/subscriptions/list') }}">
                    Subscriptions
                </a>
            </li> -->
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav>