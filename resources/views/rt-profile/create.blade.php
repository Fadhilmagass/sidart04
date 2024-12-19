<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create RT Profile') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header text-center">
                        <h1>Create RT Profile</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('rt-profile.store') }}" method="POST">
                            @csrf
                            <x-form-group label="Name" name="name" type="text" required />
                            <x-form-group label="Address" name="address" type="text" required />
                            <x-form-group label="Phone" name="phone" type="text" required />
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>