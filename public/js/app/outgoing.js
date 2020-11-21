import Config from "../config/config.js";
import Helper from "../config/helper.js";

// variabel
const selectName = document.getElementById("user_id");
const nominal = document.getElementById("nominal");
const submit = document.getElementById("form-outgoing");
const urlTotal = `${Config.url}/transaksi/transaksi-keluar/json-total`;
// end

// jquery code
$(function() {
  $(".select2").select2({
    dropdownParent: $("#exampleModal"),
  });
  $("#table").DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    lengtChange: true,
    autoWidth: false,
    ajax: {
      url: `${Config.url}/transaksi/transaksi-keluar/json-data`,
    },
    columns: [
      { data: "DT_RowIndex", name: "no" },
      { data: "name", name: "name" },
      { data: "nominal", name: "nominal" },
      { data: "created_at", name: "created_at" },
      { data: "action", name: "action" },
    ],
    order: [[4, "desc"]],
  });
});
// jquer code end

// vanilla js

nominal.addEventListener("keyup", (e) => {
  e.target.value = Helper.inputRupiah(e.target.value);
});

const handleValidate = () => {
  if (selectName.value == "") {
    selectName.classList.add("border-danger");
    selectName.focus();
  }
  if (nominal.value == "") {
    nominal.classList.add("border-danger");
    nominal.focus();
  }
};

const handleSubmit = (e) => {
  e.preventDefault();
  const urlSubmit = `${Config.url}/transaksi/transaksi-keluar/store`;
  const formData = new FormData();
  formData.append("user_id", selectName.value);
  formData.append("nominal", Helper.removeDot(nominal.value));

  Helper.storeData(
    urlSubmit,
    Helper.setConfig("POST", "cors", Config.tokenCsrf, formData)
  )
    .then((res) => {
      if (res.success) {
        Helper.reloadDataTabel("#table");
        Helper.reloadForm("#form-outgoing", ".select2");
        Helper.getTotal(urlTotal, ".total");
        Helper.successMsg(res.message);
        $("#exampleModal").modal("hide");
      } else {
        if (res.warning) {
          return Helper.warningMsg(res.message);
        }
        for (let index in res.message) {
          Helper.errorMsg(res.message[index]);
          handleValidate();
        }
      }
    })
    .catch((err) => console.error(err));
};

const handleDelete = (e) => {
  if (e.target.classList.contains("delete")) {
    const id = e.target.dataset.id;
    const urlDelete = `${
      Config.url
    }/transaksi/transaksi-keluar/delete/${parseInt(id)}`;
    swal({
      title: "Apakah Kamu Yakin ?",
      text: "Setelah dihapus anda tidak dapat memulihkan data ini!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        Helper.storeData(
          urlDelete,
          Helper.setConfig("DELETE", "cors", Config.tokenCsrf)
        )
          .then((res) => {
            Helper.reloadDataTabel("#table");
            Helper.getTotal(urlTotal, ".total");
            Helper.successMsg(res.message);
          })
          .catch((err) => Helper.errorMsg(err));
      } else {
        swal("Your imaginary file is safe!");
      }
    });
  }
};

submit.addEventListener("submit", handleSubmit);
document.addEventListener("click", handleDelete);
window.onload = Helper.getTotal(urlTotal, ".total");
// vanilla js end
