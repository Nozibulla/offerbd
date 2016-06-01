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
            <li><a href="/admin/dashboard"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a></li>

            @if(Auth::guard('admin')->user()->hasRole("owner"))
            
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Admin
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ url('/admin/pending-admin') }}">Pending List</a></li>
                    <li><a href="{{ url('/admin/approved-admin') }}">Approved List</a></li>
                    <li><a href="{{ url('/admin/rolewise-admin') }}">Role per Admin</a></li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            @endif
            <li>
                <a href="#"><i class="fa fa-sitemap fa-fw"></i> Advertisements
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ url('/admin/advertisements/post-ad') }}">Post</a></li>
                    <li><a href="{{ url('/admin/advertisements/pending-ad') }}">Pending</a></li>
                    <li><a href="{{ url('/admin/advertisements/approved-ad') }}">Approved</a></li>
                    <li><a href="{{ url('/admin/advertisements/archived-ad') }}">Archived</a></li>
                </ul>
                <!-- < /.nav-second-level > -->
            </li>
            <li>
                <a href="#"><i class="fa fa-sitemap fa-fw"></i> Products
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ url('/admin/products/add-product') }}">Add</a></li>
                    <li><a href="{{ url('/admin/products/pending-product') }}">Pending</a></li>
                    <li><a href="{{ url('/admin/products/approved-product') }}">Approved</a></li>
                </ul>
                <!-- < /.nav-second-level > -->
            </li>
            <li>
                <a href="#"><i class="fa fa-sitemap fa-fw"></i>Category
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ url('/admin/category/add-category') }}">Add</a></li>
                    <li><a href="{{ url('/admin/category/pending-category') }}">Pending</a></li>
                    <li><a href="{{ url('/admin/category/approved-category') }}">Approved</a></li>
                </ul>
                <!-- < /.nav-second-level > -->
            </li>
            <li>
                <a href="#"><i class="fa fa-sitemap fa-fw"></i> Branches
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ url('/admin/branch/add-branch') }}">Add</a></li>
                    <li><a href="{{ url('/admin/branch/pending-branch') }}">Pending</a></li>
                    <li><a href="{{ url('/admin/branch/approved-branch') }}">Approved</a></li>
                </ul>
                <!-- < /.nav-second-level > -->
            </li>
            <li>
                <a href="#"><i class="fa fa-sitemap fa-fw"></i> Brands
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ url('/admin/brands/add-brand') }}">Add</a></li>
                    <li><a href="{{ url('/admin/brands/pending-brand') }}">Pending</a></li>
                    <li><a href="{{ url('/admin/brands/approved-brand') }}">Approved</a></li>
                </ul>
                <!-- < /.nav-second-level > -->
            </li>
            <li><a href="{{ url('/admin/adproviders/list') }}">Adproviders</a></li>
            <li><a href="{{ url('/admin/subscriptions/list') }}">Subscriptions</a></li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav>