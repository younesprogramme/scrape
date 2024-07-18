<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app_blade.css') }}">
    <script src="https://code.jquery.com/jquery-1.11.1.js"></script>
    <script src={{ asset('js/app.js') }}></script>
    <!-- Styles -->
    <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
        html {
            line-height: 1.15;
            -webkit-text-size-adjust: 100%
        }

        body {
            margin: 0
        }

        a {
            background-color: transparent
        }

        [hidden] {
            display: none
        }

        html {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            line-height: 1.5
        }

        *,
        :after,
        :before {
            box-sizing: border-box;
            border: 0 solid #e2e8f0
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        svg,
        video {
            display: block;
            vertical-align: middle
        }

        video {
            max-width: 100%;
            height: auto
        }

        .bg-white {
            --bg-opacity: 1;
            background-color: #fff;
            background-color: rgba(255, 255, 255, var(--bg-opacity))
        }

        .bg-gray-100 {
            --bg-opacity: 1;
            background-color: #f7fafc;
            background-color: rgba(247, 250, 252, var(--bg-opacity))
        }

        .border-gray-200 {
            --border-opacity: 1;
            border-color: #edf2f7;
            border-color: rgba(237, 242, 247, var(--border-opacity))
        }

        .border-t {
            border-top-width: 1px
        }

        .flex {
            display: flex
        }

        .grid {
            display: grid
        }

        .hidden {
            display: none
        }

        .items-center {
            align-items: center
        }

        .justify-center {
            justify-content: center
        }

        .font-semibold {
            font-weight: 600
        }

        .h-5 {
            height: 1.25rem
        }

        .h-8 {
            height: 2rem
        }

        .h-16 {
            height: 4rem
        }

        .text-sm {
            font-size: .875rem
        }

        .text-lg {
            font-size: 1.125rem
        }

        .leading-7 {
            line-height: 1.75rem
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto
        }

        .ml-1 {
            margin-left: .25rem
        }

        .mt-2 {
            margin-top: .5rem
        }

        .mr-2 {
            margin-right: .5rem
        }

        .ml-2 {
            margin-left: .5rem
        }

        .mt-4 {
            margin-top: 1rem
        }

        .ml-4 {
            margin-left: 1rem
        }

        /* .mt-8 {
            margin-top: 2rem
        } */

        .ml-12 {
            margin-left: 3rem
        }

        .-mt-px {
            margin-top: -1px
        }

        .max-w-6xl {
            /* max-width: 72rem; */
            max-width: 60%;
        }

        .min-h-screen {
            min-height: 100vh
        }

        .overflow-hidden {
            overflow: hidden
        }

        .p-6 {
            padding: 1.5rem
        }

        .py-4 {
            /* padding-top: 1rem; */
            padding-bottom: 1rem;
            padding-top: 0.5rem !important;
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem
        }

        .pt-8 {
            padding-top: 2rem
        }

        .fixed {
            position: fixed
        }

        .relative {
            position: relative
        }

        .top-0 {
            top: 0
        }

        .right-0 {
            right: 0
        }

        .shadow {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06)
        }

        .text-center {
            text-align: center
        }

        .text-gray-200 {
            --text-opacity: 1;
            color: #edf2f7;
            color: rgba(237, 242, 247, var(--text-opacity))
        }

        .text-gray-300 {
            --text-opacity: 1;
            color: #e2e8f0;
            color: rgba(226, 232, 240, var(--text-opacity))
        }

        .text-gray-400 {
            --text-opacity: 1;
            color: #cbd5e0;
            color: rgba(203, 213, 224, var(--text-opacity))
        }

        .text-gray-500 {
            --text-opacity: 1;
            color: #a0aec0;
            color: rgba(160, 174, 192, var(--text-opacity))
        }

        .text-gray-600 {
            --text-opacity: 1;
            color: #718096;
            color: rgba(113, 128, 150, var(--text-opacity))
        }

        .text-gray-700 {
            --text-opacity: 1;
            color: #4a5568;
            color: rgba(74, 85, 104, var(--text-opacity))
        }

        .text-gray-900 {
            --text-opacity: 1;
            color: #1a202c;
            color: rgba(26, 32, 44, var(--text-opacity))
        }

        .underline {
            text-decoration: underline
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .w-5 {
            width: 1.25rem
        }

        .w-8 {
            width: 2rem
        }

        .w-auto {
            width: auto
        }

        .grid-cols-1 {
            grid-template-columns: repeat(1, minmax(0, 1fr))
        }

        @media (min-width:640px) {
            .sm\:rounded-lg {
                border-radius: .5rem
            }

            .sm\:block {
                display: block
            }

            .sm\:items-center {
                align-items: center
            }

            .sm\:justify-start {
                justify-content: flex-start
            }

            .sm\:justify-between {
                justify-content: space-between
            }

            .sm\:h-20 {
                height: 5rem
            }

            .sm\:ml-0 {
                margin-left: 0
            }

            .sm\:px-6 {
                padding-left: 1.5rem;
                padding-right: 1.5rem
            }

            .sm\:pt-0 {
                padding-top: 0
            }

            .sm\:text-left {
                text-align: left
            }

            .sm\:text-right {
                text-align: right
            }
        }

        @media (min-width:768px) {
            .md\:border-t-0 {
                border-top-width: 0
            }

            .md\:border-l {
                border-left-width: 1px
            }

            .md\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }
        }

        @media (min-width:1024px) {
            .lg\:px-8 {
                padding-left: 2rem;
                padding-right: 2rem
            }
        }

        @media (prefers-color-scheme:dark) {
            .dark\:bg-gray-800 {
                --bg-opacity: 1;
                background-color: #2d3748;
                background-color: rgba(45, 55, 72, var(--bg-opacity))
            }

            .dark\:bg-gray-900 {
                --bg-opacity: 1;
                background-color: #1a202c;
                background-color: rgba(26, 32, 44, var(--bg-opacity))
            }

            .dark\:border-gray-700 {
                --border-opacity: 1;
                border-color: #4a5568;
                border-color: rgba(74, 85, 104, var(--border-opacity))
            }

            .dark\:text-white {
                --text-opacity: 1;
                color: #fff;
                color: rgba(255, 255, 255, var(--text-opacity))
            }

            .dark\:text-gray-400 {
                --text-opacity: 1;
                color: #cbd5e0;
                color: rgba(203, 213, 224, var(--text-opacity))
            }

            .dark\:text-gray-500 {
                --tw-text-opacity: 1;
                color: #6b7280;
                color: rgba(107, 114, 128, var(--tw-text-opacity))
            }
        }

    </style>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            /* background-color: #f7fafc; */
        }

        .form-control,
        .form-select {
            width: 60%;
        }

        .alert {
            margin-top: 5px;
            position: relative;
            padding: 0.4rem 0.4rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
        }

        .witingimage {
            z-index: 10000px:;
        }

        #success_msg {
            width: 60%;
        }

        .btn-secondary,
        .btn-primary {
            background-color: #a3ca05 !important;
            border-color: #a3ca05 !important;
        }

        .btn-secondary,
        .btn-primary:hover {
            background-color: #9fb50f !important;
            border-color: #def643 !important;
        }

        .btn-secondary,
        .btn-primary:active {
            background-color: #a3ca05;
            border-color: #def643;
        }

        .form-control,
        .form-select {
            width: 100%;
        }

    </style>
