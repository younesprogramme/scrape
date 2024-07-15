{{-- <x-app-layout> --}}
    
    <x-slot name="header">
        {{-- {{ __('Users') }} --}}
    </x-slot>
    <style>
        table > thead {
            position: relative;
            background-color: white;
            z-index: 100;
            box-shadow: 0 0 10px #aaa;
        }
    </style>

    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-12 mt-4 px-0">
                <div class="mb-3 d-flex">
                    {{-- <a href="{{ route('user.c0reate') }}" class="btn btn-outline-success">New user</a>
                    <a href="{{ route('user.index', ['deleted' => 1]) }}" class="ms-auto btn btn-outline-dark">Deleted users</a>
                </div> --}}
                <div class="card rounded-3 bg-white my-3">
                    <div class="card-body pb-4">
                        <div class="table-responsive">

                            <table class="table table-striped table-hover table-borderless align-middle">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Panel Set Up</th>
                                    <th scope="col">Market. Adv.</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Team size</th>
                                    <th scope="col">Manager</th>
                                    <th scope="col" class="text-end">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                              
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const table = document.querySelector('table')
        const changeTopOfThead = () => {
            table.firstElementChild.style.top =
                `${table.getBoundingClientRect().top < 0 ? Math.abs(table.getBoundingClientRect().top) : 0}px`;
        }
        changeTopOfThead()
        window.onscroll = changeTopOfThead
    </script>
{{-- </x-app-layout> --}}
