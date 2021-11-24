<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin') }}" class="brand-link">
        <img src="{{ asset('backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Laravel Shopping</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if(!Auth::user()->profile->avatar && Auth::user()->profile->gender =="male" )
                <img src="{{ asset('backend/dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
                @elseif(!Auth::user()->profile->avatar && Auth::user()->profile->gender =="female")
                <img src="{{ asset('backend/dist/img/avatar3.png') }}" class="img-circle elevation-2" alt="User Image">
                @else
                <img src="{{ asset('avatar-image/'.Auth::user()->profile->avatar) }}" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="{{ route('admin') }}" class="d-block">
                    {{ Auth::user()->name}}
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                @role('super-admin|admin|product-manager')
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="fa fa-tachometer" aria-hidden="true"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{ route('welcome') }}" class="nav-link">
                                <i class="fa fa-home" aria-hidden="true"></i>
                                <p>Go To Home Page</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin') }}" class="nav-link">
                                <i class="fa fa-tachometer" aria-hidden="true"></i>
                                <p>Dashborad</p>
                            </a>
                        </li>
                        @role('super-admin|admin')
                        <li class="nav-item">
                            <a href="{{ route('slider.index') }}" class="nav-link">
                                <i class="fa fa-sliders" aria-hidden="true"></i>
                                <p>Slider</p>
                            </a>
                        </li>
                        @endrole
                        <li class="nav-item">
                            <a href="{{ route('order.index') }}" class="nav-link">
                                <i class="fa fa-cutlery" aria-hidden="true"></i>
                                <p>Orders</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endrole
                @role('super-admin|admin|product-manager|post-editor')
                <li class="nav-item">
                    <a href="{{ route('notification.index') }}" class="nav-link">
                        <i class="fa fa-bell" aria-hidden="true"></i>
                        <p>
                            Notifications
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('category.index') }}" class="nav-link">
                        <i class="fa fa-sort" aria-hidden="true"></i>
                        <p>
                            Category
                        </p>
                    </a>
                </li>
                @endrole
                @role('super-admin|admin|post-editor')
                <li class="nav-item">
                    <a href="{{ route('post.index') }}" class="nav-link">
                        <i class="fa fa-clipboard" aria-hidden="true"></i>
                        <p>
                            Posts
                        </p>
                    </a>
                </li>
                @endrole
                @role('super-admin|admin|post-editor')
                <li class="nav-item">
                    <a href="{{ route('comment.index') }}" class="nav-link">
                        <i class="fa fa-commenting" aria-hidden="true"></i>
                        <p>
                            Comments
                        </p>
                    </a>
                </li>
                @endrole
                @role('super-admin|admin')
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
                @endrole
                @role('super-admin')
                <li class="nav-item">
                    <a href="{{ route('role.index') }}" class="nav-link">
                        <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                        <p>
                            Roles
                        </p>
                    </a>
                </li>
                @endrole
                <li class="nav-item">
                    <a href="{{ route('fileManager') }}" class="nav-link">
                        <i class="fa fa-film" aria-hidden="true"></i>
                        <p>
                            File And Media
                        </p>
                    </a>
                </li>
                @role('super-admin|admin|product-manager')
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                        <p>
                            Products
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{ route('product.create') }}" class="nav-link">
                                <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                <p>Create New Product</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('product.index') }}" class="nav-link">
                                <i class="fa fa-list-alt" aria-hidden="true"></i>
                                <p>List Products</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('brand.index') }}" class="nav-link">
                                <i class="fa fa-building-o" aria-hidden="true"></i>
                                <p>Brand Products</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('option.index') }}" class="nav-link">
                                <i class="fa fa-filter" aria-hidden="true"></i>
                                <p>Options Product</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('coupon.index') }}" class="nav-link">
                                <i class="fa fa-percent" aria-hidden="true"></i>
                                <p>Add Coupon</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('salesDate') }}" class="nav-link">
                                <i class="fa fa-calendar-o" aria-hidden="true"></i>
                                <p>Sale Date</p>
                            </a>
                        </li>
                    </ul>

                </li>
                @endrole
                @role('super-admin|admin')
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="fa fa-file-text" aria-hidden="true"></i>
                        <p>
                            Pages
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{ route('admin.aboutUs') }}" class="nav-link">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                <p>About Us</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.privacyPolicy') }}" class="nav-link">
                                <i class="fa fa-user-secret" aria-hidden="true"></i>
                                <p>Privacy & Policy</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('testimonials.index') }}" class="nav-link">
                        <i class="fa fa-text-height" aria-hidden="true"></i>
                        <p>
                            Testimonials
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('setting') }}" class="nav-link">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                        <p>
                            Setting
                        </p>
                    </a>
                </li>
                @endrole
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
