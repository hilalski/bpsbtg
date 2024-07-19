<div class="pagetitle">
    @if (request()->url() === url("/dashboard"))
        <h1>Dashboard</h1>
    @else
        @if (isset($menu))
            @php $currentUrl = request()->url(); $menuMatch = false; $submenuMatch = false; $urlmenuMatch = false; $urlsubmenuMatch = false; @endphp
            @foreach($menu as $m)
                @foreach ($m->submenu as $sm)
                    @foreach ($sm->subsubmenu as $ssm)
                        @if (request()->is("dashboard/{$m->url}/{$sm->url}/{$ssm->url}*"))
                            <h1>{{ $ssm->name }}</h1>
                            @php $submenuMatch = true; @endphp
                        @endif
                    @endforeach
                    @if (!$submenuMatch && request()->is("dashboard/{$m->url}/{$sm->url}*"))
                        <h1>{{ $sm->name }}</h1>
                        @php $menuMatch = true; @endphp
                    @endif
                @endforeach
                @if (!$menuMatch && !$submenuMatch && request()->is("dashboard/{$m->url}*"))
                    <h1>{{ $m->name }}</h1>
                @endif
            @endforeach
        @endif
    @endif
    <nav>
        <ol id="breadcrumb-web-bau" class="breadcrumb">
            <li class="breadcrumb-item {{ request()->url() === url("/dashboard") ? 'active' : '' }}">
                <a href="{{ route('home.index') }}">Dashboard</a>
            </li>
            @if (isset($menu))
                @foreach($menu as $m)
                    @if (request()->is("dashboard/{$m->url}*"))
                        @if (count($m->submenu) > 0)
                            <li class="breadcrumb-item pe-none">
                                <a>
                                    {{ $m->name }}
                                </a>
                                @foreach ($m->submenu as $sm)
                                    @foreach ($sm->subsubmenu as $ssm)
                                        @if (request()->is("dashboard/{$m->url}/{$sm->url}/{$ssm->url}*"))
                                            <li class="breadcrumb-item">
                                                <a href="/dashboard/{{ $m->url }}/{{ $sm->url }}">
                                                    {{ $sm->name }}
                                                </a>
                                                <li class="breadcrumb-item active">
                                                    <a href="/dashboard/{{ $m->url }}/{{ $sm->url }}/{{ $ssm->url }}">
                                                        {{ $ssm->name }}
                                                    </a>
                                                </li>
                                            </li>
                                            @php $urlsubmenuMatch = true; @endphp
                                        @endif
                                    @endforeach
                                    @if (!$urlsubmenuMatch && request()->is("dashboard/{$m->url}/{$sm->url}*"))
                                        <li class="breadcrumb-item active">
                                            <a href="/dashboard/{{ $m->url }}/{{ $sm->url }}">
                                                {{ $sm->name }}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </li>
                        @else
                            <li class="breadcrumb-item active">
                                <a>
                                    {{ $m->name }}
                                </a>
                            </li>
                        @endif
                    @endif
                @endforeach
            @endif
        </ol>
    </nav>
</div>
