@inject('contactService', 'App\Services\ContactService')
<header class="main-header " id="header">
    <nav class="navbar navbar-static-top navbar-expand-lg">
        <button id="sidebar-toggler" class="sidebar-toggle">
            <span class="sr-only">Toggle navigation</span>
        </button>
        <div class="search-form d-none d-lg-inline-block"></div>
        <div class="navbar-right ">
            <ul class="nav navbar-nav">
                <li class="dropdown notifications-menu">
                    <button class="dropdown-toggle" data-toggle="dropdown">
                        <i class="mdi mdi-bell-ring-outline"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li class="dropdown-header">{{ $contactService->unreadMessagesNumber() }} Nouveau messages</li>

                        @foreach($contactService->unreadMessagesToDisplay() as $contact)
                            <li class="m-4">
                                <i class="mdi mdi-email"></i> <span class="text-theme">{{ text_format($contact->subject, 30) }}</span>
                                <p>{{ text_format($contact->message, 65) }} </p>
                                <span class=" font-size-12 d-inline-block float-right text-theme"><i class="mdi mdi-clock-outline"></i> {{ $contact->creation_date }}</span>
                            </li>
                            @if(!$loop->last)<li class="dropdown-divider"></li>@endif
                        @endforeach

                        <li class="dropdown-footer">
                            <a class="text-center" href="{{ route('contacts.index') }}"> Tout voir </a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown user-menu">
                    <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <img src="{{ auth()->user()->avatar_src }}" class="async-image img-responsive" alt="..." />
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li class="dropdown-header">
                            <div class="d-inline-block">
                                {{ text_format(auth()->user()->full_name, 18) }}
                                <small class="pt-1">{{ text_format(auth()->user()->email, 20) }}</small>
                                <small>
                                    <span class="badge badge-pill badge-{{ auth()->user()->role->badge_color }} mt-2">
                                        {{ auth()->user()->role->name }}
                                    </span>
                                </small>
                            </div>
                        </li>
                        <li class="{{ active_page(collect(['profile.index'])) === 'active' ? 'bg-light' : '' }}">
                            <a href="{{ route('profile.index') }}">
                                <i class="mdi mdi-account"></i> Mon Profil
                            </a>
                        </li>
                        <li class="{{ active_page(collect(['profile.logs'])) === 'active' ? 'bg-light' : '' }}">
                            <a href="{{ route('profile.logs') }}">
                                <i class="mdi mdi-newspaper"></i> Mon journal
                            </a>
                        </li>
                        <li class="dropdown-footer">
                            <a class="nav-link logout" href="javascript: void(0);" role="button"
                               onclick="document.getElementById('logout-form').submit();">
                                <i class="mdi mdi-logout"></i>
                                Déconnexion
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