</head>

<body class="">
    @include('layouts.navigation')
    <header class="bg-white shadow-sm mb-2 py-3 fs-5 fw-bold second_header">
        <div class="container">
            Scrape data
        </div>
    </header>
    <div class="container mt-3">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                {{-- <div class="grid grid-cols-1 md:grid-cols-2"> --}}
                <div class="p-6">
                    <div class="">
                        <form class="needs-validation" novalidate>
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">User id :</label><br>
                                <input type="text" class="form-control" name="userid" id="userid"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                    placeholder="Enter user id" required value="">
                                <div class="invalid-feedback">
                                    Please enter user id.
                                </div>
                                <label for="exampleInputEmail1">Provider :</label><br>
                                <select class="form-select" name="provider" id="provider"
                                    aria-label="Default select example" required>
                                    <option selected enabled value="">Select provider</option>
                                    <option value="autobunny">Autobunny</option>
                                    <option value="zopmedia">Zopmedia</option>
                                    <option value="ipayauto">Ipayauto</option>
                                    <option value="dealerspike">Dealerspike</option>
                                    <option value="autosearchtechnologies">Auto search technologies</option>
                                    <option value="dealersync">Dealersync</option>
                                    <option value="vinlist">Vinlist</option>
                                    {{-- <option value="autousagee">Autousagee</option> --}}
                                    {{-- <option value="fullycustom">fully custom</option> --}}
                                    <option value="sincro">Sincro</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please choose a provider.
                                </div>
                                {{-- <input type="text" class="form-control" name="provider" id="provider"
                                    placeholder="Enter provider" required value="{{ $post ?? '' }}"> --}}
                                <label for="exampleInputEmail1">Url :</label><br>
                                <input type="text" class="form-control" name="starturl" id="starturl"
                                    placeholder="Enter url" required value="{{ $post ?? '' }}">
                                <div class="invalid-feedback">
                                    Please Enter url.
                                </div>
                                {{-- <img class="witingimage" src="https://upload.wikimedia.org/wikipedia/commons/b/b1/Loading_icon.gif?20151024034921"/> --}}

                                {{-- <div class="spinner-border m-3" role="status">
                                        <span class="sr-only"></span>
                                    </div> --}}
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault1" value="one time">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        One time
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault2" value="recurring" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Recurring
                                    </label>
                                </div>
                                <button id="loading" type="button" disabled
                                    style="color:#212529;margin-top: 8px; display :none">
                                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                    Loading...
                                </button>
                                <div class="alert alert-danger" id="alert_danger" role="alert" style="display:none">
                                    Error !!
                                </div>
                                <div class="alert alert-success" id="success_msg" role="alert" style="display:none">
                                    data has been scraped correctly
                                </div>

                            </div><br>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button id="btn_click" type="submit" class="btn btn-primary ">Scrape</button>
                                <button id="btn_download" class="btn btn-secondary " value="autobunny/44813" style="display: block;    background-color: #a3ca05;
                                    border-color: #a3ca05;margin-left:5px;">Download csv file</button>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- </div> --}}
            </div>
        </div>
        <div class="card rounded-3 bg-white my-3">
            <div class="card-body pb-4">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-borderless align-middle">
                        <thead style="top: 0px;">
                            <tr>
                                <th><strong> #</strong></th>
                                <th><strong> Id</strong></th>
                                <th><strong>Date</strong></th>
                                <th><strong>Provider </strong></th>
                                <th><strong>URL </strong></th>
                                <th><strong>User id </strong></th>
                                <th class="text-center"><strong>Download </strong></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($scrapes as $scrape)
                                <tr>
                                    <td>
                                        <div class="user-icon rounded-circle color-{{ random_int(1, 7) }}">
                                            {{ strtoupper(substr($scrape->provider, 0, 1)) }}</div>
                                    </td>
                                    <td>{{ $scrape->id }}</td>
                                    <td>{{ $scrape->date }}</td>
                                    <td>{{ Str::limit($scrape->provider, 20) }}</td>
                                    <td><a href="{{ $scrape->url }}" target="_blank">
                                            {{ Str::limit($scrape->url, 200) }}</a></td>
                                    <td>{{ $scrape->user_id }}</td>
                                    <td class="text-center">
                                        <a href="{{ 'http://ftp.v12software.com/webscraping/' . $scrape->provider . '/' . $scrape->user_id }}"
                                            id="download_link"
                                            data-jobid=" {{ asset('csv/') . $scrape->user_id }}"><i
                                                class="fa fa-download" style='color:#a3ca05' aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- <script src="https://cdn.socket.io/4.5.0/socket.io.min.js"
        integrity="sha384-7EyYLQZgWBi67fBtVxw60/OWl1kjsfrPFcaU0pp0nAh+i8FD068QogUvg85Ewy1k" crossorigin="anonymous"> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.js"></script>



    <script>
        
        var options = $('select.form-select option:gt(0)');
        var arr = options.map(function(_, o) {
            return {
                t: $(o).text(),
                v: o.value
            };
        }).get();
        arr.sort(function(o1, o2) {
            return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0;
        });
        options.each(function(i, o) {
            o.value = arr[i].v;
            $(o).text(arr[i].t);
        });

        document.querySelector("#btn_click").addEventListener("click", function(e) {
            e.preventDefault();
            schedule = document.querySelector('input[name="flexRadioDefault"]:checked').value;
            var userid = document.getElementById("userid").value;
            var provider = document.getElementById("provider").value;
            var starturl = document.querySelector('input[name = "starturl"]').value;
            var token = document.querySelector('input[name = "_token"]').value;
            var forms = document.querySelectorAll('.needs-validation');

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    if (!form.checkValidity()) {
                        console.log('valide')
                    } else {
                        document.getElementById("loading").style.display = "block"
                        document.getElementById("success_msg").style.display = "none";
                        document.getElementById("btn_download").style.display = "none";
                        document.getElementById("alert_danger").style.display = "none";
                        fetch('create', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': token
                                },
                                body: JSON.stringify({
                                    userid: userid,
                                    provider: provider,
                                    starturl: starturl,
                                    schedule: schedule,
                                }),
                            })
                            .then((res) => res.json())
                            .then((data) => {
                                if (data.msg == "error") {
                                    document.getElementById("alert_danger").style.display = "block";
                                    document.getElementById("loading").style.display = "none";
                                } else {
                                    var interval = setInterval(function() {
                                        fetch('csv', {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                    'X-CSRF-TOKEN': token
                                                },
                                                body: JSON.stringify({
                                                    scrapingJobId: data.scrapingJobId,
                                                    userid: data.userid,
                                                    provider: data.provider,
                                                }),
                                            })
                                            .then((res) => res.json())
                                            .then((data) => {
                                                if (data.msg == "finished") {
                                                    clearInterval(interval)
                                                    document.getElementById("loading").style
                                                        .display = "none";
                                                    document.getElementById("success_msg").style
                                                        .display = "block";
                                                    document.getElementById("btn_download")
                                                        .value = data.provider + '/' + data
                                                        .scrapingJobId;
                                                    document.getElementById("btn_download")
                                                        .style
                                                        .display = "block";
                                                }

                                            });

                                    }, 10000); // 2000 ms = start after 2sec   

                                }
                            })
                            .catch((err) => console.log(err));
                    }
                    form.classList.add('was-validated')
                })

        });
        document.querySelector("#btn_download").addEventListener("click", function(e) {
            e.preventDefault();
            var scrapingJobId = document.getElementById("btn_download").value;
            console.log('csv/' + scrapingJobId);
            const link = document.createElement('a');
            link.setAttribute('href', 'http://ftp.v12software.com/webscraping/' + scrapingJobId);
            link.click();
        });
    </script>
</body>


</html>
