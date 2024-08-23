<!DOCTYPE html>
<html direction="rtl" dir="rtl" style="direction: rtl" >

<head><base href="">

    @yield('title')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8" />

    <meta name="keywords" content="مترونیک, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />

    <livewire:styles />
    <link rel="canonical" href="Https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="/assets/media/logos/favicon.ico" />
    <link href="/assets/plugins/global/plugins.bundle.rtl.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

{{--    <link href="/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />--}}

    <link href="/assets/plugins/global/plugins.bundle.rtl.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/style.bundle.rtl.css" rel="stylesheet" type="text/css" />


    <link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
    <script type="text/javascript" src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>
    <style>
        jdp-container, jdp-container *, jdp-container :after, jdp-container :before {

            z-index: 10000000 !important;
        }
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
        .search{
            cursor: pointer;
        }
    </style>

</head>
<body id=" " class="header-extended header-fixed header-tablet-and-mobile-fixed">

<div class="d-flex flex-column flex-root">

    <div class="page d-flex flex-row flex-column-fluid">

        <div class="wrapper d-flex flex-column flex-row-fluid" id=" ">

            @include('layouts.header')

            @yield('content')


            <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">

                <div class="container-xxl d-flex flex-column flex-md-row align-items-center justify-content-between">

                    <div class="text-dark order-2 order-md-1">
                        <span class="text-muted fw-bold me-1">2023©</span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
<script>var hostUrl = "/assets/";</script>



<script type="text/javascript" src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>


<script src="/assets/plugins/global/plugins.bundle.js"></script>
<script src="/assets/js/PersianValidate.js"></script>
<script src="/assets/js/scripts.bundle.js"></script>

@yield('script')
<script>
    if(!($('input[name=search]') .val()===''))
        $('[name=close_search]').attr('hidden',false)

    function change_user(  id){
        $("[name =user]").val(id)
        console.log(   $("[name =user]").val())
        $('#change_user').submit()
    }

    $('input[name=search]').on('keyup',function (event) {
        if($('input[name=search]') .val()==='')
            $('[name=close_search]').attr('hidden',true)
        else
            $('[name=close_search]').attr('hidden',false)
    });




    $('input ').each(function( index ) {

        $( this ).attr("autocomplete", "off");
    });


    $('.search').on( "click", function(event){

        if( $('[name=search]').val())
            window.location.replace(`${$(location).attr('href').split('?search=')[0]}?search=${$.trim(String( $('[name=search]').val()))}`)
    })


</script>
<script src="{{asset('/js/app.js')}}"></script>
<script>

    jalaliDatepicker.startWatch();


    document.addEventListener("livewire:load", () => {
        Livewire.hook('message.processed', (message, component) => {

            $('input ').each(function( index ) {

                $( this ).attr("autocomplete", "off");
            });
        });
    });






</script>
<livewire:scripts />
<script>


</script>


@include('sweetalert::alert')

</body>

</html>
