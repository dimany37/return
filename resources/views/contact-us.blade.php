
@extends('layouts.layout-temlate')
@include('template.header')

@section('content')

<section class="no-margin">
    <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3AKGYFSUUKS0tkgzfg3cwxuSE0fs7s1ULn&amp;source=constructor" width="100%" height="200" frameborder="0"></iframe>    </section>

<section id="contact-page" class="container">
    <div class="row-fluid">

        <div class="span8">
            <h4>Contact Form</h4>
            <div class="status alert alert-success" style="display: none"></div>

            <form  method="post" action="{{ route('sendUs') }}" enctype="multipart/form-data">
            @csrf
                <div class="row-fluid">
                    <div class="span5">
                        <label>First Name</label>
                        <input type="text" class="input-block-level" required="required"  name="firstName">
                        <label>Last Name</label>
                        <input type="text" class="input-block-level" required="required"  name="lastName">
                        <label>Email Address</label>
                        <input type="text" class="input-block-level" required="required" name="email">
                    </div>
                    <div class="span7">
                        <label>Message</label>
                        <textarea id="message" required="required" class="input-block-level" rows="8" name="message"></textarea>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary btn-large pull-right" >Send Message</button>
            </form>
        </div>

        <div class="span3">
            <h4>Our Address</h4>
            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
            <p>
                <i class="icon-map-marker pull-left"></i> 1209 Willow Oaks Lane, New York<br>
                Lafayette, 1212,  United States
            </p>
            <p>
                <i class="icon-envelope"></i> &nbsp;email@example.com
            </p>
            <p>
                <i class="icon-phone"></i> &nbsp;+123 45 67 89
            </p>
            <p>
                <i class="icon-globe"></i> &nbsp;http://www.shapebootstrap.net
            </p>
        </div>

    </div>

</section>

<
<!--/bottom-->

<!--Footer-->
@include('template.footer')
@endsection
