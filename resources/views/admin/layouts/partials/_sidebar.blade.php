@section('sidebar')
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <li class="nav-title">USERS & ACCESS CONTROL</li>
    <!-- Users -->
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#">
            <i class="fa fa-user"></i> Users
        </a>
        <ul class="nav-dropdown-items">
            <li class="nav-item">
                <a class="nav-link{{ return_if(on_page('admin.users.create'), ' active') }}"
                   href="{{ route('admin.users.create') }}">
                    <i class="fa fa-plus"></i> Add User
                </a>
            </li>
            <!-- Impersonate User -->
            @role('admin-root')
                <li class="nav-item">
                    <a class="nav-link{{ return_if(on_page('admin.users.impersonate.index'), ' active') }}"
                       href="{{ route('admin.users.impersonate.index') }}">
                        <i class="fa fa-user"></i>Impersonate User
                    </a>
                </li>
            @endrole
            <li class="nav-item">
                <a class="nav-link{{ return_if(on_page('admin.users.index'), ' active') }}"
                   href="{{ route('admin.users.index') }}">
                    <i class="fa fa-user"></i>Users
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="{{route('admin.stores')}}">
            <i class="fa fa-user"></i> Stores
        </a>
    </li>

    <!-- Permissions -->
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#">
            <i class="fa fa-unlock-alt"></i>Permissions
        </a>
        <ul class="nav-dropdown-items">
            <li class="nav-item">
                <a class="nav-link{{ return_if(on_page('admin.permissions.create'), ' active') }}"
                   href="{{ route('admin.permissions.create') }}">
                    <i class="fa fa-unlock-alt"></i> Add Permission
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ return_if(on_page('admin.permissions.index'), ' active') }}"
                   href="{{ route('admin.permissions.index') }}">
                    <i class="fa fa-unlock-alt"></i> Permissions
                </a>
            </li>
        </ul>
    </li>

    <!-- Roles -->
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#">
            <i class="fa fa-lock"></i> Roles
        </a>
        <ul class="nav-dropdown-items">
            <li class="nav-item">
                <a class="nav-link{{ return_if(on_page('admin.roles.create'), ' active') }}"
                   href="{{ route('admin.roles.create') }}">
                    <i class="icon-plus"></i>  Add Role
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ return_if(on_page('admin.roles.index'), ' active') }}"
                   href="{{ route('admin.roles.index') }}">
                    <i class="fa fa-lock"></i>  Roles
                </a>
            </li>
        </ul>
    </li>
    <!-- Tickets -->
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="fa fa-ticket"></i> Tickets
        </a>
        <ul class="nav-dropdown-items">
            <li class="nav-item">
                <a class="nav-link{{ return_if(on_page('admin.tickets'), ' active') }}"
                    href="{{ route('admin.tickets') }}">
                    <i class="fa fa-ticket"></i>Tickets
                </a>
            </li>
        </ul>
    </li>
    <!-- Plans -->
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#">
            <i class="fa fa-tags"></i> Manage Plans
        </a>
        <ul class="nav-dropdown-items">
            <li class="nav-item">
                <a class="nav-link{{ return_if(on_page('admin.plans.index'), ' active') }}"
                    href="{{ route('admin.plans.index') }}">
                    <i class="fa fa-tags"></i>All Plan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ return_if(on_page('admin.plans.create'), ' active') }}"
                    href="{{ route('admin.plans.create') }}">
                    <i class="icon-plus"></i> Add Plan
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ return_if(on_page('account.index') or on_page('account.profile.index') or on_page('account.password.index') or on_page('account.deactivate.index') or on_page('account.twofactor.index') , ' active') }}" href="#navbar-examples1" data-toggle="collapse" role="button"
           aria-expanded="false" aria-controls="navbar-examples">
            <i class="fas fa-user"></i>
            <span class="nav-link-text">Products</span>
        </a>
        <div class="collapse" id="navbar-examples1">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/products/add') }}">
                        Add Product

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/products/all') }}">
                        All Products

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('all-categories') }}">
                        Categories

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('add-category') }}">
                        Add Category

                    </a>
                </li>
                {{--## Code By Abbas, Cloning Categories ##--}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('all-brands') }}">
                        Brands
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('add-brand') }}">
                        Add Brand
                    </a>
                </li>
            </ul>
                <!-- Coupons -->
    <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="fa fa-tags"></i> Manage Coupons
            </a>
            <ul class="nav-dropdown-items">
                <li class="nav-item">
                    <a class="nav-link{{ return_if(on_page('admin.coupons.index'), ' active') }}"
                        href="{{ route('admin.coupons.index') }}">
                        <i class="fa fa-tags"></i>All Coupons
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ return_if(on_page('admin.coupons.create'), ' active') }}"
                        href="{{ route('admin.coupons.create') }}">
                        <i class="icon-plus"></i> Add Coupon
                    </a>
                </li>
            </ul>
        </li>
        <!-- Soupscriptions -->
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#">
            <i class="fa fa-credit-card"></i> Subscription
        </a>
        <ul class="nav-dropdown-items">
            <li class="nav-item">
                <a class="nav-link{{ return_if(on_page('admin.subscriptions.index'), ' active') }}"
                    href="{{ route('admin.subscriptions.index') }}">
                    <i class="fa fa-tags"></i>All subscription
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="fa fa-envelope"></i> Notification
        </a>
        <ul class="nav-dropdown-items">
            <li class="nav-item">
                <a class="nav-link{{ return_if(on_page('admin.subscriptions.index'), ' active') }}"
                    href="{{ route('admin.annoucement.create') }}">
                    <i class="fa fa-comment"></i>Send Notification
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#">
            <i class="fa fa-gear"></i> Statistics
        </a>
        <ul class="nav-dropdown-items">
            <li class="nav-item">
                <a class="nav-link{{ return_if(on_page('admin.env.index'), ' active') }}"
                    href="{{ route('admin.visitlog') }}">
                    <i class="fa fa-gear"></i>Visitor log
                </a>
            </li>
        </ul>
    </li>
    {{-- Disable this menu cause the Env editor package not yet compatible to Laravel 6 --}}
    {{-- <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="fa fa-gear"></i> Settings
        </a>
        <ul class="nav-dropdown-items">
            <li class="nav-item">
                <a class="nav-link{{ return_if(on_page('admin.env.index'), ' active') }}"
                    href="{{ route('admin.env.index') }}">
                    <i class="fa fa-gear"></i>Env setting
                </a>
            </li>
        </ul>
    </li> --}}
@endsection