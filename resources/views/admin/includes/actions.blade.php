<x-utils.view-button :href="route('admin.users.show', $user)" />
<x-utils.edit-button :href="route('admin.users.edit', $user)" />

<div class="dropdown d-inline-block">
    <a class="btn btn-sm btn-secondary dropdown-toggle" id="moreMenuLink" href="#" role="button" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
        {{ __('More') }}
    </a>

    <div class="dropdown-menu" aria-labelledby="moreMenuLink">
        <x-utils.link
            :href="route('admin.users.show', $user)"
            class="dropdown-item"
            :text="__('Change Password')"
            permission="" />
            @canBeImpersonated($user)
                <x-utils.link
                :href="route('impersonate', $user->id)"
                class="dropdown-item"
                :text="__('Login As ' . $user->name)"
                permission="" />
            @endCanBeImpersonated
    </div>
</div>

<div class="dropdown-menu dropdown-menu-right dropdown" style="width: 150px; position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(1139px, 168px, 0px);" aria-labelledby="actions1Invoker" x-placement="bottom-end">
    <ul class="list-unstyled mb-0">
        <li>
            <a class="d-flex align-items-center link-muted py-2 px-3" href="#!">
                <i class="fa fa-plus mr-2"></i> {{ __('Add') }}
            </a>
        </li>
        <li>
            <a class="d-flex align-items-center link-muted py-2 px-3" href="#!">
                <i class="fa fa-minus mr-2"></i> {{ __('Remove') }}
            </a>
        </li>
    </ul>
</div>