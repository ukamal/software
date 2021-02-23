@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
@endphp
{{--@dd($prefix)--}}

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
      <img src="{{ asset('public/backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">DASHBOARD</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{(!empty(Auth::user()->image))?url('public/upload/user_images/'.Auth::user()->image):url('public/upload/no_image.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>
          
          <li class="nav-item {{($prefix=='/users')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage User
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">2</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('view-user') }}" class="nav-link {{($route=='view-user')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View User</p>
                </a>
              </li>
            </ul>
          </li>
        
          <li class="nav-item {{($prefix=='/profiles')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Profile
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">2</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('profiles-view') }}" class="nav-link {{($route=='profiles-view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Your Profile</p>
                </a>
              </li>
                <li class="nav-item">
                    <a href="{{ route('password-view') }}" class="nav-link {{($route=='password-view')?'active':''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Change Password</p>
                    </a>
                </li>
            </ul>
          </li>

          <li class="nav-item {{($prefix=='/suppliers')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Suppliers
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">2</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('view-supplier') }}" class="nav-link {{($route=='view-supplier')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Suppliers</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{($prefix=='/customers')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Customer
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">2</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('view-customer') }}" class="nav-link {{($route=='view-customer')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Customer</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('credit-customer') }}" class="nav-link {{($route=='credit-customer')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Credit Customers</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('paid-customer') }}" class="nav-link {{($route=='paid-customer')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Paid Customers</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('customer-report') }}" class="nav-link {{($route=='customer-report')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customer Wise Report</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{($prefix=='/units')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Units
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">2</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('view-units') }}" class="nav-link {{($route=='view-units')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Units</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{($prefix=='/categories')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Category
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">2</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('view-category') }}" class="nav-link {{($route=='view-category')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Category</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{($prefix=='/products')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Product
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">2</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('view-product') }}" class="nav-link {{($route=='view-product')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Product</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{($prefix=='/purchase')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage purchase
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">3</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('view-purchase') }}" class="nav-link {{($route=='view-purchase')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View purchase</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('pending-list') }}" class="nav-link {{($route=='pending-list')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Approval purchase</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('daily-purchase-report') }}" class="nav-link {{($route=='daily-purchase-report')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daily Purchase Report</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{($prefix=='/invoices')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Invoice
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">4</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('view-invoice') }}" class="nav-link {{($route=='view-invoice')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Invoice</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('invoice-pending-list') }}" class="nav-link {{($route=='invoice-pending-list')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Approval Invoice</p>
                </a>
              </li>
            </ul>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('invoice-print-list') }}" class="nav-link {{($route=='invoice-print-list')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Print Invoice</p>
                </a>
              </li>
            </ul>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('daily-invoice-report') }}" class="nav-link {{($route=='daily-invoice-report')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daily Invoice Report</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{($prefix=='/stocks')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Stock
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">2</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('report-stock') }}" class="nav-link {{($route=='report-stock')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Stock</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('stock-report-supplier-product-wise') }}" class="nav-link {{($route=='stock-report-supplier-product-wise')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Supplier/Product Wise</p>
                </a>
              </li>
            </ul>
          </li>

        </ul>
      </nav>
        <br><br><br>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
