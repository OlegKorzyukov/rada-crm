<div class="sidebar_wrapper">
      <ul>
            <li><a href="/">
                        <img class="sidebar__list-img" src="{{ asset('/images/icons/sidebar_statistic.svg') }}" alt="">{{__('sidebar.statistic')}}</a>
            </li>
            @can ('viewAny', App\Models\User::class)
            <li><a href="{{ route('users') }}">
                        <img class="sidebar__list-img" src="{{ asset('/images/icons/sidebar_users.svg') }}" alt="">{{__('sidebar.users')}}</a>
            </li>
            @endcan
            @can ('viewAny', App\Models\Group::class)
            <li><a href="{{ route('groups') }}">
                        <img class="sidebar__list-img" src="{{ asset('/images/icons/sidebar_groups.svg') }}" alt="">{{__('sidebar.groups')}}</a>
            </li>
            @endcan
            @can ('viewAny', App\Models\Task::class)
            <li><a href="{{ route('tasks') }}">
                        <img class="sidebar__list-img" src="{{ asset('/images/icons/sidebar_tasks.svg') }}" alt="">{{__('sidebar.tasks')}}</a>
            </li>
            @endcan
            @can ('viewAny', App\Models\Department::class)
            <li><a href="{{route('departments')}}">
                        <img class="sidebar__list-img" src="{{ asset('/images/icons/sidebar_department.svg') }}" alt="">{{__('sidebar.departments')}}</a>
            </li>
            @endcan
            @can ('readFile', App\Models\File::class)
            <li><a href="/">
                        <img class="sidebar__list-img" src="{{ asset('/images/icons/sidebar_files.svg') }}" alt="">{{__('sidebar.files')}}</a>
            </li>
            @endcan
            <li><a href="/">
                        <img class="sidebar__list-img" src="{{ asset('/images/icons/sidebar_user-history.svg') }}" alt="">{{__('sidebar.historyUser')}}</a>
            </li>
            <li><a href="/">
                        <img class="sidebar__list-img" src="{{ asset('/images/icons/sidebar_settings.svg') }}" alt="">{{__('sidebar.settings')}}</a>
            </li>
      </ul>
</div>