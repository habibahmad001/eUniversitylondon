@extends('layouts.reset')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="contact-container">
                <h2>Contact Us</h2>
                <div class="panel-body contact-text-section">
                    Address:  CityPoint, 1 Ropemaker Street, London, EC2Y 9HU. <br />
                    Telephone: +44 2034097966 <br />
                    Fax: +44 2034097969 <br />
                    Skype: global. edulink1 <br />
                    Email: support@globaledulink.co.uk <br />
                </div>
                <div class="contact-form-section">
                    @if(isset($message))
                    <div class="msgg">
                        {{ $message }}
                    </div>
                    @endif
                    <form name="cfrm" id="cfrm" method="post" action="/email_form">
                        {{ csrf_field() }}
                        <input type="text" name="name" class="search-what" id="name" placeholder="Name"> <br />
                        <input type="email" name="email" class="search-what" id="email" placeholder="Email"> <br />
                        <input type="text" name="pno" class="search-what" id="pno" placeholder="123-456-7891"> <br />
                        <textarea name="msg" id="msg" placeholder="Message"></textarea> <br />
                        <input type="button" onclick="javascript: document.getElementById('cfrm').submit();" name="contact-submit" class="contact-submit" id="contact-submit" value="Submit"> <br />
                    </form>

                </div>
            </div>
        </div>
    </div>
</div><br /><br />
<div class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2482.657754480909!2d-0.0921822847991852!3d51.519494617640596!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48761cabe9932dc3%3A0x8913167b1bc0f86c!2sCityPoint%2C%201%20Ropemaker%20St%2C%20London%20EC2Y%209ST%2C%20UK!5e0!3m2!1sen!2s!4v1576446541599!5m2!1sen!2s" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
</div>
    <br /><br />
@endsection
