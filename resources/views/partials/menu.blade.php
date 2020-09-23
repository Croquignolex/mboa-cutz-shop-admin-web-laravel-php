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
                {{--Produits--}}
                <li class="has-sub expand {{ active_page(products_pages()) }}">
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