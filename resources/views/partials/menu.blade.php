<aside class="left-sidebar bg-sidebar">
    <div id="sidebar" class="sidebar sidebar-with-footer">
        <div class="app-brand bg-theme">
            <a href="{{ route('dashboard.index') }}">
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
                {{--Categoris--}}
                <li class="has-sub expand {{ active_page(categories_pages()) }}">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#categories" aria-expanded="false" aria-controls="categories">
                        <i class="mdi mdi-database"></i>
                        <span class="nav-text">Categories</span> <b class="caret"></b>
                    </a>
                    <ul class="collapse {{ active_page_group(categories_pages()) }}" id="categories" data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            <li class="{{ active_page(collect('categories.index')) }}">
                                <a class="sidenav-item-link" href="{{ route('categories.index') }}">
                                    <span class="nav-text">
                                        <i class="mdi mdi-playlist-check"></i>
                                        Tous les categories
                                    </span>
                                </a>
                            </li>
                            <li class="{{ active_page(collect('categories.create')) }}">
                                <a class="sidenav-item-link" href="{{ route('categories.create') }}">
                                    <span class="nav-text">
                                        <i class="mdi mdi-playlist-plus"></i>
                                        Nouvelle categorie
                                    </span>
                                </a>
                            </li>
                        </div>
                    </ul>
                </li>
                {{--Produits--}}
                {{--<li class="has-sub expand {{ active_page(products_pages()) }}">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#products" aria-expanded="false" aria-controls="products">
                        <i class="mdi mdi-basket"></i>
                        <span class="nav-text">Produits</span> <b class="caret"></b>
                    </a>
                    <ul class="collapse {{ active_page_group(products_pages()) }}" id="products" data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            <li class="{{ active_page(collect('products.index')) }}">
                                <a class="sidenav-item-link" href="{{ route('products.index') }}">
                                    <span class="nav-text">
                                        <i class="mdi mdi-playlist-check"></i>
                                        Tous les produits
                                    </span>
                                </a>
                            </li>
                            <li class="{{ active_page(collect('products.create')) }}">
                                <a class="sidenav-item-link" href="{{ route('products.create') }}">
                                    <span class="nav-text">
                                        <i class="mdi mdi-playlist-plus"></i>
                                        Nouveau produit
                                    </span>
                                </a>
                            </li>
                        </div>
                    </ul>
                </li>--}}
                {{--Admins--}}
                <li class="has-sub expand {{ active_page(admins_pages()) }}">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#admins" aria-expanded="false" aria-controls="admins">
                        <i class="mdi mdi-account-multiple"></i>
                        <span class="nav-text">Administrateurs</span> <b class="caret"></b>
                    </a>
                    <ul class="collapse {{ active_page_group(admins_pages()) }}" id="admins" data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            <li class="{{ active_page(collect('admins.index')) }}">
                                <a class="sidenav-item-link" href="{{ route('admins.index') }}">
                                    <span class="nav-text">
                                        <i class="mdi mdi-playlist-check"></i>
                                        Tous les administrateurs
                                    </span>
                                </a>
                            </li>
                            <li class="{{ active_page(collect('admins.create')) }}">
                                <a class="sidenav-item-link" href="{{ route('admins.create') }}">
                                    <span class="nav-text">
                                        <i class="mdi mdi-playlist-plus"></i>
                                        Nouvel administrateur
                                    </span>
                                </a>
                            </li>
                        </div>
                    </ul>
                </li>
                {{--Dashboard--}}
                <li  class="{{ active_page(archives_pages()) }}">
                    <a class="sidenav-item-link" href="{{ route('archives.index') }}">
                        <i class="mdi mdi-archive"></i>
                        <span class="nav-text">Archives</span>
                    </a>
                </li>
                {{--Articles--}}
               {{-- <li class="has-sub expand {{ active_page(articles_pages()) }}">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#articles" aria-expanded="false" aria-controls="articles">
                        <i class="mdi mdi-format-float-left"></i>
                        <span class="nav-text">Articles</span> <b class="caret"></b>
                    </a>
                    <ul class="collapse {{ active_page_group(articles_pages()) }}" id="articles" data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            <li class="{{ active_page(collect('articles.index')) }}">
                                <a class="sidenav-item-link" href="{{ route('articles.index') }}">
                                    <span class="nav-text">
                                        <i class="mdi mdi-playlist-check"></i>
                                        Tous les articles
                                    </span>
                                </a>
                            </li>
                            <li class="{{ active_page(collect('articles.create')) }}">
                                <a class="sidenav-item-link" href="{{ route('articles.create') }}">
                                    <span class="nav-text">
                                        <i class="mdi mdi-playlist-plus"></i>
                                        Nouvel article
                                    </span>
                                </a>
                            </li>
                        </div>
                    </ul>
                </li>--}}
            </ul>
        </div>
    </div>
</aside>