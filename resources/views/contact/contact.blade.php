@extends('layouts.index')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="./Asset/css/contact us.css">

    <div class="center modal-box">
        <div class="title-contact">Contact Us
            <div class="fas fa-times"></div>
        </div>
        <div class="form_container">
            <form action="#" name="form">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Full name
                            <input type="text" placeholder="Enter your full name" required>
                        </span>
                        <span class="details">Email
                            <input type="email" placeholder="xxx@gmail.com" pattern="^[a-zA-Z0-9._%+-]+@gmail\.com$"
                                required>
                        </span>
                        <span class="details">Phone
                            <input type="tel" placeholder="XXXX-XXX-XXX" pattern="\d{10}" required>
                        </span>
                    </div>
                    <div class="input-box">
                        <span class="details">
                            <span>Comment</span>
                            <textarea name="comment" id="comment" required></textarea>
                        </span>
                    </div>
                </div>
                <div class="button">
                    <input type="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="./Asset/js/contact us.js"></script>
@endsection
