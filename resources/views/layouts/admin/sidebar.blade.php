<div class="vertical-menu">

    <div data-simplebar class="h-100">

        @php
            $admin_sidebar_data = \SiteHelper::getAdminSidebarTree();
        @endphp

        <!--- Sidemenu -->

        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Apps</li>
                @if (!empty($admin_sidebar_data))
                    @foreach ($admin_sidebar_data as $item)
                        @if ($item->is_multi_level == 0)
                            <li class="{{ Request::is($item->active_cases) ? 'mm-active' : '' }}">
                                <a href="{{ route($item->route_name) }}"
                                    class="waves-effect {{ Request::is($item->active_cases) ? 'active' : '' }}">
                                    {!! $item->icon !!}
                                    <span key="t-{{ str_replace('_', '', $item->name) }}">{{ $item->name }}</span>
                                </a>
                            </li>
                        @else
                            <li class="{{ Request::is($item->active_cases) ? 'mm-active' : '' }}">
                                <a href="javascript: void(0);"
                                    class="has-arrow waves-effect {{ Request::is($item->active_cases) ? 'mm-active' : '' }}"
                                    aria-expanded="{{ Request::is($item->active_cases) ? 'true' : 'false' }}">
                                    {!! $item->icon !!}
                                    <span key="t-{{ str_replace('_', '', $item->name) }}">{{ $item->name }}</span>
                                </a>
                                @if ($item->sub_modules_count > 0)
                                    <ul class="sub-menu {{ Request::is($item->active_cases) ? 'mm-show' : '' }}"
                                        aria-expanded="false">
                                        @foreach ($item->sub_modules as $sub_module)
                                            @php
                                                if (!empty($sub_module->url_slug)) {
                                                    $url = route($sub_module->route_name, $sub_module->route_params);
                                                } else {
                                                    $url = route($sub_module->route_name);
                                                }
                                            @endphp
                                            <li class="{{ Request::is($sub_module->active_cases) ? 'mm-active' : '' }}">
                                                <a href="{{ $url }}" class="{{ Request::is($sub_module->active_cases) ? 'active' : '' }}" key="t-{{ str_replace('_', '', $sub_module->name) }}"> {!! $sub_module->icon !!} {{ $sub_module->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endif
                    @endforeach
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
