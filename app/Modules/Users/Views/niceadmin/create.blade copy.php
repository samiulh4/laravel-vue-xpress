@extends('layouts.niceadmin')
@section('styles')
<!-- Jquery Steps CSS -->
<link href="{{ asset('assets/common/plugins/jquery-steps/css/normalize.css') }}" rel="stylesheet">
<link href="{{ asset('assets/common/plugins/jquery-steps/css/main.css') }}" rel="stylesheet">
<link href="{{ asset('assets/common/plugins/jquery-steps/css/jquery.steps.css') }}" rel="stylesheet">
<style>
    .input-group-text {
        margin: 0px !important;
    }
</style>
@endsection
@section('content')
<div class="col-md-12">
    <form class="user-create-step-form" id="userCreateStepForm" method="" action="" enctype="multipart/form-data" autocomplete="off">
        {{ csrf_field() }}
        <div class="step-form-wizard" id="stepFormWizard">
            <!-- start -:- General Information -->
            <h2>General Information</h2>
            <fieldset>
                <div class="row">
                    <div class="col-md-6 position-relative">
                        <label for="user_type_id" class="form-label">User Type<span class="text-danger fw-bold">&nbsp;*&nbsp;</span></label>
                        <label class="input-error-message"></label>
                        <select class="form-select" id="user_type_id" name="user_type_id">
                            <option value="">--SELECT USER TYPE--</option>
                            @foreach ($userTypeList as $l)
                            <option value="{{ $l->id }}">{{ $l->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 position-relative">
                        <label for="name" class="form-label">Name<span class="text-danger fw-bold">&nbsp;*&nbsp;</span></label>
                        <label class="input-error-message"></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Full Name" />
                    </div>
                    <div class="col-md-6 position-relative mt-4">
                        <label for="email" class="form-label">E-mail<span class="text-danger fw-bold">&nbsp;*&nbsp;</span></label>
                        <label class="input-error-message"></label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter E-mail" />
                    </div>
                    <div class="col-md-6 position-relative mt-4">
                        <label for="name" class="form-label">Username<span class="text-danger fw-bold">&nbsp;*&nbsp;</span></label>
                        <label class="input-error-message"></label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" />
                    </div>
                    <div class="col-md-6 position-relative mt-4">
                        <label for="mobile_no" class="form-label">Mobile No.<span class="text-danger fw-bold">&nbsp;*&nbsp;</span></label>
                        <label class="input-error-message"></label>
                        <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="Enter Mobile No." />
                    </div>
                    <div class="col-md-6 position-relative mt-4">
                        <label for="phone_no" class="form-label">Phone No.</label>
                        <label class="input-error-message"></label>
                        <input type="text" class="form-control" id="phone_no" name="phone_no" placeholder="Enter Phone No." />
                    </div>
                    <div class="col-md-6 position-relative mt-4">
                        <label for="date_of_birth" class="form-label">Date Of Birth<span class="text-danger fw-bold">&nbsp;*&nbsp;</span></label>
                        <label class="input-error-message"></label>
                        <div class="input-group">
                            <input type="text" name="date_of_birth" id="date_of_birth" class="form-control dob-datepicker" placeholder="YY-MM-DD" />
                            <div class="input-group-prepend">
                                <label class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 position-relative mt-4">
                        <label for="country_id" class="form-label">Country<span class="text-danger fw-bold">&nbsp;*&nbsp;</span></label>
                        <label class="input-error-message"></label>
                        <select class="form-select" id="country_id" name="country_id">
                            <option value="">-- SELECT COUNTRY--</option>
                            @foreach ($countryList as $l)
                            <option value="{{ $l->id }}">{{ $l->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 position-relative mt-4">
                        <label for="national_id" class="form-label">National ID</label>
                        <label class="input-error-message"></label>
                        <input type="text" class="form-control" id="national_id" name="national_id" placeholder="Enter National ID" />
                    </div>
                    <div class="col-md-6 position-relative mt-4">
                        <label for="passport_no" class="form-label">Passport No.</label>
                        <label class="input-error-message"></label>
                        <input type="text" class="form-control" id="passport_no" name="passport_no" placeholder="Enter Passport No." />
                    </div>
                </div><!-- ./row -->
            </fieldset>
            <!-- start -:- General Information -->

            <!-- start -:- Education & Work Information -->
            <h2>Education & Work</h2>
            <fieldset>
                <div class="row">
                    <div class="col-md-12">
                        <h3>User Educational Information</h3>
                    </div>
                    <div class="col-md-6 position-relative mt-4">
                        <label for="national_id" class="form-label">National ID</label>
                        <label class="input-error-message"></label>
                        <input type="text" class="form-control" id="national_id" name="national_id" placeholder="Enter National ID" />
                    </div>
                    <div class="col-md-6 position-relative mt-4">
                        <label for="passport_no" class="form-label">Passport No.</label>
                        <label class="input-error-message"></label>
                        <input type="text" class="form-control" id="passport_no" name="passport_no" placeholder="Enter Passport No." />
                    </div>
                </div>
            </fieldset>
            <!-- end -:- Education & Work Information -->

            <h2>Education & Work</h2>
            <fieldset> </fieldset>
        </div><!-- ./step-form-wizard -->
    </form>
</div>
@endsection
@section('scripts')
<!-- Jquery Steps JS -->
<script src="{{ asset('assets/common/plugins/jquery-steps/js/modernizr-2.6.2.min.js') }}"></script>
<script src="{{ asset('assets/common/plugins/jquery-steps/js/jquery.cookie-1.3.1.js') }}"></script>
<script src="{{ asset('assets/common/plugins/jquery-steps/js/jquery.steps.js') }}"></script>
<script type="text/javascript">
    var formStep = $('#stepFormWizard');
    $(document).ready(function() {
        $(formStep).steps({
            headerTag: "h2",
            bodyTag: "fieldset",
            transitionEffect: "slideLeft",
            labels: {
                next: "Next",
                previous: "Previous",
                finish: "Submit",
                loading: "Loading ...",
            },
            onStepChanging: function(event, currentIndex, newIndex) {
                //formEl.validate().settings.ignore = ":disabled,:hidden";
                //return formEl.valid();
            },
            onStepChanged: function(event, currentIndex, newIndex) {

            },
            onFinished: function(event, currentIndex) {
                event.preventDefault();
                /*formEl.validate().settings.ignore = ":disabled,:hidden";
                if(formTag.valid() == false){
                    return false;
                }*/
                if (confirm("Are you sure ?")) {
                    var formData = new FormData(document.querySelector('#user-create-edit-step-form'));
                    submitUserStoreOrUpdateStepForm(formData);
                } else {
                    return false;
                }
            }
        }); // end -:- Step Form
        $('.dob-datepicker').datepicker({
            maxDate: '0',
            dateFormat: 'yy-mm-dd'
        });
    }); // Document Ready    
</script>
@endsection