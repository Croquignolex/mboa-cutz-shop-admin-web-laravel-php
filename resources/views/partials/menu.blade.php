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
                {{--Orders--}}
                <li  class="">
                    <a class="sidenav-item-link" href="#">
                        <i class="mdi mdi-library-books"></i>
                        <span class="nav-text">Commandes</span>
                    </a>
                </li>
                {{--Booking--}}
                <li  class="">
                    <a class="sidenav-item-link" href="#">
                        <i class="mdi mdi-bookmark-check"></i>
                        <span class="nav-text">Reservations</span>
                    </a>
                </li>
                {{--Customers--}}
                <li class="has-sub expand">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#customers" aria-expanded="false" aria-controls="customers">
                        <i class="mdi mdi-account-multiple-outline"></i>
                        <span class="nav-text">Clients</span> <b class="caret"></b>
                    </a>
                    <ul class="collapse" id="customers" data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            <li class="">
                                <a class="sidenav-item-link" href="#">
                                    <span class="nav-text">
                                        <i class="mdi mdi-playlist-check"></i>
                                        Tous les clients
                                    </span>
                                </a>
                            </li>
                            <li class="">
                                <a class="sidenav-item-link" href="#">
                                    <span class="nav-text">
                                        <i class="mdi mdi-playlist-plus"></i>
                                        Nouveau client
                                    </span>
                                </a>
                            </li>
                        </div>
                    </ul>
                </li>
                {{--Categories--}}
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
                                        Toutes les categories
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
                {{--Tags--}}
                <li class="has-sub expand {{ active_page(tags_pages()) }}">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#tags" aria-expanded="false" aria-controls="tags">
                        <i class="mdi mdi-tag-multiple"></i>
                        <span class="nav-text">Etiquettes</span> <b class="caret"></b>
                    </a>
                    <ul class="collapse {{ active_page_group(tags_pages()) }}" id="tags" data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            <li class="{{ active_page(collect('tags.index')) }}">
                                <a class="sidenav-item-link" href="{{ route('tags.index') }}">
                                    <span class="nav-text">
                                        <i class="mdi mdi-playlist-check"></i>
                                        Toutes les étiquettes
                                    </span>
                                </a>
                            </li>
                            <li class="{{ active_page(collect('tags.create')) }}">
                                <a class="sidenav-item-link" href="{{ route('tags.create') }}">
                                    <span class="nav-text">
                                        <i class="mdi mdi-playlist-plus"></i>
                                        Nouvelle étiquette
                                    </span>
                                </a>
                            </li>
                        </div>
                    </ul>
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
                {{--Services--}}
                <li class="has-sub expand {{ active_page(services_pages()) }}">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#services" aria-expanded="false" aria-controls="services">
                        <i class="mdi mdi-shopping"></i>
                        <span class="nav-text">Services</span> <b class="caret"></b>
                    </a>
                    <ul class="collapse {{ active_page_group(services_pages()) }}" id="services" data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            <li class="{{ active_page(collect('services.index')) }}">
                                <a class="sidenav-item-link" href="{{ route('services.index') }}">
                                    <span class="nav-text">
                                        <i class="mdi mdi-playlist-check"></i>
                                        Tous les services
                                    </span>
                                </a>
                            </li>
                            <li class="{{ active_page(collect('services.create')) }}">
                                <a class="sidenav-item-link" href="{{ route('services.create') }}">
                                    <span class="nav-text">
                                        <i class="mdi mdi-playlist-plus"></i>
                                        Nouveau service
                                    </span>
                                </a>
                            </li>
                        </div>
                    </ul>
                </li>
                {{--Blog--}}
                <li class="has-sub expand">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#blog" aria-expanded="false" aria-controls="blog">
                        <i class="mdi mdi-blinds"></i>
                        <span class="nav-text">Blog</span> <b class="caret"></b>
                    </a>
                    <ul class="collapse" id="blog" data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            <li class="">
                                <a class="sidenav-item-link" href="#">
                                    <span class="nav-text">
                                        <i class="mdi mdi-playlist-check"></i>
                                        Tous les artcles
                                    </span>
                                </a>
                            </li>
                            <li class="">
                                <a class="sidenav-item-link" href="#">
                                    <span class="nav-text">
                                        <i class="mdi mdi-playlist-plus"></i>
                                        Nouvel article
                                    </span>
                                </a>
                            </li>
                        </div>
                    </ul>
                </li>
                {{--Testimonials--}}
                <li class="has-sub expand {{ active_page(testimonials_pages()) }}">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#testimonials" aria-expanded="false" aria-controls="testimonials">
                        <i class="mdi mdi-face"></i>
                        <span class="nav-text">Témoignages</span> <b class="caret"></b>
                    </a>
                    <ul class="collapse {{ active_page_group(testimonials_pages()) }}" id="testimonials" data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            <li class="{{ active_page(collect('testimonials.index')) }}">
                                <a class="sidenav-item-link" href="{{ route('testimonials.index') }}">
                                    <span class="nav-text">
                                        <i class="mdi mdi-playlist-check"></i>
                                        Tous les témoignages
                                    </span>
                                </a>
                            </li>
                            <li class="{{ active_page(collect('testimonials.create')) }}">
                                <a class="sidenav-item-link" href="{{ route('testimonials.create') }}">
                                    <span class="nav-text">
                                        <i class="mdi mdi-playlist-plus"></i>
                                        Nouveau témoignage
                                    </span>
                                </a>
                            </li>
                        </div>
                    </ul>
                </li>
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
            </ul>
        </div>
    </div>
</aside>