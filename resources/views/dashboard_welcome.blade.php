@extends("layouts.admin")

@section("title", "Admin Control")

@section("styles")
    <style>
        .hero {
            display: table;
            position: relative;
            background-image: url({{ asset("images/cover.jpg") }});
            background-size: cover;
            padding: 150px 0;
            color: #fff;
            width: 100%;
            height: 100vh;
        }

        .hero:after {
            content: '';
            z-index: 0;
            position: absolute;
            background: rgba(0, 0, 0, 0.65);
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
        }

        .hero .container {
            position: relative;
            z-index: 1;
            text-align: center;
            display: table-cell;
            vertical-align: middle;
            width: 100%;
        }

        .hero-brand {
            margin-bottom: 75px;
            display: inline-block;
        }

        .hero-brand:hover {
            opacity: .75;
        }

        .tagline {
            font-family: "Raleway", Helvetica, Arial, sans-serif;
            font-size: 26px;
            margin: 45px 0 75px 0;
            color: #fff;
        }
    </style>
@endsection

@section("content")
    <!-- ======= Hero Section ======= -->
    <section class="hero">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-12">
                    <a class="hero-brand" href="{{ route("admin.dashboard") }}" title="Home"><img alt="Bell Logo" src="{{ asset("images/logo/AJ3M Logo.png") }}"></a>
                </div>
            </div>

            <div class="col-md-12">
                <h1>
                    Welcome back to dashboard {{ Auth::user()->name }},
                </h1>
            </div>
        </div>

    </section><!-- End Hero -->
@endsection
