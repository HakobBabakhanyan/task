<div class="sidebar-container">
    <div class="sidebar-logo">
        {{ env('APP_NAME') }}
    </div>
    <ul class="sidebar-navigation">
        <li class="header">Navigation</li>
        <li @if(($page??null) == 'users') class="active" @endif>
            <a href="{{ route('users.main') }}">
                Users
            </a>
        </li>
        <li @if(($page??null) == 'countries') class="active" @endif>
            <a href="{{ route('countries.main') }}">
                Countries
            </a>
        </li>
    </ul>
</div>
