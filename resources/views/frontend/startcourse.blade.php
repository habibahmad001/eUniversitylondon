@extends("layouts.frontapp")
@section('content')
    <style>
        .pdfobject-container {
            max-width: 100%;
            width: 800px;
            height: 1000px;
            display: inline-block;
        }
    </style>
    <div class="header_absolute ds s-parallax s-overlay title-bg2">


        <section class="page_title ds s-pt-80 s-pb-80 s-pt-lg-130 s-pb-lg-90">
            <div class="divider-50"></div>
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <h1>Start Course Here</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ URL::to("/") }}">Home</a>
                            </li>
                        </ol>
                    </div>

                </div>
            </div>
        </section>
    </div>


    <section class="ls s-pt-55 s-pb-45 s-pt-lg-95 s-pb-lg-75 shop-order-received">
        <div class="container">
            <div class="row">
                <main class="col-lg-12 text-center">
                    <div class="pdfobject-container" id="my-pdf"></div>

                    {{--<iframe width="800" height="1000" src="https://www.1training.org/them+65encode-pdf-viewer-sc/?file={{ asset('/uploads/coursepdf/' . $courseData[0]->pdf ) }}&amp;settings=111111111&amp;lang=en-US#page=&amp;zoom=auto&amp;pagemode="></iframe>--}}
                </main>
            </div>
        </div>
    </section>

    <script src="/js/front/pdfobject.min.js"></script>
    <script>
        var options = {
            page: '2',
            pdfOpenParams: {
                /*view: 'FitV',
                pagemode: 'thumbs',*/
                search: 'lorem ipsum'
            }
        };
        PDFObject.embed("/uploads/coursepdf/{{ $courseData[0]->pdf }}", "#my-pdf", options);
    </script>

@endsection