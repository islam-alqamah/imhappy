<x-account-layout>
    <x-slot name="header">
        <div class="d-none d-lg-block">
            <h1 class="h2 text-white">{{ __('Create a new ticket') }}</h1>
        </div>
    </x-slot>
<div class="card">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0 text-primary"><i class="fas fa-ticket-alt"></i> {{ __('Create New Ticket') }}</h3>
        </div>
        <!-- Card body -->
        <div class="card-body">
                
            <form class="form-horizontal offset-sm-2" role="form" method="POST">
                {!! csrf_field() !!}

                <div class="form-group row {{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title" class="col-md-2 col-form-label form-control-label">{{ __('Title') }}</label>
                    <div class="col-md-7">
                        <input id="title" type="text" class="form-control" name="title"
                            value="{{ old('title') }}">

                        @if ($errors->has('title'))
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('category') ? ' has-error' : '' }}">
                    <label for="category" class="col-md-2 col-form-label form-control-label">{{ __('Category') }}</label>

                    <div class="col-md-7">
                        <select id="category" type="category" class="form-control" name="category">
                            <option value="">{{ __('Select Category') }}</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('category'))
                        <span class="help-block">
                            <span class="text-danger">{{ $errors->first('category') }}</sp>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('priority') ? ' has-error' : '' }}">
                    <label for="priority" class="col-md-2 col-form-label form-control-label">Priority</label>

                    <div class="col-md-7">
                        <select id="priority" type="" class="form-control" name="priority">
                            <option value="">{{ __('Select Priority') }}</option>
                            <option value="low">{{ __('Low') }}</option>
                            <option value="medium">{{ __('Medium') }}</option>
                            <option value="high">{{ __('High') }}</option>
                        </select>

                        @if ($errors->has('priority'))
                        <span class="help-block">
                            <span class="text-danger">{{ $errors->first('priority') }}</span>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('message') ? ' has-error' : '' }}">
                    <label for="message" class="col-md-2 col-form-label form-control-label">{{ __('Message') }}</label>

                    <div class="col-md-7">
                        <textarea rows="5" id="message" class="form-control" name="message"></textarea>

                        @if ($errors->has('message'))
                        <span class="help-block">
                            <span class="text-danger">{{ $errors->first('message') }}</span>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 col-md-offset-6">
                        <button type="submit" class="btn btn-soft-primary btn-sm">
                            <i class="fas fa-ticket-alt"></i> {{ __('Open Ticket') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
</div>
</x-account-layout>