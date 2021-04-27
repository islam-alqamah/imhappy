<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ShowUsers extends TableComponent
{
    use HtmlComponents;

    /**
     * @var string
     */
    public $sortField = 'name';

    /**
     * @var string
     */
    public $status;

    /**
     * @param  string  $status
     */
    public function mount($status = 'active'): void
    {
        $this->status = $status;
    }

    public function query() : Builder
    {
        return User::with('roles')->withCount('permissions');
    }

    public function columns() : array
    {
        return [
            Column::make('Avatar')
                ->format(function (User $model) {
                    return $this->image($model->profile_photo_url, $model->name, ['class' => 'img-fluid rounded-circle avatar']);
                }),
            Column::make('Name')
                ->searchable()
                ->sortable(),
            Column::make('E-mail', 'email')
                ->searchable()
                ->sortable()
                ->format(function (User $model) {
                    return $this->mailto($model->email, null, ['target' => '_blank']);
                }),
            Column::make('Verified', 'email_verified_at')
                ->sortable()
                ->searchable()
                ->format(function (User $model) {
                    return $this->html($model->isVerified() ? '<span class="badge badge-soft-success">Verified</span>' : '<span class="badge badge-soft-danger">Unverified</span>');
                }),
            Column::make('Status', 'active')
                ->sortable()
                ->searchable()
                ->format(function (User $model) {
                    return $this->html($model->isActive() ? '<span class="badge badge-soft-success">Active</span>' : '<span class="badge badge-soft-danger">Inactive</span>');
                }),
            Column::make('Role', 'roles.name')
                ->searchable()
                ->sortable()
                ->format(function (User $model) {
                    return $model->getRolesLabelAttribute();
                    // if(\Laravel\Jetstream\Jetstream::hasRoles()){
                    //     'admin';
                    // }
                }),
            // Column::make('Permissions')
            //     ->sortable()
            //     ->format(function(User $model) {
            //         return $this->html('<strong>'.$model->permissions_count.'</strong>');
            //     }),
            // Column::make('Team')
            //     ->sortable()
            //     ->format(function(User $model) {
            //         return $this->html($model->getUserTeams()) ;
            //     }),
            Column::make('Actions')
                ->format(function (User $model) {
                    return view('admin.includes.actions', ['user' => $model]);
                }),
                // ->hideIf(auth()->user()->cannot('do-this')),
        ];
    }
}
