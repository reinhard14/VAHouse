@extends('layouts.va.va-layout')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8 offset-md-1 mb-5 pb-5">
            <div class="row my-4">
                <div class="col">
                    <h3>Dashboard</h3>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                             <div class="row border-bottom mb-3">
                                <div class="col text-center mb-3">
                                    <img src="{{asset('dist/img/user_default.png')}}" alt="va-avatar" height="175px" width="175px">
                                    <p>
                                        <span class=" badge badge-pill badge-success span-normal-text">Hired</span>
                                    </p>

                                    <span class="text-orange"><i class="bi bi-patch-check-fill"></i> </span> <small class=""> Tier 1 VA </small>
                                    <span class="text-orange pl-3"><i class="bi bi-shield-fill-check"></i></span><small> HR Unverified</small>
                                </div>
                                <div class="col">
                                    <small>
                                        Service Provider Name
                                    </small>
                                    <p class="font-weight-bold">Rest Art</p>

                                    <small>
                                        Date Hired
                                    </small>
                                    <p class="font-weight-bold">January 01, 2021</p>

                                    <small>
                                        Department/Client
                                    </small>
                                    <p class="font-weight-bold">Esther Buns</p>
                                </div>
                                <div class="col">
                                    <small>
                                        Designation
                                    </small>
                                    <p class="font-weight-bold">Virtual Assistant</p>

                                    <small>
                                        Shift
                                    </small>
                                    <p class="font-weight-bold">Full Time / 40 hours per week</p>

                                    <small>
                                        Team Leader
                                    </small>
                                    <p class="font-weight-bold">Eunny Fas</p>
                                </div>
                             </div>

                             <div class="row border-bottom mb-3 px-4">
                                <div class="col-md-8">
                                    <small>
                                        Services Offered
                                    </small>
                                    <p class="font-weight-bold">Human Resource Management</p>
                                </div>
                                <div class="col">
                                    <small>
                                        Rate in Peso
                                    </small>
                                    <p class="font-weight-bold">129.6</p>
                                </div>
                             </div>

                             <div class="row px-4">
                                <div class="col-md-8">
                                    <small>
                                        Skype
                                    </small>
                                    <p class="font-weight-bold">Hr.skype</p>

                                    <small>
                                        Mobile Number
                                    </small>
                                    <p class="font-weight-bold">09201231231</p>
                                </div>
                                <div class="col">
                                    <small>
                                        Email
                                    </small>
                                    <p class="font-weight-bold">vahouse.dummymail@gmail.com</p>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5">
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="{{ asset('dist/js/pages/user-end/index.js') }}"></script>

@endsection
