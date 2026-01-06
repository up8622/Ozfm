@can('view-any', App\Models\Administrator::class)
<x-responsive-nav-link
    href="{{ route('dashboard.administrators.index') }}"
    :active="request()->routeIs('dashboard.administrators.index')"
>
    {{ __('navigation.administrators') }}
</x-responsive-nav-link>
@endcan @can('view-any', App\Models\Usluga::class)
<x-responsive-nav-link
    href="{{ route('dashboard.uslugas.index') }}"
    :active="request()->routeIs('dashboard.uslugas.index')"
>
    {{ __('navigation.uslugas') }}
</x-responsive-nav-link>
@endcan @can('view-any', App\Models\Pacijent::class)
<x-responsive-nav-link
    href="{{ route('dashboard.pacijents.index') }}"
    :active="request()->routeIs('dashboard.pacijents.index')"
>
    {{ __('navigation.pacijents') }}
</x-responsive-nav-link>
@endcan @can('view-any', App\Models\Terapeut::class)
<x-responsive-nav-link
    href="{{ route('dashboard.terapeuts.index') }}"
    :active="request()->routeIs('dashboard.terapeuts.index')"
>
    {{ __('navigation.terapeuts') }}
</x-responsive-nav-link>
@endcan @can('view-any', App\Models\Termin::class)
<x-responsive-nav-link
    href="{{ route('dashboard.termins.index') }}"
    :active="request()->routeIs('dashboard.termins.index')"
>
    {{ __('navigation.termins') }}
</x-responsive-nav-link>
@endcan
