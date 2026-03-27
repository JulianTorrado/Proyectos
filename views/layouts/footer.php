<!-- /.card-footer-->
</div>
<!-- /.card -->
</div>
</div>
</div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 1.0.0
  </div>
  <strong>Copyright &copy; 2022 <a href="https://calidadsg.com">calidadsg.com</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>

<!-- <script src="assets\dist\js\validaciones.js"></script> -->
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="assets/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="assets/plugins/jszip/jszip.min.js"></script>
<script src="assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes 
<script src="View/library/dist/js/demo.js"></script>-->


<script>
  $(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
  });

  $(document).ready(function () {
    $('[data-toggle="popover"]').popover();
  });
</script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $("#example3").DataTable({
      "responsive": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print"],
      "order": [[3, 'desc']], // Ordenar solo la columna 4 (índice 3)
    }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');



    $("#examplee1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#examplee1_wrapper .col-md-6:eq(0)');

    $("#actividadesf").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#actividadesf_wrapper .col-md-6:eq(0)');

    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
  });

  // In your Javascript (external .js resource or <script> tag)
  $(document).ready(function () {
    $('.js-example-basic-single').select2();
  });

  //Initialize Select2 Elements
  $('.select2').select2()

  //Initialize Select2 Elements
  $('.select2bs4').select2({
    theme: 'bootstrap4'
  });

  $('.swalDefaultSuccess').click(function () {
    Toast.fire({
      icon: 'success',
      title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
    })
  });
  $('.swalDefaultInfo').click(function () {
    Toast.fire({
      icon: 'info',
      title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
    })
  });
  $('.swalDefaultError').click(function () {
    Toast.fire({
      icon: 'error',
      title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
    })
  });
  $('.swalDefaultWarning').click(function () {
    Toast.fire({
      icon: 'warning',
      title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
    })
  });
  $('.swalDefaultQuestion').click(function () {
    Toast.fire({
      icon: 'question',
      title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
    })
  });



</script>
</body>

</html>