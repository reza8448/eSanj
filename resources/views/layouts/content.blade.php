 @extends('layouts.master')
@section('content')

    <div class="toolbar mb-n1 pt-3 mb-lg-n3 pt-lg-6" id="kt_toolbar">

        <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap gap-2">

            <div class="page-title d-flex flex-column align-items-start me-3 py-2 py-lg-0 gap-2">

                <h1 class="d-flex text-dark fw-bolder m-0 fs-3">{{$title}}

                    <span class="h-20px border-gray-400 border-start mx-3"></span>

                    <small class="fs-7 fw-bold my-1">{{$breadcrumb}}</small>
                   </h1>

            </div>

        </div>

    </div>
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start  m-15">

        {{$slot}}
    </div>

@endsection
 @section('script')

     {{ $script??'' }}

 @endsection
