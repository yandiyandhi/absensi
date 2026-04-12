$(document).ready(function () {
    $("#modalEditJenisIzin").on("show.bs.modal", function (event) {
        const button = $(event.relatedTarget);

        const id = button.data("id");
        const name = button.data("name");

        $("#nama_izin").val(name);

        $("#formEditIzin").attr("action", `/jenis-izin/${id}`);
    });
});

// Delete Jenis Izin
$(document).on("click", ".deleteJenisIzin", function () {
    const id = $(this).data("id");
    const name = $(this).data("name");

    Swal.fire({
        text: `Jenis izin "${name}" akan dihapus`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, hapus",
        cancelButtonText: "Batal",
        confirmButtonColor: "#d33",
        width: "80%",
    }).then((result) => {
        if (result.isConfirmed) {
            $("#formDeleteJenisIzin").attr("action", `/jenis-izin/${id}`);
            $("#formDeleteJenisIzin").submit();
        }
    });
});

// Edit Departemen
$(document).ready(function () {
    $("#modalEditDepartemen").on("show.bs.modal", function (event) {
        const button = $(event.relatedTarget);

        const id = button.data("id");
        const name = button.data("name");

        $("#nama_departemen").val(name);

        $("#formEditDepartemen").attr("action", `/departemen/${id}`);
    });
});

// Delete Departemen
$(document).on("click", ".deleteDepartemen", function () {
    const id = $(this).data("id");
    const name = $(this).data("name");

    Swal.fire({
        text: `Departemen "${name}" akan dihapus`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, hapus",
        cancelButtonText: "Batal",
        confirmButtonColor: "#d33",
        width: "80%",
    }).then((result) => {
        if (result.isConfirmed) {
            $("#formDeleteDepartemen").attr("action", `/departemen/${id}`);
            $("#formDeleteDepartemen").submit();
        }
    });
});

// Edit Jabatan
function DataDepartemen(id) {
    return $.ajax({
        url: `/jabatan/departemen/${id}`,
        type: "GET",
        dataType: "json",
    });
}

function loadDepartemenOptions(select) {
    return $.ajax({
        url: "/departemen/get-data",
        type: "GET",
        dataType: "json",
        success: function (res) {
            select.clearOptions();

            res.forEach((item) => {
                select.addOption({
                    value: item.id, // atau uuid
                    text: item.nama_departemen,
                });
            });

            select.refreshOptions(false);
        },
    });
}

$(document).ready(function () {
    $("#modalEditJabatan").on("show.bs.modal", async function (event) {
        const button = $(event.relatedTarget);

        const id = button.data("id");
        const name = button.data("name");

        let departemen = await DataDepartemen(id);
        const dept = departemen.departemen_id;

        $("#nama_jabatan").val(name);
        $("#formEditJabatan").attr("action", `/jabatan/${id}`);

        let select = document.querySelector("#departemenEdit_id").tomselect;
        select.setValue(dept);
    });
});

// Delete Jabatan
$(document).on("click", ".deleteJabatan", function () {
    const id = $(this).data("id");
    const name = $(this).data("name");

    Swal.fire({
        text: `Jabatan "${name}" akan dihapus`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, hapus",
        cancelButtonText: "Batal",
        confirmButtonColor: "#d33",
        width: "80%",
    }).then((result) => {
        if (result.isConfirmed) {
            $("#formDeleteJabatan").attr("action", `/jabatan/${id}`);
            $("#formDeleteJabatan").submit();
        }
    });
});

// Delete Kantor
$(document).on("click", ".deleteKantor", function () {
    const id = $(this).data("id");
    const name = $(this).data("name");

    Swal.fire({
        text: `Kantor "${name}" akan dihapus`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, hapus",
        cancelButtonText: "Batal",
        confirmButtonColor: "#d33",
        width: "80%",
    }).then((result) => {
        if (result.isConfirmed) {
            $("#formDeleteKantor").attr("action", `/kantor/${id}`);
            $("#formDeleteKantor").submit();
        }
    });
});

// Cancel Izin
$(document).on("click", ".cancelIzin", function () {
    const id = $(this).data("id");

    Swal.fire({
        text: "Pengajuan izin akan dibatalkan",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, Batal",
        cancelButtonText: "Batal",
        confirmButtonColor: "#d33",
        width: "80%",
    }).then((result) => {
        if (result.isConfirmed) {
            $("#formCancelIzin").attr("action", `/izin/cancel/${id}`);
            $("#formCancelIzin").submit();
        }
    });
});

// Approval izin
// Setujui Izin
$(document).on("click", ".SetujuiIzin", function () {
    const id = $(this).data("id");
    const name = $(this).data("name");
    console.log(id, name);
    Swal.fire({
        text: `Izin "${name}" akan disetujui`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, setujui",
        cancelButtonText: "Batal",
        confirmButtonColor: "#d33",
        width: "80%",
    }).then((result) => {
        if (result.isConfirmed) {
            $("#SetujuiIzin").attr("action", `/izin/approve/${id}`);
            $("#SetujuiIzin").submit();
        }
    });
});

// Tolak Izin
$(document).on("click", ".TolakIzin", function () {
    const id = $(this).data("id");
    const name = $(this).data("name");
    console.log(id, name);
    Swal.fire({
        text: `Izin "${name}" akan ditolak`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, tolak",
        cancelButtonText: "Batal",
        confirmButtonColor: "#d33",
        width: "80%",
    }).then((result) => {
        if (result.isConfirmed) {
            $("#TolakIzin").attr("action", `/izin/tolak/${id}`);
            $("#TolakIzin").submit();
        }
    });
});
