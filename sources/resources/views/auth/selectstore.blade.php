<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PONDOPOS - SELECT STORE</title>
  <link rel="icon"  type="image/x-icon" href="{{url('assets/img/logo/1_favicon.png')}}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="assets/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img src="{{url('assets\img\logo\5_logo.png')}}" alt="Logo Pondo" style="width : 15rem">
    <h1 class="text-danger">SELECT STORE</h1>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body" style="overflow: auto;">
    <ul class="list-group">
      @foreach($data['store'] as $store)
      <button class="list-group-item" onclick="select_store({{$store->store_id}})">
        <i class="fa fa-shopping-bag" style="margin-right: 15px"></i>
        {{$store->name}}
        <i class="fa fa-long-arrow-right pull-right" aria-hidden="true"></i>
      </button>
      @endforeach
    </ul>
    <form id="set_store" action="{{route('set_store')}}" method="post">
      @csrf
      <input type="hidden" name="store_id" id="store_id">
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });

  function select_store(id){
    $('#store_id').val(id);
    document.getElementById("set_store").submit();
  }
</script>
</body>
</html>
