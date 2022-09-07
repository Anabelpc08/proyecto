@extends('adminlte::page')

@section('title', 'SIPA')


@section('content')
  <div class="container">
    <div class="d-flex align-items-center justify-content-center flex-column bd-highlight my-auto" style="height: 700px;">
      <div class=" bd-highlight"><h1 class="fw-bolder py-3">ÁREA DE ALMACÉN </h1></div>
      <div class=" bd-highlight"><h1 class="fw-bolder py-3">SISTEMA INTEGRAL DE PROCESOS ADMINISTRATIVOS</h1></div>
      <div class=" bd-highlight"><h2>Hospital Regional 1° de Octubre</h2></div>
    </div>
  </div>
@stop


@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<!-- Se llama archivo css de Datatables y se v a aplicar solamente en el index de los proveedores -->
<link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" rel="style"></link>
 <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<!-- Styles -->
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
@stop
