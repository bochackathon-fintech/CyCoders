<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.jpg') }}">

    <!-- CSFR token for ajax call -->
    <meta name="_token" content="{{ csrf_token() }}" />

    <title>User</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="styleeheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- icheck checkboxes -->
    <link rel="stylesheet" href="{{ asset('icheck/square/yellow.css') }}">


    <!-- toastr notifications -->

    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">


    <!-- Font Awesome -->


    <style>
        .panel-heading {
            padding: 0;
        }

        .panel-heading ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        .panel-heading li {
            float: left;
            border-right: 1px solid #bbb;
            display: block;
            padding: 14px 16px;
            text-align: center;
        }

        .panel-heading li:last-child:hover {
            background-color: #ccc;
        }

        .panel-heading li:last-child {
            border-right: none;
        }

        .panel-heading li a:hover {
            text-decoration: none;
        }

        .table.table-bordered tbody td {
            vertical-align: baseline;
        }
    </style>

</head>

<body>
    <div class="col-md-8 col-md-offset-2">
        <h2 class="text-center">User Profile</h2>
        <br />
        <div class="panel panel-default">
          <div class="panel-heading">
            Settings
          </div>
          <div class="panel-body">
              <a href="#" class="btn btn-primary" id="rate-settings">Rate</a>
              <a href="#" class="btn btn-success" id="piggy-settings">PiggyBags</a>
              <a href="#" class="btn btn-info" id="info-settings">Info</a>
          </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <ul>
                    <li><i class="fa fa-file-text-o"></i> All the current Transactions</li>
                </ul>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover" id="">

                    <thead>
                        <th>
                            Amount
                        </th>
                        <th>
                            Pinkyyy
                        </th>
                    </thead>
                    <tbody>
                        <td>{{floatval($balance->available_amount)}}</td>
                        <td>{{floatval($balance->pinky)}}</td>
                    </tbody>
                </table>
            </div>

            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover" id="postTable" style="visibility: hidden;">
                    <thead>
                        <tr>
                            <th valign="middle">#</th>
                            <th>ID</th>
                            <th>User</th>
                            <th>Receiver</th>
                            <th>Amount</th>
                            <th>Last updated</th>

                    </thead>
                    <tbody>

                        @foreach($transactions as $key => $transaction)
                        <tr class="item{{$transaction->id}}">
                            <td class="col1"></td>
 <td>{{$transaction->id}}</td>
                            <td>
                                {{$transaction->TransactionUser->email}}
                            </td>
                            <td>
                                {{$transaction->ReceivingUser->email}}
                            </td>
                            <td>
                                {{$transaction->amount}}
                            </td>
                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $transaction->updated_at)->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="panel-body">
               <span class="text-center">
                   Received Transactions
               </span>
                <table class="table table-striped table-bordered table-hover" id="" style="">
                    <thead>
                        <tr>
                            <th valign="middle">#</th>
                            <th>ID</th>
                            <th>User</th>
                            <th>Receiver</th>
                            <th>Amount</th>
                            <th>Last updated</th>

                    </thead>
                    <tbody>

                        @foreach($received as $key => $rec)
                        <tr class="item{{$transaction->id}}">
                            <td class="col1"></td>
 <td>{{$rec->id}}</td>
                            <td>
                                {{$rec->TransactionUser->email}}
                            </td>
                            <td>
                                {{$rec->ReceivingUser->email}}
                            </td>
                            <td>
                                {{$rec->amount}}
                            </td>
                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $rec->updated_at)->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel panel-default -->
    </div>
    <div id="rate-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                    <form class="form-horizontal" role="form">
                <div class="modal-body">
                          <div class="form-group">
                            <label class="control-label col-sm-1" for="title"></label>
                            <div class="col-sm-9">
                               <div class="form-group">
                              <label for="usr">Amount:</label>
                              <input type="number" class="form-control" id="amount" placeholder="eg.. 3%">
                              <small class="label label-warning">No need to include the % sign</small>
                                <p class="errorContent text-center alert alert-danger hidden"></p>
                                </div>
                              </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success add" data-dismiss="modal">
                            <span id="" class='glyphicon glyphicon-check'></span> Add
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Close
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>

    <!-- Bootstrap JavaScript -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.1/js/bootstrap.min.js"></script>

    <!-- toastr notifications -->
    {{--
    <script type="text/javascript" src="{{ asset('toastr/toastr.min.js') }}"></script> --}}
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- icheck checkboxes -->
    <script type="text/javascript" src="{{ asset('icheck/icheck.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/charge-calls.js') }}"></script>

    <!-- Delay table load until everything else is loaded -->
    <script>
        $(window).load(function() {
            $('#postTable').removeAttr('style');
        })
    </script>

</body>

</html>