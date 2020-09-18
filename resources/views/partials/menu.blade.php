<aside class="left-sidebar bg-sidebar">
    <div id="sidebar" class="sidebar sidebar-with-footer">
        <div class="app-brand bg-theme">
            <a href="{{ route('dashboard.index') }}" class="text-center">
                <img src="{{ img_asset('logo', 'jpg') }}" alt="..." width="40">
                <span class="brand-name">{{ config('app.name') }}</span>
            </a>
        </div>
        <div class="sidebar-scrollbar">
            <ul class="nav sidebar-inner" id="sidebar-menu">
                {{--Dashboard--}}
                <li  class="{{ active_page(collect('dashboard.index')) }}">
                    <a class="sidenav-item-link" href="{{ route('dashboard.index') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span class="nav-text">Tableau de board</span>
                    </a>
                </li>
                {{--Blog--}}
                <li class="has-sub expand {{ active_page(blog_pages()) }}">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#blog" aria-expanded="false" aria-controls="blog">
                        <i class="mdi mdi-format-float-left"></i>
                        <span class="nav-text">Blog</span> <b class="caret"></b>
                    </a>
                    <ul class="collapse {{ active_page_group(blog_pages()) }}" id="blog" data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            <li class="{{ active_page(collect('blog.index')) }}">
                                <a class="sidenav-item-link" href="{{ route('blog.index') }}">
                                    <span class="nav-text">
                                        <i class="mdi mdi-format-align-left"></i>
                                        Tous les articles
                                    </span>
                                </a>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</aside>