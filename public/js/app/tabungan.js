import Config from "../config/config.js";
import Helper from "../config/helper.js";

// variable
const urlTotal = `${Config.url}/tabungan/json-total`;
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
      url: `${Config.url}/tabungan/json-data`,
    },
    columns: [
      { data: "DT_RowIndex", name: "no" },
      { data: "name", name: "name" },
      { data: "saldo", name: "saldo" },
      { data: "created_at", name: "created_at" },
      { data: "updated_at", name: "updated_at" },
      { data: "action", name: "action" },
    ],
    order: [[4, "desc"]],
  });
});
// jquer code end

// vanilla js code
const handleDelete = (e) => {
  if (e.target.classList.contains("delete")) {
    const id = e.target.dataset.id;
    const userId = e.target.dataset.userid;
    const urlDelete = `${Config.url}/tabungan/delete/${parseInt(id)}`;
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
          Helper.setConfig("DELETE", "cors", Config.tokenCsrf, {
            user_id: parseInt(userId),
          })
        )
          .then((res) => {
            Helper.reloadDataTabel("#table");
            Helper.getTotal(urlTotal, ".total");
            Helper.successMsg(res.message);
          })
          .catch((err) => console.error(err));
      } else {
        swal("Ok!!");
      }
    });
  }
};

const handleDetail = (e) => {
  const userId = e.target.dataset.userid;
  if (e.target.classList.contains("detail-income")) {
    console.log(userId);
  } else if (e.target.classList.contains("detail-out")) {
    console.log(userId);
  }
};

document.addEventListener("click", handleDelete);
window.onload = Helper.getTotal(urlTotal, ".total", "Total Tabungan");
// end
