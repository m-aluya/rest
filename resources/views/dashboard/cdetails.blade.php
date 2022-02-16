@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row mb-4">
            <div class="col-md-8 mx-auto mb-4">





                <div class="card text-left">
                    <div class="card-body">
                        <h4 class="card-title mb-5 font-weight-bold text-capitalize"><i
                                class="fa fa-long-arrow-right    "></i> {{ $collection->get('name') }}'s details</h4>
                        <a class="btn btn-primary pl-4 pr-4 mb-3" href="{{ route('customers', ['type' => 'both']) }}"> <i
                                class="fa fa-long-arrow-left" aria-hidden="true"></i> Go back</a>
                        @if (Auth::user()->accounttype == 'Admin')
                            @if ($collection->get('accountstatus') == 1)
                                <button data-c="danger" data-v="block" id="block" type="button"
                                    class="btn btn-danger pl-4 pr-4 mb-3 bl">Block Customer <i class="fa fa-lock"
                                        aria-hidden="true"></i> </button>

                            @else
                                <button id="unblock" data-c="success" data-v="unblock" id="block" type="button"
                                    class="btn btn-success pl-4 pr-4 mb-3 bl">Unblock Customer <i class="fa fa-unlock"
                                        aria-hidden="true"></i> </button>
                            @endif
                        @endif

                        @if (session()->has('message'))
                            <div class="text-center alert alert-success">{{ session()->get('message') }}</div>
                        @endif

                        @if ($orders != 0)
                            <p><strong>Total orders: {{ $orders }}</strong></p>
                        @endif


                        <table class="display table table-striped table-bordered">
                            @foreach ($collection as $key => $detail)
                                <tr>
                                    @if ($key == 'auth_code')
                                    @else <td id="{{ $key }}" data-{{ $key }}="{{ $detail }}"
                                            class="text-uppercase font-weight-bold"> {{ str_replace('_', ' ', $key) }}
                                        </td>
                                        <td>{{ $detail }}</td>
                                    @endif
                                </tr>
                            @endforeach
                        </table>
                        <a class="btn btn-primary pl-4 pr-4 mb-3" href="{{ route('customers', ['type' => 'both']) }}"><i
                                class="fa fa-long-arrow-left" aria-hidden="true"></i> Go back</a>

                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="modal" tabindex="-1" id="blm">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Block {{ $collection->get('name') }}'s account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center"> You about to <span class="f"></span>
                        <b>{{ $collection->get('name') }}'s</b> account. <br />Are you sure you want to do this?
                    </p>



                    <form action="{{ route('customer.block', $collection->get('id')) }}" method="post"
                        class="text-center">
                        @csrf
                        <input name="id" type="hidden" id="idx" value="{{ $collection->get('id') }}">
                        <input type="hidden" id="customerName" value="{{ $collection->get('name') }}">
                        <button type="submit" id="bn" class="btn pl-3 pr-3">Yes, <span class="f"></span> the
                            account </button>
                        <button type="button" class="btn btn-dark pl-4 pr-4">No <i class="fa fa-remove"></i></button>

                    </form>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(".bl").click(function() {
            var cl = $(this).data('v');
            $(".f").html($(this).data('v'));

            $("#blm").modal('show');
        });
    </script>
@endsection
