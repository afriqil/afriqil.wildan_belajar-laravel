$(document).ready(function () {
  // Memeriksa apakah kata sandi admin benar atau salah
  $("#current_pwd").keyup(function () {
    var current_pwd = $("#current_pwd").val();
    alert(current_pwd);
    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      type: "post",
      url: "/admin/check-current-password",
      data: { current_pwd: current_pwd },
      success: function (resp) {
        if (resp == "false") {
          $("#verivyCurrentPwd").html("Kata Sandi Saat Ini Salah!");
        } else if (resp == "true") {
          $("#verivyCurrentPwd").html("Kata Sandi Saat Ini Benar!");
        }
      },
      error: function () {
        alert("error");
      },
    });
  });

  // Memperbarui Status Halaman CMS
  $(document).on("click", ".updateCmsPageStatus", function () {
    var status = $(this).children("i").attr("status");
    var page_id = $(this).attr("page_id");
    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      type: "post",
      url: "/admin/update-cms-page-status",
      data: { status: status, page_id: page_id },
      success: function (resp) {
        if (resp["status"] == 0) {
          $("#page-" + page_id).html(
            "<i class='fas fa-toggle-off' style='color:#B22222' status='Tidak Aktif'></i>"
          );
        } else if (resp["status"] == 1) {
          $("#page-" + page_id).html(
            "<i class='fas fa-toggle-on' style='color:#3f6ed3' status='Aktif'></i>"
          );
        }
      },
      error: function () {
        alert("Terjadi kesalahan");
      },
    });
  });

    // Memperbarui Status Halaman category
  $(document).on("click", ".updateCategoryStatus", function () {
    var status = $(this).children("i").attr("status");
    var category_id = $(this).attr("category_id");
    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      type: "post",
      url: "/admin/update-category-status",
      data: { status: status, category_id: category_id },
      success: function (resp) {
        if (resp["status"] == 0) {
          $("#category-" + category_id).html(
            "<i class='fas fa-toggle-off' style='color:#B22222' status='Tidak Aktif'></i>"
          );
        } else if (resp["status"] == 1) {
          $("#category-" + category_id).html(
            "<i class='fas fa-toggle-on' style='color:#3f6ed3' status='Aktif'></i>"
          );
        }
      },
      error: function () {
        alert("Terjadi kesalahan");
      },
    });
  });


  // Memperbarui status halaman Sub Admin
  $(document).on("click", ".updateSubadminStatus", function () {
    var status = $(this).children("i").attr("status");
    var subadmin_id = $(this).attr("subadmin_id");
    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      type: "post",
      url: "/admin/update-subadmin-status",
      data: { status: status, subadmin_id: subadmin_id },
      success: function (resp) {
        if (resp["status"] == 0) {
          $("#subadmin-" + subadmin_id).html(
            "<i class='fas fa-toggle-off' style='color:#B22222' status='Tidak Aktif'></i>"
          );
        } else if (resp["status"] == 1) {
          $("#subadmin-" + subadmin_id).html(
            "<i class='fas fa-toggle-on' style='color:#3f6ed3' status='Aktif'></i>"
          );
        }
      },
      error: function () {
        alert("Terjadi kesalahan");
      },
    });
  });

  //   Conform delete of CMS Pages
  /* $(document).on("click", ".confirmDelete", function () {
    var name = $(this).attr("name");
    if (
      confirm("Apakah Anda yakin ingin menghapus halaman ini " + name + " ?")
    ) {
      return true;
    }
    return false;
  }); */

  //confirm deletion with Sweetalert
  $(document).on("click", ".confirmDelete", function () {
    var record = $(this).attr("record");
    var recordid = $(this).attr("recordid");
    Swal.fire({
      title: "Apakah Anda yakin?",
      text: "Tindakan ini tidak dapat dikembalikan!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, hapus!",
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire(
          "Terhapus!",
          "Berkas Anda telah dihapus.",
          "success"
        )
          // Redirect to delete URL after confirming deletion
          window.location.href = "/admin/delete-" + record + "/" + recordid;
      }
    });
  });
});
