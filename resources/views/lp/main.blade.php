@extends('layouts.lp-base')

@section('content')

<div class="hero">
    <ul class="slides">
        <li data-bg-image="{{asset('lp/images/slider-1.jpg')}}">
            <div class="container">
                <div class="slide-content">
                    <h1 class="slide-title">Preparation + Practice = Success</h1>
                    <small class="date">Lead Us "The Largest UPSC Practice Portal" </small>
                    <p>Supplement your preparation with timely practice to ensure maximum result.</p>
                    <a href="#highlight" class="button">Know more</a>
                </div>
            </div>
        </li>

       <li data-bg-image="{{asset('lp/images/slider-2.jpg')}}">
            <div class="container">
                <div class="slide-content">
                    <h1 class="slide-title">Mocks, Publications, Current Affairs</h1>
                    <small class="date">Get everything you need to prepare with Lead Us!!</small>
                    <p>Prepare yourself with the latest UPSC practice portal and work on your weak points.</p>
                    <a href="#highlight" class="button">Know more</a>
                </div>
            </div>
        </li>
    </ul>
</div>

<main class="main-content">
    <div id="highlight" class="fullwidth-block">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="feature">
                        <div class="feature-icon"><img src="{{asset('lp/images/icon-church.png')}}" alt="" class="icon"></div>
                        <h2 class="feature-title">Prelims &amp; Mains</h2>
                        <p>Practice questions on different topics &amp; subjects at your ease &amp; get
                            prepared.</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="feature">
                        <div class="feature-icon"><img src="{{asset('lp/images/icon-candles.png')}}" alt="" class="icon"></div>
                        <h2 class="feature-title">Current affairs</h2>
                        <p>Read our customised current affairs to keep yourself updated with the latest
                            happenings.</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="feature">
                        <div class="feature-icon"><img src="{{asset('lp/images/icon-cross.png')}}" alt="" class="icon"></div>
                        <h2 class="feature-title">Publications</h2>
                        <p>Our publication analysis will help you gain an edge &amp; prepare better &amp;
                            faster.</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="feature">
                        <div class="feature-icon"><img src="{{asset('lp/images/icon-star.png')}}" alt="" class="icon"></div>
                        <h2 class="feature-title">Mock Tests</h2>
                        <p>Keep a track of your progress by appearing for the mock test &amp; know your weak
                            zones.</p>
                    </div>
                </div>
            </div> <!-- .row -->
        </div> <!-- .container -->
    </div> <!-- #about -->

    <div id="features" class="fullwidth-block" data-bg-color="#4a3173">
        <div class="container">
            <h2 class="section-title">Lead Us Specials</h2>
            <p class="section-intro">Prepare & Practice with Lead Us and get your daily dose to be ready for
                success. We at Lead Us believe that small steps of practice take you to greater success. So
                don't wait!! Get yourself enrolled with Lead Us.</p>

            <div class="row">
                <div class="col-md-2 col-sm-3 col-xs-6">
                    <div class="pastor">
                        <img src="{{asset('lp/images/pastor-1.jpg')}}" alt="" class="pastor-image">

                    </div>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-6">
                    <div class="pastor">
                        <img src="{{asset('lp/images/pastor-2.jpg')}}" alt="" class="pastor-image">

                    </div>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-6">
                    <div class="pastor">
                        <img src="{{asset('lp/images/pastor-3.jpg')}}" alt="" class="pastor-image">

                    </div>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-6">
                    <div class="pastor">
                        <img src="{{asset('lp/images/pastor-4.jpg')}}" alt="" class="pastor-image">

                    </div>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-6">
                    <div class="pastor">
                        <img src="{{asset('lp/images/pastor-5.jpg')}}" alt="" class="pastor-image">

                    </div>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-6">
                    <div class="pastor">
                        <img src="{{asset('lp/images/pastor-6.jpg')}}" alt="" class="pastor-image">

                    </div>
                </div>
            </div> <!-- .row -->

            <div class="text-center">
                <a href="#" class="button">Enroll Now !</a>
            </div>
        </div> <!-- .container -->
    </div> <!-- #pastors -->

    <div id="mock-tests" class="fullwidth-block">
        <div class="container">
            <h2 class="section-title">Upcoming Mock Tests</h2>
            {{-- <div class="text-center">
                <a href="#" class="prev-events"><img src="{{asset('lp/images/arrow-left.png')}}" alt=""></a>
                <a href="#" class="next-events"><img src="{{asset('lp/images/arrow-right.png')}}" alt=""></a>
            </div> --}}
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="event">
                        <img src="{{asset('lp/images/event-1.jpg')}}" alt="" class="event-image">
                        <h3 class="event-title"><a href="#">Mock Test Name</a></h3>
                        <div class="event-meta"><span class="date"><i class="fa fa-calendar"></i>
                                02/04/2014</span><span class="location"><i class="fa fa-map-marker"></i>Day</span></div>
                        <a href="#" class="button">Take Mock Test</a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="event">
                        <img src="{{asset('lp/images/event-2.jpg')}}" alt="" class="event-image">
                        <h3 class="event-title"><a href="#">Mock Test Name</a></h3>
                        <div class="event-meta"><span class="date"><i class="fa fa-calendar"></i>
                                02/04/2014</span><span class="location"><i class="fa fa-map-marker"></i>Day</span></div>
                        <a href="#" class="button">Take Mock Test</a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="event">
                        <img src="{{asset('lp/images/event-3.jpg')}}" alt="" class="event-image">
                        <h3 class="event-title"><a href="#">Mock Test Name</a></h3>
                        <div class="event-meta"><span class="date"><i class="fa fa-calendar"></i>
                                02/04/2014</span><span class="location"><i class="fa fa-map-marker"></i>Day</span></div>
                        <a href="#" class="button">Take Mock Test</a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="event">
                        <img src="{{asset('lp/images/event-4.jpg')}}" alt="" class="event-image">
                        <h3 class="event-title"><a href="#">Mock Test Name</a></h3>
                        <div class="event-meta"><span class="date"><i class="fa fa-calendar"></i>
                                02/04/2014</span><span class="location"><i class="fa fa-map-marker"></i>Day</span></div>
                        <a href="#" class="button">Take Mock Test</a>
                    </div>
                </div>
            </div> <!-- .row -->
        </div> <!-- .container -->
    </div> <!-- #events -->

    <div id="current-affairs" class="fullwidth-block" data-bg-color="#4a3173">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <h3 class="section-title">Current Affairs</h3>
                    <ul class="seremon-list">
                        <li>
                            <h3 class="seremon-title"><a href="#">Labore et dolore magna aliqua</a></h3>
                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                aliquipommodo consequat.</p>
                            <div class="seremon-meta">
                                <span><i class="fa fa-calendar"></i> <strong>Date:</strong> 05/04/2014</span>
                                <span><i class="fa fa-user"></i> <strong>Author:</strong> Lead Us</span>
                            </div>
                        </li>
                        <li>
                            <h3 class="seremon-title"><a href="#">Labore et dolore magna aliqua</a></h3>
                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
                            <div class="seremon-meta">
                                <span><i class="fa fa-calendar"></i> <strong>Date:</strong> 05/04/2014</span>
                                <span><i class="fa fa-user"></i> <strong>Author:</strong> Lead Us</span>
                            </div>
                        </li>
                        <li>
                            <h3 class="seremon-title"><a href="#">Labore et dolore magna aliqua</a></h3>
                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
                            <div class="seremon-meta">
                                <span><i class="fa fa-calendar"></i> <strong>Date:</strong> 05/04/2014</span>
                                <span><i class="fa fa-user"></i> <strong>Author:</strong> Lead Us</span>
                            </div>
                        </li>
                        <li>
                            <h3 class="seremon-title"><a href="#">Labore et dolore magna aliqua</a></h3>
                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                aliquipommodo consequat.</p>
                            <div class="seremon-meta">
                                <span><i class="fa fa-calendar"></i> <strong>Date:</strong> 05/04/2014</span>
                                <span><i class="fa fa-user"></i> <strong>Author:</strong> Lead Us</span>
                            </div>
                        </li>
                    </ul>

                    <a href="#" class="button">See all Current Affairs</a>
                </div>
                <div class="col-md-5 offset-md-2">
                    <h3 class="section-title">Publication Analysis</h3>
                    <ul class="seremon-list">
                        <li>
                            <h3 class="seremon-title"><a href="#">Press Information Bureau (PIB)</a></h3>
                            <div class="seremon-meta">
                                <span><i class="fa fa-calendar"></i> <strong>Date:</strong> 05/04/2014</span>
                                <span><i class="fa fa-user"></i> <strong>Pastor:</strong> John Birman</span>
                            </div>
                            <a href="#" class="button secondary"><img src="{{asset('lp/images/icon-headset.png')}}" alt="" class="icon">
                                See Publication</a>
                        </li>
                        <li>
                            <h3 class="seremon-title"><a href="#">Yojana</a></h3>
                            <div class="seremon-meta">
                                <span><i class="fa fa-calendar"></i> <strong>Date:</strong> 05/04/2014</span>
                                <span><i class="fa fa-user"></i> <strong>Pastor:</strong> John Birman</span>
                            </div>
                            <a href="#" class="button secondary"><img src="{{asset('lp/images/icon-headset.png')}}" alt="" class="icon">
                                See Publication</a>
                        </li>
                        <li>
                            <h3 class="seremon-title"><a href="#">Kurukshetra</a></h3>
                            <div class="seremon-meta">
                                <span><i class="fa fa-calendar"></i> <strong>Date:</strong> 05/04/2014</span>
                                <span><i class="fa fa-user"></i> <strong>Pastor:</strong> John Birman</span>
                            </div>
                            <a href="#" class="button secondary"><img src="{{asset('lp/images/icon-headset.png')}}" alt="" class="icon">
                                See Publication</a>
                        </li>
                        <li>
                            <h3 class="seremon-title"><a href="#">Lead Us Custom Publication Analysis</a></h3>
                            <div class="seremon-meta">
                                <span><i class="fa fa-calendar"></i> <strong>Date:</strong> 05/04/2014</span>
                                <span><i class="fa fa-user"></i> <strong>Pastor:</strong> John Birman</span>
                            </div>
                            <a href="#" class="button secondary"><img src="{{asset('lp/images/icon-headset.png')}}" alt="" class="icon">
                                See Publication</a>
                        </li>
                    </ul>

                    <a href="#" class="button">See all Publication Analysis</a>
                </div>
            </div> <!-- .row -->
        </div> <!-- .container -->
    </div> <!-- #seremons -->

    <div id="subjects" class="fullwidth-block">
        <div class="container">
            <h2 class="section-title">Practice Subjects we offer</h2>
            <p class="section-intro">Choose from the wide range of practice subjects that we offer to ensure
                your practice results in assured success.</p>

            <div class="family-list">
                <figure class="family">
                    <img src="{{asset('lp/images/family-1.png')}}" alt="">
                    <figcaption>
                        <h3 class="family-name">History</h3>
                        <span class="arrow"></span>
                    </figcaption>
                </figure>
                <figure class="family">
                    <img src="{{asset('lp/images/family-2.jpg')}}" alt="">
                    <figcaption>
                        <h3 class="family-name">Geography</h3>
                        <span class="arrow"></span>
                    </figcaption>
                </figure>
                <figure class="family">
                    <img src="{{asset('lp/images/family-3.jpg')}}" alt="">
                    <figcaption>
                        <h3 class="family-name">Art & Culture</h3>
                        <span class="arrow"></span>
                    </figcaption>
                </figure>
                <figure class="family">
                    <img src="{{asset('lp/images/family-4.jpg')}}" alt="">
                    <figcaption>
                        <h3 class="family-name">Environment</h3>
                        <span class="arrow"></span>
                    </figcaption>
                </figure>
                <figure class="family">
                    <img src="{{asset('lp/images/family-5.jpg')}}" alt="">
                    <figcaption>
                        <h3 class="family-name">Economics</h3>
                        <span class="arrow"></span>
                    </figcaption>
                </figure>
                <figure class="family">
                    <img src="{{asset('lp/images/family-6.jpg')}}" alt="">
                    <figcaption>
                        <h3 class="family-name">General Science</h3>
                        <span class="arrow"></span>
                    </figcaption>
                </figure>
                <figure class="family">
                    <img src="{{asset('lp/images/family-7.jpg')}}" alt="">
                    <figcaption>
                        <h3 class="family-name">Science & Tech</h3>
                        <span class="arrow"></span>
                    </figcaption>
                </figure>
                <figure class="family">
                    <img src="{{asset('lp/images/family-8.jpg')}}" alt="">
                    <figcaption>
                        <h3 class="family-name">General Knowledge</h3>
                        <span class="arrow"></span>
                    </figcaption>
                </figure>
                <figure class="family">
                    <img src="{{asset('lp/images/family-9.jpg')}}" alt="">
                    <figcaption>
                        <h3 class="family-name">Polity</h3>
                        <span class="arrow"></span>
                    </figcaption>
                </figure>

            </div>

            <hr class="space">
            <div class="text-center">
                <a href="#" class="button">Register with us</a>
            </div>
        </div> <!-- .container -->
    </div> <!-- #families -->

    <div id="contact" class="fullwidth-block" data-bg-color="#4a3173">
        <div class="container">
            <h2 class="section-title">Contact us</h2>
            <p class="section-intro">Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus
                saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.</p>

            <div class="contact-detail">
                <span><img src="{{asset('lp/images/icon-marker.png')}}" alt="" class="icon"> 294 Samuelson Rd, portage</span>
                <span><img src="{{asset('lp/images/icon-phone.png')}}" alt="" class="icon"> (989) 589 423 553</span>
                <span><img src="{{asset('lp/images/icon-envelope.png')}}" alt="" class="icon"> contact@patrichchurch.com</span>
            </div>

            <form class="contact-form">
                <div class="row">
                    <div class="col-md-6">
                        <div class="control"><input type="text" placeholder="Your name..."><img
                                src="{{asset('lp/images/icon-user.png')}}" alt="" class="icon"></div>
                        <div class="control"><input type="text" placeholder="Email..."><img src="{{asset('lp/images/icon-email.png')}}"
                                alt="" class="icon"></div>
                        <div class="control"><input type="text" placeholder="Phone..."><img
                                src="{{asset('lp/images/phone.png')}}" width="21" height="21" alt="" class="icon"></div>
                    </div>
                    <div class="col-md-6">
                        <div class="control">
                            <textarea name="" placeholder="Your message..."></textarea>
                            <img src="{{asset('lp/images/icon-pen.png')}}" alt="" class="icon">
                        </div>
                        <p class="text-right">
                            <input type="submit" value="Send message">
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>


</main>

@endsection
