  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; <?php echo date ('Y');  ?> <a href="https://adminlte.io">Afriqil Wildan</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="{{asset('AdminLTE')}}/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="{{asset('AdminLTE')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="{{asset('AdminLTE')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('AdminLTE')}}/dist/js/adminlte.js"></script>


  <!-- PAGE PLUGINS -->
  <!-- jQuery Mapael -->
  <script src="{{asset('AdminLTE')}}/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
  <script src="{{asset('AdminLTE')}}/plugins/raphael/raphael.min.js"></script>
  <script src="{{asset('AdminLTE')}}/plugins/jquery-mapael/jquery.mapael.min.js"></script>
  <script src="{{asset('AdminLTE')}}/plugins/jquery-mapael/maps/usa_states.min.js"></script>
  <!-- ChartJS -->
  <script src="{{asset('AdminLTE')}}/plugins/chart.js/Chart.min.js"></script>

  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('AdminLTE')}}/dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{asset('AdminLTE')}}/dist/js/pages/dashboard2.js"></script>
  <!-- Custom JS -->
  <script src="{{asset('AdminLTE')}}/js/custom.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="{{asset('AdminLTE')}}/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="{{asset('AdminLTE')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="{{asset('AdminLTE')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script>
    $(function() {
      $("#cmspages").DataTable();
      $("#subadmins").DataTable();
      $("#categories").DataTable();
    });
  </script>
  <!-- Select2 -->
  <script src="{{asset('AdminLTE')}}/plugins/select2/js/select2.full.min.js"></script>
  <script>$('.select2').select2();</script>
  <!-- AlertSweet2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </body>

  </html>